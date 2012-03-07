<form id='addHotkeyForm' method='post' action='{$HomeUrl}ajax/datasuppliers_goSubmitAddHotkey/'><div class='nowarning'>

	<div class="addusermiddle">
		<div class="adduseritem"><div class="b">First Name</div><input type="text" name="fname"></div>
		<div class="adduseritem"><div class="b">Last Name</div><input type="text" name="sname"></div>
		<div class="adduseritem"><div class="b">Telephone</div><input type="text" name="tel"></div>
		<div class="adduseritem"><div class="b">Claim Type</div>
		
			<SELECT name="ctype">
				<OPTION VALUE="RTA">RTA</OPTION>
				<OPTION VALUE="Assault">Assault</OPTION>
				<OPTION VALUE="PL">PL</OPTION>
				<OPTION VALUE="MN">MN</OPTION>
				<OPTION VALUE="EL">EL</OPTION>
			</SELECT>
		
		</div>
		
		<br /><BR />
		
		<div class="adduseritem"><div class="b">Supplier</div>
		
			<SELECT name="supplier">
				{foreach from=$suppliers item=item}
					<OPTION VALUE="{$item.id}">{$item.name}</OPTION>
				{/foreach}
			</SELECT>
			
		</div>
		
		<div class="adduseritem"><div class="b">Operator</div><input type="text" name="operator"></div>
		<div class="adduseritem"><div class="b">Staff Member</div>
		
			<SELECT name="staff">
				{foreach from=$staff item=item}
					<OPTION VALUE="{$item.id}">{$item.fname} {$item.sname}</OPTION>
				{/foreach}
			</SELECT>
			
		</div>

	</div>

<p><div class="loginitem2"><input type='Button' value='Add Hotkey' class="login" onclick='submit_addNewHotkey()' /> <input type='button' value='Cancel' class="login" onclick='Modalbox.hide()' /></div></p></div></form>
