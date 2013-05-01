<?php


function accident_get_email_template($name){
    global $wpdb;
    $valid_names = array(
        'billed',
        'cancel',
        'forgot_password',
        'issue',
        'new_comment',
        'new_discussion',
        'new_file',
        'new_revision',
        'new_user',
        'reminder',
        'task_assigned',
        'task_completed',
        'task_completed_with_comment',
        'task_reassigned',
        'task_reopened',
        'task_reopened',
        'task_edited',
		'new_task_confirmation',
		'new_task_admin_notification'
    );
    
    if(!in_array($name,$valid_names)) return false;
    else {
        $find_s = 'SELECT * FROM acx_email_templates WHERE name=\''.$name.'\'';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        if($find_q !== false && count($find_q) > 0){
            $return_values = array(
                'subject' => $find_q[0]['subject'],
                'body' => $find_q[0]['body'],
                'variables' => explode("\n",$find_q[0]['variables'])
            );
            return $return_values;
        } else return false;
    }
}

function accident_email_new_job($job_id){
    $email_template = accident_get_email_template('task_assigned');
    
    $job_name = accident_get_job_name($job_id);
    $body_replace = array(
        ':created_by_url' => AC_BACKEND_ADDRESS . '/public/index.php?path_info=people/'.$_SESSION['agent_user_company'].'/users/'.$_SESSION['agent_user_id'],
        ':created_by_name' => $_SESSION['agent_user_name'],
        ':object_type'=>'Job',
        ':project_name' => $_SESSION['agent_company_name'],
        ':details_body'=>print_job_details_table($job_id,true,true,false,true),
        ':owner_company_name' => accident_get_owner_company_name() 
    );
    $subject_replace = array(
        ':object_type' => 'Job',
        ':project_name' => $_SESSION['agent_company_name']
    );
    $body = $email_template['body'];
    $subject = $email_template['subject'];
    
    foreach($body_replace as $var=>$value) $body = str_replace($var,$value,$body);    
    foreach($subject_replace as $var=>$value) $subject = str_replace($var,$value,$subject);
    
    accident_send_job_message($job_id,$body,$subject);
	
	// Send the submitter a confirmation e-mail to tell them it has been received
	$email_template=accident_get_email_template('new_task_confirmation');
	$body_replace=array(
		':object_type'=>'Assignment',
		':owner_company_name'=>accident_get_owner_company_name(),
	);
	$subject_replace=array(
		':object_type'=>'Assignment',
	);
	$body = $email_template['body'];
    $subject = $email_template['subject'];
	
	foreach($body_replace as $var=>$value) $body = str_replace($var,$value,$body);    
    foreach($subject_replace as $var=>$value) $subject = str_replace($var,$value,$subject);
	
	$user_id=$_SESSION['agent_user_id'];
	$email = accident_get_user_email_address($user_id);
	$name = accident_get_user_name($user_id);
	
	accident_send_email($job_id,$body,$subject,$name,$email);
	
	// Send administrators an e-mail notifying them a new assignment has been received
	$email_template=accident_get_email_template('new_task_admin_notification');
	
	$submitter=$name;
	if(isset($_SESSION['agent_company_name']))
		$submitter=$_SESSION['agent_company_name'];
	
	$body_replace=array(
		':object_type'=>'Assignment',
		':object_url' => AC_BACKEND_ADDRESS . '/public/index.php?path_info=projects/'.$_SESSION['default_project_id'].'/tickets/'.$job_ticket_info['integer_field_1'],
		':submitter'=>$submitter,
	);
	$subject_replace=array(
		':object_type'=>'Assignment',
	);
	$body = $email_template['body'];
    $subject = $email_template['subject'];
	
	foreach($body_replace as $var=>$value) $body = str_replace($var,$value,$body);    
    foreach($subject_replace as $var=>$value) $subject = str_replace($var,$value,$subject);
	
	global $wpdb;
	$sql='select id from acx_users where role_id in ('.AGENT_ADMIN_ROLE.', '.ADMIN_ROLE.')';
	$results=$wpdb->get_results($sql,'ARRAY_A');
	
	if($results!==false)
	{
		foreach($results as $r)
		{
			$admin_id=$r['id'];
			$email = accident_get_user_email_address($admin_id);
			$name = accident_get_user_name($admin_id);
			accident_send_email($job_id,$body,$subject,$name,$email);
		}
	}
}

function accident_email_edit_job($job_id){
    //die('Into Edit Job Email');
    $email_template = accident_get_email_template('task_edited');
    $job_name = accident_get_job_name($job_id);
    $body_replace = array(
        ':created_by_url' => AC_BACKEND_ADDRESS . '/public/index.php?path_info=people/'.$_SESSION['agent_user_company'].'/users/'.$_SESSION['agent_user_id'],
        ':created_by_name' => $_SESSION['agent_user_name'],
        ':object_type'=>'Job',
        ':project_name' => $_SESSION['agent_company_name'],
        ':details_body'=>print_job_details_table($job_id,true,true,false,true),
        ':owner_company_name' => accident_get_owner_company_name()  
    );
    $subject_replace = array(
        ':object_type' => 'Job',
        ':project_name' => $_SESSION['agent_company_name']
    );
    $body = $email_template['body'];
    $subject = $email_template['subject'];
    
    foreach($body_replace as $var=>$value) $body = str_replace($var,$value,$body);    
    foreach($subject_replace as $var=>$value) $subject = str_replace($var,$value,$subject);
    
    accident_send_job_message($job_id,$body,$subject);
}

