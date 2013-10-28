<?php

/**
 * accident_get_jobs()
 *  
 *      Returns job data for a single user
 * 
 * @param integer $user_id
 * @return array The Job Data
 */


function accident_get_jobs($user_id=0){
    global $wpdb;
    if($user_id != 0){
        $jobs = array();
        $find_s = 'SELECT ar_job.*, acx_users.first_name, acx_users.last_name, acx_project_objects.state FROM ar_job 
        LEFT JOIN acx_users ON acx_users.id = ar_job.user_id
        LEFT JOIN acx_project_objects ON acx_project_objects.id = ar_job.ticket_id
        WHERE user_id=\''.$user_id.'\' AND ticket_id != \'\' AND (acx_project_objects.state !=1) 
        ORDER BY date_of_loss DESC';
               
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if($find_q !== false && count($find_q) > 0){
            foreach($find_q as $a_job) $jobs[] = $a_job;
        } 
                
        foreach($jobs as $key=>$job){
            $jobs[''.$key]['comments'] = accident_get_job_comments($job['id']);
            $jobs[''.$key]['ticket'] = accident_get_job_ticket($job['id']);
            $jobs[''.$key]['files'] = accident_get_job_files($job['id']);
        }
        return $jobs;
    } else return false;    
}

/**
 * accident_get_company_jobs()
 * 
 *      Returns job data for a single company (all users within the company)
 * 
 * @param integer $company_id
 * @return array The Job Data
 */
