<?php

	class Reporting extends ApplicationObject{

	function __construct($id = null) {
      $this->setModule(REPORTING_MODULE);
      parent::__construct($id);
    } // __construct
		function getName(){
			return lang('Reporting');
		}

		function get_all_technician_ids(){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$technician_ids = array();

			$user_r = $mysqli->query("SELECT id FROM ". TABLE_PREFIX ."users WHERE role_id = '12'");
			while($user_row = $user_r->fetch_assoc()){
				$technician_ids[] = $user_row['id'];
			}
			$user_r->close();

			return $technician_ids;
		}

		function get_all_user_ids(){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$user_ids = array();

			$user_r = $mysqli->query("SELECT id FROM ". TABLE_PREFIX ."users");
			while($user_row = $user_r->fetch_assoc()){
				$user_ids[] = $user_row['id'];
			}
			$user_r->close();

			return $user_ids;
		}

		function get_user_info($tech_id){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			$tech_r = $mysqli->query("SELECT id, first_name, last_name, email FROM ". TABLE_PREFIX ."users WHERE id='$tech_id'");

			if($tech_r->num_rows > 0){
				$tech_row = $tech_r->fetch_assoc();
				$tech_r->close();
				return $tech_row;
			}
			else{
				$tech_r->close();
				return false;
			}
		}

		function get_all_company_ids(){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$company_ids = array();

			$company_r = $mysqli->query("SELECT id FROM ". TABLE_PREFIX ."companies");
			while($company_row = $company_r->fetch_assoc()){
				$company_ids[] = $company_row['id'];
			}
			$company_r->close();

			return $company_ids;
		}

		function get_company_info($company_id){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			$company_r = $mysqli->query("SELECT * FROM ". TABLE_PREFIX ."companies WHERE id=$company_id");

			if($company_r->num_rows > 0){
				$company_row = $company_r->fetch_assoc();
				$company_r->close();
				return $company_row;
			}
			else{
				$company_r->close();
				return false;
			}
		}

		function get_company_users($company_id){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$user_ids = array();

			$user_r = $mysqli->query("SELECT id FROM ". TABLE_PREFIX ."users WHERE company_id='$company_id'");

			while($user_row = $user_r->fetch_assoc()){
				$user_ids[] = $user_row['id'];
			}

			$user_r->close();

			return $user_ids;
		}

		function get_all_created_tickets_by_user($user_id){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$job_ids = array();
			$date_sel = "";
			if(isset($_SESSION['low_range']) && $_SESSION['low_range'] !== ''){
				$lowmysql =	date("Y-m-d H:i:s", strtotime($_SESSION['low_range']));
				$date_sel .= " AND created_on >= '" . $lowmysql."'";
			}
			
			if(isset($_SESSION['high_range']) && $_SESSION['high_range'] !== ''){
				$highmysql =	date("Y-m-d H:i:s", strtotime($_SESSION['high_range']));
				$date_sel .= " AND created_on <= '" . $highmysql."'";
			}
			
			$job_r = $mysqli->query("SELECT id FROM ". TABLE_PREFIX ."project_objects WHERE created_by_id='$user_id' AND type='Ticket' AND module='tickets'".$date_sel);
			while($job_row = $job_r->fetch_assoc()){
				$job_ids[] = $job_row['id'];
			}

			$job_r->close();

			return $job_ids;
		}

		function get_all_completed_tickets(){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$job_ids = array();

			if(isset($_SESSION['low_range']) && $_SESSION['low_range'] !== ''){
				$lowmysql =	date("Y-m-d H:i:s", strtotime($_SESSION['low_range']));
				$date_sel .= " AND completed_on >= '" . $lowmysql."'";
			}
			
			if(isset($_SESSION['high_range']) && $_SESSION['high_range'] !== ''){
				$highmysql =	date("Y-m-d H:i:s", strtotime($_SESSION['high_range']));
				$date_sel .= " AND completed_on <= '" . $highmysql."'";
			}

			$job_r = $mysqli->query("SELECT id FROM ". TABLE_PREFIX ."project_objects WHERE completed_on IS NOT NULL AND type='Ticket' AND module='tickets'".$date_sel." ORDER BY completed_on DESC");
			while($job_row = $job_r->fetch_assoc()){
				$job_ids[] = $job_row['id'];
			}

			$job_r->close();

			return $job_ids;
		}

		function get_all_completed_tickets_by_created_user($user_id){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$job_ids = array();

			if(isset($_SESSION['low_range']) && $_SESSION['low_range'] !== ''){
				$lowmysql =	date("Y-m-d H:i:s", strtotime($_SESSION['low_range']));
				$date_sel .= " AND completed_on >= '" . $lowmysql."'";
			}
			
			if(isset($_SESSION['high_range']) && $_SESSION['high_range'] !== ''){
				$highmysql =	date("Y-m-d H:i:s", strtotime($_SESSION['high_range']));
				$date_sel .= " AND completed_on <= '" . $highmysql."'";
			}

			$job_r = $mysqli->query("SELECT id FROM ". TABLE_PREFIX ."project_objects WHERE created_by_id='$user_id' AND completed_on IS NOT NULL AND type='Ticket' AND module='tickets'".$date_sel);
			$debug = "SELECT id FROM ". TABLE_PREFIX ."project_objects WHERE created_by_id='$user_id' AND completed_on IS NOT NULL AND type='Ticket' AND module='tickets'".$date_sel;
			if(!$job_r){
				printf("Error: %s\n", $debug);
			}

			while($job_row = $job_r->fetch_assoc()){
				$job_ids[] = $job_row['id'];
			}

			

			$job_r->close();

			return $job_ids;
		}

		function get_company_created_tickets($company_id){
			$job_ids = array();

			$user_ids = Reporting::get_company_users($company_id);

			foreach($user_ids as $a_user){
				$job_ids = array_merge($job_ids, Reporting::get_all_created_tickets_by_user($a_user));
			}

			return $job_ids;
		}

		function get_company_completed_tickets($company_id){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$ticket_ids = array();
			$user_ids = Reporting::get_company_users($company_id);

			if(isset($_SESSION['low_range']) && $_SESSION['low_range'] !== ''){
				$lowmysql =	date("Y-m-d H:i:s", strtotime($_SESSION['low_range']));
				$date_sel .= " AND completed_on >= '" . $lowmysql."'";
			}
			
			if(isset($_SESSION['high_range']) && $_SESSION['high_range'] !== ''){
				$highmysql =	date("Y-m-d H:i:s", strtotime($_SESSION['high_range']));
				$date_sel .= " AND completed_on <= '" . $highmysql."'";
			}

			$ticket_r = $mysqli->query("SELECT id FROM ".TABLE_PREFIX."project_objects WHERE created_by_id IN (".implode(",", $user_ids).") AND completed_on IS NOT NULL AND module='tickets' AND type='Ticket'".$date_sel);
			while($ticket_row = $ticket_r->fetch_assoc()){
				$ticket_ids[] = $ticket_row['id'];
			}
			$ticket_r->close();

			return $ticket_ids;
		}


		function get_all_completed_technician_ticket_ids($tech_id){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$ticket_ids = array();

			if(isset($_SESSION['low_range']) && $_SESSION['low_range'] !== ''){
				$lowmysql =	date("Y-m-d H:i:s", strtotime($_SESSION['low_range']));
				$date_sel .= " AND apo.created_on >= '" . $lowmysql."'";
			}
			
			if(isset($_SESSION['high_range']) && $_SESSION['high_range'] !== ''){
				$highmysql =	date("Y-m-d H:i:s", strtotime($_SESSION['high_range']));
				$date_sel .= " AND apo.created_on <= '" . $highmysql."'";
			}

			$ticket_r = $mysqli->query("SELECT apo.id FROM ". TABLE_PREFIX ."project_objects AS apo LEFT JOIN ". TABLE_PREFIX ."assignments AS aa ON apo.id = aa.object_id WHERE apo.type='Ticket' AND apo.module='tickets' AND aa.user_id = '$tech_id' AND apo.completed_on IS NOT NULL".$date_sel);
			while($ticket_row = $ticket_r->fetch_assoc()){
				$ticket_ids[] = $ticket_row['id'];
			}
			$ticket_r->close();

			return $ticket_ids;
		}

		function get_ticket_completion_time($ticket_id){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			$ticket_r = $mysqli->query("SELECT TIMESTAMPDIFF(MINUTE, created_on, completed_on) AS the_diff FROM ". TABLE_PREFIX ."project_objects WHERE completed_on IS NOT NULL AND id='$ticket_id'");

			if($ticket_r->num_rows > 0){
				$ticket_row = $ticket_r->fetch_assoc();
				$ticket_r->close();
				return $ticket_row['the_diff'];
			}
			else{
				$ticket_r->close();
				return false;
			}
		}

		function get_ticket_info($ticket_id){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			$ticket_r = $mysqli->query("SELECT * FROM ". TABLE_PREFIX ."project_objects WHERE id='$ticket_id'");

			if($ticket_r->num_rows > 0){
				$ticket_row = $ticket_r->fetch_assoc();
				$ticket_r->close();
				return array_merge($ticket_row, array('completed_time' => ceil(Reporting::get_ticket_completion_time($ticket_id) / 60)));
			}
			else{
				return false;
			}
		}

		function get_earliest_company_ticket($ticket_ids){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			$ticket_r = $mysqli->query("SELECT id FROM ". TABLE_PREFIX ."project_objects WHERE created_on IS NOT NULL AND type='Ticket' AND module='tickets' AND id IN (".implode(",", $ticket_ids).") ORDER BY created_on ASC LIMIT 1");

			if($ticket_r->num_rows > 0){
				$ticket_row = $ticket_r->fetch_assoc();
				$ticket_r->close();
				return $ticket_row['id'];
			}
			else{
				return false;
			}
		}

		function get_lastest_company_ticket($ticket_ids){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			$ticket_r = $mysqli->query("SELECT id FROM ". TABLE_PREFIX ."project_objects WHERE created_on IS NOT NULL AND type='Ticket' AND module='tickets' AND id IN (".implode(",", $ticket_ids).") ORDER BY created_on DESC LIMIT 1");

			if($ticket_r->num_rows > 0){
				$ticket_row = $ticket_r->fetch_assoc();
				$ticket_r->close();
				return $ticket_row['id'];
			}
			else{
				return false;
			}
		}

		function get_company_months_active($company_id){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$ticket_ids = Reporting::get_company_created_tickets($company_id);

			$first_ticket = Reporting::get_ticket_info(Reporting::get_earliest_company_ticket($ticket_ids));
			$last_ticket = Reporting::get_ticket_info(Reporting::get_lastest_company_ticket($ticket_ids));

			$timediff_r = $mysqli->query("SELECT TIMESTAMPDIFF(MONTH, '".$first_ticket['created_on']."', NOW()) AS the_diff");
			if($timediff_r->num_rows > 0){
				$timediff_row = $timediff_r->fetch_assoc();
				$timediff_r->close();
				return $timediff_row['the_diff'];
			}
			else{
				$timediff_r->close();
				return false;
			}

		}

		function get_company_weeks_active($company_id){
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$ticket_ids = Reporting::get_company_created_tickets($company_id);

			$first_ticket = Reporting::get_ticket_info(Reporting::get_earliest_company_ticket($ticket_ids));
			$last_ticket = Reporting::get_ticket_info(Reporting::get_lastest_company_ticket($ticket_ids));

			$timediff_r = $mysqli->query("SELECT TIMESTAMPDIFF(WEEK, '".$first_ticket['created_on']."', NOW()) AS the_diff");
			if($timediff_r->num_rows > 0){
				$timediff_row = $timediff_r->fetch_assoc();
				$timediff_r->close();
				return $timediff_row['the_diff'];
			}
			else{
				$timediff_r->close();
				return false;
			}

		}

		function get_ticket_revenue($ticket_id){
			//TODO: Get the actual revenue numbers
			return 199;
		}

		function sum_user_ticket_revenue($user_id){
			$completed_tickets = Reporting::get_all_completed_tickets_by_created_user($user_id);
			$total_revenue = 0;

			foreach($completed_tickets as $a_completed_ticket){
				$total_revenue += Reporting::get_ticket_revenue($a_completed_ticket);
			}

			return $total_revenue;
		}

		function sum_company_ticket_revenue($company_id){
			$user_ids = Reporting::get_company_users($company_id);
			$total_revenue = 0;

			foreach($user_ids as $a_user_id){
				$total_revenue += Reporting::sum_user_ticket_revenue($a_user_id);
			}

			return $total_revenue;
		}

		function get_time_avg($times_arr){
			$sum = array_sum($times_arr);
			$num_times = count($times_arr);

			return ceil(($sum / $num_times) / 60);
		}

		function get_tech_times($tech_id){
			$tickets = Reporting::get_all_completed_technician_ticket_ids($tech_id);
			$times = array();
			foreach($tickets as $a_ticket){
				$times[] = Reporting::get_ticket_completion_time($a_ticket);
			}
			return $times;
		}

		function get_company_times($company_id){
			$tickets = Reporting::get_company_completed_tickets($company_id);
			$times=array();
			foreach($tickets as $a_ticket){
				$times[] = Reporting::get_ticket_completion_time($a_ticket);
			}
			return $times;
		}
		

		function get_tech_avg_time($tech_id){
			$times = Reporting::get_tech_times($tech_id);
			return Reporting::get_time_avg($times);
		}

		function get_company_avg_time($company_id){
			$times = Reporting::get_company_times($company_id);
			return Reporting::get_time_avg($times);
		}

		function get_cases_by_investigator(){
			$return_arr = array();

			$tech_ids = Reporting::get_all_technician_ids();
			foreach($tech_ids as $a_tech_id){
				$tech_info = Reporting::get_user_info($a_tech_id);
				$tickets = Reporting::get_all_completed_technician_ticket_ids($a_tech_id);

				$ticket_arr = array();

				foreach($tickets as $a_ticket){
					$ticket_arr[$a_ticket] = Reporting::get_ticket_info($a_ticket);

				}
				$return_arr[$a_tech_id] = array_merge($tech_info, array("tickets" => count($ticket_arr)));
			}

			return $return_arr;
		}

		function get_time_by_investigator(){
			$return_arr = array();
			$tech_ids = Reporting::get_all_technician_ids();
			foreach($tech_ids as $a_tech_id){
				$return_arr[$a_tech_id] = array_merge(Reporting::get_user_info($a_tech_id), array('total_time' => ceil(array_sum(Reporting::get_tech_times($a_tech_id)) / 60)));
			}

			return $return_arr;
		}

		function get_average_case_time_investigator(){
			$return_arr = array();
			$tech_ids = Reporting::get_all_technician_ids();
			foreach($tech_ids as $a_tech_id){
				$return_arr[$a_tech_id] = array_merge(Reporting::get_user_info($a_tech_id), array('avg_time' => Reporting::get_tech_avg_time($a_tech_id)));
			}

			return $return_arr;
		}

		function get_average_case_time_company(){
			$return_arr = array();
			$company_ids = Reporting::get_all_company_ids();

			foreach($company_ids as $a_company_id){
				$return_arr[$a_company_id] = array_merge(Reporting::get_company_info($a_company_id), array('avg_time' => Reporting::get_company_avg_time($a_company_id)));
			}

			return $return_arr;
		}

		function get_report_revenue_calculator(){

			$retur_arr = array();
			$tech_ids = Reporting::get_all_technician_ids();
			foreach($tech_ids as $a_tech_id){
				$tech_info = Reporting::get_user_info($a_tech_id);
				$tickets = Reporting::get_all_completed_technician_ticket_ids($a_tech_id);

				$ticket_arr = array();

				foreach($tickets as $a_ticket){
					$ticket_arr[$a_ticket] = Reporting::get_ticket_info($a_ticket);

				}
				$return_arr[$a_tech_id] = array_merge($tech_info, array("tickets" => count($ticket_arr), "revenue" => count($ticket_arr) * 199));
			}

			return $return_arr;
		}

		function get_report_most_active_company(){
			$return_arr = array();
			$company_ids = Reporting::get_all_company_ids();
			foreach($company_ids as $a_company_id){
				$num_jobs = count(Reporting::get_company_created_tickets($a_company_id));
				if($num_jobs > 0){
					$return_arr[$a_company_id] = array(
						'info' => Reporting::get_company_info($a_company_id),
						'numJobs' => $num_jobs
					);
				}
				
			}

			return $return_arr;
		}

		function get_report_most_active_user(){
			$return_arr = array();
			$user_ids = Reporting::get_all_user_ids();
			foreach($user_ids as $a_user_id){
				$num_jobs = count(Reporting::get_all_created_tickets_by_user($a_user_id));
				if($num_jobs > 0){
					$return_arr[$a_user_id] = array(
						'info' => Reporting::get_user_info($a_user_id),
						'numJobs' => $num_jobs
					);
				}
				
			}

			return $return_arr;
		}

		function get_report_most_revenue(){
			$return_arr = array();
			$company_ids = Reporting::get_all_company_ids();
			foreach($company_ids as $a_company_id){
				$total_company_revenue = Reporting::sum_company_ticket_revenue($a_company_id);
				if($total_company_revenue > 0){
					$return_arr[$a_company_id] = array(
						'info' => Reporting::get_company_info($a_company_id),
						'totalRevenue' => $total_company_revenue
					);
				}
			}

			return $return_arr;
		}

		function get_report_cases_by_date_range(){
			$return_arr = array();
			$company_ids = Reporting::get_all_company_ids();
			foreach($company_ids as $a_company_id){
				$return_arr[$a_company_id] = array(
					'info' => Reporting::get_company_info($a_company_id),
					'cases' => count(Reporting::get_company_created_tickets($a_company_id))
				);
			}

			return $return_arr;
		}

		// function get_report_cases_per_month(){
		// 	$return_arr = array();
		// 	$company_ids = Reporting::get_all_company_ids();
		// 	foreach($company_ids as $a_company_id){
		// 		$num_cases = count(Reporting::get_company_created_tickets($a_company_id));
		// 		$num_months = Reporting::get_company_months_active($a_company_id);
		// 		if($num_cases > 0 && $num_months > 0){
		// 			$return_arr[$a_company_id] = array(
		// 				'info' => Reporting::get_company_info($a_company_id),
		// 				'avg' => ($num_cases/$num_months),
		// 				'cases' => $num_cases,
		// 				'months' => $num_months
		// 			);
		// 		}
		// 	}

		// 	return $return_arr;
		// }
	}

?>