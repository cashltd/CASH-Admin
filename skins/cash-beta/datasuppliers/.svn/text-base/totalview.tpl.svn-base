<script>
{literal}



	var freshpagestart = 0;
	var acceptpagestart = 0;
	var declinepagestart = 0;



	var provider = '0';
	var perpage = 15;
	var userid = {/literal}{$userid}{literal};
{/literal}
</script>

<script>
{literal}
	function setLoading(frame) {
		$(frame).update("<center><img src='{/literal}{$HomeUrl}{literal}skins/cash/images/load.gif'><br /><b>Loading... Please Wait!</b></center>");
	}

	
	function freshchange(type) {
		switch (type)
			{
				case 'n':
				  freshpagestart = freshpagestart + 1;
				  break;
				case 'p':
					if (freshpagestart > 0) {
				  		freshpagestart = freshpagestart - 1;
					}
				  break;
			}
		claimp.stop();
		claimp.url = '{/literal}{$HomeUrl}{literal}ajax/datasuppliers_freshdata/id/'+provider+'-'+freshpagestart+'-'+perpage+'-'+userid+'/';
		claimp.start();
		
	}

	
	function declinechange(type) {
		switch (type)
			{
				case 'n':
				  declinepagestart = declinepagestart + 1;
				  break;
				case 'p':
					if (declinepagestart > 0) {
					  declinepagestart = declinepagestart - 1;
					}
				  break;
			}
		claimr.stop();
		claimr.url = '{/literal}{$HomeUrl}{literal}ajax/datasuppliers_olddata/id/'+provider+'-'+declinepagestart+'-'+perpage+'-'+userid+'/';
		claimr.start();
		
	}
	
	function acceptchange(type) {
		switch (type)
			{
				case 'n':
				  acceptpagestart = acceptpagestart + 1;
				  break;
				case 'p':
					if (acceptpagestart > 0) {
					  acceptpagestart = acceptpagestart - 1;
					}
				  break;
			}
		claimq.stop();
		claimq.url = '{/literal}{$HomeUrl}{literal}ajax/datasuppliers_newdata/id/'+provider+'-'+acceptpagestart+'-'+perpage+'-'+userid+'/';
		claimq.start();
		
	}
	
	
	function refreshAll() {
			freshpagestart = 0;
			acceptpagestart = 0;
			declinepagestart = 0;
		claimq.stop();
		claimr.stop();
		claimp.stop();
			setLoading('claimQueue');
			setLoading('noVerify');
			setLoading('toVerify');
				claimp.url = '{/literal}{$HomeUrl}{literal}ajax/datasuppliers_freshdata/id/'+provider+'-'+freshpagestart+'-'+perpage+'-'+userid+'/';
				claimq.url = '{/literal}{$HomeUrl}{literal}ajax/datasuppliers_newdata/id/'+provider+'-'+acceptpagestart+'-'+perpage+'-'+userid+'/';
				claimr.url = '{/literal}{$HomeUrl}{literal}ajax/datasuppliers_olddata/id/'+provider+'-'+declinepagestart+'-'+perpage+'-'+userid+'/';
		claimq.start();
		claimr.start();
		claimp.start();
	}
	
	function allgo() {
		{/literal}{foreach from=$suppliers item=item}{literal}$('sup{/literal}{$item.id}{literal}').removeClassName('selected');
		{/literal}{/foreach}{literal}$('sup0').removeClassName('selected');
	}
	
	function setsupplier(id) {
		allgo();
		provider = id;
		$('sup'+id).addClassName('selected');
		refreshAll();
	}
	
	function setuser(id) {
		$('ser{/literal}{$userid}{literal}').removeClassName('selected');
		$('ser0').removeClassName('selected');
		$('ser'+id).addClassName('selected');
		userid = id;
		refreshAll();
	}
	
{/literal}
</script>


<div id="supplierselect">
	<a href="javascript:;" class="selected" id="sup0" onclick="setsupplier('0')">All Data</a>
		{foreach from=$suppliers item=item}
			<a href="javascript:;" id="sup{$item.id}" onclick="setsupplier('{$item.id}')">{$item.name}</a>
		{/foreach}
</div>

<div id="userselect"><a href="javascript:;" id="ser{$userid}" class="selected" onClick="setuser('{$userid}')">Just Me</a> <a href="javascript:;" id="ser0" onClick="setuser('0')">All Users</a></div> 





<script>
{literal} 
// <![CDATA[
var claimp = new Ajax.PeriodicalUpdater('toVerify', '{/literal}{$HomeUrl}{literal}ajax/datasuppliers_freshdata/id/'+provider+'-'+freshpagestart+'-'+perpage+'-'+userid+'/', {
  method: 'get', frequency: 30});
// ]]>
{/literal} 
</script>
<div id="toVerify">
<center><b>Loading... Please Wait!</b></center>
</div>


<a name="accepted"></a><h3 class="green"><div class="hider" onClick="Effect.toggle('claimQueue', 'blind');">Toggle</div>Accepted Claims</h3>
<script>
{literal} 
// <![CDATA[
var claimq = new Ajax.PeriodicalUpdater('claimQueue', '{/literal}{$HomeUrl}{literal}ajax/datasuppliers_newdata/id/'+provider+'-'+acceptpagestart+'-'+perpage+'-'+userid+'/', {
  method: 'get', frequency: 30});
// ]]>
{/literal} 
</script>
<div id="claimQueue" style="display: none;">
<center><b>Loading... Please Wait!</b></center>
</div>



<h3 class="red"><div class="hider" onClick="Effect.toggle('noVerify', 'blind');">Toggle</div>Declined Claims</h3>

<script>
{literal} 
// <![CDATA[
var claimr = new Ajax.PeriodicalUpdater('noVerify', '{/literal}{$HomeUrl}{literal}ajax/datasuppliers_olddata/id/'+provider+'-'+declinepagestart+'-'+perpage+'-'+userid+'/', {
  method: 'get', frequency: 30});
// ]]>
{/literal} 
</script>
<div id="noVerify" style="display: none;">
<center><b>Loading... Please Wait!</b></center>
</div>




