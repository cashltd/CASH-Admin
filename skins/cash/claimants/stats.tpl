<div style="float: right;">
<div class="adduseritem">
			<SELECT name="id" name="staffid" onchange="window.location='{$HomeUrl}claimants/stats/id/user:'+this.options[this.selectedIndex].value+'/'">
			<option value="0">Select a User to view</option>
				<option value="0">All Users</option>
				{foreach from=$staff item=item}
					<OPTION VALUE="{$item.id}">{$item.fname} {$item.sname}</OPTION>
				{/foreach}
			</SELECT><br /><br /><br />
			
						<SELECT name="id" name="dataid" onchange="window.location='{$HomeUrl}claimants/stats/id/data:'+this.options[this.selectedIndex].value+'/'">
			<option value="0">Select Data File to view</option>
				<option value="0">All Data</option>
				{foreach from=$data item=item}
					<OPTION VALUE="{$item.id}">{$item.filename} {$item.sname}</OPTION>
				{/foreach}
			</SELECT> <br /><br /><br />
			
			
			
			<SELECT name="id" name="coid" onchange="window.location='{$HomeUrl}claimants/stats/id/company:'+this.options[this.selectedIndex].value+'/'">
			<option value="0">Select Company to view</option>
				<option value="0">All Companies</option>
					<OPTION VALUE="DLG">DLG</OPTION>
					<OPTION VALUE="CPN">CPN</OPTION>
			</SELECT> 
			
</div>
</div>
{if $datefrom}
<h2>Showing stats for DLG data from {$datefrom|date_format:"%A, %B %e, %Y"} to {$dateto|date_format:"%A, %B %e, %Y"}</h2>
{/if}

<b>Total Claimants: </b> {$stats.totalclaimants}<br />
<i style="color: silver; font-size: 9px;">This is the total amount claimants that have been added to the database!</i><br /><br />

<b>Total Un-Assigned Claimants: </b> {$stats.unassignedclaimants} <span style="color: gray; font-size: 9px;">({$stats.unassignedclaimantspercent|number_format:2}%)</span><br />
<i style="color: silver; font-size: 9px;">This shows the amount of claimants in the database that can still be assigned!</i><br /><br />

<hr size="1" color="silver"><br />

<b>Total Assigned Claimants: </b> {$stats.assignedclaimants}<br />
<i style="color: silver; font-size: 9px;">This shows the amount of claimants in the database that have been assigned to staff!</i><br /><br />

<b>Dormant Claimants: </b> {$stats.dormant} <span style="color: gray; font-size: 9px;">({$stats.dormantpercent|number_format:2}%)</span><br />
<i style="color: silver; font-size: 9px;">The amount of claimants that have been assigned but not yet contacted!</i><br /><br />

<b>Callbacks Claimants: </b> {$stats.callbacks} <span style="color: gray; font-size: 9px;">({$stats.callbackspercent|number_format:2}%)</span><br />
<i style="color: silver; font-size: 9px;">The amount of claimants that need to be called back!</i><br /><br />

<b>No Answer Claimants: </b> {$stats.noanswers} <span style="color: gray; font-size: 9px;">({$stats.noanswerspercent|number_format:2}%)</span><br />
<i style="color: silver; font-size: 9px;">The amount of claimants that have not answered the phone!</i><br /><br />

<hr size="1" color="silver"><br />

<b>Accepted Claimants: </b> {$stats.accepted} <span style="color: gray; font-size: 9px;">({$stats.acceptedpercent|number_format:2}%)</span><br />
<i style="color: silver; font-size: 9px;">The amount of claimants that have been accepted!</i><br /><br />

<b>Declined Claimants: </b> {$stats.declined} <span style="color: gray; font-size: 9px;">({$stats.declinedpercent|number_format:2}%)</span><br />
<i style="color: silver; font-size: 9px;">The amount of claimants that have been declined!</i><br /><br />

