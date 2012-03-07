<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'firm_id'); ?>
		<?php echo $form->textField($model,'firm_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'finish_date'); ?>
		<?php echo $form->textField($model,'finish_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'monthly_leads'); ?>
		<?php echo $form->textField($model,'monthly_leads'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contract_length'); ?>
		<?php echo $form->textField($model,'contract_length'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_per_lead'); ?>
		<?php echo $form->textField($model,'price_per_lead'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vat_rate'); ?>
		<?php echo $form->textField($model,'vat_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'joining_fee'); ?>
		<?php echo $form->textField($model,'joining_fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->