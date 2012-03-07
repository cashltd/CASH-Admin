<?php 

	
	function makeCall($extension, $callName, $callNumber) {
		$socket = fsockopen("localhost","5038", $errno, $errstr); 
		fputs($socket, "Action: Login\r\n"); 
		fputs($socket, "UserName: admin\r\n");
		fputs($socket, "Secret: 3eNusu2a\r\n\r\n");
		
		$wrets=fgets($socket,128); 
		
		fputs($socket, "Action: Originate\r\n" ); 
		fputs($socket, "Channel: SIP/$extension\r\n" ); 
		fputs($socket, "Exten: $callNumber\r\n" ); 
		fputs($socket, "Priority: 1\r\n" ); 
		fputs($socket, "Callerid: \"$callName\" <$callNumber>\r\n");
		fputs($socket, "Async: yes\r\n\r\n" ); 
		
		$wrets=fgets($socket,128); 
		echo $wrets; 
	}
	
	makeCall("200", "Simon Skinner", "07515879426");


?> 

