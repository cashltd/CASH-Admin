<?php
$this->breadcrumbs=array(
	'Solicitor Contacts',
);

$this->menu=array(
	array('label'=>'Create SolicitorContact', 'url'=>array('create')),
	array('label'=>'Manage SolicitorContact', 'url'=>array('admin')),
);
?>

<h1>Solicitor Contacts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
