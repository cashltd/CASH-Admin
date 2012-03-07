<?php /* Smarty version 2.6.14, created on 2012-03-05 17:31:58
         compiled from legalbid/verify.tpl */ ?>

<script>
<?php echo ' 
// <![CDATA[
new Ajax.PeriodicalUpdater(\'toVerify\', \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/legalbid_listVerify/\', {
  method: \'get\', frequency: 30});
// ]]>
'; ?>
 
</script>
<div id="toVerify">
<center><b>Loading... Please Wait!</b></center>
</div>


<h3 class="green"><div class="hider" onClick="Effect.toggle('claimQueue', 'blind');">Toggle</div>Claim Queue</h3>
<script>
<?php echo ' 
// <![CDATA[
var claimq = new Ajax.PeriodicalUpdater(\'claimQueue\', \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/legalbid_queueVerify/\', {
  method: \'get\', frequency: 30});
// ]]>
'; ?>
 
</script>
<div id="claimQueue">
<center><b>Loading... Please Wait!</b></center>
</div>



<h3 class="red"><div class="hider" onClick="Effect.toggle('noVerify', 'blind');">Toggle</div>Declined Claims</h3>

<script>
<?php echo ' 
// <![CDATA[
new Ajax.PeriodicalUpdater(\'noVerify\', \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/legalbid_oldVerify/\', {
  method: \'get\', frequency: 30});
// ]]>
'; ?>
 
</script>
<div id="noVerify">
<center><b>Loading... Please Wait!</b></center>
</div>



