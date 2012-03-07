
<script>{literal}
	var freshpagestart = 0;
	var acceptpagestart = 0;
	var declinepagestart = 0;

	var provider = '0';
	var perpage = 15;
	var userid = {/literal}{$userid}{literal};


	function refreshAll() {
		
	}

{/literal}</script>

<div id="userselect">

<a href="javascript:;" id="ser{$userid}" class="selected" onClick="setuser('{$userid}')">All</a> 
<a href="javascript:;" id="ser{$userid}" onClick="setuser('{$userid}')">Signed Up</a> 
<a href="javascript:;" id="ser{$userid}" onClick="setuser('{$userid}')">Interested</a> 
<a href="javascript:;" id="ser{$userid}" onClick="setuser('{$userid}')">Appointment Made</a> 
<a href="javascript:;" id="ser{$userid}" onClick="setuser('{$userid}')">Workable</a> 
<a href="javascript:;" id="ser{$userid}" onClick="setuser('{$userid}')">Not Interested</a> 
<a href="javascript:;" id="ser{$userid}" onClick="setuser('{$userid}')">Not Contacted</a> 

</div> 


<div id="supplierselect">
	<a href="javascript:;" class="selected" id="sec0" onclick="setsector('0')">All Sectors</a>
		{foreach from=$sectors item=item}
			<a href="javascript:;" id="sec{$item.id}" onclick="setsector('{$item.id}')">{$item.title}</a>
		{/foreach}
</div>



<script>
{literal} 
// <![CDATA[
var claimp = new Ajax.PeriodicalUpdater('toVerify', 'http://admin.cash-ltd.co.uk/ajax/solicitors_listsolicitors/id/'+provider+'-'+freshpagestart+'-'+perpage+'-'+userid+'/', {
  method: 'get', frequency: 30});
// ]]>
{/literal} 
</script>
<div id="toVerify">
<center><b>Loading... Please Wait!</b></center>
</div>