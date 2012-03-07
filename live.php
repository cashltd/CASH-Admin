<?php
error_reporting(0);
// ## Below we choose the default database
// ## details so we don't have to set them
// ## everytime the database class is instanced.
define( 'DB_HOST', 'localhost' );					// Server the database is hosted on "localhost" for this server
define( 'DB_USER', 'cashltd_cashy' );				// Username for the database
define( 'DB_PASS', 'cashy' );						// Password for the database
define( 'DB_DATA', 'cashltd_cash' );				// database the information is in

  include_once("framework/classes/class_database.php");

	// Make sure that our last used timestamp is a reasonable size
  if (isset($_GET['json'][3]))
  {
    $jsonArray = Array(); // We return this array using json_encode.
    $jsonArray['newActions'] = Array(); // We create this so that the json array doesn't get confused
    
		// Get the currrent timestamp and also convert it to the mysql format timestamp
    $unixTimestamp = (int)$_GET['json']; // We don't use this any more but leave it in case we change our mind
    $mysqlTimestamp = date("Y-m-d H:i:s" ,$unixTimestamp);

		// Create variables holding the different timestamps we need to check
    $todayStart = date("Y-m-d H:i:s", strtotime("Today"));
    $todayEnd = date("Y-m-d H:i:s", strtotime("Tomorrow - 1 second"));
    $weekStart = date("Y-m-d H:i:s", (strtotime("Today") == strtotime("Monday")) ? strtotime("Monday") : strtotime("Last Monday"));
  
    // Query our database to get the results that we need to display
    $db = new Database();
    $results = $db->getAll("SELECT * FROM admin_actions INNER JOIN admin_login ON admin_actions.uid = admin_login.id WHERE action LIKE '%Accepted%' AND timestamp > '".$mysqlTimestamp."' ORDER BY timestamp DESC LIMIT 0,5;");
    $callsToday = $db->getAll("SELECT count(*) AS count FROM admin_actions WHERE action LIKE '%Set%' AND timestamp >= '".$todayStart."' AND  timestamp <= '".$todayEnd."' ORDER BY timestamp DESC LIMIT 0,5;");
    $accClaimsToday = $db->getAll("SELECT count(*) AS count FROM admin_actions WHERE action LIKE '%Accepted%' AND timestamp >= '".$todayStart."' AND  timestamp <= '".$todayEnd."' ORDER BY timestamp DESC LIMIT 0,5;");
    $accClaimsWeek = $db->getAll("SELECT count(*) AS count FROM admin_actions WHERE action LIKE '%Accepted%' AND timestamp >= '".$weekStart."' AND  timestamp <= '".$todayEnd."' ORDER BY timestamp DESC LIMIT 0,5;");

		// Return the current timestamp so we can post it back from jQuery this way records
		// are always up to date and jQuery doesn't have to check for duplicates.
    $jsonArray['timestamp'] = strtotime("now");

    $jsonArray['solicitors'] = 6; // Currently we don't have the option the check this from a database

		// Send our call and claim counts into the array to be returned
    $jsonArray['callsToday'] = $callsToday[0]['count'];
    $jsonArray['accClaimsToday'] = $accClaimsToday[0]['count'];
    $jsonArray['accClaimsWeek'] = $accClaimsWeek[0]['count'];
    
		// Add all new actions to the created array
    foreach ($results AS $res) $jsonArray['newActions'][] = Array("easyText" => $res['fname']." accepted a new claim!<br /><span class='smaller'>".date("H:i", strtotime($res['timestamp']))." on ".date("l jS F", strtotime($res['timestamp']))."</span>", "name" => $res['fname'], "date" => date("H:i", strtotime($res['timestamp']))." on ".date("l jS F", strtotime($res['timestamp'])));
    
		// json encode our array and print it to the browser
    print json_encode($jsonArray);
    
  } else {

?>

<html>
<head>
<title></title>

<style>

#celebrate {
  display: none;
  height: 500px;
  width: 1100px;
  background-image: url(/skins/cash/images/celebrate.png);
  position: absolute;
  top: 100px;
  left: 50%;
  margin-left: -550px;
  z-index: 1000;
  
}
  #celebrate #text {
    width: 650px;
    height: 300px;
    margin-top: -150px;
    margin-left: -325px;
    position: absolute;
    left: 50%;
    top: 50%;
    text-align: center;
    color: #ee960b;
    text-shadow: 2px 2px 2px #999;
    font-size: 70px;
    font-weight: bold;
    font-family: helvetica;
    line-height: 100px;
  }

