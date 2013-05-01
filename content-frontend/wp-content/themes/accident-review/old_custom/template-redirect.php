<?php


add_action('template_redirect','accident_template_redirect');

function accident_template_redirect(){
    global $wp,$wpdb;
    
    $current_user = $_SESSION['agent_user_data']['id'];
    
    $activity_s = 'UPDATE acx_users
                   SET last_activity_on = NOW()
                    WHERE id = '.$current_user;
    $activity_q = $wpdb->get_results($activity_s,'ARRAY_A');
    
//    $visit_s = 'SELECT last_activity_on FROM acx_users WHERE id='.$current_user;
//    $visit_q = $wpdb->get_results($visit_s,'ARRAY_A');
//    
//    print_r($visit_q);
//    
//    echo '<br>'.$visit_q[0]['last_activity_on'];

    
    
    if(isset($_POST['submit_login'])){
        $status = accident_login_agent();
        if($status !== false){
        	// @TODO: Change redirect to its permanent location
        	if(isset($_SERVER['HTTP_REFERER']) && preg_match('/\/dev\//',$_SERVER['HTTP_REFERER'],$matches))
				header('Location: /dev/home');
            else
				header('Location: /reps/home');
        } 
    }
    
    if(isset($_GET['do']) && $_GET['do'] == 'logout'){
        $status = accident_logout_agent();
        if($status !== false){
        	// @TODO: Change redirect to its permanent location
        	if(isset($_SERVER['HTTP_REFERER']) && preg_match('/\/dev\//',$_SERVER['HTTP_REFERER'],$matches))
				header('Location: /dev/home');
			else
            	header('Location: /reps/login?do=logoutsuccess');
        }
    }
        
    $agent_pages = array( '/reps', '/case-study' /*For instance...*/ );
    
    foreach($agent_pages as $an_agent_page){
        if(stristr($_SERVER['REQUEST_URI'],$an_agent_page) !== false && stristr($_SERVER['REQUEST_URI'],'login') == false && stristr($_SERVER['REQUEST_URI'],'register') == false){
            if(!isset($_SESSION['agent_user_id'])){
                //session_destroy();
                header('Location: /reps/login');
            } 
        }
    }
    
    if(trim($_SERVER['REQUEST_URI'],'/') == 'reps/request' && (!isset($_GET['type']) || $_GET['type'] == '')) header('Location: /reps/home');   
      
    
}


?>