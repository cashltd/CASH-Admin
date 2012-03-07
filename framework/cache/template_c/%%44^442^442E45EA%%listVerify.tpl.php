<?php /* Smarty version 2.6.14, created on 2012-03-05 17:31:58
         compiled from legalbid/listVerify.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'legalbid/listVerify.tpl', 16, false),array('modifier', 'truncate', 'legalbid/listVerify.tpl', 18, false),)), $this); ?>
<table width="100%" border="0" class="verifytable" cellpadding="0" cellspacing="0">
	<tr>
		<th>Time</th>
		<th>Item Name</th>
		<th>Description</th>
		<th>Start Price</th>
		<th>Seller</th>
		<th>Doc</th>
		<th>Actions</th>
	</tr>
	
	
	
	<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<tr>
		<TD valign="top" width="80" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['startdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y<br />%R") : smarty_modifier_date_format($_tmp, "%d/%m/%y<br />%R")); ?>
</td>
			<TD valign="top" width="200"><?php echo $this->_tpl_vars['item']['title']; ?>
</td>
			<td valign="top" width="400"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['desc'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 200, "") : smarty_modifier_truncate($_tmp, 200, "")); ?>
<b title="<?php echo $this->_tpl_vars['item']['desc']; ?>
">...</b></td>
			<td valign="top" align="center">&pound;<?php echo $this->_tpl_vars['item']['start']; ?>
</td>
			<td valign="top" align="center"><?php echo $this->_tpl_vars['item']['solicitor']; ?>
</td>
			<td valign="top" align="center"><a href="http://legalbid.co.uk/otherclaims/<?php echo $this->_tpl_vars['item']['doc']; ?>
">View</a></td>
			<td valign="top" align="center">
			
			<a href="javascript:;" onClick="verifyClaim('<?php echo $this->_tpl_vars['item']['iid']; ?>
', '<?php echo $this->_tpl_vars['item']['title']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
accept.png" border="0" title="Accept this claim"></a> <a href="javascript:;" onClick="declineClaim('<?php echo $this->_tpl_vars['item']['iid']; ?>
', '<?php echo $this->_tpl_vars['item']['title']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
decline.png" border="0" title="Decline this claim"></a>
	
			</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>




</table> 