.floatLeft {
}
.padRight {
  margin-right: 30px;
  display: inline-block;
  padding-top: 5px;
}
  .padRight img
  {
    margin-top: -3px;
  }

body, html { width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: black; }

#fullpage {
  padding: 20px;
  height: 780px;
  display: block;
  position: relative;
}

#bottomArea {
  position: absolute;
  bottom: 0px;
  margin: auto;
  left: 50%;
  margin-left: -470px;
  display: block;
  width: 900px;
  border-radius: 40px;
  -webkit-box-shadow: 0px 0px 2px #000;
  background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#fff), to(#ccc));
  padding: 20px;
  font-size: 20px;
  font-weight: bold;
  font-family: helvetica;
  color: #445918;
  text-shadow: 2px 2px 2px #999;
  text-align: center;
}
  #bottomArea #content {
    display: block;
  }

#logo {
  margin-bottom: 30px;
}

#container {
  border-radius: 40px;
  -webkit-box-shadow: 0px 0px 10px white;
  background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#ffffff), to(#ccc));
  height: 100%;
  padding: 40px;
}

#announcements {
  list-style: none;
  display: none;
}

#louisacontent {
  margin-bottom: 20px;
  display: block;
}

#announce {
  border-radius: 10px;
  padding: 20px;
  -webkit-box-shadow: 0px 0px 2px #000;
  text-align: center;
  background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#fff), to(#ccc));
  width: 900px;
  margin: auto;
  font-size: 40px;
  font-weight: bold;
  font-family: helvetica;
  color: #445918;
  text-shadow: 2px 2px 2px #999;
  display: none;
  margin-top: 120px;
}

.smaller {
  font-size: 30px;
}

</style>

<!-- Include jQuery -->
<script src="/framework/script/jquery.js"></script>

