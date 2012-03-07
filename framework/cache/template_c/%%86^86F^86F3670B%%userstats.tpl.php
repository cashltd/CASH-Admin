<?php /* Smarty version 2.6.14, created on 2012-03-06 17:32:37
         compiled from admin/userstats.tpl */ ?>
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
				<?php $_from = $this->_tpl_vars['suppliers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<OPTION VALUE="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['fname']; ?>
 <?php echo $this->_tpl_vars['item']['sname']; ?>
</OPTION>
				<?php endforeach; endif; unset($_from); ?>
			</SELECT>
		
		</div>
		<div class="addusercalitem"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
cal.png" border="0" title="Choose Start Date" onClick="cal.select(document.forms['apoint'].start,'start','yyyy-MM-dd 09:00:00'); return false;" style="cursor: pointer; float: right;"><div class="b">Start Date</div><input type="text" name="start" id="start"></div>
		<div class="addusercalitem"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
cal.png" border="0" title="Choose End Date" onClick="cal.select(document.forms['apoint'].end,'end','yyyy-MM-dd 20:30:00'); return false;" style="cursor: pointer; float: right;"><div class="b">End Date</div><input type="text" name="end" id="end"></div>
		
		
	<p><div class="loginitem2"><input type='submit' value='View Stats' class="login" /></div></p>
	
		
	</div>
	
</form>	

<DIV ID="test" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>