<?php

	// When requiring to connect to the livechat server we use the defined variable  LIVECHAT_SERVER

	class livechat
		{

			// Simple function to send back the livechat server address for ajax callback
			public function server()
				{
					print json_encode(LIVECHAT_SERVER);
				}
		
		
			
			// This function sends the current list of online users to the main server
			// It will be called on a cron job every 2(?) minutes to maintain a constantly updated list
			public function send_live_users()
				{
					// Connect to database and find anyone online in the last 3(?) minutes
					$timeago = strtotime("-24 days");
					$db = new database();
					$results = $db->getAll("SELECT id, fname, sname, avatar, lastaction FROM admin_login WHERE active=1 AND lastaction > '".$timeago."';");
										
					$handle = curl_init("http://".LIVECHAT_SERVER."/livechat_recieve/live_users/");
					curl_setopt($handle, CURLOPT_POST, true);
					curl_setopt($handle, CURLOPT_POSTFIELDS, array( "results" => json_encode($results) ) );
					$return = curl_exec($handle);
				}
				
		}


?>