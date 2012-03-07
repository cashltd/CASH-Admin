<script>
	var cal = new CalendarPopup("test");
	cal.setCssPrefix("TEST");
</script>
<b><center>To view stats for a user please choose the user and a date range from the boxes below</center></b><br /><br />

<form method="post" NAME="apoint" style="font-size: 10px; font-family: verdana;">


	<div class="addusermiddle">
		<div class="adduseritem"><div class="b">Choose User</div>
		

			<SELECT name="user">			
					<OPTION VALUE="0">All Users</OPTION>
				{foreach from=$suppliers item=item}
					<OPTION VALUE="{$item.id}">{$item.fname} {$item.sname}</OPTION>
				{/foreach}
			</SELECT>
		
		</div>
		<div class="addusercalitem"><img src="{$ImageUrl}cal.png" border="0" title="Choose Start Date" onClick="cal.select(document.forms['apoint'].start,'start','yyyy-MM-dd 09:00:00'); return false;" style="cursor: pointer; float: right;"><div class="b">Start Date</div><input type="text" name="start" id="start"></div>
		<div class="addusercalitem"><img src="{$ImageUrl}cal.png" border="0" title="Choose End Date" onClick="cal.select(document.forms['apoint'].end,'end','yyyy-MM-dd 20:30:00'); return false;" style="cursor: pointer; float: right;"><div class="b">End Date</div><input type="text" name="end" id="end"></div>
		
		
	<p><div class="loginitem2"><input type='submit' value='View Stats' class="login" /></div></p>
	
		
	</div>
	
</form>	

<DIV ID="test" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
