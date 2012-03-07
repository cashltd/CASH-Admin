<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solicitor-contract-details-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'firm_id'); ?>
		<?php echo $form->textField($model,'firm_id'); ?>
		<?php echo $form->error($model,'firm_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php echo $form->textField($model,'start_date'); ?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'finish_date'); ?>
		<?php echo $form->textField($model,'finish_date'); ?>
		<?php echo $form->error($model,'finish_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monthly_leads'); ?>
		<?php echo $form->textField($model,'monthly_leads'); ?>
		<?php echo $form->error($model,'monthly_leads'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contract_length'); ?>
		<?php echo $form->textField($model,'contract_length'); ?>
		<?php echo $form->error($model,'contract_length'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price_per_lead'); ?>
		<?php echo $form->textField($model,'price_per_lead'); ?>
		<?php echo $form->error($model,'price_per_lead'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vat_rate'); ?>
		<?php echo $form->textField($model,'vat_rate'); ?>
		<?php echo $form->error($model,'vat_rate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'joining_fee'); ?>
		<?php echo $form->textField($model,'joining_fee'); ?>
		<?php echo $form->error($model,'joining_fee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->