<script>

	// Control our display with easly editible variables
  var newLoadSeconds = 10;
  var tickerDisplaySeconds = 10;
  var animationSeconds = 1;
  var celebrateSeconds = 15;

	// Setup some variable that we need later on
  var currentElement = 0;
  var tickers = new Array();
  var lastTimestamp = 11111; // Invent a really old timestamp used for the first json request
  var ajaxPullHolder, runAnimationHolder, celebrateText;


	// ************************************************
	// Function to update the timestamp so we can check
	// for new results since our last request.
	// ************************************************
  function updateTs() {
    lastTimestamp = new Date().getTime();
    console.log("Timestamp Updated to " + lastTimestamp);
  }

	// ************************************************
	// Function called on first run and after a pause
	// to keep the json data coming in.
	// ************************************************
  function updateAjax() {
    ajaxPullHolder = window.setInterval(ajaxPull, newLoadSeconds*1000);
  }

	// ************************************************
	// Function called on first run and after a pause
	// to keep our annimation running.
	// ************************************************
  function runAnimation() {
    displayAnnounce();
    runAnimationHolder = window.setInterval( displayAnnounce, ((tickerDisplaySeconds*1000)+((animationSeconds*1000)*2)) );
  }
	
	// *************************************************
	// Basic function to hide the user details and then
	// change the data in it and display it again.
	// *************************************************
  function displayAnnounce() {
    $("#announce").fadeOut((animationSeconds*1000), function() {
      $(this).html(tickers[currentElement]).fadeIn((animationSeconds*1000), function() {
        if (currentElement == (tickers.length-1))
          currentElement = 0 
        else 
          currentElement ++;
      })
      });
  }
  
	// ************************************************
	// This is our main control function that handles
	// our incoming json data and displaying it.
	// ************************************************
  function ajaxPull(first) {
    first = typeof(first) != 'undefined' ? first : false;
    $.getJSON("/live.php?json="+lastTimestamp, function(data) { }).success(function(data) {
			// Store the timestamp of the json so we don't get the same data next request
      lastTimestamp = data.timestamp;
      
			// Check to see if our number of calls has changed since our last json update
			if (data.callsToday != $("#callsToday").html()) $("#callsToday").html(data.callsToday);
      if (data.accClaimsToday != $("#accClaimsToday").html()) $("#accClaimsToday").html(data.accClaimsToday);
      if (data.accClaimsWeek != $("#accClaimsWeek").html()) $("#accClaimsWeek").html(data.accClaimsWeek);
      if (data.solicitors != $("#panelSolicitors").html()) $("#panelSolicitors").html(data.solicitors);
      
      if (data.newActions.length > 0) {
        $.each(data.newActions, function(key, val) {
          if (first) tickers.push(val.easyText);
          else tickers.unshift(val.easyText);
          if (!first) tickers.pop();
        });
        
        if (!first) {
          console.log("In the area to display the celebration");
          // Pause the current display system
          window.clearInterval(ajaxPullHolder);
          window.clearInterval(runAnimationHolder);
          
          // Woop new claim, get excited!
          if (data.newActions.length > 1) {
            var names = "";
            $.each(data.newActions, function(key, val) {
              names = (names == "") ?  names + val.name : names + " and " + val.name;
            })
            
            
            celebrateText = names + " have just accepted claims!";
          } else {
            celebrateText = data.newActions[0].name + " has just accepted a claim!";
          }

          $('#celebrate #text').html(celebrateText);
          $('embed').remove();
          $('body').append('<embed src="/cheer.wav" autostart="true" hidden="true" loop="false">');
          $('#celebrate').fadeIn((animationSeconds*1000), function() {
            console.log("Fading in the celebration");
            // Play a sound now!
                        
            // Start normal display system again
            window.setTimeout(function() {
              $('#celebrate').fadeOut((animationSeconds*1000), function() {
                updateAjax(false);
                runAnimation();
              })
            }, celebrateSeconds*1000 );
          })
          
        }
        
        currentElement = 0;
      }
      
      if (first) runAnimation();
     });
    
  }

	// ************************************************
	// When the page has loaded we pull in our json
	// data and start the animation to display it.
	// ************************************************
  $(document).ready(function() {
    ajaxPull(true);
    updateAjax();  
  });
  
</script>


</head>
<body>
<div id="fullpage">
  <div id="container">
    <div id="celebrate">
      <div id="text">
        Simon has just accepted a claim! So there!
      </div>
    </div>
  
    <div style="text-align: center; display: block;" id="logo">
    <img src="/skins/cash/images/cash_ltd_logo.png">
    </div>

    <div id="announce"></div>
 
    <div id="bottomArea">
      <div id="louisacontent">
      <span class="floatLeft padRight">
      <img src="/skins/cash/images/princ.png" height="28" width="28" align="left" hspace="10">
  
      Louisa has got <span id="panelSolicitors">0</span> solicitors onto the panel!
      </span>
      </div>
    
      <div id="content">
    
        <span class="floatLeft padRight">
        <img src="/skins/cash/images/phone.png" height="28" width="28" align="left" hspace="10">
    
        <span id="callsToday">0</span> calls today
        </span>
    
      
        <span class="floatLeft padRight">
        <img src="/skins/cash/images/tick.png" height="28" width="28" align="left" hspace="10">
    
        <span id="accClaimsToday">0</span> Accepted today
        </span>
    
    
          <span class="floatLeft padRight">
          <img src="/skins/cash/images/tick.png" height="28" width="28" align="left" class="floatLeft" hspace="10">

          <span id="accClaimsWeek">0</span> Accepted this week!
          </span>
    
      </div>
    </div>
    
  </div>
</div>
</body>
</html>

<?php

}

?>