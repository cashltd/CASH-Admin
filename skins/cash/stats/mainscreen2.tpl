    <script type="text/javascript">

      drawChartDaily = function() {literal}{{/literal}
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        {foreach from=$users item=name}
        data.addColumn('number', '{$name}');
        {/foreach}
        data.addRows([
          {foreach from=$stats key=endTime item=daystats}
           {if $date neq 'fullMonth'}
            ['{$endTime}', {foreach from=$daystats key=datr item=info}{$info},{/foreach}],
           {/if}
          {/foreach}
        ]);

        var options = {literal}{{/literal}
          width: '100%', height: '100%',
          title: 'Outgoing Calls today by Hour',
          theme: 'maximized',
          legend: {literal}{{/literal}position: 'in',{literal}}{/literal},
          titlePosition : 'in',
        {literal}}{/literal};

        var chart = new google.visualization.LineChart(document.getElementById('chart_div_Daily'));
        chart.draw(data, options);
      {literal}}{/literal}


    </script>
    
    <div id="chart_div_Daily" style="border: 0px black solid; height: 150px; width: 485px; background-color: white;"><b>Loading Statistics</b></b></div>
