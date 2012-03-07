<h1>Claimant Search</h1>

<ul>
	{foreach from=$claimants item=claimant}
	<li><a href="/claimantdata/view/id/{$claimant.assignedID}/">{$claimant.forename} {$claimant.surname}</a><br /><i style="color: #AAA"> {$claimant.address1} {$claimant.address2} {$claimant.address3} {$claimant.town} {$claimant.county} - {$claimant.telephone} {$claimant.mobile}</i></li>
	{/foreach}
</ul>