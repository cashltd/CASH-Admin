<?PHP

	class login {
		
		public function log($uid, $message) {
			
			$db = new database();
			$db->query("INSERT INTO `admin_actions` (`id` ,`uid` ,`action` ,`timestamp`) VALUES (NULL , '".$uid."', '".$message."', NOW( ));");
			
		}
		
		
		public function getUserExtension($userid=False) {
			if (!$userid)
				$sql = "SELECT extension FROM admin_login WHERE username='".$_COOKIE['username']."' AND password='".$_COOKIE['password']."'";
			else
				$sql = "SELECT extension FROM admin_login WHERE id='".$userid."'";
				
			$db = new database();
			$result = $db->getFirst($sql);
			return $result['extension'];
		}
		
		public function getUserDetailsFromExtension($ext) {
			$sql = "SELECT * FROM admin_login WHERE extension='".$ext."'";
				
			$db = new database();
			$result = $db->getFirst($sql);
			return $result;
		}
		
		
		public function getUsername() {
			$db = new database();
			$result = $db->getFirst("SELECT username FROM admin_login WHERE username='".$_COOKIE['username']."' AND password='".$_COOKIE['password']."'");
			return $result['username'];
		}
		
		public function getStrict() {
			$db = new database();
			$result = $db->getFirst("SELECT strict FROM admin_login WHERE username='".$_COOKIE['username']."' AND password='".$_COOKIE['password']."'");
			return $result['strict'];
		}
		
		public function getUsernameX($id) {
			$db = new database();
			$result = $db->getFirst("SELECT fname, sname FROM admin_login WHERE id='".$id."'");
			return $result['fname']." ".$result['sname'];
		}
		
		public function getUserID() {
			$db = new database;
			$result = $db->getFirst("SELECT id FROM admin_login WHERE username='".$_COOKIE['username']."' AND password='".$_COOKIE['password']."'");
			return $result['id'];
		}
		
		public function getUserRank() {
			$db = new database;
			$result = $db->getFirst("SELECT rank FROM admin_login WHERE username='".$_COOKIE['username']."' AND password='".$_COOKIE['password']."'");
			return $result['rank'];
		}
		
		public function doLogin() {
			setcookie("username", safe::post("username"), time()+(3600*12), "/");
			setcookie("password", md5(safe::post("password")), time()+(3600*12), "/");	
		}
		
		public function doLogout() {
			GLOBAL $page;
			setcookie("username", "asd", time()+(3600*12), "/");
			setcookie("password", "asd", time()+(3600*12), "/");
			
				$db = new database();
				$db->query("UPDATE  `cashltd_cash`.`admin_login` SET page = '',  `lastaction` =  '' WHERE  `admin_login`.`id` ='".login::getUserID()."';");
				
			
			$page->redirect(HomeUrl);
		}
		
		public function loginForm() {
			GLOBAL $page;
			
			$page->addPage("loginform.tpl");
		}
		
		public function isLoggedIn() {
			GLOBAL $page;
			
			$db = new database();
			$result = $db->getFirst("SELECT username FROM admin_login WHERE username='".$_COOKIE['username']."' AND password='".$_COOKIE['password']."'");
			
				if ($_COOKIE['username'] <> "" AND $result['username'] == $_COOKIE['username']) {
					return TRUE;	
				} else {
					if ($_COOKIE['username'] <> "" AND $_COOKIE['username'] <> "asd") {
						define("ERROR", "<div class='error'>Incorrect Username / Password</div>");
						$page->addVar("error","<div class='error'>Incorrect Username / Password</div>");
					}
					return FALSE;
				}
			
			}
		
	}

?>