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
		
		public $belongs_to=array(
			'rep'=>array(
				'model'=>'User_model',
				'primary_key'=>'client_user_id',
			),
			'tech'=>array(
				'model'=>'User_model',
				'primary_key'=>'tech_user_id',
			),
		);
		
		protected $return_type='array';
		
		public $after_get=array('after_get');
		
		public $before_create=array('created_at');

		public $before_update=array('before_update');

		public $after_update=array('after_update');

		protected $archive_final_report=FALSE;

		protected $old_data;
		
		protected function after_get($data)
		{
			$data['date_of_loss_displayed']=$data['date_of_loss']=='0000-00-00' ? '' : date('m/d/Y',strtotime($data['date_of_loss']));
			$data['created_at_displayed']=$data['created_at']=='0000-00-00 00:00:00' ? '' : date('Y-m-d H:i:s',strtotime($data['created_at']));
			$data['type_displayed']=$this->get_type($data['type']);
			
			return $data;
		}

		protected function before_update($data)
		{
			if(!empty($_POST['save_report']))
			{
				$old_data=$this->get($_POST['assignment_id']);
				$old_final_report=trim(strip_tags($old_data['final_report']));
				$final_report=trim(strip_tags($data['final_report']));
				$this->archive_final_report=( $old_final_report!=$final_report );
			}
			
			return $data;
		}

		protected function after_update($data,$result)
		{
			if($this->archive_final_report)
			{
				$this->_database->insert('ar_final_report_archive',array(
					'user_id'=>$this->user->data['id'],
					'job_id'=>$_POST['assignment_id'],
					'created_at'=>date('Y-m-d H:i:s'),
					'final_report'=>$data[0]['final_report'],
				));

				$this->archive_final_report=FALSE;
			}

			return $data;
		}
		
		public function get_type($type)
		{
			$types=array(
				'vehicle-theft'=>'Vehicle Theft Analysis',
				'accident-reconstruction'=>'Collision Analysis/Reconstruction',
				'fire-analysis'=>'Vehicle Fire Analysis',
				'mechanical-analysis'=>'Mechanical Analysis',
				/*'physical-damage-comparison'=>'Physical Damage Analysis',*/
				'report-review'=>'Report Review',
				'other'=>'Other',
			);
			
			return isset($types[$type]) ? $types[$type] : 'Unknown';
		}

		public function get_make($id)
		{
			require_once('../content-frontend/wp-content/themes/accident-review/custom/vin-functions.php');
			$response=requestDivisions(2000);
			$makes=$response['result'];
			if(isset($makes[$id]))
				return $makes[$id];
			
			return $id;
		}

		public function get_final_report_versions($assignment_id)
		{
			$query=$this->_database
				->order_by('created_at','desc')
				->get_where('ar_final_report_archive',array(
					'job_id'=>$assignment_id,
				));

			$versions=array();

			foreach($query->result_array() as $row)
			{
				$user_query=$this->_database->get_where('ar_user',array(
					'id'=>$row['user_id'],
				),1);
				$user=$user_query->row_array();
				$versions[ $row['id'] ]=date('l, F j, Y, g:ia',strtotime($row['created_at'])).' by '.$user['first_name'].' '.$user['last_name'];
			}

			return $versions;
		}
	}
