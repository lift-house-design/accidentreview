<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config=array(
	'site/login'=>array(
		array(
			'field'=>'email',
			'label'=>'E-mail Address',
			'rules'=>'trim|required|valid_email',
		),
		array(
			'field'=>'password',
			'label'=>'Password',
			'rules'=>'trim|required',
		),
	),
);
	
/* End of file form_validation.php */
/* Location: ./application/controllers/form_validation.php */