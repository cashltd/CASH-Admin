<?php

	class search
	{
		const folder = "search/";
		
		
		
		
		public function results()
		{
			GLOBAL $page;
		
			// First split up the string by spaces
			$search = explode(" ", $_POST['q']);
			
			
			// Search our claimants
			$db = new Database();
			$results = $db->getAll("SELECT id FROM claimants_data WHERE tel LIKE '%".$search[0]."%' OR mobile LIKE '%".$search[0]."%' OR fname LIKE '%".$search[0]."%' OR sname LIKE '%".$search[0]."%';");
		
			$claimants = Array();
		
			foreach ($results AS $result) 
			{
				$claimant = new ClaimantData($result['id']);
				$claimants[] = $claimant->asArray();
			}
		
		
		
		
			$page->addPage(self::folder . "results.tpl", ARRAY( 'claimants' => $claimants));	
		
		}
		
	}

?>