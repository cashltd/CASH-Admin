<?php /* Smarty version 2.6.14, created on 2012-02-16 10:24:04
         compiled from head.tpl */ ?>

<html>
<head>
<title>C.A.S.H Limited Admin Panel</title>


<script src="<?php echo $this->_tpl_vars['HomeUrl']; ?>
framework/script/prototype.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['HomeUrl']; ?>
framework/script/scriptaculous.js" type="text/javascript"></script>

<!-- Import jQuery so we can start converting away from prototype! -->
<script src="<?php echo $this->_tpl_vars['HomeUrl']; ?>
framework/script/jquery.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['HomeUrl']; ?>
framework/script/jquery.ui.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['HomeUrl']; ?>
framework/script/timepicker.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['HomeUrl']; ?>
framework/script/jquery.rollingAlert.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['HomeUrl']; ?>
framework/script/jquery.loggedon.js" type="text/javascript"></script>
<script>
	var $j = jQuery.noConflict();
	$j(document).ready(function() <?php echo '{'; ?>

	
		$j("body").loggedon();
		
		$j("body").rollingAlert( <?php echo '{'; ?>
 	'stylesheet' : '<?php echo $this->_tpl_vars['SkinUrl']; ?>
rollingAlert.css',
									'containerClass' : 'rollingAlertContainer' 
								<?php echo '}'; ?>
 );
	<?php echo '}'; ?>
);
	$j.ajaxSetup (<?php echo '{'; ?>
  
	        cache: false  
	    <?php echo '}'; ?>
);
</script>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>




<script src="<?php echo $this->_tpl_vars['HomeUrl']; ?>
framework/script/modalbox.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['HomeUrl']; ?>
framework/script/niftycube.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['HomeUrl']; ?>
framework/script/cal.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['SkinUrl']; ?>
loadscript.js" type="text/javascript"></script>
<script src="<?php echo $this->_tpl_vars['HomeUrl']; ?>
framework/script/wz_jsgraphics2.js" type="text/javascript"></script> 
<script src="<?php echo $this->_tpl_vars['HomeUrl']; ?>
framework/script/pie.js" type="text/javascript"></script>


<link href="<?php echo $this->_tpl_vars['SkinUrl']; ?>
style.css" type="text/css" rel="stylesheet">
<link href="<?php echo $this->_tpl_vars['SkinUrl']; ?>
modalbox.css" type="text/css" rel="stylesheet">
<link href="<?php echo $this->_tpl_vars['SkinUrl']; ?>
graphstyle.css" type="text/css" rel="stylesheet">
<link href="<?php echo $this->_tpl_vars['SkinUrl']; ?>
custom-theme/jquery-ui-1.8.5.custom.css" type="text/css" rel="stylesheet">

<script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDd-ACLKb41PGKZIM3ayBZRXK30E-A8is0&sensor=false">
    </script>


</head>
<body bgcolor="#ffffff" topmargin="0">

<div id="bigAndBlack" style="display: none;"></div>
<div id="claimantDetailsArea" style="display: none;"></div>

<div id="alertMessage" style="display: none;">
<h2>New alert recieved</h2>

<p>You have received a new alert from <span id="alertUserName">name</span>. To view this message click the "view" button below. To hide this message click the "hide" button below <b>but do not forget</b> to read this message, it could be important!</p>

<input type="button" value="Hide" id="hideAlertButton"><input type="button" value="View" id="viewAlertButton"></div>

<div id="announcer" style="display: none;">
	<div class="maxipad">
		<?php echo $this->_tpl_vars['announcement']; ?>

	</div>
</div>

<div id="header">


	<div id="headcol">
		<div id="possibleAlerter"></div>
		<div id="bigHead"><a href="<?php echo $this->_tpl_vars['HomeURL']; ?>
">C.A.S.H Limited Admin Panel</a></div>
	</div>
	<div id="linkpanel">
		<div id="callTimeSince" title="Telephone Idle Time">
			<div style="float: left; padding-left: 5px; margin-top: 2px;">
			<form action="/search/results/" method="post"><input type="text" name="q"></form>
			</div>
			<div id="counter"></div>
		</div>
		<a href="<?php echo $this->_tpl_vars['HomeUrl']; ?>
">Home</a>
		<a href="[-currentmodulelink-]">[-currentmodule-]</a>
		<a href="<?php echo $this->_tpl_vars['HomeUrl']; ?>
alerts/view/" id="alertLink">Alerts (<div id="alertCount">0</div>)</a>
		<a href="<?php echo $this->_tpl_vars['HomeUrl']; ?>
login/doLogout/">Logout</a>
	</div>
</div>



<div id="myStats">

<script>
<?php echo '
	updateMe = function() {
		$j.ajax({
			url: "http://" + document.domain + "/ajax/statsUpdate/",
			success: function(data) {
				$j("#statsView").html(data);
				drawChart();
			} 
		});
	}
	var auto_stat = setInterval( function()
	{
		updateMe();
	}, 30000);
	updateMe();
'; ?>

</script>

<div id="statsView" class="topChart"></div>


<script>
	<?php echo '
		updateMeDaily = function() {
			$j.ajax({
				url: "http://" + document.domain + "/ajax/dailyStats/",
				success: function(data) {
					$j("#dailyStatsView").html(data);
					drawChartDaily();
				} 
			});
		}
		var auto_stat = setInterval( function()
		{
			updateMeDaily();
		}, 30000);
		updateMeDaily();
	'; ?>

</script>

<div id="dailyStatsView" class="topChart"></div>


<br style="clear: both;" />
</div>


<div id="content">
<div id="newalert" style="display:none;">Message Goes Here!</div>