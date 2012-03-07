<?php
$this->breadcrumbs=array(
	'Claimant Csv Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClaimantCsvData', 'url'=>array('index')),
	array('label'=>'Manage ClaimantCsvData', 'url'=>array('admin')),
);
?>

<h1>Create ClaimantCsvData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>