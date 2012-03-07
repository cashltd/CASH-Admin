<div id="modalDisplay">
	
	<div class="column_left">
		<div class="header"><span>Claimant Details</span>
			<div class="extras">
				<a href="javascript:;" onClick="claimant_accept('{$details.assignedID}', '{$details.forename} {$details.surname}')"><img src="{$ImageUrl}acceptsm.png" border="0" title="Client IS claiming"></a> 
				<a href="javascript:;" onClick="claimant_decline('{$details.assignedID}', '{$details.forename} {$details.surname}')"><img src="{$ImageUrl}declinesm.png" border="0" title="Client is NOT claiming"></a> 
				<a href="javascript:;" onClick="claimant_callback('{$details.assignedID}', '{$details.forename} {$details.surname}')"><img src="{$ImageUrl}callback.png" border="0" title="Client Needs a Callback"></a>
				<a href="javascript:;" onClick="claimant_noanswer('{$details.assignedID}', '{$details.forename} {$details.surname}')"><img src="{$ImageUrl}noanswer.png" border="0" title="Client has not answered"></a>
				<a href="javascript:;" onClick="claimant_duplicate('{$details.assignedID}', '{$details.forename} {$details.surname}')"><img src="{$ImageUrl}deletesm.png" border="0" title="Client is a duplicate"></a>
			</div>
		</div>
		
		<div class="content">
			<table cellpadding="0" cellspacing="0">
			
				<tr>
					<th>Name : </th>
					<td>{$details.title} {$details.forename} {$details.surname}</td>
				</tr>
				<tr>
					<th>Address 1 : </th>
					<td>{$details.address1}</td>
				</tr>
				<tr>
					<th>Address 2 : </th>
					<td>{$details.address2}</td>
				</tr>
				<tr>
					<th>Address 3 : </th>
					<td>{$details.address3}</td>
				</tr>
				<tr>
					<th>Town : </th>
					<td>{$details.town}</td>
				</tr>
				<tr>
					<th>County : </th>
					<td>{$details.county}</td>
				</tr>
				<tr>
					<th>Postcode : </th>
					<td>{$details.postcode}</td>
				</tr>
				<tr>
					<th>Telephone : </th>
					<td>{$details.telephone}</td>
				</tr>
				<tr>
					<th>Mobile : </th>
					<td>{$details.mobile}</td>
				</tr>
			
			</table>
		</div>
	
	</div>
	
	
	<div class="column_right">
		<div class="header"><span>Claimant Location</span></div>
	
		<div class="content">
			<div id="map_canvas" style="width:100%; height:275px; border: #CCC 1px solid; -moz-box-shadow: 2px 2px 3px #888; -webkit-box-shadow: 2px 2px 3px #888; box-shadow: 2px 2px 3px #888;"></div>
		
			<script type="text/javascript">
	    
	    		mapFunction = function() {literal}{{/literal}
	    
			     	var latlng = new google.maps.LatLng({$details.long}, {$details.lat});
			     
			        var myOptions = {literal}{{/literal}
			          center: latlng,
			          zoom: 14,
			          mapTypeId: google.maps.MapTypeId.ROADMAP
			        {literal}}{/literal};
			        
			        var marker = new google.maps.Marker({literal}{{/literal}
					    position: latlng,
					{literal}}{/literal});
					
			        var map = new google.maps.Map(document.getElementById("map_canvas"),
			            myOptions);
			            
			        marker.setMap(map);
	      		{literal}}{/literal}
	      		
	      		mapFunction();
	      		
	    </script>
		</div>
	
	</div>
	
	<br style="clear: both;" /><br style="clear: both;" />
	
	
	<div class="column_left">
		<div class="header"><span>Outgoing Calls</span></div>
		
		<div class="content">
			<ul>
				{foreach from=$details.callLog.outgoing item=item}
				<li style="line-height: 35px;"><strong>{$item.calldate|date_format:"%d/%m/%y"} @ {$item.calldate|date_format:"%H:%M"}: </strong>{$item.username.fname} {$item.username.sname} ({$item.username.extension}) - {$item.duration}s <audio controls="controls" style="float: right; width: 100px;"><source src="{$item.recordLink}" type="audio/wav"></audio></li>
				{/foreach}
			</ul>
		</div>
	
	</div>
	
	<div class="column_right">
		<div class="header"><span>Incoming Calls</span></div>
		
		<div class="content">
			<ul>
			{foreach from=$details.callLog.incoming item=item}
				<li style="line-height: 35px;"><strong>{$item.calldate|date_format:"%d/%m/%y"} @ {$item.calldate|date_format:"%H:%M"}: </strong>{$item.username.fname} {$item.username.sname} ({$item.username.extension}) - {$item.duration}s <audio controls="controls" style="float: right; width: 100px;"><source src="{$item.recordLink}" type="audio/wav"></audio></li>
			{/foreach}
			</ul>
		</div>
	
	</div>
	<br style="clear: both;" /><br style="clear: both;" />
	
	<div class="column_left">
		<div class="header"><span>Sent Text Messages</span></div>
		
		<div class="content">
			<ul>
				{foreach from=$details.textLog item=item}
				<li style="line-height: 35px;"><strong>{$item.timestamp|date_format:"%d/%m/%y"} @ {$item.timestamp|date_format:"%H:%M"} </strong></li>
				{/foreach}
			</ul>
		</div>
	
	</div>
	
	<br style="clear: both;" />
</div>