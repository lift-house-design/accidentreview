<?php
	function ar_display_question_field($question_key,$question,$value=false,$append_number=false)
	{
		if($question['question_type']=='textarea')
		{
			echo '<textarea name="'.$question_key.'" '.( !empty($question['placeholder']) ? ' placeholder="'.$question['placeholder'].'"' : '').'>'.(empty($value) ? '' : $value).'</textarea>';
		}
		elseif($question['question_type']=='date')
		{
			echo '<input type="text" class="date" name="'.$question_key.'"'.( !empty($question['placeholder']) ? ' placeholder="'.$question['placeholder'].'"' : '').( empty($value) ? '' : ' value="'.$value.'"' ).' />';
		}
		elseif($question['question_type']=='radio')
		{
			$question['possible_answers']=json_decode($question['possible_answers'],true);
			
			if(count($question['possible_answers'])>0)
			{
				if($append_number!==false)
					$question_key.='_'.$append_number;

				echo '<div class="ui-radios">';
				foreach($question['possible_answers'] as $answer)
				{
					$answer_slug=str_replace(' ','_',strtolower($answer));
					
					if(empty($value))
						echo '<input type="radio" name="'.$question_key.'" id="'.$question_key.'-'.$answer_slug.'" value="'.$answer.'"'.( $question['default_answer']==$answer ? ' checked="checked"' : '' ).' />';
					else
						echo '<input type="radio" name="'.$question_key.'" id="'.$question_key.'-'.$answer_slug.'" value="'.$answer.'"'.( $value==$answer ? ' checked="checked"' : '' ).' />';
					
					echo '<label for="'.$question_key.'-'.$answer_slug.'">'.$answer.'</label> ';
				}
				echo '</div>';
			}
		}
		elseif($question['question_type']=='checkbox')
		{
			$question['possible_answers']=json_decode($question['possible_answers'],true);
			
			if(count($question['possible_answers'])>0)
			{
				if($append_number!==false)
					$question_key.='_'.$append_number;

				if(!empty($value))
				{
					$scalar_value=$value;
					$value=json_decode($value,true);
					if(!is_array($value))
						$value=array($scalar_value);
				}
				else
					$value=array();

				if(!empty($question['default_answer']))
					$question['default_answer']=json_decode($question['default_answer'],true);
				else
					$question['default_answer']=array();

				echo '<div class="checkboxes">';
				foreach($question['possible_answers'] as $answer)
				{
					$answer_slug=str_replace(' ','_',strtolower($answer));
					
					if(empty($value))
						echo '<input type="checkbox" name="'.$question_key.'" id="'.$question_key.'-'.$answer_slug.'" value="'.$answer.'"'.( in_array($answer,$question['default_answer']) ? ' checked="checked"' : '' ).' />';
					else
						echo '<input type="checkbox" name="'.$question_key.'" id="'.$question_key.'-'.$answer_slug.'" value="'.$answer.'"'.( in_array($answer,$value) ? ' checked="checked"' : '' ).' />';
					
					echo '<label for="'.$question_key.'-'.$answer_slug.'">'.$answer.'</label><br /> ';
				}
				echo '</div>';
			}
		}
		else
		{
			echo '<input type="text" name="'.$question_key.'"'.( !empty($question['placeholder']) ? ' placeholder="'.$question['placeholder'].'"' : '').( empty($value) ? '' : ' value="'.$value.'"' ).' />';
		}
	}
	
	function ar_get_assignment_type_name($type)
	{
		$types=array(
			'vehicle-theft'=>'Vehicle Theft Analysis',
			'accident-reconstruction'=>'Collision Analysis/Reconstruction',
			'fire-analysis'=>'Vehicle Fire Analysis',
			'mechanical-analysis'=>'Mechanical Analysis',
			/*'physical-damage-comparison'=>'Physical Damage Analysis',*/
			'report-review'=>'Report Review',
			'other'=>'Other',
		);
		
		return isset($types[$type]) ? $types[$type] : 'Unknown';
	}

	function ar_get_autosaved_assignment()
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
			limit 1
		',$user_data['id']);
		$autosaved_assignment_id=$wpdb->get_var($sql);

		if($autosaved_assignment_id===NULL)
			return FALSE;
		else
			return ar_get_assignment_data($autosaved_assignment_id);
	}
	
	function ar_get_assignment_data($job_id)
	{
		global $wpdb;
		
		/**
		 * Get the base job data
		 */
		$sql=$wpdb->prepare('
			select
				*
			from
				ar_job
			where
				id = %d
		',$job_id);
		
		$job=$wpdb->get_row($sql,'ARRAY_A');
		
		if($job==null)
			return false;
		
		/**
		 * Get the job question data
		 */
		$sql=$wpdb->prepare('
			select
				question_key,
				answer
			from
				ar_job_answer
			where
				job_id = %d
		',$job_id);
		
		$answers=$wpdb->get_results($sql,'ARRAY_A');
		
		if($answers!=null)
		{
			foreach($answers as $answer)
				$job[$answer['question_key']]=$answer['answer'];
		}
		
		/**
		 * Get the job vehicle data
		 */
		$sql=$wpdb->prepare('
			select
				*
			from
				ar_job_vehicle
			where
				job_id = %d and
				type = "vehicle"
		',$job_id);
		
		$vehicles=$wpdb->get_results($sql,'ARRAY_A');
		
		if($vehicles!=null)
		{
			/**
			 * Get each vehicle question data
			 */
			foreach($vehicles as $i=>$vehicle)
			{
				$sql=$wpdb->prepare('
					select
						question_key,
						answer
					from
						ar_job_vehicle_answer
					where
						vehicle_id = %d
				',$vehicle['id']);
				
				$answers=$wpdb->get_results($sql,'ARRAY_A');
				
				if($answers!=null)
				{
					foreach($answers as $answer)
						$vehicles[$i][$answer['question_key']]=$answer['answer'];
				}
			}
			
			$job['vehicles']=$vehicles;
		}

		/**
		 * Get the job claimant data
		 */
		$sql=$wpdb->prepare('
			select
				*
			from
				ar_job_vehicle
			where
				job_id = %d and
				type = "claimant"
		',$job_id);
		
		$claimants=$wpdb->get_results($sql,'ARRAY_A');
		
		if($claimants!=null)
		{
			/**
			 * Get each claimant vehicle question data
			 */
			foreach($claimants as $i=>$vehicle)
			{
				$sql=$wpdb->prepare('
					select
						question_key,
						answer
					from
						ar_job_vehicle_answer
					where
						vehicle_id = %d
				',$vehicle['id']);
				
				$answers=$wpdb->get_results($sql,'ARRAY_A');
				
				if($answers!=null)
				{
					foreach($answers as $answer)
						$claimants[$i][$answer['question_key']]=$answer['answer'];
				}
			}
			
			$job['claimants']=$claimants;
		}

		// Get attachments
		$sql=$wpdb->prepare('
			select
				*
			from
				ar_attachments
			where
				job_id = %d and
				user_id = %d
		', $job_id, $_SESSION['user']['id']);
		
		$attachments=$wpdb->get_results($sql,'ARRAY_A');
		
		if($attachments==null)
			$job['attachments']=array();
		else
			$job['attachments']=$attachments;
		
		
		$sql=$wpdb->prepare('
			select
				*
			from
				ar_correspondence
			where
				job_id = %d
		', $job_id);
		
		$correspondence=$wpdb->get_results($sql,'ARRAY_A');
		
		if($correspondence==null)
			$job['correspondence']=array();
		else
			$job['correspondence']=$correspondence;
		
		return $job;
	}

	function ar_get_assignment_meta()
	{
		return array(
			'vehicle-theft'=>array(
				'job_questions'=>array(),
				'vehicle_questions'=>array(
					'perimeter_security_system'=>array(
						'question_type'=>'radio',
						'question'=>'Is this vehicle equipped with a perimeter security system?',
						'possible_answers'=>'["Aftermarket","Factory","No","Unknown"]',
						'default_answer'=>'Unknown',
					),
					'remote_start_system'=>array(
						'question_type'=>'radio',
						'question'=>'Is this vehicle equipped with a remote start system?',
						'possible_answers'=>'["Aftermarket","Factory","No","Unknown"]',
						'default_answer'=>'Unknown',
					),
					'modifications'=>array(
						'question_type'=>'textarea',
						'question'=>'Modifications/Aftermarket',
						'placeholder'=>'List any modifications',
					),
					'keys_available'=>array(
						'question_type'=>'radio',
						'question'=>'Are the keys available?',
						'possible_answers'=>'["Yes","No","Unknown"]',
						'default_answer'=>'Unknown',
					),
					'keys_available_where'=>array(
						'question_type'=>'text',
						'question'=>'Where are the keys?',
						'placeholder'=>'Let us know where we can find the keys',
						'hidden'=>true,
					),
				),
				'claimant_questions'=>array(),
				
			),
			'accident-reconstruction'=>array(
				'job_questions'=>array(
					'questionable_loss_checkboxes'=>array(
						'question_type'=>'checkbox',
						'label'=>'Check all that apply',
						'possible_answers'=>'["Impact Severity","Injury Potential","Damage Consistency","Speed Determination","Avoidability","Liability"]',
					),
				),
				'vehicle_questions'=>array(),
				'claimant_questions'=>array(),
			),
			'fire-analysis'=>array(
				'job_questions'=>array(),
				'vehicle_questions'=>array(),
				'claimant_questions'=>array(),
			),
			'mechanical-analysis'=>array(
				'job_questions'=>array(),
				'vehicle_questions'=>array(),
				'claimant_questions'=>array(),
			),
			'physical-damage-comparison'=>array(
				'job_questions'=>array(),
				'vehicle_questions'=>array(),
				'claimant_questions'=>array(),
			),
			'report-review'=>array(
				'job_questions'=>array(),
				'vehicle_questions'=>array(),
				'claimant_questions'=>array(),
			),
			'other'=>array(
				'job_questions'=>array(),
				'vehicle_questions'=>array(),
				'claimant_questions'=>array(),
			),
		);
	}
	
	function ar_get_make_id($year,$makeName)
	{
		$makes=requestDivisions($year);
		$makes=$makes['result'];
		
		foreach($makes as $make_id=>$make_name)
			if($make_name==$makeName)
				return $make_id;
		
		return $makeName;
	}
	
	
	function ar_get_new_job_id()
	{
		global $wpdb;
		$userData=ar_user_data();
		
		$sql=$wpdb->prepare('
			select
				id
			from
				ar_job
			where
				client_user_id = %d and
				(
					type IS NULL or
					autosave = 1
				)
		',
		$userData['id']);
		
		$row=$wpdb->get_row($sql,'ARRAY_A');
		
		if($row==null)
		{
			$wpdb->insert('ar_job',array(
				'client_user_id'=>$userData['id']
			));
			
			$job_id=$wpdb->insert_id;
		}
		else
		{
			$job_id=$row['id'];
		}
		
		return $job_id;
	}
	
	function ar_save_new_assignment($job_id,$job_data,$vehicles_data,$claimants_data)
	{
		global $wpdb;
		$user_data=ar_user_data();
		
		/**
		 * Get field arrays
		 */
		
		$job_fields=array(
			'client_user_id',
			'type',
			'file_number',
			'date_of_loss',
			'insured_name',
			'loss_description',
			'services_requested',
			'loss_location',
			'tos_agreement',
			'autosave',
		);
		$vehicle_fields=array(
			'claimant_name',
			'type',
			'vin_number',
			'year',
			'make',
			'model',
			'operator',
			'color',
			'registration_number',
			'additional_info',
		);
		$answer_fields=array(
			'question_type',
			'question',
			'possible_answers',
			//'answer',
		);
		$assignment_meta=ar_get_assignment_meta();
		$assignment_types=array_keys($assignment_meta);
		$assignment_type=( isset($job_data['type']) ? $job_data['type'] : $assignment_types[0] );
		
		$job_question_fields=$assignment_meta[$assignment_type]['job_questions'];
		$vehicle_question_fields=$assignment_meta[$assignment_type]['vehicle_questions'];
		$claimant_question_fields=$assignment_meta[$assignment_type]['claimant_questions'];
		
		/**
		 * Check to make sure that job exists and belongs to this user
		 **/
		
		$sql=$wpdb->prepare('
			select
				*
			from
				ar_job
			where
				id = %d and
				client_user_id = %d
		',
		$job_id, $user_data['id']);
		$job_row=$wpdb->get_row($sql,'ARRAY_A');
		if($job_row===NULL)
			return 'Unable to find job '.$job_id.' belonging to user '.$user_data['id'];
		
		/**
		 * Prepare job data
		 **/
		
		$job=array(
			'client_user_id'=>$user_data['id'],
		);
		if($job_row['type']=='')
			$job['created_at']=date('Y-m-d H:i:s');
		
		foreach($job_fields as $field)
		{
			if(isset($job_data[$field]))
			{
				$job[$field]=$job_data[$field];
				unset($job_data[$field]);
			}
		}

		// Be sure to remove the autosave flag if we are actually saving this time
		if(empty($job['autosave']))
			$job['autosave']=0;
			
		/**
		 * Prepare job answer data
		 */
		
		$job_answers=array();
		// Check for each job question
		foreach($job_question_fields as $question_key=>$question)
		{
			// If it's found
			if(isset($job_data[$question_key]))
			{
				if(is_array($job_data[$question_key]))
					$job_data[$question_key]=json_encode($job_data[$question_key]);

				$job_answer=array(
					'job_id'=>$job_id,
					'question_key'=>$question_key,
					'answer'=>$job_data[$question_key],
				);

				foreach($answer_fields as $field)
				{
					if(isset($question[$field]))
					{
						$job_answer[$field]=$question[$field];
					}
				}
				
				$job_answers[]=$job_answer;
				unset($job_data[$question_key]);
			}
		}
		
		/**
		 * Prepare vehicle data
		 */	
		 
		$vehicles=array();
		foreach($vehicles_data as $vehicle_data)
		{
			$vehicle=array(
				'job_id'=>$job_id,
			);
			foreach($vehicle_fields as $field)
			{
				if(isset($vehicle_data[$field]))
				{
					$vehicle[$field]=$vehicle_data[$field];
					unset($vehicle_data[$field]);
				}
			}
			
			/**
			 * Prepare vehicle answer data
			 */
			
			$vehice_answers=array();
			foreach($vehicle_question_fields as $question_key=>$question)
			{
				// If it's found
				if(isset($vehicle_data[$question_key]))
				{
					if(is_array($vehicle_data[$question_key]))
						$vehicle_data[$question_key]=json_encode($vehicle_data[$question_key]);

					$vehicle_answer=array(
						'question_key'=>$question_key,
						'answer'=>$vehicle_data[$question_key],
					);
					
					foreach($answer_fields as $field)
					{
						if(isset($question[$field]))
						{
							$vehicle_answer[$field]=$question[$field];
						}
					}
					
					$vehicle_answers[]=$vehicle_answer;
					unset($vehicle_data[$question_key]);
				}
			}
			
			$vehicle['answers']=$vehicle_answers;
			
			$vehicles[]=$vehicle;
		}
		
		/**
		 * Prepare claimant data
		 */	
		 
		$claimants=array();
		foreach($claimants_data as $claimant_data)
		{
			$claimant=array(
				'job_id'=>$job_id,
			);
			foreach($vehicle_fields as $field)
			{
				if(isset($claimant_data[$field]))
				{
					$claimant[$field]=$claimant_data[$field];
					unset($claimant_data[$field]);
				}
			}
			
			/**
			 * Prepare claimant answer data
			 */
			
			$claimant_answers=array();
			foreach($claimant_question_fields as $question_key=>$question)
			{
				// If it's found
				if(isset($claimant_data[$question_key]))
				{
					if(is_array($claimant_data[$question_key]))
						$claimant_data[$question_key]=json_encode($claimant_data[$question_key]);

					$claimant_answer=array(
						'question_key'=>$question_key,
						'answer'=>$claimant_data[$question_key],
					);
					
					foreach($answer_fields as $field)
					{
						if(isset($question[$field]))
						{
							$claimant_answer[$field]=$question[$field];
						}
					}
					
					$claimant_answers[]=$claimant_answer;
					unset($claimant_data[$question_key]);
				}
			}
			
			$claimant['answers']=$claimant_answers;
			
			$claimants[]=$claimant;
		}
		
		/**
		 * Begin database transaction
		 */
		
		$wpdb->query('start transaction');
		
		try
		{
			/**
			 * Remove data associated with the job (easier to remove and reinsert than update/insert)
			 **/
			
			// Get IDs of vehicles associated with this job
			$sql=$wpdb->prepare('
				select
					id
				from
					ar_job_vehicle
				where
					job_id = %d
			',$job_id);
			$vehicle_ids=$wpdb->get_col($sql);
			
			// Delete vehicle questions associated with vehicles associated with this job
			if(!empty($vehicle_ids))
			{
				$sql=$wpdb->prepare('
					delete from
						ar_job_vehicle_answer
					where
						vehicle_id in ('.implode(',',$vehicle_ids).')
				');
				$success=$wpdb->query($sql);
				
				if($success===false)
					throw new Exception('Line No. '.__LINE__.': '.mysql_error());
			}

			// Delete vehicles associated with this job
			$sql=$wpdb->prepare('
				delete from
					ar_job_vehicle
				where
					job_id = %d
			',$job_id);
			$success=$wpdb->query($sql);
			
			if($success===false)
				throw new Exception('Line No. '.__LINE__.': '.mysql_error());
				
			// Delete job questions assocated with this job
			$sql=$wpdb->prepare('
				delete from
					ar_job_answer
				where
					job_id = %d
			',$job_id);
			$success=$wpdb->query($sql);
			
			if($success===false)
				throw new Exception('Line No. '.__LINE__.': '.mysql_error());
			
			/**
			 * Update the job
			 */
			$success=$wpdb->update('ar_job',$job,array('id'=>$job_id));
			
			if($success===false)
				throw new Exception('Line No. '.__LINE__.': '.mysql_error());
			
			/**
			 * Insert the job answers
			 */
			foreach($job_answers as $job_answer)
			{
				$success=$wpdb->insert('ar_job_answer',$job_answer);
				
				if($success===false)
					throw new Exception('Line No. '.__LINE__.': '.mysql_error());
			}
			
			/**
			 * Insert vehicles
			 **/
			foreach($vehicles as $vehicle)
			{
				$vehicle_answers=$vehicle['answers'];
				unset($vehicle['answers']);
				
				$success=$wpdb->insert('ar_job_vehicle',$vehicle);
				
				if($success===false)
					throw new Exception('Line No. '.__LINE__.': '.mysql_error());
				
				$vehicle_id=$wpdb->insert_id;
				
				/**
				 * Insert vehicle answers
				 **/
				foreach((array)$vehicle_answers as $vehicle_answer)
				{
					$vehicle_answer['vehicle_id']=$vehicle_id;
					$success=$wpdb->insert('ar_job_vehicle_answer',$vehicle_answer);
					
					if($success===false)
						throw new Exception('Line No. '.__LINE__.': '.mysql_error());
				}
			}
			
			/**
			 * Insert claimants
			 **/
			foreach($claimants as $claimant)
			{
				$claimant_answers=$claimant['answers'];
				unset($claimant['answers']);
				
				$success=$wpdb->insert('ar_job_vehicle',$claimant);
				
				if($success===false)
					throw new Exception('Line No. '.__LINE__.': '.mysql_error());
				
				$vehicle_id=$wpdb->insert_id;
				
				/**
				 * Insert claimant answers
				 **/
				foreach((array)$claimant_answers as $claimant_answer)
				{
					$claimant_answer['vehicle_id']=$vehicle_id;
					$success=$wpdb->insert('ar_job_vehicle_answer',$claimant_answer);
					
					if($success===false)
						throw new Exception('Line No. '.__LINE__.': '.mysql_error());
				}
			}
			
			/**
			 * Update the activeCollab attachments with the ticket ID
			 */
			$success=$wpdb->update('ar_attachments',array(
				'job_id'=>$job_id,
			),array(
				'job_id'=>0,
				'user_id'=>$user_data['id'],
			));
			
			if($success===false)
				throw new Exception('Line No. '.__LINE__.': '.mysql_error());
		}
		catch(Exception $e)
		{
			$wpdb->query('rollback');
			return $e->getMessage();
		}
		
		$wpdb->query('commit');
		
		return true;
	}
	
	function ar_get_file_class($filename)
	{
		// Determine file type
		$validTypes=array(
			'img'=>array('jpg','jpeg','gif','png','tif'),
			'word'=>array('doc','docx'),
			'pdf'=>array('pdf'),
			'txt'=>array('txt','rtf'),
		);
		$typeMap=array();
		foreach($validTypes as $class=>$extensions)
			foreach($extensions as $ext)
				$typeMap[$ext]=$class;
			
		$pathinfo=pathinfo($filename);

		if(isset($typeMap[strtolower($pathinfo['extension'])]))
			return $typeMap[strtolower($pathinfo['extension'])];
		else
		{
			return false;
		}
			
	}
	
	function ar_get_new_assignment_attachments($id=0)
	{
		global $wpdb;
		$userData=ar_user_data();
		
		$sql=$wpdb->prepare('
			select
				id, name, description, url
			from
				ar_attachments
			where
				job_id = %d and
				user_id = %d
		',$id,$userData['id']);
		
		return $wpdb->get_results($sql,'ARRAY_A');
	}

	function ar_send_email($template,$data,$to)
	{
		$templates=array(
			'assignment_received'=>array(
				'subject'=>'Assignment Received: {file_number} {insured_last_name} {assignment_id}',
				'message'=>file_get_contents(AR_EMAIL_TEMPLATES_PATH.'assignment_received.php'),
			),
			'assignment_received_admin'=>array(
				'subject'=>'Assignment Received: {file_number} {insured_last_name} {assignment_id}',
				'message'=>file_get_contents(AR_EMAIL_TEMPLATES_PATH.'assignment_received_admin.php'),
			),
			'new_message_tech'=>array(
				'subject'=>'New Message: {file_number} {insured_last_name} {assignment_id}',
				'message'=>file_get_contents(AR_EMAIL_TEMPLATES_PATH.'new_message_tech.php'),
			),
			'new_message_admin'=>array(
				'subject'=>'New Message: {file_number} {insured_last_name} {assignment_id}',
				'message'=>file_get_contents(AR_EMAIL_TEMPLATES_PATH.'new_message_admin.php'),
			),
			'new_attachment_tech'=>array(
				'subject'=>'File Uploaded: {file_number} {insured_last_name} {assignment_id}',
				'message'=>file_get_contents(AR_EMAIL_TEMPLATES_PATH.'new_attachment_tech.php'),
			),
			'new_attachment_admin'=>array(
				'subject'=>'File Uploaded: {file_number} {insured_last_name} {assignment_id}',
				'message'=>file_get_contents(AR_EMAIL_TEMPLATES_PATH.'new_attachment_admin.php'),
			),
		);

		$subject=$templates[$template]['subject'];
		$message=$templates[$template]['message'];

		foreach($data as $k=>$v)
		{
			$subject=str_replace('{'.$k.'}',$v,$subject);
			$message=str_replace('{'.$k.'}',$v,$message);
		}

		static $mailer;

		if(isset($mailer))
		{
			$mailer->ClearAddresses();
		}
		else
		{
			require_once('vendor/phpmailer/class.phpmailer.php');

			$mailer=new PHPMailer;
			$mailer->isSMTP();
			$mailer->Host=AR_EMAIL_HOST;
			$mailer->Username=AR_EMAIL_USER;
			$mailer->Password=AR_EMAIL_PASS;
			$mailer->SMTPAuth=TRUE;
			$mailer->SMTPKeepAlive=TRUE;
			//$mailer->SMTPDebug=1;

			$mailer->From=AR_EMAIL_FROM_EMAIL;
			$mailer->FromName=AR_EMAIL_FROM_NAME;

			$mailer->IsHTML(true);
		}

		$mailer->AddAddress($to);
		$mailer->Subject=$subject;
		$mailer->Body=$message;
		$mailer->AltBody=nl2br(strip_tags($message));

		return $mailer->Send();
	}

	function ar_get_admin_users()
	{
		global $wpdb;

		$sql=$wpdb->prepare('
			select
				*
			from
				ar_user
			where
				role = %s
		','admin');

		$results=$wpdb->get_results($sql,'ARRAY_A');

		if($results !== NULL)
			return $results;
		else
			return FALSE;
	}

	// Helper function to convert a name field (both first and last) to just a last name (returns first name if theres only one name)
	function ar_get_last_name($name)
	{
		$parts=explode(' ',trim($name));
		if(count($parts)==2)
		{
			return $parts[1];
		}
		else
		{
			return $parts[0];
		}
	}