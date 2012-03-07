<?PHP

	class api {
		
		
		public function getloggedOn() {
			
			$threemins = strtotime("-3 minutes");
			//$threemins = "-10";
			
			$db = new database();
			$results = $db->getAll("SELECT id, fname, sname, lastaction FROM admin_login WHERE id <> ".login::getUserID()." AND lastaction > '".$threemins."'");
			
			// Set current timestamp for this user
			$db->query("UPDATE  `cashltd_cash`.`admin_login` SET page = '".$_SERVER['HTTP_REFERER']."',  `lastaction` =  '".strtotime("now")."' WHERE  `admin_login`.`id` ='".login::getUserID()."';");
			
			print json_encode($results);
			
		}
		
		
		
		
		public function newsfeed() {
			$db = new database();
			$results = $db->getAll("SELECT admin_actions.id, admin_actions.action, admin_actions.timestamp, admin_login.fname, admin_login.sname FROM admin_actions LEFT JOIN admin_login ON admin_login.id = admin_actions.uid ORDER BY timestamp DESC LIMIT 0,20;");
		
			foreach ($results AS $result) {

					$result['timestamp'] = strtotime($result['timestamp']);
			
					$content[] = $result;
			}
	
		
			print json_encode($content);
		}
		
		
		public function tester() {
			print "test";
		}
		
		
		/*********************************************
		** Get users stats based on the actions log */
		
		public function returnUsers() {
			$db = new database();
			$users = $db->getAll("SELECT id, fname, sname FROM admin_login WHERE active = 1;");
			
			print json_encode($users);
		}
		
		public function returnActions() {
			// Decode the get string so we know what to encode
			// Should be in the format timestamp:timestamp:(id)bool:bool
			$push = explode(":", safe::get('id'));



// claimants::callTime($timestamp);

$check = (int)claimants::callTime(strtotime("now"));

			if ($push[0] == "NOW") {
				$push[0] = strtotime("now");
			} else if (strlen(safe::get('id')) < 1) {
				
				switch ($check) {
					case 1:
						$push[0] = strtotime(date("Y:m:d", strtotime("now"))." 09:00:00");
						break;
					case 2:
						$push[0] = strtotime(date("Y:m:d", strtotime("now"))." 13:00:00");
						break;
					case 3:
						$push[0] = strtotime(date("Y:m:d", strtotime("now"))." 17:00:00");
						break;
				}
				$madePeriod = TRUE;
			}
			
			if ($push[1] == "NOW") {
				$push[1] = strtotime("now");
			} else if (!isset($push[1])) {
				switch ($check) {
					case 1:
						$push[1] = strtotime(date("Y:m:d", strtotime("now"))." 12:59:59");
						break;
					case 2:
						$push[1] = strtotime(date("Y:m:d", strtotime("now"))." 16:59:59");
						break;
					case 3:
						$push[1] = strtotime(date("Y:m:d", strtotime("now"))." 20:29:59");
						break;
				}	
				$madePeriod = TRUE;
			}
			
		
			$start = $push[0];
			$end = $push[1];
			
			if (isset($push[2])) {
				$id = $push[2];
			} else {
				$id = FALSE;
			}
			
			if (isset($push[3])) {
				$time = $push[3];
			} else if ($madePeriod) {
				$time = TRUE;
			} else {
				$time = FALSE;
			}
					
			$stats = admin::getActions($start, $end, $id, $time);
			//$stats = admin::getActions(strtotime("2010:06:28 09:00:00"), strtotime("2010:06:28 10:00:00"), 4, TRUE);
			
			print json_encode($stats);
		}
		
		
				
		
		/* LETS work on the API options for the user alerting system **
		**************************************************************/
		
		public function messageViewed() {
			$db = new database();
			$db->query("UPDATE  `cashltd_cash`.`alerts` SET  `popped` =  '".strtotime("now")."' WHERE  `alerts`.`id` ='".safe::get('id')."';");
			
			site::log("Dismissed alert with message id ".safe::get('id'));	
			
			print "DONE";
		}
		
		public function messageView() {
			$db = new database();
			$db->query("UPDATE  `cashltd_cash`.`alerts` SET  `read` =  '1' WHERE  `alerts`.`id` ='".safe::get('id')."';");
			
			site::log("Viewed alert with message id ".safe::get('id'));	
			print "DONE";
		}
		
		public function updateAlertBadge() {
			
			$db = new database();
			
			$sql = "SELECT * FROM `alerts` WHERE `uid`='".login::getUserID()."' ORDER BY timestamp DESC;";
			$messages = $db->getAll($sql);
			
			$json['mustAlert'] = "FALSE";
			$count = 0;
				foreach ($messages AS $message) {
					if ($message['alert'] == 1 AND $message['popped'] == 0) {
						$json['mustAlert'] = "TRUE";
						$json['alertName'] = login::getUsernameX($message['fid']);
						$json['alertID'] = $message['id'];
					}
					
						$json['message'][$count]['title'] = $message['title'];
						$json['message'][$count]['from'] = login::getUsernameX($message['fid']);
						
						$json['message'][$count]['message'] = stripslashes($message['message']);
						$json['message'][$count]['read'] = $message['read'];
						$json['message'][$count]['id'] = $message['id'];
						
						
						if (date("dmY",$message['timestamp']) == date("dmY",strtotime("NOW")))
							{
								$json['message'][$count]['time'] = date("H:i",$message['timestamp']);
							} else {
								$json['message'][$count]['time'] = date("d/m/Y",$message['timestamp']);
							}
						
					$count++;
				}
				
			$json['messageCount'] = count($db->getAll("SELECT * FROM `alerts` WHERE `uid`='".login::getUserID()."' AND `read`='0' ORDER BY timestamp"));
			
			print json_encode($json);
		}
		


	
	public function dailystats() {
		GLOBAL $page;
		// choose the User ID's we want to post stats for
		// In this case Martin(4) Andrea(12), Yvonne(15)
		$statsfor = Array(	4 => Array("name" => "Martin"),
											 12 => Array("name" => "Andrea"),
											 15 => Array("name" => "Yvonne"),
											
												1 => Array("name" => "Simon"),
												2 => Array("name" => "Andy"),
												8 => Array("name" => "Angie"),
												6 => Array("name" => "Amy"),
												7 => Array("name" => "Louisa")
											);
		
		$yesterday = strtotime("-1 day"); // Get timestamp for yesterday
		$start = date("Y-m-d 08:30:00", $yesterday); // Work out the start of work yesterday
		$end = date("Y-m-d 20:30:00", $yesterday); // Work out the end of work yesterday
		
		// Loop through the required users and pull the stats for them into the array
		foreach ($statsfor as $userid => $name) {
			$statsfor[$userid]["stats"] = admin::getActions(strtotime($start), strtotime($end), (int)$userid, TRUE);
			$statsfor[$userid]["totalcalls"] = $statsfor[$userid]["stats"]["TotalCalls"];
		}
		
		// Sort the stats by Total Calls to show the 'Winner'
		$sortedstats = admin::subval_sort($statsfor,'totalcalls',arsort);
		
		// Finally chuck all the stats into a pretty table for display
		$tableDisplay = '<table id="statstable" cellspacing="0"><thead><tr>
		<th>Name</td>
		<th>Accepted</th>
		<th>Declined</th>
		<th>Allocated</th>
		<th>Callbacks</th>
		<th>Left Message</th>
		<th>No Answer</th>
		<th class="total">Total</th>
		</tr></thead><tbody>';
		
		foreach ($sortedstats as $userid => $name) {
			if ($sortedstats[$userid]['stats']['TotalCalls'] > 0) {
				$tableDisplay .= '<tr>
				<td>'.$sortedstats[$userid]['name'].'</td>
				<td>'.$sortedstats[$userid]['stats']['Accepted'].'</td>
				<td>'.$sortedstats[$userid]['stats']['Declined'].'</td>
				<td>'.$sortedstats[$userid]['stats']['Allocated'].'</td>
				<td>'.$sortedstats[$userid]['stats']['Callback'].'</td>
				<td>'.$sortedstats[$userid]['stats']['LeftMessage'].'</td>
				<td>'.$sortedstats[$userid]['stats']['NoAnswer'].'</td>
				<td class="total">'.$sortedstats[$userid]['stats']['TotalCalls'].'</td>
				</tr>';
			}
		}
		
		$tableDisplay .= '</tbody></table>';
		
		foreach ($statsfor as $userid => $name) {
	//	print $userid;
		
			 admin::sendAdminMessage($userid, "Daily Claimant Stats for ".date("d/m/Y", $yesterday), $tableDisplay, 1);
			
		}
		
		$page->addHTML($tableDisplay);
	}

}
	

?>