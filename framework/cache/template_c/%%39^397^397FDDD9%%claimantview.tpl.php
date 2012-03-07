<?php /* Smarty version 2.6.14, created on 2012-02-15 14:59:00
         compiled from claimantview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'claimantview.tpl', 104, false),)), $this); ?>
<div id="modalDisplay">
	
	<div class="column_left">
		<div class="header"><span>Claimant Details</span>
			<div class="extras">
				<a href="javascript:;" onClick="claimant_accept('<?php echo $this->_tpl_vars['details']['assignedID']; ?>
', '<?php echo $this->_tpl_vars['details']['forename']; ?>
 <?php echo $this->_tpl_vars['details']['surname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
acceptsm.png" border="0" title="Client IS claiming"></a> 
				<a href="javascript:;" onClick="claimant_decline('<?php echo $this->_tpl_vars['details']['assignedID']; ?>
', '<?php echo $this->_tpl_vars['details']['forename']; ?>
 <?php echo $this->_tpl_vars['details']['surname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
declinesm.png" border="0" title="Client is NOT claiming"></a> 
				<a href="javascript:;" onClick="claimant_callback('<?php echo $this->_tpl_vars['details']['assignedID']; ?>
', '<?php echo $this->_tpl_vars['details']['forename']; ?>
 <?php echo $this->_tpl_vars['details']['surname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
callback.png" border="0" title="Client Needs a Callback"></a>
				<a href="javascript:;" onClick="claimant_noanswer('<?php echo $this->_tpl_vars['details']['assignedID']; ?>
', '<?php echo $this->_tpl_vars['details']['forename']; ?>
 <?php echo $this->_tpl_vars['details']['surname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
noanswer.png" border="0" title="Client has not answered"></a>
				<a href="javascript:;" onClick="claimant_duplicate('<?php echo $this->_tpl_vars['details']['assignedID']; ?>
', '<?php echo $this->_tpl_vars['details']['forename']; ?>
 <?php echo $this->_tpl_vars['details']['surname']; ?>
')"><img src="<?php echo $this->_tpl_vars['ImageUrl']; ?>
deletesm.png" border="0" title="Client is a duplicate"></a>
			</div>
		</div>
		
		<div class="content">
			<table cellpadding="0" cellspacing="0">
			
				<tr>
					<th>Name : </th>
					<td><?php echo $this->_tpl_vars['details']['title']; ?>
 <?php echo $this->_tpl_vars['details']['forename']; ?>
 <?php echo $this->_tpl_vars['details']['surname']; ?>
</td>
				</tr>
				<tr>
					<th>Address 1 : </th>
					<td><?php echo $this->_tpl_vars['details']['address1']; ?>
</td>
				</tr>
				<tr>
					<th>Address 2 : </th>
					<td><?php echo $this->_tpl_vars['details']['address2']; ?>
</td>
				</tr>
				<tr>
					<th>Address 3 : </th>
					<td><?php echo $this->_tpl_vars['details']['address3']; ?>
</td>
				</tr>
				<tr>
					<th>Town : </th>
					<td><?php echo $this->_tpl_vars['details']['town']; ?>
</td>
				</tr>
				<tr>
					<th>County : </th>
					<td><?php echo $this->_tpl_vars['details']['county']; ?>
</td>
				</tr>
				<tr>
					<th>Postcode : </th>
					<td><?php echo $this->_tpl_vars['details']['postcode']; ?>
</td>
				</tr>
				<tr>
					<th>Telephone : </th>
					<td><?php echo $this->_tpl_vars['details']['telephone']; ?>
</td>
				</tr>
				<tr>
					<th>Mobile : </th>
					<td><?php echo $this->_tpl_vars['details']['mobile']; ?>
</td>
				</tr>
			
			</table>
		</div>
	
	</div>
	
	
	<div class="column_right">
		<div class="header"><span>Claimant Location</span></div>
	
		<div class="content">
			<div id="map_canvas" style="width:100%; height:275px; border: #CCC 1px solid; -moz-box-shadow: 2px 2px 3px #888; -webkit-box-shadow: 2px 2px 3px #888; box-shadow: 2px 2px 3px #888;"></div>
		
			<script type="text/javascript">
	    
	    		mapFunction = function() <?php echo '{'; ?>

	    
			     	var latlng = new google.maps.LatLng(<?php echo $this->_tpl_vars['details']['long']; ?>
, <?php echo $this->_tpl_vars['details']['lat']; ?>
);
			     
			        var myOptions = <?php echo '{'; ?>

			          center: latlng,
			          zoom: 14,
			          mapTypeId: google.maps.MapTypeId.ROADMAP
			        <?php echo '}'; ?>
;
			        
			        var marker = new google.maps.Marker(<?php echo '{'; ?>

					    position: latlng,
					<?php echo '}'; ?>
);
					
			        var map = new google.maps.Map(document.getElementById("map_canvas"),
			            myOptions);
			            
			        marker.setMap(map);
	      		<?php echo '}'; ?>

	      		
	      		mapFunction();
	      		
	    </script>
		</div>
	
	</div>
	
	<br style="clear: both;" /><br style="clear: both;" />
	
	
	<div class="column_left">
		<div class="header"><span>Outgoing Calls</span></div>
		
		<div class="content">
			<ul>
				<?php $_from = $this->_tpl_vars['details']['callLog']['outgoing']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<li style="line-height: 35px;"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['calldate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y") : smarty_modifier_date_format($_tmp, "%d/%m/%y")); ?>
 @ <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['calldate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
: </strong><?php echo $this->_tpl_vars['item']['username']['fname']; ?>
 <?php echo $this->_tpl_vars['item']['username']['sname']; ?>
 (<?php echo $this->_tpl_vars['item']['username']['extension']; ?>
) - <?php echo $this->_tpl_vars['item']['duration']; ?>
s <audio controls="controls" style="float: right; width: 100px;"><source src="<?php echo $this->_tpl_vars['item']['recordLink']; ?>
" type="audio/wav"></audio></li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
	
	</div>
	
	<div class="column_right">
		<div class="header"><span>Incoming Calls</span></div>
		
		<div class="content">
			<ul>
			<?php $_from = $this->_tpl_vars['details']['callLog']['incoming']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<li style="line-height: 35px;"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['calldate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y") : smarty_modifier_date_format($_tmp, "%d/%m/%y")); ?>
 @ <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['calldate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
: </strong><?php echo $this->_tpl_vars['item']['username']['fname']; ?>
 <?php echo $this->_tpl_vars['item']['username']['sname']; ?>
 (<?php echo $this->_tpl_vars['item']['username']['extension']; ?>
) - <?php echo $this->_tpl_vars['item']['duration']; ?>
s <audio controls="controls" style="float: right; width: 100px;"><source src="<?php echo $this->_tpl_vars['item']['recordLink']; ?>
" type="audio/wav"></audio></li>
			<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
	
	</div>
	<br style="clear: both;" /><br style="clear: both;" />
	
	<div class="column_left">
		<div class="header"><span>Sent Text Messages</span></div>
		
		<div class="content">
			<ul>
				<?php $_from = $this->_tpl_vars['details']['textLog']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<li style="line-height: 35px;"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['timestamp'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y") : smarty_modifier_date_format($_tmp, "%d/%m/%y")); ?>
 @ <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['timestamp'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
 </strong></li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
	
	</div>
	
	<br style="clear: both;" />
</div>