<table width="100%" border="0" class="verifytable" cellpadding="0" cellspacing="0">
	<tr>
		<th>&nbsp;</th>
		<th>Forename</th>
		<th>Surname</th>
		<th>Solicitor Name</th>
		<th>Area</th>
		<th>Telephone</th>
		<th>&nbsp;</th>
	</tr>
	
	
	
	{foreach from=$sols item=item}
		<tr bgcolor="{cycle values="white,#ebebeb"}">
			<TD valign="center" width="14%" align="center">status</td>
			<TD valign="center" width="14%" align="center">{$item.first}</td>
			<TD valign="center" width="14%" align="center">{$item.last}</td>
			<td valign="center" width="14%" align="center">{$item.solname}</td>
			<TD valign="center" width="14%" align="center">{$item.area}</td>
			<TD valign="center" width="14%" align="center">{$item.telephone}</td>
			<TD valign="center" align="center"><a href="javascript:;" onClick="viewHotkey('{$item.id}')"><img src="{$ImageUrl}viewsm.png" border="0" title="View Hotkey Data"></a></td>
		</tr>
	{/foreach}


	<tr>
		<th align="left">&nbsp;{if $shprev eq '1'}<a href="javascript:;" onClick="acceptchange('p')">< Previous Page</a>{/if}</th>
		<th colspan="5" align="left">Currently on Page {$pagenumber}</th>
		<th align="right"><a href="javascript:;" onClick="acceptchange('n')">Next Page ></a>&nbsp;</th>
	</tr>

</table>