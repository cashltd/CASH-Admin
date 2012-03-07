<?php
$this->breadcrumbs=array(
	'Claimant Campaigns',
);

$this->menu=array(
	array('label'=>'Create ClaimantCampaign', 'url'=>array('create')),
	array('label'=>'Manage ClaimantCampaign', 'url'=>array('admin')),
);
?>

<h1>Claimant Campaigns</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
