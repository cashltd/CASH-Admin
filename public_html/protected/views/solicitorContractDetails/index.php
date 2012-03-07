<?php
$this->breadcrumbs=array(
	'Solicitor Contract Details',
);

$this->menu=array(
	array('label'=>'Create SolicitorContractDetails', 'url'=>array('create')),
	array('label'=>'Manage SolicitorContractDetails', 'url'=>array('admin')),
);
?>

<h1>Solicitor Contract Details</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
