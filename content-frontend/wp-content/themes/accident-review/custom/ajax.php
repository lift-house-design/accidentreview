<?php

add_action('wp_ajax_nopriv_agent-file-upload', 'agent_file_upload');
add_action('wp_ajax_agent-file-upload','agent_file_upload');

add_action('wp_ajax_nopriv_agent-file-delete', 'agent_file_delete');
add_action('wp_ajax_agent-file-delete','agent_file_delete');

add_action('wp_ajax_agent-file-info','agent_file_info');
add_action('wp_ajax_nopriv_agent-file-info','agent_file_info');

add_action('wp_ajax_vehicle-vin-decode','vehicle_vin_decode');
add_action('wp_ajax_nopriv_vehicle-vin-decode','vehicle_vin_decode');

add_action('wp_ajax_vehicle-year-list','vehicle_year_list');
add_action('wp_ajax_nopriv_vehicle-year-list','vehicle_year_list');

add_action('wp_ajax_vehicle-make-list','vehicle_make_list');
add_action('wp_ajax_nopriv_vehicle-make-list','vehicle_make_list');

add_action('wp_ajax_vehicle-model-list','vehicle_model_list');
add_action('wp_ajax_nopriv_vehicle-model-list','vehicle_model_list');

// @TODO: This was added for the dev site. Leave here if everything is okay.
add_action('wp_ajax_get-assignment-panel','get_assignment_panel');
add_action('wp_ajax_nopriv_get-assignment-panel','get_assignment_panel');
add_action('wp_ajax_get-new-assignment-panel','get_new_assignment_panel');
add_action('wp_ajax_nopriv_get-new-assignment-panel','get_new_assignment_panel');
add_action('wp_ajax_get-vin-data','get_vin_data');
add_action('wp_ajax_nopriv_get-vin-data','get_vin_data');
add_action('wp_ajax_save-new-assignment','save_new_assignment');
add_action('wp_ajax_nopriv_save-new-assignment','save_new_assignment');
add_action('wp_ajax_save-attachment','save_attachment');
add_action('wp_ajax_nopriv_save-attachment','save_attachment');
add_action('wp_ajax_save-attachment-description','save_attachment_description');
add_action('wp_ajax_nopriv_save-attachment-description','save_attachment_description');
add_action('wp_ajax_delete-attachment','delete_attachment');
add_action('wp_ajax_nopriv_delete-attachment','delete_attachment');
add_action('wp_ajax_create-message','create_message');
add_action('wp_ajax_nopriv_create-message','create_message');
add_action('wp_ajax_clear-autosaves','clear_autosaves');
add_action('wp_ajax_nopriv_clear-autosaves','clear_autosaves');

/*add_action('wp_ajax_vehicle-test','vehicle_test');
add_action('wp_ajax_nopriv_vehicle-test','vehicle_test');*/

// @TODO: See previous todo
function get_assignment_panel()
{
	$assignment_data=ar_get_assignment_meta();
	$assignment_types=array_keys($assignment_data);
	
	$job_id=isset($_POST['id']) ? $_POST['id'] : 0;
	$job_data=ar_get_assignment_data($job_id);
	
	if(!empty($job_id))
	{
		$assignment_type=$job_data['type'];
		$job_questions=( empty($assignment_data[$assignment_type]['job_questions']) ? array() : $assignment_data[$assignment_type]['job_questions'] );
		$vehicle_questions=( empty($assignment_data[$assignment_type]['vehicle_questions']) ? array() : $assignment_data[$assignment_type]['vehicle_questions'] );
		$claimant_questions=( empty($assignment_data[$assignment_type]['claimant_questions']) ? array() : $assignment_data[$assignment_type]['claimant_questions'] );
		
		$assignment_attachments=$job_data['attachments'];
		$correspondence=$job_data['correspondence'];
		
		require('views/new_assignment_panel.php');
	}

    exit;
}