function accident_email_add_files($job_id,$attachment_ids=array()){
    global $wpdb;
    $email_template = accident_get_email_template('task_reassigned');
    $job_name = accident_get_job_name($job_id);
    foreach($attachment_ids as $an_attachment_id){
        $find_s = 'SELECT name FROM acx_attachments WHERE id=\''.$an_attachment_id.'\'';
        $find_q = $wpdb->get_results($find_s,'ARRAY_A');
        
        $body_replace = array(
            ':created_by_url' => AC_BACKEND_ADDRESS . '/public/index.php?path_info=people/'.$_SESSION['agent_user_company'].'/users/'.$_SESSION['agent_user_id'],
            ':created_by_name' => $_SESSION['agent_user_name'],
            ':details_body'=>print_job_details_table($job_id,true,true,false,true),
            ':owner_company_name' => accident_get_owner_company_name() 
        );
        $subject_replace = array(
            ':object_name' => $find_q[0]['name'],
            ':project_name' => $_SESSION['agent_company_name']
        );
        $body = $email_template['body'];
        $subject = $email_template['subject'];
        
        foreach($body_replace as $var=>$value) $body = str_replace($var,$value,$body);    
        foreach($subject_replace as $var=>$value) $subject = str_replace($var,$value,$subject);    
        
        accident_send_job_message($job_id,$body,$subject);
    }
    
}

function accident_email_add_comment($job_id,$comment_id){
    global $wpdb;
    
    $email_template = accident_get_email_template('new_comment');
    $job_name = accident_get_job_name($job_id);
    
    $job_ticket_info = accident_get_job_ticket($job_id);

    $find_s = 'SELECT body FROM acx_project_objects WHERE id=\''.$comment_id.'\'';
    $find_q = $wpdb->get_results($find_s,'ARRAY_A');
    
    $body_replace = array(
        ':created_by_url' => AC_BACKEND_ADDRESS . '/public/index.php?path_info=people/'.$_SESSION['agent_user_company'].'/users/'.$_SESSION['agent_user_id'],
        ':created_by_name' => $_SESSION['agent_user_name'],
        ':object_type'=>'Job',
        ':object_name' => $job_name,
        ':object_url' => AC_BACKEND_ADDRESS . '/public/index.php?path_info=projects/'.$_SESSION['default_project_id'].'/tickets/'.$job_ticket_info['integer_field_1'],
        ':comment_body' => $find_q[0]['body'],
        ':comment_url' => '',
        ':details_body' => '',
        ':owner_company_name' => accident_get_owner_company_name() 
    );
    $subject_replace = array(
        ':object_type' => 'Job',
        ':object_name' => $job_name,
        ':project_name' => $_SESSION['agent_company_name']
    );
    $body = $email_template['body'];
    $subject = $email_template['subject'];
    
    foreach($body_replace as $var=>$value) $body = str_replace($var,$value,$body);    
    foreach($subject_replace as $var=>$value) $subject = str_replace($var,$value,$subject);
    
    accident_send_job_message($job_id,$body,$subject);
}

function accident_send_job_message($job_id,$body,$subject){
    $recipients = accident_get_job_subscriptions($job_id);
    foreach($recipients as $a_recipient){
        if($a_recipient != $_SESSION['agent_user_id']){
            $email = accident_get_user_email_address($a_recipient);
            $name = accident_get_user_name($a_recipient);
            accident_send_email($job_id,$body,$subject,$name,$email);
        }        
    }
}

function accident_send_email($job_id,$body,$subject,$recipient_name,$recipient_email){
    require_once "Mail.php";
    require_once "Mail/mime.php";
 
    $from = "Accident Review <system@accidentreview.com>";
    $to = $recipient_name." <".$recipient_email.">";
    $subject = $subject." {ID".accident_get_job_ticket_id($job_id)."}"."\r\n\r\n";
    $body = $body;
    
    $mime = new Mail_mime("\n");
    $mime->setTXTBody(strip_tags($body));
    $mime->setHTMLBody($body);
    $body = $mime->get();
    
    $headers = $mime->headers(array('From' => $from,
      'To' => $to,
      'Subject' => $subject
      )
    ,true);
    
    
    $host = "ssl://secure.emailsrvr.com";
    $port = "465";
    $username = "system@accidentreview.com";
    $password = "9iojkl";
     
    $smtp = Mail::factory('smtp',
      array ('host' => $host,
        'port' => $port,
        'auth' => true,
        'username' => $username,
        'password' => $password,
        'isHTML' => true));
     
    $mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
      return false;
    } else {
      return true;
    }
}

?>