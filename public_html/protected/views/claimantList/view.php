<!-- Begin shortcut menu -->
	<ul id="shortcut">
	
	<li>
	  <a href="/solicitorContractDetails/downloadContract/id/" id="shortcut_home" title="Download Claimant Statistics">
	    <img src="/themes/cashadmin/images/shortcut/stats.png" alt="home"/><br/>
	    <strong>Stats</strong>
	  </a>
	</li>
	
	<li style="width: 20px;"></li>
	
	<li>
	  <a href="/solicitorContractDetails/downloadContract/id/" id="shortcut_home" title="New RTA Form">
	    <img src="/themes/cashadmin/images/shortcut/ktron.png" alt="home"/><br/>
	    <strong>RTA</strong>
	  </a>
	</li>
	
	<li>
	  <a href="/solicitorContractDetails/downloadContract/id/" id="shortcut_home" title="New PL Form">
	    <img src="/themes/cashadmin/images/shortcut/pl.png" alt="home"/><br/>
	    <strong>PL</strong>
	  </a>
	</li>
	
	<li>
	  <a href="/solicitorContractDetails/downloadContract/id/" id="shortcut_home" title="New EL Form">
	    <img src="/themes/cashadmin/images/shortcut/el.png" alt="home"/><br/>
	    <strong>EL</strong>
	  </a>
	</li>

	<li>
	  <a href="/solicitorContractDetails/downloadContract/id/" id="shortcut_home" title="New Assault Form">
	    <img src="/themes/cashadmin/images/shortcut/el.png" alt="home"/><br/>
	    <strong>Assault</strong>
	  </a>
	</li>

	<li>
	  <a href="/solicitorContractDetails/downloadContract/id/" id="shortcut_home" title="New Legal Enquiry Form">
	    <img src="/themes/cashadmin/images/shortcut/el.png" alt="home"/><br/>
	    <strong>Enquiry</strong>
	  </a>
	</li>
	
	<li>
	  <a href="/solicitorContractDetails/downloadContract/id/" id="shortcut_home" title="New Scottish Claim Form">
	    <img src="/themes/cashadmin/images/shortcut/el.png" alt="home"/><br/>
	    <strong>Scottish</strong>
	  </a>
	</li>


	</ul>
<!-- End shortcut menu -->

<br class="clear" />

<div class="twocolumn">

	<div class="column_left">
		<div class="header"><span>Claimant Details</span></div><br class="clear" />

		<div class="content">
			<?php $this->widget('zii.widgets.CDetailView', array(
				'data'=>$model,
				'attributes'=>array(
					'id',
					'title',
					'forename',
					'surname',
					'add1',
					'add2',
					'add3',
					'town',
					'county',
					'postcode',
					'telephone',
					'mobile',
					'email',
					'status',
					'campaign_id',
					'csv',
				),
			)); ?>
		</div>
	</div>

	<div class="column_right">
		<div class="header"><span>Claimant Location</span></div><br class="clear" />

		<div class="content" style="height: 369px;">
		    <div id="map_canvas" style="width:100%; height:100%; border: #CCC 1px solid; -moz-box-shadow: 2px 2px 3px #888; -webkit-box-shadow: 2px 2px 3px #888; box-shadow: 2px 2px 3px #888;"></div>
    <script type="text/javascript">
    
     	var latlng = new google.maps.LatLng(<?php print $model->lat; ?>, <?php print $model->long; ?>);
     
        var myOptions = {
          center: latlng,
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        var marker = new google.maps.Marker({
		    position: latlng,
		});
		
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);
            
        marker.setMap(map);
      
    </script>

		</div>
	</div>

</div>




<br class="clear" />

<div class="twocolumn">

	<div class="column_left">
		<div class="header"><span>Calls to this Claimant</span></div><br class="clear" />

		<div class="content">




		</div>
	</div>

	<div class="column_right">
		<div class="header"><span>Completed Claim Forms</span></div><br class="clear" />

		<div class="content">
		    
		</div>
	</div>

</div>
