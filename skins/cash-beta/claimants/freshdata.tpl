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
		<tr bgcolor="{cycle values="#ebebeb,white"}">
			<TD valign="center" align="left" width="225" style="color:gray;">
			<div style="float: right; text-align: right; width: 100px">{if $item.supplier eq 2}<b style="line-height: 12px; font-size: 9px; ">Callback Requested</b>{/if}{if $item.supplier eq 4}<b style="line-height: 12px; font-size: 9px; ">Left a Message<br />{$item.lastcall|date_format:"%H:%M - %d/%m/%y"}</b>{/if}{if $item.supplier eq 3}<b style="line-height: 12px; font-size: 9px; ">No Answer<br />{$item.lastcall|date_format:"%H:%M - %d/%m/%y"}</b>{/if}</div><div style="cursor: default;"><a href="javascript:;" onClick="claimant_history('{$item.id}', '{$item.fname} {$item.sname}')">{$item.lastcount}</a></div>
			</td>
			<TD valign="center" align="center">{$item.fname} {$item.sname}{$item.possibleduplicate}</td>
			<TD valign="center" width="100" align="center"><a href="javascript:voip_makeCall('{$item.fname} {$item.sname}', '{$item.tel|replace:' ':''}');">{$item.tel}</a></td>
			<TD valign="center" width="100" align="center"><a href="javascript:voip_makeCall('{$item.fname} {$item.sname}', '{$item.mobile|replace:' ':''}');">{$item.mobile}</a></td>
			<td width="16">
			
			{if $item.mobile neq ' ' &&  $item.mobile neq '' && $item.texted neq 'TRUE' }			
			<img src="{$ImageUrl}smsoff.png" border="0" title="Send SMS to this Client" id="sms{$item.id}" width="18" style="cursor: hand;" onClick="claimant_sms('{$item.id}')">
			{/if}
			</td>
			<TD valign="center" width="130" align="center">{$item.userid}</td>
			<TD valign="center" width="150" align="center">{$item.csv}</td>
			<TD valign="center" width="120" align="center">
			
			<a href="javascript:;" onClick="claimant_accept('{$item.id}', '{$item.fname} {$item.sname}')"><img src="{$ImageUrl}acceptsm.png" border="0" title="Client IS claiming"></a> 
			<a href="javascript:;" onClick="claimant_decline('{$item.id}', '{$item.fname} {$item.sname}')"><img src="{$ImageUrl}declinesm.png" border="0" title="Client is NOT claiming"></a> 
			<a href="javascript:;" onClick="claimant_callback('{$item.id}', '{$item.fname} {$item.sname}')"><img src="{$ImageUrl}callback.png" border="0" title="Client Needs a Callback"></a> 
			<a href="javascript:;" onClick="claimant_noanswer('{$item.id}', '{$item.fname} {$item.sname}')"><img src="{$ImageUrl}noanswer.png" border="0" title="Client has not answered"></a>
			<a href="javascript:;" onClick="claimant_duplicate('{$item.id}', '{$item.fname} {$item.sname}')"><img src="{$ImageUrl}deletesm.png" border="0" title="Client is a duplicate"></a>
			</td>
		</tr>
	{/foreach}


	
	
	{foreach from=$datas item=item}
		<tr bgcolor="{cycle values="white,#ebebeb"}" style="color:silver">
			<TD valign="center" align="center"><s>{$item.fname} {$item.sname}</s></td>
			<TD valign="center" width="190" align="center"><s><a href="javascript:voip_makeCall('{$item.fname} {$item.sname}', '{$item.tel|replace:' ':''}');">{$item.tel}</a></s></td>

			<TD valign="center" width="150" align="center"><s>{$item.dealer}</s></td>
			<TD valign="center" width="50" align="center"><s>{$item.ctype}</s></td>
			<TD valign="center" width="150" align="center"><s>{$item.userid}</s></td>
			<TD valign="center" width="80" align="center">
			<a href="javascript:;" onClick="viewHotkey('{$item.id}')"><img src="{$ImageUrl}viewsm.png" border="0" title="View Hotkey Data"></a> 
			<a href="javascript:;" onClick="freshdata_recoverHotkey('{$item.id}', '{$item.fname} {$item.sname}')"><img src="{$ImageUrl}recoversm.png" border="0" title="Recover this Hotkey"></a>
	
			</td>
		</tr>
	{/foreach}
	
</tbody>

</table>