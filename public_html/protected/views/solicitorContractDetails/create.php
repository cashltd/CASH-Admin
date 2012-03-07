<?php
$this->breadcrumbs=array(
	'Solicitor Contract Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SolicitorContractDetails', 'url'=>array('index')),
	array('label'=>'Manage SolicitorContractDetails', 'url'=>array('admin')),
);
?>

<h1>Create SolicitorContractDetails</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>