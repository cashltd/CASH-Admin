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
			<TD valign="center" width="80" align="center">
			
			<a href="javascript:;" onClick="freshdata_confirmHotkey('{$item.id}', '{$item.fname} {$item.sname}')"><img src="{$ImageUrl}acceptsm.png" border="0" title="Hotkey IS claiming"></a> <a href="javascript:;" onClick="freshdata_declineHotkey('{$item.id}', '{$item.fname} {$item.sname}')"><img src="{$ImageUrl}declinesm.png" border="0" title="Hotkey is NOT claiming"></a> <a href="javascript:;" onClick="freshdata_removeHotkey('{$item.id}', '{$item.fname} {$item.sname}')"><img src="{$ImageUrl}deletesm.png" border="0" title="Mark Hotkey for deletion"></a>
	
			</td>
		</tr>
	{/foreach}


	
	
	{foreach from=$datas item=item}
		<tr bgcolor="{cycle values="white,#ebebeb"}" style="color:silver">
			<TD valign="center" align="center"><s>{$item.fname} {$item.sname}</s></td>
			<TD valign="center" width="190" align="center"><s>{$item.tel}</s></td>
			<td valign="center" width="120" align="center"><s>{$item.timestamp|date_format:"%d/%m/%y - %R"}</s></td>
			<TD valign="center" width="150" align="center"><s>{$item.dealer}</s></td>
			<TD valign="center" width="50" align="center"><s>{$item.ctype}</s></td>
			<TD valign="center" width="150" align="center"><s>{$item.userid}</s></td>
			<TD valign="center" width="80" align="center">
			<a href="javascript:;" onClick="viewHotkey('{$item.id}')"><img src="{$ImageUrl}viewsm.png" border="0" title="View Hotkey Data"></a> <a href="javascript:;" onClick="freshdata_recoverHotkey('{$item.id}', '{$item.fname} {$item.sname}')"><img src="{$ImageUrl}recoversm.png" border="0" title="Recover this Hotkey"></a>
	
			</td>
		</tr>
	{/foreach}
	


</table>