<?php

  // We need projects controller
  use_controller('project', SYSTEM_MODULE);

  /**
   * Tickets controller
   *
   * @package activeCollab.modules.tickets
   * @subpackage controllers
   */
  class TicketsController extends ProjectController {
    
    /**
     * Active module
     *
     * @var string
     */
    var $active_module = TICKETS_MODULE;
    
    /**
     * Active ticket
     *
     * @var Ticket
     */
    var $active_ticket;
    
    /**
     * Enable categories support for this controller
     *
     * @var boolean
     */
    var $enable_categories = true;
    
    /**
     * Actions that are exposed through API
     *
     * @var array
     */
    var $api_actions = array('index', 'archive', 'view', 'add', 'edit', 'categories');
  
    /**
     * Constructor
     *
     * @param Request $request
     * @return TicketsController
     */
    function __construct($request) {
      parent::__construct($request);
      
      if($this->logged_user->getProjectPermission('ticket', $this->active_project) < PROJECT_PERMISSION_ACCESS) {
        $this->httpError(HTTP_ERR_FORBIDDEN);
      } // if
      
      $tickets_url = tickets_module_url($this->active_project);
      $archive_url = assemble_url('project_tickets_archive', array('project_id' => $this->active_project->getId()));
      
      $this->wireframe->addBreadCrumb(lang('Tickets'), $tickets_url);
      
      $add_ticket_url = false;
      if(Ticket::canAdd($this->logged_user, $this->active_project)) {
        $params = null;
        if($this->active_category->isLoaded()) {
          $params = array('category_id' => $this->active_category->getId());
        } // if
        $add_ticket_url = tickets_module_add_ticket_url($this->active_project, $params);
        
        $this->wireframe->addPageAction(lang('New Ticket'), $add_ticket_url);
      } // if
      
      $ticket_id = $this->request->getId('ticket_id');
      if($ticket_id) {
        $this->active_ticket = Tickets::findByTicketId($this->active_project, $ticket_id);
      } // if
      
      if(instance_of($this->active_category, 'Category') && $this->active_category->isLoaded()) {
        $this->wireframe->addBreadCrumb($this->active_category->getName(), $this->active_category->getViewUrl());
      } // if
      
      if(instance_of($this->active_ticket, 'Ticket')) {
        if($this->active_ticket->isCompleted()) {
          $this->wireframe->addBreadCrumb(lang('Archive'), $archive_url);
        } // if
        $this->wireframe->addBreadCrumb($this->active_ticket->getName(), $this->active_ticket->getViewUrl());
      } else {
        $this->active_ticket = new Ticket();
      } // if
      
      $this->smarty->assign(array(
        'tickets_url'           => $tickets_url,
        'tickets_archive_url'   => $archive_url,
        'add_ticket_url'        => $add_ticket_url,
        'active_ticket'         => $this->active_ticket,
        'page_tab'              => 'tickets',
        'mass_edit_tickets_url' => assemble_url('project_tickets_mass_edit', array('project_id' => $this->active_project->getId())),
      ));
    } // __construct
    
    /**
     * Show tickets index page
     *
     * @param void
     * @return null
     */
    function index() {
      if($this->request->isApiCall()) {
        if($this->active_category->isLoaded()) {
          $this->serveData(Tickets::findOpenByCategory($this->active_category, STATE_VISIBLE, $this->logged_user->getVisibility()), 'tickets');
        } else {
          $this->serveData(Tickets::findOpenByProject($this->active_project, STATE_VISIBLE, $this->logged_user->getVisibility()), 'tickets');
        } // if
      } else {
        if($this->active_category->isLoaded()) {
          $tickets = Milestones::groupByMilestone(
            Tickets::findOpenByCategory($this->active_category, STATE_VISIBLE, $this->logged_user->getVisibility()), 
            STATE_VISIBLE, $this->logged_user->getVisibility()
          );
        } else {
          $tickets = Milestones::groupByMilestone(
            Tickets::findOpenByProject($this->active_project, STATE_VISIBLE, $this->logged_user->getVisibility()), 
            STATE_VISIBLE, $this->logged_user->getVisibility()
          );
        } // if
        
        $this->smarty->assign(array(
          'categories' => Categories::findByModuleSection($this->active_project, TICKETS_MODULE, 'tickets'),
          'groupped_tickets' => $tickets,
          'milestones' => Milestones::findActiveByProject($this->active_project, STATE_VISIBLE, $this->logged_user->getVisibility()),
          'can_add_ticket' => Ticket::canAdd($this->logged_user, $this->active_project),
          'can_manage_categories' => $this->logged_user->isProjectLeader($this->active_project) || $this->logged_user->isProjectManager(), 
        ));
        
        js_assign('can_manage_tickets', Ticket::canManage($this->logged_user, $this->active_project));
      } // if
    } // index
    
    /**
     * Override view category page
     *
     * @param void
     * @return null
     */
    function view_category() {
      $this->redirectTo('project_tickets', array(
        'project_id' => $this->active_project->getId(),
        'category_id' => $this->request->getId('category_id')
      ));
    } // view_category
    
    /**
     * Show completed tickets
     *
     * @param void
     * @return null
     */
    function archive() {
      if($this->request->isApiCall()) {
        $this->serveData(Tickets::findCompletedByProject($this->active_project, STATE_VISIBLE, $this->logged_user->getVisibility()), 'tickets');
      } else {
        $this->wireframe->addBreadCrumb(lang('Archive'), assemble_url('project_tickets_archive', array('project_id' => $this->active_project->getId())));
      
        $per_page = 50;
        $page = (integer) $this->request->get('page');
        if($page < 1) {
          $page = 1;
        } // if
        
        if($this->active_category->isLoaded()) {
          list($tickets, $pagination) = Tickets::paginateCompletedByCategory($this->active_category, $page, $per_page, STATE_VISIBLE, $this->logged_user->getVisibility());
        } else {
          list($tickets, $pagination) = Tickets::paginateCompletedByProject($this->active_project, $page, $per_page, STATE_VISIBLE, $this->logged_user->getVisibility());
        } // if
        
        $this->smarty->assign(array(
          'tickets' => $tickets,
          'pagination' => $pagination,
          'categories' => Categories::findByModuleSection($this->active_project, TICKETS_MODULE, 'tickets'),
        ));
      } // if
    } // archive
    
    /**
     * Show single ticket
     *
     * @param void
     * @return null
     */
    function view() {
      if($this->active_ticket->isNew()) {
        $this->httpError(HTTP_ERR_NOT_FOUND);
      } // if
      
      if(!$this->active_ticket->canView($this->logged_user)) {
        $this->httpError(HTTP_ERR_FORBIDDEN);
      } // if
      
      if($this->request->isAsyncCall()){
        $vin_decode_post_var = $this->request->post('vindecode');
        if($vin_decode_post_var !== null && $vin_decode_post_var == 1){
            $success = self::accident_decode_vin($this->request->post('claimant'));
            
            $output = array();
            
            if($success !== false){
                $output['success'] = true;
                
                
                
                
            } else $output['success'] = false;
            
            $this->serveData(json_encode($output),'null','null','FORMAT_JSON');
            
        }
        
      } elseif($this->request->isApiCall()) {
        $this->serveData($this->active_ticket, 'ticket', array(
          'describe_comments'    => true, 
          'describe_tasks'       => true, 
          'describe_attachments' => true,
          'describe_assignees'   => true,
        ));
      } else {
        ProjectObjectViews::log($this->active_ticket, $this->logged_user);
        
        $page = (integer) $this->request->get('page');
        if($page < 1) {
          $page = 1;
        } // if
        
        list($comments, $pagination) = $this->active_ticket->paginateComments($page, $this->active_ticket->comments_per_page, $this->logged_user->getVisibility());
        
        $this->smarty->assign('insert_sql',$_SESSION['job_insert_sql']);
        $this->smarty->assign('update_sql',$_SESSION['job_update_sql']);
        $this->smarty->assign('available_post',print_r($_SESSION['job_available_post'],true));
        $this->smarty->assign('job_values',print_r($_SESSION['job_values'],true));
        
        $dbh = mysql_connect(DB_HOST,DB_USER,DB_PASS,true);
        mysql_select_db(DB_NAME);
        
        $find_s = 'SELECT id FROM acx_project_objects WHERE parent_id=\''.$this->active_ticket->getId().'\' AND type=\'Discussion\'';
        $find_q = mysql_query($find_s,$dbh);
        if($find_q !== false){
            $row = mysql_fetch_assoc($find_q);
            $this->smarty->assign('collection_id',$row['id']);
            $this->smarty->assign('project_id',$this->active_project->getId());
            $this->smarty->assign('collection_found',true);
        } else {
            $this->smarty->assign('collection_found',false);
        }
                
        $this->smarty->assign(array(
          'comments' => $comments,
          'pagination' => $pagination,
          'counter' => ($page - 1) * $this->active_ticket->comments_per_page,
        ));
      } // if
    } // view
    
    
    function accident_compile_vin_values(){
        $output = array(
            'claimant_a' => array(),
            'claimant_b' => array(),
            'claimant_c' => array(),
        );
        
        $the_data = $this->active_ticket->get_ticket_accident_data(array(
            'claimant_a_vin', 'claimant_a_vin_data',
            'claimant_b_vin', 'claimant_b_vin_data',
            'claimant_c_vin', 'claimant_c_vin_data'
        ));
        
        $desired_category_ids = array(1052, 1066, 1013, 1062, 1063, 1212, 1221, 1229, 1104);
                
        if(!isset($the_data['claimant_a_vin_data']) || $the_data['claimaint_a_vin_data'] == null || empty($the_data['claimant_a_vin_data'])){
            if(isset($the_data['claimant_a_vin']) && strlen($the_data['claimant_a_vin']) == 17){
                $status = self::accident_decode_vin($the_data['claimant_a_vin']);
                if($status === false) $output['claimant_a'] = false;
                else $the_data['claimant_a_vin_data'] = $this->active_ticket->get_ticket_accident_data('claimant_a_vin_data');
            } else {
                $output['claimant_a'] = false;
            }
        }
        
        if(isset($the_data['claimant_a_vin_data']) && $the_data['claimaint_a_vin_data'] != null && !empty($the_data['claimant_a_vin_data'])){
            foreach($desired_category_ids as $a_category_id){
                $category_oem = '';
                $category_installed = false;
                $category_general = '';
                $category_id = $a_category_id;
                
                foreach($the_data['claimant_a_vin_data']['standards'] as $a_standards_array){
                    if(array_key_exists('addedCategoryIds',$a_standards_array) && is_array($a_standards_array['addedCategoryIds']) && in_array($a_category_id,$a_standards_array['added'])){
                        
                    }
                }
                
                
                $output['claimant_a'][] = array(
                    'id' => $category_id,
                    'general' => $category_general,
                    'oem' => $category_oem,
                    'installed' => $category_installed
                );
                
            }
        }
        
    }
    
    function accident_decode_vin($claimant){
        $column_name = 'claimant_'.$claimant.'_vin';
        $the_vin = $this->active_ticket->get_ticket_accident_data($column_name);
        
        if(strlen($the_vin) != 17){ return false; }
        else {
            $vin_data = TicketsController::accident_vin_decoder($the_vin); 
            $this->active_ticket->set_ticket_accident_data($column_name.'_data',$vin_data);
            if($vin_data['responseStatus']['responseCode'] != 'Successful'){
                return false;
            } else return true;
        }
    }
    
    
    
    public static function accident_vin_decoder($vin){
        
        require_once($_SERVER['DOCUMENT_ROOT'].'/hollislib/nusoap.php');
        require_once($_SERVER['DOCUMENT_ROOT'].'/hollislib/class.wsdlcache.php');
       	
        function fixArray($possibleArray) {
    		if( !is_array($possibleArray[0]) ){
    			// make single element array
    			$possibleArray = array($possibleArray);
    		}
    		return $possibleArray;
    	}
        
        // Begin code for ADS 6 request using nusoap
    	$wsdlURL ="http://platform.chrome.com/AutomotiveDescriptionService/AutomotiveDescriptionService6?WSDL";
    	$namespace="urn:description6.kp.chrome.com";
    
    	$cache = new wsdlcache();
    	$wsdl = $cache->get($wsdlURL);
    	if ($wsdl == null) {
    		$wsdl = new wsdl($wsdlURL);
    		$cache->put($wsdl);
    	}
    
    	$client = new soapclient($wsdl, true);

        $locale = array(
    		"country" => "US",
    		"language" => "en"
    	);
    	$accountInfo = array(
    	    "accountNumber" => "284618",
    	    "accountSecret" => "5b8a96fe1fb54775",
    		"locale" => $locale
    	);
        
        // Get data version --displayed in html title
    	$version = "";
    	$dataVersionsRequest = array(
    		"accountInfo" => $accountInfo
    	);
    	$dataVersions = $client->call("getDataVersions", array("request" => $dataVersionsRequest), $namespace, "", false, null, "document", "literal");
    	$dataVersions = fixArray($dataVersions["dataVersion"]);
    	for ($i = 0; $i < count($dataVersions); $i++ ) {
    		$dataVersion = $dataVersions[$i];
    		if ($dataVersion["country"] == "US") {
    			$version = $dataVersion["country"] . " " . $dataVersion["build"] . " (" . $dataVersion["date"] . ")";
    		}
    	}
        
        $returnParameters = array(
    		"useSafeStandards" => true,
    		"excludeFleetOnlyStyles" => false,
    		"includeAvailableEquipment" => true,
    		"includeExtendedDescriptions" => true,
    		"includeExtendedTechnicalSpecifications" => true,
    		"includeRegionSpecificStyles" => true,
    		"includeConsumerInformation" => true,
    		"enableEnrichedVehicleEquipment" => false
    	);
    	$vinRequest = array(
    		"accountInfo" => $accountInfo,
    		"vin" => $vin,
    		"manufacturerModelCode" => "",
    		"trimName" => "",
    		"wheelBase" => 0,
    		"manufacturerOptionCodes" => array(),
    		"equipmentDescriptions" => array(),
    		"exteriorColorName" => "",
    		"returnParameters" => $returnParameters
    	);
    	
    	$vehicleInfo = $client->call("getVehicleInformationFromVin", array("request" => $vinRequest), $namespace, "", false, null, "document", "literal");
        
        return $vehicleInfo;
    
    }
    
    function accident_vin_translate_response_code($response_code){
        $response_codes = array(
            'Successful' => 'Indicates the request was successful.',
            'SuccessfulUsing AlternateLocale' => 'Indicates that the request was successful using a fallback country. The VIN was not available in the Locale requested.',
            'SuccessfulUsing AlternateVIN' => 'The VIN provided was invalid. Chrome applied permutations to the given VIN, which allowed Chrome to match the VIN to a valid alternate VIN. The vehicle was reconciled based on the alternate VIN.',
            'InvalidVinCheck' => 'Digit The VIN failed the check digit.',
            'InvalidVinLength' => 'The VIN has an invalid length.',
            'InvalidVin Character' => 'The VIN contains characters that are not valid for a VIN (e.g. "O", "I").',
            'VinNotCarriedBy Chrome' => 'The VIN is not carried by Chrome. This will include the manufacturer based on the WMI code.',
            'VinNotCarriedBy Chrome See Alternates' => 'The VIN provided was not reconciled by the service. Chrome applied permutations to the given VIN, which allowed Chrome to match the VIN to two or more valid alternate VINs. Refer to any Alternate VINs returned by the ResponseStatus.',
            'ValidationMismatch' => 'For VIN validation, this indicates that there was a validation mismatch.',
            'NameMatchNot Found' => 'For style name matching without a VIN, this indicates that a match was not found based on the information provided.'
        );
        
        if(array_key_exists($response_code,$response_codes)) return $response_codes[$response_code];
        else return 'Unknown Response Code';
    }
    
    function accident_job_name(){
        $dbh = mysql_connect(DB_HOST,DB_USER,DB_PASS,true);
        mysql_select_db(DB_NAME);
        $data = $this->active_ticket->get_ticket_accident_data();
        $user = new User($this->active_ticket->getCreatedById());
        $job_id = $this->active_ticket->get_ticket_accident_job_id();
        return $data['client_file_id'].' -- '.$user->getLastName().' -- '.date('Y-m-d',strtotime($data['date_of_loss'])).' -- '.$data['job_type'].' -- '.$job_id;
    }
    
    function accident_update_ticket_name(){
        $this->active_ticket->setName($this->accident_job_name());
        return $this->active_ticket->save();
    }
        
    function accident_job_type($type_id){
        $job_type_name = '';
        switch($type_id){
            case "1": $job_type_name = 'Vehicle Theft Analysis'; break;
            case "2": $job_type_name = 'Accident Reconstruction'; break;
            case "3": $job_type_name = 'Fire Analysis'; break;
            case "4": $job_type_name = 'Mechanical Analysis'; break;
            case "5": $job_type_name = 'Physical Damage Comparison'; break;
            case "6": $job_type_name = 'Report Review'; break;
            case "7": $job_type_name = 'Other'; break;
        }
        return $job_type_name;
    }
    
    function accident_client_users(){
        $dbh = mysql_connect(DB_HOST,DB_USER,DB_PASS,true);
        mysql_select_db(DB_NAME);
        
        $users_out = array();
        
        $find_s = 'SELECT acx_users.*, acx_project_users.role_id as project_role_id FROM acx_project_users
        LEFT JOIN acx_users ON acx_users.id = acx_project_users.user_id
        WHERE acx_project_users.project_id=\''.$this->active_project->getId().'\'
        AND acx_users.company_id=\''.$this->active_project->getCompanyId().'\'';
        $find_q = mysql_query($find_s,$dbh);
        if($find_q && mysql_num_rows($find_q) > 0 ){
            while($row = mysql_fetch_assoc($find_q)){
                $users_out[] = array(
                    'id' => $row['id'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'role_id' => $row['project_role_id'],
                    'email' => $row['email']
                );
            }
        } 
        return $users_out;
    }
    
    function accident_get_discussion($ticket_id=0){
        if($ticket_id == 0) $ticket_id = $this->active_ticket->getId();
        $dbh = mysql_connect(DB_HOST,DB_USER,DB_PASS,true);
        mysql_select_db(DB_NAME);
        
        $find_s = 'SELECT id FROM acx_project_objects WHERE parent_id=\''.$ticket_id.'\' AND type=\'Discussion\'';
        $find_q = mysql_query($find_s,$dbh);
        if($find_q && mysql_num_rows($find_q) > 0){
            $row = mysql_fetch_assoc($find_q);
            return $row['id'];
        } else return false;
    }
    
    function accident_align_discussion_subscriptions($subscribers, $ticket_id){
        $dbh = mysql_connect(DB_HOST,DB_USER,DB_PASS,true);
        mysql_select_db(DB_NAME);
        $discussion_id = $this->accident_get_discussion($ticket_id);
        foreach($subscribers as $a_user_id){
            $check_s = 'SELECT user_id,parent_id FROM acx_subscriptions WHERE user_id=\''.$a_user_id.'\' AND parent_id=\''.$discussion_id.'\'';
            $check_q = mysql_query($check_s,$dbh);
            if(mysql_num_rows($check_q) == 0){
                $ins_s = 'INSERT INTO acx_subscriptions (`user_id`,`parent_id`) VALUES (\''.$a_user_id.'\',\''.$discussion_id.'\')';
                $ins_q = mysql_query($ins_s);
            }
        }
    }
    
    function accident_job_save(){
        $dbh = mysql_connect(DB_HOST,DB_USER,DB_PASS,true);
        mysql_select_db(DB_NAME);
        
        
        $values = array(
            'date_of_loss'                          => isset($_POST['date_of_loss'])                    ? mysql_real_escape_string($_POST['date_of_loss'],$dbh) : '',
            'date_of_recovery'                      => isset($_POST['date_of_recovery'])                ? mysql_real_escape_string($_POST['date_of_recovery'],$dbh) : '',
            'loss_description'                      => isset($_POST['loss_description'])                ? mysql_real_escape_string($_POST['loss_description'],$dbh) : '',
            'location_of_loss'                      => isset($_POST['location_of_loss'])                ? mysql_real_escape_string($_POST['location_of_loss'],$dbh) : '',
            'services_requested'                    => isset($_POST['services_requested'])              ? mysql_real_escape_string($_POST['services_requested'],$dbh) : '',
            'job_type'                              => isset($_POST['job_type'])                        ? $this->accident_job_type($_POST['job_type']) : '',
            'claimant_a_owner_name'                 => isset($_POST['claimant_a_owner_name'])           ? mysql_real_escape_string($_POST['claimant_a_owner_name']) : '',
            'claimant_a_owner_type'                 => isset($_POST['claimant_a_owner_type'])           ? mysql_real_escape_string($_POST['claimant_a_owner_type']) : '',
            'claimant_a_year'                       => isset($_POST['claimant_a_year'])                 ? mysql_real_escape_string($_POST['claimant_a_year'],$dbh) : '',
            'claimant_a_make'                       => isset($_POST['claimant_a_make'])                 ? mysql_real_escape_string($_POST['claimant_a_make'],$dbh) : '',
            'claimant_a_model'                      => isset($_POST['claimant_a_model'])                ? mysql_real_escape_string($_POST['claimant_a_model'],$dbh) : '',
            'claimant_a_color'                      => isset($_POST['claimant_a_color'])                ? mysql_real_escape_string($_POST['claimant_a_color'],$dbh) : '',
            'claimant_a_vin'                        => isset($_POST['claimant_a_vin'])                  ? mysql_real_escape_string($_POST['claimant_a_vin'],$dbh) : '',
            'claimant_a_plate'                      => isset($_POST['claimant_a_plate'])                ? mysql_real_escape_string($_POST['claimant_a_plate'],$dbh) : '',
            'claimant_a_aftermarket'                => isset($_POST['claimant_a_aftermarket'])          ? mysql_real_escape_string($_POST['claimant_a_aftermarket'],$dbh) : '',
            'claimant_a_additional'                 => isset($_POST['claimant_a_additional'])           ? mysql_real_escape_string($_POST['claimant_a_additional'],$dbh) : '',
            'vehicle_theft_security_system'         => isset($_POST['vehicle_theft_security'])          ? mysql_real_escape_string($_POST['vehicle_theft_security'],$dbh) : '',
            'vehicle_theft_security_system_after'   => isset($_POST['vehicle_theft_security_after'])    ? mysql_real_escape_string($_POST['vehicle_theft_security_after'],$dbh) : '',
            'vehicle_theft_remote'                  => isset($_POST['vehicle_theft_remote'])            ? mysql_real_escape_string($_POST['vehicle_theft_remote'],$dbh) : '',
            'vehicle_theft_remote_after'            => isset($_POST['vehicle_theft_remote_after'])      ? mysql_real_escape_string($_POST['vehicle_theft_remote_after'],$dbh) : '',
            'claimant_b_owner_name'                 => isset($_POST['claimant_b_owner_name'])           ? mysql_real_escape_string($_POST['claimant_b_owner_name']) : '',
            'claimant_b_owner_type'                 => isset($_POST['claimant_b_owner_type'])           ? mysql_real_escape_string($_POST['claimant_b_owner_type']) : '',
            'claimant_b_year'                       => isset($_POST['claimant_b_year'])                 ? mysql_real_escape_string($_POST['claimant_b_year'],$dbh) : '',
            'claimant_b_make'                       => isset($_POST['claimant_b_make'])                 ? mysql_real_escape_string($_POST['claimant_b_make'],$dbh) : '',
            'claimant_b_model'                      => isset($_POST['claimant_b_model'])                ? mysql_real_escape_string($_POST['claimant_b_model'],$dbh) : '',
            'claimant_b_color'                      => isset($_POST['claimant_b_color'])                ? mysql_real_escape_string($_POST['claimant_b_color'],$dbh) : '',
            'claimant_b_vin'                        => isset($_POST['claimant_b_vin'])                  ? mysql_real_escape_string($_POST['claimant_b_vin'],$dbh) : '',
            'claimant_b_plate'                      => isset($_POST['claimant_b_plate'])                ? mysql_real_escape_string($_POST['claimant_b_plate'],$dbh) : '',
            'claimant_b_aftermarket'                => isset($_POST['claimant_b_aftermarket'])          ? mysql_real_escape_string($_POST['claimant_b_aftermarket'],$dbh) : '',
            'claimant_b_additional'                 => isset($_POST['claimant_b_additional'])           ? mysql_real_escape_string($_POST['claimant_b_additional'],$dbh) : '',
            'claimant_c_owner_name'                 => isset($_POST['claimant_c_owner_name'])           ? mysql_real_escape_string($_POST['claimant_c_owner_name']) : '',
            'claimant_c_owner_type'                 => isset($_POST['claimant_c_owner_type'])           ? mysql_real_escape_string($_POST['claimant_c_owner_type']) : '',
            'claimant_c_year'                       => isset($_POST['claimant_c_year'])                 ? mysql_real_escape_string($_POST['claimant_c_year'],$dbh) : '',
            'claimant_c_make'                       => isset($_POST['claimant_c_make'])                 ? mysql_real_escape_string($_POST['claimant_c_make'],$dbh) : '',
            'claimant_c_model'                      => isset($_POST['claimant_c_model'])                ? mysql_real_escape_string($_POST['claimant_c_model'],$dbh) : '',
            'claimant_c_color'                      => isset($_POST['claimant_c_color'])                ? mysql_real_escape_string($_POST['claimant_c_color'],$dbh) : '',
            'claimant_c_vin'                        => isset($_POST['claimant_c_vin'])                  ? mysql_real_escape_string($_POST['claimant_c_vin'],$dbh) : '',
            'claimant_c_plate'                      => isset($_POST['claimant_c_plate'])                ? mysql_real_escape_string($_POST['claimant_c_plate'],$dbh) : '',
            'claimant_c_aftermarket'                => isset($_POST['claimant_c_aftermarket'])          ? mysql_real_escape_string($_POST['claimant_c_aftermarket'],$dbh) : '',
            'claimant_c_additional'                 => isset($_POST['claimant_c_additional'])           ? mysql_real_escape_string($_POST['claimant_c_additional'],$dbh) : '',
            
        );
        
        
        
        $check_job_id = $this->active_ticket->get_ticket_accident_job_id();
                
        
        if($check_job_id !== false){
            $upd_s = 'UPDATE job SET ';
            $existing_values = $this->active_ticket->get_ticket_accident_data();
            $to_update = array();
            foreach($values as $a_column => $a_value)
                if($a_value != '' && $existing_values[$a_column] != $a_value)
                    $to_update[] = '`'.$a_column.'`=\''.$a_value.'\'';
            
            $upd_s .= implode(', ',$to_update);                
            
            $upd_s .= ' WHERE id=\''.$check_job_id.'\'';
            $upd_q = mysql_query($upd_s,$dbh);
            
            if($upd_q) return true;
            else return false;            
        } else {
            
            $client_users = $this->accident_client_users();
            $resp_client_user = null;
            foreach($client_users as $a_client_user){
                if($a_client_user['id'] == $_POST['responsible_client_user']) $resp_client_user = $a_client_user;
            }
            if($resp_client_user != null){
                $created_id = $resp_client_user['id'];
                $created_name = $resp_client_user['first_name'].' '.$resp_client_user['last_name'];
                $created_email = $resp_client_user['email'];
            }
            
             
                                    
            $ins_value = array(
                'ticket_id' => $this->active_ticket->getId(),
                'client_file_id' => (isset($_POST['client_file_id'])) ? mysql_real_escape_string($_POST['client_file_id'],$dbh) : '',
                'user_id' => $created_id                       
            );
            
            $values = array_merge($ins_value,$values);
            
            
            
            $ins_val_a = array();
            $ins_name_a = array();
            
            foreach($values as $a_column => $a_value){
                $ins_val_a[] = $a_value;
                $ins_name_a[] = $a_column;
            }
            
            $ins_s = 'INSERT INTO job (`'.implode('`, `',$ins_name_a).'`) VALUES (\''.implode('\', \'',$ins_val_a).'\')';
            
            //die($ins_s);
            $ins_q = mysql_query($ins_s,$dbh);
            
            /**
             * Add Discussion for Ticket
             */
             $create_date = new DateValue(time());
             
             $discussion = new Discussion();
             $discussion->setParentId($this->active_ticket->getId());
             $discussion->setParentType('ticket');
             $discussion->setBody("This is a discussion for ticket ".$this->accident_job_name());
             $discussion->setProjectId($this->active_project->getId());
             $discussion->setCreatedOn($create_date);
             $discussion->setCreatedByEmail($created_email);
             $discussion->setCreatedById($created_id);
             $discussion->setCreatedByName($created_name);
             $discussion->setHasTime(0);
             $discussion->setModule('discussions');
             $discussion->setDateField1($create_date);
             $discussion->setBooleanField1(0);
             $discussion->setVersion(1);
             $discussion->setState(3);
             $discussion->setVisibility(1);
             $discussion->setName($this->accident_job_name());
             $discussion->save();

            if($ins_q) return true;
            else return false;
        }
        
    }
    
    /**
     * Create a new ticket
     *
     * @param void
     * @return null
     */
    function add() {
      $this->wireframe->print_button = false;
      
      if($this->request->isApiCall() && !$this->request->isSubmitted()) {
        $this->httpError(HTTP_ERR_BAD_REQUEST);
      } // ifs
      
      if(!Ticket::canAdd($this->logged_user, $this->active_project)) {
        $this->httpError(HTTP_ERR_FORBIDDEN);
      } // if
      
      $ticket_data = $this->request->post('ticket');
      if(!is_array($ticket_data)) {
        $ticket_data = array(
          'visibility'   => $this->active_project->getDefaultVisibility(),
          'milestone_id' => $this->request->get('milestone_id'),
          'parent_id'    => $this->request->get('category_id'),
        );
      } // if
      
      $this->smarty->assign('ticket_data', $ticket_data);
      
      $years = array();
      for($i=date('Y') - 25; $i< date('Y') + 1; $i++) $years[] = $i;
      $this->smarty->assign('valid_years',$years);
      
      $this->smarty->assign('accident_makes',array('Acura', 'American', 'Audi', 'BMW', 'Buick', 'Cadillac', 'Carpenter', 
                                'Chevrolet', 'Chrysler', 'Daewoo', 'Delorean', 'Dodge', 'Eagle', 'Fiat', 
                                'Ford', 'General Motors', 'Geo', 'GMC', 'Honda', 'Hummer', 'Hyundai', 
                                'Infiniti', 'Isuzu', 'Jaguar', 'Jeep', 'Jet', 'Kia', 'Land Rover', 'Lexus', 
                                'Lincoln', 'Mazda', 'Mercedes', 'Mercury', 'Mini', 'Mitsubishi', 'Nissan', 
                                'Oldsmobile', 'Peugeot', 'Plymouth', 'Pontiac', 'Porsche', 'Ram', 'Renault', 
                                'Saab', 'Saturn', 'Scion', 'Smart', 'Solectria', 'Subaru', 'Suzuki', 'Toyota', 
                                'Volkswagen', 'Volvo', 'Other'));
      $client_users = $this->accident_client_users();
      $this->smarty->assign('accident_client_users',$client_users);
      $this->smarty->assign('accident_client_users_string',print_r($client_users,true));
      
      if($this->request->isSubmitted()) {
        db_begin_work();
               
        $this->active_ticket = new Ticket();
        
        attach_from_files($this->active_ticket, $this->logged_user);
        
        $this->active_ticket->setAttributes($ticket_data);
        $this->active_ticket->setProjectId($this->active_project->getId());
        
        if(trim($this->active_ticket->getCreatedByName()) == '' || trim($this->active_ticket->getCreatedByEmail()) == '') {
          $this->active_ticket->setCreatedBy($this->logged_user);
        } // if
        
        $this->active_ticket->setState(STATE_VISIBLE);
        
        $save = $this->active_ticket->save();
        
        if($save && !is_error($save)) {
            
            /**
             * Accident Review Fields
             */
            if(isset($_POST['job_type']) && $_POST['job_type'] !== '0'){
              $this->accident_job_save();
              $this->accident_update_ticket_name();
            }
            
            
            /**
             * END ACCIDENT REVIEW FIELDS
             */
            
          $subscribers = array($this->logged_user->getId());
          if(is_foreachable(array_var($ticket_data['assignees'], 0))) {
            $subscribers = array_merge($subscribers, array_var($ticket_data['assignees'], 0));
          } else {
            $subscribers[] = $this->active_project->getLeaderId();
          } // if
          
          if(!in_array($this->active_project->getLeaderId(), $subscribers)) {
            $subscribers[] = $this->active_project->getLeaderId();
          } // if
          
          Subscriptions::subscribeUsers($subscribers, $this->active_ticket);
          
          $this->accident_align_discussion_subscriptions($subscribers, $this->active_ticket->getId());
          
          db_commit();
          $this->active_ticket->ready();
          
          if($this->request->getFormat() == FORMAT_HTML) {
            flash_success('Ticket #:ticket_id has been added', array('ticket_id' => $this->active_ticket->getTicketId()));
            $this->redirectToUrl($this->active_ticket->getViewUrl());
          } else {
            $this->serveData($this->active_ticket, 'ticket');
          } // if
        } else {
          db_rollback();
          
          if($this->request->getFormat() == FORMAT_HTML) {
            $this->smarty->assign('errors', $save);
          } else {
            $this->serveData($save);
          } // if
        } // if
      } // if
    } // add
    
    /**
     * Quick add ticket
     *
     * @param void
     * @return null
     */
    function quick_add() {
      if(!Ticket::canAdd($this->logged_user, $this->active_project)) {
      	$this->httpError(HTTP_ERR_FORBIDDEN, lang("You don't have permission for this action"), true, true);
      } // if
      
      $this->skip_layout = true;
           
      $ticket_data = $this->request->post('ticket');
      if(!is_array($ticket_data)) {
        $ticket_data = array(
          'visibility'   => $this->active_project->getDefaultVisibility(),
        );
      } // if
      
      $this->smarty->assign(array(
        'ticket_data' => $ticket_data,
        'quick_add_url' => assemble_url('project_tickets_quick_add', array('project_id' => $this->active_project->getId())),
      ));
      
      if ($this->request->isSubmitted()) {
        db_begin_work();
        
        $this->active_ticket = new Ticket();
        
        if (count($_FILES > 0)) {
          attach_from_files($this->active_ticket, $this->logged_user);  
        } // if
        
        $this->active_ticket->setAttributes($ticket_data);
        $this->active_ticket->setBody(clean(array_var($ticket_data, 'body', null)));
        if(!isset($ticket_data['priority'])) {
          $this->active_ticket->setPriority(PRIORITY_NORMAL);
        } // if
        $this->active_ticket->setProjectId($this->active_project->getId());
        $this->active_ticket->setCreatedBy($this->logged_user);
        $this->active_ticket->setState(STATE_VISIBLE);
        
        $save = $this->active_ticket->save();
        if($save && !is_error($save)) {
          $subscribers = array($this->logged_user->getId());
          if(is_foreachable(array_var($ticket_data['assignees'], 0))) {
            $subscribers = array_merge($subscribers, array_var($ticket_data['assignees'], 0));
          } else {
            $subscribers[] = $this->active_project->getLeaderId();
          } // if
          Subscriptions::subscribeUsers($subscribers, $this->active_ticket);
          
          db_commit();
          $this->active_ticket->ready(); // ready
          
          $this->smarty->assign(array(
            'ticket_data' => array('visibility' => $this->active_project->getDefaultVisibility()),
            'active_ticket' => $this->active_ticket,
            'project_id' => $this->active_project->getId()
          ));
          $this->skip_layout = true;
        } else {
          db_rollback();
          $this->httpError(HTTP_ERR_OPERATION_FAILED, $save->getErrorsAsString(), true, true);
        } // if
      } // if
    } // quick_add
    
    /**
     * Update existing ticket
     *
     * @param void
     * @return null
     */
    function edit() {
      $this->wireframe->print_button = false;
      
      if($this->request->isApiCall() && !$this->request->isSubmitted()) {
        $this->httpError(HTTP_ERR_BAD_REQUEST);
      } // ifs
      
      if($this->active_ticket->isNew()) {
        $this->httpError(HTTP_ERR_NOT_FOUND);
      } // if
      
      if(!$this->active_ticket->canEdit($this->logged_user)) {
        $this->httpError(HTTP_ERR_FORBIDDEN);
      } // if
      
      $ticket_data = $this->request->post('ticket');
      if(!is_array($ticket_data)) {
        $ticket_data = array(
          'name' => $this->active_ticket->getName(),
          'body' => $this->active_ticket->getBody(),
          'visibility' => $this->active_ticket->getVisibility(),
          'parent_id' => $this->active_ticket->getParentId(),
          'milestone_id' => $this->active_ticket->getMilestoneId(),
          'priority' => $this->active_ticket->getPriority(),
          'assignees' => Assignments::findAssignmentDataByObject($this->active_ticket),
          'tags' => $this->active_ticket->getTags(),
          'due_on' => $this->active_ticket->getDueOn(),
          'accident' => $this->active_ticket->get_ticket_accident_data()
        );
      } // if
      $this->smarty->assign('ticket_data', $ticket_data);
      
      $years = array();
      for($i=date('Y') - 25; $i< date('Y') + 1; $i++) $years[] = $i;
      $this->smarty->assign('valid_years',$years);
      
      $this->smarty->assign('update_sql',$_SESSION['job_update_sql']);
      $this->smarty->assign('insert_sql',$_SESSION['job_insert_sql']);
      
      $this->smarty->assign('accident_makes',array('Acura', 'American', 'Audi', 'BMW', 'Buick', 'Cadillac', 'Carpenter', 
                                'Chevrolet', 'Chrysler', 'Daewoo', 'Delorean', 'Dodge', 'Eagle', 'Fiat', 
                                'Ford', 'General Motors', 'Geo', 'GMC', 'Honda', 'Hummer', 'Hyundai', 
                                'Infiniti', 'Isuzu', 'Jaguar', 'Jeep', 'Jet', 'Kia', 'Land Rover', 'Lexus', 
                                'Lincoln', 'Mazda', 'Mercedes', 'Mercury', 'Mini', 'Mitsubishi', 'Nissan', 
                                'Oldsmobile', 'Peugeot', 'Plymouth', 'Pontiac', 'Porsche', 'Ram', 'Renault', 
                                'Saab', 'Saturn', 'Scion', 'Smart', 'Solectria', 'Subaru', 'Suzuki', 'Toyota', 
                                'Volkswagen', 'Volvo', 'Other'));
      
      if($this->request->isSubmitted()) {
        if(!isset($ticket_data['assignees'])) {
          $ticket_data['assignees'] = array(array(), 0);
        } // if
        
        db_begin_work();
        $this->active_ticket->setAttributes($ticket_data);
        $save = $this->active_ticket->save();
        
        if($save && !is_error($save)) {
          db_commit();
          
          /**
           * Accident Question Save
           */
           if(isset($_POST['job_type']) && $_POST['job_type'] !== '0'){
            $this->accident_job_save();
            $this->accident_update_ticket_name();
          }
            $this->accident_align_discussion_subscriptions(Assignments::findAssignmentDataByObject($this->active_ticket), $this->active_ticket->getId());
            
           /**
            * End Accident Question Save
            */
          
          
          
          
          if($this->request->getFormat() == FORMAT_HTML) {
            flash_success('Ticket #:ticket_id has been updated', array('ticket_id' => $this->active_ticket->getTicketId()));
            $this->redirectToUrl($this->active_ticket->getViewUrl());
          } else {
            $this->serveData($this->active_ticket, 'ticket');
          } // if
        } else {
          db_rollback();
          
          if($this->request->getFormat() == FORMAT_HTML) {
            $this->smarty->assign('errors', $save);
          } else {
            $this->serveData($save);
          } // if
        } // if
      } // if
    } // edit
    
    /**
     * Update multiple tickets
     *
     * @param void
     * @return null
     */
    function mass_update() {
      if($this->request->isSubmitted()) {
        $action = $this->request->post('with_selected');
        if(trim($action) == '') {
          flash_error('Please select what you want to do with selected tickets');
          $this->redirectToReferer($this->smarty->get_template_vars('tickets_url'));
        } // if
        
        $ticket_ids = $this->request->post('tickets');
        $tickets = Tickets::findByIds($ticket_ids, STATE_VISIBLE, $this->logged_user->getVisibility());
        
        $updated = 0;
        if(is_foreachable($tickets)) {
          
          // Complete selected tickets
          if($action == 'complete') {
            $message = lang(':count tickets completed');
            foreach($tickets as $ticket) {
              if($ticket->isOpen() && $ticket->canChangeCompleteStatus($this->logged_user)) {
                $complete = $ticket->complete($this->logged_user);
                if($complete && !is_error($complete)) {
                  $updated++;
                } // if
              } // if
            } // foreach
            
          // Open selected tickets
          } elseif($action == 'open') {
            $message = lang(':count tickets opened');
            foreach($tickets as $ticket) {
              if($ticket->isCompleted() && $ticket->canChangeCompleteStatus($this->logged_user)) {
                $open = $ticket->open($this->logged_user);
                if($open && !is_error($open)) {
                  $updated++;
                } // if
              } // if
            } // foreach
            
          // Mark object as starred
          } elseif($action == 'star') {
            $message = lang(':count tickets starred');
            foreach($tickets as $ticket) {
              $star = $ticket->star($this->logged_user);
              if($star && !is_error($star)) {
                $updated++;
              } // if
            } // foreach
            
          // Unstar objects
          } elseif($action == 'unstar') {
            $message = lang(':count tickets unstarred');
            foreach($tickets as $ticket) {
              $unstar = $ticket->unstar($this->logged_user);
              if($unstar && !is_error($unstar)) {
                $updated++;
              } // if
            } // foreach
            
          // Move selected objects to Trash
          } elseif($action == 'trash') {
            $message = lang(':count tickets moved to Trash');
            foreach($tickets as $ticket) {              
              if($ticket->canDelete($this->logged_user)) {
//                $discussion_id = $this->accident_get_discussion($ticket->getId());
//                if($discussion_id !== false){
//                    $discussion = new Discussion($discussion_id);
//                    //die('About to delete: '.$discussion->getId());
//                    $delete_discussion = $discussion->moveToTrash();
//                }
                
                $delete = $ticket->moveToTrash();
                
                if(!$delete || is_error($delete)){
                    die($delete->error_message);
                }
                
                //$deleteDiscussion = 
                if($delete && !is_error($delete)) {
                  $updated++;
                } // if
              } // if
            } // foreach
            
          // Set a selected priority
          } elseif(str_starts_with($action, 'set_priority')) {
            $priority = (integer) substr($action, 13);
            $message = lang(':count tickets updated');
            foreach($tickets as $ticket) {
              if($ticket->canEdit($this->logged_user)) {
                $ticket->setPriority($priority);
                $save = $ticket->save();
                if($save && !is_error($save)) {
                  $updated++;
                } // if
              } // if
            } // foreach
            
          // Set visibility
          } elseif(str_starts_with($action, 'set_visibility')) {
            $visibility = (integer) substr($action, 15);
            $message = lang(':count tickets updated');
            foreach($tickets as $ticket) {
              if($ticket->canEdit($this->logged_user)) {
                $ticket->setVisibility($visibility);
                $save = $ticket->save();
                if($save && !is_error($save)) {
                  $updated++;
                } // if
              } // if
            } // foreach
            
          // Move this ticket to a given milestone
          } elseif(str_starts_with($action, 'move_to_milestone')) {
            if($action == 'move_to_milestone') {
              $milestone_id = null;
            } else {
              $milestone_id = (integer) substr($action, 18);
            } // if
            
            $message = lang(':count tickets updated');
            foreach($tickets as $ticket) {
              if($ticket->canEdit($this->logged_user)) {
                $ticket->setMilestoneId($milestone_id);
                $save = $ticket->save();
                if($save && !is_error($save)) {
                  $updated++;
                } // if
              } // if
            } // foreach
            
          // Move selected tickets to selected category
          } elseif(str_starts_with($action, 'move_to_category')) {
            if($action == 'move_to_category') {
              $category_id = null;
            } else {
              $category_id = (integer) substr($action, 17);
            } // if
            
            $category = $category_id ? Categories::findById($category_id) : null;
            
            $message = lang(':count tickets updated');
            foreach($tickets as $ticket) {
              if($ticket->canEdit($this->logged_user)) {
                $ticket->setParent($category, false);
                $save = $ticket->save();
                if($save && !is_error($save)) {
                  $updated++;
                } // if
              } // if
            } // foreach
            
          } else {
            $this->httpError(HTTP_ERR_BAD_REQUEST);
          } // if
          
          flash_success($message, array('count' => $updated));
          $this->redirectToReferer($this->smarty->get_template_vars('tickets_url'));
        } else {
          flash_error('Please select tickets that you would like to update');
          $this->redirectToReferer($this->smarty->get_template_vars('tickets_url'));
        } // if
      } else {
        $this->httpError(HTTP_ERR_BAD_REQUEST);
      } // if
    } // mass_update
    
    /**
     * Show ticket changes
     *
     * @param void
     * @return null
     */
    function changes() {
      if($this->active_ticket->isNew()) {
        $this->httpError(HTTP_ERR_NOT_FOUND);
      } // if
      
      if(!$this->active_ticket->canView($this->logged_user)) {
        $this->httpError(HTTP_ERR_FORBIDDEN);
      } // if
      
      $this->skip_layout = $this->request->isApiCall() || $this->request->isAsyncCall();
      
      $this->smarty->assign('changes', $this->active_ticket->getChanges());
    } // changes
    
    /**
     * Export tickets
     *
     * @param void
     * @return null
     */
    function export() {
      $object_visibility = array_var($_GET, 'visibility', VISIBILITY_NORMAL);
      $exportable_modules = explode(',', array_var($_GET,'modules', null));
      if (!is_foreachable($exportable_modules)) {
        $exportable_modules = null;
      } // if
      
      require_once(PROJECT_EXPORTER_MODULE_PATH.'/models/ProjectExporterOutputBuilder.class.php');
      
      $output_builder = new ProjectExporterOutputBuilder($this->active_project, $this->smarty, $this->active_module, $exportable_modules);
      if (!$output_builder->createOutputFolder()) {
        $this->serveData($output_builder->execution_log, 'execution_log', null, FORMAT_JSON);
      } // if
      $output_builder->createAttachmentsFolder();
      
      $module_categories = Categories::findByModuleSection($this->active_project, $this->active_module, $this->active_module);
      $module_objects = Tickets::findByProject($this->active_project, null , STATE_VISIBLE, $object_visibility);

      $output_builder->setFileTemplate($this->active_module, $this->controller_name, 'index');
      $output_builder->smarty->assign('categories',$module_categories);
      $output_builder->smarty->assign('objects', $module_objects);
      $output_builder->outputToFile('index');
                 
      // export tickets by categories
      if (is_foreachable($module_categories)) {
        foreach ($module_categories as $module_category) {
          if (instance_of($module_category,'Category')) {
            $output_builder->smarty->assign(array(
              'current_category' => $module_category,
              'objects' => Tickets::findByProject($this->active_project, $module_category, STATE_VISIBLE, $object_visibility),
            ));
            $output_builder->outputToFile('category_'.$module_category->getId());
          } // if
        } // foreach
      } // if
      
      // export tickets
      if (is_foreachable($module_objects)) {
        $output_builder->setFileTemplate($this->active_module, $this->controller_name, 'object');
        foreach ($module_objects as $module_object) {
          if (instance_of($module_object,'Ticket')) {
            $output_builder->outputAttachments($module_object->getAttachments());
            
            $comments = $module_object->getComments($object_visibility);
            $output_builder->outputObjectsAttachments($comments);
            
            if (module_loaded('timetracking')) {
              $timerecords = TimeRecords::findByParent($module_object, null, STATE_VISIBLE, $object_visibility);
              $total_time = TimeRecords::calculateTime($timerecords);
            } else {
              $timerecords = null;
              $total_time = 0;
            } // if
            
            $output_builder->smarty->assign(array(
              'timerecords' => $timerecords,
              'total_time'  => $total_time,
            	'object' => $module_object,
            	'comments' => $comments,
            ));
            $output_builder->outputToFile('ticket_'.$module_object->getId());
          } // if
        } // foreach
      } // if
      
      $this->serveData($output_builder->execution_log, 'execution_log', null, FORMAT_JSON);
    } // export
    
    /**
     * Show and process reorder task form
     *
     * @param void
     * @return null
     */
    function reorder_tickets() {
      $this->wireframe->print_button = false;
      
      $milestone = Milestones::findById($this->request->get('milestone_id'));
      if (instance_of($milestone, 'Milestone')) {
        $milestone_id = $milestone->getId();
      } else {
        $milestone_id = null;
      } // if
      
      if (!$this->request->isSubmitted()) {
        $this->httpError(HTTP_ERR_BAD_REQUEST, null, true, true);
      } // if
      
      if (!Ticket::canManage($this->logged_user, $this->active_project)) {
        $this->httpError(HTTP_ERR_FORBIDDEN, null, true, true);
      } // if     
      
      $order_data = $this->request->post('reorder_ticket');
      $ids = array_keys($order_data);
      if (is_foreachable($order_data)) {
      	$x = 1;
        foreach ($order_data as $key=>$value) {
        	$order_data[$key] = $x;
        	$x++;
        } // foreach
      } // if
      
      $tickets = Tickets::findByIds($ids, STATE_VISIBLE, $this->logged_user->getVisibility());
      if (is_foreachable($tickets)) {
        foreach ($tickets as $ticket) {
          $ticket->setMilestoneId($milestone_id);
          $ticket->setPosition(array_var($order_data, $ticket->getId()));
          $ticket->save();
        } // foreach
      } // if
      $this->httpOk();
    } // reorder
  
  } // TicketsController

?>