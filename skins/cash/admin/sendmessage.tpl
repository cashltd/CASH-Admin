<form id='addHotkeyForm' method='post' action='{$HomeUrl}admin/sendnow/'><div class='nowarning'>

	<div class="addusermiddle">
	
		<div class="adduseritem"><div class="b">To</div>
		
			<SELECT name="staff">
					<OPTION VALUE="0">All Staff</OPTION>
				{foreach from=$staff item=item}
					<OPTION VALUE="{$item.id}">{$item.fname} {$item.sname}</OPTION>
				{/foreach}
			</SELECT>
			
		</div>

		<div class="adduseritem"><div class="b">Title</div><input type="text" name="title"></div>
		<div class="adduseritem"><div class="a">Message</div><textarea name="message"></textarea></div>
		<div>
		
		<div class="adduseritem"><div class="b">Show popup alert?</div><input type="checkbox" name="alert" class="checkbox"></div>
		
		</div>
		
		
		</div>

<p><div class="loginitem2"><input type='Submit' value='Send Message' class="login" /></div></p></div></form>
