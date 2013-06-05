<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Vehicle_model extends App_Model
	{
		public $_table='ar_job_vehicle';
		
		public $protected_attributes=array('id');
		
		public $has_many=array(
			'answers'=>array(
				'model'=>'Vehicle_answer_model',
				'primary_key'=>'vehicle_id',
			),
		);
		
		public $belongs_to=array();
		
		protected $return_type='array';
		
		public $after_get=array();
		
		public $before_create=array();
	}
