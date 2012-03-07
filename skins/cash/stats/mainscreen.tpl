    <script type="text/javascript">

      drawChart = function() {literal}{{/literal}
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


    </script>
    
    <div id="chart_div" style="border: 0px black solid; height: 150px; width: 485px; background-color: white;"><b>Loading Statistics</b></b></div>
