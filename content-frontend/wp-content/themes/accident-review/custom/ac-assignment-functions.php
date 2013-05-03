<?php
	function ar_get_assignment_meta()
	{
		return array(
			'vehicle-theft'=>array(
				'job_questions'=>array(
					'date_of_recovery'=>array(
						'question_type'=>'date',
						'question'=>'Date of Recovery',
						'placeholder'=>'Enter date of recovery',
					),
					'factory_perimeter_security_system'=>array(
						'question_type'=>'radio',
						'question'=>'Is the vehicle equipped with a factory perimeter security system?',
						'possible_answers'=>'["Yes","No","Optional","Unknown"]',
						'default_answer'=>'Unknown',
					),
					'aftermarket_security_system'=>array(
						'question_type'=>'radio',
						'question'=>'Is the vehicle equipped with an aftermarket security system?',
						'possible_answers'=>'["Yes","No","Unknown"]',
						'default_answer'=>'Unknown',
					),
					'remote_start_system'=>array(
						'question_type'=>'radio',
						'question'=>'Is the vehicle equipped with a remote start system?',
						'possible_answers'=>'["Yes","No","Unknown"]',
						'default_answer'=>'Unknown',
					),
					'remote_start_system_type'=>array(
						'question_type'=>'radio',
						'question'=>'Is the remote start system factory or aftermarket?',
						'possible_answers'=>'["Factory","Aftermarket","Unknown"]',
						'default_answer'=>'Unknown',
					),
				),
				'vehicle_questions'=>array(
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
				
			),
			'accident-reconstruction'=>array(
				'job_questions'=>array(
					'location_of_loss'=>array(
						'question_type'=>'textarea',
						'question'=>'Location of Loss',
						'placeholder'=>'Enter description of the location of loss',
					),
				),
				'multiple_vehicles'=>true,
			),
			'fire-analysis'=>array(
			
			),
			'mechanical-analysis'=>array(
			
			),
			'physical-damage-comparison'=>array(
			
			),
			'report-review'=>array(
			
			),
			'other'=>array(
			
			),
		);
	}
	
	
	function ar_get_new_job_id()
	{
		global $wpdb;
		
		$sql=$wpdb->prepare('
			select
				id
			from
				ar_job
			where
				user_id = %d and
				ticket_id = 0
		',
		$_SESSION['agent_user_id']);
		
		$row=$wpdb->get_row($sql,'ARRAY_A');
		
		if($row==null)
		{
			$wpdb->insert('ar_job',array(
				'ticket_id'=>0,
				'user_id'=>$_SESSION['agent_user_id']
			));
			
			$job_id=$wpdb->insert_id;
		}
		else
		{
			$job_id=$row['id'];
		}
		
		return $job_id;
	}
	
	function ar_save_new_assignment($job_id,$job_data,$vehicles_data)
	{
		global $wpdb;
		
		/**
		 * Get field arrays
		 */
		
		$job_fields=array(
			'ticket_id',
			'user_id',
			'type',
			'file_number',
			'insured_name',
			'date_of_loss',
			'loss_description',
			'services_requested',
			'tos_agreement',
		);
		$vehicle_fields=array(
			//'job_id',
			'vin_number',
			'year',
			'make',
			'model',
			'owners_name',
			'belongs_to',
			'color',
			'registration_number',
			'modifications',
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
		
		/**
		 * Check to make sure that job exists and belongs to this user
		 **/
		
		$sql=$wpdb->prepare('
			select
				count(*)
			from
				ar_job
			where
				id = %d and
				user_id = %d
		',
		$job_id, $_SESSION['agent_user_id']);
		$count=$wpdb->get_var($sql);
		if($count<1)
			return 'Unable to find job '.$job_id.' belonging to user '.$_SESSION['agent_user_id'];
		
		/**
		 * Prepare job data
		 **/
		
		$job=array(
			'user_id'=>$_SESSION['agent_user_id'],
		);
		foreach($job_fields as $field)
		{
			if(isset($job_data[$field]))
			{
				$job[$field]=$job_data[$field];
				unset($job_data[$field]);
			}
		}
			
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
					$vehicle_answer=array(
						//'job_id'=>$job_id,
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
				foreach($vehicle_answers as $vehicle_answer)
				{
					$vehicle_answer['vehicle_id']=$vehicle_id;
					$success=$wpdb->insert('ar_job_vehicle_answer',$vehicle_answer);
					
					if($success===false)
						throw new Exception('Line No. '.__LINE__.': '.mysql_error());
				}
			}
		}
		catch(Exception $e)
		{
			$wpdb->query('rollback');
			return $e->getMessage();
		}
		
		$wpdb->query('commit');
		
		return true;
	}
