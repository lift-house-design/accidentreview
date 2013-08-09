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
		$args=func_get_args();
		$CI=get_instance();
		
		if(count($args)==0)
			return $CI->input->post();
		elseif(count($args)==1)
		{
			if(is_array($args[0]))
			{
				$post=array();
				foreach($args[0] as $key)
					$post[$key]=$CI->input->post($key);
				
				return $post;
			}
			else
				return $CI->input->post($args[0]);
		}
		else
		{
			$post=array();
			foreach($args as $key)
				$post[$key]=$CI->input->post($key);
			
			return $post;
		}
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

if(!function_exists('states_array'))
{
	function states_array($merge_with=array())
	{
		$states_array=array(
			'AL'=>'Alabama',  
			'AK'=>'Alaska',  
			'AZ'=>'Arizona',  
			'AR'=>'Arkansas',  
			'CA'=>'California',  
			'CO'=>'Colorado',  
			'CT'=>'Connecticut',  
			'DE'=>'Delaware',  
			'DC'=>'District Of Columbia',  
			'FL'=>'Florida',  
			'GA'=>'Georgia',  
			'HI'=>'Hawaii',  
			'ID'=>'Idaho',  
			'IL'=>'Illinois',  
			'IN'=>'Indiana',  
			'IA'=>'Iowa',  
			'KS'=>'Kansas',  
			'KY'=>'Kentucky',  
			'LA'=>'Louisiana',  
			'ME'=>'Maine',  
			'MD'=>'Maryland',  
			'MA'=>'Massachusetts',  
			'MI'=>'Michigan',  
			'MN'=>'Minnesota',  
			'MS'=>'Mississippi',  
			'MO'=>'Missouri',  
			'MT'=>'Montana',
			'NE'=>'Nebraska',
			'NV'=>'Nevada',
			'NH'=>'New Hampshire',
			'NJ'=>'New Jersey',
			'NM'=>'New Mexico',
			'NY'=>'New York',
			'NC'=>'North Carolina',
			'ND'=>'North Dakota',
			'OH'=>'Ohio',  
			'OK'=>'Oklahoma',  
			'OR'=>'Oregon',  
			'PA'=>'Pennsylvania',  
			'RI'=>'Rhode Island',  
			'SC'=>'South Carolina',  
			'SD'=>'South Dakota',
			'TN'=>'Tennessee',  
			'TX'=>'Texas',  
			'UT'=>'Utah',  
			'VT'=>'Vermont',  
			'VA'=>'Virginia',  
			'WA'=>'Washington',  
			'WV'=>'West Virginia',  
			'WI'=>'Wisconsin',  
			'WY'=>'Wyoming',
		);
		
		return array_merge($merge_with,$states_array);
	}
}

if(!function_exists('send_email'))
{
	function send_email($template,$data,$to)
	{
		static $email;

		$config=config('email_notifications');
		$CI=get_instance();

		if(isset($email))
		{
			$email->clear();
		}
		else
		{
			$CI->load->library('email');

			// Set a reference to the email library; this will also tell
			// this function to skip initialization on the next call
			$email=$CI->email;

			if(empty($config['templates'][$template]))
				return FALSE;
			if(!empty($config['config']))
				$email->initialize($config['config']);
		}

		$subject=$config['templates'][$template]['subject'];
		$message=$config['templates'][$template]['message'];

		foreach($data as $k=>$v)
		{
			$subject=str_replace('{'.$k.'}',$v,$subject);
			$message=str_replace('{'.$k.'}',$v,$message);
		}

		$email->from($config['sender_email'],$config['sender_name']);
		$email->to($to);
		$email->subject($subject);

		// Embed the message in the template
		$html_body=$CI->load->view('layouts/email',array(
			'message'=>$message,
		),TRUE);

		$email->message($html_body);

		return $email->send();
	}
}

if(!function_exists('get_last_name'))
{
	function get_last_name($name)
	{
		$parts=explode(' ',trim($name));
		if(count($parts)==2)
		{
			return $parts[1];
		}
		else
		{
			return $parts[0];
		}
	}
}

/* End of file project_helper.php */
/* Location: ./application/helpers/project_helper.php */