function get_new_assignment_panel()
{
	$assignment_data=ar_get_assignment_meta();
	$assignment_types=array_keys($assignment_data);
	
	// Set variables for use in the view
	$job_id=ar_get_new_job_id();
	$assignment_type=( empty($_POST['assignment_type']) ? $assignment_types[0] : $_POST['assignment_type']);
	if(!in_array($assignment_type,$assignment_types))
	{
		$assignment_type=$assignment_types[0];
	}
	$job_questions=( empty($assignment_data[$assignment_type]['job_questions']) ? array() : $assignment_data[$assignment_type]['job_questions'] );
	$vehicle_questions=( empty($assignment_data[$assignment_type]['vehicle_questions']) ? array() : $assignment_data[$assignment_type]['vehicle_questions'] );
	$claimant_questions=( empty($assignment_data[$assignment_type]['claimant_questions']) ? array() : $assignment_data[$assignment_type]['claimant_questions'] );
	
	// Get new assignment attachments
	$assignment_attachments=ar_get_new_assignment_attachments($job_id);
	
	require('views/new_assignment_panel.php');
	exit;
}

function save_new_assignment()
{
	$response=array(
		'status'=>'error',
		'error'=>'',
	);
	
	if(empty($_POST['job']))
	{
		$response['error']='The required data was not found';
		echo json_encode($response);
		exit;
	}
	
	if(empty($_POST['job']['id']))
	{
		$response['error']='The job ID was not found';
		echo json_encode($response);
		exit;
	}
	
	$job_id=$_POST['job']['id'];
	$job_data=$_POST['job'];
	$vehicles_data=empty($_POST['vehicles']) ? array() : $_POST['vehicles'];
	$claimants_data=empty($_POST['claimants']) ? array() : $_POST['claimants'];
	
	if(($error=ar_save_new_assignment($job_id,$job_data,$vehicles_data,$claimants_data))===true)
	//if(true)
	{
		$response['status']='success';

		// Send notifications
		$is_new_assignment=empty($_POST['new_assignment']) ? FALSE : TRUE;
		$autosave=empty($_POST['autosave']) ? FALSE : TRUE;

		if($is_new_assignment===TRUE && $autosave===FALSE)
		{
			$user_data=ar_user_data();

			$rep_company_name=$user_data['company_name'];
			if(empty($rep_company_name))
				$rep_company_name=$user_data['first_name'].' '.$user_data['last_name'];

			// Notify admins
			foreach(ar_get_admin_users() as $admin)
			{
				$email_data=array(
					'file_number'=>$job_data['file_number'],
					'rep_last_name'=>$user_data['last_name'],
					'assignment_id'=>$job_id,
					'first_name'=>$admin['first_name'],
					'last_name'=>$admin['last_name'],
					'rep_company_name'=>$rep_company_name,
				);
				ar_send_email('assignment_received_admin',$email_data,$admin['email']);
			}

			// Notify client
			$email_data=array(
				'file_number'=>$job_data['file_number'],
				'rep_last_name'=>$user_data['last_name'],
				'assignment_id'=>$job_id,
				'rep_first_name'=>$user_data['first_name'],
			);
			ar_send_email('assignment_received',$email_data,$user_data['email']);
		}
	}
	else
	{
		$response['error']=$error;
	}
	
	echo json_encode($response);
	exit;
}

function get_vin_data()
{
	$response=array(
		'status'=>'error',
		'error'=>'',
	);
	
	if(!empty($_POST['vin']))
	{
		$vin=$_POST['vin'];
		if(strlen($vin)==17)
		{
			$vin_object=requestVinInfo($vin,false);
			$vin_data=array();
			convertXmlObjToArr($vin_object,$vin_data);
			
			if($vin_data[0]['@attributes']['responsecode']!='Successful')
			{
				$response['error']=trim($vehicle_info[0]['@attributes']['Description']);

				if(empty($response['error']))
					$response['error']='That VIN number was not found. Try another, or select your year, make and model below.';
			}
			else
			{
				$response['status']='success';
				$response['data']=array(
					'year'=>$vin_data[1]['@attributes']['modelyear'],
					'make'=>$vin_data[1]['@attributes']['division'],
					'model'=>$vin_data[1]['@attributes']['modelname'],
					'style'=>$vin_data[1]['@attributes']['stylename'],
				);
			}
		}
		else
		{
			$response['error']='VIN must be 17 characters.';
		}
	}
	else
	{
		$response['error']='VIN was not entered.';
	}
	
	header('Content-Type: text/json');
	echo json_encode($response);
	exit;
}

