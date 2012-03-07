<?php
$this->breadcrumbs=array(
	'Solicitor Contract Payments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List SolicitorContractPayments', 'url'=>array('index')),
	array('label'=>'Create SolicitorContractPayments', 'url'=>array('create')),
	array('label'=>'Update SolicitorContractPayments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SolicitorContractPayments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SolicitorContractPayments', 'url'=>array('admin')),
);
?>

<h1>View SolicitorContractPayments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'contract_id',
		'amount',
		'date',
	),
)); ?>
