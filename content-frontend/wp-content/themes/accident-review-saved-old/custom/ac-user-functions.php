<?php



function accident_get_company_users($company_id=0){
    global $wpdb;
    if($company_id != 0){
        $users = array();
        $find_s = 'SELECT * FROM acx_users WHERE company_id=\''.$company_id.'\' ORDER BY last_name ASC';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if($find_q !== false && count($find_q) > 0){
            foreach($find_q as $a_user) $users[] = $a_user;
        }
        return $users;
    } else return false;
}

function accident_add_company_user($company_id=0,$user_data=array()){
    global $wpdb;
    if($company_id != 0 && count($user_data) != 0){
        
        $ins_s = '
        INSERT INTO acx_users 
            (`company_id`,`role_id`,`first_name`,`last_name`,`email`,`password`,`token`,`created_on`,`auto_assign`,`auto_assign_role_id`,`auto_assign_permissions`) 
        VALUES 
            (\''.$company_id.'\', \''.AGENT_GENERAL_ROLE.'\',
            \''.$user_data['first'].'\',\''.$user_data['last'].'\',
            \''.$user_data['email'].'\',\''.accident_hash_password($user_data['password']).'\',
            \''.md5($user_data['email'].microtime()).'\',
            \''.date('Y-m-d H:i:s',time()).'\',\'0\',\''.AGENT_USER_ROLE.'\',\'N;\')';
        //echo $ins_s;
        $ins_q = $wpdb->get_results($ins_s,'ARRAY_A');
        $user_id = $wpdb->insert_id;
      
        $ins_s = '
        INSERT INTO representatives 
            (`ac_user_id`,`company_name`,`name`,`title`,`department`,`department_name`,
            `street`,`city`,`state`,`zip`,`email`,`phone`,`mobile`,`fax`) 
        VALUES 
            (\''.$user_id.'\',\''.$_SESSION['agent_company_name'].'\',
            \''.$user_data['first'].' '.$user_data['last'].'\',\'\',
            \''.$user_data['department'].'\',\''.$user_data['department_name'].'\',
            \''.$user_data['street'].'\',\''.$user_data['city'].'\',\''.$user_data['state'].'\',
            \''.$user_data['zip'].'\',\''.$user_data['email'].'\',
            \''.$user_data['phone'].'\',\''.$user_data['mobile'].'\',\''.$user_data['fax'].'\')';
        //echo $ins_s;
        $ins_q = $wpdb->get_results($ins_s,'ARRAY_A');
        
        $ins_s = 'INSERT INTO acx_project_users (`user_id`,`project_id`,`role_id`,`permissions`) VALUES (\''.$user_id.'\',\''.accident_get_company_project($company_id).'\',\''.AGENT_USER_ROLE.'\',\'N;\')';
        $ins_q = $wpdb->get_results($ins_s,'ARRAY_A');
        
        return $user_id;
    }
}

function accident_update_user($user_id=0,$user_data=array()){
    global $wpdb;
    if($user_id != 0 && count($user_data) != 0){
        // Update AC Users Table
        $upd_s = 'UPDATE acx_users SET first_name=\''.$user_data['first'].'\', last_name=\''.$user_data['last'].'\', email=\''.$user_data['email'].'\' WHERE id=\''.$user_id.'\'';
        $upd_q = $wpdb->get_results($upd_s,'ARRAY_A');
        // Update Representatives Table
        $existing_rep_data = accident_get_user_rep_details($user_id);
        if($existing_rep_data['id'] == ''){
            $ins_s = '
            INSERT INTO representatives 
                (`ac_user_id`,`company_name`,`name`,`title`,`department`,`department_name`,
                `street`,`city`,`state`,`zip`,`email`,`phone`,`mobile`,`fax`) 
            VALUES 
                (\''.$user_id.'\',\''.$_SESSION['agent_company_name'].'\',
                \''.$user_data['first'].' '.$user_data['last'].'\',\'\',
                \''.$user_data['department'].'\',\''.$user_data['department_name'].'\',
                \''.$user_data['street'].'\',\''.$user_data['city'].'\',\''.$user_data['state'].'\',
                \''.$user_data['zip'].'\',\''.$user_data['email'].'\',
                \''.$user_data['phone'].'\',\''.$user_data['mobile'].'\',\''.$user_data['fax'].'\')';
            //echo $ins_s;
            $ins_q = $wpdb->get_results($ins_s,'ARRAY_A');
            
        } else {
            $rep_s = 'UPDATE representatives 
            SET `company_name`=\''.$_SESSION['agent_company_name'].'\', `name`=\''.$user_data['first'].' '.$user_data['last'].'\',`title`=\'\',
                `department`=\''.$user_data['department'].'\',`department_name`=\''.$user_data['department_name'].'\',
                `street`=\''.$user_data['street'].'\',`city`=\''.$user_data['city'].'\',`state`=\''.$user_data['state'].'\',
                `zip`=\''.$user_data['zip'].'\',`email`=\''.$user_data['email'].'\',`phone`=\''.$user_data['phone'].'\',
                `mobile`=\''.$user_data['mobile'].'\',`fax`=\''.$user_data['fax'].'\' WHERE ac_user_id=\''.$user_id.'\'';
            //echo $rep_s;
            $rep_q = $wpdb->get_results($rep_s,'ARRAY_A');
        }
    }
}

function accident_update_user_password($user_id=0,$user_data=array()){
    global $wpdb;
    if($user_id != 0 && count($user_data) != 0){
        // Update AC Users Table
        $pas_s = 'UPDATE acx_users SET password=\''.accident_hash_password($user_data['password']).'\' WHERE id=\''.$user_id.'\'';
        $pas_q = $wpdb->get_results($pas_s,'ARRAY_A');
    }
}

function accident_get_user_details($user_id=0){
    global $wpdb;
    if($user_id != 0){
        $find_s = 'SELECT * FROM acx_users WHERE id=\''.$user_id.'\'';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if($find_q !== false && count($find_q) > 0){
            return $find_q[0];
        } 
    } else return false;
}

function accident_is_user_admin($user_id=0){
    global $wpdb;
    if($user_id != 0){
        $user_data = accident_get_user_details($user_id);
        $project_id = accident_get_company_project($user_data['company_id']); 
        $role_id = accident_get_user_project_role($project_id,$user_id);
        if($role_id == AGENT_ADMIN_ROLE) return true;
        else return false;
    } else return false;
}

function accident_get_user_project_role($project_id=0,$user_id=0){
    global $wpdb;
    if($project_id != 0 && $user_id != 0){
        $find_s = 'SELECT role_id FROM acx_project_users WHERE project_id=\''.$project_id.'\' AND user_id=\''.$user_id.'\'';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if($find_q !== false && count($find_q) > 0){
            return $find_q[0]['role_id'];
        } else return false;
    } else return false;
}

function accident_check_user_job_subscription($job_id=0,$user_id=0){
    global $wpdb;
    if($job_id != 0){
        $find_s = 'SELECT count(*) as total_sub FROM acx_subscriptions WHERE user_id=\''.$user_id.'\' AND parent_id=\''.accident_get_job_ticket_id($job_id).'\'';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if($find_q !== false && $find_q[0]['total_sub'] > 0) return true;
        else return true;
    } else return false;
}

function accident_add_user_job_subscription($job_id=0,$user_id=0){
    global $wpdb;
    if($job_id != 0 && $user_id != 0){
        $ins_s = 'INSERT INTO acx_subscriptions (`user_id`,`parent_id`) VALUES (\''.$user_id.'\',\''.accident_get_job_ticket_id($job_id).'\')';
        $ins_q = $wpdb->get_results($ins_s,'ARRAY_A');
        if($ins_q !== false && count($ins_q) > 0) return true;
        else return false;
    }
}

function accident_make_user_admin($user_id=0){
    global $wpdb;
    if($user_id != 0){
        $user_data = accident_get_user_details($user_id);
        $project_id = accident_get_company_project($user_data['company_id']); 
        $upd_s = 'UPDATE acx_project_users SET role_id=\''.AGENT_ADMIN_ROLE.'\' WHERE project_id=\''.$project_id.'\' AND user_id=\''.$user_id.'\'';
        $upd_q = $wpdb->get_results($upd_s,'ARRAY_A');
        if($upd_q !== false) return true;
        else return false;        
    } else return false;
}

function accident_make_user_normal($user_id=0){
    global $wpdb;
    if($user_id != 0){
        $user_data = accident_get_user_details($user_id);
        $project_id = accident_get_company_project($user_data['company_id']); 
        $upd_s = 'UPDATE acx_project_users SET role_id=\''.AGENT_USER_ROLE.'\' WHERE project_id=\''.$project_id.'\' AND user_id=\''.$user_id.'\'';
        $upd_q = $wpdb->get_results($upd_s,'ARRAY_A');
        if($upd_q !== false) return true;
        else return false;        
    } else return false;
}

function accident_get_user_rep_details($user_id=0){
    global $wpdb;
    $user_data = array('id'=>'', 'ac_user_id'=>'', 'company_name'=>'', 'name'=>'', 'title'=>'', 'department'=>'', 
                        'department_name'=>'', 'street'=>'', 'city'=>'', 'state'=>'', 'zip'=>'', 'email'=>'',
                        'phone'=>'', 'mobile'=>'', 'fax'=>'');
    if($user_id != 0){
        $find_s = 'SELECT * FROM representatives WHERE ac_user_id=\''.$user_id.'\'';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if($find_q !== false && count($find_q) > 0){
            $user_data = $find_q[0];
        } 
    } 
    return $user_data;
}

function accident_get_company_details($company_id=0){
    global $wpdb;
    if($company_id != 0){
        $find_s = 'SELECT * FROM acx_company_config_options WHERE company_id=\''.$company_id.'\'';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if(count($find_q) > 0){
            $output = array();
            foreach($find_q as $a_config_option){
                $name = $a_config_option['name'];
                $value = unserialize($a_config_option['value']);
                $output[''.$name] = $value;
            }
            return $output;
        } else return false;
    } else return false;
}


/**
 * accident_login_agent()
 * 
 *      Processes an Agent's Login to the system.  Uses the Active Collab users table
 * 
 * @return
 */
function accident_login_agent(){
    global $wpdb;
    
    $error = false;
    if (isset($_POST['username']) && $_POST['username'] != '') {
        $username = $_POST['username'];
    } else {
        return false;
    }

    $AC_LICENSE = 'wMhitCnAtu8d3DBmSmK8A0kck3QpvJLZ42v9iy2z';

    if (isset($_POST['password']) && $_POST['password'] != '') {
        $password = $_POST['password'];
        $hash_password = sha1($AC_LICENSE . $password);
    } else {
        return false;
    }

    if ($username != '' && $password != '') {
        $check_s = 'SELECT `id`,`email`,`first_name`,`last_name`,`company_id` FROM acx_users WHERE `email`=\'' . $username . '\' AND password=\'' . $hash_password . '\'';
        $check_q = $wpdb->get_results($check_s,'ARRAY_A');
        if(!$check_q || count($check_q) == 0){
            return false;
        }
    }

    if (!$error) {
        $_SESSION['agent_user_id'] = $check_q[0]['id'];
        $_SESSION['agent_user_name'] = $check_q[0]['first_name'].' '.$check_q[0]['last_name'];
       // $_SESSION['agent_user_data'] = array();
        $_SESSION['agent_user_company'] = $check_q[0]['company_id'];
        
        $info_s = 'SELECT * FROM acx_users WHERE id=\''.$_SESSION['agent_user_id'].'\'';
        $info_q = $wpdb->get_results($info_s,'ARRAY_A');
        if($info_q && count($info_q) > 0){
            $_SESSION['agent_user_data_found'] = $info_q;
            $_SESSION['agent_user_data'] = array_shift($info_q);
        } else {
            $_SESSION['agent_user_error'] = '1';
            $wpdb->print_error();
        }
        
        $_SESSION['agent_rep_data'] = accident_get_user_rep_details($_SESSION['agent_user_id']);
        $_SESSION['agent_company_data'] = accident_get_company_details($_SESSION['agent_user_company']);
        
        $company_s = 'SELECT name FROM acx_companies WHERE id=\''.$_SESSION['agent_user_company'].'\'';
        $company_q = $wpdb->get_results($company_s,'ARRAY_A');
        if($company_q !== false && count($company_q) > 0){
            $_SESSION['agent_company_name'] = $company_q[0]['name'];
        } else $_SESSION['agent_company_name'] = 'Unknown';
        
        $project_s = 'SELECT id FROM acx_projects WHERE company_id=\''.$_SESSION['agent_user_company'].'\'';
        $project_q = $wpdb->get_results($project_s,'ARRAY_A');
        if($project_q && count($project_q) > 0){
            $_SESSION['default_project_id'] = $project_q[0]['id'];
        }
        
        $role_s = 'SELECT role_id FROM acx_project_users WHERE user_id=\''.$_SESSION['agent_user_id'].'\'';
        $role_q = $wpdb->get_results($role_s,'ARRAY_A');
        if($role_q !== false && count($role_q) > 0){
            $role_id = $role_q[0]['role_id'];
            
            if($role_id == AGENT_ADMIN_ROLE) $_SESSION['agent_user_admin'] = 1;
            else $_SESSION['agent_user_admin'] = 0;
            
        } else {
            $_SESSION['agent_user_admin'] = 0;   
        }
        return true;
    } return false;
}

/**
 * accident_logout_agent()
 * 
 * @return
 */
function accident_logout_agent(){
    unset($_SESSION['agent_user_id']);
    unset($_SESSION['agent_user_name']);
    unset($_SESSION['agent_user_data']);
    unset($_SESSION['agent_user_company']);
    unset($_SESSION['default_project_id']);
    unset($_SESSION['agent_user_admin']);
    return true;
}


?>