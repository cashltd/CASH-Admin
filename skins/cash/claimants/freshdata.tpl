<div style="position: absolute; margin-top: -50px">
<div id="statsholder" style="display: none;"><div id="statsinfo">ss</div></div>

{$currenticon}<img src="{$ImageUrl}stats.png" width="14" height="14" hspace="3" vspace="0" style="margin-bottom: 18px; cursor: pointer" onMouseOut="hideStats()" onMouseOver="viewStats()">





</div>


<table width="100%" border="0" class="verifytable" cellpadding="0" cellspacing="0" id="verifytable">
<thead>
	<tr>
		<th>&nbsp;</th>
		<th>Name</th>
		<th>Telephone</th>
		<th>Mobile</th>
		<th>&nbsp;</th>
		<th>Staff Member</th>
		<th>Data File</th>
		<th>Actions</th>
	</tr>
</thead>
	
<tbody>
	{foreach from=$data item=item}
		<tr bgcolor="{cycle values="#ebebeb,white"}"{if $item.supplier eq 2} class="important-callback"{/if}>
			<TD valign="center" align="left" width="225" style="color:gray;"><div style="float: right; text-align: right; width: 100px">
			{if $item.supplier eq 2}<b style="line-height: 12px; font-size: 9px; ">Callback Requested<br />{$item.callback|date_format:"%H:%M - %d/%m/%y"}</b>{/if}{if $item.supplier eq 4}<b style="line-height: 12px; font-size: 9px; ">Left a Message<br />{$item.timestamp|date_format:"%H:%M - %d/%m/%y"}</b>{/if}{if $item.supplier eq 3}<b style="line-height: 12px; font-size: 9px; ">No Answer<br />{$item.timestamp|date_format:"%H:%M - %d/%m/%y"}</b>{/if}</div>
			
			<div style="cursor: default;">		
				<a href="/ajax/viewclaimantdetails/id/{$item.assignedID}/" class="claimant_details" target="_new">
				
					{if $item.bit & 1}<img src="/skins/cash/images/mornon.png" title="Claimant was called in the Morning" border="0" height="18">{else}<img src="/skins/cash/images/mornoff.png" title="Claimant has not been called in the Morning" border="0" height="18">{/if}{if $item.bit & 2}<img src="/skins/cash/images/afton.png" title="Claimant was called in the Afternoon" border="0" height="18">{else}<img src="/skins/cash/images/aftoff.png" title="Claimant has not been called in the Afternoon" border="0" height="18">{/if}{if $item.bit & 4}<img src="/skins/cash/images/nigon.png" title="Claimant was called in the Night" border="0" height="18">{else}<img src="/skins/cash/images/nigoff.png" title="Claimant has not been called in the Night" border="0" height="18">{/if}
					
					{if $item.bit & 8}<img src="/skins/cash/images/mornon.png" title="Claimant was called in the Morning" border="0" height="18">{else}<img src="/skins/cash/images/mornoff.png" title="Claimant was called in the Morning" border="0" height="18">{/if}{if $item.bit & 16}<img src="/skins/cash/images/afton.png" title="Claimant was called in the Morning" border="0" height="18">{else}<img src="/skins/cash/images/aftoff.png" title="Claimant was called in the Morning" border="0" height="18">{/if}{if $item.bit & 32}<img src="/skins/cash/images/nigon.png" title="Claimant was called in the Morning" border="0" height="18">{else}<img src="/skins/cash/images/nigoff.png" title="Claimant was called in the Morning" border="0" height="18">{/if}
					
				</a>
			</div>
			</td>
			<TD valign="center" align="center">{$item.forename} {$item.surname} {$item.possibleduplicate}</td>
			<TD valign="center" width="100" align="center"><a href="javascript:voip_makeCall('{$item.forename} {$item.surname}', '{$item.telephone|replace:' ':''}', {$item.assignedID});">{$item.telephone}</a> {if $item.telephone}<font color="#AAAAAA" size="1" style="font-size: 9px;"></font>{/if}</td>
			<TD valign="center" width="100" align="center"><a href="javascript:voip_makeCall('{$item.forename} {$item.surname}', '{$item.mobile|replace:' ':''}', {$item.assignedID});">{$item.mobile}</a> {if $item.mobile}<font color="#AAAAAA" size="1" style="font-size: 9px;"></font>{/if}</td>
			<td width="16">
			
			{if $item.mobile neq ' ' &&  $item.mobile neq '' && $item.texted neq 'TRUE' }			
			<img src="{$ImageUrl}smsoff.png" border="0" title="Send SMS to this Client" id="sms{$item.assignedID}" width="18" style="cursor: hand;" onClick="claimant_sms('{$item.assignedID}')">
			{/if}
			</td>
			<TD valign="center" width="130" align="center">{$item.handlerName}</td>
			<TD valign="center" width="150" align="center"><a href="/claimants/stats/id/data:{$item.dataFileID}/" target="_new">{$item.dataFileName}</a></td>
			<TD valign="center" width="120" align="center">
			
			<a href="javascript:;" onClick="claimant_accept('{$item.assignedID}', '{$item.forename} {$item.surname}')"><img src="{$ImageUrl}acceptsm.png" border="0" title="Client IS claiming"></a> 
			<a href="javascript:;" onClick="claimant_decline('{$item.assignedID}', '{$item.forename} {$item.surname}')"><img src="{$ImageUrl}declinesm.png" border="0" title="Client is NOT claiming"></a> 
			<a href="javascript:;" onClick="claimant_callback('{$item.assignedID}', '{$item.forename} {$item.surname}')"><img src="{$ImageUrl}callback.png" border="0" title="Client Needs a Callback"></a> 
			<a href="javascript:;" onClick="claimant_noanswer('{$item.assignedID}', '{$item.forename} {$item.surname}')"><img src="{$ImageUrl}noanswer.png" border="0" title="Client has not answered"></a>
			<a href="javascript:;" onClick="claimant_duplicate('{$item.assignedID}', '{$item.forename} {$item.surname}')"><img src="{$ImageUrl}deletesm.png" border="0" title="Client is a duplicate"></a>
			</td>
		</tr>
	{/foreach}


</tbody>

</table>