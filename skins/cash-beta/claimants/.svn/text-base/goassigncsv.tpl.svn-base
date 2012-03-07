<form id='addHotkeyForm' method='post' action='{$HomeUrl}claimants/AssignCSVDone/'><div class='nowarning'>

	<div class="addusermiddle">


		<div class="adduseritem"><div class="b">CSV File</div>
		
			<SELECT name="csv">
				{foreach from=$csvs item=item}
					<OPTION VALUE="{$item.id}">{$item.filename} ({$item.timestamp|date_format:"%d/%m/%y"})</OPTION>
				{/foreach}
			</SELECT>
			
		</div>




		<div class="adduseritem"><div class="b">Staff Member</div>
		
			<SELECT name="staff">
				{foreach from=$staff item=item}
					<OPTION VALUE="{$item.id}">{$item.fname} {$item.sname}</OPTION>
				{/foreach}
			</SELECT>
			
		</div>

	</div>




<p><div class="loginitem2"><input type='Submit' value='Assign CSV' class="login" /></div></p></div></form>