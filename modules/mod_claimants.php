<?php

	class claimants {
				
		const folder = "claimants/";
		
		// Set up call
		const morning1 = 1;
		const afternoon1 = 2;
		const evening1 = 4;
		const morning2 = 8;
		const afternoon2 = 16;
		const evening2 = 32;
		
		
		
		/*****************************************
		** Time to start baby sitting the staff */  		
		
		// Work out the time of the call in relation to
		// 1 - Morning
		// 2 - Afternoon
		// 3 - Evening
		
		public function callTime($timestamp) {
		
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
		
		// Generate the image required for the given timestamp
		public function timeImage($timestamp) {
						
			switch (claimants::callTime($timestamp)) {
				case 1:
					$_imageLink = '<img src="'.HomeUrl.'skins/cash/images/mornon.png" title="Claimant was called in the Morning" border="0" height="18" width="18">';
					break;
				case 2:
					$_imageLink = '<img src="'.HomeUrl.'skins/cash/images/afton.png" title="Claimant was called in the Afternoon" border="0" height="18" width="18">';
					break;
				case 3:
					$_imageLink = '<img src="'.HomeUrl.'skins/cash/images/nigon.png" title="Claimant was called in the Evening" border="0" height="18" width="18">';
					break;
			
			}
		
			return $_imageLink;
		}
		
		// Generate the image required for the given time section
		public function checkImage($id, $off = FALSE, $size = 18) {
						
			switch ($id) {
				case 1:
					if ($off) $_imageLink = '<img src="'.HomeUrl.'skins/cash/images/mornon.png" title="Claimant was called in the Morning" border="0" height="'.$size.'" width="'.$size.'">';
					else $_imageLink = '<img src="'.HomeUrl.'skins/cash/images/mornoff.png" title="Claimant needs calling in the Morning" border="0" height="'.$size.'" width="'.$size.'">';
					break;
				case 2:
					if ($off) $_imageLink = '<img src="'.HomeUrl.'skins/cash/images/afton.png" title="Claimant was called in the Afternoon" border="0" height="'.$size.'" width="'.$size.'">';
					else $_imageLink = '<img src="'.HomeUrl.'skins/cash/images/aftoff.png" title="Claimant needs calling in the Afternoon" border="0" height="'.$size.'" width="'.$size.'">';
					break;
				case 3:
					if ($off) $_imageLink = '<img src="'.HomeUrl.'skins/cash/images/nigon.png" title="Claimant was called in the Evening" border="0" height="'.$size.'" width="'.$size.'">';
					else $_imageLink = '<img src="'.HomeUrl.'skins/cash/images/nigoff.png" title="Claimant needs calling in the Evening" border="0" height="'.$size.'" width="'.$size.'">';
					break;
			
			}
		
			return $_imageLink;
		}
		
		
		public function makePrettyCallTime($cid) {
			
			$getArray = claimants::checkCallTimes($cid);
			
			$day1[] = claimants::checkImage(1,$getArray['morning1']);
			$day1[] = claimants::checkImage(2,$getArray['afternoon1']);
			$day1[] = claimants::checkImage(3,$getArray['evening1']);
			
			
			$day2[] = claimants::checkImage(1,$getArray['morning2']);
			$day2[] = claimants::checkImage(2,$getArray['afternoon2']);
			$day2[] = claimants::checkImage(3,$getArray['evening2']);
			
			$makeLink = "";
			foreach ($day1 AS $day) {
				$makeLink .= $day;
			}
			$makeLink .= " ";
			foreach ($day2 AS $day) {
				$makeLink .= $day;
			}	
			if (safe::get('id') == "debug")	print_r($getArray);
			
			return $makeLink;			
		}
		
		
				
		public function checkCallTimes($cid) {
			
			
			$_morning = ARRAY();
			$_afternoon = ARRAY();
			$_evening = ARRAY();
			
			$events = Array();
			
			$db = new database();
			$noanswerresults = $db->getAll("SELECT * FROM claimants_noanswers WHERE cid='".$cid."' ORDER BY timestamp DESC");
			
				foreach($noanswerresults as $result) {
					
					$result['user'] = login::getUsernameX($result['uid']);
					$result['timeofday'] = claimants::callTime($result['timestamp']);
					$result['dateDay'] = date("j",$result['timestamp']);
					
					$events[] = $result;
					
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
		
		
		// Well we'd better get rid of all the '6 checks' data 
		// I say get rid, I actually mean send it to mail merge
		
		public function bitAllx() {
			$db = new database();
			$results = $db->getAll("SELECT id, clientid, timestamp FROM claimants_data ORDER BY id DESC ;");
			
			foreach ($results AS $result) {
			
				$check = claimants::checkCallTimes($result['id']);
				$thisBit = 0;
				
				if ($check['morning1']) $thisBit = $thisBit + self::morning1;
				if ($check['morning2']) $thisBit = $thisBit + self::morning2;
				if ($check['afternoon1']) $thisBit = $thisBit + self::afternoon1;
				if ($check['afternoon2']) $thisBit = $thisBit + self::afternoon2;
				if ($check['evening1']) $thisBit = $thisBit + self::evening1;
				if ($check['evening2']) $thisBit = $thisBit + self::evening2;
				
				print $result['id'] . " - " . $thisBit . "<br />";
				
				$db->query("UPDATE claimants_data SET  `bit` =  '".$thisBit."' WHERE  `claimants_data`.`id` ='".$result['id']."';");
				
			}
			
		}
		
		public function sixChecks() {
		
			$db = new database();
			$results = $db->getAll("SELECT id, clientid, timestamp FROM claimants_data WHERE status=0;");
			
			foreach ($results AS $result) {
			
				$check = claimants::checkCallTimes($result['id']);
				
				if ( // Check all times are TRUE
					$check['morning1'] AND 
					$check['morning2'] AND 
					$check['afternoon1'] AND 
					$check['afternoon2'] AND 
					$check['evening1'] AND 
					$check['evening2'] ) 
				{
					$newArray[] = $result;
				}
			}
			
			foreach ($newArray AS $ar) {
			
				$dbquery = new database();
				$dbquery->query("UPDATE  `cashltd_cash`.`claimants_data` SET  `status` =  '5', timestamp = '".$ar['timestamp']."' WHERE  `claimants_data`.`id` ='".$ar['id']."';");
				$dbquery->query("UPDATE  `cashltd_cash`.`total_claimants` SET  `status` =  '2' WHERE  `total_claimants`.`id` ='".$ar['clientid']."';");
			
			}

		}
		
		
		public function setMailmerged($id) {
				$dbquery = new database();
				$dbquery->query("UPDATE  `cashltd_cash`.`total_claimants` SET  `status` =  '6' WHERE  `total_claimants`.`id` ='".$id."';");
		}
		
		
		
		/* Time to end baby sitting the staff **	
		***************************************/


		
		public function sendSMS($telephone, $message) {
			
			if ($telephone[0] != "0") {
				$telephone = "0".str_replace(" ","",$telephone);
			}
			
			site::log("Sent an SMS to ".$telephone);			
			
			$itaggapi = "https://secure.itagg.com/smsg/sms.mes";
			$params="usr=cashltd&pwd=qwerty123&from=cash-ltd&to=".$telephone."&type=text&route=7&txt=".$message;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $itaggapi); curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			$returned = curl_exec ($ch);
			curl_close ($ch);
			// print($returned); // This will be the OK / error message		
			
			
		}
		
		
		
		public function sendtextmessage() {
			$claimant = new ClaimantData(safe::get("id"));
			$claimant->SendTextMessage();
		}
		
		
		public function makeCSVline($dbArray,$or=0) {
				
				$csvSTR="";
				$first = TRUE;
				foreach($dbArray as $key => $item) {
					if (!is_numeric($key) OR $or==1) {
							if (!$first) {
								$csvSTR .= ",";
							}
						$csvSTR .= $item;
						$first = FALSE;	
					}
				}
				return $csvSTR."\n";
			}
		
		
		// AJAX Callbacks
		
		
		
		
		/*****************
		** Just for fun */
		
		public function helloMessage($time) {
		
			$langs[1] = "English in case you weren't sure ;)";
			$langs[2] = "German";
			$langs[3] = "French";
			$langs[4] = "Italian";
			$langs[5] = "Portuguese";
			$langs[6] = "Russian";
			$langs[7] = "Spanish";
			$langs[8] = "Greek";
			$langs[9] = "Chinese";
			$langs[10] = "Dutch";
			$langs[11] = "Lithuanian";
			
			$pickLang = rand(1, count($langs));
			
			// Populate Languages
			// Good Morning
			$languages[1][1] = "Good Morning";
			$languages[1][2] = "Guten Morgen";
			$languages[1][3] = "Bonjour";
			$languages[1][4] = "Buongiorno";
			$languages[1][5] = "Bom dia";
			$languages[1][6] = "Доброе утро";
			$languages[1][7] = "Buenos días";
			$languages[1][8] = "Καλημέρα";
			$languages[1][9] = "早晨好";
			$languages[1][10] = "Goedemorgen";
			$languages[1][11] = "Labas Rytas";
		
			// Good Afternoon
			$languages[2][1] = "Good Afternoon";
			$languages[2][2] = "Guten Tag";
			$languages[2][3] = "Bonjour";
			$languages[2][4] = "Buon pomeriggio";
			$languages[2][5] = "Boa tarde";
			$languages[2][6] = "Добрый день";
			$languages[2][7] = "Buonas tardes";
			$languages[2][8] = "Καλό απόγευμα";
			$languages[2][9] = "你好";
			$languages[2][10] = "Goede Middag";
			$languages[2][11] = "Labą Dieną";

			// Good Evening
			$languages[3][1] = "Good Evening";
			$languages[3][2] = "Guten Abend";
			$languages[3][3] = "Bonsoir";
			$languages[3][4] = "Buona sera";
			$languages[3][5] = "Boa noite";
			$languages[3][6] = "Добрый вечер";
			$languages[3][7] = "Buonas noches";
			$languages[3][8] = "Καλό βράδυ";
			$languages[3][9] = "晚上好";
			$languages[3][10] = "Goede Avond";
			$languages[3][11] = "Labas Vakaras";
		
			$chosen['greeting'] = $languages[$time][$pickLang];
			$chosen['language'] = $langs[$pickLang];
			$chosen['eng'] = $languages[$time][1];
			
			return $chosen;
		}
		
		
		/* Just for fun **
		*****************/
		
		
		
		
		public function contactedTimeTest() {
			$id = 140;
			$period = 1;
			
			$db = new database();
			$results = $db->getAll("SELECT * FROM claimants_noanswers WHERE cid = '".$id."'");
		
			$contacts = ARRAY();
			foreach ($results AS $result) {
				if (claimants::callTime($result['timestamp']) == $period) {
				
				
					if (date("dmY",$result['timestamp']) == date("dmY",strtotime("NOW"))) {				
						$contacts[] = $result;
					}
				}
			}

			if (count($contacts) > 0) {
				print("Contacted in this period");
			} else {
				print("Not Contacted in this period");
			}
			
		
		}
		
		
		
		// function to check if the claimant was called at this time of the day
		// on todays date
		// Usage: claimants::contactedThisTime(1231231, 2, 1);
		public function contactedThisTime($timestamp, $id, $period) {
			// claimants::callTime(timestamp)
		
		
			$db = new database();
			$results = $db->getAll("SELECT * FROM claimants_noanswers WHERE cid = '".$id."'");
		
			$contacts = ARRAY();
			foreach ($results AS $result) {
				if (claimants::callTime($result['timestamp']) == $period) {
				
				
					if (date("dmY",$result['timestamp']) == date("dmY",strtotime("NOW"))) {				
						$contacts[] = $result;
					}
				}
			}

			if (count($contacts) > 0) {
				return TRUE;
			} else {
				return FALSE;
			}
		
		
			
		}
		
		
		public function GenerateClaimantArray()
		{
		


			// This function is quite high maintainance and could be rewritten better!
			// 13-02-2012 - Rewritten to use bitwise functions to speed up data loading. 
			
			$today = date("Y-m-d", strtotime("now"));
			
			$_currentPeriod = claimants::callTime(strtotime("now"));
	
			// Pull High Importance from the database
			if ($_currentPeriod== 1) { $bitPoint[0] = self::morning1; $bitPoint[1] = self::morning2; }
			else if ($_currentPeriod== 2) { $bitPoint[0] = self::afternoon1; $bitPoint[1] = self::afternoon2; } 
			else if ($_currentPeriod== 3) { $bitPoint[0] = self::evening1; $bitPoint[1] = self::evening2; }
			
		
			$claimantDatabase = new Database();
			
			// Get a list of important CSV files so we can prioritise these
			$importantCSV = $claimantDatabase->getAll("SELECT id FROM claimants_csv_data WHERE highpriority > '0' ORDER BY highpriority ASC;");
			$important = Array();
			
			foreach ($importantCSV AS $imp) $important[] = $imp['id'];
			
			$importantOrder = implode(", ", $important);
		
			
			// Has NEVER been called by us! EVER!
			$uberResults = $claimantDatabase->getAll("SELECT claimants_data.id FROM claimants_data INNER JOIN total_claimants ON claimants_data.clientid=total_claimants.id WHERE claimants_data.status='0' AND bit = 0 AND !(claimants_data.supplier='2') ORDER BY FIELD(total_claimants.csv, ".$importantOrder.") DESC, total_claimants.csv ASC;");
			
			// No calls on day 1 or day 2 in this period
			$highResults = $claimantDatabase->getAll("SELECT claimants_data.id FROM claimants_data INNER JOIN total_claimants ON claimants_data.clientid=total_claimants.id WHERE claimants_data.status='0' AND bit > 0 AND !(bit & ".$bitPoint[0].") AND !(bit & ".$bitPoint[1].") AND !(claimants_data.supplier='2') ORDER BY FIELD(total_claimants.csv, ".$importantOrder.") DESC, total_claimants.csv ASC;");
			
			// Calls on day 1 but none on day 2 in this period
			$mediumResults = $claimantDatabase->getAll("SELECT claimants_data.id FROM claimants_data INNER JOIN total_claimants ON claimants_data.clientid=total_claimants.id WHERE claimants_data.status='0' AND bit > 0 AND (bit & ".$bitPoint[0].") AND !(bit & ".$bitPoint[1].") AND ( !(timestamp LIKE '".$today."%') AND (lastcallperiod=".$_currentPeriod.")) AND !(claimants_data.supplier='2') ORDER BY FIELD(total_claimants.csv, ".$importantOrder.") DESC, total_claimants.csv ASC;");
			
						
			
			// Has been called in this period already
			$lowResults = $claimantDatabase->getAll("SELECT claimants_data.id FROM claimants_data INNER JOIN total_claimants ON claimants_data.clientid=total_claimants.id WHERE claimants_data.status='0' AND bit < 63 AND bit > 0 AND (bit & ".$bitPoint[0].") AND (bit & ".$bitPoint[1].") ORDER BY bit AND !(supplier='2') ORDER BY FIELD(total_claimants.csv, ".$importantOrder.") DESC, total_claimants.csv ASC;");
			
			
			
			//print "<div style='top: 0px; position: fixed;'>"."SELECT claimants_data.id FROM claimants_data INNER JOIN total_claimants ON claimants_data.clientid=total_claimants.id WHERE claimants_data.status='0' AND bit > 0 AND (bit & ".$bitPoint[0].") AND !(bit & ".$bitPoint[1].") AND ( (timestamp LIKE '".$today."%') AND (lastcallperiod=".$_currentPeriod.")) AND !(claimants_data.supplier='2') ORDER BY FIELD(total_claimants.csv, ".$importantOrder.") DESC, total_claimants.csv ASC;"."</div>";
					
					
			// Callback Queue
			$callbackResults = $claimantDatabase->getAll("SELECT claimants_data.id FROM claimants_data INNER JOIN total_claimants ON claimants_data.clientid=total_claimants.id WHERE claimants_data.status='0' AND claimants_data.supplier='2' AND callback < '".date("Y-m-d H:i:s", strtotime("now"))."' ORDER BY claimants_data.callback DESC;");
			
			

			if (login::getStrict() == 1)
				$_STRICT = TRUE;
			else
				$_STRICT = FALSE;
				
			// If we have callbacks then we forget everything else!
			if (count($callbackResults) > 0)
			{
				$allData = $callbackResults;
			} else {
				if ($_currentPeriod == 3) {
					// Since there is less time to call in the evening we modify the order to get six checks completed on evening calls
					$allData = array_merge((array)$mediumResults, (array)$highResults, (array)$uberResults, (array)$lowResults, (array)$callbackResults);
				} else {
					// If we are in strict mode then we only show Uber and High results until there are none left!
					if ($_STRICT AND (count($uberResults) + count($highResults) + count($mediumResults) ) > 0) {
						$allData = array_merge((array)$uberResults, (array)$highResults, (array)$mediumResults, (array)$callbackResults);
					} else {
						$allData = array_merge((array)$uberResults, (array)$highResults, (array)$mediumResults, (array)$lowResults, (array)$callbackResults);
					}
				}
			}

			$data = Array();
			foreach ($allData as $item)
			{
				$claimant = new ClaimantData($item['id']);
				$data[] = $claimant->asArray();
			}
			
			return $data;
		
		}
		
		
		
		
		public function freshdata() {
			GLOBAL $page;
				
				$_currentPeriod = claimants::callTime(strtotime("now"));
				$_hello = claimants::helloMessage($_currentPeriod);
			
				$currenticon = claimants::checkImage($_currentPeriod, TRUE, 36) . "<span class='greeting'>" . $_hello['greeting'] . "<b>which is ".$_hello['eng']." in ".$_hello['language']."</b></span>";
		
				$data = claimants::GenerateClaimantArray();

				if (count($data) < 1 ) {
					$page->addHtml("<center><b>No new claims at this time</b></center>");
				} else {
					$page->addPage("claimants/freshdata.tpl", ARRAY( 'data' => $data, 'currenticon' => $currenticon ));	
				}

		}
		
		public function olddata() {
			GLOBAL $page;
			
				$data = explode("-", safe::get('id'));
			
				$supplier = $data[0];
				$start = $data[1];
				$perpage = $data[2];
				$user = $data[3];
			
					$where = " status='2'";
						if ($supplier != 0) {
								if (strlen($where) > 2) $where .= " AND";
							$where .= " supplier='".$supplier."'";
						}
				
						if ($user != 0) {
								if (strlen($where) > 2) $where .= " AND";
							$where .= " userid='".$user."'";
						}
				
				if (strlen($where) > 2) $where = "WHERE" . $where;
						
				$shprev = 0;
				if ($start < 0) { 
					$start = 0;
				 } else if ($start > 0) {
				 	$shprev = 1;
				 }
				
				
				
				$db = new database();
				$sql = "SELECT * FROM claimants_data ".$where." ORDER BY timestamp DESC LIMIT ".((int)$start*$perpage).",".$perpage."";
				$datas = $db->getAll($sql);
				
				
				$datasr = Array();
				if (count($datas) > 0) {
					foreach ($datas AS $dat) {
						$dat['userid'] = login::getUsernameX($dat['userid']);
						$datasr[] = $dat;
					}
				}
				
				
				if (count($datas) < 1) {
					$page->addHtml("<center><b>No declined claims at this time</b></center>");
				} else {
					$page->addPage("claimants/olddata.tpl", ARRAY( 'data' => $datasr, 'pagenumber' => (int)$start+1, "shprev" => $shprev ));	
				}
		}		
		
		public function newdata() {
			GLOBAL $page;
			
				$data = explode("-", safe::get('id'));
			
				$supplier = $data[0];
				$start = $data[1];
				$perpage = $data[2];
				$user = $data[3];
			
					$where = " status='1'";
						if ($supplier != 0) {
								if (strlen($where) > 2) $where .= " AND";
							$where .= " supplier='".$supplier."'";
						}
				
						if ($user != 0) {
								if (strlen($where) > 2) $where .= " AND";
							$where .= " userid='".$user."'";
						}
				
				if (strlen($where) > 2) $where = "WHERE" . $where;
						
				$shprev = 0;
				if ($start < 0) { 
					$start = 0;
				 } else if ($start > 0) {
				 	$shprev = 1;
				 }
				
				
				
				$db = new database();
				$sql = "SELECT * FROM claimants_data ".$where." ORDER BY timestamp DESC LIMIT ".((int)$start*$perpage).",".$perpage."";
				$datas = $db->getAll($sql);
				
				
				
								
				$datasr = Array();
					if (count($datas) > 0) {
					foreach ($datas AS $dat) {
					
					
						$dbcsv = new database();
						$sql = "SELECT filename, accepteddate FROM total_claimants, claimants_csv_data WHERE total_claimants.csv = claimants_csv_data.id AND total_claimants.id='".$dat['clientid']."'";
						$reg = $dbcsv->getFirst($sql);
											
						$dat['csv'] = $reg['filename'];
						$dat['accepted'] = $reg['accepteddate'];

						$dat['userid'] = login::getUsernameX($dat['userid']);



						$datasr[] = $dat;
					}
				}
				
				if (count($datas) < 1) {
					$page->addHtml("<center><b>No accepted claims at this time</b></center>");
				} else {
					$page->addPage("claimants/newdata.tpl", ARRAY( 'data' => $datasr, 'pagenumber' => (int)$start+1, "shprev" => $shprev ));	
				}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function goCallback() {
		
			$cid = (INT)safe::get('id');

			$now = strtotime("now");
			
			// Find the timestamps for day start and day end
			$dayStart = strtotime(date("Y-m-d 00:00:00", $now));
			$dayEnd = strtotime(date("Y-m-d 23:59:59", $now));

			// Check current Time Period
			$_currentPeriod = claimants::callTime($now);
			
			// Bitwise details for the current time period
			if ($_currentPeriod== 1) { $bitPoint[0] = self::morning1; $bitPoint[1] = self::morning2; }
			else if ($_currentPeriod== 2) { $bitPoint[0] = self::afternoon1; $bitPoint[1] = self::afternoon2; } 
			else if ($_currentPeriod== 3) { $bitPoint[0] = self::evening1; $bitPoint[1] = self::evening2; }
			
			// Find when the claimant has already been called today
			$db = new database();
			$noanswerresults = $db->getAll("SELECT * FROM claimants_noanswers WHERE cid='".$cid."' AND timestamp >= '".$dayStart."' AND timestamp <= '".$dayEnd."' ORDER BY timestamp DESC");
		
			// See if the claimant has been called in this period today
			$inThisPeriod = FALSE;
			if (count($noanswerresults) > 0)
			{	// Better check!			
				foreach ($noanswerresults AS $noAnswer)
				{
					if (claimants::callTime($noAnswer['timestamp']) == $_currentPeriod)
					{
						$inThisPeriod = TRUE;
					}
				}
			}
	
	
			$db = new database();
			$reg = $db->getFirst("SELECT `timestamp`, `clientid`, `bit`,  FROM `claimants_data` WHERE `id` = ".$cid." LIMIT 1 ;");
			
			// If we have not called in this period today then lets update the bit
			if (!$inThisPeriod)
			{
			
				if ( !($reg['bit'] & $bitPoint[0]) )
				{	// Day one of this bit point hasn't been set
					$newBit = $reg['bit'] + $bitPoint[0];
				} else if ( !($reg['bit'] & $bitPoint[1]) )
				{	// Day two of this bit point hasn't been set
					$newBit = $reg['bit'] + $bitPoint[1];
				}
				
				// Update the bit point in the database
				$updateBit = new Database();
				$updateBit->query("UPDATE `claimants_data` SET `bit` = '".$newBit."' WHERE `id` = ".$cid." LIMIT 1 ;");
			
				print "Updating the bit";
			}
			
			// Do the default actions now to make sure everything is done the same as it used to be!
			
			site::log("Set Client No:".$reg['clientid']." as a Callback.");
			
			$db->query("UPDATE `claimants_data` SET callback='".safe::post('date')."', `lastcallperiod` = '".$_currentPeriod."', `timestamp` = '".date("Y-m-d H:i:s", $now)."', supplier='2' WHERE `id` = ".$cid." LIMIT 1 ;");
		}
		
		public function goNoAnswer() {

			$cid = (INT)safe::get('id');
		
			$now = strtotime("now");
			
			// Find the timestamps for day start and day end
			$dayStart = strtotime(date("Y-m-d 00:00:00", $now));
			$dayEnd = strtotime(date("Y-m-d 23:59:59", $now));

			// Check current Time Period
			$_currentPeriod = claimants::callTime($now);
			
			// Bitwise details for the current time period
			if ($_currentPeriod== 1) { $bitPoint[0] = self::morning1; $bitPoint[1] = self::morning2; }
			else if ($_currentPeriod== 2) { $bitPoint[0] = self::afternoon1; $bitPoint[1] = self::afternoon2; } 
			else if ($_currentPeriod== 3) { $bitPoint[0] = self::evening1; $bitPoint[1] = self::evening2; }
			
			// Find when the claimant has already been called today
			$db = new database();
			$noanswerresults = $db->getAll("SELECT * FROM claimants_noanswers WHERE cid='".$cid."' AND timestamp >= '".$dayStart."' AND timestamp <= '".$dayEnd."' ORDER BY timestamp DESC");
		
			// See if the claimant has been called in this period today
			$inThisPeriod = FALSE;
			if (count($noanswerresults) > 0)
			{	// Better check!			
				foreach ($noanswerresults AS $noAnswer)
				{
					if (claimants::callTime($noAnswer['timestamp']) == $_currentPeriod)
					{
						$inThisPeriod = TRUE;
					}
				}
			}
	
	
			$db = new database();
			$reg = $db->getFirst("SELECT `timestamp`, `clientid`, `bit` FROM `claimants_data` WHERE `id` = ".$cid." LIMIT 1 ;");
			
			// If we have not called in this period today then lets update the bit
			if (!$inThisPeriod)
			{
			
				if ( !($reg['bit'] & $bitPoint[0]) )
				{	// Day one of this bit point hasn't been set
					$newBit = $reg['bit'] + $bitPoint[0];
				} else if ( !($reg['bit'] & $bitPoint[1]) )
				{	// Day two of this bit point hasn't been set
					$newBit = $reg['bit'] + $bitPoint[1];
				}
				
				// Update the bit point in the database
				$updateBit = new Database();
				$updateBit->query("UPDATE `claimants_data` SET `bit` = '".$newBit."' WHERE `id` = ".$cid." LIMIT 1 ;");
			
				print "Updating the bit";
			}
			
			// Do the default actions now to make sure everything is done the same as it used to be!
			
		
		
		
			$db = new database();
			$reg = $db->getFirst("SELECT `timestamp`, `clientid` FROM `claimants_data` WHERE`id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			
			site::log("Set Client No:".$reg['clientid']." as a No Answer.");
			
			$db->query("INSERT INTO  `cashltd_cash`.`claimants_noanswers` (
						`id` ,
						`cid` ,
						`timestamp`,
						`message`,
						`uid`
						)
						VALUES (
						NULL ,  '".(INT)safe::get('id')."',  '".strtotime("NOW")."', 'No Answer', '".login::getUserID()."'
						);");
			
			
			$db->query("UPDATE `claimants_data` SET `lastcallperiod` = '".$_currentPeriod."', `timestamp` = '".date("Y-m-d H:i:s", $now)."', supplier='3' WHERE `id` = ".(INT)safe::get('id')." LIMIT 1 ;");
		}
		public function goNoAnswerMessage() {
		
			$cid = (INT)safe::get('id');
		
			$now = strtotime("now");
			
			// Find the timestamps for day start and day end
			$dayStart = strtotime(date("Y-m-d 00:00:00", $now));
			$dayEnd = strtotime(date("Y-m-d 23:59:59", $now));

			// Check current Time Period
			$_currentPeriod = claimants::callTime($now);
			
			// Bitwise details for the current time period
			if ($_currentPeriod== 1) { $bitPoint[0] = self::morning1; $bitPoint[1] = self::morning2; }
			else if ($_currentPeriod== 2) { $bitPoint[0] = self::afternoon1; $bitPoint[1] = self::afternoon2; } 
			else if ($_currentPeriod== 3) { $bitPoint[0] = self::evening1; $bitPoint[1] = self::evening2; }
			
			// Find when the claimant has already been called today
			$db = new database();
			$noanswerresults = $db->getAll("SELECT * FROM claimants_noanswers WHERE cid='".$cid."' AND timestamp >= '".$dayStart."' AND timestamp <= '".$dayEnd."' ORDER BY timestamp DESC");
		
			// See if the claimant has been called in this period today
			$inThisPeriod = FALSE;
			if (count($noanswerresults) > 0)
			{	// Better check!			
				foreach ($noanswerresults AS $noAnswer)
				{
					if (claimants::callTime($noAnswer['timestamp']) == $_currentPeriod)
					{
						$inThisPeriod = TRUE;
					}
				}
			}
	
	
			$db = new database();
			$reg = $db->getFirst("SELECT `timestamp`, `clientid`, `bit` FROM `claimants_data` WHERE `id` = ".$cid." LIMIT 1 ;");
			
			// If we have not called in this period today then lets update the bit
			if (!$inThisPeriod)
			{
			
				if ( !($reg['bit'] & $bitPoint[0]) )
				{	// Day one of this bit point hasn't been set
					$newBit = $reg['bit'] + $bitPoint[0];
				} else if ( !($reg['bit'] & $bitPoint[1]) )
				{	// Day two of this bit point hasn't been set
					$newBit = $reg['bit'] + $bitPoint[1];
				}
				
				// Update the bit point in the database
				$updateBit = new Database();
				$updateBit->query("UPDATE `claimants_data` SET `bit` = '".$newBit."' WHERE `id` = ".$cid." LIMIT 1 ;");
			
				print "Updating the bit";
			}
			
			// Do the default actions now to make sure everything is done the same as it used to be!
		
		
			$db = new database();
			$reg = $db->getFirst("SELECT `timestamp`, `clientid` FROM `claimants_data` WHERE`id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			
			site::log("Set Client No:".$reg['clientid']." as Left a Message.");
			
						$db->query("INSERT INTO  `cashltd_cash`.`claimants_noanswers` (
						`id` ,
						`cid` ,
						`timestamp`,
						`message`,
						`uid`
						)
						VALUES (
						NULL ,  '".(INT)safe::get('id')."',  '".strtotime("NOW")."', 'Left a Message', '".login::getUserID()."'
						);");
			
			$db->query("UPDATE `claimants_data` SET `lastcallperiod` = '".$_currentPeriod."', `timestamp` = '".date("Y-m-d H:i:s", $now)."', supplier='4' WHERE `id` = ".(INT)safe::get('id')." LIMIT 1 ;");
		}
		
		
		
		
		
		
		
		
		
		
		
		
		public function goRecoverHotkey() {
			$db = new database();
			$reg = $db->getFirst("SELECT `timestamp` FROM `claimants_data` WHERE`id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			$db->query("UPDATE `claimants_data` SET `comment` = '', `timestamp` = '".$reg['timestamp']."', `status` = '0' WHERE `id` = ".(INT)safe::get('id')." LIMIT 1 ;");
		}
		
		public function goRemoveHotkey() {
			$db = new database();
			$reg = $db->getFirst("SELECT `timestamp` FROM `claimants_data` WHERE`id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			$db->query("UPDATE `claimants_data` SET `comment` = '".safe::post('comment')."',  `timestamp` = '".$reg['timestamp']."', `status` = '-1' WHERE `id` = ".(INT)safe::get('id')." LIMIT 1 ;");
		}
		
		public function verify() {
			$db = new database();
			$reg = $db->getFirst("SELECT clientid, `timestamp` FROM `claimants_data` WHERE`id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			
			site::log("Set Client No:".$reg['clientid']." as Accepted.");
			
			$db->query("UPDATE `claimants_data` SET `comment` = '',  `timestamp` = '".$reg['timestamp']."', supplier='1', `status` = '1' WHERE `id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			$db->query("UPDATE  `cashltd_cash`.`total_claimants` SET  `status` =  '1', `accepteddate`='".strtotime("now")."' WHERE  `total_claimants`.`id` =".$reg['clientid'].";");
			
			
		}
		
		public function goDecline() {
			$db = new database();
			$reg = $db->getFirst("SELECT `timestamp`, `clientid` FROM `claimants_data` WHERE`id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			site::log("Set Client No:".$reg['clientid']." as Declined.");
			
			$db->query("UPDATE `claimants_data` SET `comment` = '".safe::post('comment')."',  `timestamp` = '".$reg['timestamp']."', supplier='1', `status` = '2' WHERE `id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			
		}
		
		public function submitAddhotkey() {
			
	
			$newclaim = new database();
			$newDetails = $newclaim->getFirst("SELECT * FROM total_claimants WHERE status = 0 ORDER BY id;");
			
			
			$insertclaim = new database();
			$insertclaim->query("INSERT INTO  `cashltd_cash`.`claimants_data` (
								`id` ,
								`supplier` ,
								`fname` ,
								`sname` ,
								`tel` ,
								`mobile` ,
								`email` ,
								`userid` ,
								`clientid` ,
								`timestamp` ,
								`status` ,
								`comment`
								)
								VALUES (
								NULL ,  '1',  '".$newDetails['forename']."',  '".$newDetails['surname']."',  '".$newDetails['telephone']."',  '".$newDetails['mobile']."',  '".$newDetails['email']."',  '".login::getUserID()."',  '".$newDetails['id']."', 
								CURRENT_TIMESTAMP ,  '0',  ''
								);
								");
			
			
			$db = new database();
			$db->query("UPDATE  `cashltd_cash`.`total_claimants` SET  `status` =  '1' WHERE  `total_claimants`.`id` =".$newDetails['id'].";");
			
			
			
			site::log("Was allocated a new claimant No:".$newDetails['id'].".");
			
		}
		
		
		
		
		
		
		public function goAssignCSV() {
			GLOBAL $page;
			
			$db = new database();
			
			$staff = $db->getAll("SELECT id, fname, sname FROM `admin_login` WHERE active='1' ORDER BY fname;");
			$csvs = $db->getAll("SELECT id, filename, timestamp FROM `claimants_csv_data` ORDER BY timestamp DESC");
			
			
			$page->addPage( self::folder . "goassigncsv.tpl", ARRAY( "staff" => $staff, "csvs" => $csvs ) );
		}
		
		
		public function AssignCSVDone() {
			GLOBAL $page;
		
			$report = claimants::assignCSV( safe::post('csv'), safe::post('staff') );
		
		
			admin::sendAdminMessage(safe::post('staff'), "You have been assigned a CSV file", "You have just been assigned new claimants. To call these possible claimants please View your claimants list as soon as possible!", 1);
		
			$page->addHTML($report);
			$page->addPage(self::folder . "assigncsvdone.tpl");
		}
		
		
		public function assignCSV($csvid, $userid) {
			$assigned = "";
			$newclaim = new database();
			$sql = "SELECT * FROM total_claimants WHERE status = 0 AND csv='".$csvid."' ORDER BY id;";
			$newDetailsTotal = $newclaim->getAll($sql);
			
			
			foreach ($newDetailsTotal AS $newDetails) {
			$insertclaim = new database();
			$insertclaim->query("INSERT INTO  `cashltd_cash`.`claimants_data` (
								`id` ,
								`supplier` ,
								`fname` ,
								`sname` ,
								`tel` ,
								`mobile` ,
								`userid` ,
								`clientid` ,
								`timestamp` ,
								`status` ,
								`comment`
								)
								VALUES (
								NULL ,  '1',  '".$newDetails['forename']."',  '".$newDetails['surname']."',  '".$newDetails['telephone']."',  '".$newDetails['mobile']."',  '".$userid."',  '".$newDetails['id']."', 
								CURRENT_TIMESTAMP ,  '0',  ''
								);
								");
								
								$assigned .= "Assigning ".$newDetails['forename']." to User<br />";
			
			
			$db = new database();
			 $db->query("UPDATE  `cashltd_cash`.`total_claimants` SET  `status` =  '1' WHERE  `total_claimants`.`id` =".$newDetails['id'].";");
			
			}
			
			return $assigned;
		}

		
		
		
		
		
		
		
		
		
		
		
		public function goDuplicate() {
				
			$db = new database();
			$res = $db->getFirst("SELECT * FROM claimants_data WHERE id='".safe::get('id')."';");
			
			site::log("Set Client No:".$res['clientid']." as a duplicate.");
			
			$dbquery = new database();
			$dbquery->query("UPDATE  `cashltd_cash`.`claimants_data` SET  `status` =  '5', timestamp = '".$res['timestamp']."' WHERE  `claimants_data`.`id` ='".$res['id']."';");
			
			$dbquery->query("UPDATE  `cashltd_cash`.`total_claimants` SET  `status` =  '3' WHERE  `total_claimants`.`id` ='".$res['clientid']."';");
			
		
		}
		
		
		public function goViewHotkey() {
			GLOBAL $page;
			
			$db = new database();
			$details = $db->getFirst("SELECT * FROM claimants_data WHERE id='".safe::get('id')."'");
			$db1 = new database();
			$user = $db1->getFirst("SELECT fname, sname FROM admin_login WHERE id='".$details['userid']."'");
			$db2 = new database();
			$supplier = $db2->getFirst("SELECT name FROM claimants_suppliers WHERE id='".$details['supplier']."'");
			
			$page->addPage(self::folder . "viewhotkey.tpl", ARRAY( "items" => $details, "user" => $user, "supplier" => $supplier ) );
		}
		
		public function CSVOptions() {
			GLOBAL $page;
						
			$db = new database();
			$suppliers = $db->getAll("SELECT id, name FROM `claimants_suppliers` ORDER BY name;");
			
			$page->addPage(self::folder . "csvoptions.tpl", ARRAY( "suppliers" => $suppliers ) );
			$page->fullReplace("[-currentmodule-]", "Get New Claimant");
			$page->fullReplace("[-currentmodulelink-]", "javascript:addNewHotkey();");
		}
		
		public function downloadCSV() {
			$supname = "AllSuppliers";
			if ((int)safe::post('supplier') > 0) {
				$getdet = new database();
				$det = $getdet->getFirst("SELECT name FROM claimants_suppliers WHERE id='".(int)safe::post('supplier')."'");
				
				$supname = $det['name'];
			}
			
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=".$supname."-".date("dmY-Hi",strtotime("now")).".csv");
			header("Pragma: no-cache");
			header("Expires: 0");
			
			if (strlen(safe::post('start')) > 1) {
			$where = " timestamp >= '".safe::post('start')." 00:00:00' AND timestamp <= '".safe::post('end')." 23:59:99'";
			} else {
			$where = "";	
			}
			
			if ((int)safe::post('supplier') > 0) {
				
				if (strlen($where) > 1)
				{
					$where .= " AND";
				}
				
				$where .= " supplier = '".(int)safe::post('supplier')."' AND  status > '-1'";
			} else {
				$where .= " status > '-1'";
			}
			
				if (strlen($where) > 1)
				{
					$where = " WHERE".$where;
				}		
			
			
					$db = new Database();
			  $phpString = "SELECT fname, sname, tel, timestamp, comment, status FROM claimants_data".$where." ORDER BY timestamp DESC";
				
					$csvres = $db->getAll($phpString);
			
			
			foreach($csvres[0] as $key => $item) {
				if (!is_numeric($key)) {
					$coltite[] .= $key;
				}
			}
			
			print datasuppliers::makeCSVline($coltite, 1)."\n";
			
			foreach($csvres AS $csv) {
				if ($csv[status] == 0) $csv[status] = "Not Called";
				if ($csv[status] == 1) $csv[status] = "Claiming";
				if ($csv[status] == 2) $csv[status] = "NOT Claiming";
				$csv[comment] = str_replace(",","",$csv[comment]);
				print datasuppliers::makeCSVline($csv);		
			}
		}
		
		
		
		
		public function threeStrikes() {
			GLOBAL $page;
			// Function to pull out the Three Strikes data and make it 'returned' in main database
		
			$threeStrikesNumber = 3;

			$db = new database();
			
			$results = $db->getAll("SELECT claimants_data.id, claimants_data.clientid FROM claimants_data WHERE (claimants_data.supplier=3 OR claimants_data.supplier=4) AND claimants_data.status=0");
		
			$tid = 0;
			foreach ($results AS $res) {
				
				$fixedArray[$tid]['id'] = $res['id'];
				$fixedArray[$tid]['cid'] = $res['clientid'];
				$fixedArray[$tid]['calls'] = count($db->getAll("SELECT id FROM claimants_noanswers WHERE cid='".$res['id']."'"));
				
				$tid++;
			}
			
			// Every + threestrikes count gets set to 5 in Caller records and 2 in Total Records
			
			foreach ($fixedArray AS $check) {
			
				// Time to get rid!
				if ($check['calls'] >= $threeStrikesNumber)
				 {
				 	// Ok Update the Callers records
				 	$dbr = new database();
				 	//$dbr->query("UPDATE  `cashltd_cash`.`claimants_data` SET  `supplier` =  '1', `status` =  '5' WHERE  `claimants_data`.`id` =".$check['id'].";");
				  //$dbr->query("UPDATE  `cashltd_cash`.`total_claimants` SET  `status` =  '2' WHERE  `total_claimants`.`id` =".$check['cid'].";");
				 
				 
				 	$yoinkedData[] = $check['cid'];
				 }
				 
				 
				 
				 
			}
					
		}
		
		
		
		
		
		
		
		public function stats() {
			GLOBAL $page;
			

			$db = new database();
			
			$stats = Array();
			
			$where = "";
			$nowhere = "";
			$code = explode(":",safe::get(id));
			
			if ($code[0] == "user" AND $code[1] > 0) {
		
				$where = " AND userid = ".$code[1];
				$nowhere = " WHERE userid = ".$code[1];
				
				$csvtable = "";
				
				
					
				$stats['showdeclined'] = "FALSE";
				
			}
						
			if ($code[0] == "data" AND $code[1] > 0) {
		
				$csvwhere = " AND csv = ".$code[1];
				$csvnowhere = " WHERE csv = ".$code[1];
				
				$csvtable = ", total_claimants";
				
				$csvtableand = " AND total_claimants.id = claimants_data.clientid ";
				
				
				
				$stats['listalldeclined'] = $db->getAll("SELECT * FROM claimants_data".$csvtable." WHERE claimants_data.status=2".$where.$csvwhere.$csvtableand);
				$stats['listallaccepted'] = $db->getAll("SELECT * FROM claimants_data".$csvtable." WHERE claimants_data.status=1".$where.$csvwhere.$csvtableand);
				
				$stats['listallwaiting'] = $db->getAll("SELECT *, claimants_data.id AS lid FROM claimants_data".$csvtable." WHERE claimants_data.status=0".$where.$csvwhere.$csvtableand);
					foreach ($stats['listallwaiting'] AS $key => $info) {
						if ($info['status'] != 3) {
						$newstring = "";
						$calls = $db->getAll("SELECT * FROM `claimants_noanswers` WHERE  `cid` ='".$info['lid']."'");
						foreach ($calls AS $call) {
							$newstring .= date("d/m/Y @ H:i",$call['timestamp']) . " - " . $call['message'];
							$newstring .= "<br />";
						}
						$stats['listallwaiting'][$key]['comment'] = $newstring;
								} else {
								$stats['listallwaiting'][$key]['comment'] = "Data was a duplicate entry";
							}
					}
				
				
				$stats['listallreturned'] = $db->getAll("SELECT *, claimants_data.id AS lid FROM claimants_data".$csvtable." WHERE claimants_data.status=5".$where.$csvwhere.$csvtableand);
					foreach ($stats['listallreturned'] AS $key => $info) {
						if ($info['status'] != 3) {
						$newstring = "";
						$calls = $db->getAll("SELECT * FROM `claimants_noanswers` WHERE  `cid` ='".$info['lid']."'");
						foreach ($calls AS $call) {
							$newstring .= date("d/m/Y @ H:i",$call['timestamp']) . " - " . $call['message'];
							$newstring .= "<br />";
						}
						$stats['listallreturned'][$key]['comment'] = $newstring;
								} else {
								$stats['listallreturned'][$key]['comment'] = "Data was a duplicate entry";
							}
					}

				
				
				
				$stats['showdeclined'] = "true";
				
				
			}
			
			if ($code[0] == "company" AND ($code[1] == "DLG" OR $code[1] == "CPN")) {
		
				
				$csvwhere = " AND format = '".$code[1]."'";
				$csvnowhere = " WHERE format = '".$code[1]."'";
				
				$csvtable = ", total_claimants INNER JOIN claimants_csv_data ON  total_claimants.csv = claimants_csv_data.id";
				$csvxtable = " INNER JOIN claimants_csv_data ON  total_claimants.csv = claimants_csv_data.id";
				
				$csvtableand = " AND total_claimants.id = claimants_data.clientid ";
				
				
			if (strlen(safe::get('from')) > 2 AND strlen(safe::get('to'))) {
				$fromstamp = strtotime(safe::get('from'));
				$tostamp = strtotime(safe::get('to'));
				
				$csvwhere .= " AND claimants_csv_data.timestamp >= ".$fromstamp." AND claimants_csv_data.timestamp <= ".$tostamp;
				$csvnowhere .= " AND claimants_csv_data.timestamp >= ".$fromstamp." AND claimants_csv_data.timestamp <= ".$tostamp;
				
				
			}
				
				
				
				//print "SELECT * FROM total_claimants".$csvtable.$csvnowhere;
				
				
				
				$stats['listalldeclined'] = $db->getAll("SELECT * FROM claimants_data".$csvtable." WHERE claimants_data.status=2".$where.$csvwhere.$csvtableand);
				$stats['listallaccepted'] = $db->getAll("SELECT * FROM claimants_data".$csvtable." WHERE claimants_data.status=1".$where.$csvwhere.$csvtableand);
				
				$stats['listallwaiting'] = $db->getAll("SELECT *, claimants_data.id AS lid FROM claimants_data".$csvtable." WHERE claimants_data.status=0".$where.$csvwhere.$csvtableand);
					foreach ($stats['listallwaiting'] AS $key => $info) {
						if ($info['status'] != 3) {
						$newstring = "";
						$calls = $db->getAll("SELECT * FROM `claimants_noanswers` WHERE  `cid` ='".$info['lid']."'");
						foreach ($calls AS $call) {
							$newstring .= date("d/m/Y @ H:i",$call['timestamp']) . " - " . $call['message'];
							$newstring .= "<br />";
						}
						$stats['listallwaiting'][$key]['comment'] = $newstring;
								} else {
								$stats['listallwaiting'][$key]['comment'] = "Data was a duplicate entry";
							}
					}
				
				
				$stats['listallreturned'] = $db->getAll("SELECT *, claimants_data.id AS lid FROM claimants_data".$csvtable." WHERE claimants_data.status=5".$where.$csvwhere.$csvtableand);
					foreach ($stats['listallreturned'] AS $key => $info) {
						if ($info['status'] != 3) {
						$newstring = "";
						$calls = $db->getAll("SELECT * FROM `claimants_noanswers` WHERE  `cid` ='".$info['lid']."'");
						foreach ($calls AS $call) {
							$newstring .= date("d/m/Y @ H:i",$call['timestamp']) . " - " . $call['message'];
							$newstring .= "<br />";
						}
						$stats['listallreturned'][$key]['comment'] = $newstring;
								} else {
								$stats['listallreturned'][$key]['comment'] = "Data was a duplicate entry";
							}
					}
				
				$stats['showdeclined'] = "true";
				
				
			
			//	print_r($stats['listalldeclined']);
			}
			
			
			
			$stats['totalclaimants'] = count($db->getAll("SELECT * FROM total_claimants".$csvxtable.$csvnowhere));
			$stats['unassignedclaimants'] = count($db->getAll("SELECT * FROM total_claimants WHERE status = 0".$csvxtable.$csvwhere));
			$stats['unassignedclaimantspercent'] = (($stats['unassignedclaimants'] / $stats['totalclaimants']) * 100);
			
			$stats['assignedclaimants'] = count($db->getAll("SELECT * FROM claimants_data".$csvtable.$nowhere.$csvnowhere.$csvtableand));
			
			$stats['dormant'] = count($db->getAll("SELECT * FROM claimants_data".$csvtable." WHERE claimants_data.supplier=1 AND claimants_data.status=0".$where.$csvwhere.$csvtableand));
			$stats['dormantpercent'] = (($stats['dormant'] / $stats['assignedclaimants']) * 100);
			
			$stats['callbacks'] = count($db->getAll("SELECT * FROM claimants_data".$csvtable." WHERE claimants_data.supplier=2 AND claimants_data.status=0".$where.$csvwhere.$csvtableand));
			$stats['callbackspercent'] = (($stats['callbacks'] / $stats['assignedclaimants']) * 100);
			
			$stats['noanswers'] = count($db->getAll("SELECT * FROM claimants_data".$csvtable." WHERE (claimants_data.supplier=3 OR claimants_data.supplier=4) AND claimants_data.status=0".$where.$csvwhere.$csvtableand));
			$stats['noanswerspercent'] = (($stats['noanswers'] / $stats['assignedclaimants']) * 100);
			
			$stats['accepted'] = count($db->getAll("SELECT * FROM claimants_data".$csvtable." WHERE claimants_data.supplier=1 AND claimants_data.status=1".$where.$csvwhere.$csvtableand));
			$stats['acceptedpercent'] = (($stats['accepted'] / $stats['assignedclaimants']) * 100);
			$stats['declined'] = count($db->getAll("SELECT * FROM claimants_data".$csvtable." WHERE claimants_data.supplier=1 AND claimants_data.status=2".$where.$csvwhere.$csvtableand));
			$stats['declinedpercent'] = (($stats['declined'] / $stats['assignedclaimants']) * 100);
			$stats['returned'] = count($db->getAll("SELECT * FROM claimants_data".$csvtable." WHERE claimants_data.status=5".$where.$csvwhere.$csvtableand));
			$stats['returnedpercent'] = (($stats['returned'] / $stats['assignedclaimants']) * 100);
			
			
			
			
			$staff = $db->getAll("SELECT id, fname, sname FROM `admin_login` ORDER BY fname;");

			$data = $db->getAll("SELECT * FROM claimants_csv_data ORDER BY timestamp;");
		
			$datar = $db->getFirst("SELECT * FROM claimants_csv_data WHERE id='".$code[1]."';");


			if ($code[0] == "data" AND $code[1] > 0 AND login::getUserRank() == 3) {
				$stats['showcost'] = "true";
				$stats['costper'] = number_format((float)$datar['cost']  / $stats['accepted'], 2);
			}

      if (safe::get('csv') == "TRUE")
      {
        
        $CSVfile = '"Title","First Name","Surname","Address 1","Address 2","Address 3","Town","County","Postcode","Telephone","Mobile","E-Mail","Original CSV","Comments"'."\n";
        
        // Accepted Claims
        
        foreach ($stats['listallaccepted'] AS $claim)
        {
          $CSVfile .= '"'.$claim['title'].'","'.$claim['fname'].'","'.$claim['sname'].'","'.$claim['add1'].'","'.$claim['add2'].'","'.$claim['add3'].'","'.$claim['town'].'","'.$claim['county'].'","'.$claim['postcode'].'","'.$claim['telephone'].'","'.$claim['mobile'].'","'.$claim['email'].'","'.$claim['filename'].'","Accepted"'."\n";
        }
        
        foreach ($stats['listalldeclined'] AS $claim)
        {
          $CSVfile .= '"'.$claim['title'].'","'.$claim['fname'].'","'.$claim['sname'].'","'.$claim['add1'].'","'.$claim['add2'].'","'.$claim['add3'].'","'.$claim['town'].'","'.$claim['county'].'","'.$claim['postcode'].'","'.$claim['telephone'].'","'.$claim['mobile'].'","'.$claim['email'].'","'.$claim['filename'].'","'.str_replace("\n"," ",$claim['comment']).'"'."\n";
        }
        
        foreach ($stats['listallwaiting'] AS $claim)
        {
          $calls = explode("<br />", $claim['comment']);
          $CSVfile .= '"'.$claim['title'].'","'.$claim['fname'].'","'.$claim['sname'].'","'.$claim['add1'].'","'.$claim['add2'].'","'.$claim['add3'].'","'.$claim['town'].'","'.$claim['county'].'","'.$claim['postcode'].'","'.$claim['telephone'].'","'.$claim['mobile'].'","'.$claim['email'].'","'.$claim['filename'].'","'.count($calls).' contact attempts with no response."'."\n";
        }
        
        foreach ($stats['listallreturned'] AS $claim)
        {
          $calls = explode("<br />", $claim['comment']);
          if (count($calls) > 1) {
            $comment = count($calls).' contact attempts with no response';
          } else {
            $comment = $calls[0];
          }
          $CSVfile .= '"'.$claim['title'].'","'.$claim['fname'].'","'.$claim['sname'].'","'.$claim['add1'].'","'.$claim['add2'].'","'.$claim['add3'].'","'.$claim['town'].'","'.$claim['county'].'","'.$claim['postcode'].'","'.$claim['telephone'].'","'.$claim['mobile'].'","'.$claim['email'].'","'.$claim['filename'].'","'.str_replace("\n"," ",$comment).'"'."\n";
        }
        
        $filename = $code[0]."-".$code[1].".csv";
        
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"".$filename."\"");
        
        echo $CSVfile;
        
      } 
      else 
      {
        $csvlink = "/csv/claimants/stats/id/".safe::get('id')."/";

			  $page->addPage(self::folder . "stats.tpl", ARRAY( "stats" => $stats, "staff" => $staff, "data" => $data, "datefrom" => $fromstamp, "dateto" => $tostamp, "csvlink" => $csvlink ) );
			
			  $page->fullReplace("[-currentmodule-]", "Request New Claimant");
			  $page->fullReplace("[-currentmodulelink-]", "javascript:getNewClaimant();");
		  }
		}
		
		
		public function addhotkey() {
			GLOBAL $page;
			
			$db = new database();
			$claimants = $db->getAll("SELECT id FROM total_claimants WHERE status=0");
			
			
			$userclaims = $db->getAll("SELECT * FROM claimants_data WHERE supplier=1 AND status = 0 AND userid=".login::getUserID().";");
			
			$_claims = count($claimants);
			// IMPORTANT
			// Do we want to force old claimants?
			// $_claims = 0;
			
			
			if ($_claims > 0) {	
				if (count($userclaims) >= 5) {
					$page->addHTML("5" );
				} else {
						$page->addHTML("1" );
				}
			} else {	
					$page->addHTML("0" );
			}
		
		}
		
		public function viewdata() {
			GLOBAL $page;
			
			
	
			
			$db = new database();
			$resulty = $db->getAll("SELECT id,name FROM claimants_suppliers");
	
			$page->addPage(self::folder . "totalview.tpl", ARRAY( 'userid' => login::getUserID(), 'suppliers' => $resulty ));
			
			
			$page->fullReplace("[-currentmodule-]", "Request New Claimant");
			$page->fullReplace("[-currentmodulelink-]", "javascript:getNewClaimant();");
		}
		
		
		public function makeDistribution() {
			GLOBAL $page;
			header("Content-type: text/xml");
			
			$export = "";
			
			$export .= "<?xml version=\"1.0\"?>\n<markers>\n";
			
			$db = new database();
			$results = $db->getAll("SELECT * FROM total_claimants;");
			
			
			foreach ($results AS $res) {
				$export .= '<marker name="ss" address="ss" lat="'.$res['long'].'" lng="'.$res['lat'].'" type="'.$res['status'].'"/>'."\n";
			}
			
			
			
			
			$export .= "</markers>\n";
			
			
			
			$myFile = "/var/www/cache/distribution.xml";
			$fh = fopen($myFile, 'w');
			fwrite($fh, $export);
			fclose($fh);
			
			print count($results)." records <a href='http://admin.cash-ltd.co.uk/cache/distribution.xml'>added</a>.";
			
		}
		
		
		public function distribution() {
			GLOBAL $page;
			
			
			$page->addPage(self::folder . "distribution.tpl");
			
						$page->fullReplace("[-currentmodule-]", "Request New Claimant");
			$page->fullReplace("[-currentmodulelink-]", "javascript:getNewClaimant();");
		}
		
		
		
		
		
		
		public function options() {
			GLOBAL $page;
			
				//$page->addHtml("<center>");
				$page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='".HomeUrl."claimants/viewdata/'><img src='".HomeUrl."skins/".DEFAULTSKIN."/images/"."view.png' border='0'><br />View Claimants</a></div>");
				$page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='javascript:getNewClaimant();'><img src='".HomeUrl."skins/".DEFAULTSKIN."/images/"."add.png' border='0'><br />Request New Claimant</a></div>");

				$page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='".HomeUrl."claimants/stats/id/0/'><img src='".HomeUrl."skins/".DEFAULTSKIN."/images/"."view.png' border='0'><br />View Stats</a></div>");
				//$page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='http://hotkey.nationwideaccesstosolicitors.co.uk/sendclaim.php' target='_blank'><img src='".HomeUrl."skins/".DEFAULTSKIN."/images/"."send.png' border='0'><br />Send Claim Form</a></div>");
				
				
				$page->addHTML("<br style='clear: both;' />");
				
				if (login::getUserRank() == 3) {
					$page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='".HomeUrl."admin/upload_claimant_csv/'><img src='".HomeUrl."skins/".DEFAULTSKIN."/images/"."csv.png' border='0'><br />Add new CSV</a></div>");
					$page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='".HomeUrl."claimants/distribution/'><img src='".HomeUrl."skins/".DEFAULTSKIN."/images/"."map.png' border='0'><br />View Claimant Distribution</a></div>");				
					
					
					$page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='".HomeUrl."claimants/goAssignCSV/'>Assign CSV</a><br /><br /><a href='".HomeUrl."claimants/sixChecks/'>Clear all Six Checks</a><br /><br /><a href='".HomeUrl."admin/saveClaimantsMailmerge/'>Send Mail Merge File</a></div>");				
				}
				
				
				//$page->addHtml("</center>");
				
				
		}
		
		
		
		
		
		
		public function possibleDuplicate($checkid) {
									
			$db = new database();	// Make new database
			
			$checkdata = $db->getFirst("SELECT * FROM claimants_data WHERE id='".$checkid."'");	// Get all details for this claimant
			
			
			
			$createWhere = " WHERE";
			
			
			// First check firstname and surname
			$createWhere .= " (fname='".$checkdata['fname']."' AND sname='".$checkdata['sname']."')";
			
			
			if (strlen($checkdata['tel']) > 3) {
				// Then we check the telephone number
				$createWhere .= " OR REPLACE(tel, ' ', '') LIKE '%".str_replace(" ", "", $checkdata['tel'])."%'";
			}
			
			if (strlen($checkdata['mobile']) > 3) {
				// Then we check the telephone number
				$createWhere .= " OR REPLACE(tel, ' ', '') LIKE '%".str_replace(" ", "", $checkdata['mobile'])."%'";
			}
			
			
			$createWhere;
			
			
			//$checksql = "SELECT * FROM datasuppliers_data WHERE (fname='".$checkdata['fname']."' AND sname='".$checkdata['sname']."') OR tel LIKE '%".$checkdata['tel']."%';";
			
			
			
			$checksql = "SELECT * FROM datasuppliers_data".$createWhere;
			$result = $db->getAll($checksql); // Check hotkey table for similar fields
			
			
			
			if (count($result) > 0) {
				return $result;	// Replace with a return once debugging is finished
			} else {
				return 0;	// Replace with a return once debugging is finished
			}
		}
		
		
				
		
		public function possibleClaimantsDuplicate($checkdata, $csv) {
									
			$db = new database();	// Make new database
			
			//$checkdata = $db->getFirst("SELECT * FROM total_claimants WHERE id='".$checkid."'");	// Get all details for this claimant
			
			
			
			$createWhere = " WHERE";
			
			
			// First check firstname and surname
			$createWhere .= " (forename='".$checkdata['forename']."' AND surname='".$checkdata['surname']."')";
			
			
			if (strlen($checkdata['telephone']) > 3) {
				// Then we check the telephone number
				$createWhere .= " OR REPLACE(telephone, ' ', '') LIKE '%".str_replace(" ", "", $checkdata['telephone'])."%'";
			}
			
			if (strlen($checkdata['mobile']) > 3) {
				// Then we check the telephone number
				$createWhere .= " OR REPLACE(mobile, ' ', '') LIKE '%".str_replace(" ", "", $checkdata['mobile'])."%'";
			}
			
			
			$createWhere;
			
						
			$checksql = "SELECT * FROM total_claimants".$createWhere;
			$result = $db->getAll($checksql); // Check hotkey table for similar fields
			
			
			
			if (count($result) > 0) {
				return $result;	// Replace with a return once debugging is finished
			} else {
				return 0;	// Replace with a return once debugging is finished
			}
		}
		
		
		
		
		
		
		
		public function claimanthistory() {
			GLOBAL $page;


			$claimant = new ClaimantData(safe::get('id'));
			$page->addPage(self::folder . "history.tpl", Array( "data" => $claimant->asArray() ));
			
			
		}
		
		
	}


?>
