<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class User_model extends App_Model
	{
		public $_table='ar_user';
		
		/*public $validate=array(
			array(
				'field'=>'',
				'label'=>'',
				'rules'=>'required',
			),
		);*/
		
		public $protected_attributes=array('id');
		
		public $has_many=array();
		
		public $belongs_to=array();
		
		protected $return_type='array';
		
		public $after_get=array('after_get');
		
		public $before_delete=array('before_delete');

		public $logged_in=FALSE;
		
		public $data;
		
		public function __construct()
		{
			parent::__construct();
			
			$user=session('user');
			$this->logged_in=!empty($user);
			
			if($this->logged_in)
				$this->data=$user;
		}
		
		protected function after_get($data)
		{
			if($data['role']=='client_admin')
			{
				$client_reps=array();
				$client_reps_result=$this->_database->get_where('ar_admin_clients',array(
					'client_admin_id'=>$data['id'],
				));

				foreach($client_reps_result->result_array() as $row)
					$client_reps[]=$row['client_rep_id'];

				$data['client_reps']=$client_reps;
			}
			else
				$data['client_reps']=array();

			return $data;
		}

		protected function before_delete($id)
		{
			$this->_database->delete('ar_admin_clients',array(
				'client_admin_id'=>$id
			));
			$this->_database->delete('ar_admin_clients',array(
				'client_rep_id'=>$id
			));

			return true;
		}
		
		public function log_in($email=NULL,$password=NULL)
		{
			if(!isset($email))
				$email=post('email');
			if(!isset($password))
				$password=post('password');
			
			if(empty($email)||empty($password))
				return FALSE;
			
			$user=$this->get_by(array(
				'email'=>$email,
				'password'=>sha1($password),
			));
			
			if(empty($user))
				return FALSE;
			
			session('user',$user);
			
			return TRUE;
		}
		
		public function log_out()
		{
			session('user',NULL);
		}
		
		public function change_password($current_password,$new_password)
		{
			// Can't change the password of a user not logged in
			if($this->logged_in===FALSE)
				return FALSE;
			
			// Confirm the current password
			$user=$this->get_by(array(
				'id'=>$this->data['id'],
				'password'=>sha1($current_password),
			));
			
			if(empty($user))
				return FALSE;
			else
			{
				// Change the password
				$this->update($this->data['id'],array(
					'password'=>sha1($new_password),
				));
				
				return TRUE;
			}
		}
		
		public function has_role($role,$id=NULL)
		{
			if($id===NULL)
				$user=$this->data;
			else
				$user=$this->user->get($id);
			
			return $user['role']==$role;
		}

		public function save_client_reps($client_reps,$user_id)
		{
			// Delete current saved reps
			$this->_database->delete('ar_admin_clients',array(
				'client_admin_id'=>$user_id,
			));

			// Now insert new rows for the new reps
			foreach($client_reps as $rep_id)
			{
				$this->_database->insert('ar_admin_clients',array(
					'client_admin_id'=>$user_id,
					'client_rep_id'=>$rep_id,
				));
			}
		}
	}
	
/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
