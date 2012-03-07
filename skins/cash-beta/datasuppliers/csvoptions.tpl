<script>
	var cal = new CalendarPopup("test");
	cal.setCssPrefix("TEST");
</script>
<b><center>To download a CSV file of the accepted and rejected Hotkey Data please select the data supplier and a date range below then click the 'download' button.</center></b><br /><br />

<form action="{$HomeUrl}ajax/datasuppliers_downloadCSV/" method="post" NAME="apoint" style="font-size: 10px; font-family: verdana;">


	<div class="addusermiddle">
		<div class="adduseritem"><div class="b">Data Supplier</div>
		

			<SELECT name="supplier">			
					<OPTION VALUE="0">All Suppliers</OPTION>
				{foreach from=$suppliers item=item}
					<OPTION VALUE="{$item.id}">{$item.name}</OPTION>
				{/foreach}
			</SELECT>
		
		</div>
		<div class="addusercalitem"><img src="{$ImageUrl}cal.png" border="0" title="Choose Start Date" onClick="cal.select(document.forms['apoint'].start,'start','yyyy-MM-dd'); return false;" style="cursor: pointer; float: right;"><div class="b">Start Date</div><input type="text" name="start" id="start" READONLY></div>
		<div class="addusercalitem"><img src="{$ImageUrl}cal.png" border="0" title="Choose End Date" onClick="cal.select(document.forms['apoint'].end,'end','yyyy-MM-dd'); return false;" style="cursor: pointer; float: right;"><div class="b">End Date</div><input type="text" name="end" id="end" READONLY></div>
		
		
	<p><div class="loginitem2"><input type='submit' value='Download' class="login" /></div></p>
	
		
	</div>
	
</form>	

<DIV ID="test" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
