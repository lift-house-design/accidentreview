<?php

	add_shortcode('dashboard','accident_dashboard');
	add_shortcode('new-assignment','accident_new_assignment');
	
	function accident_new_assignment($atts)
	{
		$assignment_types=array(
			'vehicle-theft',
			'accident-reconstruction',
			'fire-analysis',
			'mechanical-analysis',
			'physical-damage-comparison',
			'report-review',
			'other',
		);
		
		// Parse attributes
		$atts=shortcode_atts(array(
			'type'=>$assignment_types[0],
		),$atts);
		
		// Check for invalid type
		if(!in_array($atts['type'],$assignment_types)) return;
		
		
		
		require('views/new_assignment.php');
	}

	function accident_dashboard($atts, $content=null, $code='')
	{
		if(!isset($_SESSION['agent_user_id'])) header('/');
		
		if(isset($_POST['ajaxRequest']))
		{
			$request=$_POST['ajaxRequest'];
			
			switch($request['action'])
			{
				case 'saveUserInfo':
					// Get the current user info
		            $userID = $_SESSION['agent_user_id'];
		            $userInfo = accident_get_user_details($userID);
		            $userRepInfo = accident_get_user_rep_details($userID);
					$userData=array(
						'first'=>$userInfo['first_name'],
						'last'=>$userInfo['last_name'],
               			'email'=>$userInfo['email'],
                        'department'=>$userRepInfo['department'],
                        'department_name'=>$userRepInfo['department_name'],
                        'street'=>$userRepInfo['street'],
                        'city'=>$userRepInfo['city'],
                        'state'=>$userRepInfo['state'],
                        'zip'=>$userRepInfo['zip'],
                        'phone'=>$userRepInfo['phone'],
                        'mobile'=>$userRepInfo['mobile'],
                        'fax'=>$userRepInfo['fax'],
					);
					
					// Update the new field
					$userData[$request['name']]=$request['value'];
                    accident_update_user($userID,$userData);
					break;
				case 'changeUserPass':
					$userID = $_SESSION['agent_user_id'];
					$userData=array(
						'password'=>$request['value']
					);
					accident_update_user_password($userID,$userData);
					break;
			}
			exit;
		}
		
		require('views/dashboard.php');
	}