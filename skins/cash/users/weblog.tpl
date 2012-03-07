<div>

<a href="{$HomeUrl}users/weblogs/">&lt; Go Back</a>

<h2>Logs for {$ip} on {$for}</h2>

<table cellpadding="5">
<tr>
	<th></th>
	<th align="left">Web Site</th>
</tr>

{foreach from=$urls item=url}

<tr bgcolor="{cycle values="#ebebeb,white"}">
<td><a href="{$HomeUrl}users/domain/id/{if $ip eq 'All Computers'}*{else}{$ip}{/if}:{if $for eq 'All Dates'}*{else}{$for}{/if}:{$url}/">More Details</a> </td><td> {$url}</td>
</tr>

{/foreach}

</table>

<p><a href="#top">TOP</a></p>

</div>