<?php	// Framework Config and Load File (T_PAAMAYIM_NEKUDOTAYIM)


	date_default_timezone_set('Europe/London');

	error_reporting(0);
	//error_reporting(E_ALL);




	define( 'HomeUrl', 'http://'.$_SERVER['HTTP_HOST'].'/' );
	define( 'HOMEDIR', $_SERVER['DOCUMENT_ROOT']."/" );
	define( 'CLASSROOT', HOMEDIR . 'framework/classes/class_' );
	define( 'MODULEROOT', HOMEDIR . 'modules/mod_' );
	define( 'FORMROOT', HOMEDIR . 'framework/classes/forms/form_' );
	define( 'SKINDIR', HOMEDIR . 'skins/' );
	define( 'CACHEDIR', HOMEDIR . 'framework/cache' );

	define( 'LIVECHAT_SERVER', 'livechat' );

	

		define( 'DEFAULTSKIN', 'cash' );					// Choose defualt skin for the site
	
	
	define( 'PAGE_TYPE', 'html' );						// Set default page type for headers


	// ## Below we choose the default database
	// ## details so we don't have to set them
	// ## everytime the database class is instanced.
	define( 'DB_HOST', 'localhost' );					// Server the database is hosted on "localhost" for this server
	define( 'DB_USER', 'cashltd_cashy' );				// Username for the database
	define( 'DB_PASS', 'cashy' );						// Password for the database
	define( 'DB_DATA', 'cashltd_cash' );				// database the information is in

	require_once( HOMEDIR . "framework/smarty/Smarty.class.php");

	require_once( HOMEDIR . "framework/fpdf.php");
	require_once( HOMEDIR . "framework/fpdf_tpl.php");
	require_once( HOMEDIR . "framework/fpdi_pdf_parser.php");
	require_once( HOMEDIR . "framework/fpdi.php");


	ini_set("memory_limit","500M");
	function __autoload($class_name) {
		if (file_exists(CLASSROOT . strtolower($class_name) . '.php')) require_once CLASSROOT . strtolower($class_name) . '.php';
		else if (file_exists(MODULEROOT . strtolower($class_name) . '.php')) require_once MODULEROOT . strtolower($class_name) . '.php';
		else if (file_exists(FORMROOT . strtolower($class_name) . '.php')) require_once FORMROOT . strtolower($class_name) . '.php';
		else throw new Exception("Unable to find required file to load $class");
	}
?>
