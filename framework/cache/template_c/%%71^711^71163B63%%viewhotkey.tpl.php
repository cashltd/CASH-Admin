<?php /* Smarty version 2.6.14, created on 2012-02-24 15:35:40
         compiled from datasuppliers/viewhotkey.tpl */ ?>
<div class='nowarning'>

	<div class="addusermiddle">
		<div class="adduseritem"><div class="b">First Name</div><div class="c"><?php echo $this->_tpl_vars['items']['fname']; ?>
</div></div>
		<div class="adduseritem"><div class="b">Last Name</div><div class="c"><?php echo $this->_tpl_vars['items']['sname']; ?>
</div></div>
		<div class="adduseritem"><div class="b">Telephone</div><div class="c"><?php echo $this->_tpl_vars['items']['tel']; ?>
</div></div>
		<div class="adduseritem"><div class="b">Claim Type</div><div class="c"><?php echo $this->_tpl_vars['items']['ctype']; ?>
</div></div>
		
		<br /><BR />
		
		<div class="adduseritem"><div class="b">Supplier</div><div class="c"><?php echo $this->_tpl_vars['supplier']['name']; ?>
</div></div>
		
		<div class="adduseritem"><div class="b">Operator</div><div class="c"><?php echo $this->_tpl_vars['items']['dealer']; ?>
</div></div>
		<div class="adduseritem"><div class="b">Staff Member</div><div class="c"><?php echo $this->_tpl_vars['user']['fname']; ?>
 <?php echo $this->_tpl_vars['user']['sname']; ?>
</div></div>
		
		<div class="adduseritem"><div class="q">Comment</div>
		<div class="r">
		<?php echo $this->_tpl_vars['items']['comment']; ?>

		</div></div>

	</div>

<p><div class="loginitem2"><input type='button' value='Close' class="login" onclick='Modalbox.hide()' /></div></p></div>