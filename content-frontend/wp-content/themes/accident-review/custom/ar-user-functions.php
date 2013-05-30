<?php

	function login_user($email,$password)
	{
		global $wpdb;
		
		$sql=$wpdb->prepare('
			select
				*
			from
				ar_user
			where
				email = %s and
				password = %s
			limit 1
		',$email,sha1($password));
		
		$user=$wpdb->get_row($sql,'ARRAY_A');
		
		if($user===NULL)
			return FALSE;
		else
		{
			$_SESSION['user']=$user;
			return TRUE;
		}
	}
	
	function logout_user()
	{
		unset($_SESSION['user']);
		return TRUE;
	}
	
	function is_logged_in()
	{
		return !empty($_SESSION['user']);
	}
	
	function ar_user_data($id=NULL)
	{
		if($id===NULL)
		{
			if(is_logged_in())
				return $_SESSION['user'];
			else
				return FALSE;
		}
		else
		{
			global $wpdb;
			
			$sql=$wpdb->prepare('
				select
					*
				from
					ar_user
				where
					id = %d
				limit 1
			',$id);
			
			$user=$wpdb->get_row($sql,'ARRAY_A');
			
			return $user===NULL ? FALSE : $user;
		}
	}
	
	function ar_save_user($id,$data)
	{
		global $wpdb;
		
		// Get field names
		$sql=$wpdb->prepare('show columns from ar_user');
		$fields=$wpdb->get_col($sql);
		unset($fields[0]); // Don't include the id
		
		// Only use data with keys matching field names
		$data=array_intersect_key($data,array_flip($fields));
		
		$success=$wpdb->update('ar_user',$data,array(
			'id'=>$id,
		));
		
		if($success!==FALSE && is_logged_in() && $id==$_SESSION['user']['id'])
		{
			$sql=$wpdb->prepare('
				select
					*
				from
					ar_user
				where
					id = %d
				limit 1
			',$id);
			
			$user=$wpdb->get_row($sql,'ARRAY_A');
			
			if($user!==NULL)
				$_SESSION['user']=$user;
		}
		
		return $success!==FALSE;
	}
