<?php
$this->breadcrumbs=array(
	'Claimant Csv Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClaimantCsvData', 'url'=>array('index')),
	array('label'=>'Create ClaimantCsvData', 'url'=>array('create')),
	array('label'=>'View ClaimantCsvData', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClaimantCsvData', 'url'=>array('admin')),
);
?>

<h1>Update ClaimantCsvData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>