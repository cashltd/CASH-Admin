<?php /* Smarty version 2.6.14, created on 2012-02-16 13:47:46
         compiled from claimants/stats.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'claimants/stats.tpl', 31, false),array('modifier', 'number_format', 'claimants/stats.tpl', 37, false),array('modifier', 'count', 'claimants/stats.tpl', 96, false),array('function', 'cycle', 'claimants/stats.tpl', 99, false),)), $this); ?>
<div style="float: right;">
<div class="adduseritem">
			<SELECT name="id" name="staffid" onchange="window.location='<?php echo $this->_tpl_vars['HomeUrl']; ?>
claimants/stats/id/user:'+this.options[this.selectedIndex].value+'/'">
			<option value="0">Select a User to view</option>
				<option value="0">All Users</option>
				<?php $_from = $this->_tpl_vars['staff']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<OPTION VALUE="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['fname']; ?>
 <?php echo $this->_tpl_vars['item']['sname']; ?>
</OPTION>
				<?php endforeach; endif; unset($_from); ?>
			</SELECT><br /><br /><br />
			
						<SELECT name="id" name="dataid" onchange="window.location='<?php echo $this->_tpl_vars['HomeUrl']; ?>
claimants/stats/id/data:'+this.options[this.selectedIndex].value+'/'">
			<option value="0">Select Data File to view</option>
				<option value="0">All Data</option>
				<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
					<OPTION VALUE="<?php echo $this->_tpl_vars['item']['id']; ?>
"><?php echo $this->_tpl_vars['item']['filename']; ?>
 <?php echo $this->_tpl_vars['item']['sname']; ?>
</OPTION>
				<?php endforeach; endif; unset($_from); ?>
			</SELECT> <br /><br /><br />
			
			
			
			<SELECT name="id" name="coid" onchange="window.location='<?php echo $this->_tpl_vars['HomeUrl']; ?>
claimants/stats/id/company:'+this.options[this.selectedIndex].value+'/'">
			<option value="0">Select Company to view</option>
				<option value="0">All Companies</option>
					<OPTION VALUE="DLG">DLG</OPTION>
					<OPTION VALUE="CPN">CPN</OPTION>
			</SELECT> 
			
</div>
</div>
<?php if ($this->_tpl_vars['datefrom']): ?>
<h2>Showing stats for DLG data from <?php echo ((is_array($_tmp=$this->_tpl_vars['datefrom'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
 to <?php echo ((is_array($_tmp=$this->_tpl_vars['dateto'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%A, %B %e, %Y") : smarty_modifier_date_format($_tmp, "%A, %B %e, %Y")); ?>
</h2>
<?php endif; ?>

<b>Total Claimants: </b> <?php echo $this->_tpl_vars['stats']['totalclaimants']; ?>
<br />
<i style="color: silver; font-size: 9px;">This is the total amount claimants that have been added to the database!</i><br /><br />

<b>Total Un-Assigned Claimants: </b> <?php echo $this->_tpl_vars['stats']['unassignedclaimants']; ?>
 <span style="color: gray; font-size: 9px;">(<?php echo ((is_array($_tmp=$this->_tpl_vars['stats']['unassignedclaimantspercent'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%)</span><br />
<i style="color: silver; font-size: 9px;">This shows the amount of claimants in the database that can still be assigned!</i><br /><br />

<hr size="1" color="silver"><br />

<b>Total Assigned Claimants: </b> <?php echo $this->_tpl_vars['stats']['assignedclaimants']; ?>
<br />
<i style="color: silver; font-size: 9px;">This shows the amount of claimants in the database that have been assigned to staff!</i><br /><br />

<b>Dormant Claimants: </b> <?php echo $this->_tpl_vars['stats']['dormant']; ?>
 <span style="color: gray; font-size: 9px;">(<?php echo ((is_array($_tmp=$this->_tpl_vars['stats']['dormantpercent'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%)</span><br />
<i style="color: silver; font-size: 9px;">The amount of claimants that have been assigned but not yet contacted!</i><br /><br />

<b>Callbacks Claimants: </b> <?php echo $this->_tpl_vars['stats']['callbacks']; ?>
 <span style="color: gray; font-size: 9px;">(<?php echo ((is_array($_tmp=$this->_tpl_vars['stats']['callbackspercent'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%)</span><br />
<i style="color: silver; font-size: 9px;">The amount of claimants that need to be called back!</i><br /><br />

<b>No Answer Claimants: </b> <?php echo $this->_tpl_vars['stats']['noanswers']; ?>
 <span style="color: gray; font-size: 9px;">(<?php echo ((is_array($_tmp=$this->_tpl_vars['stats']['noanswerspercent'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%)</span><br />
<i style="color: silver; font-size: 9px;">The amount of claimants that have not answered the phone!</i><br /><br />

<hr size="1" color="silver"><br />

<b>Accepted Claimants: </b> <?php echo $this->_tpl_vars['stats']['accepted']; ?>
 <span style="color: gray; font-size: 9px;">(<?php echo ((is_array($_tmp=$this->_tpl_vars['stats']['acceptedpercent'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%)</span><br />
<i style="color: silver; font-size: 9px;">The amount of claimants that have been accepted!</i><br /><br />

<b>Declined Claimants: </b> <?php echo $this->_tpl_vars['stats']['declined']; ?>
 <span style="color: gray; font-size: 9px;">(<?php echo ((is_array($_tmp=$this->_tpl_vars['stats']['declinedpercent'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%)</span><br />
<i style="color: silver; font-size: 9px;">The amount of claimants that have been declined!</i><br /><br />

<b>Returned Claimants: </b> <?php echo $this->_tpl_vars['stats']['returned']; ?>
 <span style="color: gray; font-size: 9px;">(<?php echo ((is_array($_tmp=$this->_tpl_vars['stats']['returnedpercent'])) ? $this->_run_mod_handler('number_format', true, $_tmp, 2) : number_format($_tmp, 2)); ?>
%)</span><br />
<i style="color: silver; font-size: 9px;">The amount of claimants that have been returned for being 3 Strike No Answers or Duplicate data!</i><br /><br />

<?php if ($this->_tpl_vars['stats']['showcost'] == 'true'): ?>
<hr size="1" color="silver"><br />

<b>Cost per accepted claim: </b> �<?php echo $this->_tpl_vars['stats']['costper']; ?>
 <br />
<i style="color: silver; font-size: 9px;">This is the current cost for each accepted claim. Please note, this will only show correct if all possible claimants have been Accepted / Declined.</i><br /><br />

<?php endif; ?>




<?php if ($this->_tpl_vars['stats']['showdeclined'] == 'true'): ?>
<hr>

<a href="<?php echo $this->_tpl_vars['csvlink']; ?>
">Download claimant data</a><br /><br />
<table width="100%" bgcolor="#bbb" cellpadding="5">
<tr>
<Th>NAME</th>
<Th>ADD1</th>
<Th>ADD2</th>
<Th>ADD3</th>
<Th>TOWN</th>
<Th>COUNTY</th>
<Th>POSTCODE</th>
<Th>TELEPHONE</th>
<Th>MOBILE</th>
<Th>CSV</th>
<Th>COMMENT</th>
</tr>

<tr>
<Th colspan="11" align="left" bgcolor="#80a26b">Accepted Claims (<?php echo count($this->_tpl_vars['stats']['listallaccepted']); ?>
)</th>
</tr>
<?php $_from = $this->_tpl_vars['stats']['listallaccepted']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#d0d0d0"), $this);?>
">
<Td valign="top"><?php echo $this->_tpl_vars['item']['title']; ?>
 <?php echo $this->_tpl_vars['item']['forename']; ?>
 <?php echo $this->_tpl_vars['item']['surname']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['add1']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['add2']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['add3']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['town']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['county']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['postcode']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['telephone']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['mobile']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['filename']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['comment']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>


<tr>
<Th colspan="11" align="left" bgcolor="#c9aba2">Declined Claims (<?php echo count($this->_tpl_vars['stats']['listalldeclined']); ?>
)</th>
</tr>
<?php $_from = $this->_tpl_vars['stats']['listalldeclined']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#d0d0d0"), $this);?>
">
<Td valign="top"><?php echo $this->_tpl_vars['item']['title']; ?>
 <?php echo $this->_tpl_vars['item']['forename']; ?>
 <?php echo $this->_tpl_vars['item']['surname']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['add1']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['add2']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['add3']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['town']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['county']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['postcode']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['telephone']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['mobile']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['filename']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['comment']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
<Th colspan="11" align="left" bgcolor="#a26b6b">Unable to Contact (<?php echo count($this->_tpl_vars['stats']['listallreturned']); ?>
)</th>
</tr>
<?php $_from = $this->_tpl_vars['stats']['listallreturned']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#d0d0d0"), $this);?>
">
<Td valign="top"><?php echo $this->_tpl_vars['item']['title']; ?>
 <?php echo $this->_tpl_vars['item']['forename']; ?>
 <?php echo $this->_tpl_vars['item']['surname']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['add1']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['add2']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['add3']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['town']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['county']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['postcode']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['telephone']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['mobile']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['filename']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['comment']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>


<tr>
<Th colspan="11" align="left" bgcolor="#edac65">Still Trying to Contact (<?php echo count($this->_tpl_vars['stats']['listallwaiting']); ?>
)</th>
</tr>
<?php $_from = $this->_tpl_vars['stats']['listallwaiting']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#d0d0d0"), $this);?>
">
<Td valign="top"><?php echo $this->_tpl_vars['item']['title']; ?>
 <?php echo $this->_tpl_vars['item']['forename']; ?>
 <?php echo $this->_tpl_vars['item']['surname']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['add1']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['add2']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['add3']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['town']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['county']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['postcode']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['telephone']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['mobile']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['filename']; ?>
</td>
<Td valign="top"><?php echo $this->_tpl_vars['item']['comment']; ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>





</table>


<?php endif; ?>