	var json;
	var timer;
	var inboxpage = 0;
	var blackwindow = 0;
	var messagecount = 0;

	function getAlerts() {
		new Ajax.Request('http://'+ document.domain +'/api/updateAlertBadge/id/' + inboxpage + '/', {
 		 onSuccess: function(transport) {
 		   json = transport.responseText.evalJSON();
			 updateAlertBadge();
 		 }
		});
	}

	function updateAlertBadge() {
		if (json.mustAlert === "TRUE" && blackwindow === 0) {
			mustAlert();
		}
	
		if (inboxpage === 1) {
			if (json.message.length > messagecount) {
				messagecount = json.message.length;
				populate();
			}
		}
	
		$('alertCount').update(json.messageCount);
		timer = setTimeout("getAlerts()",30000);
	}
	
	function mustAlert() {
		blackwindow = 1;
		
		
		
		var $dialog = $j('<div></div>')
	    .html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 50px 0;"></span>You have received a new message from <span id="alertUserName">'+json.alertName+'</span>.<br /><Br /> To view this message click the "view" button below. To hide this message click the "hide" button below <b>but do not forget</b> to read this message, it could be important!</p>')
	    .dialog({
	        autoOpen: false,
	        title: "You have a new message!",
	        resizable: false,
	        draggable: false,
	        height: 195,
	        width: 450,
	        modal: true,
	        buttons: {
	            "View": function() {
	                findArrayID = 0;

									for (i=0; i < json.message.length; i++) {
										if (json.message[i].id == json.alertID) {
											findArrayID = i;
										}
									}

									$j(this).load('http://'+ document.domain +'/api/messageViewed/id/'+json.alertID+'/', null,
	                function(responseText) {
	                    window.location = "http://"+ document.domain +"/alerts/view/id/"+json.alertID+":"+findArrayID+"/";
											$j(this).dialog("close");
	            		})

	            },
	            "Hide": function() {
	                $j(this).load('http://'+ document.domain +'/api/messageViewed/id/'+json.alertID+'/', null,
	                function(responseText) {
	                    doAlert("DO NOT forget to read your messages!");
	                    $j(this).dialog("close");
	            		})
							}
	        }
	    });

	    $dialog.dialog('open');
		

		$('hideAlertButton').observe("click", function() {
			hideAlertMessage(json.alertID);
		});
		$('viewAlertButton').observe("click", function() {
			viewAlertMessage(json.alertID);
		});
		
	}
	
	function hideAlertMessage(id) {
			new Ajax.Request('http://'+ document.domain +'/api/messageViewed/id/'+id+'/', {
 			 onSuccess: function(transport) {
				$('bigAndBlack').fade({duration: 0});
				$('alertMessage').fade({duration: 0});
 			 }
			});
	}
	
	function viewAlertMessage(id) {

			findArrayID = 0;
			
			for (i=0; i < json.message.length; i++) {
				if (json.message[i].id == id) {
					findArrayID = i;
				}
			}
	
			new Ajax.Request('http://'+ document.domain +'/api/messageViewed/id/'+id+'/', {
 			 onSuccess: function(transport) {
				window.location = "http://"+ document.domain +"/alerts/view/id/"+id+":"+findArrayID+"/";
 			 }
			});
	}
	
	function markMessageRead(id,arrayid) {
		if (json.message[arrayid].read === "0") {
			new Ajax.Request('http://'+ document.domain +'/api/messageView/id/'+id+'/', {
 			 onSuccess: function(transport) {
 			 	json.message[arrayid].read = "1";
 			 	$('inboxMessage'+id).removeClassName('unread');
				Effect.toggle('message'+id,'blind');
 			 }
			});
		} else {
			Effect.toggle('message'+id+'','blind');
		}
	}
	
	
	function oneAlert(message,arrayid) {
		if (message.read === '0') {
			extraclass = " unread";
		} else {
			extraclass = "";
		}
		
			$('alertInbox').insert("<div class='inboxMessage"+extraclass+"' id='inboxMessage"+message.id+"' onClick='markMessageRead("+message.id+","+arrayid+");'><div class='title'>" + message.title + "</div><div class='date'>" + message.time + "</div><div class='from'>" + message.from + "</div><div id='message"+message.id+"' class='message' style='display: none;'><div class='paddy'>"+message.message+"</div></div></div>");
	
	}
	
	function populate() {
		$('alertInbox').update('');
		for (i=0; i < json.message.length; i++) {
			oneAlert(json.message[i], i);
		}
	}
	
	function populateInbox() {
		inboxpage = 1;
	}
	
	
	
	function makeStats(myjson) {
	
		printStats = "<li><strong>Allocated Claims:</strong> "+myjson.Allocated+"</li>";
		printStats = printStats + "<li><strong>Messages Left:</strong> "+myjson.LeftMessage+"</li>";
		printStats = printStats + "<li><strong>Accepted Claims:</strong> "+myjson.Accepted+"</li>";
		printStats = printStats + "<li>&nbsp;</li>";
		printStats = printStats + "<li><strong>Text Messages Sent:</strong> "+myjson.SMSs+"</li>";
		printStats = printStats + "<li><strong>Callbacks Set:</strong> "+myjson.Callback+"</li>";
		printStats = printStats + "<li><strong>No Answers:</strong> "+myjson.NoAnswer+"</li>";
		printStats = printStats + "<li><strong>Declined Claims:</strong> "+myjson.Declined+"</li>";
		printStats = printStats + "<li>&nbsp;</li>";

		printStats = printStats + "<li><strong>Phone Calls Made:</strong> "+myjson.TotalCalls+"</li>";
		printStats = printStats + "<li>&nbsp;</li>";
		

extrastats = "";

for (i=0; i < myjson.users.length; i++) {
 if (myjson.users[i].TotalCalls > 0) {
		tempStats = "<li><strong>Allocated Claims:</strong> "+myjson.users[i].Allocated+"</li>";
		tempStats = tempStats + "<li><strong>Messages Left:</strong> "+myjson.users[i].LeftMessage+"</li>";
		tempStats = tempStats + "<li><strong>Accepted Claims:</strong> "+myjson.users[i].Accepted+"</li>";
		tempStats = tempStats + "<li>&nbsp;</li>";
		tempStats = tempStats + "<li><strong>Text Messages Sent:</strong> "+myjson.users[i].SMSs+"</li>";
		tempStats = tempStats + "<li><strong>Callbacks Set:</strong> "+myjson.users[i].Callback+"</li>";
		tempStats = tempStats + "<li><strong>No Answers:</strong> "+myjson.users[i].NoAnswer+"</li>";
		tempStats = tempStats + "<li><strong>Declined Claims:</strong> "+myjson.users[i].Declined+"</li>";
		tempStats = tempStats + "<li>&nbsp;</li>";

		tempStats = tempStats + "<li><strong>Phone Calls Made:</strong> "+myjson.users[i].TotalCalls+"</li>";
		tempStats = tempStats + "<li><strong>Average Call Time:</strong> "+myjson.users[i].Average+"</li>";


		extrastats = extrastats + "<div class='statheadx'>"+myjson.users[i].name+"</div><div class='actualstats'><UL class='statlist'>"+tempStats+"</UL></div>"
	}
}



	
	
		$('statsinfo').update("<div id='statistics'><div class='stathead'>Statistics for this period</div><div class='actualstats'><UL class='statlist'>"+printStats+"</UL></div>"+extrastats+"</div>");
	}
	
	
		
	function viewStats() {
		$('statsinfo').update('<center><img src="http://'+ document.domain +'/skins/cash/images/loadblackbg.gif" style="margin: 9px;"></center>');
		$('statsholder').appear({duration: 0.3});
		
		
		new Ajax.Request('http://'+ document.domain +'/api/returnActions/', {
 			 onSuccess: function(transport) {
 			 	myjson = transport.responseText.evalJSON();
 				makeStats(myjson);
 			 }
			});
		
		
	}
	
	function hideStats() {
		$('statsholder').fade({duration: 0.3});
	}
	
	
	addLoadEvent( function() { 
		getAlerts();
	});
