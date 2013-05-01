<?php
class ReportsController extends ApplicationController{
	var $controller_name = 'Reports';

	function __construct($request) {
    parent::__construct($request);

    $this->wireframe->addBreadCrumb(lang('Reports'), assemble_url('reports'));
    $this->wireframe->current_menu_item = 'reporting';

  }

  function index(){
    $status = $this->request->get('status') ? $this->request->get('status') : 'all';
    if(isset($_POST['lowdate'])){
      $_SESSION['low_range'] = $_POST['lowdate'];
      $_SESSION['high_range'] = $_POST['highdate'];
    }

    $data = array();

    switch($status){
      case 'avg_low':

        break;
      case 'avg_high':

        break;
      default:
        $data = Reporting::get_cases_by_investigator();
    }
    $this->smarty->assign(array(
      'techs' => $data,
      'status' => $status,
      'low' => $_SESSION['low_range'],
      'high' => $_SESSION['high_range']
    ));
  }

  function report_time_by_investigator(){
    if(isset($_POST['lowdate'])){
      $_SESSION['low_range'] = $_POST['lowdate'];
      $_SESSION['high_range'] = $_POST['highdate'];
    }
  	$this->smarty->assign(array('techs' => Reporting::get_time_by_investigator(),
      'low' => $_SESSION['low_range'],
      'high' => $_SESSION['high_range']));
  }

  function report_average_case_time(){
    $status = $this->request->get('status') ? $this->request->get('status') : 'Investigator';
    if(isset($_POST['lowdate'])){
      $_SESSION['low_range'] = $_POST['lowdate'];
      $_SESSION['high_range'] = $_POST['highdate'];
    }

    switch($status){
      case 'Company':
        $data = Reporting::get_average_case_time_company();
        break;
      default:
        $data = Reporting::get_average_case_time_investigator();
    }

  	$this->smarty->assign(array('data' => $data,
      'status' => $status,
      'low' => $_SESSION['low_range'],
      'high' => $_SESSION['high_range']));
  }

  function report_revenue_calculator(){
    if(isset($_POST['lowdate'])){
      $_SESSION['low_range'] = $_POST['lowdate'];
      $_SESSION['high_range'] = $_POST['highdate'];
    }
  	$this->smarty->assign(array('data' => Reporting::get_report_revenue_calculator(),
      'low' => $_SESSION['low_range'],
      'high' => $_SESSION['high_range']));
  }

  function report_most_active_customers(){
    $status = $this->request->get('status') ? $this->request->get('status') : 'siu';
    $data = array();
    if(isset($_POST['lowdate'])){
      $_SESSION['low_range'] = $_POST['lowdate'];
      $_SESSION['high_range'] = $_POST['highdate'];
    }

    switch($status){
      case 'company':
        //Display Cases by Company
        $data = Reporting::get_report_most_active_company();
        break;
      default:
        //display cases by SIU
        $data = Reporting::get_report_most_active_user();
    }
    $this->smarty->assign(array(
      'data' => $data,
      'status' => $status,
      'low' => $_SESSION['low_range'],
      'high' => $_SESSION['high_range']
    ));
  }

  function report_most_revenue(){
    if(isset($_POST['lowdate'])){
      $_SESSION['low_range'] = $_POST['lowdate'];
      $_SESSION['high_range'] = $_POST['highdate'];
    }
    $this->smarty->assign(array(
      'data' => Reporting::get_report_most_revenue(),
      'low' => $_SESSION['low_range'],
      'high' => $_SESSION['high_range']
    ));
  }

  function report_cases_by_month_week(){
    $status = $this->request->get('status') ? $this->request->get('status') : 'Month';

    $data = array();
    if(isset($_POST['lowdate'])){
      $_SESSION['low_range'] = $_POST['lowdate'];
      $_SESSION['high_range'] = $_POST['highdate'];
    }

    // switch($status){
    //   case 'Week':
    //     //Display Week Data
    //     $data = Reporting::get_report_cases_per_week();
    //     break;
    //   default:
    //     //Display Month Data
    //     $data = Reporting::get_report_cases_per_month();
    // }

    $data = Reporting::get_report_cases_by_date_range();

    $this->smarty->assign(array(
      'data' => $data,
      'status' => $status,
      'low' => $_SESSION['low_range'],
      'high' => $_SESSION['high_range']
    ));
  }
}

?>