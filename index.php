<?php

require_once("framework/config.php");




	$page = new layout();
	

	$page->addVar("HomeUrl", HomeUrl);
	$page->addVar("ImageUrl", HomeUrl."skins/".DEFAULTSKIN."/images/");
	$page->addVar("SkinUrl", HomeUrl."skins/".DEFAULTSKIN."/");


	if (login::isLoggedIn() OR safe::get('fn')=="doLogin" OR safe::get('cl')=="livechat" OR safe::get('fn')=="doLogout" OR safe::get('fn')=="createClaimantsMailMergeFile" OR safe::get('cl')=="api") {
		if (safe::get('cl') == "sitemap") {
	
			$sitemap = new sitemap();
	
				$sitemap->addLink(HomeUrl);
				$sitemap->addLink(HomeUrl . "sitemap.xml");
	
			$sitemap->view();
			$page->render("xml");
	
		} else if (	safe::get('cl') == "ajax"
								OR (safe::get('cl') == "livechat" AND (
																											safe::get('fn') == "send_live_users"
																											)
								) OR (safe::get('cl') == "admin" AND safe::get('fn') == "createClaimantsMailMergeFile")) {
	
						if (method_exists(safe::get('cl'), safe::get('fn')))
						call_user_func(Array(safe::get('cl'), safe::get('fn')));
						else
						call_user_func(Array("site", "display"));
			$page->render();
	
		} else if (safe::get('csv') == "TRUE" OR safe::get('cl') == "api" OR (safe::get('cl') == "livechat" AND safe::get('fn') == "server")) {
				
					
					if (method_exists(safe::get('cl'), safe::get('fn')))
						call_user_func(Array(safe::get('cl'), safe::get('fn')));
						
			$page->render("json");
	
		} else {
			$sql = "SELECT hideannouncement FROM admin_login WHERE id='".(int)login::getUserID()."' LIMIT 1";
			$announcedb = new database();
			$deters = $announcedb->getFirst($sql);
		
			
			$page->addPage("head.tpl", ARRAY( "announcement" => "You can now change your password by using the 'Change Your Password' link on the <a href='http://admin.cash-ltd.co.uk/'>Home Page</a> or by <a href='javascript:;' onClick='changePassword();'>Clicking Here</a>"));
						if (method_exists(safe::get('cl'), safe::get('fn')))
						call_user_func(Array(safe::get('cl'), safe::get('fn')));
						else
						call_user_func(Array("site", "display"));
						
				if ($deters['hideannouncement'] == 0) {
					$page->addPage("showann.tpl");
				}
						
						
			$page->addPage("foot.tpl");
			$page->render();
	
		}
	} else {
		
		$page->addPage("loginhead.tpl");
		
			call_user_func(Array("login", "loginForm"));
		
		$page->addPage("loginfoot.tpl");
		$page->render();
	}

?>