<table width="100%" border="0" class="verifytable" cellpadding="0" cellspacing="0">
	<tr>
		<th>Time</th>
		<th>Title</th>
		<th>Seller</th>
		<th>Actions</th>
	</tr>
	
	
	
	{foreach from=$items item=item}
		<tr>
			<TD valign="center" width="200" align="center">{$item.startdate|date_format:"%d/%m/%y - %R"}</td>
			<TD valign="center">{$item.title}</td>
			<td valign="center" align="center">{$item.solicitor}</td>
			<TD valign="center" width="200" align="center">
			{if $item.twitter eq '0'}

			<a href="javascript:;" onClick="goTwitter('{$item.iid}')"><span class="temphold"><img id="tweetload{$item.iid}" src="{$ImageUrl}twit.png" border="0" title="Submit claim to Twitter"></span></a>
			
			{/if}			{if $item.twitter eq '1'}

			<img src="{$ImageUrl}twit2.png" border="0">
			
			{/if}
			{if $item.emailsent eq '0'}

			<a href="javascript:;" onClick="goMail('{$item.iid}')"><span class="temphold"><img id="mailload{$item.iid}" src="{$ImageUrl}mail.png" border="0" title="Send E-Mail to solicitors"></span></a>
			
			{/if}
			{if $item.emailsent eq '1'}

			<img src="{$ImageUrl}mail2.png" border="0">
			
			{/if}</td>
		</tr>
	{/foreach}




</table>