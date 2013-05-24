<?php

if(!function_exists('config'))
{
	function config($item)
	{
		return get_instance()->config->item($item);
	}
}

if(!function_exists('trace'))
{
	function trace()
	{
		$backtrace=debug_backtrace();
		
		echo '<table width="100%">';
		
		echo '<tr>';
		echo 	'<th>Line No.</th>';
		echo 	'<th>Filename</th>';
		echo 	'<th>Method/Function</th>';
		echo 	'<th>Args</th>';
		echo '</tr>';
		
		foreach($backtrace as $trace)
		{
			echo '<tr>';
			echo 	'<td>'.$trace['line'].'</td>';
			echo 	'<td>'.$trace['file'].'</td>';
			echo 	'<td>'.( isset($trace['class']) ? $trace['class'].'::'.$trace['function'] : $trace['function'] ).'</td>';
			echo 	'<td>'.count($trace['args']).'</td>';
			echo '</tr>';
			
		}
		
		echo '</table>';
	}
}

if(!function_exists('post'))
{
	function post($key=NULL)
	{
		$CI=get_instance();
		
		if(!isset($key))
			return $CI->input->post();
			
		return $CI->input->post($key);
	}
}

if(!function_exists('session'))
{
	function session()
	{
		$args=func_get_args();
		$CI=get_instance();
		
		if(count($args)==0)
			return $CI->session->all_userdata();
		elseif(count($args)==1)
		{
			if(is_array($args[0]))
				return $CI->session->set_userdata($args[0]);
			else
				return $CI->session->userdata($args[0]);
		}
		elseif(count($args)==2)
			return $CI->session->set_userdata($args[0],$args[1]);
	}
}

/* End of file project_helper.php */
/* Location: ./application/helpers/project_helper.php */