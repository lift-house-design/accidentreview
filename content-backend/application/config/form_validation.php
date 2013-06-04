<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config=array(
	'account/login'=>array(
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
	'account/index'=>array(
		// Account Details
		array(
			'field'=>'first_name',
			'label'=>'First Name',
			'rules'=>'trim|required|max_length[32]',
		),
		array(
			'field'=>'last_name',
			'label'=>'Last Name',
			'rules'=>'trim|max_length[32]',
		),
		array(
			'field'=>'email',
			'label'=>'E-mail Address',
			'rules'=>'trim|required|valid_email|max_length[64]',
		),
		array(
			'field'=>'phone',
			'label'=>'Phone',
			'rules'=>'trim|max_length[14]',
		),
		array(
			'field'=>'mobile',
			'label'=>'Mobile',
			'rules'=>'trim|max_length[14]',
		),
		array(
			'field'=>'fax',
			'label'=>'Fax',
			'rules'=>'trim|max_length[14]',
		),
		array(
			'field'=>'street_address',
			'label'=>'Street Address',
			'rules'=>'trim|max_length[32]',
		),
		array(
			'field'=>'city',
			'label'=>'City',
			'rules'=>'trim|max_length[32]',
		),
		array(
			'field'=>'state',
			'label'=>'State',
			'rules'=>'trim|max_length[2]',
		),
		array(
			'field'=>'zip',
			'label'=>'Zip Code',
			'rules'=>'trim|max_length[10]',
		),
		// Change Password
		array(
			'field'=>'current_password',
			'label'=>'Current Password',
			'rules'=>'trim',
		),
		array(
			'field'=>'new_password',
			'label'=>'New Password',
			'rules'=>'trim',
		),
		array(
			'field'=>'confirm_new_password',
			'label'=>'Confirm New Password',
			'rules'=>'trim',
		),
	),
	'users/edit'=>array(
		// Account Details
		array(
			'field'=>'first_name',
			'label'=>'First Name',
			'rules'=>'trim|required|max_length[32]',
		),
		array(
			'field'=>'last_name',
			'label'=>'Last Name',
			'rules'=>'trim|max_length[32]',
		),
		array(
			'field'=>'email',
			'label'=>'E-mail Address',
			'rules'=>'trim|required|valid_email|max_length[64]',
		),
		array(
			'field'=>'phone',
			'label'=>'Phone',
			'rules'=>'trim|max_length[14]',
		),
		array(
			'field'=>'mobile',
			'label'=>'Mobile',
			'rules'=>'trim|max_length[14]',
		),
		array(
			'field'=>'fax',
			'label'=>'Fax',
			'rules'=>'trim|max_length[14]',
		),
		array(
			'field'=>'street_address',
			'label'=>'Street Address',
			'rules'=>'trim|max_length[32]',
		),
		array(
			'field'=>'city',
			'label'=>'City',
			'rules'=>'trim|max_length[32]',
		),
		array(
			'field'=>'state',
			'label'=>'State',
			'rules'=>'trim|max_length[2]',
		),
		array(
			'field'=>'zip',
			'label'=>'Zip Code',
			'rules'=>'trim|max_length[10]',
		),
		// Change Password
		array(
			'field'=>'new_password',
			'label'=>'New Password',
			'rules'=>'trim',
		),
		array(
			'field'=>'confirm_new_password',
			'label'=>'Confirm New Password',
			'rules'=>'trim',
		),
		// Roles
		array(
			'field'=>'is_tech',
			'label'=>'Is Tech',
			'rules'=>'trim',
		),
		array(
			'field'=>'is_admin',
			'label'=>'Is Admin',
			'rules'=>'trim',
		),
	),
	'users/create'=>array(
		// Account Details
		array(
			'field'=>'first_name',
			'label'=>'First Name',
			'rules'=>'trim|required|max_length[32]',
		),
		array(
			'field'=>'last_name',
			'label'=>'Last Name',
			'rules'=>'trim|max_length[32]',
		),
		array(
			'field'=>'email',
			'label'=>'E-mail Address',
			'rules'=>'trim|required|valid_email|max_length[64]',
		),
		array(
			'field'=>'password',
			'label'=>'Password',
			'rules'=>'trim|required',
		),
		array(
			'field'=>'phone',
			'label'=>'Phone',
			'rules'=>'trim|max_length[14]',
		),
		array(
			'field'=>'mobile',
			'label'=>'Mobile',
			'rules'=>'trim|max_length[14]',
		),
		array(
			'field'=>'fax',
			'label'=>'Fax',
			'rules'=>'trim|max_length[14]',
		),
		array(
			'field'=>'street_address',
			'label'=>'Street Address',
			'rules'=>'trim|max_length[32]',
		),
		array(
			'field'=>'city',
			'label'=>'City',
			'rules'=>'trim|max_length[32]',
		),
		array(
			'field'=>'state',
			'label'=>'State',
			'rules'=>'trim|max_length[2]',
		),
		array(
			'field'=>'zip',
			'label'=>'Zip Code',
			'rules'=>'trim|max_length[10]',
		),
		// Roles
		array(
			'field'=>'is_tech',
			'label'=>'Is Tech',
			'rules'=>'trim',
		),
		array(
			'field'=>'is_admin',
			'label'=>'Is Admin',
			'rules'=>'trim',
		),
	),
	'assignments/create_message'=>array(
		array(
			'field'=>'message',
			'label'=>'Message',
			'rules'=>'trim|required',
		),
	),
);
	
/* End of file form_validation.php */
/* Location: ./application/controllers/form_validation.php */