<div class="onecolumn">

	<div class="header">
		<span>Solicitor List</span>
	</div><br class="clear">
	
	<div class="content">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		'title',
		'area',
		'telephone',
		'fax',
		'email',
		'solicitorStatus.title',
		array(
			'class'=>'CButtonColumn',
		),
))); ?>




	</div>

</div>
