<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'claimant-list-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'co_id'); ?>
		<?php echo $form->textField($model,'co_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'co_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'forename'); ?>
		<?php echo $form->textField($model,'forename',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'forename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'surname'); ?>
		<?php echo $form->textField($model,'surname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'surname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add1'); ?>
		<?php echo $form->textField($model,'add1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'add1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add2'); ?>
		<?php echo $form->textField($model,'add2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'add2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add3'); ?>
		<?php echo $form->textField($model,'add3',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'add3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'town'); ?>
		<?php echo $form->textField($model,'town',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'town'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'county'); ?>
		<?php echo $form->textField($model,'county',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'county'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'long'); ?>
		<?php echo $form->textField($model,'long'); ?>
		<?php echo $form->error($model,'long'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lat'); ?>
		<?php echo $form->textField($model,'lat'); ?>
		<?php echo $form->error($model,'lat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'campaign_id'); ?>
		<?php echo $form->textField($model,'campaign_id'); ?>
		<?php echo $form->error($model,'campaign_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'csv'); ?>
		<?php echo $form->textField($model,'csv'); ?>
		<?php echo $form->error($model,'csv'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->