<table width="100%">

<tr>
	<th>Banner</th>
	<th>Clicks</th>
	<th>Code</th>
</tr>

{foreach from=$banners item=banner}
	<tr>
		<td><center><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="{$banner.width}" height="{$banner.height}" id="cashban" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="allowFullScreen" value="false" />
		<param name="movie" value="http://banner.cash-ltd.co.uk/{$banner.banner}" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="http://banner.cash-ltd.co.uk/{$banner.banner}" quality="high" bgcolor="#ffffff" width="{$banner.width}" height="{$banner.height}" name="cashban" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
		</object></center></td>
		<td><center>{$banner.clicks}</center></td>
		<td><center><textarea cols=100 rows=10>
		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="{$banner.width}" height="{$banner.height}" id="cashban" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="allowFullScreen" value="false" />
		<param name="movie" value="http://banner.cash-ltd.co.uk/{$banner.banner}" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="http://banner.cash-ltd.co.uk/{$banner.banner}" quality="high" bgcolor="#ffffff" width="{$banner.width}" height="{$banner.height}" name="cashban" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
		</object>
		</textarea>
		</center></td>
	</tr>
{/foreach}


</table>