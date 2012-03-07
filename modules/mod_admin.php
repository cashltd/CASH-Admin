<?php


	class admin {
		const folder = "admin/";
		

		public function getLoggedInUser() {
			return 1;
		}
		
		public function addAction($action) {
			GLOBAL $page;
			
			$actiondb = new database();
				$actiondb->insert("INSERT INTO `admin_actions` (`id` ,`uid` ,`action` ,`timestamp`)
									VALUES (NULL , '".admin::getLoggedInUser()."', '".$action."', NOW( ));");
			$actiondb->close();
			
		}
		
		public function messagesent() {
			GLOBAL $page;
		
			$page->addPage(self::folder . "messagesent.tpl");
		}
		
				
		// Sends a message from the Admin user.
		// Use the $to id of the user, $title and $message
		// If they need an alert popup also chuck in a 1.
		public function sendAdminMessage($to, $title, $message, $alert = 0) {
		
			$db = new database();
			$db->query("INSERT INTO `cashltd_cash`.`alerts` (`id`, `uid`, `fid`, `title`, `message`, `timestamp`, `read`, `alert`, `popped`) VALUES (NULL, '".$to."', '0', '".addslashes($title)."', '".addslashes($message)."', '".strtotime("now")."', '0', '".$alert."', '0');");
		
		}
		
		
		
		
		public function subval_sort($a,$subkey,$sort) {
			foreach($a as $k=>$v) {
				$b[$k] = strtolower($v[$subkey]);
			}
			$sort($b);
			foreach($b as $key=>$val) {
				$c[] = $a[$key];
			}
			return $c;
		}
		
		
		
		public function userstats() {
			GLOBAL $page;
		
			$db = new database();
			$users = $db->getAll("SELECT * FROM admin_login WHERE active=1;");
		
			$stats = ARRAY();
			$stats = admin::getActions(strtotime(safe::post('start')), strtotime(safe::post('end')), (int)safe::post('user'), TRUE);
		
		
			if (strlen(safe::post('start')) > 1) {
				$page->addPage("admin/userstatsshow.tpl", ARRAY( "stats" => $stats ));
			} else {		
				$page->addPage("admin/userstats.tpl", ARRAY( "suppliers" => $users ));
			}
		}
		
		
		public function getActions($_startDate, $_endDate, $_id = FALSE, $_time = FALSE) {
			// Convert timestamp to mysql format
			
			
			if (!$_time) {
				$startDate = date("Y-m-d 09:00:00", $_startDate);
				$endDate = date("Y-m-d 20:29:59", $_endDate);
			} else {	
				$startDate = date("Y-m-d H:i:00", $_startDate);
				$endDate = date("Y-m-d H:i:59", $_endDate);
			}
			
			if (!$_id) {
				$idwhere = "";
			} else {
				$idwhere = "AND uid='".$_id."'";
			}
						
			// Create new database and start pulling the search results
			$db = new Database();
			
			$stats['StartTime'] = $startDate;
			$stats['EndTime'] = $endDate;
			
			
			
			
			if (!$_id) {
				$usersQuery = $db->getAll("SELECT uid FROM admin_actions 
						WHERE timestamp >= '".$startDate."' AND timestamp <= '".$endDate."' ".$idwhere."");
				$users = ARRAY();
				foreach ($usersQuery AS $uq) {
					$users[] = $uq['uid'];
				}
				
				$usersUnique = array_unique($users);
				$usernum = 0;
				foreach ($usersUnique AS $uu) {
					
					$names = $db->getAll("SELECT fname, sname FROM admin_login WHERE id = '".$uu."'");
					
					$stats['users'][$usernum] = admin::getActions($_startDate, $_endDate, $uu, $_time);
					$stats['users'][$usernum]['name'] = $names[0]['fname']." ".$names[0]['sname'];
					$usernum++;
				}
			}
			
			
			
			$stats['Allocated'] = count($db->getAll("SELECT id FROM admin_actions 
						WHERE action LIKE '%allocated a new claimant%' AND timestamp >= '".$startDate."' AND timestamp <= '".$endDate."' ".$idwhere.""));
						
			$stats['LeftMessage'] = count($db->getAll("SELECT id FROM admin_actions 
						WHERE action LIKE '%Left a Message%' AND timestamp >= '".$startDate."' AND timestamp <= '".$endDate."' ".$idwhere.""));
			$stats['NoAnswer'] = count($db->getAll("SELECT id FROM admin_actions 
						WHERE action LIKE '%No Answer%' AND timestamp >= '".$startDate."' AND timestamp <= '".$endDate."' ".$idwhere.""));
			$stats['Callback'] = count($db->getAll("SELECT id FROM admin_actions 
						WHERE action LIKE '%Callback%' AND timestamp >= '".$startDate."' AND timestamp <= '".$endDate."' ".$idwhere.""));
			$stats['Declined'] = count($db->getAll("SELECT id FROM admin_actions 
						WHERE action LIKE '%Declined%' AND timestamp >= '".$startDate."' AND timestamp <= '".$endDate."' ".$idwhere.""));
			$stats['Accepted'] = count($db->getAll("SELECT id FROM admin_actions 
						WHERE action LIKE '%Accepted%' AND timestamp >= '".$startDate."' AND timestamp <= '".$endDate."' ".$idwhere.""));
		
			$stats['SMSs'] = count($db->getAll("SELECT id FROM admin_actions 
						WHERE action LIKE '%Sent an SMS%' AND timestamp >= '".$startDate."' AND timestamp <= '".$endDate."' ".$idwhere.""));
						
			$stats['TotalCalls'] = (int)$stats['LeftMessage'] + (int)$stats['NoAnswer'] + (int)$stats['Callback'] + (int)$stats['Declined'] + (int)$stats['Accepted'];
						
						
						
						
			if (strtotime($endDate) > strtotime("NOW")) {
				$endDate = date("Y-m-d H:i:s", strtotime("NOW"));
			}
						
			$timeDifference = strtotime($endDate) - strtotime($startDate);
			$averageCallTime = $timeDifference / $stats['TotalCalls'];
						
						
			$stats['Average'] = floor($averageCallTime) . "s";
		
		
			return $stats;
		}
		
		
		
		
		
		
		
		
		
		
		
		public function sendnow() {
			GLOBAL $page;
		
			if (safe::post('alert') == "on") {
				$alert = 1;
			} else {
				$alert = 0;
			}
		
		
			$db = new database();
			
			if (safe::post('staff') == (int)0) {
				$users = $db->getAll("SELECT * FROM admin_login;");
				
				foreach ($users AS $user) {
					$db->query("INSERT INTO `cashltd_cash`.`alerts` (`id`, `uid`, `fid`, `title`, `message`, `timestamp`, `read`, `alert`, `popped`) VALUES (NULL, '".$user['id']."', '".login::getUserID()."', '".addslashes(safe::post('title'))."', '".addslashes(safe::post('message'))."', '".strtotime("now")."', '0', '".$alert."', '0');");
				}
			
			} else {
			
				$db->query("INSERT INTO `cashltd_cash`.`alerts` (`id`, `uid`, `fid`, `title`, `message`, `timestamp`, `read`, `alert`, `popped`) VALUES (NULL, '".safe::post('staff')."', '".login::getUserID()."', '".addslashes(safe::post('title'))."', '".addslashes(safe::post('message'))."', '".strtotime("now")."', '0', '".$alert."', '0');");
		
			}
		
			$page->redirect("".HomeUrl."admin/messagesent/");
		}
		
		
		public function sendmessage() {
			GLOBAL $page;
			
			$db = new database();
			$staff = $db->getAll("SELECT * FROM admin_login WHERE active=1");
			
		
			$page->addpage(self::folder . "sendmessage.tpl", Array( "staff" => $staff ));
		}
		
		
		public function saveClaimantsMailmerge() {
		
		$filename = "Claimants-Mailmerge-".date("dmY-Hi",strtotime("now")).".csv";
		
			
				$ch = curl_init("".HomeUrl."admin/createClaimantsMailMergeFile/");
				$fp = fopen("/var/www/content/claimantsmailmerge/".$filename, "w");

				curl_setopt($ch, CURLOPT_FILE, $fp);
				curl_setopt($ch, CURLOPT_HEADER, 0);

				curl_exec($ch);
				curl_close($ch);
				fclose($fp);
			
			
			
				
			
				$to      = 'vultuk@gmail.com';
				$subject = 'New Claimants Mail Merge File';
				$message = "A new claimants mail merge has been created. You can download it by going to the following address...\n\n <a href='".HomeUrl."content/claimantsmailmerge/".$filename."'>".HomeUrl."content/claimantsmailmerge/".$filename."</a>";
				$headers = 'From: noreply@cash-ltd.co.uk' . "\r\n" .
 			   'Reply-To: noreply@cash-ltd.co.uk' . "\r\n" .
  			  'X-Mailer: PHP/' . phpversion();


				/*
				
				mail($to, $subject, $message, $headers);
				mail("cash_limited@hotmail.co.uk", $subject, $message, $headers);
			
				// cash_limited@hotmail.co.uk
			
				*/
				
				
				admin::sendAdminMessage(1, $subject, $message, 1);
				admin::sendAdminMessage(2, $subject, $message, 1);
			
			
		}
		
		
		
		
		public function createClaimantsMailMergeFile() {
		//	header("Content-type: text/csv");
		//	header("Content-Disposition: attachment; filename=claimant-mailmerge-".date("dmY-Hi",strtotime("now")).".csv");
		//	header("Pragma: no-cache");
		//	header("Expires: 0");
		
		
			$db = new database();
			$results = $db->getAll("SELECT id, title,forename,surname,add1,add2,add3,town,county,postcode FROM total_claimants WHERE status='2';");
			
			$titles = array("id", "title","forename","surname","address1","address2","address3","town", "county","postcode");

			print datasuppliers::makeCSVline($titles,1);
			
			foreach($results AS $result) {
				claimants::setMailmerged($result['id']);
				print datasuppliers::makeCSVline($result);
			}
		
		
		}
		
		
		
		
		
		
		public function addCSV() {
		
			ini_set('auto_detect_line_endings', true);
			ob_start();
			ob_flush();
			flush();
			print('<html><head><title></title><style>html, body {height: 100%;} body { font-family: verdana; font-size: 11px; } </style></head><body>');
			
			ob_flush();
			flush();

			
			$csvfilename = safe::get('id');
			$db = new database();
			$result = $db->getFirst("SELECT * FROM claimants_csv_data WHERE id='".$csvfilename."'");

			$csvString = $result['data'];
			$explodedCSV = explode("\n", $csvString);
			
			
			
			foreach ($explodedCSV as $line) {
				$data = str_getcsv($line);
			
			print $result['format'];
			
				if ($result['format'] == 'DLG') {
					
					if ($data[0] != "INDIVIDUALID" AND $data[0] != '') {
			
						$sendData = Array(	"co_id" => $data[0],
											"title" => $data[1],
											"forename" => $data[2],
											"surname" => $data[3],
											"add1" => $data[4],
											"add2" => $data[5],
											"add3" => $data[6],
											"town" => $data[7],
											"county" => $data[8],
											"postcode" => $data[9],
											"telephone" => $data[10],
											"mobile" => $data[11],
											"email" => "",
											"csv" => $csvfilename
										);
						admin::addNewClaimant($sendData, TRUE);
					}
				} else if ($result['format'] == 'DLGRDP') {
					print $data[0];
						if ($data[0] != "INDIVIDUALID" AND $data[0] != "LeadID" AND $data[0] != '') {

							$sendData = Array(	"co_id" => $data[0],
												"title" => $data[1],
												"forename" => $data[2],
												"surname" => $data[3],
												"add1" => $data[4],
												"add2" => $data[5],
												"add3" => $data[6],
												"town" => $data[7],
												"county" => $data[8],
												"postcode" => $data[9],
												"telephone" => $data[11],
												"mobile" => "",
												"email" => "",
												"csv" => $csvfilename
											);
							admin::addNewClaimant($sendData, TRUE);
						}
					} else if ($result['format'] == 'CPN') {
					if ($data[0] != "Title" AND $data[0] != '') {
			
			        	$sendData = Array(	"co_id" => "0",
											"title" => $data[0],
											"forename" => $data[1],
											"surname" => $data[2],
											"add1" => $data[3] . " " . $data[4],
											"add2" => $data[5],
											"add3" => $data[6],
											"town" => $data[7],
											"county" => $data[8],
											"postcode" => $data[9],
											"telephone" => $data[10],
											"mobile" => $data[11],
											"email" => $data[12],
											"csv" => $csvfilename
										);
										
						admin::addNewClaimant($sendData, TRUE);
					}
				}
											
				ob_flush();
				flush();
							
				sleep(2);
				
			}

			
			print('<br /><br /><div style=""><b style="font-size: 25px;  margin-top: 60px;;">DONE!</b></div></body></html>');
			
		}
		
		
		public function upload_claimant_csv() {
			GLOBAL $page;
		
		
			if (strlen(safe::post('type')) > 1) {
			
				$realFilename = basename( $_FILES['uploadedcsv']['name']);
				$fakeFilename = $_FILES['uploadedcsv']['tmp_name'];
			
				// Time to read the uploaded CSV into the database!
			
				$fh = fopen($fakeFilename, 'r');
				$theData = fread($fh, filesize($fakeFilename));
				fclose($fh);
			
			
				$theData = addslashes($theData);
			
			
				$db = new database();
				
				$sql = "INSERT INTO `cashltd_cash`.`claimants_csv_data` 
									(`id`, `data`, `filename`, `timestamp`, `format`, `added`, `cost`) 
							VALUES 	(NULL, '".$theData."', '".str_replace('.csv','',$realFilename)."', '".strtotime("now")."', '".safe::post('type')."', '0', '".safe::post('csvprice')."');";
				
				
				
				$db->query($sql);
			
			
				$thisDataID = mysql_insert_id();
			
			
			
				
			
				$page->addPage(self::folder . "upload_claimant_csv_done.tpl", Array( "id" => $thisDataID ));
			} else {
				$page->addPage(self::folder . "upload_claimant_csv.tpl" );
			}
			
			
			
		}
		
		
		
		public function addNewClaimant($dataArray, $echo = FALSE) {
			GLOBAL $page;
			
				$newData = Array();
				foreach ($dataArray as $k => $v) {
					$newData[$k] = addslashes($v);
				}
					$dataArray = $newData;
			
			$address = $dataArray['add1'] ." ". $dataArray['add2'] ." ". $dataArray['add3'] ." ". $dataArray['town'] ." ". $dataArray['county'] ." ". $dataArray['postcode'] ." UK";
			
			
			
			$gmap = new googlemap("ABQIAAAA7tJM0bGPT2tNMHxzg_rCCBT-oQ1JliOD_5xyMSDqa3TtwxZE6xT1-0TwXh0edWM_HBvoRmpxw-_WgQ");
			$longlat = $gmap->getLongLat($address);
		//		$longlat = ARRAY("long" => 0, "lat" => 0);

			
			
			
			$checkclaim = claimants::possibleClaimantsDuplicate($dataArray, $dataArray['csv']);
			
			
			if (count($checkclaim) > 0) {
				$duplicate = "Possible Duplicate: ";
			}
			
			
			
			$db = new database();
			$db->query("INSERT INTO `cashltd_cash`.`total_claimants` (`id`, `co_id`, `title`, `forename`, `surname`, `add1`, `add2`, `add3`, `town`, `county`, `postcode`, `telephone`, `mobile`, `email`, `long`, `lat`, `csv`) VALUES (NULL, '".$dataArray['co_id']."', '".$dataArray['title']."', '".$dataArray['forename']."', '".$dataArray['surname']."', '".$dataArray['add1']."', '".$dataArray['add2']."', '".$dataArray['add3']."', '".$dataArray['town']."', '".$dataArray['county']."', '".$dataArray['postcode']."', '".$dataArray['telephone']."', '".$dataArray['mobile']."', '".$dataArray['email']."', '".$longlat['lat']."', '".$longlat['long']."', '".$dataArray['csv']."');");
			
			
			
			
			
			if ($echo) {
				print($duplicate."Added ".$dataArray['title']." ".$dataArray['forename']." ".$dataArray['surname']." <i>(".$address.")</i><br />");
			}
			
			
			
		}
		
		
	}
	// End Class
?>