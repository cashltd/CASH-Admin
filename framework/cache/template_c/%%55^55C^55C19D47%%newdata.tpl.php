<?php /* Smarty version 2.6.14, created on 2012-02-14 16:50:49
         compiled from claimants/newdata.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'claimants/newdata.tpl', 14, false),array('modifier', 'replace', 'claimants/newdata.tpl', 16, false),array('modifier', 'date_format', 'claimants/newdata.tpl', 17, false),)), $this); ?>
<table width="100%" border="0" class="verifytable" cellpadding="0" cellspacing="0">
	<tr>
		<th>Name</th>
		<th>Telephone</th>
		<th>Accepted On</th>
		<th>Data File</th>
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
			<td valign="center" width="120" align="center"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['accepted'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y - %R") : smarty_modifier_date_format($_tmp, "%d/%m/%y - %R")); ?>
</td>
			<TD valign="center" width="190" align="center"><?php echo $this->_tpl_vars['item']['csv']; ?>
</td>
			<TD valign="center" width="150" align="center"><?php echo $this->_tpl_vars['item']['userid']; ?>
</td>
			<TD valign="center" width="80" align="center"><a href="javascript:;" onClick="viewHotkey('<?php echo $this->_tpl_vars['item']['id']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
viewsm.png" border="0" title="View Hotkey Data"></a></td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>


	<tr>
		<th align="left">&nbsp;<?php if ($this->_tpl_vars['shprev'] == '1'): ?><a href="javascript:;" onClick="acceptchange('p')">< Previous Page</a><?php endif; ?></th>
		<th colspan="4" align="left">Currently on Page <?php echo $this->_tpl_vars['pagenumber']; ?>
</th>
		<th align="right"><a href="javascript:;" onClick="acceptchange('n')">Next Page ></a>&nbsp;</th>
	</tr>

</table>