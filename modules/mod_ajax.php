<?php

	class ajax {
		

		
		
		
		public function send_live_users()
			{
				livechat::send_live_users();
			}
		
		// Admin AJAX functions
		// All callbacks to main admin class
		
		public function admin_addCSV() {
			admin::addCSV();
		}
		
		
		
		// Stats AJAX functions
		// All callbacks to main stats class
		
		public function stats_show() {
			stats::show();
		}
		
		
		public function dailyStats() {
			voip::dailyCallDistribution();
		}
		
		public function statsUpdate() {
			stats::ajaxStats();
		}
		
		
		
		public function viewclaimantdetails() {
			ClaimantData::view();
		}
		
		
		
		// Caldendar AJAX functions
		// All callbacks to main calendar class
		
		public function calendar_showCalendar() {
			calendar::ajax_calendarView();
		}
		
		// Data Supplier AJAX functions (Hotkeys)
		// All callbacks to main datasuppliers class
		
		public function datasuppliers_freshdata() {
			datasuppliers::freshdata();
		}
		
		public function datasuppliers_olddata() {
			datasuppliers::olddata();
		}		
		
		public function datasuppliers_newdata() {
			datasuppliers::newdata();
		}
		
		public function datasuppliers_goRecoverHotkey() {
			datasuppliers::goRecoverHotkey();
		}
		
		public function datasuppliers_goRemoveHotkey() {
			datasuppliers::goRemoveHotkey();
		}
		
		public function datasuppliers_goConfirmHotkey() {
			datasuppliers::goConfirmHotkey();
		}
		
		public function datasuppliers_goDeclineHotkey() {
			datasuppliers::goDeclineHotkey();
		}
		
		public function datasuppliers_goAddHotkey() {
			datasuppliers::addhotkey();
		}
		
		public function datasuppliers_goSubmitAddHotkey() {
			datasuppliers::submitAddhotkey();
		}
		
		public function datasuppliers_goViewHotkey() {
			datasuppliers::goViewHotkey();
		}
		
		public function datasuppliers_downloadCSV() {
			datasuppliers::downloadCSV();
		}
		
		
		// Claimant AJAX functions
		// All callbacks to main datasuppliers class
		
		public function claimants_freshdata() {
			claimants::freshdata();
		}
		
		public function claimants_olddata() {
			claimants::olddata();
		}		
		
		public function claimants_newdata() {
			claimants::newdata();
		}
		
		public function claimants_goRecoverHotkey() {
			claimants::goRecoverHotkey();
		}
		
		public function claimants_goRemoveHotkey() {
			claimants::goRemoveHotkey();
		}
		
		public function claimants_verify() {
			claimants::verify();
		}
		
		public function claimants_goDeclineHotkey() {
			claimants::goDeclineHotkey();
		}

		public function claimants_goCallback() {
			claimants::goCallback();
		}
		
		public function claimants_goNoAnswer() {
			claimants::goNoAnswer();
		}
		public function claimants_goNoAnswerMessage() {
			claimants::goNoAnswerMessage();
		}
		
		public function claimants_sendtextmessage() {
			claimants::sendtextmessage();
		}
		
		public function claimants_goAddClaimant() {
			claimants::addhotkey();
		}
		
		public function claimants_goSubmitAddHotkey() {
			claimants::submitAddhotkey();
		}
		
		public function claimants_goViewHotkey() {
			claimants::goViewHotkey();
		}
		
		public function claimants_downloadCSV() {
			claimants::downloadCSV();
		}
		
		public function claimants_makeDistribution() {
			claimants::makeDistribution();
		}
		
		public function claimants_goDuplicate() {
			claimants::goDuplicate();
		}
		
		public function claimants_claimanthistory() {
			claimants::claimanthistory();
		}
		
		
		
		
		
		// User Options ajax scripts
		
		public function addNewUser() {
			GLOBAL $page;
			
			$db = new database();
			$db->query("INSERT INTO `cashltd_cash`.`admin_login` (
						`id` ,
						`username` ,
						`password` ,
						`rank` ,
						`fname` ,
						`sname`
						)
						VALUES (
						NULL , '".safe::post('username')."', '".MD5(safe::post('password'))."', '".safe::post('rank')."', '".safe::post('fnamex')."', '".safe::post('lnamex')."'
						);");
			
		}
		
		public function checkUsername() {
			GLOBAL $page;
				
			$db = new database();
			$result = $db->getFirst("SELECT username FROM admin_login WHERE username='".safe::get('id')."'");
			
			if ($result['username'] == safe::get('id'))
				$page->addHtml("invalid");
			else				
				$page->addHtml("valid");
		}
		
		public function login_changePassword() {
			users::changePassword();
		}

		public function login_goChangePassword() {
			users::goChangePassword();
		}
		
		public function hideAnnounce() {
						
				$sql = "UPDATE `admin_login` SET `hideannouncement` = '1' WHERE `id` = '".(int)login::getUserID()."' LIMIT 1 ;";

				$newdatabasex = new database();
				$newdatabasex->query($sql);
		}
		
		
		// Legalbid CMC Verification ajax scripts
		
		public function legalbid_decline() {
			GLOBAL $page;
			
			login::log(login::getUserID(),"Declined the auction with id of ".safe::get("id"));
			
				$db = new database();
				$dbx = new database();
				$dbe = new database();
				$db->query("UPDATE `legalbid_items` SET `startdate` = NOW( ) ,`verify` = '2', comment='".safe::post('comment')."' WHERE `id` =".safe::get("id")." LIMIT 1 ;");
			
				$sids = $db->getFirst("SELECT sellid FROM `legalbid_items` WHERE id=".safe::get("id")."");
				$sid = $sids['sellid'];
			
				$sql = "SELECT email FROM `legalbid_users` WHERE id='".$sid."';";
				$emailss = $dbx->getFirst($sql);
				$emailx = $emailss['email'];
				
				
				$sql = "SELECT * FROM legalbid_items WHERE id=".safe::get("id")." LIMIT 1;";
				$details = $dbe->getFirst($sql);
				$det = $details;
				
				
				
							$subject = "Your claim addition to legalbid.co.uk has not been accepted";
							$messagetosend = "To whom it may concern.\n\nUnfortunately a claim you added to legalbid has not been accepted.\n\n";
							
								$messagetosend .= $det["title"] . "\n" . $det["desc"];
								$messagetosend .= "\n\nThe reason given for this was\n" . safe::post('comment');
							
							$messagetosend .= "\n\nIf you wish to discuss this item further please contact us.";
	
							
							
							$Name = "legalbid.co.uk"; //senders name
							$email = "noreply@legalbid.co.uk"; //senders e-mail adress
							$recipient = $emailx; //recipient
							$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields
							
							 mail($recipient, $subject, $messagetosend, $header);
				
		
				
				
				
			
						
		}
		
		public function legalbid_mailall() {
			GLOBAL $page;
			
			login::log(login::getUserID(),"Sent out e-mail for the auction with id of ".safe::get("id"));
			
				$db = new database();
				$sql = "SELECT * FROM legalbid_items WHERE id=".safe::get("id")." LIMIT 1;";
				$details = $db->getFirst($sql);
				$det = $details;

					$dbx = new database();
					$list = $dbx->getAll("SELECT id,email FROM legalbid_users WHERE nomail='0'");
						
					
				
							$subject = "Urgent case update on Legalbid.co.uk";
							$messagetosend = "To whom it may concern.\n\nWe have just uploaded a new case to https://legalbid.co.uk.\n\n";
							
								$messagetosend .= $det["qty"]."x ".$det["title"];
							
							$messagetosend .= "\n\nHappy Bidding\nWeb: https://legalbid.co.uk";
							$messagetosend .= "\nTwitter: http://twitter.com/legalbid_co_uk";
							
							$messagetosend .= "\n\nIf you do not wish to recieve these updates please use the link below.";
							$messagetosend .= "\n\nhttps://legalbid.co.uk/unsub.php?i=".$li['id'];
							
							
							$Name = "legalbid.co.uk"; //senders name
							$email = "noreply@legalbid.co.uk"; //senders e-mail adress
							$recipient = "noreply@legalbid.co.uk"; //recipient
							
					
					
						foreach ($list AS $li) {
							$bcc[] = $li['email'];	
						}
				
						$bccCode = implode(",", $bcc);
						
						
						$header = "From: ". $Name . " <" . $email . ">\r\nBcc: ".$bccCode."\r\n"; //optional headerfields
				mail($recipient, $subject, $messagetosend, $header);
				
						
				$db -> query("UPDATE legalbid_items SET startdate = '".$det["startdate"]."', `emailsent` = '1' WHERE `id` = '".safe::get("id")."' LIMIT 1 ;");
						
		}
		
		public function legalbid_tweet() {
			GLOBAL $page;
			
			login::log(login::getUserID(),"Tweeted the auction with id of ".safe::get("id"));
			
				$db = new database();
				$sql = "SELECT * FROM legalbid_items WHERE id=".safe::get("id")." LIMIT 1;";
				$details = $db->getFirst($sql);
				$det = $details;

						$login = "legalbid_co_uk:oliviashaw";

						$message = "New case added: ".$det["qty"]."x ".$det["title"]." - http://legalbid.co.uk";
						$url = 'http://twitter.com/statuses/update.xml';
						$curl_handle = curl_init();
						curl_setopt($curl_handle, CURLOPT_URL, "$url");
						curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
						curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($curl_handle, CURLOPT_POST, 1);
						curl_setopt($curl_handle, CURLOPT_POSTFIELDS, "status=$message");
						curl_setopt($curl_handle, CURLOPT_USERPWD, $login);
						$buffer = curl_exec($curl_handle);
						curl_close($curl_handle);
						
				$db -> query("UPDATE legalbid_items SET startdate = '".$det["startdate"]."', `twitter` = '1' WHERE `id` = '".safe::get("id")."' LIMIT 1 ;");
						
		}
		
		
		
		// VOIP Features
		public function voip_makeCall() {
		
			$extension = Login::getUserExtension();
		
			$details = explode("||", safe::get("id"));
			$return = voip::makeCall($extension, $details[0], $details[1]);
			
			echo $return;
		}
		
		public function voip_monthCallStats() {
			$auth = explode(":", safe::get('id'));
			$allStats = voip::monthCallStats(True, $auth);
			
			print json_encode($allStats);
		}
		
		
		public function voip_timeSinceLastCall() {
			voip::timeSinceLastCall();
		}
		
		
		
		
		
		public function legalbid_verify() {
			GLOBAL $page;
			
			login::log(login::getUserID(),"Verified the auction with id of ".safe::get("id"));
			
			$db = new database();
			$db->query("UPDATE `legalbid_items` SET `startdate` = NOW( ) ,`verify` = '1' WHERE `id` =".safe::get("id")." LIMIT 1 ;");
		}
		
		public function legalbid_queueVerify() {
			GLOBAL $page;
					
			$db = new database();
			$actions = $db->getAll("SELECT *, legalbid_items.id AS iid FROM legalbid_items LEFT JOIN legalbid_users ON legalbid_items.sellid=legalbid_users.id WHERE seller <> 0 AND legalbid_items.verify = 1 AND (legalbid_items.twitter='0' OR legalbid_items.emailsent='0') ORDER BY startdate DESC;");
				
			$page->addPage("legalbid/queueVerify.tpl", ARRAY("items" => $actions));
		}
		
		public function legalbid_oldVerify() {
			GLOBAL $page;
					
			$db = new database();
			$actions = $db->getAll("SELECT *, legalbid_items.id AS iid FROM legalbid_items LEFT JOIN legalbid_users ON legalbid_items.sellid=legalbid_users.id WHERE  legalbid_items.verify = 2 ORDER BY startdate DESC;");
				
			$page->addPage("legalbid/noVerify.tpl", ARRAY("items" => $actions));
		}
		
		public function legalbid_listVerify() {
			GLOBAL $page;
					
			$db = new database();
			$actions = $db->getAll("SELECT *, legalbid_items.id AS iid FROM legalbid_items LEFT JOIN legalbid_users ON legalbid_items.sellid=legalbid_users.id WHERE  legalbid_items.verify = 0 ORDER BY startdate ;");
				
			$page->addPage("legalbid/listVerify.tpl", ARRAY("items" => $actions));
		}
		
		
		// Solicitors Database ajax scripts
		
		public function solicitors_listsolicitors() {
			solicitors::listsolicitors();
		}
		
		
	}

?>