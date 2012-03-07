<?php

$userExtension = $_GET['user'];
$clientName = $_GET['name'];
$clientNumber = $_GET['number'];

$callCode = "Channel: SIP/".$userExtension."
Callerid: Calling ".$clientName."
MaxRetries: 0
RetryTime: 60
WaitTime: 20
Context: users
Extension: ".$clientNumber;

$myFile = "outgoing/newCallStamp.call";
	$fh = fopen($myFile, 'w') or die("can't open file");
	fwrite($fh, $callCode);
fclose($fh);

?>