<h3 class="green"><div class="hider" onClick="Effect.toggle('claimQueue', 'blind');">Toggle</div>Legalbid - Live Claim View</h3>
<script>
{literal} 
// <![CDATA[
var claimq = new Ajax.PeriodicalUpdater('claimQueue', '{/literal}{$HomeUrl}{literal}ajax/legalbid_queueVerify/', {
  method: 'get', frequency: 2});
// ]]>
{/literal} 
</script>
<div id="claimQueue">
<center><b>Loading... Please Wait!</b></center>
</div>