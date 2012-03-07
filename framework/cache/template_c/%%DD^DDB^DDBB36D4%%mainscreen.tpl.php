<?php /* Smarty version 2.6.14, created on 2012-02-14 16:50:48
         compiled from stats/mainscreen.tpl */ ?>
    <script type="text/javascript">

      drawChart = function() <?php echo '{'; ?>

        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');
        <?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name']):
?>
        data.addColumn('number', '<?php echo $this->_tpl_vars['name']; ?>
');
        <?php endforeach; endif; unset($_from); ?>
        data.addColumn('number', 'Month Average');
        data.addRows([
          <?php $_from = $this->_tpl_vars['stats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['date'] => $this->_tpl_vars['daystats']):
?>
           <?php if ($this->_tpl_vars['date'] != 'fullMonth'): ?>
            [new Date(<?php echo $this->_tpl_vars['daystats']['info']; ?>
), <?php $_from = $this->_tpl_vars['daystats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['datr'] => $this->_tpl_vars['info']):
 if ($this->_tpl_vars['datr'] != 'info'):  echo $this->_tpl_vars['info']['totalCalls']['all']; ?>
,<?php endif;  endforeach; endif; unset($_from); ?> <?php echo $this->_tpl_vars['averageCalls']; ?>
],
           <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?>
        ]);

        var options = <?php echo '{'; ?>

          width: '100%', height: '100%',
          title: 'Outgoing Calls in <?php echo $this->_tpl_vars['chartTitle']; ?>
',
          theme: 'maximized',
          legend: <?php echo '{'; ?>
position: 'in',<?php echo '}'; ?>
,
          titlePosition : 'in',
        <?php echo '}'; ?>
;

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      <?php echo '}'; ?>



    </script>
    
    <div id="chart_div" style="border: 0px black solid; height: 150px; width: 485px; background-color: white;"><b>Loading Statistics</b></b></div>