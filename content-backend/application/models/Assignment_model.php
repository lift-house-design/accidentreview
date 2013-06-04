<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Assignment_model extends App_Model
	{
		public $_table='ar_job';
		
		/*public $validate=array(
			array(
				'field'=>'',
				'label'=>'',
				'rules'=>'required',
			),
		);*/
		
		public $protected_attributes=array('id');
		
		public $has_many=array(
			'answers'=>array(
				'model'=>'Assignment_answer_model',
				'primary_key'=>'job_id',
			),
			'vehicles'=>array(
				'model'=>'Vehicle_model',
				'primary_key'=>'job_id',
			),
			'correspondence'=>array(
				'model'=>'Correspondence_model',
				'primary_key'=>'job_id',
			),
		);
		
		public $belongs_to=array();
		
		protected $return_type='array';
		
		public $after_get=array('after_get');
		
		public $before_create=array('created_at');
		
		protected function after_get($data)
		{
			$data['date_of_loss_displayed']=$data['date_of_loss']=='0000-00-00' ? '' : date('m/d/Y',strtotime($data['date_of_loss']));
			$data['created_at_displayed']=$data['created_at']=='0000-00-00 00:00:00' ? '' : date('Y-m-d H:i:s',strtotime($data['created_at']));
			$data['type_displayed']=$this->get_type($data['type']);
			
			return $data;
		}
		
		public function get_type($type)
		{
			$types=array(
				'vehicle-theft'=>'Vehicle Theft Analysis',
				'accident-reconstruction'=>'Accident Reconstruction',
				'fire-analysis'=>'Fire Analysis',
				'mechanical-analysis'=>'Mechanical Analysis',
				'physical-damage-comparison'=>'Physical Damage Comparison',
				'report-review'=>'Report Review',
				'other'=>'Other',
			);
			
			return isset($types[$type]) ? $types[$type] : 'Unknown';
		}
	}