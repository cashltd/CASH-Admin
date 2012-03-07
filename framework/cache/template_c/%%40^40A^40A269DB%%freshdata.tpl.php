<?php /* Smarty version 2.6.14, created on 2012-02-15 12:17:02
         compiled from datasuppliers/freshdata.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'datasuppliers/freshdata.tpl', 15, false),array('modifier', 'replace', 'datasuppliers/freshdata.tpl', 17, false),array('modifier', 'date_format', 'datasuppliers/freshdata.tpl', 18, false),)), $this); ?>
<table width="100%" border="0" class="verifytable" cellpadding="0" cellspacing="0">
	<tr>
		<th>Name</th>
		<th>Telephone</th>
		<th>Time / Date</th>
		<th>Operator</th>
		<th>Type</th>
		<th>Staff Member</th>
		<th>Actions</th>
	</tr>
	
	
	
	<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "white,#ebebeb"), $this);?>
">
			<TD valign="center" align="center"><?php echo $this->_tpl_vars['item']['fname']; ?>
 <?php echo $this->_tpl_vars['item']['sname']; ?>
</td>
			<TD valign="center" width="190" align="center"><a href="javascript:voip_makeCall('<?php echo $this->_tpl_vars['item']['fname']; ?>
 <?php echo $this->_tpl_vars['item']['sname']; ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['tel'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?>
');"><?php echo $this->_tpl_vars['item']['tel']; ?>
</a></td>
			<td valign="center" width="120" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['timestamp'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y - %R") : smarty_modifier_date_format($_tmp, "%d/%m/%y - %R")); ?>
</td>
			<TD valign="center" width="150" align="center"><?php echo $this->_tpl_vars['item']['dealer']; ?>
</td>
			<TD valign="center" width="50" align="center"><?php echo $this->_tpl_vars['item']['ctype']; ?>
</td>
			<TD valign="center" width="150" align="center"><?php echo $this->_tpl_vars['item']['userid']; ?>
</td>
			<TD valign="center" width="80" align="center">
			
			<a href="javascript:;" onClick="freshdata_confirmHotkey('<?php echo $this->_tpl_vars['item']['id']; ?>
', '<?php echo $this->_tpl_vars['item']['fname']; ?>
 <?php echo $this->_tpl_vars['item']['sname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
acceptsm.png" border="0" title="Hotkey IS claiming"></a> <a href="javascript:;" onClick="freshdata_declineHotkey('<?php echo $this->_tpl_vars['item']['id']; ?>
', '<?php echo $this->_tpl_vars['item']['fname']; ?>
 <?php echo $this->_tpl_vars['item']['sname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
declinesm.png" border="0" title="Hotkey is NOT claiming"></a> <a href="javascript:;" onClick="freshdata_removeHotkey('<?php echo $this->_tpl_vars['item']['id']; ?>
', '<?php echo $this->_tpl_vars['item']['fname']; ?>
 <?php echo $this->_tpl_vars['item']['sname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
deletesm.png" border="0" title="Mark Hotkey for deletion"></a>
	
			</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>


	
	
	<?php $_from = $this->_tpl_vars['datas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "white,#ebebeb"), $this);?>
" style="color:silver">
			<TD valign="center" align="center"><s><?php echo $this->_tpl_vars['item']['fname']; ?>
 <?php echo $this->_tpl_vars['item']['sname']; ?>
</s></td>
			<TD valign="center" width="190" align="center"><s><?php echo $this->_tpl_vars['item']['tel']; ?>
</s></td>
			<td valign="center" width="120" align="center"><s><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['timestamp'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y - %R") : smarty_modifier_date_format($_tmp, "%d/%m/%y - %R")); ?>
</s></td>
			<TD valign="center" width="150" align="center"><s><?php echo $this->_tpl_vars['item']['dealer']; ?>
</s></td>
			<TD valign="center" width="50" align="center"><s><?php echo $this->_tpl_vars['item']['ctype']; ?>
</s></td>
			<TD valign="center" width="150" align="center"><s><?php echo $this->_tpl_vars['item']['userid']; ?>
</s></td>
			<TD valign="center" width="80" align="center">
			<a href="javascript:;" onClick="viewHotkey('<?php echo $this->_tpl_vars['item']['id']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
viewsm.png" border="0" title="View Hotkey Data"></a> <a href="javascript:;" onClick="freshdata_recoverHotkey('<?php echo $this->_tpl_vars['item']['id']; ?>
', '<?php echo $this->_tpl_vars['item']['fname']; ?>
 <?php echo $this->_tpl_vars['item']['sname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
recoversm.png" border="0" title="Recover this Hotkey"></a>
	
			</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>
	


</table>