<?php
$this->breadcrumbs=array(
	'Solicitor Contract Payments',
);

$this->menu=array(
	array('label'=>'Create SolicitorContractPayments', 'url'=>array('create')),
	array('label'=>'Manage SolicitorContractPayments', 'url'=>array('admin')),
);
?>

<h1>Solicitor Contract Payments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
