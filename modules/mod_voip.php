<?php



	class voip {
		
		const username = "admin";
		const password = "3eNusu2a";
		const host = "localhost";
		const port = 5038;
	
		const mobilePPM = 0.059;
		const landlinePPM = 0.0064;
	
		function sec2hms ($sec, $padHours = false) 
		  {
		
		    // start with a blank string
		    $hms = "";
		    
		    // do the hours first: there are 3600 seconds in an hour, so if we divide
		    // the total number of seconds by 3600 and throw away the remainder, we're
		    // left with the number of hours in those seconds
		    $hours = intval(intval($sec) / 3600); 
		
		    // add hours to $hms (with a leading 0 if asked for)
		    $hms .= ($padHours) 
		          ? str_pad($hours, 2, "0", STR_PAD_LEFT). ":"
		          : $hours. ":";
		    
		    // dividing the total seconds by 60 will give us the number of minutes
		    // in total, but we're interested in *minutes past the hour* and to get
		    // this, we have to divide by 60 again and then use the remainder
		    $minutes = intval(($sec / 60) % 60); 
		
		    // add minutes to $hms (with a leading 0 if needed)
		    $hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ":";
		
		    // seconds past the minute are found by dividing the total number of seconds
		    // by 60 and using the remainder
		    $seconds = intval($sec % 60); 
		
		    // add seconds to $hms (with a leading 0 if needed)
		    $hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);
		
		    // done!
		    return $hms;
		    
		  }
	
	
		// Prints out the time since last call as a json string
		function timeSinceLastCall() {
						
			$date = date("Y-m-d" , strtotime("NOW"));		
				
			$extraWhere = " AND calldate LIKE '".$date."%' AND dst LIKE '0%' AND duration >= 15";
		
			$userExtension = Login::getUserExtension();
			
			$db = new database("asteriskcdrdb");
			
			$sql = "SELECT * FROM cdr WHERE src='".$userExtension."'".$extraWhere." ORDER BY calldate DESC;";
			
			$lastCall = $db->getFirst($sql);
			
			if (count($lastCall) > 0)
			{
				$lastCallTimestamp = strtotime($lastCall['calldate']);
				
				$timeSince = (strtotime("now") - $lastCallTimestamp) - $lastCall['duration'];
				
				if ($timeSince >= 60) $fontRed = TRUE;
				
				if ($fontRed) print "<font color='red' style='font-weight: bold;'>";
				print $timeSince." second";
				if ($timeSince != 1 AND $timeSince != -1) print "s";
				if ($fontRed) print "</font>";
				
			} else {
				print "No Calls Made Today";
			}
		
		}
		
		
		
		function dailyCallDistribution() {
			GLOBAL $page;
			
			
			$date = date("Y-m-d" , strtotime("Today"));

			$extraWhere = "";

			$callFlow = Array();
			$callArray = Array(	"08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30",
								"14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30",
								"19:00", "19:30", "20:00", "20:30");
			
			$dbs = new Database();
			$usersArray = $dbs->getAll("SELECT id, fname, sname FROM admin_login WHERE callcenter = 1 ORDER BY id;");
			
			foreach ($usersArray AS $user)
			{
				$users[$user['id']] = $user['fname'] ." ".$user['sname'];
			}
			
			
			//$usersArray = Array(4);
			
			for ($i = 0; $i <= (count($callArray)-2); $i++) {
				foreach ($usersArray AS $user) {
				
				
					$userExtension = Login::getUserExtension($user['id']);
					$startTime = $callArray[$i];
					$endTime = $callArray[$i+1];
					
					$sql = "SELECT count(*) AS count FROM cdr WHERE src='".$userExtension."' AND calldate >= '".$date." ".$startTime.":00' AND calldate < '".$date." ".$endTime.":00' AND dst LIKE '0%' AND duration >= 10 ORDER BY calldate DESC;";
					
					$db = new database("asteriskcdrdb");				
					$lastCall = $db->getFirst($sql);
					
					
					
					$callFlow[$startTime.'-'.$endTime.""][$user['id']] = $lastCall['count'];
				}

			}
			
			$page->addPage("stats/mainscreen2.tpl", Array( 'users' => $users, 'stats' => $callFlow ) );
		}
		
		
		
		function averageCallIdleTime() {
		
			$date = date("Y-m-d" , strtotime("now"));		
				
			$extraWhere = " AND calldate LIKE '".$date."%' AND dst LIKE '0%' AND duration >= 15";
		
			$userExtension = Login::getUserExtension(4);
			
			$db = new database("asteriskcdrdb");
			
			$sql = "SELECT * FROM cdr WHERE src='".$userExtension."'".$extraWhere." ORDER BY calldate DESC;";
			
			$lastCall = $db->getAll($sql);
		
			$idleTime = 0;
			
			for ($i = 0; $i <= (count($lastCall)-2); $i++) {
				$finishTime = strtotime($lastCall[$i]['calldate']) + $lastCall[$i]['duration'];
				$nextStartTime = strtotime($lastCall[$i+1]['calldate']);
				$idleTime = $idleTime + ($finishTime - $nextStartTime);
			}
			
			
		
			print number_format($idleTime / (count($lastCall)-1), 2);
		}
	
	
	
		function amiTest() {
		
			$socket = fsockopen(self::host, self::port, $errno, $errstr); 
			fputs($socket, "Action: Login\r\n"); 
			fputs($socket, "UserName: ".self::username."\r\n");
			fputs($socket, "Secret: ".self::password."\r\n\r\n");
			
			$wrets=fgets($socket,128); 
			
			fputs($socket, "Action: QueueStatus\r\n" );
			
			$wrets=fgets($socket,128); 
			print $wrets; 
		
		}
	
	
	
	
		function makeCall($extension, $callName, $callNumber) {

			// check there's a 0!
			if ($callNumber[0] != 0)
				$callNumber = "0" . $callNumber;



			if (login::getUserRank() == 3) {
				
				$socket = fsockopen(self::host, self::port, $errno, $errstr); 
				fputs($socket, "Action: Login\r\n"); 
				fputs($socket, "UserName: ".self::username."\r\n");
				fputs($socket, "Secret: ".self::password."\r\n\r\n");
				
				$wrets=fgets($socket,128); 
				
				fputs($socket, "Action: Originate\r\n" ); 
				fputs($socket, "Channel: SIP/$extension\r\n" ); 
				fputs($socket, "Context: from-internal\r\n" ); 
				fputs($socket, "Variable: __SIPADDHEADER=Alert-Info: \;Alertinfo=\;info=dialer \r\n" ); 
				fputs($socket, "Exten: $callNumber\r\n" ); 
				fputs($socket, "Priority: 1\r\n" ); 
				fputs($socket, "Callerid: \"$callName\" <$extension>\r\n");
				fputs($socket, "Async: yes\r\n\r\n" ); 
				
				$wrets=fgets($socket,128); 
				return $wrets; 
			
			} else {

				$socket = fsockopen(self::host, self::port, $errno, $errstr); 
				fputs($socket, "Action: Login\r\n"); 
				fputs($socket, "UserName: ".self::username."\r\n");
				fputs($socket, "Secret: ".self::password."\r\n\r\n");
				
				$wrets=fgets($socket,128); 
				
				fputs($socket, "Action: Originate\r\n" ); 
				fputs($socket, "Channel: SIP/$extension\r\n" ); 
				fputs($socket, "Context: from-internal\r\n" ); 
				fputs($socket, "Variable: __SIPADDHEADER=Alert-Info: \;Alertinfo=\;info=dialer \r\n" ); 
				fputs($socket, "Exten: $callNumber\r\n" ); 
				fputs($socket, "Priority: 1\r\n" ); 
				fputs($socket, "Callerid: \"$callName\" <$extension>\r\n");
				fputs($socket, "Async: yes\r\n\r\n" ); 
				
				$wrets=fgets($socket,128); 
				return $wrets; 
			
			}
			
			
			
		}
		
		
		function numberStats($callNumber) {
		
			if (substr($callNumber, 0, 1) != '0')
				$callNumber = "0" . $callNumber;
		
			$db = new database("asteriskcdrdb");
			$totalCalls = $db->getAll("SELECT * FROM cdr WHERE dst='".$callNumber."';");
		
			return $totalCalls;
		
		}
		
		
				
		function dailyCallStats($userid, $date="today") {
		
			if ($date == "today") {
				$date = date("Y-m-d" , strtotime("NOW"));
			}
		
			$stats = Array();
		
			$extraWhere = " AND calldate LIKE '".$date."%' AND dst LIKE '0%' AND duration >= 10";
		
			$userExtension = Login::getUserExtension($userid);
			
			$db = new database();
			$acceptedClaims = $db->getFirst("SELECT count(*) AS count FROM admin_actions WHERE action LIKE '%Client%Accepted%' AND uid='".$userid."' AND timestamp LIKE '".$date."%'");
			$db = new database();
			$acceptedHotkeys = $db->getFirst("SELECT count(*) AS count FROM admin_actions WHERE action LIKE '%Hotkey%Accepted%' AND uid='".$userid."' AND timestamp LIKE '".$date."%'");
			
			
			$db = new database("asteriskcdrdb");
			$totalCalls = $db->getFirst("SELECT count(src) as count FROM cdr WHERE src='".$userExtension."' ".$extraWhere.";");
			
			$db = new database("asteriskcdrdb");
			$callDuration = $db->getFirst("SELECT sum(duration) as duration FROM cdr WHERE src='".$userExtension."' ".$extraWhere.";");
			
			$db = new database("asteriskcdrdb");
			$firstCall = $db->getFirst("SELECT calldate FROM cdr WHERE src='".$userExtension."' ".$extraWhere." ORDER BY calldate ASC;");
			
			$db = new database("asteriskcdrdb");
			$lastCall = $db->getFirst("SELECT calldate FROM cdr WHERE src='".$userExtension."' ".$extraWhere." ORDER BY calldate DESC;");
			
			
			$extraWhere = " AND calldate LIKE '".$date."%' AND (dst LIKE '01%' OR dst LIKE '02%')";
			$db = new database("asteriskcdrdb");
			$landlineCalls = $db->getAll("SELECT * FROM cdr WHERE src='".$userExtension."' ".$extraWhere.";");
			
			$extraWhere = " AND calldate LIKE '".$date."%' AND (dst LIKE '07%')";
			$db = new database("asteriskcdrdb");
			$mobileCalls = $db->getAll("SELECT * FROM cdr WHERE src='".$userExtension."' ".$extraWhere.";");
			
			
			$mobileSum = 0;
			$landlineSum = 0;
			
			foreach ($landlineCalls AS $lCall)
			{
				$landlineSum = $landlineSum + $lCall['duration'];
			}
			
			foreach ($mobileCalls AS $mCall)
			{
				$mobileSum = $mobileSum + $mCall['duration'];
			}
			
			
			
			
			
			
			$stats['firstcall'] = $firstCall['calldate'];
			$stats['lastcall'] = $lastCall['calldate'];
			
			$stats['workDuration']['sec'] = strtotime($lastCall['calldate']) - strtotime($firstCall['calldate']);
			$stats['workDuration']['read'] = voip::sec2hms($stats['workDuration']['sec']);
			
			$stats['totalDuration']['sec'] = $callDuration['duration'];
			$stats['totalDuration']['read'] = voip::sec2hms($stats['totalDuration']['sec']);
			
			$stats['totalCalls']['all'] = $totalCalls['count'];
			$stats['totalCalls']['landline'] = count($landlineCalls);
			$stats['totalCalls']['mobile'] = count($mobileCalls);
			
			$stats['durations']['mobile']['all'] = $mobileSum;
			$stats['durations']['mobile']['read'] = voip::sec2hms($mobileSum);
			$stats['durations']['mobile']['cost'] = ceil(($mobileSum * (self::mobilePPM / 60) * 100))/100;
			
			$stats['durations']['landline']['all'] = $landlineSum;
			$stats['durations']['landline']['read'] = voip::sec2hms($landlineSum);
			$stats['durations']['landline']['cost'] = ceil(($landlineSum * (self::landlinePPM / 60) * 100))/100;
			
			
			$stats['averageCallTime'] = $stats['totalDuration']['sec'] / $stats['totalCalls']['all'];
			$stats['callPercentage'] = ($stats['totalDuration']['sec'] / $stats['workDuration']['sec'])*100;
			
			$stats['claims']['accepted'] = $acceptedClaims['count'];
			$stats['hotkeys']['accepted'] = $acceptedHotkeys['count'];
			
			return $stats;
		
		
		}
		
		function monthStats($userid, $month, $year) {
			$allStats = Array();
			
			if ($month < 10)
				$month = "0".$month;
			
			$firstDay = $year."-".$month."-01";
			$daysInMonth = $date = date("t" , strtotime($firstDay));
			
			$totalCalls = 0;
			$mobileCalls = 0;
			$landlineCalls = 0;
			$workDuration = 0;
			$callDuration = 0;
			$workedDays = 0;
			
			for ($i = 1; $i <= $daysInMonth; $i++) {
			
				if ($i < 10)
					$d = "0".$i;
				else
					$d = $i;
				
				$statDay = $year."-".$month."-".$d;
				$statDayWeekday = date('N', strtotime($statDay));
				
				if ($statDayWeekday < 6) {
					
					$allStats[$statDay] = voip::dailyCallStats($userid, $statDay);
					
					$totalCalls = $totalCalls + $allStats[$statDay]['totalCalls']['all'];
					$mobileCalls = $mobileCalls + $allStats[$statDay]['totalCalls']['mobile'];
					$landlineCalls = $landlineCalls + $allStats[$statDay]['totalCalls']['landline'];
					
					$workDuration = $workDuration + $allStats[$statDay]['workDuration']['sec'];
					$callDuration = $callDuration + $allStats[$statDay]['totalDuration']['sec'];
					
					
					if ($allStats[$statDay]['totalCalls']['all'] > 0)
						$workedDays++;
				}
			}
			
			$allStats['fullMonth']['workedDays'] = $workedDays;
			
			$allStats['fullMonth']['totalCalls'] = $totalCalls;
			$allStats['fullMonth']['landline'] = $landlineCalls;
			$allStats['fullMonth']['mobile'] = $mobileCalls;
			
			$allStats['fullMonth']['workDuration']['sec'] = $workDuration;
			$allStats['fullMonth']['workDuration']['read'] = voip::sec2hms($allStats['fullMonth']['workDuration']['sec']);
			$allStats['fullMonth']['callDuration']['sec'] = $callDuration;
			$allStats['fullMonth']['callDuration']['read'] = voip::sec2hms($allStats['fullMonth']['callDuration']['sec']);
			
			$allStats['fullMonth']['callPercentage'] = ($allStats['fullMonth']['callDuration']['sec'] / $allStats['fullMonth']['workDuration']['sec'])*100;
			
			$allStats['fullMonth']['averageCallTime'] = $allStats['fullMonth']['callDuration']['sec'] / $allStats['fullMonth']['totalCalls'];
			$allStats['fullMonth']['averageCallsPerDay'] = $allStats['fullMonth']['totalCalls'] / $allStats['fullMonth']['workedDays'];
			
			return $allStats;
		}
		
		function monthCallStats($isReturn=False, $auth=False) {
		
			if (!$auth)
				$auth = explode(":", safe::get('id'));
			
			
			if ($auth[0] == 0) {
				// We want details from all users!
				$db = new database();
				$users = $db->getAll("SELECT id FROM admin_login WHERE callcenter = 1 ORDER BY id;");
				
				foreach ($users AS $user) {
					$stats[$user['id']] = voip::monthStats($user['id'], $auth[1], $auth[2]);
				}
				
			} else {
				// just the details from one user
				$stats = voip::monthStats($auth[0], $auth[1], $auth[2]);
			}
		
			if ($isReturn)
				return $stats;
			else
				print json_encode($stats);
		
		}
		
		function callStats() {
			$userid = safe::get('id');
			
			$stats = voip::monthStats($userid, 1, 2012);
			
			
			print_r($stats);
			
		}
	
	
	}

?>