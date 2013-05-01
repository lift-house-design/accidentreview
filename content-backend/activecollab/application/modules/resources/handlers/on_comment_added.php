<?php

  /**
   * Resources module handle on_comment_added event
   *
   * @package activeCollab.modules.resources
   * @subpackage helpers
   */
  
  /**
   * Handle on_comment_added event (send email notifications)
   *
   * @param Comment $comment
   * @param ProjectObject $parent
   * @return null
   */
  function resources_handle_on_comment_added(&$comment, &$parent) {      
    if(instance_of($parent, 'ProjectObject')) {
      $parent->refreshCommentsCount();
      $p_id = $parent->getProjectID();
      $t_id = $parent->getId();
      
      if($comment->send_notification) {
        $dbh = mysql_connect(DB_HOST,DB_USER,DB_PASS,true);
        mysql_select_db(DB_NAME);
        $subs = $parent->getSubscribers();
        $f_subs = array();
        $b_subs = array();
        foreach($subs as $a_sub){
            $s_id = $a_sub->getID();
            $find_s = 'SELECT role FROM acx_project_users WHERE user_id = '.$s_id.' AND project_id = '.$p_id;
            //echo $find_s.'<br />';
            $find_q = mysql_query($find_s, $dbh);
            $role = mysql_fetch_assoc($find_q);
            $role = $role['role_id'];
            //echo $role.'<br>';
            if(in_array($role, array(8,9))){
                array_push($f_subs, $s_id);
            }
            else{
                array_push($b_subs, $s_id);
            }            
        }
        //echo 'Project ID = '.$p_id.'<br>';
        //echo 'ID = '.$t_id.'<br>';
        
        $job_s = 'SELECT * FROM job WHERE ticket_id = '.$t_id;
        $job_q = mysql_query($job_s, $dbh);
        $job = mysql_fetch_assoc($job_q);
        $j_id = $job['id'];
        
        $find_s = 'SELECT * FROM acx_assignments WHERE object_id = '.$job['ticket_id'];
        $find_q = mysql_query($find_s, $dbh);
        $ticket = mysql_fetch_assoc($find_q);
        
        $find_s = 'SELECT * FROM acx_users WHERE id = '.$ticket['user_id'];
            //echo $find_s.'<br />';
        $find_q = mysql_query($find_s, $dbh);
        $assignee = mysql_fetch_assoc($find_q);
        
//        echo 'Ticket details: <pre>';
//        print_r($ticket);
//        echo '</pre><br>'.$find_s.'<br>';
        
        $find_s = 'SELECT * FROM acx_users WHERE id = '.$job['user_id'];
            //echo $find_s.'<br />';
        $find_q = mysql_query($find_s, $dbh);
        $user = mysql_fetch_assoc($find_q);
        
        $find_s = 'SELECT * FROM acx_companies WHERE id= '.$user['company_id'];
        $find_q = mysql_query($find_s, $dbh);
        $company = mysql_fetch_assoc($find_q);
                
//        echo 'Job details: <pre>';
//        print_r($job);
//        echo '</pre>';
//        echo 'User details: <pre>';
//        print_r($user);
//        echo '</pre>';
        
        
        
        
        $assignee_name = $assignee['first_name'].' '.$assignee['last_name'];
        $find_s = 'SELECT post_name FROM wp_posts WHERE post_type=\'technician-bio\' AND post_status=\'publish\' AND post_title = \''.$assignee_name.'\'';
        $find_q = mysql_query($find_s, $dbh);
//        echo 'find_s = '.$find_s.'<br>';
        $assignee_bio = mysql_fetch_assoc($find_q);
        
        
        
        //echo 'Portal URL = '.$comment->getViewUrl().'<br>';
        //echo 'Job ID = '.$j_id.'<br>';
        
        array_push($b_subs, $comment->getCreatedById());
        array_push($f_subs, $comment->getCreatedById());
        //echo 'User id = '.$comment->getCreatedById();
        
        $f_baseurl = 'http://accident-review.mhann.hollisint.com';
        $f_comment_url = $f_baseurl . '/reps/assignments/view/?id='.$j_id.'#comments';
        $f_project_url = $f_baseurl . '/reps/assignments/view/?id='.$j_id;
        $f_client_url = $f_baseurl . 'reps/assignments';
        
        $assignee_url = $f_baseurl . '/technician-bio/'.$assignee_bio['post_name'];
        
        $table = '
            <div style="border: 1px solid #e8e8e8;">
              <table style="width: 100%; border-collapse: collapse">
                <tbody><tr style="background: #e8e8e8">
                  <td style="width: 150px; padding: 5px">Job</td>
                  <td style="padding: 5px"><a href="'.$f_project_url.'">'.$job['client_file_id'].' -- '.$user['last_name'].' -- '.date('Y-m-d',strtotime($job['date_of_loss'])).' -- '.$job['job_type'].' -- '.$job['id'].'</a></td>
                </tr>
                  <tr style="background: #fff">
                      <td style="padding: 5px">Client</td>
                  <td style="padding: 5px"><a href="'.$f_client_url.'" class="project_link">'.$company['name'].'</a></td>
                    </tr>
                  <tr style="background: #e8e8e8">
                  <td style="padding: 5px">Priority</td>
                  <td style="padding: 5px">Normal</td>
                </tr>
                    <tr style="background: #fff">
                  <td style="padding: 5px">Assignees</td>
                  <td style="padding: 5px"><a href="'.$assignee_url.'">'.$assignee_name.'</a> is responsible.</td>
                </tr>
                </tbody></table>


            </div>';
        
        $f_details_body = array(
            'en_USAR.UTF-8' => $table
            );        
        
//        echo 'frontend details body =<pre>';
//        print_r($f_details_body);
//        echo '</pre><br>';
        
        //echo 'comment url = '.$f_comment_url.'<br>';
        
        
        //send to backend users:
        
        $created_by = $comment->getCreatedBy();
//        echo 'Created by = '.$created_by->getDisplayName().' <br>';
        
        $find_s = 'SELECT post_name FROM wp_posts WHERE post_type=\'technician-bio\' AND post_status=\'publish\' AND post_title = \''.$created_by->getDisplayName().'\'';
        $find_q = mysql_query($find_s, $dbh);
//        echo 'find_s = '.$find_s.'<br>';
        $bio = mysql_fetch_assoc($find_q);
        
//        echo 'bio details =<pre>';
//        print_r($bio);
//        echo '</pre><br>';
                
        $f_createdby_url = $f_baseurl . '/technician-bio/'.$bio['post_name'];
        
        $parent->sendToSubscribers('resources/new_comment', array(
          'comment_body' => $comment->getFormattedBody(),
          'comment_url' => $comment->getViewUrl(),
          'created_by_url' => $created_by->getViewUrl(),
          'created_by_name' => $created_by->getDisplayName(),
        ), $b_subs, $parent);
        
        //send to frontend users:
        
        $parent->sendToSubscribers('resources/new_comment', array(
          'details_body'        => $f_details_body,
          'project_url'        => $f_project_url,
          'object_url'        => $f_project_url,
          'comment_body' => $comment->getFormattedBody(),
          'comment_url' => $f_comment_url,
          'created_by_url' => $f_createdby_url,
          'created_by_name' => $created_by->getDisplayName(),
        ), $f_subs, $parent);
        
//        die();
        
      } // if
    } // if
  } // resources_handle_on_comment_added

?>