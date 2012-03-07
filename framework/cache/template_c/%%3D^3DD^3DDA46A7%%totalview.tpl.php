<?php /* Smarty version 2.6.14, created on 2012-02-15 12:17:00
         compiled from datasuppliers/totalview.tpl */ ?>
<script>
<?php echo '



	var freshpagestart = 0;
	var acceptpagestart = 0;
	var declinepagestart = 0;



	var provider = \'0\';
	var perpage = 15;
	var userid = ';  echo $this->_tpl_vars['userid'];  echo ';
'; ?>

</script>

<script>
<?php echo '
	function setLoading(frame) {
		$(frame).update("<center><img src=\'';  echo $this->_tpl_vars['HomeUrl'];  echo 'skins/cash/images/load.gif\'><br /><b>Loading... Please Wait!</b></center>");
	}

	
	function freshchange(type) {
		switch (type)
			{
				case \'n\':
				  freshpagestart = freshpagestart + 1;
				  break;
				case \'p\':
					if (freshpagestart > 0) {
				  		freshpagestart = freshpagestart - 1;
					}
				  break;
			}
		claimp.stop();
		claimp.url = \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/datasuppliers_freshdata/id/\'+provider+\'-\'+freshpagestart+\'-\'+perpage+\'-\'+userid+\'/\';
		claimp.start();
		
	}

	
	function declinechange(type) {
		switch (type)
			{
				case \'n\':
				  declinepagestart = declinepagestart + 1;
				  break;
				case \'p\':
					if (declinepagestart > 0) {
					  declinepagestart = declinepagestart - 1;
					}
				  break;
			}
		claimr.stop();
		claimr.url = \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/datasuppliers_olddata/id/\'+provider+\'-\'+declinepagestart+\'-\'+perpage+\'-\'+userid+\'/\';
		claimr.start();
		
	}
	
	function acceptchange(type) {
		switch (type)
			{
				case \'n\':
				  acceptpagestart = acceptpagestart + 1;
				  break;
				case \'p\':
					if (acceptpagestart > 0) {
					  acceptpagestart = acceptpagestart - 1;
					}
				  break;
			}
		claimq.stop();
		claimq.url = \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/datasuppliers_newdata/id/\'+provider+\'-\'+acceptpagestart+\'-\'+perpage+\'-\'+userid+\'/\';
		claimq.start();
		
	}
	
	
	function refreshAll() {
			freshpagestart = 0;
			acceptpagestart = 0;
			declinepagestart = 0;
		claimq.stop();
		claimr.stop();
		claimp.stop();
			setLoading(\'claimQueue\');
			setLoading(\'noVerify\');
			setLoading(\'toVerify\');
				claimp.url = \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/datasuppliers_freshdata/id/\'+provider+\'-\'+freshpagestart+\'-\'+perpage+\'-\'+userid+\'/\';
				claimq.url = \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/datasuppliers_newdata/id/\'+provider+\'-\'+acceptpagestart+\'-\'+perpage+\'-\'+userid+\'/\';
				claimr.url = \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/datasuppliers_olddata/id/\'+provider+\'-\'+declinepagestart+\'-\'+perpage+\'-\'+userid+\'/\';
		claimq.start();
		claimr.start();
		claimp.start();
	}
	
	function allgo() {
		';  $_from = $this->_tpl_vars['suppliers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
 echo '$(\'sup';  echo $this->_tpl_vars['item']['id'];  echo '\').removeClassName(\'selected\');
		';  endforeach; endif; unset($_from);  echo '$(\'sup0\').removeClassName(\'selected\');
	}
	
	function setsupplier(id) {
		allgo();
		provider = id;
		$(\'sup\'+id).addClassName(\'selected\');
		refreshAll();
	}
	
	function setuser(id) {
		$(\'ser';  echo $this->_tpl_vars['userid'];  echo '\').removeClassName(\'selected\');
		$(\'ser0\').removeClassName(\'selected\');
		$(\'ser\'+id).addClassName(\'selected\');
		userid = id;
		refreshAll();
	}
	
'; ?>

</script>


<div id="supplierselect">
	<a href="javascript:;" class="selected" id="sup0" onclick="setsupplier('0')">All Data</a>
		<?php $_from = $this->_tpl_vars['suppliers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
			<a href="javascript:;" id="sup<?php echo $this->_tpl_vars['item']['id']; ?>
" onclick="setsupplier('<?php echo $this->_tpl_vars['item']['id']; ?>
')"><?php echo $this->_tpl_vars['item']['name']; ?>
</a>
		<?php endforeach; endif; unset($_from); ?>
</div>

<div id="userselect"><a href="javascript:;" id="ser<?php echo $this->_tpl_vars['userid']; ?>
" class="selected" onClick="setuser('<?php echo $this->_tpl_vars['userid']; ?>
')">Just Me</a> <a href="javascript:;" id="ser0" onClick="setuser('0')">All Users</a></div> 





<script>
<?php echo ' 
// <![CDATA[
var claimp = new Ajax.PeriodicalUpdater(\'toVerify\', \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/datasuppliers_freshdata/id/\'+provider+\'-\'+freshpagestart+\'-\'+perpage+\'-\'+userid+\'/\', {
  method: \'get\', frequency: 30});
// ]]>
'; ?>
 
</script>
<div id="toVerify">
<center><b>Loading... Please Wait!</b></center>
</div>


<a name="accepted"></a><h3 class="green"><div class="hider" onClick="Effect.toggle('claimQueue', 'blind');">Toggle</div>Accepted Claims</h3>
<script>
<?php echo ' 
// <![CDATA[
var claimq = new Ajax.PeriodicalUpdater(\'claimQueue\', \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/datasuppliers_newdata/id/\'+provider+\'-\'+acceptpagestart+\'-\'+perpage+\'-\'+userid+\'/\', {
  method: \'get\', frequency: 30});
// ]]>
'; ?>
 
</script>
<div id="claimQueue" style="display: none;">
<center><b>Loading... Please Wait!</b></center>
</div>



<h3 class="red"><div class="hider" onClick="Effect.toggle('noVerify', 'blind');">Toggle</div>Declined Claims</h3>

<script>
<?php echo ' 
// <![CDATA[
var claimr = new Ajax.PeriodicalUpdater(\'noVerify\', \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/datasuppliers_olddata/id/\'+provider+\'-\'+declinepagestart+\'-\'+perpage+\'-\'+userid+\'/\', {
  method: \'get\', frequency: 30});
// ]]>
'; ?>
 
</script>
<div id="noVerify" style="display: none;">
<center><b>Loading... Please Wait!</b></center>
</div>



