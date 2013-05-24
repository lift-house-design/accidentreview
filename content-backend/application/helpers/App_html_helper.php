<?php

if(!function_exists('css'))
{
	function css($css)
	{
		$html='';
		
		if(is_array($css))
		{
			foreach($css as $css_file)
				$html.=link_tag(asset($css_file,'css'));
		}
		elseif(!empty($css))
		{
			$html.=link_tag(asset($css,'css'));
		}
		
		return $html;
	}
}

if(!function_exists('js'))
{
	function js($js)
	{
		$html='';
		
		if(is_array($js))
		{
			foreach($js as $js_file)
				$html.='<script src="'.asset($js_file,'js').'"></script>';
		}
		elseif(!empty($js))
		{
			$html.='<script src="'.asset($js,'js').'"></script>';
		}
		
		return $html;
	}
}