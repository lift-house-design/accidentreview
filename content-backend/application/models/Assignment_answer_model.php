<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Assignment_answer_model extends App_Model
	{
		public $_table='ar_job_answer';
		
		public $protected_attributes=array('id');
		
		public $has_many=array();
		
		public $belongs_to=array(
			'assignment'=>array(
				'model'=>'Assignment_model',
			),
		);
		
		protected $return_type='array';
		
		public $after_get=array();
		
		public $before_create=array();
	}