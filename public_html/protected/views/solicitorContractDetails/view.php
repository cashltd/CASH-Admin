<!-- Begin shortcut menu -->
	<ul id="shortcut">
	
	<li>
	  <a href="/solicitorFirm/<?php print $model->firm_id; ?>" id="shortcut_home" title="Back to the Solicitor">
	    <img src="/themes/cashadmin/images/shortcut/home.png" alt="home"/><br/>
	    <strong>Solicitor</strong>
	  </a>
	</li>
	
	<li>
	  <a href="/solicitorContractDetails/downloadContract/id/<?php print $model->id; ?>" id="shortcut_home" title="Download this Contract">
	    <img src="/themes/cashadmin/images/shortcut/posts.png" alt="home"/><br/>
	    <strong>Contract</strong>
	  </a>
	</li>
	
	<li>
	  <a href="/solicitorContractDetails/downloadContract/id/<?php print $model->id; ?>" id="shortcut_home" title="Download Contract Statistics">
	    <img src="/themes/cashadmin/images/shortcut/stats.png" alt="home"/><br/>
	    <strong>Stats</strong>
	  </a>
	</li>

	</ul>
<!-- End shortcut menu -->
			
<br class="clear"/>

<div class="twocolumn">

	<div class="column_left">
		<div class="header"><span>Contract Details</span></div><br class="clear">
		
		<div class="content">


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'firm_id',
		array('label'=>'start_date', 'value'=>date('d/m/Y', strtotime($model->start_date))),
		array('label'=>'finish_date', 'value'=>date('d/m/Y', strtotime($model->finish_date))),
		'monthly_leads',
		'contract_length',
		array('label' => 'Price Per Lead', 'value' => '£'.$model->price_per_lead),
		array('label'=>'VAT Rate', 'value'=>$model->vat_rate.'%'),
		array('label' => 'Joining Fee', 'value' => '£'.$model->joining_fee),
		'status',
		array('label'=>'Total', 'value'=>'£'.$model->totalToDate().' / £'.$model->contractTotalCost()),
	),
)); ?>
		</div>
	</div>


	<div class="column_right">
		<div class="header"><span>Payments Made</span>
			<div class="switch" style="width:24px">
			<a href="/solicitorContractPayments/create"><img src="/themes/cashadmin/images/addButton.png" style="margin-top: 6px;"></a>
			</div>
		</div><br class="clear">		
		<div class="content">
			<?php
			$paymentModel = $model->paymentsMade();
			$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$paymentModel,
			'hideHeader' => FALSE,

			'summaryText' => '<b>Total Contract Payments:</b> £'.$model->totalToDate(),
			'columns'=>array(
				'date',
				'amount'
		))); ?>
		</div>
	</div>


</div>

<br class="clear">

<div class="twocolumn">

	<div class="column_left">
		<div class="header"><span>Lead Statistics</span>
			<div class="switch" style="width:150px">
				<table width="150px" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td>
							<input type="button" id="lead_stats_week" name="lead_stats_week" class="left_switch active" value="Week" style="width:50px"/>
						</td>
						<td>
							<input type="button" id="lead_stats_month" name="lead_stats_month" class="middle_switch" value="Month" style="width:50px"/>
						</td>
						<td>
							<input type="button" id="lead_stats_year" name="lead_stats_year" class="right_switch" value="Year" style="width:50px"/>
						</td>
					</tr>
				</tbody>
				</table>
			</div>
		</div><br class="clear">
		<div class="content">
		
		
		
		
		
			<?php $this->Widget('ext.highcharts.HighchartsWidget', array(
				'options'=>array(
					'title' => array( 'text' => '' ),
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
							'data' => $model->leadStatistics(),
						)
					),
				)
			)); ?>
		
		
		</div>
	</div>


	<div class="column_right">
		<div class="header"><span>Sent Leads</span>
			<div class="switch" style="width:150px">
				<table width="150px" cellpadding="0" cellspacing="0">
				<tbody>
					<tr>
						<td>
							<input type="button" id="chart_bar" name="chart_bar" class="left_switch active" value="Week" style="width:50px"/>
						</td>
						<td>
							<input type="button" id="chart_area" name="chart_area" class="middle_switch" value="Month" style="width:50px"/>
						</td>
						<td>
							<input type="button" id="chart_pie" name="chart_pie" class="right_switch" value="Year" style="width:50px"/>
						</td>
					</tr>
				</tbody>
				</table>
			</div>
		</div><br class="clear">
		<div class="content">
		
		<?php
		
			$this->Widget('ext.highcharts.HighchartsWidget', array(
				'options'=>array(
					'title' => array('text' => ''),
					'credits' => array('enabled' => false),
					'exporting' => array('enabled' => false),
					'xAxis' => array(

						'categories' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday')
					),
						'yAxis' => array(
							'title' => array('text' => 'Leads Sent')
					),
					'series' => array(
						array('name' => 'Leads', 'data' => array(1, 0, 4, 0, 1))
					)
				)
			));
		
		?>
		
		
		
		</div>
	</div>


</div><br class="clear"/>

<div class="onecolumn">


		<div class="header"><span>Assigned Claimants</span></div><br class="clear">
		
		<div class="content">


			<?php
			$this->widget('zii.widgets.grid.CGridView', array(
			'dataProvider'=>$model->claimantListView(),
			'hideHeader' => FALSE,
			'selectableRows'=>1,
			'selectionChanged'=>'function(id){ location.href = "/claimantList/"+$.fn.yiiGridView.getSelection(id);}',
			'summaryText' => '',
			'columns'=>array(
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

<br class="clear"/>
