<?php
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	$job_ids_to_remove=array(
		56243,
		56242,
		56241
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

	// Used to select job IDs to remove based on a query; comment out to use hardcoded
	// IDs declared on line 4
	///////////////////////////////////////////////////////////////////////////////////
	
	$job_ids_to_remove=array();
	$r=query('
		select
			id
		from
			ar_job
	');
	while($row=mysql_fetch_assoc($r))
		$job_ids_to_remove[]=$row['id'];

	///////////////////////////////////////////////////////////////////////////////////

	foreach($job_ids_to_remove as $job_id)
	{
		echo '[ Deleting '.$job_id.' ]'.NL;
		echo T.'- Finding vehicle IDs'.NL;
		$r=query('
			select
				id
			from
				ar_job_vehicle
			where
				job_id = '.$job_id.'
		');
		while($row=mysql_fetch_assoc($r))
		{
			echo T.'- Deleting vehicle answers for vehicle '.$row['id'].NL;
			query('
				delete from
					ar_job_vehicle_answer
				where
					vehicle_id = '.$row['id'].'
			');
		}
		echo T.'- Deleting vehicles'.NL;
		query('
			delete from
				ar_job_vehicle
			where
				job_id = '.$job_id.'
		');
		echo T.'- Deleting job answers'.NL;
		query('
			delete from
				ar_job_answer
			where
				job_id = '.$job_id.'
		');
		echo T.'- Deleting updates'.NL;
		query('
			delete from
				ar_update
			where
				job_id = '.$job_id.'
		');
		echo T.'- Deleting correspondence'.NL;
		query('
			delete from
				ar_correspondence
			where
				job_id = '.$job_id.'
		');
		echo T.'- Deleting final report archives'.NL;
		query('
			delete from
				ar_final_report_archive
			where
				job_id = '.$job_id.'
		');
		echo T.'- Deleting job'.NL;
		query('
			delete from
				ar_job
			where
				id = '.$job_id.'
			limit 1
		');
		echo '[ Finished '.$job_id.' ]'.NL;
	}
	echo '== COMPLETE ==';