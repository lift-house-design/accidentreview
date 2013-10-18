<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Users extends App_Controller
	{
		public $authenticate=TRUE;
		
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
			$this->js[]='actions/users-index.js';
			
			$this->data['users']=$this->user->get_all();
		}
		
		public function edit($id)
		{
			if($this->authenticate() && $this->form_validation->run('users/edit')!==FALSE)
			{
				$post=post();
				$has_error=FALSE;
				
				// Change the password
				if(post('new_password'))
				{
					if(post('new_password')==post('confirm_new_password'))
					{
						$post['password']=sha1($post['new_password']);
						$this->set_notification('The password for '.trim($post['first_name'].' '.$post['last_name']).' has been changed.');
					}
					else
					{
						$this->form_validation->set_error('The new password and confirm new password fields did not match. Please try again.');
						$has_error=TRUE;
					}
				}
				
				$post['is_tech']=post('is_tech') ? 1 : 0;
				$post['is_admin']=post('is_admin') ? 1 : 0;
				
				// Save the account information
				if($this->user->update($id,$post))
				{
					if(empty($post['client_reps']))
						$post['client_reps']=array();

					$this->user->save_client_reps($post['client_reps'],$id);
					
					$this->set_notification('The account details for '.trim($post['first_name'].' '.$post['last_name']).' have been updated.');
					
					// Only redirect if there was no problem with changing the password
					if($has_error===FALSE)
						redirect('users');
				}
				else
					$this->form_validation->set_error('There was a problem saving the account details. Please try again.');
			}
			
			$this->js[]='jquery.maskedinput-1.3.1.js';
			$this->js[]='actions/users-edit.js';
			
			$this->data['usr']=$this->user->get($id);

			$this->data['state_options']=states_array(array(''=>'(select a state)'));
			$this->data['client_admin_reps_options']=$this->user->get_many_by('role','client');
		}
		
		public function create()
		{
			if($this->authenticate() && $this->form_validation->run('users/create')!==FALSE)
			{
				$post=post();
				
				$post['password']=sha1(post('password'));
				$post['is_tech']=post('is_tech') ? 1 : 0;
				$post['is_admin']=post('is_admin') ? 1 : 0;
				
				if(post('password')==post('confirm_password'))
				{
					if($this->user->insert($post))
					{
						$id=$this->db->insert_id();

						if(empty($post['client_reps']))
							$post['client_reps']=array();

						$this->user->save_client_reps($post['client_reps'],$id);

						$this->set_notification('The account details for '.trim($post['first_name'].' '.$post['last_name']).' have been saved.');
						redirect('users');
					}
					else
						$this->form_validation->set_error('There was a problem saving the account details. Please try again.');
				}
				else
				{
					$this->form_validation->set_error('The password and confirm password fields did not match. Please try again.');
				}
			}
			
			$this->js[]='jquery.maskedinput-1.3.1.js';
			$this->js[]='actions/users-create.js';
			
			$this->data['state_options']=states_array(array(''=>'(select a state)'));
			$this->data['client_admin_reps_options']=$this->user->get_many_by('role','client');
		}
		
		public function delete($id)
		{
			if($this->user->delete($id))
				$this->set_notification('That account has been removed.');
			else
				$this->form_validation->set_error('There was a problem removing that account. Please try again.');
			redirect('users');
		}
	}
	
/* End of file users.php */
/* Location: ./application/controllers/users.php */