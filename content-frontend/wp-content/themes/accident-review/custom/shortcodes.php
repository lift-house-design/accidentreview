<?php

	add_shortcode('dashboard','accident_dashboard');
	add_shortcode('new-assignment','accident_new_assignment');
	add_shortcode('login','accident_login');
	add_shortcode('logout','accident_logout');
	add_shortcode('reset','accident_reset');
	add_shortcode('phpinfo','phpinfo2');
	
	function phpinfo2()
	{
		var_dump(array(
			'upload_max_filesize'=>ini_get('upload_max_filesize'),
			'post_max_size'=>ini_get('post_max_size'),
		));
		exit;
	}
	
	function accident_reset_form()
	{
		$email = $_POST['reset_email'];
		if(!empty($email))
		{
			
			$exists = ar_email_exists($email);
			if(!$exists)
			{
				echo '<h5 style="text-align:center;color:red">Email Address not found.</h5>';
			}else{
				$code = sha1($email.time().rand(99,999999999));
				set_reset($email,$code);
				$link = 'http://'.$_SERVER['HTTP_HOST'].'/dashboard/login/?reset_code='.$code;
				$subject = "Password Reset Requested";
				$body = 'Follow the link below to reset your password:\n<br/>\n<br/><a href="'.$link.'">'.$link.'</a>';
				send_ar_email($email,$subject,$body);
				echo "<h5 style=\"text-align:center;color:green\">An Email was sent to $email with a link to reset your password.</h5>";
				return;
			}
		}

		echo '
		<h2 style="color:rgb(10, 44, 121);text-align:center;margin:0px 0px 20px">Reset Your Password</h2>
		<form method="POST" action="?reset_form=1" style="text-align:center">
			<span style="color:rgb(10, 44, 121);">Email:</span>
			<input name="reset_email" style="width:200px" value="'.$email.'"/><br/><br/>
			<input type="submit" value="Send Code"/>
		</form>
		';
	}

	function accident_reset_code()
	{
		var_dump($_GET);
	}

	function accident_login()
	{
		// handle reset
		if(!empty($_GET['reset_form']))
			return accident_reset_form();
		if(!empty($_GET['reset_code']))
			return accident_reset_code();

		if(!empty($_POST['email']) && !empty($_POST['password']) && login_user($_POST['email'],$_POST['password']))
		{
			$location='/dashboard?check_autosave=1';
			echo 'You have been logged in. Please wait...';
			echo '<meta http-equiv="refresh" content="0;URL=\''.$location.'\'">';
		}
		else
		{
			echo 'There was a problem logging you in. Check the e-mail address and password you entered and try again.';
		}
	}
	
	function accident_logout()
	{
		logout_user();
		
		$location='/';
		echo 'You have been logged out. Please wait...';
		echo '<meta http-equiv="refresh" content="0;URL=\''.$location.'\'">';
	}

	function accident_new_assignment($atts)
	{
		$assignment_questions=array(
			'vehicle-theft'=>array(
				
			),
			'accident-reconstruction'=>array(
				
			),
			'fire-analysis'=>array(
			
			),
			'mechanical-analysis'=>array(
			
			),
			'physical-damage-comparison'=>array(
			
			),
			'report-review'=>array(
			
			),
			'other'=>array(
			
			),
		);
		$assignment_types=array_keys($assignment_questions);
		
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

		if(is_logged_in()===FALSE)
		{
			$location='/';
			echo 'You must be logged in to view this page.';
			echo '<meta http-equiv="refresh" content="0;URL=\''.$location.'\'">';
		}
		else
		{
			if(isset($_POST['ajaxRequest']))
			{
				$request=$_POST['ajaxRequest'];
				
				switch($request['action'])
				{
					case 'saveUserInfo':
						$userData=ar_user_data();
						$data=array(
							$request['name']=>$request['value'],
						);
						ar_save_user($userData['id'],$data);
						break;
					case 'changeUserPass':
						$userData=ar_user_data();
						$data=array(
							'password'=>sha1($request['value']),
						);
						ar_save_user($userData['id'],$data);
						break;
					case 'deleteUpdate':
						ar_remove_update($request['id']);
						break;
				}
				exit;
			}

			$assignment_updates=ar_get_assignment_updates();
			
			require('views/dashboard.php');
		}
	}