<?php

include_once('./framework/classes/class_database.php');
include_once('./modules/mod_googlemap.php');

	function addNewClaimant($dataArray, $echo = FALSE) {
			GLOBAL $page;
			
				$newData = Array();
				foreach ($dataArray as $k => $v) {
					$newData[$k] = addslashes($v);
				}
					$dataArray = $newData;
			
			$address = $dataArray['add1'] ." ". $dataArray['add2'] ." ". $dataArray['add3'] ." ". $dataArray['town'] ." ". $dataArray['county'] ." ". $dataArray['postcode'] ." UK";
			
			
			
			$gmap = new googlemap("ABQIAAAA7tJM0bGPT2tNMHxzg_rCCBT-oQ1JliOD_5xyMSDqa3TtwxZE6xT1-0TwXh0edWM_HBvoRmpxw-_WgQ");
			$longlat = $gmap->getLongLat($address);
		//		$longlat = ARRAY("long" => 0, "lat" => 0);

			
			
			$db = new database();
			$db->query("INSERT INTO `cashltd_cash`.`total_claimants` (`id`, `co_id`, `title`, `forename`, `surname`, `add1`, `add2`, `add3`, `town`, `county`, `postcode`, `telephone`, `mobile`, `email`, `long`, `lat`, `csv`) VALUES (NULL, '".$dataArray['co_id']."', '".$dataArray['title']."', '".$dataArray['forename']."', '".$dataArray['surname']."', '".$dataArray['add1']."', '".$dataArray['add2']."', '".$dataArray['add3']."', '".$dataArray['town']."', '".$dataArray['county']."', '".$dataArray['postcode']."', '".$dataArray['telephone']."', '".$dataArray['mobile']."', '".$dataArray['email']."', '".$longlat['lat']."', '".$longlat['long']."', '".$dataArray['csv']."');");
			
			
			
			
			
			if ($echo) {
				print("Added ".$dataArray['title']." ".$dataArray['forename']." ".$dataArray['surname']."(".$address.")\n");
			}
			
			
			
		}



	define( 'DB_HOST', 'localhost' );					// Server the database is hosted on "localhost" for this server
	define( 'DB_USER', 'cashltd_cashy' );				// Username for the database
	define( 'DB_PASS', 'cashy' );						// Password for the database
	define( 'DB_DATA', 'cashltd_cash' );				// database the information is in


ini_set('auto_detect_line_endings', true);
ob_start();
ob_flush();
flush();

ob_flush();
flush();


$csvfilename = 517;
$db = new database();
$result = $db->getFirst("SELECT * FROM claimants_csv_data WHERE id='".$csvfilename."'");

$csvString = $result['data'];
$explodedCSV = explode("\n", $csvString);



foreach ($explodedCSV as $line) {
$data = str_getcsv($line);

if ($result['format'] == 'DLG') {

if ($data[0] != "INDIVIDUALID" AND $data[0] != '') {

$sendData = Array(	"co_id" => $data[0],
"title" => $data[1],
"forename" => $data[2],
"surname" => $data[3],
"add1" => $data[4],
"add2" => $data[5],
"add3" => $data[6],
"town" => $data[7],
"county" => $data[8],
"postcode" => $data[9],
"telephone" => $data[10],
"mobile" => $data[11],
"email" => "",
"csv" => $csvfilename
);
addNewClaimant($sendData, TRUE);
}
} else if ($result['format'] == 'DLGRDP') {
print $data[0];
if ($data[0] != "INDIVIDUALID" AND $data[0] != "LeadID" AND $data[0] != '') {

$sendData = Array(	"co_id" => $data[0],
"title" => $data[1],
"forename" => $data[2],
"surname" => $data[3],
"add1" => $data[4],
"add2" => $data[5],
"add3" => $data[6],
"town" => $data[7],
"county" => $data[8],
"postcode" => $data[9],
"telephone" => $data[11],
"mobile" => "",
"email" => "",
"csv" => $csvfilename
);
addNewClaimant($sendData, TRUE);
}
} else if ($result['format'] == 'CPN') {
if ($data[0] != "Title" AND $data[0] != '') {

$sendData = Array(	"co_id" => "0",
"title" => $data[0],
"forename" => $data[1],
"surname" => $data[2],
"add1" => $data[3] . " " . $data[4],
"add2" => $data[5],
"add3" => $data[6],
"town" => $data[7],
"county" => $data[8],
"postcode" => $data[9],
"telephone" => $data[10],
"mobile" => $data[11],
"email" => $data[12],
"csv" => $csvfilename
);

addNewClaimant($sendData, TRUE);
}
}

ob_flush();
flush();

sleep(2);

}

print "Done";
?>
