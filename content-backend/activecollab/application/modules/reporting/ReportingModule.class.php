<?php


class ReportingModule extends Module{
	
	var $name = 'reporting';

	var $version = '0.1';

	function getDisplayName(){
		return lang('Reports');
	}

	function getDescription(){
		return lang('Custom Reports Module');
	}

	function defineHandlers(&$events){
		$events->listen('on_build_menu', 'on_build_menu');
	}

    function defineRoutes(&$router) {
    	$router->map('reports', 'reports', array('controller' => 'reports'));
    	$router->map('report_most_active_customers', 'reports/report_most_active_customers', array('controller' => 'reports', 'action'=> 'report_most_active_customers'));
    	$router->map('report_most_revenue', 'reports/report_most_revenue', array('controller' => 'reports', 'action'=> 'report_most_revenue'));
    	$router->map('report_cases_by_month_week', 'reports/report_cases_by_month_week', array('controller' => 'reports', 'action'=> 'report_cases_by_month_week'));
    	$router->map('report_time_by_investigator', 'reports/report_time_by_investigator', array('controller' => 'reports', 'action'=> 'report_time_by_investigator'));
    	$router->map('report_average_case_time', 'reports/report_average_case_time', array('controller' => 'reports', 'action' => 'report_average_case_time'));
    	$router->map('report_revenue_calculator', 'reports/report_revenue_calculator', array('controller' => 'reports', 'action' => 'report_revenue_calculator'));
    }

}


?>