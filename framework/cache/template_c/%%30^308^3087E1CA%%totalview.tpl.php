<?php /* Smarty version 2.6.14, created on 2012-03-06 17:31:58
         compiled from solicitors/totalview.tpl */ ?>

<script><?php echo '
	var freshpagestart = 0;
	var acceptpagestart = 0;
	var declinepagestart = 0;

	var provider = \'0\';
	var perpage = 15;
	var userid = ';  echo $this->_tpl_vars['userid'];  echo ';


	function refreshAll() {
		
	}

'; ?>
</script>

<div id="userselect">

<a href="javascript:;" id="ser<?php echo $this->_tpl_vars['userid']; ?>
" class="selected" onClick="setuser('<?php echo $this->_tpl_vars['userid']; ?>
')">All</a> 
<a href="javascript:;" id="ser<?php echo $this->_tpl_vars['userid']; ?>
" onClick="setuser('<?php echo $this->_tpl_vars['userid']; ?>
')">Signed Up</a> 
<a href="javascript:;" id="ser<?php echo $this->_tpl_vars['userid']; ?>
" onClick="setuser('<?php echo $this->_tpl_vars['userid']; ?>
')">Interested</a> 
<a href="javascript:;" id="ser<?php echo $this->_tpl_vars['userid']; ?>
" onClick="setuser('<?php echo $this->_tpl_vars['userid']; ?>
')">Appointment Made</a> 
<a href="javascript:;" id="ser<?php echo $this->_tpl_vars['userid']; ?>
" onClick="setuser('<?php echo $this->_tpl_vars['userid']; ?>
')">Workable</a> 
<a href="javascript:;" id="ser<?php echo $this->_tpl_vars['userid']; ?>
" onClick="setuser('<?php echo $this->_tpl_vars['userid']; ?>
')">Not Interested</a> 
<a href="javascript:;" id="ser<?php echo $this->_tpl_vars['userid']; ?>
" onClick="setuser('<?php echo $this->_tpl_vars['userid']; ?>
')">Not Contacted</a> 

</div> 


<div id="supplierselect">
	<a href="javascript:;" class="selected" id="sec0" onclick="setsector('0')">All Sectors</a>
		<?php $_from = $this->_tpl_vars['sectors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<a href="javascript:;" id="sec<?php echo $this->_tpl_vars['item']['id']; ?>
" onclick="setsector('<?php echo $this->_tpl_vars['item']['id']; ?>
')"><?php echo $this->_tpl_vars['item']['title']; ?>
</a>
		<?php endforeach; endif; unset($_from); ?>
</div>



<script>
<?php echo ' 
// <![CDATA[
var claimp = new Ajax.PeriodicalUpdater(\'toVerify\', \'http://admin.cash-ltd.co.uk/ajax/solicitors_listsolicitors/id/\'+provider+\'-\'+freshpagestart+\'-\'+perpage+\'-\'+userid+\'/\', {
  method: \'get\', frequency: 30});
// ]]>
'; ?>
 
</script>
<div id="toVerify">
<center><b>Loading... Please Wait!</b></center>
</div>