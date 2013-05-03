<?php

add_action('wp_ajax_nopriv_agent-file-upload', 'agent_file_upload');
add_action('wp_ajax_agent-file-upload','agent_file_upload');

add_action('wp_ajax_nopriv_agent-file-delete', 'agent_file_delete');
add_action('wp_ajax_agent-file-delete','agent_file_delete');

add_action('wp_ajax_agent-file-info','agent_file_info');
add_action('wp_ajax_nopriv_agent-file-info','agent_file_info');

add_action('wp_ajax_vehicle-vin-decode','vehicle_vin_decode');
add_action('wp_ajax_nopriv_vehicle-vin-decode','vehicle_vin_decode');

add_action('wp_ajax_vehicle-year-list','vehicle_year_list');
add_action('wp_ajax_nopriv_vehicle-year-list','vehicle_year_list');

add_action('wp_ajax_vehicle-make-list','vehicle_make_list');
add_action('wp_ajax_nopriv_vehicle-make-list','vehicle_make_list');

add_action('wp_ajax_vehicle-model-list','vehicle_model_list');
add_action('wp_ajax_nopriv_vehicle-model-list','vehicle_model_list');

// @TODO: This was added for the dev site. Leave here if everything is okay.
add_action('wp_ajax_get-assignment-panel','get_assignment_panel');
add_action('wp_ajax_nopriv_get-assignment-panel','get_assignment_panel');
add_action('wp_ajax_get-new-assignment-panel','get_new_assignment_panel');
add_action('wp_ajax_nopriv_get-new-assignment-panel','get_new_assignment_panel');
add_action('wp_ajax_get-vin-data','get_vin_data');
add_action('wp_ajax_nopriv_get-vin-data','get_vin_data');
add_action('wp_ajax_save-new-assignment','save_new_assignment');
add_action('wp_ajax_nopriv_save-new-assignment','save_new_assignment');

/*add_action('wp_ajax_vehicle-test','vehicle_test');
add_action('wp_ajax_nopriv_vehicle-test','vehicle_test');*/

// @TODO: See previous todo
function get_assignment_panel()
{
	global $wpdb;
	
	require('views/assignment_panel.php');
    exit;
}

function get_new_assignment_panel()
{
	$assignment_data=ar_get_assignment_meta();
	$assignment_types=array_keys($assignment_data);
	
	// Set variables for use in the view
	$job_id=ar_get_new_job_id();
	$assignment_type=( empty($_POST['assignment_type']) ? $assignment_types[0] : $_POST['assignment_type']);
	if(!in_array($assignment_type,$assignment_types))
	{
		$assignment_type=$assignment_types[0];
	}
	$job_questions=( empty($assignment_data[$assignment_type]['job_questions']) ? array() : $assignment_data[$assignment_type]['job_questions'] );
	$vehicle_questions=( empty($assignment_data[$assignment_type]['vehicle_questions']) ? array() : $assignment_data[$assignment_type]['vehicle_questions'] );
	$multiple_vehicles=( empty($assignment_data[$assignment_type]['multiple_vehicles']) ? false : true);
	
	require('views/new_assignment_panel.php');
	exit;
}

function save_new_assignment()
{
	$response=array(
		'status'=>'error',
		'error'=>'',
	);
	
	if(empty($_POST['job']) || empty($_POST['vehicles']))
	{
		$response['error']='The required data was not found';
		echo json_encode($response);
		exit;
	}
	
	if(empty($_POST['job']['id']))
	{
		$response['error']='The job ID was not found';
		echo json_encode($response);
		exit;
	}
	
	$job_id=$_POST['job']['id'];
	$job_data=$_POST['job'];
	$vehicles_data=$_POST['vehicles'];
	
	if(($error=ar_save_new_assignment($job_id,$job_data,$vehicles_data))===true)
	{
		$response['status']='success';
	}
	else
	{
		$response['error']=$error;
	}
	
	echo json_encode($response);
	exit;
}

