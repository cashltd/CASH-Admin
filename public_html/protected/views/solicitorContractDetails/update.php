<?php
$this->breadcrumbs=array(
	'Solicitor Contract Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SolicitorContractDetails', 'url'=>array('index')),
	array('label'=>'Create SolicitorContractDetails', 'url'=>array('create')),
	array('label'=>'View SolicitorContractDetails', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SolicitorContractDetails', 'url'=>array('admin')),
);
?>

<h1>Update SolicitorContractDetails <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>