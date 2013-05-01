<?php

if(!function_exists('ac_email'))
{
	require_once "Mail.php";
	require_once "Mail/mime.php";
	
	function ac_email($ticket_id,$to_name,$to_email,$template_name,$subject_vars=array(),$body_vars=array())
	{
		// SMTP credentials
		$host="ssl://secure.emailsrvr.com";
		$port="465";
		$username="system@accidentreview.com";
		$password="9iojkl";
		
		// Get the templated subject and body
		$email_templates_table=TABLE_PREFIX.'email_templates';
		$email_template=db_execute_one('select subject, body from '.$email_templates_table.' where name=? limit 1',$template_name);
		$subject=$email_template['subject'];
		$body=$email_template['body'];
		
		// Replace the vars with values
		foreach($subject_vars as $var=>$value)
			$subject=str_replace($var,$value,$subject);    
    	foreach($body_vars as $var=>$value)
			$body=str_replace($var,$value,$body);
		
		// Set email properties
		$from='Accident Review <system@accidentreview.com>';
		$to=$to_name." <".$to_email.">";
		$subject=$subject.' {ID'.$ticket_id.'}'."\r\n\r\n";
		$body=$body;
		
		// Set email body
		$mime=new Mail_mime("\n");
		$mime->setTXTBody(strip_tags($body));
		$mime->setHTMLBody($body);
		$body=$mime->get();
		
		// Set email headers
		$headers=$mime->headers(array(
			'From'=>$from,
			'To'=>$to,
			'Subject'=>$subject,
		),true);
		
		// Send the email
		$smtp=Mail::factory('smtp',array(
			'host'=>$host,
			'port'=>$port,
			'auth'=>true,
			'username'=>$username,
			'password'=>$password,
			'isHTML'=>true,
		));
		$email=$smtp->send($to,$headers,$body);
		
		return PEAR::isError($mail) ? false : true;
	}
}
