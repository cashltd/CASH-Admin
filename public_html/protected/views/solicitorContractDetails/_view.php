<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firm_id')); ?>:</b>
	<?php echo CHtml::encode($data->firm_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_date')); ?>:</b>
	<?php echo CHtml::encode($data->start_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('finish_date')); ?>:</b>
	<?php echo CHtml::encode($data->finish_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('monthly_leads')); ?>:</b>
	<?php echo CHtml::encode($data->monthly_leads); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contract_length')); ?>:</b>
	<?php echo CHtml::encode($data->contract_length); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_per_lead')); ?>:</b>
	<?php echo CHtml::encode($data->price_per_lead); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('vat_rate')); ?>:</b>
	<?php echo CHtml::encode($data->vat_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('joining_fee')); ?>:</b>
	<?php echo CHtml::encode($data->joining_fee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>