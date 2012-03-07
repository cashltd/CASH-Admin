<?php /* Smarty version 2.6.14, created on 2012-02-15 09:12:02
         compiled from calendar/view.tpl */ ?>
<div id="calendarselect">
	<a href="javascript:;" id="sup1" class="selected" onclick="setsupplier('1')">Day</a>
	<a href="javascript:;" id="sup1" onclick="setsupplier('1')">Week</a>
	<a href="javascript:;" id="sup1" onclick="setsupplier('1')">Month</a>
</div>


<script>
<?php echo '
new Ajax.Updater(\'calendarView\', \'';  echo $this->_tpl_vars['HomeUrl'];  echo 'ajax/calendar_showCalendar/\', {});
'; ?>

</script>
<div id="calendarView">
ss

</div>