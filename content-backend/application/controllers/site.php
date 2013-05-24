<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends App_Controller
{
	public function index()
	{
		var_dump($this->user->get(1));
		$this->layout=false;
	}
}

/* End of file site.php */
/* Location: ./application/controllers/site.php */