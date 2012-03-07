<div id="alertInbox">
<center><img src="{$HomeUrl}skins/cash/images/load.gif"><br /><b>Loading Alerts... Please Wait!</b></center>
</div>

<script>
	addLoadEvent(function() {literal}{{/literal}
		populateInbox();
	{literal}}{/literal});

	{if $disp eq "TRUE"}
	addLoadEvent(function(){literal}{{/literal}
		var trey = setTimeout("markMessageRead({$id},{$arrayid})",2000);
	{literal}}{/literal});
	{/if}
</script>
