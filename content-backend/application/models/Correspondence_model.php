<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Correspondence_model extends App_Model
	{
		public $_table='ar_correspondence';
		
		/*public $validate=array(
			array(
				'field'=>'',
				'label'=>'',
				'rules'=>'required',
			),
		);*/
		
		public $protected_attributes=array('id');
		
		public $has_many=array();
		
		public $belongs_to=array(
			'user'=>array(
				'model'=>'User_model',
				'primary_key'=>'from_user_id',
			),
			'assignment'=>array(
				'model'=>'Assignment_model',
				'primary_key'=>'job_id',
			),
		);
		
		protected $return_type='array';
		
		public $after_get=array();
		
		public $before_create=array('created_at');
	}