/** 
 * USED IN save_attachment()
 * Converts human readable file size (e.g. 10 MB, 200.20 GB) into bytes. 
 * 
 * @param string $str 
 * @return int the result is in bytes 
 * @author Svetoslav Marinov 
 * @author http://slavi.biz 
 */ 
function to_bytes($str) { 
	$bytes_array = array( 
		/*'B' => 1,
		'KB' => 1024,*/
		'M' => 1024 * 1024, // Megabtye
		'G' => 1024 * 1024 * 1024, // Terrabyte
		/*'TB' => 1024 * 1024 * 1024 * 1024,
		'PB' => 1024 * 1024 * 1024 * 1024 * 1024, */
	);

	if(preg_match('/^(\d+)(\w\w?)$/',$str,$matches) && isset($bytes_array[$matches[2]]))
	{
		$value=$matches[1];
		$bytes=$bytes_array[$matches[2]]*$value;
		return $bytes;
	}
	else
	{
		return FALSE;
	}


/*
    $bytes = floatval($str); 

    if (preg_match('#([KMGTP]?B)$#si', $str, $matches) && !empty($bytes_array[$matches[1]])) { 
        $bytes *= $bytes_array[$matches[1]]; 
    } 

    $bytes = intval(round($bytes, 2)); 

    return $bytes; */
} 

