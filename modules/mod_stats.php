<?php

	class stats {
	
		const folder = "stats/";
	
		public function getUserHotkeys($id, $rangefrom, $rangeto) {
		
			$db = new database(); // Create a database connection
			
			
			if ($rangefrom == $rangeto) {
				$datewhere = " AND timestamp LIKE '".$rangefrom."%';";
			} else {
				$datewhere = " AND timestamp >= '".$rangefrom."%' AND timestamp <= '".$rangeto."%';";
			}
			
			
			return count($db->getAll("SELECT status FROM datasuppliers_data WHERE status > 0 AND userid='".$id."'".$datewhere));
		
		}
	
		public function getUserClaimants($id, $rangefrom, $rangeto) {
		
			$db = new database(); // Create a database connection
			
			
			if ($rangefrom == $rangeto) {
				$datewhere = " AND timestamp LIKE '".$rangeto."%';";
			} else {
				$datewhere = " AND timestamp >= '".$rangefrom."%' AND timestamp <= '".$rangeto."%';";
			}
			
			
			return count($db->getAll("SELECT status FROM claimants_data WHERE status < 3 AND status > 0 AND userid='".$id."'".$datewhere));
		
		}



		public function callstats(){
			GLOBAL $page;
			
			$auth = explode(":", safe::get('id'));
			$allStats = voip::monthCallStats(True, $auth);
			$monthTimestamp = strtotime($auth[2]."-".$auth[1]."-01");
			$fixedStats = array();
			$users = Array();
			
			if ($auth[0] != 0) {
				$tempArray[$auth[0]] = $allStats;
				$allStats = $tempArray;
			}
						
			foreach ($allStats AS $userID => $userStats) {
				$users[$userID] = login::getUsernameX($userID);
				foreach ($userStats AS $date => $dayStats) {
					if ($date != "fullMonth")
						$fixedStats[$date][$userID] = $dayStats;
						$realDate = strtotime($date);
						$fixedStats[$date]['info'] = date("Y, ", $realDate) . (date("n", $realDate)-1) . date(", j", $realDate);
				}
			}

			$totalUsers = 0;
			$totalCalls = 0;
			$totalDays = 0;
			
			$callTypes['mobile'] = 0;
			$callTypes['landline'] = 0;
						
			foreach ($allStats AS $userID => $userStats) {
				$totalCalls = $totalCalls + $userStats['fullMonth']['averageCallsPerDay'];

				$callTypes['mobile'] = $callTypes['mobile'] + $userStats['fullMonth']['mobile'];
				$callTypes['landline'] = $callTypes['landline'] + $userStats['fullMonth']['landline'];
				
				$totalDays = count($userStats);
				if ($userStats['fullMonth']['totalCalls'] > 0)
					$totalUsers++;
			}
			$averageCalls = $totalCalls / $totalUsers;

			
			// Lets create Table data for google
			$googleTable = Array();
			
			
			
			
			$i = 0;
			foreach ($fixedStats AS $key => $singleStat) {
			
				if ($key != "fullMonth") {
					$realDate = strtotime($key);
					$googleTable['data'][$i][0] = date("Y, ", $realDate) . (date("n", $realDate)-1) . date(", j", $realDate);
					
					
					$tcalls = 0;
					$mcalls = 0;
					$lcalls = 0;
					$tcost = 0;
					
					$tHotkeys = 0;
					$tAccepted = 0;
					
					foreach($singleStat AS $skey => $arr) {
						if ($skey != 'info') {
												
							$tcalls = $tcalls + $arr['totalCalls']['all'];
							$mcalls = $mcalls + $arr['totalCalls']['mobile'];
							$lcalls = $lcalls + $arr['totalCalls']['landline'];
							$tcost = $tcost + ($arr['durations']['landline']['cost'] + $arr['durations']['mobile']['cost']);
						
							$tAccepted = $tAccepted + $arr['claims']['accepted'];
							$tHotkeys = $tHotkeys + $arr['hotkeys']['accepted'];
						
						}
					}
					
					$googleTable['data'][$i][1] = $tcalls;
					$googleTable['data'][$i][2] = $lcalls;
					$googleTable['data'][$i][3] = $mcalls;
					
					$googleTable['data'][$i][4] = $tHotkeys;
					$googleTable['data'][$i][5] = $tAccepted;
					
					$googleTable['data'][$i][6]['number'] = $tcost;
					$googleTable['data'][$i][6]['cost'] = number_format($tcost, 2, '.', ',');
				
					$i++;
				
				}
				
			}
			
			$googleTable['rows'] = count($googleTable['data']);


			$page->addPage(self::folder . "callstats.tpl", Array( "googleTable" => $googleTable, "stats" => $fixedStats, "callTypes"=>$callTypes, "users" => $users, "averageCalls" => ceil($averageCalls), "chartTitle" => date("F Y", $monthTimestamp)  ) );
		}



		public function show() {
			GLOBAL $page;
			
			
				$daterange = explode(":", safe::get('id'));
			
				$rangestart = $daterange[0];
				$rangeend = $daterange[1];
				$height = $daterange[2];
				$width = $daterange[3];
				
						
				$userdb = new database(); //Start new database to steal user details
				$users = $userdb->getAll("SELECT * FROM admin_login WHERE active='1' ORDER BY fname");
				$usercount = count($users);
			
				$db = new database(); // Start another database connection for counting totals
				
				if ($rangestart == $rangeend) {
					$datewhere = " AND timestamp LIKE '".$rangestart."%';";
				} else {
					$datewhere = " AND timestamp >= '".$rangestart."%' AND timestamp <= '".$rangeend."%';";
				}
				
				$totalhotkeys = count($db->getAll("SELECT status FROM datasuppliers_data WHERE status > 0".$datewhere));
				$totalclaimants = count($db->getAll("SELECT status FROM claimants_data WHERE status < 3 AND status > 0".$datewhere));
				$total = $totalhotkeys + $totalclaimants;
			
				foreach ($users as $user) {
					$stats[$user['id']]['name'] = $user['fname'];
					$stats[$user['id']]['hotkeys'] = stats::getUserHotkeys($user['id'],$rangestart,$rangeend);
					$stats[$user['id']]['claimants'] = stats::getUserClaimants($user['id'],$rangestart,$rangeend);
					
					$stats[$user['id']]['totalpercent'] = (ceil((($stats[$user['id']]['hotkeys'] + $stats[$user['id']]['claimants']) / $total)*100));
					
					
					
					$stats[$user['id']]['hkaccepted'] = count($db->getAll("SELECT status FROM datasuppliers_data WHERE userid='".$user['id']."' AND status = 1".$datewhere));
					$stats[$user['id']]['hkdeclined'] = count($db->getAll("SELECT status FROM datasuppliers_data WHERE userid='".$user['id']."' AND status = 2".$datewhere));
					$stats[$user['id']]['hkreturned'] = 0;
					$stats[$user['id']]['hkdormant'] = count($db->getAll("SELECT status FROM datasuppliers_data WHERE userid='".$user['id']."' AND status = 0".$datewhere));
					$stats[$user['id']]['hkcallback'] = 0;
					$stats[$user['id']]['hknoanswer'] = 0;
					
					
					$stats[$user['id']]['claccepted'] = count($db->getAll("SELECT status FROM claimants_data WHERE userid='".$user['id']."' AND status = 1".$datewhere));
					$stats[$user['id']]['cldeclined'] = count($db->getAll("SELECT status FROM claimants_data WHERE userid='".$user['id']."' AND status = 2".$datewhere));
					$stats[$user['id']]['clreturned'] = count($db->getAll("SELECT status FROM claimants_data WHERE userid='".$user['id']."' AND status = 5".$datewhere));;
					$stats[$user['id']]['cldormant'] = count($db->getAll("SELECT status FROM claimants_data WHERE userid='".$user['id']."' AND status = 0 AND supplier = 1".$datewhere));
					$stats[$user['id']]['clcallback'] = count($db->getAll("SELECT status FROM claimants_data WHERE userid='".$user['id']."' AND supplier = 2".$datewhere));;
					$stats[$user['id']]['clnoanswer'] = count($db->getAll("SELECT status FROM claimants_data WHERE userid='".$user['id']."' AND (supplier = 3 OR supplier = 4)".$datewhere));;
					
					
					$stats[$user['id']]['hotkeyspercent'] = ceil(($stats[$user['id']]['hotkeys'] / ($stats[$user['id']]['hotkeys'] + $stats[$user['id']]['claimants']))*100);
					$stats[$user['id']]['hotkeysheightpix'] = ((($height * ($stats[$user['id']]['totalpercent']/100))*($stats[$user['id']]['hotkeyspercent'] / 100)));
					
					$stats[$user['id']]['claimantspercent'] = ceil(($stats[$user['id']]['claimants'] / ($stats[$user['id']]['hotkeys'] + $stats[$user['id']]['claimants']))*100);
					$stats[$user['id']]['claimantsheightpix'] = ((($height * ($stats[$user['id']]['totalpercent']/100))*($stats[$user['id']]['claimantspercent'] / 100)));
					
					$stats[$user['id']]['remainingpercent'] = 100 - ($stats[$user['id']]['hotkeyspercent'] + $stats[$user['id']]['claimantspercent']);
					
					
					
					
					
				}
			
								$pickwidth = floor(88/$usercount);
			
			
			$page->addPage(self::folder . "show.tpl", Array( "stats" => $stats, "height" => $height, "width" => $width, "start" => $rangestart, "end" => $rangeend, "pickwidth" => $pickwidth ) );
		}

	
	
	
	function getWeekRange(&$start_date, &$end_date, $offset=0) { 
        $start_date = ''; 
        $end_date = '';    
        $week = date('W'); 
        $week = $week - $offset; 
        $date = date('Y-m-d'); 
        
        $i = 0; 
        while(date('W', strtotime("-$i day")) >= $week) {                        
            $start_date = date('Y-m-d', strtotime("-$i day")); 
            $i++;        
        }    
            
        list($yr, $mo, $da) = explode('-', $start_date);    
        $end_date = date('Y-m-d', mktime(0, 0, 0, $mo, $da + 6, $yr)); 
} 
    
    function getMonthRange(&$start_date, &$end_date, $offset=0) { 
        $start_date = ''; 
        $end_date = '';    
        $date = date('Y-m-d'); 
        
        list($yr, $mo, $da) = explode('-', $date); 
        $start_date = date('Y-m-d', mktime(0, 0, 0, $mo - $offset, 1, $yr)); 
        
        $i = 2; 
        
        list($yr, $mo, $da) = explode('-', $start_date); 
        
        while(date('d', mktime(0, 0, 0, $mo, $i, $yr)) > 1) { 
            $end_date = date('Y-m-d', mktime(0, 0, 0, $mo, $i, $yr)); 
            $i++; 
        } 
} 
	
	
	
	public function ajaxStats() {
	GLOBAL $page;
	$today = strtotime("now");
			
			$id = "0:".(((int)date("n", $today))).":".(((int)date("Y", $today)));
			
			$auth = explode(":", $id);
			$allStats = voip::monthCallStats(True, $auth);
			$monthTimestamp = strtotime($auth[2]."-".$auth[1]."-01");
			$fixedStats = array();
			$users = Array();
			
			if ($auth[0] != 0) {
				$tempArray[$auth[0]] = $allStats;
				$allStats = $tempArray;
			}
						
			foreach ($allStats AS $userID => $userStats) {
				$users[$userID] = login::getUsernameX($userID);
				foreach ($userStats AS $date => $dayStats) {
					if ($date != "fullMonth")
						$fixedStats[$date][$userID] = $dayStats;
						$realDate = strtotime($date);
						$fixedStats[$date]['info'] = date("Y, ", $realDate) . (date("n", $realDate)-1) . date(", j", $realDate);
				}
			}

			$totalUsers = 0;
			$totalCalls = 0;
			$totalDays = 0;
			
			$callTypes['mobile'] = 0;
			$callTypes['landline'] = 0;
						
			foreach ($allStats AS $userID => $userStats) {
				$totalCalls = $totalCalls + $userStats['fullMonth']['averageCallsPerDay'];

				$callTypes['mobile'] = $callTypes['mobile'] + $userStats['fullMonth']['mobile'];
				$callTypes['landline'] = $callTypes['landline'] + $userStats['fullMonth']['landline'];
				
				$totalDays = count($userStats);
				if ($userStats['fullMonth']['totalCalls'] > 0)
					$totalUsers++;
			}
			$averageCalls = $totalCalls / $totalUsers;

			
			// Lets create Table data for google
			$googleTable = Array();
			
			
			
			
			$i = 0;
			foreach ($fixedStats AS $key => $singleStat) {
			
				if ($key != "fullMonth") {
					$realDate = strtotime($key);
					$googleTable['data'][$i][0] = date("Y, ", $realDate) . (date("n", $realDate)-1) . date(", j", $realDate);
					
					
					$tcalls = 0;
					$mcalls = 0;
					$lcalls = 0;
					$tcost = 0;
					
					$tHotkeys = 0;
					$tAccepted = 0;
					
					foreach($singleStat AS $skey => $arr) {
						if ($skey != 'info') {
												
							$tcalls = $tcalls + $arr['totalCalls']['all'];
							$mcalls = $mcalls + $arr['totalCalls']['mobile'];
							$lcalls = $lcalls + $arr['totalCalls']['landline'];
							$tcost = $tcost + ($arr['durations']['landline']['cost'] + $arr['durations']['mobile']['cost']);
						
							$tAccepted = $tAccepted + $arr['claims']['accepted'];
							$tHotkeys = $tHotkeys + $arr['hotkeys']['accepted'];
						
						}
					}
					
					$googleTable['data'][$i][1] = $tcalls;
					$googleTable['data'][$i][2] = $lcalls;
					$googleTable['data'][$i][3] = $mcalls;
					
					$googleTable['data'][$i][4] = $tHotkeys;
					$googleTable['data'][$i][5] = $tAccepted;
					
					$googleTable['data'][$i][6]['number'] = $tcost;
					$googleTable['data'][$i][6]['cost'] = number_format($tcost, 2, '.', ',');
				
					$i++;
				
				}
				
			}
			
			$googleTable['rows'] = count($googleTable['data']);


			$page->addPage(self::folder . "mainscreen.tpl", Array( "googleTable" => $googleTable, "stats" => $fixedStats, "callTypes"=>$callTypes, "users" => $users, "averageCalls" => ceil($averageCalls), "chartTitle" => date("F Y", $monthTimestamp)  ) );
	}
	
	
		public function options() {
			GLOBAL $page;
			
			$page->addPage(self::folder . "mainscreen2.tpl", array());
			
		}
	
	}


?>