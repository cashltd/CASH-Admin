<?php

	class claimform
		{
			const folder = "claimform/";
			protected $state = Array();
			protected $stateID, $claimantID, $formType;
			
			// set the basic variables that we need to know for claim form creation
			public function __construct($formType, $stateID=0)
			{
				$this->formType = $formType;
				$this->stateID = $stateID;
			}





			// Temporary page to show how to use / test the claimform creation system!
			public function access()
			{
				GLOBAL $page;
			
				$claimform = new claimform("RTA", 1);
				
				if ($claimform->stateID != 0)
				{
					$claimform->loadState();
				} else {
					$claimform->createAccident();
				}
				
				
				$claimform->setField("Name", "Anthony Skinner");
				
//				$claimform->setField("Address", "28 Dutton Road, Blackpool, Lancs");
//				$claimform->setField("Postcode", "FY38DH");
//				$claimform->setField("TelephoneNumberDay", "0800600666");
//				$claimform->setField("TelephoneNumberHome", "01253301483");
//				$claimform->setField("TelephoneNumberMobile", "07515879426");
//				$claimform->setField("EMailAddress", "vultuk@gmail.com");
//				$claimform->setField("NationalInsuranceNumber","JH660658C");
				
				
				
				$claimform->saveState();
			
			
			
				print_r($claimform->state);
				$page->addHtml('LOL');
			}
			
			
			





			// Create the state for a new form and fill it with the correct form details
			private function createAccident()
			{
				if ($this->formType == "RTA") {
				
					$tempArray = Array(		// Start Victim Details
															"Name" => "",
															"Address" => "",
															"Postcode" => "",
															"TelephoneNumberDay" => "",
															"TelephoneNumberHome" => "",
															"TelephoneNumberMobile" => "",
															"EMailAddress" => "",
															"NationalInsuranceNumber" => "",
															"DateOfBirth" => "",
															"BestTimeToCall" => "",
															"TimeOffWork" => "",
															"LossOfEarnings" => "",
															"ClaimRejected" => "",
															"BeingProcessed" => "",
															"UnderInfluence" => "",
															"ExpenseFunding" => ""
															
																// 
															
															
															
														);
														
														
								
				}
				
			
			
			
			
				$this->state = $tempArray;
			}

			// Function to set a field of the claim form to the required value
			private function setField($field, $value)
			{
				$this->state[$field] = $value;
			}

			// Load the current form state into the class so we can start to edit it
			private function loadState()
			{
					$db = new database();
					$getState = $db->getFirst("SELECT id, state, timestamp FROM  `claimform_state` WHERE id='".$this->stateID."' LIMIT 0 , 30");
				
					$this->state = unserialize($getState['state']);
			}
		
			// Save the current state of the form into the database
			private function saveState()
			{
				
				$db = new database();
				
				if ($this->stateID != 0)
				{
					$db->query("UPDATE claimform_state SET state='".serialize($this->state)."', updated='".strtotime("now")."' WHERE id='".$this->stateID."'");
				} else {
					$db->query("INSERT INTO `cashltd_cash`.`claimform_state` (`id`, `state`, `timestamp`, `updated`) VALUES (NULL, '".serialize($this->state)."', '".strtotime("now")."', '".strtotime("now")."');");
				}
				
			}
		
		}

?>