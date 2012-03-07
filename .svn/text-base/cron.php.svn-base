<?php

	// Set up variables we need (pretty much constants tbh)
		$writeLog = FALSE;
		$logFile = "/var/www/logs/csv.log";
		$logEntry = "";
	
	// Make sure we have easy database access
		include_once("/var/www/framework/classes/class_database.php");
		define( 'DB_HOST', 'localhost' );					// Server the database is hosted on "localhost" for this server
		define( 'DB_USER', 'cashltd_cashy' );			// Username for the database
		define( 'DB_PASS', 'cashy' );							// Password for the database
		define( 'DB_DATA', 'cashltd_cash' );			// database the information is in
	



	// Start a database connection and grab some csv data from it
		$db = new database();
		$nextcsv = $db->getFirst("SELECT * FROM claimants_csv_data WHERE added='0' ORDER BY timestamp;");
		
		if (!$db->empty) {
			// We now know we're going to have to log something!
				$writeLog = TRUE;
				
			// Find the CSV line we need to work with
				$currentline = $nextcsv['currentrecord'];
				
				
				
				
				
			// Write timestamp to the log entry variable
				$logEntry .= date( "H:i:s - d/m/y -  ", strtotime("NOW") );
			
		}
	
		
	


	// Did we do anything? If so, log it!
		if ($writeLog) {
			$current = file_get_contents($logFile);
			$data = fopen($logFile, "w+");
			fwrite($data,$logEntry."\r\n".$current);
			fclose($data);
		}
	
?>