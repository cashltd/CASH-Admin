<?php

	define( 'DB_HOST', 'localhost' );					// Server the database is hosted on "localhost" for this server
	define( 'DB_USER', 'cashltd_cashy' );				// Username for the database
	define( 'DB_PASS', 'cashy' );						// Password for the database
	define( 'DB_DATA', 'cashltd_cash' );				// database the information is in

	include_once("framework/classes/class_database.php");
	
	$json_array = Array();
	$_query = $_GET['q'];
	
	if ($_query == "livestats") {
		
	} else if ($_query == "claimants_pending") {
		$db = new database();
		$results = $db->getAll("SELECT `claimants_data`.*,  `total_claimants`.`long`, `total_claimants`.`lat`
														FROM  `claimants_data` 
														INNER JOIN `total_claimants`
														ON `claimants_data`.`clientid` = `total_claimants`.`id`
														WHERE `claimants_data`.`status` = 0 AND `claimants_data`.`bit` <> 63
														ORDER BY `claimants_data`.`id` DESC");
														
		$json_array = $results;
	}	else if ($_query == "claimants_accepted") {
			$db = new database();
			$results = $db->getAll("SELECT `claimants_data`.*,  `total_claimants`.`long`, `total_claimants`.`lat`
															FROM  `claimants_data` 
															INNER JOIN `total_claimants`
															ON `claimants_data`.`clientid` = `total_claimants`.`id`
															WHERE `claimants_data`.`status` = 1 
															ORDER BY `claimants_data`.`id` DESC");

			$json_array = $results;
		}		else if ($_query == "claimants_declined") {
					$db = new database();
					$results = $db->getAll("SELECT `claimants_data`.*,  `total_claimants`.`long`, `total_claimants`.`lat`
																	FROM  `claimants_data` 
																	INNER JOIN `total_claimants`
																	ON `claimants_data`.`clientid` = `total_claimants`.`id`
																	WHERE `claimants_data`.`status` = 2
																	ORDER BY `claimants_data`.`id` DESC");

					$json_array = $results;
				}



	print json_encode($json_array);
?>