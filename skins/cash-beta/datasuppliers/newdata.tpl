<table width="100%" border="0" class="verifytable" cellpadding="0" cellspacing="0">
	<tr>
		<th>Name</th>
		<th>Telephone</th>
		<th>Time / Date</th>
		<th>Operator</th>
		<th>Type</th>
		<th>Staff Member</th>
		<th>Actions</th>
	</tr>
	
	
	
	{foreach from=$data item=item}
		<tr bgcolor="{cycle values="white,#ebebeb"}">
			<TD valign="center" align="center">{$item.fname} {$item.sname}</td>
			<TD valign="center" width="190" align="center"><a href="javascript:voip_makeCall('{$item.fname} {$item.sname}', '{$item.tel|replace:' ':''}');">{$item.tel}</a></td>
			<td valign="center" width="120" align="center">{$item.timestamp|date_format:"%d/%m/%y - %R"}</td>
			<TD valign="center" width="150" align="center">{$item.dealer}</td>
			<TD valign="center" width="50" align="center">{$item.ctype}</td>
			<TD valign="center" width="150" align="center">{$item.userid}</td>
			<TD valign="center" width="80" align="center"><a href="javascript:;" onClick="viewHotkey('{$item.id}')"><img src="{$ImageUrl}viewsm.png" border="0" title="View Hotkey Data"></a></td>
		</tr>
	{/foreach}


	<tr>
		<th align="left">&nbsp;{if $shprev eq '1'}<a href="javascript:;" onClick="acceptchange('p')">< Previous Page</a>{/if}</th>
		<th colspan="5" align="left">Currently on Page {$pagenumber}</th>
		<th align="right"><a href="javascript:;" onClick="acceptchange('n')">Next Page ></a>&nbsp;</th>
	</tr>

</table>