
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
 


<!-- Meta data for SEO -->
<meta name="description" content="">
<meta name="keywords" content="">

<!-- Template stylesheet -->
<link href="/themes/cashadmin/css/blue/screen.css" rel="stylesheet" type="text/css" media="all">
<link href="/themes/cashadmin/css/blue/datepicker.css" rel="stylesheet" type="text/css" media="all">
<link href="/themes/cashadmin/css/tipsy.css" rel="stylesheet" type="text/css" media="all">
<link href="/themes/cashadmin/js/visualize/visualize.css" rel="stylesheet" type="text/css" media="all">
<link href="/themes/cashadmin/js/jwysiwyg/jquery.wysiwyg.css" rel="stylesheet" type="text/css" media="all">
<link href="/themes/cashadmin/js/fancybox/jquery.fancybox-1.3.0.css" rel="stylesheet" type="text/css" media="all">
<link href="/themes/cashadmin/css/tipsy.css" rel="stylesheet" type="text/css" media="all">
<link href="/themes/cashadmin/css/cashcustom/jquery-ui-1.7.3.custom.css" rel="stylesheet" type="text/css" media="all">
<link href="/themes/cashadmin/css/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css" media="all">

<!--[if IE]>
	<link href="css/ie.css" rel="stylesheet" type="text/css" media="all">
	<script type="text/javascript" src="js/excanvas.js"></script>
<![endif]-->

<!-- Jquery and plugins -->
<script type="text/javascript" src="/themes/cashadmin/js/jquery.js"></script>


<!-- Website Title --> 
<title><?php echo CHtml::encode($this->pageTitle); ?></title>


<script type="text/javascript" src="/themes/cashadmin/js/jquery-ui.js"></script>

<script type="text/javascript" src="/themes/cashadmin/js/custom_blue.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/jquery.img.preload.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/hint.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/visualize/jquery.visualize.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/jwysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/fancybox/jquery.fancybox-1.3.0.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/jquery.tipsy.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/jquery-ui-timepicker-addon.js"></script>

<script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDd-ACLKb41PGKZIM3ayBZRXK30E-A8is0&sensor=false">
    </script>

</head>
<body>
<div class="content_wrapper">

	<!-- Begin header -->
	<div id="header">
		<div id="logo">
			<img src="/themes/cashadmin/images/logo.png" alt="logo"/>
		</div>
		<div id="search">
			<form action="dashboard.html" id="search_form" name="search_form" method="get">
				<input type="text" id="q" name="q" title="Search" class="search noshadow"/>
			</form>
		</div>
		<div id="account_info">
			<img src="/themes/cashadmin/images/icon_online.png" alt="Online" class="mid_align"/>
			Hello <a href=""><?php echo Yii::app()->user->name; ?></a> (<a href="">1 new message</a>)  | <a href="/site/logout">Logout</a>
		</div>
	</div>
	<!-- End header -->
	
	
	<!-- Begin left panel -->
	<a href="javascript:;" id="show_menu">&raquo;</a>
	<div id="left_menu">
		<ul id="main_menu">
			<li><a href="login_blue.html"><img src="/themes/cashadmin/images/icon_home.png" alt="Home"/>Home</a></li>
			<li>
				<a id="menu_pages" href=""><img src="/themes/cashadmin/images/icon_pages.png" alt="Pages"/>Pages</a>
				<ul>
					<li><a href="">Add new Pages</a></li>
					<li><a href="">Edit Pages</a></li>
				</ul>
			</li>
			<li>
				<a href=""><img src="/themes/cashadmin/images/icon_posts.png" alt="Posts"/>Claimants</a>
				<ul>
					<li><a href="/claimantList">View Claimants</a></li>
					<li><a href="/claimantList/create">Add Claimant</a></li>
				</ul>	
			</li>
			<li>
				<a href=""><img src="/themes/cashadmin/images/icon_media.png" alt="Media"/>Campaigns</a>
				<ul>
					<li><a href="/claimantCampaign">View Campaigns</a></li>
					<li><a href="/claimantCampaign/create">Add Campaign</a></li>
				</ul>
			</li>
			<li>
				<a href=""><img src="/themes/cashadmin/images/icon_users.png" alt="Solicitors"/>Solicitors</a>
				<ul>
					<li><a href="/solicitorFirm/">View Solicitors</a></li>
					<li><a href="/solicitorFirm/create">Add Solicitor</a></li>
				</ul>	
			</li>
		</ul>
		<br class="clear"/>
		
		<!-- Begin left panel calendar -->
		<div id="calendar"></div>
		<!-- End left panel calendar -->
		
	</div>
	<!-- End left panel -->
	
	
	<!-- Begin content -->
	<div id="content">
		<div class="inner">
		
			<?php echo $content; ?>

		</div>
		
		<br class="clear"/><br class="clear"/>
		
		<!-- Begin footer -->
		<div id="footer">
			&copy; Copyright 2012 C.A.S.H. Limited
		</div>
		<!-- End footer -->
		
		
	</div>
	<!-- End content -->
</div>
</body>
</html>