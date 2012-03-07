<?php
$this->breadcrumbs=array(
	'Solicitor Contacts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SolicitorContact', 'url'=>array('index')),
	array('label'=>'Manage SolicitorContact', 'url'=>array('admin')),
);
?>

<h1>Create SolicitorContact</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>