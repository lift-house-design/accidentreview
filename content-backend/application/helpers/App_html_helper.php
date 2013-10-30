<?php

if(!function_exists('css'))
{
	function css($css)
	{
		if(empty($css))
			return '';

		$html = '';
		if(is_array($css))
			foreach($css as $file)
				$html .= '<link href="'.$file.'" rel="stylesheet" type="text/css"/>';
		else
			$html .= '<link href="'.$css.'" rel="stylesheet" type="text/css"/>';
		
		return $html;
	}
}

if(!function_exists('js'))
{
	function js($js)
	{
		if(empty($js))
			return '';

		$html = '';
		if(is_array($js))
			foreach($js as $file)
				$html .= '<script src="'.$file.'"></script>';
		else
			$html .= '<script src="'.$js.'"></script>';
		
		return $html;
	}
}