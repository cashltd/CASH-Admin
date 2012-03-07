<?php

	class site {


		public function logTestPage() {
			GLOBAL $page;
			
		
			$page->addPage("test.tpl");
		}



		
		public function format_telfax2 ($number,$fax="no") {
		    $number=trim($number);
		    $number = str_replace(" ", "", $number);
		    $number = str_replace("-", "", $number);
		    $number = str_replace("(", "", $number);
		    $number = str_replace(")", "", $number);
		    $number = str_replace("+", "00", $number);
		    if (substr($number,0,2) == "02") {
		        $formattedtext = substr($number,0,3)." ".substr($number,3,4)." ".substr($number,7,4);
		    } else if (substr($number,0,2) == "01" && substr($number,3,1) == "1")  {
		        $formattedtext = substr($number,0,4)." ".substr($number,4,3)." ".substr($number,7,4);
		    } else if (substr($number,0,3) == "011" || substr($number,0,3) == "033" || substr($number,0,4) == "0871")  {
		        $formattedtext = substr($number,0,4)." ".substr($number,4,3)." ".substr($number,7,4);
		    } else if (substr($number,0,3) == "080" || substr($number,0,3) == "050")  {
		        $formattedtext = substr($number,0,4)." ".substr($number+" ",3,7);
		    } else if (substr($number,0,2)=="00")  {
		        $formattedtext = "+".substr($number,2);
		    } else if (substr($number,0,1)=="8")  {
		        $formattedtext = $number;
		    } else {
		        $formattedtext = substr($number,0,5)." ".substr($number,5);
		    }
 
		    return $formattedtext;
		}
		
		
		public function log($_logMessage) {
		
			$db = new database();
			$db->query("INSERT INTO `cashltd_cash`.`admin_actions` (`id`, `uid`, `action`, `timestamp`) VALUES (NULL, '".login::getUserID()."', '".$_logMessage."', CURRENT_TIMESTAMP);");
		
		}
		
		

		public function itemhead($title, $extraclass="") {
			GLOBAL $page;
			
			$page->addHtml("\n\n\t<div class='inOptions draggable' id='".preg_replace("/[^a-zA-Z0-9]/", "", $title)."'>\n\t\t<div class='inTitle ".$extraclass."'>".$title."</div>\n\t\t<div class='minipad'>\n\n");
		}
		
		public function itemheadLarge($title) {
			GLOBAL $page;
			
			$page->addHtml("\n\n\t<div class='inOptionsLarge draggable' id='".preg_replace("/[^a-zA-Z0-9]/", "", $title)."'>\n\t\t<div class='inTitle'>".$title."</div>\n\t\t<div class='minipad'>\n\n");
		}
		
		public function itemfoot() {
			GLOBAL $page;
			
			$page->addHtml("\n\n\t\t</div>\n\t</div>");
		}
		
		
		
		
		public function display() {

			GLOBAL $page;

			
			$allowedOptions = ARRAY( "Legalbid Options",
									 "Data Supplier Options",
									 "User Options"
									);
			
			$page->addHtml("<div id='sortableMenu'>");
			

			
			site::itemhead("Legalbid Options");
			 legalbid::options();
			site::itemfoot();
			
			
				site::itemhead("Claimants", "titleBlue");
				 claimants::options();
				site::itemfoot();
			
			
			
			site::itemhead("Hotkey Options", "titleRed");
			 datasuppliers::options();
			site::itemfoot();
			
			if (login::getUserRank() == 3) {
				site::itemhead("Solicitors Database");
				 solicitors::options();
				site::itemfoot();
			}
			
				site::itemhead("User Options");
				 users::options();
				site::itemfoot();
			
						if (login::getUserRank() == 3) {
				site::itemheadLarge("Calendar");
				 calendar::options();
				site::itemfoot();
			}
			
			$page->addHtml("</div>");
			
			
			$page->addHtml("\n\n\t<br style=\"clear: both;\">\n\n");

			$page->addHtml("<script>\n");
			
			$page->addHtml("Sortable.create('sortableMenu',{tag:'div',handle:'Gripper',constraint:false,scroll:window});");
			
			/*
				foreach ($allowedOptions AS $aO) {
					$page->addHtml("new Draggable('".preg_replace("/[^a-zA-Z0-9]/", "", $aO)."', { revert: true });\n");
				}
			*/
			
			$page->addHtml("</script>");
			
			
		}


	}


?>
