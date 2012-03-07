<?php


	class SingleClaimant
	{
	
		static $claimantid;
	
		static $title;
		static $forename;
		static $surname;
		static $address1;
		static $address2;
		static $address3;
		static $town;
		static $county;
		static $postcode;
		static $telephone;
		static $mobile;
		static $email;
		static $long;
		static $lat;
		static $status;
		
		static $texted;
		
		static $dataFileName;
		static $dataFileID;
		
		static $callLog = Array();
		static $textLog = Array();
		
		public function asArray()
		{
			return (array)$this;
		}
	
		public function LoadClaimant()
		{
			$cl = new Database();
			$details = $cl->getFirst("SELECT * FROM total_claimants WHERE id='".$this->claimantid."'");
			
			$this->title = $details['title'];
			$this->forename = $details['forename'];
			$this->surname = $details['surname'];
			$this->address1 = $details['add1'];
			$this->address2 = $details['add2'];
			$this->address3 = $details['add3'];
			$this->town = $details['town'];
			$this->county = $details['county'];
			$this->postcode = $details['postcode'];
			$this->telephone = $details['telephone'];
			$this->mobile = $details['mobile'];
			$this->email = $details['email'];
			$this->long = $details['long'];
			$this->lat = $details['lat'];
			$this->status = $details['status'];
			$this->dataFileID = $details['csv'];
			
			// If we have changed the numbers then we update the database
			// This saves changing things every time we load a claimant
			if ($this->numberFixes())
				$this->SaveClaimant();
				
			$calls = new Database("asteriskcdrdb");
			$allCalls = $calls->getAll("SELECT * FROM cdr WHERE dst='".(($this->telephone) == "" ? "***" : $this->telephone)."' OR dst='".(($this->mobile) == "" ? "***" : $this->mobile)."';");
			$this->callLog['outgoing'] = $this->ParseCallData($allCalls, "out");
		
			$calls = new Database("asteriskcdrdb");
			$allCalls = $calls->getAll("SELECT * FROM cdr WHERE src='".(($this->telephone) == "" ? "***" : $this->telephone)."' OR src ='".(($this->mobile) == "" ? "***" : $this->mobile)."';");			
			$this->callLog['incoming'] = $this->ParseCallData($allCalls, "in");
			
			$dblc = new database();
			$this->textLog = $dblc->getAll("SELECT * FROM textmessage_log WHERE telephone='".(($this->mobile) == "" ? "***" : $this->mobile)."';");
			if (count($this->textLog))
				$this->texted = TRUE;
			else
				$this->texted = FALSE;
		
			$dfdb = new Database();
			$dfdbr = $dfdb->getFirst("SELECT filename FROM claimants_csv_data WHERE id='".$this->dataFileID."';");
			$this->dataFileName = $dfdbr['filename'];
		
		}
		
		private function ParseCallData($data, $type)
		{
			$parsedData = Array();
			foreach ($data AS $call)
			{
				if ($type == "out")
				{
					$call['username'] = login::getUserDetailsFromExtension($call['src']);
				} else {
					$call['username'] = login::getUserDetailsFromExtension($call['src']);
				}
				
				$callTime = strtotime($call['calldate']);
				$link = date("Y/m/d", $callTime);
				$call['recordLink'] = "/monitor/".$link."/".$call['recordingfile'];
				
				$parsedData[] = $call;
			}
			
			return $parsedData;
		}
		
		private function SaveClaimant()
		{
			// Save the record to the database
		}
		
		
		public function SendTextMessage()
		{	
			$db = new Database();
			$message = "Free Text. Our records indicate you may be entitled to compensation for the accident you had. Tel: 0800 8405601 Web: www.cash-ltd.co.uk - To opt-out reply stop";
			$db->query("INSERT INTO  `cashltd_cash`.`textmessage_log` (
						`id` ,
						`telephone` ,
						`message` ,
						`uid` ,
						`cid` ,
						`timestamp`
						)
						VALUES (
						NULL ,  '".$this->mobile."',  '".addslashes($message)."',  '".login::getUserID()."',  '".$this->claimantid."',  '".strtotime("NOW")."'
						);");
						
			claimants::sendSMS($this->mobile, $message);
		}
		
		private function numberFixes()
		{
			// Telephone Number Fixes
			$this->telephone = str_replace(" ","", $this->telephone);
			if (substr($this->telephone,0,1) != 0) $this->telephone = "0".$this->telephone;
			
			// Mobile Number Fixes
			$this->mobile = str_replace(" ","", $this->mobile);
			if (substr($this->mobile,0,1) != 0) $this->mobile = "0".$this->mobile;
			
			// Move mobile numbers into the mobile column if it's blank
			if ($this->mobile == "" AND substr($this->telephone, 0, 2) == "07") { $this->mobile = $this->telephone; $this->telephone = ""; }
			// Move landline numbers into the landline column if it's blank
			if ($this->telephone == "" AND substr($this->mobile, 0, 2) != "07") { $this->telephone = $this->mobile; $this->mobile = ""; }
			// Switch around mobile and landlines if they're in the wrong columns
			if (substr($this->telephone, 0, 2) == "07" AND substr($this->mobile, 0, 2) != "07")
			{ 
				$tempTel = $this->telephone;
				$this->telephone = $this->mobile;
				$this->mobile = $tempTel;
			}
		}
			
		public function __construct($id)
		{
			$this->claimantid = $id;
			$this->LoadClaimant();
			
		}
	
	}


	?>