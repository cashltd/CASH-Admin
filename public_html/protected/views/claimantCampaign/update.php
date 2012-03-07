<?php
$this->breadcrumbs=array(
	'Claimant Campaigns'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ClaimantCampaign', 'url'=>array('index')),
	array('label'=>'Create ClaimantCampaign', 'url'=>array('create')),
	array('label'=>'View ClaimantCampaign', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ClaimantCampaign', 'url'=>array('admin')),
);
?>

<h1>Update ClaimantCampaign <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>