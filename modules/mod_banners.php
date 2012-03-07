<?php

	class banners {
		
		const folder = "banners/";
		
		public function clicks() {
			GLOBAL $page;
			
			$db = new database();
			$results = $db->getAll("SELECT * FROM cashltd_banners ORDER BY clicks DESC;");
			
			
			$page->addPage(self::folder . "info.tpl", ARRAY( "banners" => $results ));
		}
		
	}

?>