<?php
$this->breadcrumbs=array(
	'Claimant Lists',
);

$this->menu=array(
	array('label'=>'Create ClaimantList', 'url'=>array('create')),
	array('label'=>'Manage ClaimantList', 'url'=>array('admin')),
);
?>

<h1>Claimant Lists</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
