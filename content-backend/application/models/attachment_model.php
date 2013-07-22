<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Attachment_model extends App_Model
	{
		public $_table='ar_attachments';
		
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
		);
		
		protected $return_type='array';
		
		public $after_get=array('after_get');
		
		public $before_create=array();
		
		protected function after_get($data)
		{
			$data['type']=$this->get_type($data['name']);
			
			return $data;
		}
		
		protected function get_type($filename)
		{
			$validTypes=array(
				'img'=>array('jpg','jpeg','gif','png'),
				'word'=>array('doc','docx'),
				'pdf'=>array('pdf'),
				'txt'=>array('txt','rtf'),
			);
			$typeMap=array();
			foreach($validTypes as $class=>$extensions)
				foreach($extensions as $ext)
					$typeMap[$ext]=$class;
					
			$pathinfo=pathinfo($filename);

			if(isset($typeMap[strtolower($pathinfo['extension'])]))
				return $typeMap[strtolower($pathinfo['extension'])];
			else
				return FALSE;
		}
	}