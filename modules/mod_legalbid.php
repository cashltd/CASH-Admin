<?php	// Legal Bid administration Module
		// Written by Simon Skinner
		// First Revision 01.10.08

		class legalbid {
			
			const folder = "legalbid/";
			
			
			
			

			
			public function sentence_case($string) {
			    $sentences = preg_split('/([.?!]+)/', $string, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
			    $new_string = '';
			    foreach ($sentences as $key => $sentence) {
			        $new_string .= ($key & 1) == 0?
			            ucfirst(strtolower(trim($sentence))) :
			            $sentence.' ';
			    }
			    return trim($new_string);
			} 
			
			
			public function decline() {
				GLOBAL $page;
			
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
				
		
				
				
				
				
				
				$page->addPage(self::folder . "declined.tpl", ARRAY("decmessage" => nl2br($messagetosend)));
				$page->fullReplace("[-currentmodule-]", "Legalbid Options");
				$page->fullReplace("[-currentmodulelink-]", "".HomeUrl."legalbid/options/");
			}
			
			
			public function findTopBidder($id) {
				
				$db = new database();
				$details = $db->getFirst("SELECT uid FROM legalbid_bids WHERE iid=".$id." ORDER BY bid DESC");
	
				return $details[uid];
				
			}
				
			public function getCredit($id) {
	
				$db = new database();
				$credit = $db->getAll("SELECT deposit FROM legalbid_deposits WHERE uid=".$id.";");
	
					$depo = 0;
					foreach ($credit AS $dep) {
						$depo = $depo + $dep[deposit];
					}
					
					
					
				$checks = $db->getAll("SELECT id FROM legalbid_items");
					
				$depoff = 0;
					foreach ($checks AS $check) {
						if ($id == legalbid::findTopBidder($check[id])) {
							$dr = new database();
							$drz = $dr->getFirst("SELECT bid FROM legalbid_bids WHERE iid=".$check[id]." ORDER BY bid DESC");
							$depoff = $depoff + ($drz[bid]*1.175);
						}
					}
					
				
				
				return $depo - $depoff;
	
			}
				
			public function verify() {
				GLOBAL $page;

				$page->addPage(self::folder . "verify.tpl");
				$page->fullReplace("[-currentmodule-]", "Legalbid Options");
				$page->fullReplace("[-currentmodulelink-]", "".HomeUrl."legalbid/options/");
			}
			
			public function verifyit() {
				GLOBAL $page;
				
				$db = new database();
				$db->query("UPDATE `legalbid_items` SET `startdate` = NOW( ) ,`verify` = '1' WHERE `id` =".safe::get("id")." LIMIT 1 ;");
				
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
						
						
				
						
						$list = $db->getAll("SELECT id,email FROM legalbid_users WHERE nomail='0'");
						
						foreach ($list AS $li) {
							$subject = "Urgent case update on Legalbid.co.uk";
							$messagetosend = "To whom it may concern.\n\nWe have just uploaded a new case to https://legalbid.co.uk.\n\n";
							
								$messagetosend .= $det["qty"]."x ".$det["title"];
							
							$messagetosend .= "\n\nHappy Bidding\nWeb: https://legalbid.co.uk";
							$messagetosend .= "\nTwitter: http://twitter.com/legalbid_co_uk";
							
							$messagetosend .= "\n\nIf you do not wish to recieve these updates please use the link below.";
							$messagetosend .= "\n\nhttps://legalbid.co.uk/unsub.php?i=".$li['id'];
							
							
							$Name = "legalbid.co.uk"; //senders name
							$email = "noreply@legalbid.co.uk"; //senders e-mail adress
							$recipient = $li['email']; //recipient
							$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields
							
							mail($recipient, $subject, $messagetosend, $header);
						}

								
				
				$page->addPage(self::folder . "done.tpl");
				$page->fullReplace("[-currentmodule-]", "Legalbid Options");
				$page->fullReplace("[-currentmodulelink-]", "".HomeUrl."legalbid/options/");
			}
	
			public function addAuction() {
					GLOBAL $page;
						$db = new database();
						
					if (safe::post("sid") > 0) { 
						
						
						$db->query("	INSERT INTO `cashltd_cash`.`legalbid_items` (
										`id` ,
										`doc` ,
										`title` ,
										`desc` ,
										`start` ,
										`startdate` ,
										`duration` ,
										`cat` ,
										`qty`,
										`bin`
										)
										VALUES (
										NULL , '".safe::post("doc")."', '".safe::post("title")."', '".safe::post("desc")."', '".safe::post("start")."', NOW( ) , '".safe::post("dur")."', '".safe::post("sid")."', '".safe::post("qty")."', '".safe::post("bin")."'
										);");
						
						
												
						$login = "legalbid_co_uk:oliviashaw";

						$message = "New case added: ".safe::post("qty")."x ".safe::post("title")." - http://legalbid.co.uk";
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
						
						
				
										
						
						$list = $db->getAll("SELECT id,email FROM legalbid_users WHERE nomail='0'");
						
						foreach ($list AS $li) {
							$subject = "Urgent case update on Legalbid.co.uk";
							$messagetosend = "To whom it may concern.\n\nWe have just uploaded a new case to https://legalbid.co.uk.\n\n";
							
								$messagetosend .= safe::post("qty")."x ".safe::post("title");
							
							$messagetosend .= "\n\nHappy Bidding\nWeb: https://legalbid.co.uk";
							$messagetosend .= "\nTwitter: http://twitter.com/legalbid_co_uk";;
							
							$messagetosend .= "\n\nIf you do not wish to recieve these updates please use the link below.";
							$messagetosend .= "\n\nhttps://legalbid.co.uk/unsub.php?i=".$li['id'];
							
							
							$Name = "legalbid.co.uk"; //senders name
							$email = "noreply@legalbid.co.uk"; //senders e-mail adress
							$recipient = $li['email']; //recipient
							$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields
							
							mail($recipient, $subject, $messagetosend, $header);
						}
						
					
						
						$page->addPage(self::folder . "addauction_thanks.tpl");
						
					} else {
						
	
							$sols = $db->getAll("SELECT id, title FROM legalbid_categories ORDER BY title;");
						$db->close;
						
						foreach ($sols AS $sol) {
							$solid[] = $sol["id"];
							$solname[] = strip_tags($sol["title"]);
						}
						
						$page->addVar("HomeFolder", self::folder);
						$page->addPage(self::folder . "addauction.tpl", ARRAY( "solid" => $solid, "solname" => $solname ));
					}
					
				$page->fullReplace("[-currentmodule-]", "Legalbid Options");
				$page->fullReplace("[-currentmodulelink-]", "".HomeUrl."legalbid/options/");
					
				}
			
			public function addCredit() {
					GLOBAL $page;
						$db = new database();
						
					if (safe::post("sid") > 0) { 
						
						
						$db->query("	INSERT INTO `cashltd_cash`.`legalbid_deposits` (
										`id` ,
										`uid` ,
										`deposit` ,
										`method` ,
										`timestamp`
										)
										VALUES (
										NULL , '".safe::post("sid")."', '".safe::post("amount")."', '".safe::post("reason")."', NOW( )
										);");
						
						$page->addPage(self::folder . "addcredit_thanks.tpl");
						
					} else {
						
	
							$sols = $db->getAll("SELECT id, solicitor, name FROM legalbid_users ORDER BY solicitor;");
						$db->close;
						
						foreach ($sols AS $sol) {
							$solid[] = $sol["id"];
						 $solname[] = $sol["solicitor"]. " (".$sol["name"].") - &pound;".legalbid::getCredit($sol["id"]);
						}
						
						$page->addVar("HomeFolder", self::folder);
						$page->addPage(self::folder . "addcredit.tpl", ARRAY( "solid" => $solid, "solname" => $solname ));
					}
					
				$page->fullReplace("[-currentmodule-]", "Legalbid Options");
				$page->fullReplace("[-currentmodulelink-]", "".HomeUrl."legalbid/options/");
				}
		
				
			public function liveview() {
				GLOBAL $page;
				
				
				
				
				
				
				$page->addPage(self::folder . "liveview.tpl");
			}
				
				
				
			/**
			 * Function is called to display the options on the main page
			 * so users can select which part to administrate.
			 */
			public function options() {
				GLOBAL $page;
				
				$breakdown = "";
				$db = new database();
				
				$breakdown .= "<b>Number of Claims added in 2009</b><Br />";
				
				$count = count($db->getAll("SELECT * FROM `cashltd_cash`.`legalbid_items` WHERE startdate LIKE '2009-06-%%'"));
				$breakdown .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>June:</b> ".$count."<br />";
				
				$count = count($db->getAll("SELECT * FROM `cashltd_cash`.`legalbid_items` WHERE startdate LIKE '2009-05-%%'"));
				$breakdown .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>May:</b> ".$count."<br />";
				
				$count = count($db->getAll("SELECT * FROM `cashltd_cash`.`legalbid_items` WHERE startdate LIKE '2009-04-%%'"));
				$breakdown .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>Apr:</b> ".$count."<br />";
				
				$count = count($db->getAll("SELECT * FROM `cashltd_cash`.`legalbid_items` WHERE startdate LIKE '2009-03-%%'"));
				$breakdown .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Mar:</b> ".$count."<br />";
				
				$count = count($db->getAll("SELECT * FROM `cashltd_cash`.`legalbid_items` WHERE startdate LIKE '2009-02-%%'"));
				$breakdown .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Feb:</b> ".$count."<br />";
				
				$count = count($db->getAll("SELECT * FROM `cashltd_cash`.`legalbid_items` WHERE startdate LIKE '2009-01-%%'"));
				$breakdown .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Jan:</b> ".$count."<br /><br />";
				
				
				
				
				$breakdown .= "<b>Number of Claims added in 2008</b><Br />";
				
				$count = count($db->getAll("SELECT * FROM `cashltd_cash`.`legalbid_items` WHERE startdate LIKE '2008-12-%%'"));
				$breakdown .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>Dec:</b> ".$count."<br />";
				
				$count = count($db->getAll("SELECT * FROM `cashltd_cash`.`legalbid_items` WHERE startdate LIKE '2008-11-%%'"));
				$breakdown .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Nov:</b> ".$count."<br />";
				
				$count = count($db->getAll("SELECT * FROM `cashltd_cash`.`legalbid_items` WHERE startdate LIKE '2008-10-%%'"));
				$breakdown .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Oct:</b> ".$count."<br />";
				
				$count = count($db->getAll("SELECT * FROM `cashltd_cash`.`legalbid_items` WHERE startdate LIKE '2008-09-%%'"));
				$breakdown .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Sep:</b> ".$count."<br />";
				
				
				
				$page->addVar("breakdown", $breakdown);
				
				
				$page->addVar("HomeFolder", self::folder);
				$page->addPage(self::folder . "options.tpl");
			$page->fullReplace("[-currentmodule-]", "Add Hotkey Data");
			$page->fullReplace("[-currentmodulelink-]", "javascript:addNewHotkey();");
			}
			
		}

		// End Class
?>