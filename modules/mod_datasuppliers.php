<?php

	class datasuppliers {
				
		const folder = "datasuppliers/";
		
		
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
		
		public function freshdata() {
			GLOBAL $page;
			
				$data = explode("-", safe::get('id'));
			
				$supplier = $data[0];
				$start = $data[1];
				$perpage = $data[2];
				$user = $data[3];
			
					$where = " status='0'";
						if ($supplier != 0) {
								if (strlen($where) > 2) $where .= " AND";
							$where .= " supplier='".$supplier."'";
						}
				
						if ($user != 0) {
								if (strlen($where) > 2) $where .= " AND";
							$where .= " userid='".$user."'";
						}
				
				if (strlen($where) > 2) $where = "WHERE" . $where;
						
				$db = new database();
				$sql = "SELECT * FROM datasuppliers_data ".$where." ORDER BY timestamp DESC LIMIT ".$start.",".$perpage."";
				$datas = $db->getAll($sql);

				
									$where = " status='-1'";
						if ($supplier != 0) {
								if (strlen($where) > 2) $where .= " AND";
							$where .= " supplier='".$supplier."'";
						}
				
						if ($user != 0) {
								if (strlen($where) > 2) $where .= " AND";
							$where .= " userid='".$user."'";
						}
				
				if (strlen($where) > 2) $where = "WHERE" . $where;
						
				$dbs = new database();
				$sql = "SELECT * FROM datasuppliers_data ".$where." ORDER BY timestamp DESC LIMIT ".$start.",".$perpage."";
				$datass = $dbs->getAll($sql);
				
				
				
				$datasr = Array();
								
				if (count($datas) > 0) {
					foreach ($datas AS $dat) {
						$dat['userid'] = login::getUsernameX($dat['userid']);
						$datasr[] = $dat;
					}
				}
				
				$datassr = Array();
				if (count($datass) > 0) {
					foreach ($datass AS $dat) {
						$dat['userid'] = login::getUsernameX($dat['userid']);
						$datassr[] = $dat;
					}
				}
				
							
				if (count($datas) < 1 AND count($datass) < 1 ) {
					$page->addHtml("<center><b>No new claims at this time</b></center>");
				} else {
					$page->addPage("datasuppliers/freshdata.tpl", ARRAY( 'data' => $datasr, 'datas' => $datassr ));	
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
				$sql = "SELECT * FROM datasuppliers_data ".$where." ORDER BY timestamp DESC LIMIT ".((int)$start*$perpage).",".$perpage."";
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
					$page->addPage("datasuppliers/olddata.tpl", ARRAY( 'data' => $datasr, 'pagenumber' => (int)$start+1, "shprev" => $shprev ));	
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
				$sql = "SELECT * FROM datasuppliers_data ".$where." ORDER BY timestamp DESC LIMIT ".((int)$start*$perpage).",".$perpage."";
				$datas = $db->getAll($sql);
				
				
				
								
				$datasr = Array();
					if (count($datas) > 0) {
					foreach ($datas AS $dat) {
						$dat['userid'] = login::getUsernameX($dat['userid']);
						$datasr[] = $dat;
					}
				}
				
				if (count($datas) < 1) {
					$page->addHtml("<center><b>No accepted claims at this time</b></center>");
				} else {
					$page->addPage("datasuppliers/newdata.tpl", ARRAY( 'data' => $datasr, 'pagenumber' => (int)$start+1, "shprev" => $shprev ));	
				}
		}
		
		public function goRecoverHotkey() {
			$db = new database();
			$reg = $db->getFirst("SELECT `timestamp` FROM `datasuppliers_data` WHERE`id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			$db->query("UPDATE `datasuppliers_data` SET `comment` = '', `timestamp` = '".$reg['timestamp']."', `status` = '0' WHERE `id` = ".(INT)safe::get('id')." LIMIT 1 ;");
		}
		
		public function goRemoveHotkey() {
			$db = new database();
			$reg = $db->getFirst("SELECT `timestamp` FROM `datasuppliers_data` WHERE`id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			$db->query("UPDATE `datasuppliers_data` SET `comment` = '".safe::post('comment')."',  `timestamp` = '".$reg['timestamp']."', `status` = '-1' WHERE `id` = ".(INT)safe::get('id')." LIMIT 1 ;");
		}
		
		public function goConfirmHotkey() {
			$db = new database();
			$reg = $db->getFirst("SELECT `timestamp` FROM `datasuppliers_data` WHERE`id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			$db->query("UPDATE `datasuppliers_data` SET `comment` = '',  `timestamp` = '".$reg['timestamp']."', `status` = '1' WHERE `id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			site::log("Set Hotkey No:".(INT)safe::get('id')." as Accepted.");
		}
		
		public function goDeclineHotkey() {
			$db = new database();
			$reg = $db->getFirst("SELECT `timestamp` FROM `datasuppliers_data` WHERE`id` = ".(INT)safe::get('id')." LIMIT 1 ;");
			
			$db->query("UPDATE `datasuppliers_data` SET `comment` = '".mysql_real_escape_string(safe::post('comment'))."',  `timestamp` = '".$reg['timestamp']."', `status` = '2' WHERE `id` = ".(INT)safe::get('id')." LIMIT 1 ;");
		}
		
		public function submitAddhotkey() {
			$db = new database();
			
			$sql = "INSERT INTO `cashltd_cash`.`datasuppliers_data` (
						`id` ,
						`supplier` ,
						`fname` ,
						`sname` ,
						`tel` ,
						`dealer` ,
						`userid` ,
						`ctype` ,
						`timestamp` ,
						`status` ,
						`comment`
					)
					VALUES (
						NULL , '".safe::post('supplier')."', '".safe::post('fname')."', '".safe::post('sname')."', '".site::format_telfax2(safe::post('tel'))."', '".safe::post('operator')."', '".safe::post('staff')."', '".safe::post('ctype')."', NOW( ) , '0', ''
					);";
			
			$db->query($sql);
			
			
				
			site::log("Added a new Hotkey");	
			
		}
		
		public function goViewHotkey() {
			GLOBAL $page;
			
			$db = new database();
			$details = $db->getFirst("SELECT * FROM datasuppliers_data WHERE id='".safe::get('id')."'");
			$db1 = new database();
			$user = $db1->getFirst("SELECT fname, sname FROM admin_login WHERE id='".$details['userid']."'");
			$db2 = new database();
			$supplier = $db2->getFirst("SELECT name FROM datasuppliers_suppliers WHERE id='".$details['supplier']."'");
			
			$page->addPage(self::folder . "viewhotkey.tpl", ARRAY( "items" => $details, "user" => $user, "supplier" => $supplier ) );
		}
		
		public function CSVOptions() {
			GLOBAL $page;
						
			$db = new database();
			$suppliers = $db->getAll("SELECT id, name FROM `datasuppliers_suppliers` ORDER BY name;");
			
			$page->addPage(self::folder . "csvoptions.tpl", ARRAY( "suppliers" => $suppliers ) );
			$page->fullReplace("[-currentmodule-]", "Add Hotkey Data");
			$page->fullReplace("[-currentmodulelink-]", "javascript:addNewHotkey();");
		}
		
		public function downloadCSV() {
			$supname = "AllSuppliers";
			if ((int)safe::post('supplier') > 0) {
				$getdet = new database();
				$det = $getdet->getFirst("SELECT name FROM datasuppliers_suppliers WHERE id='".(int)safe::post('supplier')."'");
				
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
			  $phpString = "SELECT fname, sname, tel, timestamp, comment, status FROM datasuppliers_data".$where." ORDER BY timestamp DESC";
				
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
		
		
		
		public function addhotkey() {
			GLOBAL $page;
			
			$db = new database();
			$suppliers = $db->getAll("SELECT id, name FROM `datasuppliers_suppliers` ORDER BY name;");
			$staff = $db->getAll("SELECT id, fname, sname FROM `admin_login` ORDER BY fname;");
			
			
			$page->addPage(self::folder . "addhotkey.tpl", ARRAY( "suppliers" => $suppliers, "staff" => $staff ) );
		}
		
		public function viewdata() {
			GLOBAL $page;
			
			
			$db = new database();
			$resulty = $db->getAll("SELECT id,name FROM datasuppliers_suppliers");
			
			
			
			$page->addPage(self::folder . "totalview.tpl", ARRAY( 'userid' => login::getUserID(), 'suppliers' => $resulty ));
			
			$page->fullReplace("[-currentmodule-]", "Add Hotkey Data");
			$page->fullReplace("[-currentmodulelink-]", "javascript:addNewHotkey();");
		}
		
		public function options() {
			GLOBAL $page;
			
			//	$page->addHtml("<center>");
				$page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='".HomeUrl."datasuppliers/viewdata/'><img src='".HomeUrl."skins/".DEFAULTSKIN."/images/"."hkview.png' border='0'><br />View Data</a></div>");
				$page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='javascript:addNewHotkey();'><img src='".HomeUrl."skins/".DEFAULTSKIN."/images/"."hkadd.png' border='0'><br />Add Hotkey Data</a></div>");
				// $page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='http://hotkey.nationwideaccesstosolicitors.co.uk/sendclaim.php' target='_blank'><img src='".HomeUrl."skins/".DEFAULTSKIN."/images/"."send.png' border='0'><br />Send Hotkey Claim Form</a></div>");
				$page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='".HomeUrl."datasuppliers/CSVOptions/'><img src='".HomeUrl."skins/".DEFAULTSKIN."/images/"."csv.png' border='0'><br />Download CSV</a></div>");
				//$page->addHtml("</center>");
				
				
		}
		
	}


?>