function get_vin_data()
{
	$response=array(
		'status'=>'error',
		'error'=>'',
	);
	
	if(!empty($_POST['vin']))
	{
		$vin=$_POST['vin'];
		if(strlen($vin)==17)
		{
			$vin_object=requestVinInfo($vin,false);
			$vin_data=array();
			convertXmlObjToArr($vin_object,$vin_data);
			
			if($vin_data[0]['@attributes']['responsecode']!='Successful')
			{
				$response['error']=$vehicle_info[0]['@attributes']['Description'];
			}
			else
			{
				$response['status']='success';
				$response['data']=array(
					'year'=>$vin_data[1]['@attributes']['modelyear'],
					'make'=>$vin_data[1]['@attributes']['division'],
					'model'=>$vin_data[1]['@attributes']['modelname'],
					'style'=>$vin_data[1]['@attributes']['stylename'],
				);
			}
		}
		else
		{
			$response['error']='VIN must be 17 characters.';
		}
	}
	else
	{
		$response['error']='VIN was not entered.';
	}
	
	header('Content-Type: text/json');
	echo json_encode($response);
	exit;
}

function agent_file_upload(){
    
    global $wpdb;
    
    $output = array();
    if(!empty($_FILES)){
        $tempPath = $_FILES['file_upload']['tmp_name'];
        $tempSize = $_FILES['file_upload']['size'];
        $tempType = $_FILES['file_upload']['mime_type'];
        $tempName = $_FILES['file_upload']['name'];
        
        $hashName = sha1($tempName.microtime());
        
        $targetPath = dir_name($_SERVER['DOCUMENT_ROOT']).'/content-backend/uploads/'.$hashName;
        
        if(move_uploaded_file($tempPath,$targetPath) !== false){
            
            $ins_s = '
            INSERT INTO acx_attachments 
                (`parent_id`,`parent_type`,`name`,`mime_type`,`size`,`location`,
                `attachment_type`,`created_on`,`created_by_id`,`created_by_name`,
                `created_by_email`) 
            VALUES 
                (\'0\',\'ticket\',\''.$tempName.'\',\''.$tempType.'\',\''.$tempSize.'\',\''.$hashName.'\',
                \'attachment\',\''.date('Y-m-d H:i:s').'\',\''.$_SESSION['agent_user_id'].'\',\''.$_SESSION['agent_user_name'].'\',
                \''.$_SESSION['agent_user_data']['email'].'\')';
            
            $ins_q = $wpdb->get_results($ins_s,'ARRAY_A');
            if($ins_q){
                $output['file_id'] = $file_id = $wpdb->insert_id;
                $output['error'] = '0';
            } else {
                $output['error'] = '1';
            }
        } else {
            $output['error'] = '1';
        }
    } else {
        $output['error'] = '1';
    }
    
    header('Content-Type: text/json');
	echo json_encode($output);
    die();
}

function agent_file_delete(){
    global $wpdb;
    $output = array();
    $del_s = 'DELETE FROM acx_attachments WHERE id=\''.$_POST['attid'].'\'';
    $del_q = $wpdb->get_results($del_s,'ARRAY_A');
    if($del_q !== false) $output['success'] = 1;
    else $output['success'] = 0;
    
    header('Content-Type: text/json');
	echo json_encode($output);
    die();
    
}

function agent_file_info(){
    global $wpdb;
    $output = array();
    $info_s = 'SELECT * FROM acx_attachments WHERE id=\''.$_POST['attid'].'\'';
    $output['query'] = $info_s;
    $info_q = $wpdb->get_results($info_s,'ARRAY_A');
    $output['result'] = $info_q;
    if($info_q != false && count($info_q) > 0){
        $output['name'] = $info_q[0]['name'];
        $output['size'] = format_bytes($info_q[0]['size']);
        $output['location'] = $info_q[0]['location'];
        $output['success'] = 1;
    } else {
        $output['success'] = 0;
    }
    
    header('Content-Type: text/json');
	echo json_encode($output);
    die();
}

function vehicle_vin_decode(){
    
    $output = array();

    $output['talkback'] = array();
    
    $output['talkback']['vin'] = $the_vin = $_POST['vin'];
    $output['talkback']['job_id'] = $the_job = $_POST['job_id'];
    $output['talkback']['claimant'] = $the_claimant = $_POST['claimant'];
    
    $output['talkback']['trim'] = $the_trim = (isset($_POST['trim']) && $_POST['trim'] != '') ? $_POST['trim'] : '';
    $output['talkback']['model'] = $the_model = (isset($_POST['model']) && $_POST['model'] != '') ? $_POST['model'] : '';
    $output['talkback']['wheel'] = $the_wheel_base = (isset($_POST['wheel']) && $_POST['wheel'] != '') ? $_POST['wheel'] : '';
    $output['talkback']['option'] = $the_options = (isset($_POST['options']) && $_POST['options'] != '') ? $_POST['options'] : '';
    $output['talkback']['equipment'] = $the_equipment = (isset($_POST['equipment']) && $_POST['equipment'] != '') ? $_POST['equipment'] : '';
    $output['talkback']['color'] = $the_color = (isset($_POST['color']) && $_POST['color'] != '') ? $_POST['color'] : '';

    // $vehicle_info = request_decoded_vin($the_vin,true,$the_trim,$the_model,$the_wheel_base,$the_options,$the_equipment, $the_color);
    
    $vin_info = requestVinInfo($the_vin,false);


    $results = array();

    convertXmlObjToArr($vin_info, $results);

    $vehicle_info = $results;

    $output['talkback']['vehicle_info'] = $vehicle_info;

    if($vehicle_info[0]['@attributes']['responsecode'] != 'Successful'){
        $output['success'] = false;
        $output['error_message'] = 'here is the problem:'.$vehicle_info[0]['@attributes']['Description'];
        // die(print_r($vehicle_info,true));
    } else {
        $output['success'] = true;
        
        store_vin_data_ajax($the_job,$the_claimant,$vehicle_info);
        
        $output['results'] = array(
            'year' => $vehicle_info[1]['@attributes']['modelyear'],
            'make' => $vehicle_info[1]['@attributes']['division'],
            'model' => $vehicle_info[1]['@attributes']['modelname'],
            'style' => $vehicle_info[1]['@attributes']['stylename']
        );
    }


    header('Content-Type: text/json');
	echo json_encode($output);
    die();
}

function store_vin_data_ajax($job_id,$claimant,$vehicle_data){
    global $wpdb;
    $upd_s = 'UPDATE `job` SET `claimant_'.$claimant.'_vin_data`=\''.json_encode($vehicle_data).'\' WHERE `id`=\''.$job_id.'\'';
    $upd_q = $wpdb->get_results($upd_s,'ARRAY_A');
    if($upd_q !== false) return true;
    else return false;
}

function convertXmlObjToArr($obj, &$arr) 
{ 
    $children = $obj->children(); 
    foreach ($children as $elementName => $node) 
    { 
        $nextIdx = count($arr); 
        $arr[$nextIdx] = array(); 
        $arr[$nextIdx]['@name'] = strtolower((string)$elementName); 
        $arr[$nextIdx]['@attributes'] = array(); 
        $attributes = $node->attributes(); 
        foreach ($attributes as $attributeName => $attributeValue) 
        { 
            $attribName = strtolower(trim((string)$attributeName)); 
            $attribVal = trim((string)$attributeValue); 
            $arr[$nextIdx]['@attributes'][$attribName] = $attribVal; 
        } 
        $text = (string)$node; 
        $text = trim($text); 
        if (strlen($text) > 0) 
        { 
            $arr[$nextIdx]['@text'] = $text; 
        } 
        $arr[$nextIdx]['@children'] = array(); 
        convertXmlObjToArr($node, $arr[$nextIdx]['@children']); 
    } 
    return; 
}

function vehicle_year_list()
{
	$output = requestModelYears();
	header('Content-Type: text/json');
	echo json_encode($output);
	die();
}

function vehicle_make_list()
{
	$output = requestDivisions(intval($_POST['year']));
	header('Content-Type: text/json');
	echo json_encode($output);
	die();
}

function vehicle_model_list()
{
	$output = requestModels(intval($_POST['year']), intval($_POST['make']));
	header('Content-Type: text/json');
	echo json_encode($output);
	die();
}
?>