function accident_get_company_jobs($company_id=0){
    global $wpdb;
    if($company_id !== false){
        $jobs = array();
        $user_ids = array();
        $user_id_s = 'SELECT id FROM acx_users WHERE company_id=\''.$company_id.'\'';
        
        $user_id_q = $wpdb->get_results($user_id_s,'ARRAY_A');
        if($user_id_q !== false && count($user_id_q) > 0) foreach($user_id_q as $user_row) $user_ids[] = $user_row['id'];
        
        if(count($user_ids) > 0){
            $find_s = 'SELECT job.*, acx_users.first_name, acx_users.last_name FROM job 
            LEFT JOIN acx_users ON acx_users.id = job.user_id
            WHERE user_id IN (\''.implode('\',\'',$user_ids).'\') AND ticket_id != \'\' ORDER BY date_of_loss DESC';
        
            $find_q = $wpdb->get_results($find_s,'ARRAY_A');
            if($find_q !== false && count($find_q) > 0){
                foreach($find_q as $a_job) $jobs[] = $a_job;
            }   
        }
        foreach($jobs as $key=>$job){
            $jobs[''.$key]['comments'] = accident_get_job_comments($job['id']);
            $jobs[''.$key]['ticket'] = accident_get_job_ticket($job['id']);
            $jobs[''.$key]['files'] = accident_get_job_files($job['id']);
        }
        
        return $jobs; 
    } else return false;
    
}

/**
 * accident_get_company_jobs()
 * 
 *      Returns jobs with recent updates for a single company (all users within the company)
 * 
 * @param integer $company_id
 * @return array The Job Data
 */
function accident_get_company_jobs_updated($company_id=0){
    global $wpdb;
    if($company_id !== false){
        $jobs = array();
        $user_ids = array();
        $user_id_s = 'SELECT id FROM acx_users WHERE company_id=\''.$company_id.'\'';
        
        $current_user = $_SESSION['agent_user_data']['id'];
        $visit_s = 'SELECT last_activity_on FROM acx_users WHERE id='.$current_user;
        $visit_q = $wpdb->get_results($visit_s,'ARRAY_A');        
        $visit = $visit_q[0]['last_activity_on']; 
        $last_visit = date ("Y-m-d H:i:s", strtotime("-1 day", strtotime($visit)));        
        
        $user_id_q = $wpdb->get_results($user_id_s,'ARRAY_A');
        if($user_id_q !== false && count($user_id_q) > 0) foreach($user_id_q as $user_row) $user_ids[] = $user_row['id'];
        
        if(count($user_ids) > 0){
            $find_s = 'SELECT job.*, acx_users.first_name, acx_users.last_name, acx_project_objects.updated_on FROM job 
            LEFT JOIN acx_users ON acx_users.id = job.user_id
            LEFT JOIN acx_project_objects on acx_project_objects.id = job.ticket_id
            WHERE user_id IN (\''.implode('\',\'',$user_ids).'\') AND ticket_id != \'\' AND acx_project_objects.updated_on >= \''.$last_visit.'\' OR acx_project_objects.created_on >= \''.$last_visit.'\' ORDER BY date_of_loss DESC';
        
            $find_q = $wpdb->get_results($find_s,'ARRAY_A');
            if($find_q !== false && count($find_q) > 0){
                foreach($find_q as $a_job) $jobs[] = $a_job;
            }   
        }
        foreach($jobs as $key=>$job){
            $jobs[''.$key]['comments'] = accident_get_job_comments($job['id']);
            $jobs[''.$key]['ticket'] = accident_get_job_ticket($job['id']);
            $jobs[''.$key]['files'] = accident_get_job_files($job['id']);
        }
        
        return $jobs; 
    } else return false;
    
}

/**
 * accident_translate_job_state()
 * 
 *      Translates the job and ticket values into a 'State' (complete,pending,open)
 * 
 * @param mixed $ticket_id
 * @return string The State
 */
function accident_translate_job_state($ticket_id){
    global $wpdb;
    
    $info_s = 'SELECT completed_on FROM acx_project_objects WHERE id=\''.$ticket_id.'\'';
    $info_q = $wpdb->get_results($info_s,'ARRAY_A');
    if($info_q !== false && count($info_q) > 0){
        $completed_on = $info_q[0]['completed_on'];
        
        if(empty($completed_on)){
            $find_s = 'SELECT user_id FROM acx_assignments WHERE object_id=\''.$ticket_id.'\'';
            //echo '<div style="display:none;" class="ticket-assign-query">'.$find_s.'</div>';
            $find_q = $wpdb->get_results($find_s,'ARRAY_A'); 
            if(count($find_q) > 0){
                return 'Open';
            } else {
                return 'Pending';
            }
        } else return 'Complete';    
    } else return 'Unknown';
    
    
}

/**
 * accident_get_job_comments()
 * 
 *      Returns the Comments from Active Collab for the Ticket associated with a Job
 * 
 * @param integer $job_id
 * @return
 */
function accident_get_job_comments($job_id=0){
    global $wpdb;
    if($job_id != 0){
        $comments = array();
        $ticket_id = accident_get_job_ticket_id($job_id);
        $find_s = 'SELECT acx_project_objects.*, acx_users.first_name, acx_users.last_name 
            FROM acx_project_objects 
            LEFT JOIN acx_users ON acx_users.id = acx_project_objects.created_by_id
            WHERE parent_id=\''.$ticket_id.'\' AND type=\'Comment\' ORDER BY created_on ASC';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if($find_q !== false && count($find_q) > 0){
            foreach($find_q as $a_comment) $comments[] = $a_comment;
        }
        return $comments;
    } else return false;
}

/**
 * accident_get_new_comments()
 * 
 *      Returns the number of new Comments from Active Collab for the Ticket associated with a Job
 * 
 * @param integer $job_id
 * @return
 */
function accident_get_new_comments($job_id=0){
    global $wpdb;
    if($job_id != 0){
        $ticket_id = accident_get_job_ticket_id($job_id);
        $current_user = $_SESSION['agent_user_data']['id'];
        $visit_s = 'SELECT last_activity_on FROM acx_users WHERE id='.$current_user;
        $visit_q = $wpdb->get_results($visit_s,'ARRAY_A');        
        $visit = $visit_q[0]['last_activity_on']; 
        $last_visit = date ("Y-m-d H:i:s", strtotime("-1 day", strtotime($visit)));
        
        $find_s = 'SELECT acx_project_objects.*, acx_users.first_name, acx_users.last_name  
            FROM acx_project_objects 
            LEFT JOIN acx_users ON acx_users.id = acx_project_objects.created_by_id
            WHERE parent_id=\''.$ticket_id.'\' AND type=\'Comment\' AND acx_project_objects.created_on >= \''.$last_visit.'\' ORDER BY created_on ASC';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        $comments = 0;
        if($find_q !== false && count($find_q) > 0){
            foreach($find_q as $a_comment){
                $comments += 1;
            }
        }
        return $comments;
    } else return false;
}

/**
 * accident_get_job_ticket()
 * 
 *      Returns the Ticket data for the Ticket associated with a job
 * 
 * @param integer $job_id
 * @return
 */
function accident_get_job_ticket($job_id=0){
    global $wpdb;
    if($job_id != 0){
        $ticket_id = accident_get_job_ticket_id($job_id);
        $find_s = 'SELECT * FROM acx_project_objects WHERE id=\''.$ticket_id.'\'';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if($find_q !== false && count($find_q) > 0){
            return $find_q[0];
        } else return false;
    } else return false;
}


/**
 * accident_get_job_details()
 * 
 *      Returns data on a single job
 * 
 * @param integer $job_id
 * @return
 */
function accident_get_job_details($job_id=0){
    global $wpdb;
    if($job_id != 0){
        $find_s = 'SELECT * FROM job WHERE id=\''.$job_id.'\'';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if($find_q !== false && count($find_q) > 0){
            $job_data = $find_q[0];
            $job_data['comments'] = accident_get_job_comments($job_id);
            $job_data['ticket'] = accident_get_job_ticket($job_id);
            $job_data['files'] = accident_get_job_files($job_id);
            return $job_data;
        } else return false;  
    } else return false;
}

/**
 * accident_get_job_files()
 * 
 *      Returns data on the Files associated with a Job
 * 
 * @param integer $job_id
 * @return
 */
function accident_get_job_files($job_id=0){
    global $wpdb;
    if($job_id != 0){
        $files = array();
        $ticket_id = accident_get_job_ticket_id($job_id);
        if($ticket_id !== false && $ticket_id != ''){
            $find_s = 'SELECT * FROM acx_attachments WHERE parent_id=\''.$ticket_id.'\'';
            $find_q = $wpdb->get_results($find_s,'ARRAY_A');
            if($find_q !== false && count($find_q) > 0){
                //echo 'Total Files: '+count($find_q);
                foreach($find_q as $a_file){
                    $files[] = array(
                        'id' => $a_file['id'],
                        'name' => $a_file['name'],
                        'mime' => $a_file['mime_type'],
                        'size' => $a_file['size'],
                        'location' => $a_file['location'],
                        'url' => 'https://'.$_SERVER['HTTP_HOST'].'/files/'.$a_file['location']
                    );
                }
            }
        }
        return $files;
    } else return false;
}


$job_field_cache = array();

/**
 * accident_get_job_fields()
 * 
 *      Returns an array of the Job Questions (and possible answers)
 * 
 * @return
 */
function accident_get_job_fields(){
    global $wpdb, $job_field_cache;
    if(count($job_field_cache) > 0) return $job_field_cache;
    
    $job_fields  = array();
    $field_s = 'SELECT * FROM job_questions';
    $field_q = $wpdb->get_results($field_s,'ARRAY_A');
    foreach($field_q as $a_field){
        $job_fields[''.$a_field['short_name']] = array();
        $job_fields[''.$a_field['short_name']]['question'] = $a_field['question'];
        $job_fields[''.$a_field['short_name']]['values'] = (is_array(explode(',',$a_field['question_values'])))?explode(',',$a_field['question_values']):'';
        $job_fields[''.$a_field['short_name']]['short_name'] = $a_field['short_name'];
    }
    $job_field_cache = $job_fields;
    return $job_fields;
}

/**
 * accident_update_job_details()
 * 
 *      Updates or Inserts a Job in the database.
 * 
 * @param integer $job_id
 * @param mixed $details
 * @return
 */
function accident_update_job_details($job_id=0,$details=array()){
    global $wpdb;
    $job_fields = array('ticket_id'=>array('question'=>'','short_name'=>'ticket_id'),'user_id'=>array('question'=>'','short_name'=>'user_id'));
    $new_job = false;
    $job_fields = array_merge($job_fields,accident_get_job_fields());

    if(count($details) == 0) $details = accident_populate_details_post();
    
    if($details['ticket_id'] == 0){
        $new_job = true;
        $next_id = 0;
        $next_id_s = 'SELECT integer_field_1 FROM acx_project_objects WHERE project_id=\''.$_SESSION['default_project_id'].'\' ORDER BY integer_field_1 DESC LIMIT 1';
        $next_id_q = $wpdb->get_results($next_id_s,'ARRAY_A');
        if(!$next_id_q || count($next_id_q) == 0){
            $next_id = 1;
        } else {
            $next_id = $next_id_q[0]['integer_field_1'] + 1;
        }
        
        $upd_s = '
        INSERT INTO acx_project_objects 
                (`type`,`module`,`project_id`,`parent_id`,`name`,`state`,`visibility`,`created_on`,`created_by_id`,
                    `created_by_name`,`created_by_email`,`has_time`,`integer_field_1`,`version`,`milestone_id`) 
        VALUES  (\'Ticket\',\'tickets\',\''.$_SESSION['default_project_id'].'\',\''.accident_get_category_id($details['job_type']).'\',
                    \''.accident_get_job_name(0).'\',\'3\',\'1\',\''.$details['job_date'].'\',
                    \''.$_SESSION['agent_user_id'].'\',\''.$_SESSION['agent_user_name'].'\',\''.$_SESSION['agent_user_data']['email'].'\',
                    \'0\',\''.$next_id.'\',\'1\',\'0\')';
        $upd_q = $wpdb->get_results($upd_s,'ARRAY_A');    
        
        $details['ticket_id'] = $ticket_id = $wpdb->insert_id;
        
        if(count($_SESSION['files_list']) > 0){
            foreach($_SESSION['files_list'] as $file){
                $attach_s = 'UPDATE acx_attachments SET parent_id=\''.$details['ticket_id'].'\' WHERE id=\''.$file.'\' AND created_by_id=\''.$_SESSION['agent_user_id'].'\'';
                //echo $attach_s.'<br>';
                $attach_q = $wpdb->get_results($attach_s,'ARRAY_A'); 
            }
        }
        
        $discussion_ins_s = '
        INSERT INTO acx_project_objects
                (`type`,`module`,`project_id`,`name`,`state`,`visibility`,`created_on`,`created_by_id`,
                    `created_by_name`,`created_by_email`,`has_time`,`version`,`parent_id`,`parent_type`,`body`) 
        VALUES  (\'Discussion\',\'discussions\',\''.$_SESSION['default_project_id'].'\',\''.accident_get_job_name(0).'\',\'3\',\'1\',\''.$details['job_date'].'\',
                    \''.$_SESSION['agent_user_id'].'\',\''.$_SESSION['agent_user_name'].'\',\''.$_SESSION['agent_user_data']['email'].'\',
                    \'0\',\'1\',\''.$ticket_id.'\',\'ticket\',\'discussion\')';
        
        $discussion_ins_q = $wpdb->get_results($discussion_ins_s,'ARRAY_A');
        
        $discussion_id = $wpdb->insert_id;
        
        $activity_log_s = '
        INSERT INTO acx_activity_logs
                (`type`,`object_id`,`project_id`,`created_on`,`created_by_id`,`created_by_name`,`created_by_email`)
        VALUES  (\'ObjectCreatedActivityLog\',\''.$ticket_id.'\',\''.$_SESSION['default_project_id'].'\',now(),\''.$_SESSION['agent_user_id'].'\',\''.$_SESSION['agent_user_name'].'\',\''.$_SESSION['agent_user_data']['email'].'\')';

        $activity_log_q = $wpdb->get_results($activity_log_s,'ARRAY_A');
        
        
        $subscription_s = '
        INSERT INTO acx_subscriptions
                (`user_id`,`parent_id`)
        VALUES
                (\''.$_SESSION['agent_user_id'].'\',\''.$ticket_id.'\'),
                (\''.accident_get_leader_id().'\',\''.$ticket_id.'\'),
                (\''.accident_get_leader_id().'\',\''.$discussion_id.'\')';
        
        $subscription_q = $wpdb->get_results($subscription_s,'ARRAY_A');
        
        $search_s = '
        INSERT INTO acx_search_index
                (`object_id`,`type`,`content`)
        VALUES
                (\''.$ticket_id.'\',\'ProjectObject\',\''.$details['job_name'].'\')
        ';
        
        $search_q = $wpdb->get_results($search_s,'ARRAY_A');
        
        accident_auto_assign_users($job_id);
        
    } else {
        //die('Job: '.$job_id);
        $upd_s = 'UPDATE acx_project_objects SET updated_on=NOW(), 
                updated_by_id=\''.$_SESSION['agent_user_id'].'\', 
                updated_by_name=\''.$_SESSION['agent_user_name'].'\', 
                updated_by_email=\''.$_SESSION['agent_user_data']['email'].'\' 
                WHERE id=\''.accident_get_job_ticket_id($job_id).'\'';
        //die($upd_s);
        $upd_q = $wpdb->get_results($upd_s,'ARRAY_A');    
    }
    
    if($upd_q !== false){
        
        
        if(isset($details['files']) && count($details['files']) > 0){
            $id_s = '(\''.implode('\',\'',$details['files']).'\')';
            $attach_s = 'UPDATE acx_attachments SET parent_id=\''.$details['ticket_id'].'\' WHERE id IN '.$id_s.' AND created_by_id=\''.$_SESSION['agent_user_id'].'\'';
            $attach_q = $wpdb->get_results($attach_s,'ARRAY_A');  
        }
        
        
        $existing_data = accident_get_job_details($_GET['id']);
        
        $questions = get_all_questions();
        $update_data = array();
        foreach($job_fields as $column=>$value){
            if(array_key_exists($column,$details) && $existing_data[''.$column] !== $details[''.$column]) {
                switch($column){
                    case 'job_type':
                        if($details[''.$column] != '') $update_data[] = $job_fields[''.$column];
                        break;
                    default:
                        $update_data[] = $job_fields[''.$column];
                        break;
                }
            }
        }
        
        $update_strings = array();
        foreach($update_data as $a_job_field){
            if(array_key_exists($a_job_field['short_name'],$details))
            $update_strings[] = ' `'.$a_job_field['short_name'].'`=\''.$details[''.$a_job_field['short_name']].'\' ';
        }
        if(count($update_strings) > 0){
            $upd_job_s = 'UPDATE job SET '.implode(',',$update_strings).' WHERE id=\''.$job_id.'\'';
            $upd_job_q = $wpdb->get_results($upd_job_s,'ARRAY_A');
        }
        
        
        if($new_job) accident_email_new_job($job_id);
        else accident_email_edit_job($job_id);
                
        if($upd_job_q !== false) return true;
        else return false;
    } else {
        die($wpdb->print_error());
        return false;
    }
    return $job_id;
}

/**
 * accident_get_job_ticket_id()
 * 
 *      Returns the ticket ID assicated with the Job
 * 
 * @param integer $job_id
 * @return
 */
function accident_get_job_ticket_id($job_id=0){
    global $wpdb;
    if($job_id != 0){
        $find_s = 'SELECT ticket_id FROM ar_job WHERE id=\''.$job_id.'\'';
        //die($find_s);
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if($find_q !== false && count($find_q) > 0){
            $row = $find_q[0];
            return $row['ticket_id'];
        } else {
            return false;   
        }
    } else return false;
}

/**
 * accident_populate_details_post()
 * 
 *      Populates an array of data from the POST variable for use in saving the Job to the database
 * 
 * @param mixed $existing
 * @return
 */
function accident_populate_details_post($existing=array()){
    global $_POST;
    $value_store = $existing;
                
    $value_store['job_id'] = isset($_POST['job_id']) ? mysql_real_escape_string($_POST['job_id']) : 0;
    $value_store['ticket_id'] = isset($_POST['job_ticket_id']) ? mysql_real_escape_string($_POST['job_ticket_id']) : 0;
    $value_store['user_id'] = isset($_POST['agent_user_id']) ? mysql_real_escape_string($_POST['agent_userid']) : $_SESSION['agent_user_id'];
    $value_store['client_file_id'] = isset($_POST['client_file_id']) ? mysql_real_escape_string($_POST['client_file_id']) : '';
    $value_store['date_of_loss']     = $date_of_loss = date('Y-m-d H:i:s',strtotime(mysql_real_escape_string($_POST['date_of_loss'])));
    $value_store['date_of_recovery'] = $date_of_recovery = date('Y-m-d H:i:s',strtotime(mysql_real_escape_string($_POST['date_of_recovery'])));
    $value_store['loss_description'] = $loss_description = mysql_real_escape_string($_POST['loss_description']);
    $value_store['location_of_loss'] = $location_of_loss = mysql_real_escape_string($_POST['location_of_loss']);
    $value_store['services_requested'] = $services_requested = mysql_real_escape_string($_POST['services_requested']);
    $value_store['agree_terms'] = strlen(mysql_real_escape_string($_POST['agree_terms'])) > 0 ? 'yes' : NULL;
   
    $value_store['job_type'] = accident_translate_job_type_id($_POST['job_type']);
    $value_store['job_date'] = $job_date = date('Y-m-d H:i:s',time());
    
    $value_store['job_name'] = accident_get_job_name($value_store['job_id']);
    
    $claimant_a = array();
    $claimant_b = array();
    $claimant_c = array();
    
    $claimant_a['owner_name'] = mysql_real_escape_string($_POST['claimant_a_owner_name']);
    $claimant_a['owner_type'] = mysql_real_escape_string($_POST['claimant_a_owner_type']);
    $claimant_a['owner_type_other'] = mysql_real_escape_string($_POST['claimant_a_owner_type_other']);
    $claimant_a['year'] = mysql_real_escape_string($_POST['claimant_a_year']);
    $claimant_a['make'] = mysql_real_escape_string($_POST['claimant_a_make']);
    $claimant_a['model'] = mysql_real_escape_string($_POST['claimant_a_model']);
    $claimant_a['color'] = mysql_real_escape_string($_POST['claimant_a_color']);
    $claimant_a['vin'] = mysql_real_escape_string($_POST['claimant_a_vin']);
    $claimant_a['plate'] = mysql_real_escape_string($_POST['claimant_a_plate']);
    $claimant_a['aftermarket'] = mysql_real_escape_string($_POST['claimant_a_aftermarket']);
    $claimant_a['additional'] = mysql_real_escape_string($_POST['claimant_a_additional']);
    $claimant_a['keys_available'] = mysql_real_escape_string($_POST['claimant_a_keys_available']);
    $claimant_a['where_keys'] = mysql_real_escape_string($_POST['claimant_a_where_keys']);
    
    foreach($claimant_a as $key=>$value){
        $value_store['claimant_a_'.$key] = $value;
    }
    
    $claimant_b['owner_name'] = mysql_real_escape_string($_POST['claimant_b_owner_name']);
    $claimant_b['owner_type'] = mysql_real_escape_string($_POST['claimant_b_owner_type']);
    $claimant_b['owner_type_other'] = mysql_real_escape_string($_POST['claimant_b_owner_type_other']);
    $claimant_b['year'] = mysql_real_escape_string($_POST['claimant_b_year']);
    $claimant_b['make'] = mysql_real_escape_string($_POST['claimant_b_make']);
    $claimant_b['model'] = mysql_real_escape_string($_POST['claimant_b_model']);
    $claimant_b['color'] = mysql_real_escape_string($_POST['claimant_b_color']);
    $claimant_b['vin'] = mysql_real_escape_string($_POST['claimant_b_vin']);
    $claimant_b['plate'] = mysql_real_escape_string($_POST['claimant_b_plate']);
    $claimant_b['aftermarket'] = mysql_real_escape_string($_POST['claimant_b_aftermarket']);
    $claimant_b['additional'] = mysql_real_escape_string($_POST['claimant_b_additional']);
    $claimant_a['keys_available'] = mysql_real_escape_string($_POST['claimant_b_keys_available']);
    $claimant_a['where_keys'] = mysql_real_escape_string($_POST['claimant_b_where_keys']);
    
    foreach($claimant_b as $key=>$value){
        $value_store['claimant_b_'.$key] = $value;
    }
    
    $claimant_c['owner_name'] = mysql_real_escape_string($_POST['claimant_c_owner_name']);
    $claimant_c['owner_type'] = mysql_real_escape_string($_POST['claimant_c_owner_type']);
    $claimant_c['owner_type_other'] = mysql_real_escape_string($_POST['claimant_c_owner_type_other']);
    $claimant_c['year'] = mysql_real_escape_string($_POST['claimant_c_year']);
    $claimant_c['make'] = mysql_real_escape_string($_POST['claimant_c_make']);
    $claimant_c['model'] = mysql_real_escape_string($_POST['claimant_c_model']);
    $claimant_c['color'] = mysql_real_escape_string($_POST['claimant_c_color']);
    $claimant_c['vin'] = mysql_real_escape_string($_POST['claimant_c_vin']);
    $claimant_c['plate'] = mysql_real_escape_string($_POST['claimant_c_plate']);
    $claimant_c['aftermarket'] = mysql_real_escape_string($_POST['claimant_c_aftermarket']);
    $claimant_c['additional'] = mysql_real_escape_string($_POST['claimant_c_additional']);
    $claimant_a['keys_available'] = mysql_real_escape_string($_POST['claimant_c_keys_available']);
    $claimant_a['where_keys'] = mysql_real_escape_string($_POST['claimant_c_where_keys']);
    
    foreach($claimant_c as $key=>$value){
        $value_store['claimant_c_'.$key] = $value;
    }
    
    $value_store['vehicle_theft_security_system'] = $vehicle_theft_security_system = mysql_real_escape_string($_POST['vehicle_theft_security_system']);
    $value_store['vehicle_theft_security_system_after'] = $vehicle_theft_security_system_after = mysql_real_escape_string($_POST['vehicle_theft_security_system_after']);
    $value_store['vehicle_theft_remote'] = $vehicle_theft_remote = mysql_real_escape_string($_POST['vehicle_theft_remote']);
    $value_store['vehicle_theft_remote_after'] = $vehicle_theft_remote_after = mysql_real_escape_string($_POST['vehicle_theft_remote_after']);
    
    if(isset($_POST['uploaded_files'])){
        $value_store['files'] = $_POST['uploaded_files'];
    }   
    
    return $value_store;            
}

/**
 * accident_process_agent_request_form()
 * 
 *      Main Processing Function for the Job Form
 * 
 * @param integer $job_id
 * @return
 */
function accident_process_agent_request_form($job_id=0){
    if($job_id == 0 && isset($_POST['job_id'])) $job_id = $_POST['job_id'];
    $job_update_status = accident_update_job_details($job_id);
    //if($job_id == 0) $job_id = $job_update_status;
    //$job_file_status = accident_save_job_files($job_id);
    return true;
}


/**
 * get_all_questions()
 * 
 * @return
 */
function get_all_questions(){
	global $wpdb;
	$questions = array();
	$find_s = 'SELECT * FROM job_questions';
	$find_q = $wpdb->get_results($find_s,'ARRAY_A');
	if($find_q !== false && count($find_q) > 0){
		foreach($find_q as $a_question) $questions[''.$a_question['short_name']] = $a_question;
	}
	return $questions;
}

function accident_hash_password($password){
    $AC_LICENSE = 'wMhitCnAtu8d3DBmSmK8A0kck3QpvJLZ42v9iy2z';
    return sha1($AC_LICENSE . $password);
    
}

function accident_create_comment($job_id=0,$comment_body=''){
    global $wpdb;
    if($job_id != 0){
        $comment_fields = array(
            'type'=>'Comment',
            'module'=>'resources',
            'project_id'=>$_SESSION['default_project_id'],
            'parent_id'=>accident_get_job_ticket_id($job_id),
            'parent_type'=>'Ticket',
            //'body'=>$wpdb->escapeString($comment_body),
            'body'=>$comment_body,
            'state'=>'3',
            'visibility'=>'1',
            'created_on'=>date('Y-m-d H:i:s',time()),
            'created_by_id'=>$_SESSION['agent_user_id'],
            'created_by_name'=>$_SESSION['agent_user_name'],
            'created_by_email'=>$_SESSION['agent_user_data']['email'],
            'has_time'=>'0',
            'version'=>'1',
        );
        //echo print_r($comment_fields,true);
        $fields = $values = array();
        foreach($comment_fields as $a_field=>$a_value){ $fields[] = $a_field; $values[] = $a_value; }
        
        $ins_s = 'INSERT INTO acx_project_objects (`'.implode('`,`',$fields).'`) VALUES (\''.implode('\',\'',$values).'\')';
        $ins_q = $wpdb->get_results($ins_s,'ARRAY_A');
        if($ins_q !== false){
            $comment_id = $wpdb->insert_id;
            $activity_log_s = '
            INSERT INTO acx_activity_logs
                    (`type`,`object_id`,`project_id`,`created_on`,`created_by_id`,`created_by_name`,`created_by_email`)
            VALUES  (\'NewCommentActivityLog\',\''.$ticket_id.'\',\''.$_SESSION['default_project_id'].'\',now(),\''.$_SESSION['agent_user_id'].'\',\''.$_SESSION['agent_user_name'].'\',\''.$_SESSION['agent_user_data']['email'].'\')';
    
            $activity_log_q = $wpdb->get_results($activity_log_s,'ARRAY_A');
            
            accident_email_add_comment($job_id,$comment_id);
            
            return true;
        } else return false;
    } else return false;
}

function accident_get_company_project($company_id=0){
    global $wpdb;
    if($company_id != 0){
        $project_s = 'SELECT id FROM acx_projects WHERE company_id=\''.$company_id.'\'';
        $project_q = $wpdb->get_results($project_s,'ARRAY_A');
        if($project_q && count($project_q) > 0){
            return $project_q[0]['id'];
        }
    } else return false;
}

function accident_get_job_name($job_id=0){
    global $wpdb;
    $name = '';
    if($job_id != '0'){
        $find_s = 'SELECT * FROM job WHERE id=\''.$job_id.'\'';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if($find_q && count($find_q) > 0){
            $name = $find_q[0]['client_file_id'].' -- '.$_SESSION['agent_user_data']['last_name'].' -- '.date('Y-m-d',strtotime($find_q[0]['date_of_loss'])).' -- '.$find_q[0]['job_type'].' -- '.$job_id.'';
        } else $name = '';
    } else {
        if(isset($_POST['job_type']) && isset($_POST['date_of_loss']) && isset($_POST['client_file_id']) && isset($_POST['job_id'])){
            $name = $_POST['client_file_id'].' -- '.$_SESSION['agent_user_data']['last_name'].' -- '.date('Y-m-d',strtotime($_POST['date_of_loss'])).' -- '.accident_translate_job_type_id($_POST['job_type']).' -- '.$_POST['job_id'];
        }
    }
    return $name;
}

function accident_get_owner_company_name(){
    global $wpdb;
    $find_s = 'SELECT name FROM acx_companies WHERE is_owner=1';
    $find_q = $wpdb->get_results($find_s,'ARRAY_A');
    if($find_q && count($find_q) > 0){
        return $find_q[0]['name'];
    } else return '';
}

function accident_get_next_job_id(){
    global $wpdb;
    $find_s = 'SELECT id FROM job ORDER BY id DESC LIMIT 1';
    $find_q = $wpdb->get_results($find_s,'ARRAY_A');
    if($find_q !== false && count($find_q) > 0){
        $last_id = $find_q[0]['id'];
        return $last_id + 1;
    } else return 1;
}

function accident_auto_assign_users($job_id){
    global $wpdb;
    $find_s = 'SELECT id,auto_assign,auto_assign_role_id FROM acx_users WHERE auto_assign=\'1\'';
    $find_q = $wpdb->get_results($find_s,'ARRAY_A');
    if($find_q !== false && count($find_q) > 0){
        $ticket_id = accident_get_job_ticket_id($job_id);
        foreach($find_q as $a_user){
            if( ! accident_check_user_job_subscription($job_id,$a_user['id']) ){
                accident_add_user_job_subscription($job_id,$a_user['id']);
            }
        }
    }
}

function accident_get_leader_id($project_id=0){
    global $wpdb;
    if($project_id == 0) $project_id = $_SESSION['default_project_id'];
    $find_s = 'SELECT leader_id FROM acx_projects WHERE id=\''.$project_id.'\'';
    $find_q = $wpdb->get_results($find_s,'ARRAY_A');
    if($find_q !== false && count($find_q) > 0){
        return $find_q[0]['leader_id'];
    }
}

function accident_get_category_id($job_type_string,$project_id=0){
    global $wpdb;
    if($project_id == 0) $project_id = $_SESSION['default_project_id'];
    $find_s = 'SELECT id FROM acx_project_objects WHERE name=\''.$job_type_string.'\' AND project_id=\''.$project_id.'\' AND type=\'Category\' AND module=\'tickets\'';
    $find_q = $wpdb->get_results($find_s,'ARRAY_A');
    if($find_q !== false){
        return $find_q[0]['id'];
    } else return null;
}


function accident_translate_job_type_id($type_id){
    $job_type_name = '';
    switch($type_id){
        case "1": $job_type_name = 'Vehicle Theft Analysis'; break;
        case "2": $job_type_name = 'Accident Reconstruction'; break;
        case "3": $job_type_name = 'Fire Analysis'; break;
        case "4": $job_type_name = 'Mechanical Analysis'; break;
        case "5": $job_type_name = 'Physical Damage Comparison'; break;
        case "6": $job_type_name = 'Report Review'; break;
        case "7": $job_type_name = 'Other'; break;
    }
    return $job_type_name;
}

function accident_translate_id_job_type($job_type_name){
    switch($job_type_name){
        case 'Vehicle Theft Analysis': return "1"; break;
        case 'Accident Reconstruction': return "2"; break;
        case 'Fire Analysis': return "3"; break;
        case 'Mechanical Analysis': return "4"; break;
        case 'Physical Damage Comparison': return "5"; break;
        case 'Report Review': return "6"; break;
        case 'Other': return "7"; break;
    }
    return false;
}

function print_job_details_table($job_id=0,$with_files=true,$with_comments=true,$with_comments_form=true,$to_email=false){
    if($job_id == 0) return '';
    
    $job = accident_get_job_details($job_id);
    if($with_files) $files = accident_get_job_files($job_id);
    if($with_comments) $comments = accident_get_job_comments($job_id);
    $questions = get_all_questions();

    $ticketid = $job['ticket_id'];
    $ticketstatus = accident_translate_job_state($ticketid);
    ini_set(arg_separator.input, '&,');
    if($ticketstatus == 'Complete'){
        $edit_button = '<a class="edit-assignments button" href="/reps/assignments/pdf/?id='.$job_id.'&amp;report=print">Create Report »</a>';
    } else {
        $edit_button = '<a class="edit-assignments button" href="/reps/assignments/edit/?id='.$job_id.'">Edit Assignment »</a>';
    }

            $basepath = 'http';
            if ($_SERVER["HTTPS"] == "on") {$basepath .= "s"; }
            $basepath .= "://";
            $basepath .= $_SERVER["SERVER_NAME"].'/';

            $is_theft == false;


    switch($job['job_type']){
        case 'Vehicle Theft Analysis':
            $job_header = '<img src="'.$basepath.'wp-content/themes/accident-review/images/pdfcat/theft.png">';
            $is_theft = true;
            break;
        case 'Accident Reconstruction':
            $job_header = '<img src="'.$basepath.'wp-content/themes/accident-review/images/pdfcat/recon.png">';
            break;
        case 'Fire Analysis':
            $job_header = '<img src="'.$basepath.'wp-content/themes/accident-review/images/pdfcat/fire.png">';
            break;
        case 'Mechanical Analysis':
            $job_header = '<img src="'.$basepath.'wp-content/themes/accident-review/images/pdfcat/mech.png">';
            break;
        case 'Physical Damage Comparison':
            $job_header = '<img src="'.$basepath.'wp-content/themes/accident-review/images/pdfcat/damage.png">';
            break;
        case 'Report Review':
            $job_header = '<img src="'.$basepath.'wp-content/themes/accident-review/images/pdfcat/report.png">';
            break;
        default:
            $job_header = '<img src="'.$basepath.'wp-content/themes/accident-review/images/pdfcat/other.png">';
            break;
    }

    $car_b = $car_c = $multi = false;

    if($job['claimant_b_year'] != '' && $job['claimant_b_make'] != '' && $job['claimant_b_model'] != '' && intval($job['claimant_b_year']) > 0){
        $car_b = true;
        $multi = true;
    }
    if($job['claimant_c_year'] != '' && $job['claimant_c_make'] != '' && $job['claimant_c_model'] != ''  && intval($job['claimant_c_year']) > 0){
        $car_c = true;
        $multi = true;
    }



    $out = '';

    if(!$to_email){
    $out .= '<div class="print-only">
        <div class="print-logo"><img alt="Accident Review Logo" src="'.$basepath.'wp-content/themes/accident-review/images/logo-pdf.png"></div>
        <table class="print-header"><tr>
        <td class="table-left"><div class="print-owner">'.$job["claimant_a_owner_name"].'</div></td>
        <td class="table-right"><div class="print-date">'.date('F d, Y').'<br>Case Review# '.$job['client_file_id'].'</div></td>
        </tr></table>
        <br class="clear"><br class="clear">
        <div class="job-header">'.$job_header.'</div>
        <table class="report-details">';


    if($multi){
        $out .= '<thead><tr><td colspan="2"><h3>First Vehicle:</h3></td></tr></thead>';
    }

    $out .= '<tbody>
        <tr><td class="label">Owner:</td><td class="job-li">'.$job["claimant_a_owner_name"].'</td></tr>
        <tr><td class="label">Vehicle:</td><td class="job-li">'.$job["claimant_a_year"].' '.$job["claimant_a_make"].' '.$job["claimant_a_model"].'</td></tr>
        <tr><td class="label">VIN:</td><td class="job-li">'.$job["claimant_a_vin"].'</td></tr>
        </tbody></table>';

    if($car_b){
            $out .= '<table class="report-details">
        <thead><tr><td colspan="2"><h3>Second Vehicle:</h3></td></tr></thead><tbody>
        <tr><td class="label">Owner:</td><td class="job-li">'.$job["claimant_b_owner_name"].'</td></tr>
        <tr><td class="label">Vehicle:</td><td class="job-li">'.$job["claimant_b_year"].' '.$job["claimant_b_make"].' '.$job["claimant_b_model"].'</td></tr>
        <tr><td class="label">VIN:</td><td class="job-li">'.$job["claimant_b_vin"].'</td></tr>
        </tbody></table>';
        }

    if($car_c){
            $out .= '<table class="report-details">
        <thead><tr><td colspan="2"><h3>Third Vehicle:</h3></td></tr></thead><tbody>
        <tr><td class="label">Owner:</td><td class="job-li">'.$job["claimant_c_owner_name"].'</td></tr>
        <tr><td class="label">Vehicle:</td><td class="job-li">'.$job["claimant_c_year"].' '.$job["claimant_c_make"].' '.$job["claimant_c_model"].'</td></tr>
        <tr><td class="label">VIN:</td><td class="job-li">'.$job["claimant_c_vin"].'</td></tr>
        </tbody></table>';
        }


        if($with_comments){
            $last_comment_key = count($comments) -1;
            $last_comment = $comments[$last_comment_key];
            $techslug = strtolower(str_replace(' ', '-', $last_comment['created_by_name']));
            $nameparts = explode(' ',$job["claimant_a_owner_name"]);
            $name = $nameparts[0];
            if($name == '' && $job["claimant_a_owner_name"] != '') $name = $job["claimant_a_owner_name"];
            if($name == '') $name = 'Client';

            $out .= '<div class="final_comment">Attention '.$name.',<br>'.$last_comment['body'].'</div><br class="clear"><div class="techsig"><a href="'.$basepath.'reps/tech-aar/'.$techslug.'">'.$last_comment['created_by_name'].'</a></div><br class="clear"><br />';
        }

        $out .= '<div class="toslink"><a href="'.$basepath.'reps/tos/">Terms of Service</a></div></div>';


    $out .=  '
            <span style="float:right;margin-top:-50px;">
                <a class="all-assignments button" href="/reps/assignments">All Assignments »</a><br />'.
                $edit_button
            .'</span>
            <h4 class="job_name_heading">'.$job['ticket']['name'].'</h4>
            <br class="clear" />
            <div class="accident_breadcrumb"  id="crumb">
                <ul>
                    <li><a href="/reps/home/">Home</a></li>
                    <li>»</li>
                    <li><a href="/reps/assignments">Manage Assignments</a></li>
                    <li>»</li>
                    <li>View Assignment Details</li>
                </ul><br class="clear" />
            </div>
            <div class="sidebar" id="navsidebar">
            <ul>
            <li><h2>Assignments</h2><br class="clear"></li>
            <li><a href="/reps/assignments">Manage Assignments »</a></li>
            </ul>
            </div>';  

            $out .= '<script type="text/javascript">
            $("#replaceme").replaceWith($("#crumb"));  
            $("#sidebar").replaceWith($("#navsidebar"));
            </script>
            <br />';
        }
        $out .='<div class="general_information one_page">
            <h5 class="section_name"><span class="section_name_span">
                <span class="section_name_span_span">General Information</span><div class="clear"></div></span></h5>
                <br class="clear" />
            <table class="view_table">

                <tbody>
                    <tr>
                        <td>'.$questions['job_type']['question'].'</td>
                        <td>'.$job['job_type'].'</td>
                    </tr>
                    <tr>
                        <td>'.$questions['date_of_loss']['question'].'</td>
                        <td>'.date('m/d/Y',strtotime($job['date_of_loss'])).'</td>
                        </tr>
                     '.((accident_translate_id_job_type($job['job_type']) != '1') ? '<!--' : '').'<tr>
                        <td>'.$questions['date_of_recovery']['question'].'</td>
                        <td>'.date('m/d/Y',strtotime($job['date_of_recovery'])).'</td>
                    </tr>
                    <tr>
                        <td>'.$questions['location_of_loss']['question'].'</td>
                        <td>'.$job['location_of_loss'].'</td>
                    </tr> '.((accident_translate_id_job_type($job['job_type']) != '1') ? '-->' : '').'
                    <tr>
                        <td>'.$questions['loss_description']['question'].'</td>
                        <td>'.$job['loss_description'].'</td>
                    </tr>
                    <tr>
                        <td>'.$questions['services_requested']['question'].'</td>
                        <td>'.$job['services_requested'].'</td>
                    </tr>
                    <tr>
                        <td>Client File ID</td>
                        <td>'.$job['client_file_id'].'</td>
                    </tr>
                </tbody>
            </table>
            </div>
            <br class="clear" /><br />
            <div class="claimant_a one_page">
                <h5 class="section_name">
                    <span class="section_name_span">
                        <span class="section_name_span_span">Vehicle Information</span>
                        <div class="clear"></div>
                    </span>
                </h5>
                <br class="clear" />
            <table class="view_table">

                    <tbody>
                        <tr>
                            <td>Owner\'s Name</td>
                            <td>'.$job['claimant_a_owner_name'].'</td>
                        </tr>
                         <tr>
                            <td>Owner Type</td>
                            <td>'.$job['claimant_a_owner_type'].'</td>
                        </tr>
                        <tr'.(( strtolower($job['claimant_a_owner_type']) == 'other')?' style="display:table-row;" ':' style="display:none;" ').'>
                            <td>Owner Type - Other</td>
                            <td>'.$job['claimant_a_owner_type_other'].'</td>
                        </tr>
                        <tr>
                            <td>Year</td>
                            <td>'.$job['claimant_a_year'].'</td>
                        </tr>
                        <tr>
                            <td>Make</td>
                            <td>'.$job['claimant_a_make'].'</td>
                        </tr>
                        <tr>
                            <td>Model</td>
                            <td>'.$job['claimant_a_model'].'</td>
                        </tr>
                        <tr>
                            <td>Color</td>
                            <td>'.$job['claimant_a_color'].'</td>
                        </tr>
                        <tr>
                            <td>VIN</td>
                            <td>'.$job['claimant_a_vin'].'</td>
                        </tr>
                        <tr>
                            <td>License Plate</td>
                            <td>'.$job['claimant_a_plate'].'</td>
                        </tr>
                        <tr>
                            <td>Aftermarket Modifications</td>
                            <td>'.$job['claimant_a_aftermarket'].'</td>
                        </tr>
                        <tr>
                            <td>Additional Information</td>
                            <td>'.$job['claimant_a_additional'].'</td>
                        </tr>';
                        if($keys_check){
                            $out .= '
                        <tr>
                            <td>Keys Available</td>
                            <td>'.$job['claimant_a_keys_available'].'</td>
                        </tr>
                        <tr>
                            <td>Key Location</td>
                            <td>'.$job['claimant_a_where_keys'].'</td>
                            </tr>';
                        }
                        $out .= '
                    </tbody>
                </table>
            </div>';
    if($job['claimant_b_year'] != '' && $job['claimant_b_make'] != '' && $job['claimant_b_model'] != ''){
        $out .= '
            <br class="clear" /><br />
            <div class="claimant_b one_page">
                <h5 class="section_name">
                    <span class="section_name_span">
                        <span class="section_name_span_span">Second Vehicle Information</span>
                        <div class="clear"></div>
                    </span>
                </h5>
                <br class="clear" />
            <table class="view_table">
                
                    <tbody>
                        <tr>
                            <td>Owner\'s Name</td>
                            <td>'.$job['claimant_b_owner_name'].'</td>
                        </tr>
                        <tr>
                            <td>Owner Type</td>
                            <td>'.$job['claimant_b_owner_type'].'</td>
                        </tr>
                        <tr'.(( strtolower($job['claimant_b_owner_type']) == 'other')?' style="display:table-row;" ':' style="display:none;" ').'>
                            <td>Owner Type - Other</td>
                            <td>'.$job['claimant_b_owner_type_other'].'</td>
                        </tr>
                        <tr>
                            <td>Year</td>
                            <td>'.$job['claimant_b_year'].'</td>
                        </tr>
                        <tr>
                            <td>Make</td>
                            <td>'.$job['claimant_b_make'].'</td>
                        </tr>
                        <tr>
                            <td>Model</td>
                            <td>'.$job['claimant_b_model'].'</td>
                        </tr>
                        <tr>
                            <td>VIN</td>
                            <td>'.$job['claimant_b_vin'].'</td>
                        </tr>
                        <tr>
                            <td>License Plate</td>
                            <td>'.$job['claimant_b_plate'].'</td>
                        </tr>
                        <tr>
                            <td>Aftermarket Modifications</td>
                            <td>'.$job['claimant_b_aftermarket'].'</td>
                        </tr>
                        <tr>
                            <td>Additional Information</td>
                            <td>'.$job['claimant_b_additional'].'</td>
                        </tr>';
                        if($keys_check){
                            $out .= '
                        <tr>
                            <td>Keys Available</td>
                            <td>'.$job['claimant_b_keys_available'].'</td>
                        </tr>
                        <tr>
                            <td>Key Location</td>
                            <td>'.$job['claimant_b_where_keys'].'</td>
                            </tr>';
                        }
                        $out .= '
                    </tbody>
                </table>
            </div>
        ';    
    }
    if($job['claimant_c_year'] != '' && $job['claimant_c_make'] != '' && $job['claimant_c_model'] != ''){
        $out .= '
            <br class="clear" /><br />
            <div class="claimant_c one_page">
                <h5 class="section_name">
                    <span class="section_name_span">
                        <span class="section_name_span_span">Third Vehicle Information</span>
                        <div class="clear"></div>
                    </span>
                </h5>
                <br class="clear" />
            <table class="view_table">
                
                    <tbody>
                        <tr>
                            <td>Owner\'s Name</td>
                            <td>'.$job['claimant_c_owner_name'].'</td>
                        </tr>
                        <tr>
                            <td>Owner Type</td>
                            <td>'.$job['claimant_c_owner_type'].'</td>
                        </tr>
                        <tr'.(( strtolower($job['claimant_c_owner_type']) == 'other')?' style="display:table-row;" ':' style="display:none;" ').'>
                            <td>Owner Type - Other</td>
                            <td>'.$job['claimant_c_owner_type_other'].'</td>
                        </tr>
                        <tr>
                            <td>Year</td>
                            <td>'.$job['claimant_c_year'].'</td>
                        </tr>
                        <tr>
                            <td>Make</td>
                            <td>'.$job['claimant_c_make'].'</td>
                        </tr>
                        <tr>
                            <td>Model</td>
                            <td>'.$job['claimant_c_model'].'</td>
                        </tr>
                        <tr>
                            <td>VIN</td>
                            <td>'.$job['claimant_c_vin'].'</td>
                        </tr>
                        <tr>
                            <td>License Plate</td>
                            <td>'.$job['claimant_c_plate'].'</td>
                        </tr>
                        <tr>
                            <td>Aftermarket Modifications</td>
                            <td>'.$job['claimant_c_aftermarket'].'</td>
                        </tr>
                        <tr>
                            <td>Additional Information</td>
                            <td>'.$job['claimant_c_additional'].'</td>
                        </tr>';
                        if($keys_check){
                            $out .= '
                        <tr>
                            <td>Keys Available</td>
                            <td>'.$job['claimant_c_keys_available'].'</td>
                        </tr>
                        <tr>
                            <td>Key Location</td>
                            <td>'.$job['claimant_c_where_keys'].'</td>
                            </tr>';
                        }
                        $out .= '
                    </tbody>
                </table>
            </div>
        ';    
    }     
    $out .= '
            <br class="clear" /><br />
            <div class="job_specific_forms">';

    if($is_theft) {
        $out .= '<div class="vehicle_theft one_page">
                    <h5 class="section_name">
                        <span class="section_name_span">
                            <span class="section_name_span_span">Vehicle Theft Analysis</span>
                            <div class="clear"></div>
                        </span>
                    </h5>
                    <br class="clear" />
                    <table class="view_table">
                        <tbody>
                            <tr>
                                <td>'.$questions['vehicle_theft_security_system']['question'].'</td>
                                <td>'.ucwords($job['vehicle_theft_security_system']).'</td>
                            </tr>
                            <tr>
                                <td>'.$questions['vehicle_theft_security_system_after']['question'].'</td>
                                <td>'.ucwords($job['vehicle_theft_security_system_after']).'</td>
                            </tr>
                            <tr>
                                <td>'.$questions['vehicle_theft_remote']['question'].'</td>
                                <td>'.ucwords($job['vehicle_theft_remote']).'</td>
                            </tr>
                            <tr>
                                <td>'.$questions['vehicle_theft_remote_after']['question'].'</td>
                                <td>'.ucwords($job['vehicle_theft_remote_after']).'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>';
            }

            if($with_files && $files){
            $out .= '
            <br class="clear" /><br />
            <div class="files">
                <h5 class="section_name">
                    <span class="section_name_span">
                        <span class="section_name_span_span">Files</span>
                        <div class="clear"></div>
                    </span>
                </h5>
                <br class="clear" />
                <table class="files_table view_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($files as $key => $value){
                        $out .= '
                        <tr>
                            <td>'.$files[$key]['name'].'</td>
                            <td>'.$files[$key]['size'].' Bytes</td>
                            <td>
                                <a href="'.$files[$key]['url'].'">Download</a> 
                            </td>
                        </tr>';
                    }
            $out .= '
                    </tbody>
                </table>
            </div>
            <br class="clear" /><br />
            <div class="files images one_page">
                <h5 class="section_name">
                    <span class="section_name_span">
                        <span class="section_name_span_span">Images</span>
                        <div class="clear"></div>
                    </span>
                </h5>
                <br class="clear" />
                <ol class="images">';
                foreach($files as $key => $value){
//                    if ($files[$key]['mime']==('images/bmp'||'images/cis-cod'||'images/gif'||'images/ief'
//                            ||'images/jpeg'||'images/pipeg'||'images/pjpeg'||'images/png'||'images/svg+xml'
//                            ||'images/tiff'||'images/x-cmu-raster'||'images/x-cmx'||'images/x-icon'
//                            ||'images/x-png'||'images/x-portable-anymap'||'images/x-portable-bitmap'
//                            ||'images/x-portable-graymap'||'images/x-portable-pixmap'||'images/x-rgb'
//                            ||'images/x-xbitmap'||'images/x-xpixmap'||'images/x-xwindowdump')){
//                        $out .= '
//                    <li>
//                        <a href='.$files[$key]['url'].'><img src="'.$files[$key]['url'].'"/></a>
//                    </li>';
//                    }
                    $images = array('jpg','gif','png','bmp','tga','tif');
                    $filename = $files[$key]['name'];
                    $extension = substr(strrchr($filename,'.'),1);
                    if(in_array($extension,$images)){
                        $out .= '
                        <li>
                            <a href='.$files[$key]['url'].'><img src="'.$files[$key]['url'].'"/></a>
                        </li>';
                    }
                }
            $out .= '
                </ol>
            </div>';
            }//if        
            
            if($with_comments){
                $out .=  '
                <br class="clear" /><br />
            <div class="comments">
                <h5 class="section_name">
                    <span class="section_name_span">
                        <span class="section_name_span_span">Comments</span>
                        <div class="clear"></div>
                    </span>
                </h5>
                <br class="clear" />';
                if($comments){
                $out .= '
                <ol class="comments" id="comments" >';
                    foreach($comments as $key => $value){
                        $comment_exp = explode('-- REPLY ABOVE THIS LINE --',$comments[$key]['body']);
                        $comment_body = $comment_exp[0];
                    $out .= '<li><table class="comment_table one_page"><thead><tr><th>
                    '.date('m/d/Y @ g:i A',strtotime($comments[$key]['created_on'])) .
                    ' '.$comments[$key]['first_name'].' '.$value['last_name'].' says:</th></tr></thead>
                    <tbody><tr><td>'.$comment_body.
                    '</td></tr></tbody></table></li>';
                    }
                    $out .= '
                </ol>';
                }else{
                    $out .= '
                <ol class=comments>
                    No Comments
                </ol>';
                }
                if($with_comments_form){
                    $out .= '
                <br class="clear" />
                <form method="post" class="add_comment">
                <div class="information textbox">
                    <label for="comment_text">Add a Comment</label>
                    <textarea class="comment_text field" placeholder="Submit a comment on this Job" rows="4" name="comment_text"></textarea></div><br/>
                    <input type="submit" name="comment_submit_image" value="Submit Comment »" class="submit-button" />
                        
                </form>
                    ';
                }
                $out .= '      
            </div>';
            }
        $out .= 
        '</div>';

        return $out;
}

function accident_main_form($job_id = 0){   
    
   // echo 'Job ID: '.$job_id;
    if($job_id == 0){
        $job_id = accident_prep_job();
    }
    if($job_id == 0 || $job_id == false) return 'BAD ID'; 
    
    if(isset($_GET['type'])){
        $type_id = 0;
        $type_name = '';
        $keys_check = false;
        /**
        1 = Vehicle Theft Analysis		vehicle-theft-analysis
        2 = Accident Reconstruction		accident-reconstruction
        3 = Fire Analysis				fire-analysis
        4 = Mechanical Analysis			mechanical-analysis
        5 = Physical Damage Comparison	physical-damage-comparison	
        6 = Report Review				report-review
        7 = Other						other
        */
        switch($_GET['type']){
            case 'vehicle-theft-analysis': $type_id = 1; $type_name = 'Vehicle Theft Analysis'; $keys_check = true; break;
            case 'accident-reconstruction': $type_id = 2; $type_name = 'Accident Reconstruction'; break;
            case 'fire-analysis': $type_id = 3; $type_name = 'Fire Analysis'; break;
            case 'mechanical-analysis': $type_id = 4; $type_name = 'Mechanical Analysis'; break;
            case 'physical-damage-comparison': $type_id = 5; $type_name = 'Physical Damage Comparison'; break;
            case 'report-review': $type_id = 6; $type_name = 'Report Review'; break;
            case 'other': $type_id = 7; $type_name = 'Other'; break;
        }
        
        
    } else {$type_id = 7; $type_name = 'Other';}
    
    $job_details = accident_get_job_details($job_id);  


    $ticketid = $job_details['ticket_id'];
    $ticketstatus = accident_translate_job_state($ticketid); 
        
    $out = "<script type='text/javascript' src='/wp-content/themes/accident-review/js/plupload.js?ver=3.2.1'></script>
            
	<script src='/wp-content/themes/accident-review/js/jquery.selectbox-0.6.1.js' type='text/javascript'></script>";  

    if(isset($job_details['job_type'])){
        switch($job_details['job_type']){
            case 'Vehicle Theft Analysis': $type_id = 1; $type_name = 'Vehicle Theft Analysis'; $keys_check = true; break;
            case 'Accident Reconstruction': $type_id = 2; $type_name = 'Accident Reconstruction'; break;
            case 'Fire Analysis': $type_id = 3; $type_name = 'Fire Analysis'; break;
            case 'Mechanical Analysis': $type_id = 4; $type_name = 'Mechanical Analysis'; break;
            case 'Physical Damage Comparison': $type_id = 5; $type_name = 'Physical Damage Comparison'; break;
            case 'Report Review': $type_id = 6; $type_name = 'Report Review'; break;
            case 'Other': $type_id = 7; $type_name = 'Other'; break;
        }
    }
    
    $out .= '<div class="accident_breadcrumb" id="crumb">
                <ul>
                    <li><a href="/reps/home/">Home</a></li>
                    <li>»</li>
                    <li><a href="/reps/assignments">Manage Assignments</a></li>
                    <li>»</li>';
    

    if(stristr($_SERVER['REQUEST_URI'],'reps/assignments/request') !== false){
        $out .= '<li><a href="/reps/home">New Assignment</a></li>
                <li>»</li>
                <li>'.$type_name.'</li>   ';
        $newAssign = true;
    } else {
        $out .= '<li>Edit Assignment</li>';
        $newAssign = false;
    }
    $out .= '     
    
                </ul></br class="clear">
            </div>
    
    <div class="sidebar" id="navsidebar">
    <ul>
    <li><h2>Assignments</h2><br class="clear"></li>
    <li><a href="/reps/assignments">Manage Assignments »</a></li>
    </ul>
    </div>';  
    $out .= '<script type="text/javascript">
    $("#replaceme").replaceWith($("#crumb"));  
    $("#sidebar").replaceWith($("#navsidebar"));
    </script>';

    if($ticketstatus == 'Complete'){
        $out .= '<span style="float:right;margin-top:-50px;">
            <a class="all-assignments button" href="/reps/assignments">All Assignments »</a>
        </span>';
        $out .= 'This job has been completed and cannot be edited.';
        return $out; 
    }
    
    if(!$newAssign){    
        $out .= '<span style="float:right;margin-top:-50px;">
            <a class="all-assignments button" href="/reps/assignments">All Assignments »</a>
        </span>';    
    }
    else{
        $out .= '          
        <div class="instructions">
            <div class="top">
                <div class="bottom">
                    <h3 class="unselectable toggler">Instructions</h3>
                    <div id="toggleable">
                        <p><strong>How to Submit</strong></p>	
                        <ol>
                            <li>Complete form and select submit at the bottom of the page</li>
                            <li>If additional information is needed you will be notified by an expert</li>
                        </ol>
                    </div>
               </div>
            </div>
            <script type="text/javascript">
                $(".toggler").click(function() {
                    $("#toggleable").toggle();
                    $(".toggler").toggleClass("toggled");
                })
            </script>
        </div>';
    }
    
    $_SESSION['job_id'] = $job_id;
    $_SESSION['files_list'] = array();
    
    $out .= '<p>AccidentReview File <strong>#'.$job_id.'</strong></p>
    <form class="accident-form" method="post" id="accident-main-form" enctype="multipart/form-data" action="">
        <input type="hidden" name="job_id" value="'.$job_id.'" />
        <input type="hidden" name="session_id" value="'.session_id().'" />
        <input type="hidden" name="job_ticket_id" value="'.$job_details['ticket_id'].'" />
        <!--<div class="manage">
            <p><strong>Upload Assignment Files</strong></p>
            <input type="file" id="accident_files" name="filedata" />
            <div id="file_upload_queue" ></div>
            <div class="upload-actions" style="display:none;">
                <a href="#" class="accident-upload-files">Upload Files</a>
                <a href="#" class="accident-upload-clear">Clear Queue</a>
            </div>
        </div>-->
        <div class="manage">
            <p><strong>Upload Assignment Files</strong></p>
            <div id="container" style="position:relative;display:inline-block;">
                <div id="filelist"></div>
                    <a id="pickfiles" class="button" href="#">Submit files »</a>
                    <a id="clearfiles" class="button" style="display:none" href="#">Clear Queue »</a>
                    <ul class="rules"><li><strong>Allowed file types:</strong></li>
                    <li>Images (jpg,gif,png,bmp,tga,tiff)</li>
                    <li>Documents (txt,doc,docx,odt,rtf,pdf)</li></ul>
                <div id="droptarget"></div>
            </div>
        </div>
        <input type="hidden" name="job_type" value="'.$type_id.'" />';
            $files = accident_get_job_files($job_id);
            if(count($files) > 0){
                $style = '';
            }else if(isset($_POST['uploaded_files'])){
                $style = '';
                $newfiles = $_POST['uploaded_files'];
            } else {
                $newfiles = $files = array();
                $style = 'style="display:none" ';
            }
       $out .= '
        <div id="filesdiv" '.$style.'>
        <p><strong>Assignment Files</strong></p>
                    <div style="width:290px;float:left;font-weight:bold;margin-top: 8px;margin-bottom: 5px;">Name</div>
                    <div style="width:60px;float:left;font-weight:bold;margin-top: 8px;margin-bottom: 5px;">Size</div>
                    <div style="width:60px;float:left;font-weight:bold;margin-top: 8px;margin-bottom: 5px;">Actions</div>
        <div class="files" >
        <table class="files_table view_table" id="filetable" >
            <tbody>';
            foreach($files as $key => $value){
                $out .= '
                <tr class="{attid:'.$files[$key]['id'].'}">
                    <td>'.$files[$key]['name'].'</td>
                    <td>'.format_bytes($files[$key]['size']).'</td>
                    <td>';
                    if(isset($files[$key]['url']) && $files[$key]['url'] != ''){
                    $out .= '<a href="'.$files[$key]['url'].'">Download</a> | 
                         <a href="#" class="remove-existing-file">Delete</a>';
                     } else {
                        $out .= 'Uploaded';
                     }
                $out .= '</td>
                </tr>';
            }
            foreach($newfiles as $key => $value){
                $out .= '
                <tr class="{attid:'.$newfiles[$key]['id'].'}">
                    <td><input type="hidden" name="uploaded_files['.$newfiles[$key]['id'].'][name]" value="'.$newfiles[$key]['name'].'" />'.$newfiles[$key]['name'].'</td>
                    <td><input type="hidden" name="uploaded_files['.$newfiles[$key]['id'].'][size]" value="'.$newfiles[$key]['size'].'" />'.format_bytes($newfiles[$key]['size']).'</td>
                    <td><input type="hidden" name="uploaded_files['.$newfiles[$key]['id'].'][id]" value="'.$newfiles[$key]['id'].'" />';
                    if(isset($newfiles[$key]['url']) && $newfiles[$key]['url'] != ''){
                    $out .= '<a href="'.$newfiles[$key]['url'].'">Download</a> | 
                         <a href="#" class="remove-existing-file">Delete</a>';
                     } else {
                        $out .= 'Uploaded';
                     }
                $out .= '</td>
                </tr>';
            }
        $out .= '
            </tbody>
        </table>
</div>
        </div>
        <br class="clear" />
        <div class="information">
            <div class="row short">
                <label for="date_of_loss">Date of Loss</label>
                <input class="field datepicker" type="text" name="date_of_loss" id="date_of_loss" placeholder="Select a Date" value="'.(($_POST)?$_POST['date_of_loss']:($job_details['date_of_loss'] != '')?date('Y-m-d',strtotime($job_details['date_of_loss'])):'').'"/>
            </div>
            <div class="row">
                <label for="client_file_id">Internal Claim ID</label>
                <input class="field" type="text" name="client_file_id" id="client_file_id" placeholder="Your Company\'s Claim ID" value="'.(($_POST)?$_POST['client_file_id']:$job_details['client_file_id']).'"/>
            </div>
            <br class="clear" />
            <div class="textbox">
                <label for="loss_description">Describe Loss in Chronological Order</label>
                <textarea id="loss_description" name="loss_description" placeholder="Describe the claim in detailed, chronological order">'.(($_POST)?$_POST['loss_description']:strip_tags($job_details['loss_description'])).'</textarea>
            </div>
            <div class="textbox">
                <label for="services_requested">Services Requested</label>
                <textarea id="services_requested" name="services_requested" placeholder="Describe the services you are requesting.">'.(($_POST)?$_POST['services_requested']:strip_tags($job_details['services_requested'])).'</textarea>
            </div>

            <br class="clear" />
            <div class="form-full vehicle-info" id="vehicle_info">
                <h2>Vehicle Information</h2>
                <div class="claimant_a_form">
                    <div class="vinchoice" id="vinbuttons_a" '.(($_GET['do'] == 'edit' && (($_POST)?$_POST['claimant_a_owner_name']:$job_details['claimant_a_owner_name']) != '' )? 'style="display:none;"':'').'>
                    <table class="vinfo_table"><tbody><tr><td>
                        <a class="button vinchoice" href="#" id="vin_yes_a" name="vin_yes_a">VIN AVAILABLE »</a>
                        </td><td>
                        <a class="button vinchoice" href="#" id="vin_no_a" name="vin_no_a">VIN NOT AVAILABLE »</a>
                        </td></tr></tbody></table>
                    </div>
                    <div class="select-row vinchoice" style="display:none;">
                        <select name="input_method_a" id="input_method_a" class="input_method">
                            <option value="" '.(($_POST && $_POST['input_method_a'] == '')?'selected="selected"':'').'></option>
                            <option value="VIN" '.(($_POST && $_POST['input_method_a'] == 'VIN')?'selected="selected"':'').'>VIN</option>
                            <option value="Info" '.(($_POST && $_POST['input_method_a'] == 'Info')?'selected="selected"':'').'>Info</option>
                        </select>
                    </div>  
                     <div class="row long vininput" id="vininput_a" '.((!$_POST || $_POST['input_method_a'] == '' || $_POST['input_method_a'] == 'Info') && ($_GET['do'] != 'edit' || $job_details['claimant_a_vin'] == '')?'style="display:none;"':'').'>
                    <table class="vinfo_table"><tbody><tr><td>
                        <label for="claimant_a_vin">VIN</label>
                        <input name="claimant_a_vin" id="claimant_a_vin" type="text" value="'.(($_POST)?$_POST['claimant_a_vin']:$job_details['claimant_a_vin']).'" class="field vin_decoder" placeholder="Copy and paste full VIN"/>
                        <img src="'.get_bloginfo('stylesheet_directory').'/images/loading.gif" class="vin_progress" />
                        <img src="'.get_bloginfo('stylesheet_directory').'/images/warning_sign.gif" class="vin_error" />
                        </td><td>
<label for="vin_select_a">&nbsp;</label>
                        <a class="button vinput" href="#" id="vin_select_a" name="vin_select_a" style="margin-bottom: 0px;float:right;">SELECT »</a>
                    </td></tr></tbody></table></div>
                    <br class="clear" />
                    <div class="vininfo" id="vininfo_a" '.(((!$_POST || $_POST['input_method_a'] == '') && ( $_GET['do'] != 'edit'))?'style="display:none;"':'') .'>                    	
                        <table class="vinfo_table">
                            <tbody>
                               <tr>
                                    <td>
                                        <div class="row short">
                                            <label for="claimant_a_year">Year</label>
'.(( $_GET['do'] == 'edit' && $job_details['claimant_a_vin'] != '' )?'<input class="field yeartext_a" name="claimant_a_year" value="'.(($_POST)?$_POST['claimant_a_year']:$job_details['claimant_a_year']).'"  readonly="readonly">':'<select class="field yeartext_a" name="claimant_a_year" value="'.(($_POST)?$_POST['claimant_a_year']:$job_details['claimant_a_year']).'" placeholder="Year of the Vehicle"  >'.get_vehicle_years_options((($_POST)?$_POST['claimant_a_year']:$job_details['claimant_a_year'])).'
											</select>').'
                                    </div>
                                    </td>
                                    <td>
                                        <div class="row short">
                                            <label for="claimant_a_make">Make</label>
'.(( $_GET['do'] == 'edit' && $job_details['claimant_a_vin'] != '' )?'<input class="field maketext_a" name="claimant_a_make" value="'.(($_POST)?$_POST['claimant_a_make']:$job_details['claimant_a_make']).'" readonly="readonly">':'<select class="field maketext_a" name="claimant_a_make" value="'.(($_POST)?$_POST['claimant_a_make']:$job_details['claimant_a_make']).'" placeholder="Make of the Vehicle" >
                                            '.get_vehicle_divisions_options((($_POST)?$_POST['claimant_a_year']:$job_details['claimant_a_year']), 
                                            								(($_POST)?$_POST['claimant_a_make']:$job_details['claimant_a_make'])).'
                                            	</select>').'
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row short">
                                            <label for="claimant_a_model">Model</label>
'.(( $_GET['do'] == 'edit' && $job_details['claimant_a_vin'] != '' )?'<input class="field modeltext_a" name="claimant_a_model" value="'.(($_POST)?$_POST['claimant_a_model']:$job_details['claimant_a_model']).'" readonly="readonly">':'<select name="claimant_a_model" value="'.(($_POST)?$_POST['claimant_a_model']:$job_details['claimant_a_model']).'" class="field modeltext_a" placeholder="Model of the Vehicle"  >
                                            '.get_vehicle_models_options((($_POST)?$_POST['claimant_a_year']:$job_details['claimant_a_year']), 
                                            								(($_POST)?$_POST['claimant_a_make']:$job_details['claimant_a_make']), 
                                            								(($_POST)?$_POST['claimant_a_model']:$job_details['claimant_a_model'])).'
                                            	</select>').'
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="row long">
                                            <label for="claimant_a_owner_name">Owner\'s Name</label>
                                            <input class="field" type="text" name="claimant_a_owner_name" value="'.(($_POST)?$_POST['claimant_a_owner_name']:$job_details['claimant_a_owner_name']).'" placeholder="Owner\'s Full Name" />
                                        </div>
                                    </td>
                                    <td>
<div class="row short">
<label for="claimant_a_owner_type">Owner Type</label>
<select class="field" name="claimant_a_owner_type" onchange="showfield_a(this.options[this.selectedIndex].value)">
<option value="Claimant" '.(($_POST && $_POST['claimant_a_owner_type'] == 'Claimant')?'selected="selected"':(!$_POST && strtolower($job_details['claimant_a_owner_type']) == 'claimant')?'selected="selected"':'').'>Claimant</option>
<option value="Insured" '.(($_POST && $_POST['claimant_a_owner_type'] == 'Insured')?'selected="selected"':(!$_POST && strtolower($job_details['claimant_a_owner_type']) == 'insured')?'selected="selected"':'').'>Insured</option>
<option value="Other" '.(($_POST && $_POST['claimant_a_owner_type'] == 'Other')?'selected="selected"':(!$_POST && strtolower($job_details['claimant_a_owner_type']) == 'other')?'selected="selected"':'').'>Other</option>
</select>
</div></td></tr>
<script type="text/javascript">
function showfield_a(name){
  if(name=="Other"){
document.getElementById("divOther_a").style.display = "table-row";
  } else { 
document.getElementById("divOther_a").style.display = "none";
} }
</script>
<tr id="divOther_a" '.(( !$_POST && strtolower($job_details['claimant_a_owner_type']) == 'other')?' style="display:table-row;" ':' style="display:none;" ').'><td colspan="3"><div class="row"><br class="clear"><label for="claimant_a_owner_type_other">Enter Other Owner Type</label> <input type="text" name="claimant_a_owner_type_other" value="'
.(($_POST)?$_POST["claimant_a_owner_type_other"]:$job_details["claimant_a_owner_type_other"]).'" class="field" placeholder="Enter Other Type of Owner" /></div></td></tr>
                                <tr>
                                    <td>
                                        <div class="row short">
                                            <label for="claimant_a_color">Color</label>
                                            <input name="claimant_a_color" type="text" value="'.(($_POST)?$_POST['claimant_a_color']:$job_details['claimant_a_color']).'" class="field" placeholder="Color of the Vehicle" />
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <div class ="row long">
                                            <label for="claimant_a_plate">Plate Number</label>
                                            <input name="claimant_a_plate" type="text" value="'.(($_POST)?$_POST['claimant_a_plate']:$job_details['claimant_a_plate']).'" class="field" placeholder="License Plate Number of the Vehicle"/>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br class="clear" />
                    <div class="textbox">
                        <label for="claimant_a_aftermarket">Modifications/Aftermarket</label>
                        <textarea name="claimant_a_aftermarket" class="field" placeholder="List any Modifications">'.(($_POST)?$_POST['claimant_a_aftermarket']:strip_tags($job_details['claimant_a_aftermarket'])).'</textarea>
                    </div>
                    <br class="clear" />
                    <div class="textbox">
                        <label for="claimant_a_additional">Additional Information</label>
                        <textarea name="claimant_a_additional" class="field" placeholder="Provide any additional information that will help us analyze your request.">'.($_POST ?$_POST['claimant_a_additional']:strip_tags($job_details['claimant_a_additional'])).'</textarea>
                    </div>';
                    if($keys_check){
                        $out .= 
                        '<div class="form-single">
                        <label>Are keys available?</label>
                        <div class="buttongroup">
                            <input name="claimant_a_keys_available" id="claimant_a_keys_available_yes" type="radio" value="Yes" 
                                '.(($_POST && $_POST['claimant_a_keys_available'] == 'Yes')?'checked="checked"':(!$_POST && strip_tags(strtolower($job_details['claimant_a_keys_available'])) == 'yes')?'checked="checked"':'').'/>
                            <label for="claimant_a_keys_available_yes">Yes</label>
                                <input name="claimant_a_keys_available" id="claimant_a_keys_available_no" type="radio" value="No" 
                                '.(($_POST && $_POST['claimant_a_keys_available'] == 'No')?'checked="checked"':(!$_POST && strip_tags(strtolower($job_details['claimant_a_keys_available'])) == 'no')?'checked="checked"':'').'/>
                            <label for="claimant_a_keys_available_no">No</label>                                
                                <input name="claimant_a_keys_available" id="claimant_a_keys_available_unknown" type="radio" value="Unknown" 
                                '.(($_POST && $_POST['claimant_a_keys_available'] == 'Unknown')?'checked="checked"':(!$_POST && strip_tags(strtolower($job_details['claimant_a_keys_available'])) == 'unknown')?'checked="checked"':'').' />
                            <label for="claimant_a_keys_available_unknown">Unknown</label>
                        </div>
                    </div>
                    <div class="textbox">
                        <label for="claimant_a_where_keys">If so, where?</label>
                        <textarea name="claimant_a_where_keys" class="field" placeholder="Let us know where we can find the keys to the vehicle.">'.(($_POST)?$_POST['claimant_a_where_keys']:strip_tags($job_details['claimant_a_where_keys'])).'</textarea>
                        </div>';
                    }

                $out .= 
                '</div>   
            </div>
            <script type="text/javascript">
                //$("select").selectbox();
            </script>
        ';
        $show_secondary = false;
        $show_ternary = false;
        
        if($_POST){
            if($_POST['claimant_b_year'] != '' && $_POST['claimant_b_make'] != '' && $_POST['claimant_b_model'] != '') $show_secondary = true;
            if($_POST['claimant_c_year'] != '' && $_POST['claimant_c_make'] != '' && $_POST['claimant_c_model'] != '') $show_ternary = true;
        } else {
            if($job_details['claimant_b_year'] != '' && $job_details['claimant_b_make'] != '' && $job_details['claimant_b_model'] != '') $show_secondary = true;
            if($job_details['claimant_c_year'] != '' && $job_details['claimant_c_make'] != '' && $job_details['claimant_c_model'] != '') $show_ternary = true;
        }
        
        $out .= '
        <div class="form-full vehicle-info" id="vehicle_info_secondary" style="'.(($show_secondary)?'':'display:none;').'">
            <h2>
                Second Vehicle Information                
            </h2>
            <div class="remove_vehicle_button_container">
                <a href="#" class="remove_vehicle_button"></a>
            </div>
        <div class="information">
            <div class="claimant_b_form">
                     <div class="vinchoice" id="vinbuttons_b" '.(($_GET['do'] == 'edit' && (($_POST)?$_POST['claimant_b_owner_name']:$job_details['claimant_b_owner_name']) != '' )? 'style="display:none;"':'').'>
                    <table class="vinfo_table"><tbody><tr><td>
                        <a class="button vinchoice" href="#" id="vin_yes_b" name="vin_yes_b">VIN AVAILABLE »</a>
                        </td><td>
                        <a class="button vinchoice" href="#" id="vin_no_b" name="vin_no_b">VIN NOT AVAILABLE »</a>
                        </td></tr></tbody></table>
                    </div>
                    <div class="select-row vinchoice" style="display:none;">
                        <select name="input_method_b" id="input_method_b" class="input_method">
                            <option value="" '.(($_POST && $_POST['input_method_b'] == '')?'selected="selected"':'').'></option>
                            <option value="VIN" '.(($_POST && $_POST['input_method_b'] == 'VIN')?'selected="selected"':'').'>VIN</option>
                            <option value="Info" '.(($_POST && $_POST['input_method_b'] == 'Info')?'selected="selected"':'').'>Info</option>
                        </select>
                    </div>
                    <br class="clear" />
                    <div class="row long vininput" id="vininput_b" '.((!$_POST || $_POST['input_method_b'] == '' || $_POST['input_method_b'] == 'Info') && ($_GET['do'] != 'edit' || $job_details['claimant_b_vin'] == '')?'style="display:none;"':'').'>
                    <table class="vinfo_table"><tbody><tr><td>
                        <label for="claimant_b_vin">VIN</label>
                        <input name="claimant_b_vin" id="claimant_b_vin" type="text" value="'.(($_POST)?$_POST['claimant_b_vin']:$job_details['claimant_b_vin']).'" class="field vin_decoder" placeholder="Copy and paste full VIN"/>
                        <img src="'.get_bloginfo('stylesheet_directory').'/images/loading.gif" class="vin_progress" />
                        <img src="'.get_bloginfo('stylesheet_directory').'/images/warning_sign.gif" class="vin_error" />
                        </td><td>
<label for="vin_select_b">&nbsp;</label>
                        <a class="button vinput" href="#" id="vin_select_b" name="vin_select_b" style="margin-bottom: 0px;float:right;">SELECT »</a>
                    </td></tr></tbody></table></div>
                    <br class="clear" />
                    <div class="vininfo" id="vininfo_b" '.((!$_POST || $_POST['input_method_b'] == '' || $_POST['input_method_b'] == 'Info') && ($_GET['do'] != 'edit' || $job_details['claimant_b_vin'] == '')?'style="display:none;"':'') .'>              
                        <table class="vinfo_table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="row short">
                                            <label for="claimant_b_year">Year</label>
                                            <select class="field yeartext_b" name="claimant_b_year" value="'.(($_POST)?$_POST['claimant_b_year']:$job_details['claimant_b_year']).'" placeholder="Year of the Vehicle" >
                                            '.get_vehicle_years_options((($_POST)?$_POST['claimant_b_year']:$job_details['claimant_b_year'])).'
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row short">
                                            <label for="claimant_b_make">Make</label>
                                            <select class="field maketext_b" name="claimant_b_make" value="'.(($_POST)?$_POST['claimant_b_make']:$job_details['claimant_b_make']).'" placeholder="Make of the Vehicle" >
                                            '.get_vehicle_divisions_options((($_POST)?$_POST['claimant_b_year']:$job_details['claimant_b_year']), 
                                                                            (($_POST)?$_POST['claimant_b_make']:$job_details['claimant_b_make'])).'
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row short">
                                            <label for="claimant_b_model">Model</label>
                                            <select name="claimant_b_model" value="'.(($_POST)?$_POST['claimant_b_model']:$job_details['claimant_b_model']).'" class="field modeltext_b" placeholder="Model of the Vehicle">
                                            '.get_vehicle_models_options((($_POST)?$_POST['claimant_b_year']:$job_details['claimant_b_year']), 
                                                                            (($_POST)?$_POST['claimant_b_make']:$job_details['claimant_b_make']), 
                                                                            (($_POST)?$_POST['claimant_b_model']:$job_details['claimant_b_model'])).'
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="row long">
                                            <label for="claimant_b_owner_name">Owner\'s Name</label>
                                            <input class="field" type="text" name="claimant_b_owner_name" value="'.(($_POST)?$_POST['claimant_b_owner_name']:$job_details['claimant_b_owner_name']).'" placeholder="Owner\'s Full Name" />
                                        </div>
                                    </td>
                                    <td>
<div class="row short">
<label for="claimant_b_owner_type">Owner Type</label>
<select class="field" name="claimant_b_owner_type" onchange="showfield_b(this.options[this.selectedIndex].value)">
<option value="Claimant" '.(($_POST && $_POST['claimant_b_owner_type'] == 'Claimant')?'selected="selected"':(!$_POST && strtolower($job_details['claimant_b_owner_type']) == 'claimant')?'selected="selected"':'').'>Claimant</option>
<option value="Insured" '.(($_POST && $_POST['claimant_b_owner_type'] == 'Insured')?'selected="selected"':(!$_POST && strtolower($job_details['claimant_b_owner_type']) == 'insured')?'selected="selected"':'').'>Insured</option>
<option value="Other" '.(($_POST && $_POST['claimant_b_owner_type'] == 'Other')?'selected="selected"':(!$_POST && strtolower($job_details['claimant_b_owner_type']) == 'other')?'selected="selected"':'').'>Other</option>
</select>
</div></td></tr>
<script type="text/javascript">
function showfield_b(name){
  if(name=="Other"){
document.getElementById("divOther_b").style.display = "table-row";
  } else { 
document.getElementById("divOther_b").style.display = "none";
} }
</script>
<tr id="divOther_b" '.(( !$_POST && strtolower($job_details['claimant_b_owner_type']) == 'other')?' style="display:table-row;" ':' style="display:none;" ').'><td colspan="3"><div class="row"><br class="clear"><label for="claimant_b_owner_type_other">Enter Other Owner Type</label> <input type="text" name="claimant_b_owner_type_other" value="'
.(($_POST)?$_POST["claimant_b_owner_type_other"]:$job_details["claimant_b_owner_type_other"]).'" class="field" placeholder="Enter Other Type of Owner" /></div></td></tr>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row short">
                                            <label for="claimant_b_color">Color</label>
                                            <input name="claimant_b_color" type="text" value="'.(($_POST)?$_POST['claimant_b_color']:$job_details['claimant_b_color']).'" class="field" placeholder="Color of the Vehicle" />
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <div class ="row long">
                                            <label for="claimant_b_plate">Plate Number</label>
                                            <input name="claimant_b_plate" type="text" value="'.(($_POST)?$_POST['claimant_b_plate']:$job_details['claimant_b_plate']).'" class="field" placeholder="License Plate Number of the Vehicle"/>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br class="clear" />
                    <div class="textbox">
                        <label for="claimant_b_aftermarket">Modifications/Aftermarket</label>
                        <textarea name="claimant_b_aftermarket" class="field" placeholder="List any Modifications">'.(($_POST)?$_POST['claimant_b_aftermarket']:strip_tags($job_details['claimant_b_aftermarket'])).'</textarea>
                    </div>
                    <br class="clear" />
                    <div class="textbox">
                        <label for="claimant_b_additional">Additional Information</label>
                        <textarea name="claimant_b_additional" class="field" placeholder="Provide any additional information that will help us analyze your request.">'.($_POST ?$_POST['claimant_b_additional']:strip_tags($job_details['claimant_b_additional'])).'</textarea>
                    </div>';
                    if($keys_check){
                        $out .= 
                        '<div class="form-single">
                        <label>Are keys available?</label>
                        <div class="buttongroup">
                            <input name="claimant_b_keys_available" id="claimant_b_keys_available_yes" type="radio" value="Yes" 
                                '.(($_POST && $_POST['claimant_b_keys_available'] == 'Yes')?'checked="checked"':(!$_POST && strtolower($job_details['claimant_b_keys_available']) == 'yes')?'checked="checked"':'').'/>
                            <label for="claimant_b_keys_available_yes">Yes</label>
                                <input name="claimant_b_keys_available" id="claimant_b_keys_available_no" type="radio" value="No" 
                                '.(($_POST && $_POST['claimant_b_keys_available'] == 'No')?'checked="checked"':(!$_POST && strtolower($job_details['claimant_b_keys_available']) == 'no')?'checked="checked"':'').'/>
                            <label for="claimant_b_keys_available_no">No</label>                                
                                <input name="claimant_b_keys_available" id="claimant_b_keys_available_unknown" type="radio" value="Unknown" 
                                '.(($_POST && $_POST['claimant_b_keys_available'] == 'Unknown')?'checked="checked"':(!$_POST && strtolower($job_details['claimant_b_keys_available']) == 'unknown')?'checked="checked"':'').' />
                            <label for="claimant_b_keys_available_unknown">Unknown</label>
                        </div>
                    </div>
                    <div class="textbox">
                        <label for="claimant_b_where_keys">If so, where?</label>
                        <textarea name="claimant_b_where_keys" class="field" placeholder="Let us know where we can find the keys to the vehicle.">'.(($_POST)?$_POST['claimant_b_where_keys']:strip_tags($job_details['claimant_b_where_keys'])).'</textarea>
                    </div>';
                    }

                $out .= 
                '</div>
            </div>
        </div>
        <div class="form-full vehicle-info" id="vehicle_info_ternary" style="'.(($show_ternary)?'':'display:none;').'">
            <h2>
                Third Vehicle Information
            </h2>
                <div class="remove_vehicle_button_container">
                    <a href="#" class="remove_vehicle_button"></a>
                </div>
                       <div class="information">
                            <div class="claimant_c_form">
                    <div class="vinchoice" id="vinbuttons_c" '.(($_GET['do'] == 'edit' && (($_POST)?$_POST['claimant_c_owner_name']:$job_details['claimant_c_owner_name']) != '' )? 'style="display:none;"':'').'>
                    <table class="vinfo_table"><tbody><tr><td>
                        <a class="button vinchoice" href="#" id="vin_yes_c" name="vin_yes_c">VIN AVAILABLE »</a>
                        </td><td>
                        <a class="button vinchoice" href="#" id="vin_no_c" name="vin_no_c">VIN NOT AVAILABLE »</a>
                        </td></tr></tbody></table>
                    </div>
                   <div class="select-row vinchoice" style="display:none;">
                        <select name="input_method_c" id="input_method_c" class="input_method">
                            <option value="" '.(($_POST && $_POST['input_method_c'] == '')?'selected="selected"':'').'></option>
                            <option value="VIN" '.(($_POST && $_POST['input_method_c'] == 'VIN')?'selected="selected"':'').'>VIN</option>
                            <option value="Info" '.(($_POST && $_POST['input_method_c'] == 'Info')?'selected="selected"':'').'>Info</option>
                        </select>
                    </div>
                    <br class="clear" />
                    <div class="row long vininput" id="vininput_c" '.((!$_POST || $_POST['input_method_c'] == '' || $_POST['input_method_c'] == 'Info') && ($_GET['do'] != 'edit' || $job_details['claimant_c_vin'] == '')?'style="display:none;"':'').'>
                    <table class="vinfo_table"><tbody><tr><td>
                        <label for="claimant_c_vin">VIN</label>
                        <input name="claimant_c_vin" id="claimant_c_vin" type="text" value="'.(($_POST)?$_POST['claimant_c_vin']:$job_details['claimant_c_vin']).'" class="field vin_decoder" placeholder="Copy and paste full VIN"/>
                        <img src="'.get_bloginfo('stylesheet_directory').'/images/loading.gif" class="vin_progress" />
                        <img src="'.get_bloginfo('stylesheet_directory').'/images/warning_sign.gif" class="vin_error" />
                        </td><td>
<label for="vin_select_c">&nbsp;</label>
                        <a class="button vinput" href="#" id="vin_select_c" name="vin_select_c" style="margin-bottom: 0px;float:right;">SELECT »</a>
                    </td></tr></tbody></table></div>
                    <br class="clear" />
                    <div class="vininfo" id="vininfo_c" '.((!$_POST || $_POST['input_method_c'] == '' || $_POST['input_method_c'] == 'Info') && ($_GET['do'] != 'edit' || $job_details['claimant_c_vin'] == '')?'style="display:none;"':'') .'>                   
                        <table class="vinfo_table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="row short">
                                            <label for="claimant_c_year">Year</label>
                                            <select class="field yeartext_c" name="claimant_c_year" value="'.(($_POST)?$_POST['claimant_c_year']:$job_details['claimant_c_year']).'" placeholder="Year of the Vehicle" >
                                            '.get_vehicle_years_options((($_POST)?$_POST['claimant_c_year']:$job_details['claimant_c_year'])).'
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row short">
                                            <label for="claimant_c_make">Make</label>
                                            <select class="field maketext_c" name="claimant_c_make" value="'.(($_POST)?$_POST['claimant_c_make']:$job_details['claimant_c_make']).'" placeholder="Make of the Vehicle" >
                                            '.get_vehicle_divisions_options((($_POST)?$_POST['claimant_c_year']:$job_details['claimant_c_year']), 
                                                                            (($_POST)?$_POST['claimant_c_make']:$job_details['claimant_c_make'])).'
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="row short">
                                            <label for="claimant_c_model">Model</label>
                                            <select name="claimant_c_model" value="'.(($_POST)?$_POST['claimant_c_model']:$job_details['claimant_c_model']).'" class="field modeltext_c" placeholder="Model of the Vehicle">
                                            '.get_vehicle_models_options((($_POST)?$_POST['claimant_c_year']:$job_details['claimant_c_year']), 
                                                                            (($_POST)?$_POST['claimant_c_make']:$job_details['claimant_c_make']), 
                                                                            (($_POST)?$_POST['claimant_c_model']:$job_details['claimant_c_model'])).'
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="row long">
                                            <label for="claimant_c_owner_name">Owner\'s Name</label>
                                            <input class="field" type="text" name="claimant_c_owner_name" value="'.(($_POST)?$_POST['claimant_c_owner_name']:$job_details['claimant_c_owner_name']).'" placeholder="Owner\'s Full Name" />
                                        </div>
                                    </td>
                                    <td>
<div class="row short">
<label for="claimant_c_owner_type">Owner Type</label>
<select class="field" name="claimant_c_owner_type" onchange="showfield_c(this.options[this.selectedIndex].value)">
<option value="Claimant" '.(($_POST && $_POST['claimant_c_owner_type'] == 'Claimant')?'selected="selected"':(!$_POST && strtolower($job_details['claimant_c_owner_type']) == 'claimant')?'selected="selected"':'').'>Claimant</option>
<option value="Insured" '.(($_POST && $_POST['claimant_c_owner_type'] == 'Insured')?'selected="selected"':(!$_POST && strtolower($job_details['claimant_c_owner_type']) == 'insured')?'selected="selected"':'').'>Insured</option>
<option value="Other" '.(($_POST && $_POST['claimant_c_owner_type'] == 'Other')?'selected="selected"':(!$_POST && strtolower($job_details['claimant_c_owner_type']) == 'other')?'selected="selected"':'').'>Other</option>
</select>
</div></td></tr>
<script type="text/javascript">
function showfield_c(name){
  if(name=="Other"){
document.getElementById("divOther_c").style.display = "table-row";
  } else { 
document.getElementById("divOther_c").style.display = "none";
} }
</script>
<tr id="divOther_c" '.(( !$_POST && strtolower($job_details['claimant_c_owner_type']) == 'other')?' style="display:table-row;" ':' style="display:none;" ').'><td colspan="3"><div class="row"><br class="clear"><label for="claimant_c_owner_type_other">Enter Other Owner Type</label> <input type="text" name="claimant_c_owner_type_other" value="'
.(($_POST)?$_POST["claimant_c_owner_type_other"]:$job_details["claimant_c_owner_type_other"]).'" class="field" placeholder="Enter Other Type of Owner" /></div></td></tr>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="row short">
                                            <label for="claimant_c_color">Color</label>
                                            <input name="claimant_c_color" type="text" value="'.(($_POST)?$_POST['claimant_c_color']:$job_details['claimant_c_color']).'" class="field" placeholder="Color of the Vehicle" />
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <div class ="row long">
                                            <label for="claimant_c_plate">Plate Number</label>
                                            <input name="claimant_c_plate" type="text" value="'.(($_POST)?$_POST['claimant_c_plate']:$job_details['claimant_c_plate']).'" class="field" placeholder="License Plate Number of the Vehicle"/>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                 <br class="clear" />
                  <div class="textbox">
                        <label for="claimant_c_aftermarket">Modifications/Aftermarket</label>
                        <textarea name="claimant_c_aftermarket" class="field" placeholder="List any Modifications">'.(($_POST)?$_POST['claimant_c_aftermarket']:strip_tags($job_details['claimant_c_aftermarket'])).'</textarea>
                    </div>
                    <br class="clear" />
                    <div class="textbox">
                        <label for="claimant_c_additional">Additional Information</label>
                        <textarea name="claimant_c_additional" class="field" placeholder="Provide any additional information that will help us analyze your request.">'.($_POST ?$_POST['claimant_c_additional']:strip_tags($job_details['claimant_c_additional'])).'</textarea>
                    </div>';
                    if($keys_check){
                        $out .= 
                        '<div class="form-single">
                        <label>Are keys available?</label>
                        <div class="buttongroup">
                            <input name="claimant_c_keys_available" id="claimant_c_keys_available_yes" type="radio" value="Yes" 
                                '.(($_POST && $_POST['claimant_c_keys_available'] == 'Yes')?'checked="checked"':(!$_POST && strtolower($job_details['claimant_c_keys_available']) == 'yes')?'checked="checked"':'').'/>
                            <label for="claimant_c_keys_available_yes">Yes</label>
                                <input name="claimant_c_keys_available" id="claimant_c_keys_available_no" type="radio" value="No" 
                                '.(($_POST && $_POST['claimant_c_keys_available'] == 'No')?'checked="checked"':(!$_POST && strtolower($job_details['claimant_c_keys_available']) == 'no')?'checked="checked"':'').'/>
                            <label for="claimant_c_keys_available_no">No</label>                                
                                <input name="claimant_c_keys_available" id="claimant_c_keys_available_unknown" type="radio" value="Unknown" 
                                '.(($_POST && $_POST['claimant_c_keys_available'] == 'Unknown')?'checked="checked"':(!$_POST && strtolower($job_details['claimant_c_keys_available']) == 'unknown')?'checked="checked"':'').' />
                            <label for="claimant_c_keys_available_unknown">Unknown</label>
                        </div>
                    </div>
                    <div class="textbox">
                        <label for="claimant_c_where_keys">If so, where?</label>
                        <textarea name="claimant_c_where_keys" class="field" placeholder="Let us know where we can find the keys to the vehicle.">'.(($_POST)?$_POST['claimant_c_where_keys']:strip_tags($job_details['claimant_c_where_keys'])).'</textarea>
                    </div>';
                    }

                $out .= 
                '</div>   
            </div>
        </div>
        <div class="information">
            <div class="form-full" id="theft_fields" '.((accident_translate_id_job_type($job_details['job_type']) == '1')?'style="display:block;"':'').'>
                <h3>Additional Vehicle Theft Questions</h3>
                <div>
                    <div class="row short">
                        <label for="date_of_recovery">Date of Recovery</label>
                        <input type="text" name="date_of_recovery" id="date_of_recovery" class="datepicker field" placeholder="Select a Date" value="'.(($_POST)?$_POST['date_of_recovery']:$job_details['date_of_recovery']).'"/>
                    </div>
                    <br class="clear" />
                    <div class="textbox">
                        <label for="location_of_loss">Location of Loss</label>
                        <textarea name="location_of_loss" class="field" placeholder="Describe the location the vehicle was stolen from.">'.(($_POST)?$_POST['location_of_loss']:strip_tags($job_details['location_of_loss'])).'</textarea>
                    </div>
                    <div>
                        <label for="vehicle_theft_security-system">Is the vehicle equipped with a factory perimeter security system?</label>
                        <div class="buttongroup">
                                <input name="vehicle_theft_security_system" id="vehicle_theft_security_system_yes" type="radio" value="Yes" 
                                '.(($_POST && $_POST['vehicle_theft_security_system'] == 'Yes')?'checked="checked"':(!$_POST && strtolower($job_details['vehicle_theft_security_system']) == 'yes')?'checked="checked"':'').'/>
                            <label for="vehicle_theft_security_system_yes">Yes</label>
                                <input name="vehicle_theft_security_system" id="vehicle_theft_security_system_no" type="radio" value="No" 
                                '.(($_POST && $_POST['vehicle_theft_security_system'] == 'No')?'checked="checked"':(!$_POST && strtolower($job_details['vehicle_theft_security_system']) == 'no')?'checked="checked"':'').'/>
                            <label for="vehicle_theft_security_system_no">No</label>
                                <input name="vehicle_theft_security_system" id="vehicle_theft_security_system_optional" type="radio" value="optional" 
                                '.(($_POST && $_POST['vehicle_theft_security_system'] == 'optional')?'checked="checked"':(!$_POST && strtolower($job_details['vehicle_theft_security_system']) == 'optional')?'checked="checked"':'').'/>
                            <label for="vehicle_theft_security_system_optional">Optional</label>
                                <input name="vehicle_theft_security_system" id="vehicle_theft_security_system_unknown" type="radio" value="Unknown" 
                                '.(($_POST && $_POST['vehicle_theft_security_system'] == 'Unknown')?'checked="checked"':(!$_POST && strtolower($job_details['vehicle_theft_security_system']) == 'unknown')?'checked="checked"':'').' />
                            <label for="vehicle_theft_security_system_unknown">Unknown</label>
                        </div>
                    </div>
                    <div class="form-single">
                        <label for="vehicle_theft_security_system_after">Is the vehicle equipped with an aftermarket security system?</label>
                        <div class="buttongroup">
                                <input name="vehicle_theft_security_system_after" id="vehicle_theft_security_system_after_yes" type="radio" value="Yes" 
                                '.(($_POST && $_POST['vehicle_theft_security_system_after'] == 'Yes')?'checked="checked"':(!$_POST && $job_details['vehicle_theft_security_system_after'] == 'Yes')?'checked="checked"':'').'/>
                            <label for="vehicle_theft_security_system_after_yes">Yes</label>
                                <input name="vehicle_theft_security_system_after" id="vehicle_theft_security_system_after_no" type="radio" value="No" 
                                '.(($_POST && $_POST['vehicle_theft_security_system_after'] == 'No')?'checked="checked"':(!$_POST && $job_details['vehicle_theft_security_system_after'] == 'No')?'checked="checked"':'').'/>
                            <label for="vehicle_theft_security_system_after_no">No</label>
                                <input name="vehicle_theft_security_system_after" id="vehicle_theft_security_system_after_unknown" type="radio" value="Unknown" 
                                '.(($_POST && $_POST['vehicle_theft_security_system_after'] == 'Unknown')?'checked="checked"':(!$_POST && $job_details['vehicle_theft_security_system_after'] == 'Unknown')?'checked="checked"':'').'/>
                            <label for="vehicle_theft_security_system_after_unknown">Unknown</label>
                        </div>
                    </div>
                    <div class="form-single">
                        <label for="vehicle_theft_remote">Is the vehicle equipped with a remote start system?</label>   
                        <div class="buttongroup">
                            <input name="vehicle_theft_remote" id="vehicle_theft_remote_yes" type="radio" value="Yes" 
                                '.(($_POST && $_POST['vehicle_theft_remote'] == 'Yes')?'checked="checked"':(!$_POST && $job_details['vehicle_theft_remote'] == 'Yes')?'checked="checked"':'').'/>
                            <label for="vehicle_theft_remote_yes">Yes</label>
                                <input name="vehicle_theft_remote" id="vehicle_theft_remote_no" type="radio" value="No" 
                                '.(($_POST && $_POST['vehicle_theft_remote'] == 'No')?'checked="checked"':(!$_POST && $job_details['vehicle_theft_remote'] == 'No')?'checked="checked"':'').'/>
                            <label for="vehicle_theft_remote_no">No</label>
                                <input name="vehicle_theft_remote" id="vehicle_theft_remote_unknown" type="radio" value="Unknown" 
                                '.(($_POST && $_POST['vehicle_theft_remote'] == 'Unknown')?'checked="checked"':(!$_POST && $job_details['vehicle_theft_remote'] == 'Unknown')?'checked="checked"':'').'/>
                            <label for="vehicle_theft_remote_unknown">Unknown</label>
                        </div>
                    </div>
                    <div class="form-single">
                        <label>Is the remote start system factory or aftermarket?</label>
                        <div class="buttongroup">
                            <input type="radio" name="vehicle_theft_remote_after" id="vehicle_theft_remote_after_factory" value="factory" 
                                '.(($_POST && $_POST['vehicle_theft_remote_after'] == 'factory')?'checked="checked"':(!$_POST && $job_details['vehicle_theft_remote_after'] == 'factory')?'checked="checked"':'').'/>
                            <label for="vehicle_theft_remote_after_factory">Factory</label>
                            <input type="radio" name="vehicle_theft_remote_after" id="vehicle_theft_remote_after_market" value="aftermarket" 
                                '.(($_POST && $_POST['vehicle_theft_remote_after'] == 'aftermarket')?'checked="checked"':(!$_POST && $job_details['vehicle_theft_remote_after'] == 'aftermarket')?'checked="checked"':'').'/>
                            <label for="vehicle_theft_remote_after_market">Aftermarket</label>
                            <input type="radio" name="vehicle_theft_remote_after" id="vehicle_theft_remote_after_unknown" value="Unknown" 
                                '.(($_POST && $_POST['vehicle_theft_remote_after'] == 'Unknown')?'checked="checked"':(!$_POST && $job_details['vehicle_theft_remote_after'] == 'Unknown')?'checked="checked"':'').'/>
                            <label for="vehicle_theft_remote_after_unknown">Unknown</label>
                        </div>
                    </div>                            
                </div>
            </div>
        </div>


 <div class="add_vehicle_button_container">
                <a href="#" class="add_vehicle_button button"  style="'.(($show_ternary)?'display:none;':'').'">Add Another Vehicle »</a>
            </div>
            <br class="clear" />

        <div class="form-single" '.(($_POST && isset($_POST['agree_terms']))?'style="display:none"':(!$_POST && isset($job_details['agree_terms']))?'style="display:none"':'').'>
            <label>Before submitting, you must agree to the <a href="/reps/tos" target="_blank">Terms of Service</a></label>
                <div class="agreement">
                    <input type="checkbox" name="agree_terms" id="agree_terms" value="agree_terms" 
                        '.(($_POST && isset($_POST['agree_terms']))?'checked="checked"':(!$_POST && isset($job_details['agree_terms']))?'checked="checked"':'').'/>
                    <label for="agree_terms" class="checklabel">Agree</label>
                </div>
                <br class="clear" />
        </div>
        <input type="submit" name="submit_job" value="Submit Assignment »" class="submit-button" />
        <span class="waiting-for-files"><img alt="" src="'.get_bloginfo('stylesheet_directory').'/images/ajax-loader.gif"/>&nbsp;Please wait for your files to upload before submitting...</span>
    </div></form>
    <script type="text/javascript">
        (function($,undefined){
                        
            $(\'#theft_fields\').hide();
            
            $(function(){
                
                if( ! $.browser.msie){
                    $(\'select[name="job_type"]\').bind(\'change\',function(){
                        determine_extra_questions();    
                    });    
                    $(\'select[name="job_type"]\').trigger(\'change\');
                } else {
                    $(\'select[name="job_type"] > option\').bind(\'click\',function(){
                        determine_extra_questions();
                    });
                    $(\'select[name="job_type"] > option\').trigger(\'click\');    
                }
                
                
                
                function determine_extra_questions(){
                    $(\'#theft_fields\').hide();
                    $(\'.add_vehicle_button_container\').hide();
                    if($(\'input[name="job_type"]\').val() == 1){
                        $(\'#theft_fields\').show();
                    }
                    if($(\'input[name="job_type"]\').val() == 2 || $(\'input[name="job_type"]\').val() == 5){
                        $(\'.add_vehicle_button_container\').show();
                    }
                }
                determine_extra_questions();
                
                $(\'.add_vehicle_button\').bind(\'click\',function(event){
                    event.preventDefault();
                    if($(\'#vehicle_info_secondary:visible\').length){
                        $(\'#vehicle_info_ternary\').show();    
                        $(\'#vehicle_info_ternary\').find(\'.chosen_select\').chosen();
						$.scrollTo(\'#vehicle_info_ternary\',350);
                    } else {
                        $(\'#vehicle_info_secondary\').show();
                        $(\'#vehicle_info_secondary\').find(\'.chosen_select\').chosen();
						$.scrollTo(\'#vehicle_info_secondary\',350);
                    }
                    
                    if($(\'#vehicle_info_secondary:visible\').length && $(\'#vehicle_info_ternary:visible\').length){
                        $(this).hide();
                    }
                });
                
                $(\'.remove_vehicle_button\').bind(\'click\',function(event){
                    event.preventDefault();
                    $(this).parents(\'.vehicle-info\').hide();
                    if( ! $(\'.add_vehicle_button:visible\').length ) $(\'.add_vehicle_button\').show();
                });
                
                $(\'.remove-existing-file\').live(\'click\',function(event){
                    event.preventDefault();
                    var the_data = $(event.target).parents(\'tr:eq(0)\').metadata(),
                        attaid = the_data.attid;
                    console.log(attaid);
                    
                    
                    $(\'<div>Are you sure you want to delete this file?</div>\').dialog({
                        buttons: {
                            \'Yes\': function(){
                                
                                $(this).dialog(\'close\');
                                
                                $.ajax({
                                    url: \'/wp-admin/admin-ajax.php\',
                                    type: \'POST\',
                                    dataType: \'json\',
                                    data: {
                                        action: \'agent-file-delete\',
                                        attid: attaid
                                    },
                                    success: function(data){
                                        $(event.target).parents(\'tr:eq(0)\').fadeOut(\'fast\',function(){
                                            $(this).remove();    
                                        });
                                    }
                                });
                            },
                            \'No\': function(){
                                $(this).dialog(\'close\');
                            }    
                        }
                    });
                    
                });
                
            });
        })(jQuery);
    </script>
    ';
    
        
    return $out;
    
}

function accident_prep_job(){
    global $wpdb;
    
    /*
    $ins_s = 'INSERT INTO acx_project_objects 
        (`type`,`module`,`project_id`,`state`,`visibility`,`created_by_id`,`has_time`,`version`) 
    VALUES 
        (`ticket`,)';
    */
    
    $ins_s = 'INSERT INTO job (user_id) VALUES ('.$_SESSION['agent_user_id'].')';
    $ins_q = $wpdb->get_results($ins_s,'ARRAY_A');
    if($ins_q !== false){
        return $wpdb->insert_id;
    } else {
        return false;   
    }
}

function accident_get_job_subscriptions($job_id){
    global $wpdb;
    $users = array();
    $find_s = 'SELECT user_id FROM acx_subscriptions WHERE parent_id=\''.accident_get_job_ticket_id($job_id).'\'';
    $find_q = $wpdb->get_results($find_s,'ARRAY_A');
    if($find_q !== false && count($find_q) > 0){
        foreach($find_q as $a_user){
            $users[] = $a_user['user_id'];
        }
    }
    return $users;
}

function accident_get_user_email_address($user_id){
    global $wpdb;
    $find_s = 'SELECT email FROM acx_users WHERE id=\''.$user_id.'\'';
    $find_q = $wpdb->get_results($find_s,'ARRAY_A');
    if($find_q !== false && count($find_q) > 0){
        return $find_q[0]['email'];
    } else return '';
}

function accident_get_user_name($user_id){
    global $wpdb;
    $find_s = 'SELECT first_name,last_name FROM acx_users WHERE id=\''.$user_id.'\'';
    $find_q = $wpdb->get_results($find_s,'ARRAY_A');
    if($find_q !== false && count($find_q) > 0){
        return $find_q[0]['first_name'].' '.$find_q[0]['last_name'];
    } else return '';
}

function format_bytes($size) {
    $units = array(' B', ' KB', ' MB', ' GB', ' TB');
    for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
    return round($size, 2).$units[$i];
}

function accident_get_pdf($id,$filename) {
    require_once($_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/accident-review/lib/dompdf/dompdf_config.inc.php');

    $pageURL = $basepath = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s"; $basepath .= "s"; }
    $pageURL .= "://";
    $basepath .= "://";
    $endpath = '/reps/assignments/pdf/?id='.$id;
    if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$endpath;
    } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$endpath;
    }
    $basepath .= $_SERVER["SERVER_NAME"].'/';

    $html = get_url_contents($pageURL);

    $dompdf = new DOMPDF();
    $dompdf->set_base_path($basepath);
    $dompdf->load_html($html);

    $dompdf->render();
    $dompdf->stream($filename);

}

function get_url_contents($url)
{
        $crl = curl_init();
        $timeout = 5;
        curl_setopt ($crl, CURLOPT_URL,$url);
        curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
}
function get_vehicle_years_options($year_param)
{
	if (! $years = wp_cache_get( 1, 'vehicle_years' ))
	{
		$years = requestModelYears();
		wp_cache_add( 1, $years, 'vehicle_years' );
	}
	
	$out = '';
	foreach($years['result'] as $modelYear)
	{
		$year = (string)$modelYear;
		$out .= "<option optionvalue='".$year."' value='".$year."' ".($year_param == $year ? 'selected' : '').">".$year."</option>";
	}		
	return $out; 
}
function get_vehicle_divisions_options($year_param, $division_param)
{
	if (! $divisions = wp_cache_get( intval($year_param), 'vehicle_divisions' ))
	{
		$divisions = requestDivisions(intval($year_param));
		wp_cache_add( intval($year_param), $divisions, 'vehicle_divisions' );
	}
	
	$out = '';
	foreach($divisions['result'] as $divisionKey=>$divisionValue)
	{
		$out .= "<option optionvalue='".$divisionKey."' value='".$divisionValue."' ".($division_param == $divisionValue ? 'selected' : '').">".$divisionValue."</option>";
	}
	return $out;
}
function get_vehicle_models_options($year_param, $division_param, $model_param)
{
	if (! $divisions = wp_cache_get( intval($year_param), 'vehicle_divisions' ))
	{
		$divisions = requestDivisions(intval($year_param));
		wp_cache_add( intval($year_param), $divisions, 'vehicle_divisions' );
	}
	
	$div = 0;
	foreach ($divisions['result'] as $divisionKey=>$divisionValue)
	{
		if ($divisionValue == $division_param)
		{
			$div = $divisionKey;
			break;
		}
	}
	
	if (! $models = wp_cache_get( intval($year_param).'_'.intval($div), 'vehicle_models' ))
	{
		$models = requestModels(intval($year_param), intval($div));
		wp_cache_add( intval($year_param).'_'.intval($div), $models, 'vehicle_models' );
	}
	
	
	$out = '';
	foreach($models['result'] as $modelKey=>$modelValue)
	{
		$out .= "<option optionvalue='".$modelKey."' value='".$modelValue."' ".($model_param == $modelValue ? 'selected' : '').">".$modelValue."</option>";
	}
	return $out;
}

?>