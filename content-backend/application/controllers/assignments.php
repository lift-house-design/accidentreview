<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Assignments extends App_Controller
	{
		protected $models=array('user','assignment');
		
		protected $authenticate=TRUE;
		
		public function index()
		{
			$this->css[]='http://accidentreview.com/wp-content/themes/accident-review/jquery.dataTables.css';
			$this->js[]='http://accidentreview.com/wp-content/themes/accident-review/js/jquery.dataTables.min.js';
			$this->js[]='actions/assignments-index.js';
			
			$assignments=array();
			foreach($this->assignment->get_all() as $assignment)
			{
				if($assignment['type']!==NULL)
					$assignments[]=$assignment;
			}
			
			$this->data['assignments']=$assignments;
		}
	}
	
/* End of file assignments.php */
/* Location: ./application/controllers/assignments.php */