function save_attachment()
{
	global $wpdb;
	$userData=ar_user_data();
	
	$response=array(
		'status'=>'error',
		'error'=>'',
	);

/*	ob_start();
	var_dump($_FILES);
	$data=ob_get_clean();
	$response['data']=$data;
	echo json_encode($response);
	exit;*/
	
	if(!empty($_POST['assignment_id']))
	{
		$assignment_id=$_POST['assignment_id'];
		
		if(!empty($_FILES))
		{
			$response['files']=array();

			for($i=0; $i<count($_FILES['file']['tmp_name']); $i++)
			{
				$response_item=array(
					'status'=>'error',
					'error'=>'',
				);

				$tempPath=$_FILES['file']['tmp_name'][$i];
				$tempSize=$_FILES['file']['size'][$i];
				$tempType=$_FILES['file']['mime_type'][$i];
				$tempName=$_FILES['file']['name'][$i];
				$hashName=sha1($tempName.microtime());
				
				$targetPath=AR_ATTACHMENT_PATH.$hashName;
				$fileClass=ar_get_file_class($tempName);
				
				if($fileClass!==false)
				{
					$max_attachment_size=1024*1024*10; // 10mb

					if($tempSize < $max_attachment_size)
					{
						if(move_uploaded_file($tempPath,$targetPath)!==false)
						{
							$result=$wpdb->insert('ar_attachments',array(
								'job_id'=>$assignment_id,
								'user_id'=>$userData['id'],
								'name'=>$tempName,
								'description'=>$tempName,
								'mime_type'=>$tempType,
								'url'=>$hashName,
							));
							
							if($result!==false)
							{
								$response_item['status']='success';
								$response_item['attachment_id']=$wpdb->insert_id;
								$response_item['type']=$fileClass;
								$response_item['description']=$tempName;
								$response_item['url']=AR_ATTACHMENT_URL.$hashName;

								/*
								 * Now send e-mail notifications
								 */

								$sql=$wpdb->prepare('
									select
										*
									from
										ar_job
									where
										id = %d
									limit 1
								',$assignment_id);
								$assignment=$wpdb->get_row($sql,'ARRAY_A');

								// Only send e-mail notifications if this is an EXISTING ASSIGNMENT
								// (existing assignment is an assignment whos type is set and autosave is 0)
								if($assignment['type']!==NULL && $assignment['autosave']==0)
								{
									$sql=$wpdb->prepare('
										select
											*
										from
											ar_user
										where
											id = %d
										limit 1
									',$assignment['client_user_id']);
									$rep=$wpdb->get_row($sql,'ARRAY_A');

									$sql=$wpdb->prepare('
										select
											*
										from
											ar_user
										where
											id = %d
										limit 1
									',$assignment['tech_user_id']);
									$tech=$wpdb->get_row($sql,'ARRAY_A');
									
									/*$attachment_type_map=array(
										'img'=>'Photo',
										'word'=>'Word Document',
										'pdf'=>'PDF Document',
										'txt'=>'Text Document',
									);
									$attachment_type=$attachment_type_map[$fileClass];
									$attachment_name=$tempName;
									$attachment_url=$response['url'];*/

									// If a tech is assigned to this attachment's assignment, send them an e-mail
									if($tech!==NULL)
									{
										// Now send the tech a notification
										$email_data=array(
											'file_number'=>$assignment['file_number'],
											'rep_last_name'=>$rep['last_name'],
											'assignment_id'=>$assignment_id,
											'tech_first_name'=>$tech['first_name'],
											'rep_first_name'=>$rep['first_name'],
										);
										$response_item['email_data']=$email_data;
										$response_item['tech_data']=$tech;
										$response_item['email_response']=ar_send_email('new_attachment_tech',$email_data,$tech['email']);
									}
									// If no tech is assigned, send all administrators an e-mail
									else
									{
										$response_item['email_data']=array();
										$response_item['admin_data']=array();
										$response_item['email_response']=array();

										foreach(ar_get_admin_users() as $admin)
										{
											$email_data=array(
												'file_number'=>$assignment['file_number'],
												'rep_last_name'=>$rep['last_name'],
												'assignment_id'=>$assignment_id,
												'admin_first_name'=>$admin['first_name'],
												'rep_first_name'=>$rep['first_name'],
											);
											$response_item['email_data'][]=$email_data;
											$response_item['admin_data'][]=$admin;
											$response_item['email_response'][]=ar_send_email('new_attachment_admin',$email_data,$admin['email']);;
										}
									}
								}

								if($response_item['type']=='img')
								{
									// Attempt to resize if it is an image
									require_once('vendor/SimpleImage.php');
									$img=new SimpleImage(AR_ATTACHMENT_PATH.$hashName);

									if($img->getWidth()>1200)
									{
										$img->resizeToWidth(1200);
										$img->save(AR_ATTACHMENT_PATH.$hashName);
									}
								}
							}
							else
							{
								$response_item['error']='There was a problem saving the file data.';
							}
						}
						else
						{
							$response_item['error']='There was a problem saving the file.';
						}
					}
					else
					{
						$response_item['error']='The attachment file size must be less than 10 MB.';
					}
				}
				else
				{
					$response_item['error']='You have uploaded an invalid file type.';
				}

				$response['files'][]=$response_item;
			} // End for
		}
		else
		{
			$response['error']='There was no uploaded files found.';
		}
	}
	else
	{
		$response['error']='The assignment ID was not found.';
	}

	if(empty($response['error']))
		$response['status']='success';
	
	echo json_encode($response);
	exit;
}

function save_attachment_description()
{
	global $wpdb;
	
	$response=array(
		'status'=>'error',
		'error'=>'',
	);
	
	if(!empty($_POST['attachment_id']))
	{
		if(isset($_POST['description']))
		{
			$attachment_id=$_POST['attachment_id'];
			$description=$_POST['description'];
			
			$result=$wpdb->update('ar_attachments',array(
				'description'=>$description,
			),array(
				'id'=>$attachment_id,
			));
			
			if($result!==false)
			{
				$response['status']='success';
			}
			else
			{
				$response['error']='There was a problem saving the description.';
			}
		}
		else
		{
			$response['error']='Description was not found.';
		}
	}
	else
	{
		$response['error']='Attachment ID was not found.';
	}
	
	echo json_encode($response);
	exit;
}

function delete_attachment()
{
	global $wpdb;
	
	$response=array(
		'status'=>'error',
		'error'=>'',
	);
	
	if(!empty($_POST['attachment_id']))
	{
		$attachment_id=$_POST['attachment_id'];
		
		// Get the filename to attempt to delete it
		$sql=$wpdb->prepare('
			select
				url
			from
				ar_attachments
			where
				id = %d
			limit 1
		',$attachment_id);
		$hashName=$wpdb->get_var($sql);

		// Delete the attachment record from the database
		$sql=$wpdb->prepare('
			delete from
				ar_attachments
			where
				id = %d
			limit 1
		',$attachment_id);
		$result=$wpdb->query($sql);
		
		if($result!==false)
		{
			$response['status']='success';
			// Attempt to delete the file from the filesystem
			if($hashName!==NULL)
				@unlink(AR_ATTACHMENT_PATH.$hashName);
		}
		else
		{
			$response['error']='There was a problem deleting the attachment.';
		}
	}
	else
	{
		$response['error']='Attachment ID was not found.';
	}
	
	echo json_encode($response);
	exit;
}

function create_message()
{
	global $wpdb;
	
	$response=array(
		'status'=>'error',
		'error'=>'',
	);
	
	if(!empty($_POST['message']))
	{
		if(!empty($_POST['assignment_id']))
		{
			$user_data=ar_user_data();
			
			$success=$wpdb->insert('ar_correspondence',array(
				'from_user_id'=>$user_data['id'],
				'job_id'=>$_POST['assignment_id'],
				'message'=>$_POST['message'],
				'created_at'=>date('Y-m-d H:i:s'),
			));
			
			if($success)
			{
				$response['status']='success';
				$response['timestamp']=date('m/d/Y h:ia');

				$sql=$wpdb->prepare('
					select
						*
					from
						ar_job
					where
						id = %d
					limit 1
				',$_POST['assignment_id']);
				$assignment=$wpdb->get_row($sql,'ARRAY_A');

				$sql=$wpdb->prepare('
					select
						*
					from
						ar_user
					where
						id = %d
					limit 1
				',$assignment['client_user_id']);
				$rep=$wpdb->get_row($sql,'ARRAY_A');

				$sql=$wpdb->prepare('
					select
						*
					from
						ar_user
					where
						id = %d
					limit 1
				',$assignment['tech_user_id']);
				$tech=$wpdb->get_row($sql,'ARRAY_A');
				
				// If a tech is assigned to this assignment, send them an e-mail
				if($tech!==NULL)
				{
					// Now send the tech a notification
					$email_data=array(
						'file_number'=>$assignment['file_number'],
						'rep_last_name'=>$rep['last_name'],
						'assignment_id'=>$assignment['id'],
						'tech_first_name'=>$tech['first_name'],
						'rep_first_name'=>$rep['first_name'],
						'message'=>$_POST['message'],
					);
					$response['email_data']=$email_data;
					$response['tech_data']=$tech;
					$response['email_response']=ar_send_email('new_message_tech',$email_data,$tech['email']);
				}
				// If no tech is assigned, send all administrators the same e-mail
				else
				{
					$response['email_data']=array();
					$response['admin_data']=array();
					$response['email_response']=array();

					foreach(ar_get_admin_users() as $admin)
					{
						$email_data=array(
							'file_number'=>$assignment['file_number'],
							'rep_last_name'=>$rep['last_name'],
							'assignment_id'=>$assignment['id'],
							'admin_first_name'=>$admin['first_name'],
							'rep_first_name'=>$rep['first_name'],
							'message'=>$_POST['message'],
						);
						$response['email_data'][]=$email_data;
						$response['admin_data'][]=$admin;
						$response['email_response'][]=ar_send_email('new_message_admin',$email_data,$admin['email']);;
					}
				}
			}
			else
				$response['error']='There was a problem saving the message.';
		}
		else
		{
			$response['error']='The assignment ID was not found.';
		}
	}
	else
	{
		$response['error']='The message was not found.';
	}
	
	echo json_encode($response);
	exit;
}

function clear_autosaves()
{
	global $wpdb;
	$user_data=ar_user_data();

	$sql=$wpdb->prepare('
		select
			id
		from
			ar_job
		where
			client_user_id = %d and
			autosave = 1
	',$user_data['id']);
	$autosaved_assignment_ids=$wpdb->get_col($sql);

	if(empty($autosaved_assignment_ids))
	{
		$response['status']='There were no autosaved assignments to remove.';
	}
	else
	{
		$count=0;
		foreach($autosaved_assignment_ids as $autosaved_assignment_id)
		{
			// Get vehicle IDs
			$sql=$wpdb->prepare('
				select
					id
				from
					ar_job_vehicle
				where
					job_id = %d
			',$autosaved_assignment_id);
			$vehicle_ids=$wpdb->get_col($sql);

			// Delete vehicle answers
			foreach($vehicle_ids as $vehicle_id)
			{
				$sql=$wpdb->prepare('
					delete from
						ar_job_vehicle_answer
					where
						vehicle_id = %d
				',$vehicle_id);
				$wpdb->query($sql);
			}

			// Delete vehicles
			$sql=$wpdb->prepare('
				delete from
					ar_job_vehicle
				where
					job_id = %d
			',$autosaved_assignment_id);
			$wpdb->query($sql);

			// Delete job answers
			$sql=$wpdb->prepare('
				delete from
					ar_job_answer
				where
					job_id = %d
			',$autosaved_assignment_id);
			$wpdb->query($sql);

			// Delete job updates (there shouldn't be any of these, but just for good measure...)
			$sql=$wpdb->prepare('
				delete from
					ar_update
				where
					job_id = %d
			',$autosaved_assignment_id);
			$wpdb->query($sql);

			// Delete attachments
			$sql=$wpdb->prepare('
				delete from
					ar_attachments
				where
					job_id = %d
			',$autosaved_assignment_id);
			$wpdb->query($sql);

			// Delete job
			$sql=$wpdb->prepare('
				delete from
					ar_job
				where
					id = %d
				limit 1
			',$autosaved_assignment_id);
			$count+=$wpdb->query($sql);
		}

		$response['status']='Removed '.$count.' assignments.';
	}

	echo json_encode($response);
	exit;
}

function agent_file_upload(){
    
    global $wpdb;
    
    $output = array();
    if(!empty($_FILES)){
        $tempPath = $_FILES['file_upload']['tmp_name'];
        $tempSize = $_FILES['file_upload']['size'];
        $tempType = $_FILES['file_upload']['mime_type'];
        $tempName = $_FILES['file_upload']['name'];
        
        $hashName = sha1($tempName.microtime());
        
        $targetPath = dir_name($_SERVER['DOCUMENT_ROOT']).'/content-backend/uploads/'.$hashName;
        
        if(move_uploaded_file($tempPath,$targetPath) !== false){
            
            $ins_s = '
            INSERT INTO acx_attachments 
                (`parent_id`,`parent_type`,`name`,`mime_type`,`size`,`location`,
                `attachment_type`,`created_on`,`created_by_id`,`created_by_name`,
                `created_by_email`) 
            VALUES 
                (\'0\',\'ticket\',\''.$tempName.'\',\''.$tempType.'\',\''.$tempSize.'\',\''.$hashName.'\',
                \'attachment\',\''.date('Y-m-d H:i:s').'\',\''.$_SESSION['agent_user_id'].'\',\''.$_SESSION['agent_user_name'].'\',
                \''.$_SESSION['agent_user_data']['email'].'\')';
            
            $ins_q = $wpdb->get_results($ins_s,'ARRAY_A');
            if($ins_q){
                $output['file_id'] = $file_id = $wpdb->insert_id;
                $output['error'] = '0';
            } else {
                $output['error'] = '1';
            }
        } else {
            $output['error'] = '1';
        }
    } else {
        $output['error'] = '1';
    }
    
    header('Content-Type: text/json');
	echo json_encode($output);
    die();
}

function agent_file_delete(){
    global $wpdb;
    $output = array();
    $del_s = 'DELETE FROM acx_attachments WHERE id=\''.$_POST['attid'].'\'';
    $del_q = $wpdb->get_results($del_s,'ARRAY_A');
    if($del_q !== false) $output['success'] = 1;
    else $output['success'] = 0;
    
    header('Content-Type: text/json');
	echo json_encode($output);
    die();
    
}

function agent_file_info(){
    global $wpdb;
    $output = array();
    $info_s = 'SELECT * FROM acx_attachments WHERE id=\''.$_POST['attid'].'\'';
    $output['query'] = $info_s;
    $info_q = $wpdb->get_results($info_s,'ARRAY_A');
    $output['result'] = $info_q;
    if($info_q != false && count($info_q) > 0){
        $output['name'] = $info_q[0]['name'];
        $output['size'] = format_bytes($info_q[0]['size']);
        $output['location'] = $info_q[0]['location'];
        $output['success'] = 1;
    } else {
        $output['success'] = 0;
    }
    
    header('Content-Type: text/json');
	echo json_encode($output);
    die();
}

function vehicle_vin_decode(){
    
    $output = array();

    $output['talkback'] = array();
    
    $output['talkback']['vin'] = $the_vin = $_POST['vin'];
    $output['talkback']['job_id'] = $the_job = $_POST['job_id'];
    $output['talkback']['claimant'] = $the_claimant = $_POST['claimant'];
    
    $output['talkback']['trim'] = $the_trim = (isset($_POST['trim']) && $_POST['trim'] != '') ? $_POST['trim'] : '';
    $output['talkback']['model'] = $the_model = (isset($_POST['model']) && $_POST['model'] != '') ? $_POST['model'] : '';
    $output['talkback']['wheel'] = $the_wheel_base = (isset($_POST['wheel']) && $_POST['wheel'] != '') ? $_POST['wheel'] : '';
    $output['talkback']['option'] = $the_options = (isset($_POST['options']) && $_POST['options'] != '') ? $_POST['options'] : '';
    $output['talkback']['equipment'] = $the_equipment = (isset($_POST['equipment']) && $_POST['equipment'] != '') ? $_POST['equipment'] : '';
    $output['talkback']['color'] = $the_color = (isset($_POST['color']) && $_POST['color'] != '') ? $_POST['color'] : '';

    // $vehicle_info = request_decoded_vin($the_vin,true,$the_trim,$the_model,$the_wheel_base,$the_options,$the_equipment, $the_color);
    
    $vin_info = requestVinInfo($the_vin,false);


    $results = array();

    convertXmlObjToArr($vin_info, $results);

    $vehicle_info = $results;

    $output['talkback']['vehicle_info'] = $vehicle_info;

    if($vehicle_info[0]['@attributes']['responsecode'] != 'Successful'){
        $output['success'] = false;
        $output['error_message'] = 'here is the problem:'.$vehicle_info[0]['@attributes']['Description'];
        // die(print_r($vehicle_info,true));
    } else {
        $output['success'] = true;
        
        store_vin_data_ajax($the_job,$the_claimant,$vehicle_info);
        
        $output['results'] = array(
            'year' => $vehicle_info[1]['@attributes']['modelyear'],
            'make' => $vehicle_info[1]['@attributes']['division'],
            'model' => $vehicle_info[1]['@attributes']['modelname'],
            'style' => $vehicle_info[1]['@attributes']['stylename']
        );
    }


    header('Content-Type: text/json');
	echo json_encode($output);
    die();
}

function store_vin_data_ajax($job_id,$claimant,$vehicle_data){
    global $wpdb;
    $upd_s = 'UPDATE `job` SET `claimant_'.$claimant.'_vin_data`=\''.json_encode($vehicle_data).'\' WHERE `id`=\''.$job_id.'\'';
    $upd_q = $wpdb->get_results($upd_s,'ARRAY_A');
    if($upd_q !== false) return true;
    else return false;
}

function convertXmlObjToArr($obj, &$arr) 
{ 
    $children = $obj->children(); 
    foreach ($children as $elementName => $node) 
    { 
        $nextIdx = count($arr); 
        $arr[$nextIdx] = array(); 
        $arr[$nextIdx]['@name'] = strtolower((string)$elementName); 
        $arr[$nextIdx]['@attributes'] = array(); 
        $attributes = $node->attributes(); 
        foreach ($attributes as $attributeName => $attributeValue) 
        { 
            $attribName = strtolower(trim((string)$attributeName)); 
            $attribVal = trim((string)$attributeValue); 
            $arr[$nextIdx]['@attributes'][$attribName] = $attribVal; 
        } 
        $text = (string)$node; 
        $text = trim($text); 
        if (strlen($text) > 0) 
        { 
            $arr[$nextIdx]['@text'] = $text; 
        } 
        $arr[$nextIdx]['@children'] = array(); 
        convertXmlObjToArr($node, $arr[$nextIdx]['@children']); 
    } 
    return; 
}

function vehicle_year_list()
{
	$output = requestModelYears();
	header('Content-Type: text/json');
	echo json_encode($output);
	die();
}

function vehicle_make_list()
{
	$output = requestDivisions(intval($_POST['year']));
	header('Content-Type: text/json');
	echo json_encode($output);
	die();
}

function vehicle_model_list()
{
	$output = requestModels(intval($_POST['year']), intval($_POST['make']));
	header('Content-Type: text/json');
	echo json_encode($output);
	die();
}
?>
