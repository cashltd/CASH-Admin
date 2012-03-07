<?php
$this->breadcrumbs=array(
	'Solicitor Contacts'=>array('index'),
	$model->Title,
);

$this->menu=array(
	array('label'=>'List SolicitorContact', 'url'=>array('index')),
	array('label'=>'Create SolicitorContact', 'url'=>array('create')),
	array('label'=>'Update SolicitorContact', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete SolicitorContact', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SolicitorContact', 'url'=>array('admin')),
);
?>

<h1>View SolicitorContact #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'firm_id',
		'Title',
		'first_name',
		'surname',
		'address1',
		'address2',
		'area',
		'postcode',
		'telephone',
		'fax',
		'email',
	),
)); ?>
