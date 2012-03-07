<?php
$this->breadcrumbs=array(
	'Claimant Csv Datas',
);

$this->menu=array(
	array('label'=>'Create ClaimantCsvData', 'url'=>array('create')),
	array('label'=>'Manage ClaimantCsvData', 'url'=>array('admin')),
);
?>

<h1>Claimant Csv Datas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
