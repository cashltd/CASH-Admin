<div>
<a href="{$HomeUrl}users/weblogs/id/{if $ip eq 'All Computers'}*{else}{$ip}{/if}:{if $for eq 'All Dates'}*{else}{$for}{/if}/">&lt; Go Back</a>

<h2>Logs from <a href="http://{$domain}" target="_NewWindow">{$domain}</a> for {$ip} on {$for}</h2>

<b><a href="http://admin.cash-ltd.co.uk/users/whitelisturl/id/{$domain}/">Whitelist Address</a></b><br /><br />


<table cellpadding="5">
<tr>
	<th>Date</th>
	<th>Time</th>
	<th align="left">IP Address</th>
	<th align="left">Web Site</th>
	<th align="left">Preview</th>
</tr>

{foreach from=$urls item=url}

<tr bgcolor="{cycle values="#ebebeb,white"}">
<td valign="top">
{$url.timestamp|date_format:"%d/%m/%Y"} </td>
<td valign="top">
{$url.timestamp|date_format:"%H:%M.%S"} </td><td valign="top"> {$url.src_ip} </td><td valign="top"> <a href="{$url.req_uri}" target="_NewWindow">{$url.req_uri|truncate:150:"..."}</a>
</td>
<td valign="top">
{if $url.mime_type eq 'image/gif' OR $url.mime_type eq 'image/jpeg' OR $url.mime_type eq 'image/png' }
<!-- <img src="{$url.req_uri}" height="20" onmouseover="this.height='150'" onmouseout="this.height='20'"> -->
{/if}

</td>
</tr>

{/foreach}

</table>

<p><a href="#top">TOP</a></p>
</div>