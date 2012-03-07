<?php if ($model->email_marketing==1) { ?>
<div class="alert_warning">
	<p>
		<img src="/themes/cashadmin/images/icon_warning.png" class="mid_align"/>
		<b>Do not</b> contact this solicitor using E-Mail Marketing Templates!
	</p>
</div>
<?php } ?>

<h1><?php echo $model->title; ?></h1>



<div class="twocolumn">
	<div class="column_left">
		<div class="header">
			<span>Firm Details</span>
			<div class="switch" style="width:60px">
			<a href="/solicitorFirm/update/<?php echo $model->id; ?>"><img title="Edit this Firm" src="/themes/cashadmin/images/edit-icon.png" style="margin-top: 6px;"></a>
			<a href="/solicitorContact/create/<?php echo $model->id; ?>"><img title="Add New Contact" src="/themes/cashadmin/images/addButton.png" style="margin-top: 6px; margin-left: 10px;"></a>
			</div>
		</div><br class="clear">
		
		<div class="content">
		
		<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'id',
			'added',
			'address1',
			'address2',
			'area',
			'postcode',
			'telephone',
			'fax',
			array('name'=>'email', 'type'=>'raw', 'value'=>CHtml::link($model->email, '/internalMail/'.urlencode($model->email), array('class'=>'modalPopup'))),
			array('name'=>'Web Address', 'type'=>'raw', 'value'=>CHtml::link($model->web_address, $model->web_address)),
			'pipartners',
			'yearstrading',
			'offices',
			'solicitorStatus.title',
			'sectors',
		),
		)); ?>
	
		
		</div>
	</div>
	
	

	<?php 
	$i = 0;
	foreach ($model->solicitorContacts() as $scModel) {
	?>
	
	<div class="column_right" style="margin-bottom: 10px">
		<div class="header">
			<span><?php echo $scModel->Title; ?> <?php echo $scModel->first_name; ?> <?php echo $scModel->surname; ?></span>
		</div><br class="clear">
		
		<div class="content"<?php if ($i > 0) { ?> style="display: none;"<?php } ?>>
		
	<?php
	 $this->widget('zii.widgets.CDetailView', array(
		'data'=>$scModel,
		'attributes'=>array(
			'address1',
			'address2',
			'area',
			'postcode',
			'telephone',
			'fax',
			array('name'=>'email', 'type'=>'raw', 'value'=>CHtml::link($scModel->email, '/internalMail/'.urlencode($scModel->email), array('class'=>'modalPopup'))),
		),
		));
	?>
	
		</div>
	</div>
	
	<?php
	$i++;
	}
	?>


	
</div><br class="clear" />




<div class="twocolumn">
	
	<div class="column_left">
		<div class="header"><span>Notes</span></div>
		<br class="clear" />
		
		<div class="content">
			<?php
			$noteModel = new CArrayDataProvider($model->solicitorNotes(), array());
			
			$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$noteModel,
			'hideHeader' => TRUE,
			'summaryText' => '',
			'columns'=>array(
				array('name'=>'User', 'value'=>'sad'),
				'note',
		))); ?>
		</div>
	</div>


	<div class="column_right">
		<div class="header"><span>Contracts</span>
			<div class="switch" style="width:24px">
			<a href="/solicitorContractDetails/create"><img src="/themes/cashadmin/images/addButton.png" style="margin-top: 6px;"></a>
			</div>
		</div>
		<br class="clear" />
		
		<div class="content">
			<?php
			$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$model->solicitorContractsModel(),
			'hideHeader' => FALSE,
			'selectableRows'=>1,
			'selectionChanged'=>'function(id){ location.href = "/solicitorContractDetails/"+$.fn.yiiGridView.getSelection(id);}',
			'summaryText' => '',
			'columns'=>array(
				'contractStatus.title',
				'start_date',
				'finish_date',
				'monthly_leads',
		))); ?>
		</div>
	</div>


</div><br class="clear" />



