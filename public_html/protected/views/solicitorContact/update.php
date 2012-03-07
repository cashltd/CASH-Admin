<?php
$this->breadcrumbs=array(
	'Solicitor Contacts'=>array('index'),
	$model->Title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SolicitorContact', 'url'=>array('index')),
	array('label'=>'Create SolicitorContact', 'url'=>array('create')),
	array('label'=>'View SolicitorContact', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage SolicitorContact', 'url'=>array('admin')),
);
?>

<h1>Update SolicitorContact <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>