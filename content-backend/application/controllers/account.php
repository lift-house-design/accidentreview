<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends App_Controller
{
	public function index()
	{
		$this->authenticate=TRUE;
		
		public function __construct(){
			header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
			header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
			parent::__construct();
		}
		
		if($this->authenticate() && $this->form_validation->run('account/index')!==FALSE)
		{
			// Save the account information
			if($this->user->update($this->user->data['id'],post()))
			{
				$this->set_notification('Your account details have been updated.');
				$user=$this->user->get($this->user->data['id']);
				session('user',$user);
				$this->user->data=$user;
			}
			
			// Change the password
			if(post('new_password'))
			{
				if(post('new_password')==post('confirm_new_password'))
				{
					if($this->user->change_password(post('current_password'),post('new_password'))===TRUE)
					{
						$this->set_notification('Your password has been changed.');
					}
					else
						$this->form_validation->set_error('The current password you entered was incorrect. Please try again.');
				}
				else
					$this->form_validation->set_error('The new password and confirm new password fields did not match. Please try again.');
			}
		}
		
		$this->js[]='jquery.maskedinput-1.3.1.js';
		$this->js[]='actions/account-index.js';
		$this->data['state_options']=states_array(array(''=>'(select a state)'));
	}
	
	public function login()
	{
		if($this->form_validation->run('account/login')!==FALSE)
		{
			if($this->user->log_in())
				redirect('assignments');
			else
				$this->form_validation->set_error('You entered an incorrect username or password. Please try again.');
		}
			
	}
	
	public function logout()
	{
		$this->user->log_out();
		redirect('login');
	}
}

/* End of file site.php */
/* Location: ./application/controllers/site.php */