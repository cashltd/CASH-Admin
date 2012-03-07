<?php

		class user {

			private $username;
			private $password;
			private $id;
			private $name;

			public function __construct($table = "users", $userdb = DB_DATA) {
				 $this->username = safe::cookie("username");
				 $this->password = safe::cookie("password");

				$checkLoggedIn = new database($userdb);
				$result = $checkLoggedIn->getFirst("	SELECT id, name FROM " . $table . "
											WHERE uname = '" . $this->username . "' AND pword = '" . $this->password . "';
											");

				if ($checkLoggedIn->empty) {
					$this->loggedIn = FALSE;
				} else {
					$this->loggedIn =  TRUE;
					$this->id = $result['id'];
					$this->name = $result['name'];
				}
			}

			/**
			 * Check if user is logged in
			 *
			 * @param mixed $table Name of the table storing the user details
			 * @param mixed $userdb Database storing the user details
			 * @return boolean True if the user is logged in, False if not.
			 */
			public function isLoggedIn() {
				return $this->loggedIn;
			}

			/**
			 * Returns the ID of the currently logged in user
			 *
			 * @return integer ID of the logged in user
			 */
			public function getCurrentUserID() {
				return $this->id;

			}

			/**
			 * Returns the Name of the currently logged in user
			 *
			 * @return mixed Name of the logged in user
			 */
			public function getCurrentUserName() {
				return $this->name;

			}

			public function login() {
				GLOBAL $smarty;
				$smarty->display("class_user_login.tpl");
			}

			public function saveLogin() {
				setcookie("username", safe::post("username"), time()+(3600*12), "/");
				setcookie("password", md5(safe::post("password")), time()+(3600*12), "/");
				headers::setHeader('redirect',FALSE,HomeUrl);
			}

			public function clearLogin() {
				setcookie("username", "loggedout", time()+(3600*12), "/");
				setcookie("password","loggedout", time()+(3600*12), "/");
				headers::setHeader('redirect',FALSE,HomeUrl);
			}


		}

?>