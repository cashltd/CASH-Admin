<?php
$this->breadcrumbs=array(
	'Claimant Lists'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClaimantList', 'url'=>array('index')),
	array('label'=>'Manage ClaimantList', 'url'=>array('admin')),
);
?>

<h1>Create ClaimantList</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>