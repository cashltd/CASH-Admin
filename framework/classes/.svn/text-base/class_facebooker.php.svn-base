<?php

	class facebooker {

		private $apikey;
		private $apisecret;
		private $apicallback;
		public $fb;
		public $user;

		public function __construct($apikey, $apisecret, $apicallback) {
			$this->apikey = $apikey;
			$this->apisecret = $apisecret;
			$this->apicallback = $apicallback;

			$this->fb = new Facebook($this->apikey, $this->apisecret);
			$this->user = $this->fb->require_login();

			try {
			  if (!$this->fb->api_client->users_isAppAdded()) {
			    $this->fb->redirect($this->fb->get_add_url());
			  }
			} catch (Exception $ex) {
			  //this will clear cookies for your application and redirect them to a login prompt
			  $this->fb->set_user(null, null);
			  $this->fb->redirect($this->apicallback);
			}
		}

		public function setProfileBoxHTML( $html ) {
			$this->fb->api_client->profile_setFBML($html, $this->user);
		}

		public function getAdded() {
			$rs = $this->fb->api_client->fql_query("SELECT uid FROM user WHERE has_added_app=1 and uid IN (SELECT uid2 FROM friend WHERE uid1 = $this->user)");
			$bvapp = "";

			if ($rs)
			{
			    for ( $i = 0; $i < count($rs); $i++ )
			    {
			        if ( $bvapp != "" )
			            $bvapp .= ",";

			        $bvapp .= $rs[$i]["uid"];
			    }
			}
			return $bvapp;
		}

		public function publishNews($title, $body,
                                           $image_1=null, $image_1_link=null,
                                           $image_2=null, $image_2_link=null,
                                           $image_3=null, $image_3_link=null,
                                           $image_4=null, $image_4_link=null) {

			$this->fb->api_client->feed_publishActionOfUser($title, $body,
                                           $image_1, $image_1_link,
                                           $image_2, $image_2_link,
                                           $image_3, $image_3_link,
                                           $image_4, $image_4_link);

		}
	}


?>