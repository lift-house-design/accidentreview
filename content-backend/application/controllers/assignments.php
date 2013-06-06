<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Assignments extends App_Controller
	{
		protected $models=array('user','assignment','vehicle_answer','correspondence');
		
		protected $authenticate=TRUE;
		
		public function index()
		{
			$this->css[]='http://accidentreview.com/wp-content/themes/accident-review/jquery.dataTables.css';
			$this->js[]='http://accidentreview.com/wp-content/themes/accident-review/js/jquery.dataTables.min.js';
			$this->js[]='actions/assignments-index.js';
			
			$assignment_where=array(
				'type IS NOT NULL'=>NULL,
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
			
			$assignment=$this->assignment
				->with('answers')
				->with('vehicles')
				->with('correspondence')
				->with('rep')
				->get($id);
			
			$this->data['assignment']=$assignment;
			$this->data['techs']=$this->user->get_many_by('is_tech',1);
		}
		
		public function update_status($id,$status)
		{
			if($this->authenticate())
			{
				if($this->assignment->update($id,array('status'=>urldecode($status))))
					$this->set_notification('The status has been changed.');
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
					$this->set_notification('The assigned tech has been changed.');
				else
					$this->form_validation->set_error('There was a problem changing the assigned tech.');
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
				
				if($hasError===FALSE && post('change_status'))
				{
					$success=$this->assignment->update($post['assignment_id'],array(
						'status'=>'Client Review',
					));
					
					if($success)
						$this->set_notification('The status has been changed.');
					else
						$this->form_validation->set_error('There was a problem changing the status.');
				}
			}
			
			redirect('assignments/'.post('assignment_id'));
		}
	}
	
/* End of file assignments.php */
/* Location: ./application/controllers/assignments.php */