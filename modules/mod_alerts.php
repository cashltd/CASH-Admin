<?php


	class alerts {
		const folder = "alerts/";
		
		
		public function view() {
			GLOBAL $page;
			
			
			if (strlen(safe::get('id')) > 1) {
				$disp = "TRUE";
				$displayids = explode(":",safe::get('id'));
			} else {
				$disp = "FALSE";
			}
			
			
			$page->addPage(self::folder . "view.tpl", ARRAY( "id" => $displayids[0], "arrayid" => $displayids[1], "disp" => $disp ) );
			$page->fullReplace("[-currentmodule-]", "");
			$page->fullReplace("[-currentmodulelink-]", "javascript:;");
		}
		
		
	}
	
?>