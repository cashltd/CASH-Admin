<script>
{literal}

var thismonth = "{/literal}{$HomeUrl}{literal}ajax/stats_show/id/{/literal}{$dates.thismonth.start}{literal}:{/literal}{$dates.thismonth.end}{literal}:235:490/";
var thisweek = "{/literal}{$HomeUrl}{literal}ajax/stats_show/id/{/literal}{$dates.thisweek.start}{literal}:{/literal}{$dates.thisweek.end}{literal}:235:490/";
var today = "{/literal}{$HomeUrl}{literal}ajax/stats_show/id/{/literal}{$start}{literal}:{/literal}{$end}{literal}:235:490/";


function toggleMessage() {
	$('chart_message').appear({ duration: 0.2 })
}


function showday() {
		
	livestats.stop();
	$('loadingIcon').toggle()
	livestats.url = today;
		
	$('chart_message').fade({duration: 0.2 })
	$('sup2').removeClassName('selected');
	$('sup1').removeClassName('selected');
	$('sup0').addClassName('selected');
	livestats.start();

}

function showweek() {
		
	livestats.stop();
	$('loadingIcon').toggle()
	livestats.url = thisweek;
		
	$('chart_message').fade({duration: 0.2 })
	$('sup2').removeClassName('selected');
	$('sup0').removeClassName('selected');
	$('sup1').addClassName('selected');
	livestats.start();

}

function showmonth() {
		
	livestats.stop();
	$('loadingIcon').toggle()
	livestats.url = thismonth;
		
	$('chart_message').fade({duration: 0.2 })
	$('sup1').removeClassName('selected');
	$('sup0').removeClassName('selected');
	$('sup2').addClassName('selected');
	livestats.start();
}



function makePie(title, user,acc,dec,ret,dor,call,noan) {
	
	$('myCanvas').update("");

 var p = new pie();
 if (acc > 0) p.add("Accepted - "+acc+" ",acc);
 if (dec > 0) p.add("Declined - "+dec+" ",dec);
 if (ret > 0) p.add("Returned - "+ret+" ",ret);
 if (dor > 0) p.add("Dormant - "+dor+" ",dor);
 if (call > 0) p.add("Callback - "+call+" ",call);
 if (noan > 0) p.add("No Answer - "+noan+" ",noan);
 
 p.render("myCanvas", title + " statistics For " + user)
 
 toggleMessage();
 
}



// <![CDATA[
var livestats = new Ajax.PeriodicalUpdater('statsView', thismonth, {method: 'get', frequency: 10});
// ]]>
{/literal}
</script>
<div id="calendarselect">
	<a href="javascript:;" id="sup0" onclick="showday()">Day</a>
	<a href="javascript:;" id="sup1" onclick="showweek()">Week</a>
	<a href="javascript:;" id="sup2" class="selected" onclick="showmonth()">Month</a>
</div>

	<div class="chart_message" id="chart_message" style="display: none; cursor: hand;">
	<img src="{$HomeUrl}skins/cash/images/close.png" title="Close" class="closer" width="30" onclick="$('chart_message').fade({literal}{duration: 0.2 }{/literal})">
	<div id="chart_moreDetails">
		
		<div id="myCanvas" style="margin: auto; margin-top: 5px; position:relative;height:270;width:270px; z-index: 99; opacity: 1.2;"></div> 

		
	</div>
	</div>
<div id="statsView">
<center><img src='{$HomeUrl}skins/cash/images/load.gif'><br /><b>Loading... Please Wait!</b></center>

</div>