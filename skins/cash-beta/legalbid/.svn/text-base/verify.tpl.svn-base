
<script>
{literal} 
// <![CDATA[
new Ajax.PeriodicalUpdater('toVerify', '{/literal}{$HomeUrl}{literal}ajax/legalbid_listVerify/', {
  method: 'get', frequency: 30});
// ]]>
{/literal} 
</script>
<div id="toVerify">
<center><b>Loading... Please Wait!</b></center>
</div>


<h3 class="green"><div class="hider" onClick="Effect.toggle('claimQueue', 'blind');">Toggle</div>Claim Queue</h3>
<script>
{literal} 
// <![CDATA[
var claimq = new Ajax.PeriodicalUpdater('claimQueue', '{/literal}{$HomeUrl}{literal}ajax/legalbid_queueVerify/', {
  method: 'get', frequency: 30});
// ]]>
{/literal} 
</script>
<div id="claimQueue">
<center><b>Loading... Please Wait!</b></center>
</div>



<h3 class="red"><div class="hider" onClick="Effect.toggle('noVerify', 'blind');">Toggle</div>Declined Claims</h3>

<script>
{literal} 
// <![CDATA[
new Ajax.PeriodicalUpdater('noVerify', '{/literal}{$HomeUrl}{literal}ajax/legalbid_oldVerify/', {
  method: 'get', frequency: 30});
// ]]>
{/literal} 
</script>
<div id="noVerify">
<center><b>Loading... Please Wait!</b></center>
</div>