<b>Returned Claimants: </b> {$stats.returned} <span style="color: gray; font-size: 9px;">({$stats.returnedpercent|number_format:2}%)</span><br />
<i style="color: silver; font-size: 9px;">The amount of claimants that have been returned for being 3 Strike No Answers or Duplicate data!</i><br /><br />

{if $stats.showcost eq "true"}
<hr size="1" color="silver"><br />

<b>Cost per accepted claim: </b> £{$stats.costper} <br />
<i style="color: silver; font-size: 9px;">This is the current cost for each accepted claim. Please note, this will only show correct if all possible claimants have been Accepted / Declined.</i><br /><br />

{/if}




{if $stats.showdeclined eq "true"}
<hr>

<a href="{$csvlink}">Download claimant data</a><br /><br />
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
<Th colspan="11" align="left" bgcolor="#80a26b">Accepted Claims ({$stats.listallaccepted|@count})</th>
</tr>
{foreach from=$stats.listallaccepted item=item}
<tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
<Td valign="top">{$item.title} {$item.forename} {$item.surname}</td>
<Td valign="top">{$item.add1}</td>
<Td valign="top">{$item.add2}</td>
<Td valign="top">{$item.add3}</td>
<Td valign="top">{$item.town}</td>
<Td valign="top">{$item.county}</td>
<Td valign="top">{$item.postcode}</td>
<Td valign="top">{$item.telephone}</td>
<Td valign="top">{$item.mobile}</td>
<Td valign="top">{$item.filename}</td>
<Td valign="top">{$item.comment}</td>
</tr>
{/foreach}


<tr>
<Th colspan="11" align="left" bgcolor="#c9aba2">Declined Claims ({$stats.listalldeclined|@count})</th>
</tr>
{foreach from=$stats.listalldeclined item=item}
<tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
<Td valign="top">{$item.title} {$item.forename} {$item.surname}</td>
<Td valign="top">{$item.add1}</td>
<Td valign="top">{$item.add2}</td>
<Td valign="top">{$item.add3}</td>
<Td valign="top">{$item.town}</td>
<Td valign="top">{$item.county}</td>
<Td valign="top">{$item.postcode}</td>
<Td valign="top">{$item.telephone}</td>
<Td valign="top">{$item.mobile}</td>
<Td valign="top">{$item.filename}</td>
<Td valign="top">{$item.comment}</td>
</tr>
{/foreach}
<tr>
<Th colspan="11" align="left" bgcolor="#a26b6b">Unable to Contact ({$stats.listallreturned|@count})</th>
</tr>
{foreach from=$stats.listallreturned item=item}
<tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
<Td valign="top">{$item.title} {$item.forename} {$item.surname}</td>
<Td valign="top">{$item.add1}</td>
<Td valign="top">{$item.add2}</td>
<Td valign="top">{$item.add3}</td>
<Td valign="top">{$item.town}</td>
<Td valign="top">{$item.county}</td>
<Td valign="top">{$item.postcode}</td>
<Td valign="top">{$item.telephone}</td>
<Td valign="top">{$item.mobile}</td>
<Td valign="top">{$item.filename}</td>
<Td valign="top">{$item.comment}</td>
</tr>
{/foreach}


<tr>
<Th colspan="11" align="left" bgcolor="#edac65">Still Trying to Contact ({$stats.listallwaiting|@count})</th>
</tr>
{foreach from=$stats.listallwaiting item=item}
<tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
<Td valign="top">{$item.title} {$item.forename} {$item.surname}</td>
<Td valign="top">{$item.add1}</td>
<Td valign="top">{$item.add2}</td>
<Td valign="top">{$item.add3}</td>
<Td valign="top">{$item.town}</td>
<Td valign="top">{$item.county}</td>
<Td valign="top">{$item.postcode}</td>
<Td valign="top">{$item.telephone}</td>
<Td valign="top">{$item.mobile}</td>
<Td valign="top">{$item.filename}</td>
<Td valign="top">{$item.comment}</td>
</tr>
{/foreach}





</table>


{/if}
