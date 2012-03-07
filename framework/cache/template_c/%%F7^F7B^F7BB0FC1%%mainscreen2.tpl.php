<?php /* Smarty version 2.6.14, created on 2012-02-14 16:50:48
         compiled from stats/mainscreen2.tpl */ ?>
    <script type="text/javascript">

      drawChartDaily = function() <?php echo '{'; ?>

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        <?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name']):
?>
        data.addColumn('number', '<?php echo $this->_tpl_vars['name']; ?>
');
        <?php endforeach; endif; unset($_from); ?>
        data.addRows([
          <?php $_from = $this->_tpl_vars['stats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['endTime'] => $this->_tpl_vars['daystats']):
?>
           <?php if ($this->_tpl_vars['date'] != 'fullMonth'): ?>
            ['<?php echo $this->_tpl_vars['endTime']; ?>
', <?php $_from = $this->_tpl_vars['daystats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['datr'] => $this->_tpl_vars['info']):
 echo $this->_tpl_vars['info']; ?>
,<?php endforeach; endif; unset($_from); ?>],
           <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?>
        ]);

        var options = <?php echo '{'; ?>

          width: '100%', height: '100%',
          title: 'Outgoing Calls today by Hour',
          theme: 'maximized',
          legend: <?php echo '{'; ?>
position: 'in',<?php echo '}'; ?>
,
          titlePosition : 'in',
        <?php echo '}'; ?>
;

        var chart = new google.visualization.LineChart(document.getElementById('chart_div_Daily'));
        chart.draw(data, options);
      <?php echo '}'; ?>



    </script>
    
    <div id="chart_div_Daily" style="border: 0px black solid; height: 150px; width: 485px; background-color: white;"><b>Loading Statistics</b></b></div>