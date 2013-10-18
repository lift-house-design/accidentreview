<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Assignments extends App_Controller
	{
		protected $models=array('user','assignment','vehicle_answer','correspondence','attachment','assignment_update');
		
		protected $authenticate=TRUE;

		public function __construct(){
			header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Pragma: no-cache');
			parent::__construct();
		}

		public function index()
		{
			$this->css[]='http://accidentreview.com/wp-content/themes/accident-review/jquery.dataTables.css';
			$this->js[]='http://accidentreview.com/wp-content/themes/accident-review/js/jquery.dataTables.min.js';
			$this->js[]='actions/assignments-index.js';
			
			$assignment_where=array(
				'type IS NOT NULL'=>NULL,
				'autosave'=>0,
			);
			
			if($this->user->has_role('tech') && !$this->user->has_role('admin'))
			{
				$assignment_where['tech_user_id']=$this->user->data['id'];
			}
			
			$this->data['assignments']=$this->assignment->get_many_by($assignment_where);
		}
		
		public function view($id)
		{
			$this->js[]='actions/assignments-view.js';
			$this->js[]='jquery-ui.js';
			$this->css[]='jquery-ui.css';
			// Redactor
			$this->js[]=array(
				'file'=>'redactor.js',
				'type'=>'plugins/redactor',
			);
			$this->css[]=array(
				'file'=>'redactor.css',
				'type'=>'plugins/redactor',
			);
			// Fancybox
			$this->js[]=array(
				'file'=>'jquery.fancybox.js',
				'type'=>'plugins/fancybox2',
			);
			$this->css[]=array(
				'file'=>'jquery.fancybox.css',
				'type'=>'plugins/fancybox2',
			);
			
			$assignment=$this->assignment
				->with('answers')
				->with('vehicles')
				->with('correspondence')
				->with('rep')
				->get($id);
				
			$attachments=$this->attachment->get_many_by('job_id',$assignment['id']);
			$photo_attachments=array();
			$other_attachments=array();
			
			foreach($attachments as $a)
			{
				if($a['type']=='img')
					$photo_attachments[]=$a;
				else
					$other_attachments[]=$a;
			}

			if($version=$this->input->get('v'))
			{
				$version_query=$this->db->get_where('ar_final_report_archive',array(
					'id'=>$version,
				),1);
				$version_row=$version_query->row_array();
				$assignment['final_report']=$version_row['final_report'];
			}

			if($tab=$this->input->get('t'))
				$this->data['tab']=$tab;
			
			$this->data['photo_attachments']=$photo_attachments;
			$this->data['other_attachments']=$other_attachments;
			$this->data['assignment']=$assignment;
			$this->data['techs']=$this->user->get_many_by('role','tech');
			$this->data['final_report_versions']=$this->assignment->get_final_report_versions($id);
			$this->data['version']=$this->input->get('v');
		}
		
		public function update_status($id,$status)
		{
			if($this->authenticate())
			{
				if($this->assignment->update($id,array('status'=>urldecode($status))))
				{
					$this->set_notification('The status has been changed.');

					// Notify the client
					if($status == 'Complete') 
					{
						// Send the client an e-mail saying the final review is ready
						$assignment=$this->assignment
							->with('rep')
							->get($id);
						$email_data=array(
							'file_number'=>$assignment['file_number'],
							'rep_last_name'=>$assignment['rep']['last_name'],
							'insured_last_name'=>get_last_name($assignment['insured_name']),
							'assignment_id'=>$assignment['id'],
							'rep_first_name'=>$assignment['rep']['first_name'],
						);

						if(send_email('final_review_complete',$email_data,$assignment['rep']['email']))
						{
							$this->set_notification('The client has been sent an e-mail notifying them that the final review is ready.');
						}
						else
						{
							$this->form_validation->set_error('There was a problem sending a notification to the client telling them the final review is ready.');
						}

						// Add assignment update
						$this->assignment_update->insert(array(
							'user_id'=>$assignment['rep']['id'],
							'job_id'=>$assignment['id'],
							'message'=>'This assignment\'s final report is ready.',
						));
					}
					else
					{
						$assignment=$this->assignment
							->with('rep')
							->get($id);
						$email_data=array(
							'file_number'=>$assignment['file_number'],
							'rep_last_name'=>$assignment['rep']['last_name'],
							'insured_last_name'=>get_last_name($assignment['insured_name']),
							'rep_last_name'=>$assignment['rep']['last_name'],
							'assignment_id'=>$assignment['id'],
							'rep_first_name'=>$assignment['rep']['first_name'],
						);

						if(send_email('status_updated',$email_data,$assignment['rep']['email']))
							$this->set_notification('The representative was notified by e-mail of the status change.');
						else
							$this->form_validation->set_error('There was a problem notifying the representative of the status change');

						// Add assignment update
						$this->assignment_update->insert(array(
							'user_id'=>$assignment['rep']['id'],
							'job_id'=>$assignment['id'],
							'message'=>'This assignment\'s status was changed to '.urldecode($status).'.',
						));
					}


				}
				else
					$this->form_validation->set_error('There was a problem changing the status.');
			}

			redirect('assignments/'.$id);
		}
		
		public function update_tech($id,$tech_id)
		{
			if($this->authenticate())
			{
				if($this->assignment->update($id,array('tech_user_id'=>$tech_id)))
				{
					$this->set_notification('The assigned tech has been changed.');

					// Send e-mail to client telling them a tech has been assigned
					$assignment=$this->assignment
						->with('rep')
						->with('tech')
						->get($id);
					$email_data=array(
						'file_number'=>$assignment['file_number'],
						'rep_last_name'=>$assignment['rep']['last_name'],
						'insured_last_name'=>get_last_name($assignment['insured_name']),
						'assignment_id'=>$assignment['id'],
						'rep_first_name'=>$assignment['rep']['first_name'],
						'created_time'=>date('l, F j, Y, g:ia',strtotime($assignment['created_at'])),
						'tech_first_name'=>$assignment['tech']['first_name'],
						'tech_last_name'=>$assignment['tech']['last_name'],
						'tech_signature'=>empty($assignment['tech']['signature']) ? '' : ', '.$assignment['tech']['signature'],
					);
					send_email('tech_assigned',$email_data,$assignment['rep']['email']);

					// Send e-mail to tech
					$email_data=array(
						'file_number'=>$assignment['file_number'],
						'rep_last_name'=>$assignment['rep']['last_name'],
						'insured_last_name'=>get_last_name($assignment['insured_name']),
						'assignment_id'=>$assignment['id'],
						'tech_first_name'=>$assignment['tech']['first_name'],
					);
					send_email('assigned_to_tech',$email_data,$assignment['tech']['email']);

					// Add assignment update
					$this->assignment_update->insert(array(
						'user_id'=>$assignment['rep']['id'],
						'job_id'=>$assignment['id'],
						'message'=>'A tech has been assigned to this assignment.',
					));
				}
				else
					$this->form_validation->set_error('There was a problem changing the assigned tech.');
			}

			redirect('assignments/'.$id);
		}

		public function send_reminder($id)
		{
			$assignment=$this->assignment
				->with('tech')
				->with('rep')
				->get($id);
			$email_data=array(
				'file_number'=>$assignment['file_number'],
				'rep_last_name'=>$assignment['rep']['last_name'],
				'insured_last_name'=>get_last_name($assignment['insured_name']),
				'assignment_id'=>$assignment['id'],
				'tech_first_name'=>$assignment['tech']['first_name'],
			);

			if(send_email('assigned_to_tech',$email_data,$assignment['tech']['email']))
			{
				$this->set_notification('The tech has been sent an e-mail with a reminder about this assignment.');
			}
			else
			{
				$this->form_validation->set_error('There was a problem sending the reminder e-mail to the tech.');
			}
			
			redirect('assignments/'.$id);
		}
		
		public function create_message()
		{
			if($this->form_validation->run('assignments/create_message')!==FALSE)
			{
				$post=post();
				$hasError=FALSE;
				$success=$this->correspondence->insert(array(
					'from_user_id'=>$this->user->data['id'],
					'job_id'=>$post['assignment_id'],
					'message'=>$post['message'],
				));
				
				if($success)
					$this->set_notification('Your message has been added.');
				else
				{
					$this->form_validation->set_error('There was a problem saving your message.');
					$hasError=TRUE;
				}
				
				if($hasError===FALSE)
				{
					if(post('change_status'))
					{
						$success=$this->assignment->update($post['assignment_id'],array(
							'status'=>'Client Review',
						));
						
						if($success)
							$this->set_notification('The status has been changed.');
						else
							$this->form_validation->set_error('There was a problem changing the status.');
					}
					
					// Send e-mail notification
					$assignment=$this->assignment
						->with('rep')
						->get($post['assignment_id']);
					$role='Tech';
					if($this->user->data['role']=='admin')
						$role='Administrator';
					$email_data=array(
						'file_number'=>$assignment['file_number'],
						'rep_last_name'=>$assignment['rep']['last_name'],
						'insured_last_name'=>get_last_name($assignment['insured_name']),
						'assignment_id'=>$assignment['id'],
						'rep_first_name'=>$assignment['rep']['first_name'],
						'tech_first_name'=>$this->user->data['first_name'],
						'tech_last_name'=>$this->user->data['last_name'],
						'tech_signature'=>empty($this->user->data['signature']) ? '' : ', '.$this->user->data['signature'],
						'role'=>$role,
						'message'=>$post['message'],
					);

					if(send_email('new_message',$email_data,$assignment['rep']['email']))
					{
						$this->set_notification('The client has been sent an e-mail notifying them that your message was posted to their assigment.');
					}
					else
					{
						$this->set_notification('ERROR SENDING EMAIL');
						$this->form_validation->set_error('There was a problem sending a notification to the client.');
					}

					// Add assignment update
					$this->assignment_update->insert(array(
						'user_id'=>$assignment['rep']['id'],
						'job_id'=>$assignment['id'],
						'message'=>'A tech has added correspondence to your assignment.',
					));
				}
			}

			redirect('assignments/'.post('assignment_id'));
		}
		
		public function save_final_report()
		{
			$post=post();
			
			if(!empty($post))
			{
				$assignment_data=array(
					'final_report'=>$post['final_report']
				);
				if(!empty($post['assignment_completed']))
					$assignment_data['status']='Complete';
				
				$success=$this->assignment->update($post['assignment_id'],$assignment_data);
				
				if($success)
				{
					$this->set_notification('The final report has been saved.');
					if(!empty($post['assignment_completed']))
					{
						$this->set_notification('The status has been changed.');

						// Send the client an e-mail saying the final review is ready
						$assignment=$this->assignment
							->with('rep')
							->get($post['assignment_id']);
						$email_data=array(
							'file_number'=>$assignment['file_number'],
							'rep_last_name'=>$assignment['rep']['last_name'],
							'insured_last_name'=>get_last_name($assignment['insured_name']),
							'assignment_id'=>$assignment['id'],
							'rep_first_name'=>$assignment['rep']['first_name'],
						);

						if(send_email('final_review_complete',$email_data,$assignment['rep']['email']))
						{
							$this->set_notification('The client has been sent an e-mail notifying them that the final review is ready.');
						}
						else
						{
							$this->form_validation->set_error('There was a problem sending a notification to the client telling them the final review is ready.');
						}

						// Add assignment update
						$this->assignment_update->insert(array(
							'user_id'=>$assignment['rep']['id'],
							'job_id'=>$assignment['id'],
							'message'=>'This assignment\'s final report is ready.',
						));
					}
				}
				else
				{
					$this->form_validation->set_error('There was a problem saving the final report.');
					if(!empty($post['assignment_completed']))
						$this->form_validation->set_error('There was a problem changing the status.');
				}
				
				redirect('assignments/'.$post['assignment_id']);
			}
			
			redirect('assignments');
		}
		
		public function report($id)
		{
			error_reporting(0);
			$this->authenticate=FALSE;
			$this->layout='layouts/report';
			$this->css[]='report.css';
			$this->js[]='jquery-1.9.1.min.js';
			
			$this->data['assignment']=$this->assignment
				->with('answers')
				->with('vehicles')
				->with('correspondence')
				->with('rep')
				->get($id);
			$this->data['tech']=$this->user->get($this->data['assignment']['tech_user_id']);

			$vehicles=array();
			$claimants=array();

			foreach($this->data['assignment']['vehicles'] as $vehicle)
			{
				if($vehicle['type']=='vehicle')
					$vehicles[]=$vehicle;
				elseif($vehicle['type']=='claimant')
					$claimants[]=$vehicle;
			}

			$this->data['vehicles']=$vehicles;
			$this->data['claimants']=$claimants;
		}

		public function phpinfo()
		{
			phpinfo();
			exit;
		}
	}
	
/* End of file assignments.php */
/* Location: ./application/controllers/assignments.php */