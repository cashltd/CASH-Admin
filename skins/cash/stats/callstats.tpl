    
    <script type="text/javascript">

      google.load("visualization", "1", {literal}{{/literal}packages:["corechart"]{literal}}{/literal});
      google.load('visualization', '1', {literal}{{/literal}packages:['table']{literal}}{/literal});
      google.setOnLoadCallback(drawChart);
      function drawChart() {literal}{{/literal}
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');
        {foreach from=$users item=name}
        data.addColumn('number', '{$name}');
        {/foreach}
        data.addColumn('number', 'Month Average');
        data.addRows([
          {foreach from=$stats key=date item=daystats}
           {if $date neq 'fullMonth'}
            [new Date({$daystats.info}), {foreach from=$daystats key=datr item=info}{if $datr neq 'info'}{$info.totalCalls.all},{/if}{/foreach} {$averageCalls}],
           {/if}
          {/foreach}
        ]);

        var options = {literal}{{/literal}
          width: '100%', height: '100%',
          title: 'Outgoing Calls in {$chartTitle}',
          theme: 'maximized',
          legend: {literal}{{/literal}position: 'in',{literal}}{/literal},
          titlePosition : 'in',
        {literal}}{/literal};

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      {literal}}{/literal}
      
      
            google.setOnLoadCallback(callSplit);
      function callSplit() {literal}{{/literal}
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Call Type');
        data.addColumn('number', 'Total');
        data.addRows([
          ['Mobiles',    {$callTypes.mobile}],
          ['Landlines',      {$callTypes.landline}],
        ]);

        var options = {literal}{{/literal}
          width: '100%', height: '100%',
          is3D: true,
          theme: 'maximized',
          title: 'Call Types for {$chartTitle}'
        {literal}}{/literal};

        var chart = new google.visualization.PieChart(document.getElementById('callSplit_div'));
        chart.draw(data, options);
      {literal}}{/literal}
      
      
      
            
      google.setOnLoadCallback(drawTable);
      function drawTable() {literal}{{/literal}
        var data = new google.visualization.DataTable();
        
        data.addColumn('date', 'Date');
        data.addColumn('number', 'Total Calls');
        data.addColumn('number', 'Landline');
        data.addColumn('number', 'Mobile');
        data.addColumn('number', 'HKs');
        data.addColumn('number', 'Data');
        data.addColumn('number', 'Cost');
        
        data.addRows({$googleTable.rows});
        
        {foreach from=$googleTable.data key=key item=details}
        data.setCell({$key}, 0, new Date({$details.0}));
        	data.setCell({$key}, 1, {$details.1});
        	data.setCell({$key}, 2, {$details.2});
        	data.setCell({$key}, 3, {$details.3});
        	data.setCell({$key}, 4, {$details.4});
        	data.setCell({$key}, 5, {$details.5});
        	data.setCell({$key}, 6, {$details.6.number}, '£{$details.6.cost}');
        {/foreach}
        
        var options = {literal}{{/literal}
          height: '100%',
          showRowNumber: false
        {literal}}{/literal};
        
        var table = new google.visualization.Table(document.getElementById('dailyList_div'));
        table.draw(data, options);
      {literal}}{/literal}
      
    </script>
    
    {$fullMonth.totalCalls}
    
    <div style="width: 1200px">
    
    	<div id="chart_div" style="border: 0px black solid; height: 300px; width: 590px; float: left; margin: 5px;"></div>
    
       	<div id="dailyList_div" style="border: 0px black solid; width: 590px; height: 300px; float: right; margin: 5px;"></div>
    	
    	<br style="clear: both;" /><br style="clear: both;" />
    	
    	<div id="callSplit_div" style="border: 0px black solid; width: 390px; height: 300px; float: left; margin: 5px;"></div>
    	
    </div>
    
    
     <br style="clear: both;">
    