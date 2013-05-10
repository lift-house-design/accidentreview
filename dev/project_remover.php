<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	$job_ids_to_remove=array(

	);
	
	$ticket_ids_to_remove=array(
	
	);
	
	$db_host='localhost';
	$db_user='root';
	$db_pass='root';
	$db_name='accidentreview';
	
	mysql_connect($db_host,$db_user,$db_pass);
	mysql_select_db($db_name);
	
	define('NL',"\r\n");
	define('T',"\t");
	
	function query($sql)
	{
		$result=mysql_query($sql);
		
		if(!$result)
		{
			echo 'Query: '.T.trim($sql).NL.NL;
			echo 'Error: '.T.mysql_error().NL.NL; 
		}
		else return $result;
	}
	
	function remove_tickets($ticket_ids_to_remove)
	{
		if(empty($ticket_ids_to_remove))
		{
			echo 'No ticket IDs to remove.';
			return;
		}
		
		echo 'Deleting tickets...'.NL;
		query('
			delete from
				acx_project_objects
			where
				id in ('.implode(',',$ticket_ids_to_remove).') and
				type="Ticket" and
				module="tickets"
		');
		echo 'Deleted: '.T.mysql_affected_rows().NL.NL;
		
		$r=query('
			select
				id
			from
				acx_project_objects
			where
				parent_id in ('.implode(',',$ticket_ids_to_remove).') and
				type="Discussion" and
				module="discussions"
		');
		$discussion_ids=array();
		while($row=mysql_fetch_assoc($r))
			$discussion_ids[]=$row['id'];
		
		echo 'Deleting discussions...'.NL;
		query('
			delete from
				acx_project_objects
			where
				parent_id in ('.implode(',',$ticket_ids_to_remove).') and
				type="Discussion" and
				module="discussions"
		');
		echo 'Deleted: '.T.mysql_affected_rows().NL.NL;
		
		echo 'Deleting activity logs...'.NL;
		query('
			delete from
				acx_activity_logs
			where
				object_id in ('.implode(',',$ticket_ids_to_remove).') and 
				type="ObjectCreatedActivityLog"
		');
		echo 'Deleted: '.T.mysql_affected_rows().NL.NL;
		
		echo 'Deleting subscriptions...'.NL;
		query('
			delete from
				acx_subscriptions
			where
				parent_id in ('.implode(',',$ticket_ids_to_remove).( empty($discussion_ids) ? '' : ','.implode(',',$discussion_ids) ).')
		');
		echo 'Deleted: '.T.mysql_affected_rows().NL.NL;
	
		echo 'Deleting search indexes...'.NL;
		query('
			delete from
				acx_search_index
			where
				object_id in ('.implode(',',$ticket_ids_to_remove).') and
				type = "ProjectObject"
		');
		echo 'Deleted: '.T.mysql_affected_rows().NL.NL;
		
		echo 'Deleting attachments...'.NL;
		query('
			delete from
				acx_attachments
			where
				parent_id in ('.implode(',',$ticket_ids_to_remove).') and
				parent_type = "ticket"
		');
		echo 'Deleted: '.T.mysql_affected_rows().NL.NL;
	}
	
	function remove_jobs($job_ids_to_remove)
	{
		if(empty($job_ids_to_remove))
		{
			echo 'No job IDs to remove.';
			return;
		}
		
		$r=query('
			select
				id
			from
				ar_job_vehicle
			where
				job_id in ('.implode(',',$job_ids_to_remove).')
		');
		$vehicle_ids=array();
		while($row=mysql_fetch_assoc($r))
			$vehicle_ids[]=$row['id'];
		
		if(!empty($vehicle_ids))
		{
			echo 'Deleting vehicle answers...'.NL;
			query('
				delete from
					ar_job_vehicle_answer
				where
					vehicle_id in ('.implode(',',$vehicle_ids).')
			');
			echo 'Deleted: '.T.mysql_affected_rows().NL.NL;
				
			echo 'Deleting vehicles...'.NL;
			query('
				delete from
					ar_job_vehicle
				where
					id in ('.implode(',',$vehicle_ids).')
			');
			echo 'Deleted: '.T.mysql_affected_rows().NL.NL;
		}
			
		echo 'Deleting job answers...'.NL;
		query('
			delete from
				ar_job_answer
			where
				job_id in ('.implode(',',$job_ids_to_remove).')
		');
		echo 'Deleted: '.T.mysql_affected_rows().NL.NL;
		
		$r=query('
			select
				ticket_id
			from
				ar_job
			where
				id in ('.implode(',',$job_ids_to_remove).')
		');
		$ticket_ids=array();
		while($row=mysql_fetch_assoc($r))
			if($row['ticket_id']>0)
				$ticket_ids[]=$row['ticket_id'];
		
		echo 'Deleting jobs...'.NL;
		query('
			delete from
				ar_job
			where
				id in ('.implode(',',$job_ids_to_remove).')
		');
		echo 'Deleted: '.T.mysql_affected_rows().NL.NL;
		
		remove_tickets($ticket_ids);
	}
	
	if(!empty($job_ids_to_remove))
		remove_jobs($job_ids_to_remove);
	if(!empty($ticket_ids_to_remove))
		remove_tickets($ticket_ids_to_remove);
