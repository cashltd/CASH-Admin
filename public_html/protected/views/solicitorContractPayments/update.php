<?php
$this->breadcrumbs=array(
	'Solicitor Contract Payments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SolicitorContractPayments', 'url'=>array('index')),
	array('label'=>'Create SolicitorContractPayments', 'url'=>array('create')),
	array('label'=>'View SolicitorContractPayments', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SolicitorContractPayments', 'url'=>array('admin')),
);
?>

<h1>Update SolicitorContractPayments <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>