<?php

function display_error($error, $error_string, $filename, $line, $symbols) {
	
	$headers = 'From: it@cash-ltd.co.uk' . "\r\n" . 
    'Reply-To: it@cash-ltd.co.uk' . "\r\n" . 
    'X-Mailer: PHP/' . phpversion(); 

$sentMail = mail("C.A.S.H IT Department <it@cash-ltd.co.uk>", 
				 "Internal Site Error", 
				 "There has been an error on the internal site. The error details are as follows...\n\n".
				 $error_string."\n".$filename.":".
				 $line,
				 $headers, "-fit@cash-ltd.co.uk");
	
	print "<center>There has been an error on this page. The IT team have been informed. Please use the <b>Back Button</b> on your browser to continue.</center>";

}

set_error_handler('display_error');

function ping($host, $port, $timeout) { 
  $tB = microtime(true); 
  $fP = fSockOpen($host, $port, $errno, $errstr, $timeout); 
  if (!$fP) { return false; } 
  $tA = microtime(true); 
  return round((($tA - $tB) * 1000), 0)." ms"; 
}





$ping = ping('intranet.cash-ltd.co.uk', 80, 10);
if ($ping)
	{
		print $ping;
	}


?>