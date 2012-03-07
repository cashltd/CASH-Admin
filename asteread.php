<?php

	class AsteriskSocket {

		// Store the singleton instance
		private static $_asteriskClass;

		// Store details of the AMI server
		private $_username = "admin";
		private $_password = "3eNusu2a";
		private $_host = "localhost";
		private $_port = 5038;
		
		private $_socket;


		
		
		private function handleCallback($msg) {
			if ( preg_match("/Event: Dial/", $msg) )
				echo $msg;
		}


		public function startSocketRead() {
			// While the socket is open we send the callback to our Callback Handler
			while (!feof($this->_socket)) {
				$this->handleCallback(fread($this->_socket, 8192));
			}
		
		}




		// Force the socket to close if we are happy to do so
		public function forceClose() {
			fclose($this->_socket);
		}



		// ###############################
		// General Singleton class methods
		public static function getInstance() {
			if (!self::$_asteriskClass) self::$_asteriskClass = new AsteriskSocket();			
			return self::$_asteriskClass;
		}

		private function __construct() {
			// Connect to the Asterisk AMI and store it locally
			$this->_socket = fsockopen($this->_host, $this->_port, $errno, $errstr);
			fputs($this->_socket, "Action: Login\r\n"); 
			fputs($this->_socket, "UserName: ".$this->_username."\r\n");
			fputs($this->_socket, "Secret: ".$this->_password."\r\n\r\n");
		}
		
		public function __destruct() {
			$this->forceClose();
		}

	}



	$openSocket = AsteriskSocket::getInstance();
	$openSocket->startSocketRead();
	


?>