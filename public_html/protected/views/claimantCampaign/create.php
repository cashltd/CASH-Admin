<?php
$this->breadcrumbs=array(
	'Claimant Campaigns'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ClaimantCampaign', 'url'=>array('index')),
	array('label'=>'Manage ClaimantCampaign', 'url'=>array('admin')),
);
?>

<h1>Create ClaimantCampaign</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>