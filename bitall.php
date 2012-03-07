<?
define( 'DB_HOST', 'localhost' );					// Server the database is hosted on "localhost" for this server
define( 'DB_USER', 'cashltd_cashy' );				// Username for the database
define( 'DB_PASS', 'cashy' );						// Password for the database
define( 'DB_DATA', 'cashltd_cash' );				// database the information is in

const morning1 = 1;
const afternoon1 = 2;
const evening1 = 4;
const morning2 = 8;
const afternoon2 = 16;
const evening2 = 32;

include_once('./framework/classes/class_database.php');


function callTime($timestamp) {

	$_date['h'] = (int)date("G",$timestamp);
	$_date['m'] = (int)date("i",$timestamp);
	
	$_dayStart = 6;					// Start the day at 6am
	$_morningEnd = 13;				// Morning ends at 13:00
	$_afternoonEnd = 17;			// Afternoon ends at 17:00
	
	if ($_date['h'] < $_morningEnd AND $_date['h'] >= $_dayStart) {
		// Time is morning
		$_returnTime = 1;
	} else if ($_date['h'] >= $_morningEnd AND $_date['h'] < $_afternoonEnd) {
		// Time is Afternoon
		$_returnTime = 2;
	} else {
		// Time should be evening cos we don't work before 6am
		$_returnTime = 3;
	}

	return $_returnTime;
}

function checkCallTimes($cid) {
	
	
	$_morning = ARRAY();
	$_afternoon = ARRAY();
	$_evening = ARRAY();
	
	$events = Array();
	
	$db = new database();
	$noanswerresults = $db->getAll("SELECT * FROM claimants_noanswers WHERE cid='".$cid."' ORDER BY timestamp DESC");
	
	if (count($noanswerresults) > 0) {
		foreach($noanswerresults as $result) {
			
			$result['timeofday'] = callTime($result['timestamp']);
			$result['dateDay'] = date("j",$result['timestamp']);
			
			$events[] = $result;
			
		}
	}
	
	// Now we have all the no answers in an array we need to group them by time of day
	
	foreach ($events AS $event) {
	
		if ($event['timeofday'] == 1) {
			$_morning[] = $event;
		} else if ($event['timeofday'] == 2) {
			$_afternoon[] = $event;
		} else {
			$_evening[] = $event;
		}
					
	}
	
	// OK lets count the arrays to check for correct times
	
	$checks = ARRAY();
	
	

	if (count($_morning) > 0) {
		$checks['morning1'] = TRUE;
		$checks['morning2'] = FALSE;
		
		// better check for more than one date to fill in the second check
		$firstdate = $_morning[0]['dateDay'];
		foreach ($_morning AS $check2) {
			if ($firstdate != $check2['dateDay']) {
				$checks['morning2'] = TRUE;
			}
		}

	} else {
		$checks['morning1'] = FALSE;
		$checks['morning2'] = FALSE;
	}
	
	
	if (count($_afternoon) > 0) {
		$checks['afternoon1'] = TRUE;
		$checks['afternoon2'] = FALSE;
		
		// better check for more than one date to fill in the second check
		$firstdate = $_afternoon[0]['dateDay'];
		foreach ($_afternoon AS $check2) {
			if ($firstdate != $check2['dateDay']) {
				$checks['afternoon2'] = TRUE;
			}
		}
		
		
	} else {
		$checks['afternoon1'] = FALSE;
		$checks['afternoon2'] = FALSE;
	}
	
	if (count($_evening) > 0) {
		$checks['evening1'] = TRUE;
		$checks['evening2'] = FALSE;
		
		// better check for more than one date to fill in the second check
		$firstdate = $_evening[0]['dateDay'];
		foreach ($_evening AS $check2) {
			if ($firstdate != $check2['dateDay']) {
				$checks['evening2'] = TRUE;
			}
		}
	} else {
		$checks['evening1'] = FALSE;
		$checks['evening2'] = FALSE;
	}

	return $checks;
	
}




set_time_limit(0);
$db = new database();
$results = $db->getAll("SELECT id, clientid, timestamp FROM claimants_data ORDER BY id DESC;");

foreach ($results AS $result) {

	$check = checkCallTimes($result['id']);
	$thisBit = 0;
	
	if ($check['morning1']) $thisBit = $thisBit + morning1;
	if ($check['morning2']) $thisBit = $thisBit + morning2;
	if ($check['afternoon1']) $thisBit = $thisBit + afternoon1;
	if ($check['afternoon2']) $thisBit = $thisBit + afternoon2;
	if ($check['evening1']) $thisBit = $thisBit + evening1;
	if ($check['evening2']) $thisBit = $thisBit + evening2;
	
	print $result['id'] . " - " . $thisBit . "\n";
	
	$db->query("UPDATE claimants_data SET  `bit` =  '".$thisBit."' WHERE  `claimants_data`.`id` ='".$result['id']."';");
	
}


?>