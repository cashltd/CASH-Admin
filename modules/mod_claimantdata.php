<?php

	class ClaimantData extends SingleClaimant
	{
	
		static $assignedID;
	
		static $bit;
		static $supplier;
		static $timestamp;
		static $lastcallperiod;
		static $handlerID;
		static $handlerName;
		static $callback;
		
		public function view()
		{
			GLOBAL $page;
			
			$details = new ClaimantData(safe::get('id'));
			
			$page->addPage("claimantview.tpl", Array('details'=>$details->asArray()));
			
		}
		
		public function __construct($id)
		{
			$this->assignedID = $id;
		
			$db = new Database();
			$result = $db->getFirst("SELECT callback, clientid, supplier, bit, timestamp, lastcallperiod, userid FROM claimants_data WHERE id='".$id."';");
			
			$this->bit = $result['bit'];
			$this->timestamp = $result['timestamp'];
			$this->lastcallperiod = $result['lastcallperiod'];
			$this->supplier = $result['supplier'];
			$this->handlerID = $result['userid'];
			$this->handlerName = login::getUsernameX($result['userid']);
			$this->callback = $result['callback'];
			
			$this->claimantid = $result['clientid'];
			$this->LoadClaimant();
			
		}
	
	}

?>