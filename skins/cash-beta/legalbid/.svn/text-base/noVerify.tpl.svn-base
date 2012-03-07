<table width="100%" border="0" class="verifytable" cellpadding="0" cellspacing="0">
	<tr>
		<th>Time</th>
		<th>Item Name</th>
		<th>Description</th>
		<th>Start Price</th>
		<th>Seller</th>
		<th>Doc</th>
		<th>Reason</th>
	</tr>
	
	
	
	{foreach from=$items item=item}
		<tr>
			<TD valign="top" width="80" align="center">{$item.startdate|date_format:"%d/%m/%y<br />%R"}</td>
			<TD valign="top" width="200">{$item.title}</td>
			<td valign="top" width="400">{$item.desc|truncate:200:""}<b title="{$item.desc}">...</b></td>
			<td valign="top" align="center">&pound;{$item.start}</td>
			<td valign="top" align="center">{$item.solicitor}</td>
			<td valign="top" align="center"><a href="http://legalbid.co.uk/otherclaims/{$item.doc}">View</a></td>
			<td valign="top" align="center"><b title="{$item.comment}">{$item.comment|truncate:8:""}...</b></td>
		</tr>
	{/foreach}




</table> 