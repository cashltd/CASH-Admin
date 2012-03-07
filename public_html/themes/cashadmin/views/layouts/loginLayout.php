
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
 
<!-- Website Title --> 
<title>WeAdmin | Login</title>

<!-- Meta data for SEO -->
<meta name="description" content="">
<meta name="keywords" content="">

<!-- Template stylesheet -->
<link href="/themes/cashadmin/css/blue/screen.css" rel="stylesheet" type="text/css" media="all">
<link href="/themes/cashadmin/css/blue/datepicker.css" rel="stylesheet" type="text/css" media="all">
<link href="/themes/cashadmin/js/visualize/visualize.css" rel="stylesheet" type="text/css" media="all">
<link href="/themes/cashadmin/js/jwysiwyg/jquery.wysiwyg.css" rel="stylesheet" type="text/css" media="all">
<link href="/themes/cashadmin/js/fancybox/jquery.fancybox-1.3.0.css" rel="stylesheet" type="text/css" media="all">

<!--[if IE]>
	<link href="/themes/cashadmin/css/ie.css" rel="stylesheet" type="text/css" media="all">
	<meta http-equiv="X-UA-Compatible" content="IE=7" />
<![endif]-->

<!-- Jquery and plugins -->
<script type="text/javascript" src="/themes/cashadmin/js/jquery.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/jquery-ui.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/jquery.img.preload.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/hint.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/visualize/jquery.visualize.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/jwysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="/themes/cashadmin/js/fancybox/jquery.fancybox-1.3.0.js"></script>
<script type="text/javascript" charset="utf-8"> 
$(function(){ 
    // find all the input elements with title attributes
    $('input[title!=""]').hint();
    $('#login_info').click(function(){
		$(this).fadeOut('fast');
	});
});
</script>
</head>
<body class="login">

	<!-- Begin login window -->
	<div id="login_wrapper">
		
		<br class="clear"/>
		<div id="login_top_window">
			<img src="/themes/cashadmin/images/blue/top_login_window.png" alt="top window"/>
		</div>
		
		<!-- Begin content -->
		<div id="login_body_window">
			<?php echo $content; ?>
		</div>
		<!-- End content -->
		
		<div id="login_footer_window">
			<img src="/themes/cashadmin/images/blue/footer_login_window.png" alt="footer window"/>
		</div>
		<div id="login_reflect">
			<img src="/themes/cashadmin/images/blue/reflect.png" alt="window reflect"/>
		</div>
	</div>
	<!-- End login window -->
	
</body>
</html>



