<?php
$this->breadcrumbs=array(
	'Solicitor Contract Payments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SolicitorContractPayments', 'url'=>array('index')),
	array('label'=>'Manage SolicitorContractPayments', 'url'=>array('admin')),
);
?>

<h1>Create SolicitorContractPayments</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>