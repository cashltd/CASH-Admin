<?php /* Smarty version 2.6.14, created on 2012-03-05 17:31:58
         compiled from legalbid/queueVerify.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'legalbid/queueVerify.tpl', 13, false),)), $this); ?>
<table width="100%" border="0" class="verifytable" cellpadding="0" cellspacing="0">
	<tr>
		<th>Time</th>
		<th>Title</th>
		<th>Seller</th>
		<th>Actions</th>
	</tr>
	
	
	
	<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<tr>
			<TD valign="center" width="200" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['startdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y - %R") : smarty_modifier_date_format($_tmp, "%d/%m/%y - %R")); ?>
</td>
			<TD valign="center"><?php echo $this->_tpl_vars['item']['title']; ?>
</td>
			<td valign="center" align="center"><?php echo $this->_tpl_vars['item']['solicitor']; ?>
</td>
			<TD valign="center" width="200" align="center">
			<?php if ($this->_tpl_vars['item']['twitter'] == '0'): ?>

			<a href="javascript:;" onClick="goTwitter('<?php echo $this->_tpl_vars['item']['iid']; ?>
')"><span class="temphold"><img id="tweetload<?php echo $this->_tpl_vars['item']['iid']; ?>
" src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
twit.png" border="0" title="Submit claim to Twitter"></span></a>
			
			<?php endif; ?>			<?php if ($this->_tpl_vars['item']['twitter'] == '1'): ?>

			<img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
twit2.png" border="0">
			
			<?php endif; ?>
			<?php if ($this->_tpl_vars['item']['emailsent'] == '0'): ?>

			<a href="javascript:;" onClick="goMail('<?php echo $this->_tpl_vars['item']['iid']; ?>
')"><span class="temphold"><img id="mailload<?php echo $this->_tpl_vars['item']['iid']; ?>
" src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
mail.png" border="0" title="Send E-Mail to solicitors"></span></a>
			
			<?php endif; ?>
			<?php if ($this->_tpl_vars['item']['emailsent'] == '1'): ?>

			<img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
mail2.png" border="0">
			
			<?php endif; ?></td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>




</table>