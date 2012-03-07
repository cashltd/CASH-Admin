
	<div class="column_right">
		<div class="header">
			<span>Contact Details</span>
		</div><br class="clear">
		
		<div class="content">
		
			<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$data,
		'attributes'=>array(
			'title',
			'first_name',
			'surname',
			'address1',
			'address2',
			'area',
			'postcode',
			'telephone',
			'fax',
			'email',
		),
	)); ?>
	
		
		</div>
	</div>
	