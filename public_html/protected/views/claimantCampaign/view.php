<h1>Campaign: <?php echo $model->title; ?></h1>
<i><?php echo $model->description; ?></i>


<div class="twocolumn" style="height: 487px;">

	<div style="float: left; width: 49%; padding: 0px;">
		<div class="onecolumn" style="margin: 0px;">
			<div class="header"><span>Campaign Details</span></div><br class="clear">
			<div class="content">
				<?php $this->widget('zii.widgets.CDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'id',
						'start_date',
						'finish_date',
					),
				)); ?>
			</div>
		</div>

		<div class="onecolumn">
			<div class="header"><span>CSV Files</span></div><br class="clear">
			<div class="content">
				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$model->csvDetails(),
					'hideHeader' => FALSE,
					'selectableRows'=>1,
					'selectionChanged'=>'function(id){ location.href = "/claimantCsvData/view/id/"+$.fn.yiiGridView.getSelection(id);}',
					'summaryText' => '',
					'columns'=>array(
						'filename',
						'timestamp',
						'cost'
				))); ?>
			</div>
		</div>
	</div>
	
	
	<div class="column_right" style="height: 502px;">
		<div class="header"><span>Campaign Statistics</span></div><br class="clear">
		<div class="content">
			
			<?php $this->Widget('ext.highcharts.HighchartsWidget', array(
				'options'=>array(
					'title' => array( 'text' => $model->title ),
					'credits' => array('enabled' => false),
					'exporting' => array('enabled' => false),
					'tooltip'=>array(
             			'formatter'=> 'js:function(){ return "<b>"+this.point.name+"</b>: "+this.percentage+"%"}'
        			),
        			'plotOptions'=>array(
			            'pie'=> array(
			                'allowPointSelect'=>true,
			                'cursor'=>'pointer',
			                'dataLabels'=>array(
			                	'enabled'=>true,
			                	'formatter'=> 'js:function(){ return "<b>"+this.point.name+"</b>: "+this.point.number+" ("+this.percentage+"%)"}'
			                ),
			                'showInLegend'=>true
			            )
			        ),
					'series' => array(
						array(
							'type' => 'pie',
							'name' => 'Pie Chart',
							'data' => $model->statistics(),
						)
					),
				)
			)); ?>
			
		</div>
	</div>
	
	
</div>

<br class="clear">

<div class="onecolumn">
	<div class="header">
		<span>Claimants in this Campaign</span>
	</div>
	<br class="clear">
	<div class="content">

				<?php $this->widget('zii.widgets.grid.CGridView', array(
					'dataProvider'=>$model->claimantDetails(),
					'hideHeader' => FALSE,
					'selectableRows'=>1,
					'selectionChanged'=>'function(id){ location.href = "/claimantList/view/id/"+$.fn.yiiGridView.getSelection(id);}',
					'summaryText' => '',
					'columns'=>array(
						'claimantStatus.title',
						'title',
						'forename',
						'surname',
						'add1',
						'town',
						'county',
						'postcode',
						'telephone',
						'mobile',
						
				))); ?>
	
	</div>
</div>

