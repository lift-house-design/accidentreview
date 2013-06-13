<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Assignment_update_model extends App_Model
	{
		public $_table='ar_update';
		
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
				'model'=>'user_model',
				'primary_key'=>'user_id',
			),
			'assignment'=>array(
				'model'=>'assignment_model',
				'primary_key'=>'job_id',
			),
		);
		
		protected $return_type='array';
		
		public $after_get=array();
		
		public $before_create=array();
	}