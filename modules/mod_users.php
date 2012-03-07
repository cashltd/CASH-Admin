<?php	// Legal Bid administration Module
		// Written by Simon Skinner
		// First Revision 01.10.08




    class weblog_pdf extends FPDF
  	{
  	  //Current column
      var $col=0;
      //Ordinate of column start
      var $y0;
      
      var $date;
  	  
  		function Header()
  		{
  			$this->Image('/var/www/skins/cash/images/cash_ltd_logo.png',5,5,0,30);
  			$this->SetFont('Arial', 'B', '14');
  			$this->Cell(0,8, "Web Log Report for", 0, 1, "R");
  			$this->SetFont('Arial', '', '12');
  			$this->Cell(0,8, date("l, F jS Y", strtotime($this->date)), 0, 1, "R");
  			$this->SetXY(10, 40);
  			$this->SetFont('Arial', '', '10');
  		}
  		
  		function SetCol($col)
      {
          //Set position at a given column
          $this->col=$col;
          $x=10+$col*65;
          $this->SetLeftMargin($x);
          $this->SetX($x);
      }

      function AcceptPageBreak()
      {
          //Method accepting or not automatic page break
          if($this->col<2)
          {
              //Go to next column
              $this->SetCol($this->col+1);
              //Set ordinate to top
              $this->SetY($this->y0);
              //Keep on page
              return false;
          }
          else
          {
              //Go back to first column
              $this->SetCol(0);
              //Page break
              return true;
          }
      }
  		
  	}


		class users {
			
			const folder = "users/";
			

			public function changePassword() {
				GLOBAL $page;
				
				$page->addPage(self::folder . "changepassword.tpl");
			}
			
			public function goChangePassword() {
				
				$sql = "UPDATE admin_login SET password='".MD5(safe::post('newpassword'))."' WHERE id='".(int)login::getUserID()."' LIMIT 1 ;";

				$newdatabase = new database();
				$newdatabase->query($sql);

				
				setcookie("password", md5(safe::post("newpassword")), time()+(3600*12), "/");	
				
				ajax::hideAnnounce();
				
			}
			
			public function adduser() {
				GLOBAL $page;
				
				$page->addPage(self::folder . "adduser.tpl");
				$page->fullReplace("[-currentmodule-]", "User Options");
				$page->fullReplace("[-currentmodulelink-]", "".HomeUrl."users/options/");
			}
			
			public function domain() {
				GLOBAL $page;

				if (strlen(safe::get("id")) > 2 )
				{
					$idstring = explode(":", safe::get("id"));

					if (strlen($idstring[0]) < 2) {
						$idstring[0] = "%";
						$ip = "All Computers";
					} else {
						$ip = $idstring[0];
					}

					$extwhere = "WHERE src_ip LIKE '".$idstring[0]."' ";
					
					if (strlen($idstring[1]) > 2) {
						$date_explode = explode("-", $idstring[1]);
						$start_timestamp = mktime(0,0,0,$date_explode[1],$date_explode[0],$date_explode[2]); 
						$end_timestamp = mktime(23,59,59,$date_explode[1],$date_explode[0],$date_explode[2]);
						
						$extwhere .= "AND (timestamp > '".$start_timestamp."' AND timestamp < '".$end_timestamp."') ";
						
						$for = $idstring[1];
					} else {
						$for = "All Dates";
					}
					
					$extwhere .= "AND req_uri LIKE '%".$idstring[2]."%'";

				} else {
					$ip = "All Computers";
					$for = "All Dates";
				}
				
				
				$db = new database("squidlog_db", "localhost", "root", "oliviashaw");
				$results = $db->getAll("SELECT * 
										FROM  `access_log` 
										".$extwhere."
										ORDER BY timestamp DESC");
				
				$domain_array = array();
				foreach ($results AS $res) {
					$urlparsed = $res['req_uri'];
					$urlparseds = parse_url($res['req_uri'], PHP_URL_HOST);
					if ($urlparseds <> "admin.cash-ltd.co.uk") $domain_array[] = $res;
				}
				
				$compiled = $domain_array;
								
				$page->addPage(self::folder . "domain.tpl", Array('urls'=>$compiled, 'ip'=>$ip, 'for'=>$for, 'domain'=>$idstring[2]));
				$page->fullReplace("[-currentmodule-]", "User Options");
				$page->fullReplace("[-currentmodulelink-]", "".HomeUrl."users/options/");
			}
			
			public function domainWhitelist() {
			  
			  $db = new database();
			  $results = $db->getAll("SELECT url FROM url_whitelist;");
			  
			  foreach ($results as $result) {
			    
			    $whitelist[] = $result['url'];
			    
			  }									
									
					return $whitelist;
			  
			}
				
			public function getLogArray($ip, $from, $to) {
			  
			  $startStampa = strtotime($from);
			  $endStampa = strtotime($to);
			  
        $startStamp = mktime( 0,
                             0,
                             0,
                             (int)date("m", $startStampa),
                             (int)date("d", $startStampa),
                             (int)date("Y", $startStampa)
                           );
        
        
       $endStamp = mktime( 23,
                            59,
                            59,
                            (int)date("m", $endStampa),
                            (int)date("d", $endStampa),
                            (int)date("Y", $endStampa)
                          );
                        
			  

			  
			  $db = new database("squidlog_db", "localhost", "root", "oliviashaw");
			  			  
			  $sql = "SELECT * 
										            FROM  `access_log` 
										            WHERE `src_ip` = '".$ip."'
										                  AND `timestamp` >= '".$startStamp."'
										                  AND `timestamp` <= '".$endStamp."';";
			  			  
			  $results = $db->getAll($sql);
			  
			  $domain_array = array();
				foreach ($results AS $res) {
				  // Check the domain wasn't accessed at break times
				    $breakTimes = Array( Array( 'start' => '0:00', 'finish' => '9:05' ),
				    
				                         Array( 'start' => '10:10', 'finish' => '10:35' ),
				                         Array( 'start' => '12:25', 'finish' => '13:05' ),
                     				     Array( 'start' => '15:10', 'finish' => '15:35' ),
                     				     
                     				     Array( 'start' => '19:55', 'finish' => '23:59' )
				                        );
				                        
				    $breaktime = FALSE;
				    // Get current timestamp date
				    
				    foreach ($breakTimes AS $break) {
				      $splitstart = explode(':',$break['start']);
              $splitend = explode(':',$break['finish']);
              
              
              $timestart = mktime( (int)$splitstart[0],
                                   (int)$splitstart[1],
                                   0,
                                   (int)date("m", $res['timestamp']),
                                   (int)date("d", $res['timestamp']),
                                   (int)date("Y", $res['timestamp'])
                                 );
              
              $timeend   = mktime( (int)$splitend[0],
                                   (int)$splitend[1],
                                   59,
                                   (int)date("m", $res['timestamp']),
                                   (int)date("d", $res['timestamp']),
                                   (int)date("Y", $res['timestamp'])
                                 );
                                 
				      
				      if ($res['timestamp'] >= $timestart AND $res['timestamp'] <= $timeend) {
				        $breaktime = TRUE;
				      }
				      
				    }
				  
				  if (!$breaktime) {
					  $urlparsed = parse_url($res['req_uri'], PHP_URL_HOST);
					  $domain_array[] = $urlparsed;
				  }
				}
				
				$compiled = array_diff(array_unique($domain_array), users::domainWhitelist());
			  
			  return $compiled;
			  
			}
			
			public function whitelisturl() {
			  
			  $db = new database();
			  $db->query("INSERT INTO `url_whitelist` (`id`, `url`) VALUES (NULL, '".safe::get('id')."');");
			  
			  header("Location: http://admin.cash-ltd.co.uk/users/weblogs/");
			}
			
			public function makeLogPDF() {
			  
			  
			  $users = Array( Array("name" => "Amy Hamilton", "IP" => "192.168.0.40"),
			                  Array("name" => "Louisa Blofeld", "IP" => "192.168.0.203"),
                			  Array("name" => "Yvonne Dolan", "IP" => "192.168.0.206"),
                			  Array("name" => "Martin Rowe", "IP" => "192.168.0.209"),
                			  Array("name" => "Vanessa Stephens", "IP" => "192.168.0.213"),
                			  Array("name" => "Mel Hamilton", "IP" => "192.168.0.214"),
                			  Array("name" => "Simon Skinner", "IP" => "192.168.0.242")
			                  );
			  
			  if ((int)date("N") == 1)
			    $monday = strtotime("This Monday", time());
			  else
			    $monday = strtotime("Last Monday", time());
			  
			  $dateArray = Array( date("Y-m-d", $monday),
			                      date("Y-m-d", strtotime("+1 day", $monday)), 
			                      date("Y-m-d", strtotime("+2 days", $monday)), 
			                      date("Y-m-d", strtotime("+3 days", $monday)), 
			                      date("Y-m-d", strtotime("+4 days", $monday))
			                    );
			  
			  $pdf = new weblog_pdf("P", "mm", "A4");

        foreach ($dateArray AS $date) {
          $pdf->col = 0;
          $pdf->date = $date;
          $pdf->AddPage("P", "A4");
        
          $pdf->y0 = $pdf->GetY();
        
          foreach ($users AS $user) {

            $logs = users::getLogArray($user['IP'], $date, $date);

    			  $pdf->SetFont('Arial', 'B', '10');
    			  $pdf->SetX( $pdf->GetX() - 5 );
      			$pdf->Cell(0,8, $user['name'], 0, 1, "L");
    			  $pdf->SetFont('Arial', '', '8');
            
            if (count($logs) > 0) {
      			  foreach ($logs AS $log) {
      			    
      			    $pdf->Cell(0,5, $log, 0, 1, "L", false, "http://admin.cash-ltd.co.uk/users/domain/id/".$user['IP'].":".date("d-m-Y",strtotime($date)).":".$log."/");
      			  }
            } else {
              $pdf->Cell(0,5, "No Websites Viewed", 0, 1, "L");
            }

  		    }
			  
		    }
			  
			  $pdf->Output("test.pdf", "D");
			  
			}
			
			
			
			public function logReturnTest() {
			  
			  
			  $logs = users::getLogArray("192.168.0.214", "2011-08-08", "2011-08-08");
			  
			  print_r( $logs );
			  
			}
			
			public function weblogs() {
				GLOBAL $page;
			
				
				if (strlen(safe::get("id")) > 1 )
				{
					$idstring = explode(":", safe::get("id"));

					if (strlen($idstring[0]) < 2) {
						$idstring[0] = "%";
						$ip = "All Computers";
					} else {
						$ip = $idstring[0];
					}

					$extwhere = "WHERE src_ip LIKE '".$idstring[0]."' ";
					
					if (strlen($idstring[1]) > 2) {
						$date_explode = explode("-", $idstring[1]);
						$start_timestamp = mktime(0,0,0,$date_explode[1],$date_explode[0],$date_explode[2]); 
						$end_timestamp = mktime(23,59,59,$date_explode[1],$date_explode[0],$date_explode[2]);
						
						$extwhere .= "AND (timestamp > '".$start_timestamp."' AND timestamp < '".$end_timestamp."') ";
						
						$for = $idstring[1];
						
					} else {
						$for = "All Dates";
					}

					$db = new database("squidlog_db", "localhost", "root", "oliviashaw");
					$results = $db->getAll("SELECT * 
											FROM  `access_log` 
											".$extwhere."
											");
					
					$domain_array = array();
					foreach ($results AS $res) {
						$urlparsed = parse_url($res['req_uri'], PHP_URL_HOST);
						$domain_array[] = $urlparsed;
					}
					
					$compiled = array_diff(array_unique($domain_array), users::domainWhitelist());
								
					$page->addPage(self::folder . "weblog.tpl", Array('urls'=>$compiled, 'ip'=>$ip, 'for'=>$for));
					
				} else {
					$page->addPage(self::folder . "computerlist.tpl");
				}

				
				$page->fullReplace("[-currentmodule-]", "User Options");
				$page->fullReplace("[-currentmodulelink-]", "".HomeUrl."users/options/");
			}
			
			public function options() {
				GLOBAL $page;
				
				$page->addHtml("<center>");
				
				
					if (login::getUserRank() == 3) {
						$page->addHtml("<a href='".HomeUrl."admin/sendmessage/'>Send User a Message</a><br />");
						$page->addHtml("<a href='".HomeUrl."admin/userstats/'>View User Stats</a><br />");
						$page->addHtml("<a href='".HomeUrl."users/viewedit/'>View / Edit User</a><br />");
						$page->addHtml("<a href='".HomeUrl."users/adduser/'>Add User</a><br />");
						$page->addHtml("<a href='".HomeUrl."users/deleteuser/'>Delete User</a><br />");
						$page->addHtml("<a href='".HomeUrl."users/weblogs/'>Web Logs</a><br />");
					}
					
					
					$page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='http://hotkey.nationwideaccesstosolicitors.co.uk/sendclaim.php' target='_blank'><img src='".HomeUrl."skins/".DEFAULTSKIN."/images/"."send.png' border='0'><br />Send Claim Form</a></div>");
					
					$page->addHtml("<div style='text-align: center; font-size: 9px; width: 70px; height: 100px; float: left; margin-right: 5px; margin-left: 5px;'><a href='javascript:;' onClick='changePassword();'><img src='".HomeUrl."skins/".DEFAULTSKIN."/images/"."password.png' border='0'><br />Change Your Password</a></div>");
					
				$page->addHtml("</center>");
				
				
				$page->fullReplace("[-currentmodule-]", "Legalbid Options");
				$page->fullReplace("[-currentmodulelink-]", "".HomeUrl."legalbid/options/");
			}
			
		}

		// End Class
?>