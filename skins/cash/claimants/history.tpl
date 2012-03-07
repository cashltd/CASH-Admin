
<ul id="historyul">

	<li>Outgoing Calls
		<ul style="margin-left: 5px; padding-left: 10px; list-style: none;">
			{foreach from=$data.callLog.outgoing item=item}
			<li style="line-height: 35px;"><strong>{$item.calldate|date_format:"%d/%m/%y"} @ {$item.calldate|date_format:"%H:%M"}: </strong>{$item.username.fname} {$item.username.sname} ({$item.username.extension}) - {$item.duration}s <audio controls="controls" style="float: right; width: 100px;"><source src="{$item.recordLink}" type="audio/wav"></audio></li>

			{/foreach}
		</ul>
	</li>
	
	<li>Incoming Calls
		<ul style="margin-left: 5px; padding-left: 10px; list-style: none;">
			{foreach from=$data.callLog.incoming item=item}
			<li style="line-height: 35px;"><strong>{$item.calldate|date_format:"%d/%m/%y"} @ {$item.calldate|date_format:"%H:%M"}: </strong>{$item.username.fname} {$item.username.sname} ({$item.username.extension}) - {$item.duration}s <audio controls="controls" style="float: right; width: 100px;"><source src="{$item.recordLink}" type="audio/wav"></audio></li>
			{/foreach}
		</ul>
	</li>
	
	<li>Text Messages
		<ul style="margin-left: 5px; padding-left: 10px; list-style: none;">
			{foreach from=$data.textLog item=item}
			<li style="line-height: 35px;"><strong>{$item.timestamp|date_format:"%d/%m/%y"} @ {$item.timestamp|date_format:"%H:%M"} </strong></li>
			{/foreach}
		</ul>
	</li>

</ul>

