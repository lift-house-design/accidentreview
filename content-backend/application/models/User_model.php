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
	}
	
/* End of file User_model.php */
/* Location: ./application/models/User_model.php */