<?PHP

	class solicitors {
		
		const folder = "solicitors/";
		
		
		
		public function options() {
			GLOBAL $page;
			
				$page->addHtml("<center>");
				$page->addHtml("<a href='".HomeUrl."solicitors/viewAll/'>View All Solicitors</a><br />");
				$page->addHtml("<a href='http://hotkey.nationwideaccesstosolicitors.co.uk/sendclaim.php' target='_blank'>Search Solicitors</a><br />");
				$page->addHtml("<a href='http://hotkey.nationwideaccesstosolicitors.co.uk/sendclaim.php' target='_blank'>Not Yet Contacted Counties</a><br />");
				$page->addHtml("<a href='javascript:addNewHotkey();'>Add Solicitor</a><br />");
				$page->addHtml("</center>");
				
				
		}
		
		
		public function viewAll() {
			GLOBAL $page;
			
			$db = new database();
			$sectors = $db->getAll("SELECT id, title FROM solicitors_sectors;");
			
			
			$page->addPage(self::folder . "totalview.tpl", ARRAY( 'userid' => login::getUserID(), "sectors" => $sectors ));
			
			$page->fullReplace("[-currentmodule-]", "Add New Solicitor");
			$page->fullReplace("[-currentmodulelink-]", "javascript:addNewHotkey();");
		}
		
		
		// Ajax callbacks
		public function listsolicitors() {
			GLOBAL $page;
			
			
			$db = new database();
			$sols = $db->getAll("SELECT * FROM solicitors_sols LIMIT 0,20");
			
			
			$page->addPage(self::folder . "listsolicitors.tpl", ARRAY( "sols" => $sols ));
			
		}
		
	}

?>