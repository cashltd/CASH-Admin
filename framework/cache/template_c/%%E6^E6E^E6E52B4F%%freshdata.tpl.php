<?php /* Smarty version 2.6.14, created on 2012-02-15 16:50:44
         compiled from claimants/freshdata.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'claimants/freshdata.tpl', 29, false),array('modifier', 'date_format', 'claimants/freshdata.tpl', 31, false),array('modifier', 'replace', 'claimants/freshdata.tpl', 44, false),)), $this); ?>
<div style="position: absolute; margin-top: -50px">
<div id="statsholder" style="display: none;"><div id="statsinfo">ss</div></div>

<?php echo $this->_tpl_vars['currenticon']; ?>
<img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
stats.png" width="14" height="14" hspace="3" vspace="0" style="margin-bottom: 18px; cursor: pointer" onMouseOut="hideStats()" onMouseOver="viewStats()">





</div>


<table width="100%" border="0" class="verifytable" cellpadding="0" cellspacing="0" id="verifytable">
<thead>
	<tr>
		<th>&nbsp;</th>
		<th>Name</th>
		<th>Telephone</th>
		<th>Mobile</th>
		<th>&nbsp;</th>
		<th>Staff Member</th>
		<th>Data File</th>
		<th>Actions</th>
	</tr>
</thead>
	
<tbody>
	<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#ebebeb,white"), $this);?>
"<?php if ($this->_tpl_vars['item']['supplier'] == 2): ?> class="important-callback"<?php endif; ?>>
			<TD valign="center" align="left" width="225" style="color:gray;"><div style="float: right; text-align: right; width: 100px">
			<?php if ($this->_tpl_vars['item']['supplier'] == 2): ?><b style="line-height: 12px; font-size: 9px; ">Callback Requested<br /><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['callback'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M - %d/%m/%y") : smarty_modifier_date_format($_tmp, "%H:%M - %d/%m/%y")); ?>
</b><?php endif;  if ($this->_tpl_vars['item']['supplier'] == 4): ?><b style="line-height: 12px; font-size: 9px; ">Left a Message<br /><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['timestamp'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M - %d/%m/%y") : smarty_modifier_date_format($_tmp, "%H:%M - %d/%m/%y")); ?>
</b><?php endif;  if ($this->_tpl_vars['item']['supplier'] == 3): ?><b style="line-height: 12px; font-size: 9px; ">No Answer<br /><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['timestamp'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M - %d/%m/%y") : smarty_modifier_date_format($_tmp, "%H:%M - %d/%m/%y")); ?>
</b><?php endif; ?></div>
			
			<div style="cursor: default;">		
				<a href="/ajax/viewclaimantdetails/id/<?php echo $this->_tpl_vars['item']['assignedID']; ?>
/" class="claimant_details" target="_new">
				
					<?php if ($this->_tpl_vars['item']['bit'] & 1): ?><img src="/skins/cash/images/mornon.png" title="Claimant was called in the Morning" border="0" height="18"><?php else: ?><img src="/skins/cash/images/mornoff.png" title="Claimant has not been called in the Morning" border="0" height="18"><?php endif;  if ($this->_tpl_vars['item']['bit'] & 2): ?><img src="/skins/cash/images/afton.png" title="Claimant was called in the Afternoon" border="0" height="18"><?php else: ?><img src="/skins/cash/images/aftoff.png" title="Claimant has not been called in the Afternoon" border="0" height="18"><?php endif;  if ($this->_tpl_vars['item']['bit'] & 4): ?><img src="/skins/cash/images/nigon.png" title="Claimant was called in the Night" border="0" height="18"><?php else: ?><img src="/skins/cash/images/nigoff.png" title="Claimant has not been called in the Night" border="0" height="18"><?php endif; ?>
					
					<?php if ($this->_tpl_vars['item']['bit'] & 8): ?><img src="/skins/cash/images/mornon.png" title="Claimant was called in the Morning" border="0" height="18"><?php else: ?><img src="/skins/cash/images/mornoff.png" title="Claimant was called in the Morning" border="0" height="18"><?php endif;  if ($this->_tpl_vars['item']['bit'] & 16): ?><img src="/skins/cash/images/afton.png" title="Claimant was called in the Morning" border="0" height="18"><?php else: ?><img src="/skins/cash/images/aftoff.png" title="Claimant was called in the Morning" border="0" height="18"><?php endif;  if ($this->_tpl_vars['item']['bit'] & 32): ?><img src="/skins/cash/images/nigon.png" title="Claimant was called in the Morning" border="0" height="18"><?php else: ?><img src="/skins/cash/images/nigoff.png" title="Claimant was called in the Morning" border="0" height="18"><?php endif; ?>
					
				</a>
			</div>
			</td>
			<TD valign="center" align="center"><?php echo $this->_tpl_vars['item']['forename']; ?>
 <?php echo $this->_tpl_vars['item']['surname']; ?>
 <?php echo $this->_tpl_vars['item']['possibleduplicate']; ?>
</td>
			<TD valign="center" width="100" align="center"><a href="javascript:voip_makeCall('<?php echo $this->_tpl_vars['item']['forename']; ?>
 <?php echo $this->_tpl_vars['item']['surname']; ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['telephone'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?>
', <?php echo $this->_tpl_vars['item']['assignedID']; ?>
);"><?php echo $this->_tpl_vars['item']['telephone']; ?>
</a> <?php if ($this->_tpl_vars['item']['telephone']): ?><font color="#AAAAAA" size="1" style="font-size: 9px;"></font><?php endif; ?></td>
			<TD valign="center" width="100" align="center"><a href="javascript:voip_makeCall('<?php echo $this->_tpl_vars['item']['forename']; ?>
 <?php echo $this->_tpl_vars['item']['surname']; ?>
', '<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['mobile'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?>
', <?php echo $this->_tpl_vars['item']['assignedID']; ?>
);"><?php echo $this->_tpl_vars['item']['mobile']; ?>
</a> <?php if ($this->_tpl_vars['item']['mobile']): ?><font color="#AAAAAA" size="1" style="font-size: 9px;"></font><?php endif; ?></td>
			<td width="16">
			
			<?php if ($this->_tpl_vars['item']['mobile'] != ' ' && $this->_tpl_vars['item']['mobile'] != '' && $this->_tpl_vars['item']['texted'] != 'TRUE'): ?>			
			<img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
smsoff.png" border="0" title="Send SMS to this Client" id="sms<?php echo $this->_tpl_vars['item']['assignedID']; ?>
" width="18" style="cursor: hand;" onClick="claimant_sms('<?php echo $this->_tpl_vars['item']['assignedID']; ?>
')">
			<?php endif; ?>
			</td>
			<TD valign="center" width="130" align="center"><?php echo $this->_tpl_vars['item']['handlerName']; ?>
</td>
			<TD valign="center" width="150" align="center"><a href="/claimants/stats/id/data:<?php echo $this->_tpl_vars['item']['dataFileID']; ?>
/" target="_new"><?php echo $this->_tpl_vars['item']['dataFileName']; ?>
</a></td>
			<TD valign="center" width="120" align="center">
			
			<a href="javascript:;" onClick="claimant_accept('<?php echo $this->_tpl_vars['item']['assignedID']; ?>
', '<?php echo $this->_tpl_vars['item']['forename']; ?>
 <?php echo $this->_tpl_vars['item']['surname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
acceptsm.png" border="0" title="Client IS claiming"></a> 
			<a href="javascript:;" onClick="claimant_decline('<?php echo $this->_tpl_vars['item']['assignedID']; ?>
', '<?php echo $this->_tpl_vars['item']['forename']; ?>
 <?php echo $this->_tpl_vars['item']['surname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
declinesm.png" border="0" title="Client is NOT claiming"></a> 
			<a href="javascript:;" onClick="claimant_callback('<?php echo $this->_tpl_vars['item']['assignedID']; ?>
', '<?php echo $this->_tpl_vars['item']['forename']; ?>
 <?php echo $this->_tpl_vars['item']['surname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
callback.png" border="0" title="Client Needs a Callback"></a> 
			<a href="javascript:;" onClick="claimant_noanswer('<?php echo $this->_tpl_vars['item']['assignedID']; ?>
', '<?php echo $this->_tpl_vars['item']['forename']; ?>
 <?php echo $this->_tpl_vars['item']['surname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
noanswer.png" border="0" title="Client has not answered"></a>
			<a href="javascript:;" onClick="claimant_duplicate('<?php echo $this->_tpl_vars['item']['assignedID']; ?>
', '<?php echo $this->_tpl_vars['item']['forename']; ?>
 <?php echo $this->_tpl_vars['item']['surname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
deletesm.png" border="0" title="Client is a duplicate"></a>
			</td>
		</tr>
	<?php endforeach; endif; unset($_from); ?>


</tbody>

</table>