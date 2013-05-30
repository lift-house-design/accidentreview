<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Users extends App_Controller
	{
		public $authenticate=TRUE;
		
		public function index()
		{
			$this->css[]='http://accidentreview.com/wp-content/themes/accident-review/jquery.dataTables.css';
			$this->js[]='http://accidentreview.com/wp-content/themes/accident-review/js/jquery.dataTables.min.js';
			$this->js[]='actions/users-index.js';
			
			// Users listing
			$users=array();
			foreach($this->user->get_all() as $usr)
			{
				$role='Client';
				if($usr['is_tech'])
					$role='Tech';
				if($usr['is_admin'])
					$role='Admin';
				$usr['role']=$role;
				$users[]=$usr;
			}
			
			$this->data['users']=$users;
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
		}
	}
	
/* End of file users.php */
/* Location: ./application/controllers/users.php */