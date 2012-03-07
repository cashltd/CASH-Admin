
	<img src="{$HomeUrl}skins/cash/images/load.gif" style="display: none;" id="loadingIcon">
	<div style="display: block; position: relative; margin: 0; width: {$width}px; height: {$height}px; margin: auto;">

	<div class="daterange"><b>Showing: </b>{$start} to {$end}</div>

	<div class="chart"> 
	
		{foreach from=$stats item=item}
		<div class="fullbar" style="width: {$pickwidth}%;"> 
		 <div style="height: {$item.totalpercent}%; position: absolute; bottom: 0px; width: 100%;">
		  <div class="name{if $item.totalpercent gt 80}overper{/if}"><strong>{$item.name}</strong></div> 
		  <div class="spacing" style="height: {$item.remainingpercent}%"></div> 
		  <div class="claimants" style="height: {$item.claimantspercent}%" onclick="makePie('Claimant', '{$item.name}',{$item.claccepted},{$item.cldeclined},{$item.clreturned},{$item.cldormant},{$item.clcallback},{$item.clnoanswer})"><strong>{if $item.claimantsheightpix gte 13}{$item.claimants}{/if}</strong></div> 
		  <div class="hotkeys" style="height: {$item.hotkeyspercent}%" onclick="makePie('Hotkey', '{$item.name}',{$item.hkaccepted},{$item.hkdeclined},{$item.hkreturned},{$item.hkdormant},{$item.hkcallback},{$item.hknoanswer})"><strong>{if $item.hotkeysheightpix gt 13}{$item.hotkeys}{/if}</strong></div> 
		  </div>
		</div> 
		{/foreach}
			
	
	</div> 
</div>