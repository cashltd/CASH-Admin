<?php
$this->breadcrumbs=array(
	'Claimant Csv Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ClaimantCsvData', 'url'=>array('index')),
	array('label'=>'Create ClaimantCsvData', 'url'=>array('create')),
	array('label'=>'Update ClaimantCsvData', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete ClaimantCsvData', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClaimantCsvData', 'url'=>array('admin')),
);
?>

<h1>View ClaimantCsvData #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'data',
		'filename',
		'timestamp',
		'cost',
		'campaign_id',
	),
)); ?>
