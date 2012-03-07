<?php
$this->breadcrumbs=array(
	'Claimant Lists'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClaimantList', 'url'=>array('index')),
	array('label'=>'Create ClaimantList', 'url'=>array('create')),
	array('label'=>'View ClaimantList', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClaimantList', 'url'=>array('admin')),
);
?>

<h1>Update ClaimantList <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>