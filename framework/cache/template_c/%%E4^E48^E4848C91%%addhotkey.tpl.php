<?php /* Smarty version 2.6.14, created on 2012-02-15 11:40:51
         compiled from datasuppliers/addhotkey.tpl */ ?>
<form id='addHotkeyForm' method='post' action='<?php echo $this->_tpl_vars['HomeUrl']; ?>
ajax/datasuppliers_goSubmitAddHotkey/'><div class='nowarning'>

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
				<?php $_from = $this->_tpl_vars['suppliers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<OPTION VALUE="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</OPTION>
				<?php endforeach; endif; unset($_from); ?>
			</SELECT>
			
		</div>
		
		<div class="adduseritem"><div class="b">Operator</div><input type="text" name="operator"></div>
		<div class="adduseritem"><div class="b">Staff Member</div>
		
			<SELECT name="staff">
				<?php $_from = $this->_tpl_vars['staff']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<OPTION VALUE="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['fname']; ?>
 <?php echo $this->_tpl_vars['item']['sname']; ?>
</OPTION>
				<?php endforeach; endif; unset($_from); ?>
			</SELECT>
			
		</div>

	</div>

<p><div class="loginitem2"><input type='Button' value='Add Hotkey' class="login" onclick='submit_addNewHotkey()' /> <input type='button' value='Cancel' class="login" onclick='Modalbox.hide()' /></div></p></div></form>