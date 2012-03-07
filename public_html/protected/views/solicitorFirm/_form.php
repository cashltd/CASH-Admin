<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solicitor-firm-form',
	'enableAjaxValidation'=>true,
)); ?>


	<p>
		<label><?php echo $form->labelEx($model,'title'); ?></label><br />
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?> <?php echo $form->error($model,'title'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'address1'); ?></label><br />
		<?php echo $form->textField($model,'address1',array('size'=>60,'maxlength'=>255)); ?> <?php echo $form->error($model,'address1'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'address2'); ?></label><br />
		<?php echo $form->textField($model,'address2',array('size'=>60,'maxlength'=>255)); ?> <?php echo $form->error($model,'address2'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'area'); ?></label><br />
		<?php echo $form->textField($model,'area',array('size'=>60,'maxlength'=>255)); ?> <?php echo $form->error($model,'area'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'postcode'); ?></label><br />
		<?php echo $form->textField($model,'postcode',array('size'=>10,'maxlength'=>10)); ?> <?php echo $form->error($model,'postcode'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'telephone'); ?></label><br />
		<?php echo $form->textField($model,'telephone',array('size'=>50,'maxlength'=>50)); ?> <?php echo $form->error($model,'telephone'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'fax'); ?></label><br />
		<?php echo $form->textField($model,'fax',array('size'=>50,'maxlength'=>50)); ?> <?php echo $form->error($model,'fax'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'email'); ?></label><br />
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?> <?php echo $form->error($model,'email'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'web_address'); ?></label><br />
		<?php echo $form->textField($model,'web_address',array('size'=>60,'maxlength'=>255)); ?> <?php echo $form->error($model,'web_address'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'pipartners'); ?></label><br />
		<?php echo $form->textField($model,'pipartners'); ?> <?php echo $form->error($model,'pipartners'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'yearstrading'); ?></label><br />
		<?php echo $form->textField($model,'yearstrading'); ?> <?php echo $form->error($model,'yearstrading'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'offices'); ?></label><br />
		<?php echo $form->textField($model,'offices'); ?> <?php echo $form->error($model,'offices'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'status'); ?></label><br />		
		<?php echo $form->dropDownList($model,'status', CHtml::listData(SolicitorStatus::model()->findAll(), 'id', 'title'), array('prompt'=>'Select Solicitor Status')); ?> <?php echo $form->error($model,'status'); ?>
	</p><br/>

	<p>
		<label><?php echo $form->labelEx($model,'sectors'); ?></label><br />
		<?php echo $form->textField($model,'sectors',array('size'=>60,'maxlength'=>255)); ?> <?php echo $form->error($model,'sectors'); ?>
	</p><br/>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->