<?php

if (!function_exists('asset'))
{
	function asset($path,$type=FALSE)
	{
		$asset_url=get_instance()->config->item('assets_url');
		return '/'.trim($asset_url,'/').'/'.( empty($type) ? '' : $type.'/' ).$path;
	}
}