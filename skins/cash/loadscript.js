
if (!window.console) console = {};
console.log = console.log ||
function() {};
console.warn = console.warn ||
function() {};
console.error = console.error ||
function() {};
console.info = console.info ||
function() {};

google.load("visualization", "1", {packages:["corechart"]});

var claimp = new Ajax.PeriodicalUpdater('counter', 'http://' + document.domain + '/ajax/voip_timeSinceLastCall/', {
  method: 'get', frequency: 1});




function stripCharacter(words, character) {
    //documentation for this script at http://www.shawnolson.net/a/499/
    var spaces = words.length;
    for (var x = 1; x < spaces; ++x) {
        words = words.replace(character, "");
    }
    return words;
}

function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
        window.onload = func;
    } else {
        window.onload = function() {
            if (oldonload) {
                oldonload();
            }
            func();
        }
    }
}


function voip_makeCall(name, number, clientID) {




    new Ajax.Request('http://' + document.domain + '/ajax/voip_makeCall/id/' + name + '||' + number + '/', {
        onSuccess: function(transport) {
        
        	if (transport.responseText.match(/Success/))
        		showClientPanel(clientID);
        	else
        		alert("Failed to Dial - Please call manually!");
        }
    });
}



function freshdata_goRecoverHotkey(id) {

    new Ajax.Request('http://' + document.domain + '/ajax/datasuppliers_goRecoverHotkey/id/' + id + '/', {
        onSuccess: function(transport) {
            Modalbox.hide();
            doAlert("Hotkey has been Recovered");
            refreshAll();
        }
    });
}

function freshdata_recoverHotkey(id, title) {

    cltitle = "Recover Hotkey: " + title + "?";

    Modalbox.show('<div class=\'warning\'><p>Are you sure to recover this hotkey?</p> <input type=\'button\' value=\'Yes!\' onclick="freshdata_goRecoverHotkey(\'' + id + '\')" /> <input type=\'button\' value=\'No!\' onclick=\'Modalbox.hide()\' /></div>', {
        title: cltitle,
        width: 300
    });

}

function freshdata_goConfirmHotkey(id) {

    new Ajax.Request('http://' + document.domain + '/ajax/datasuppliers_goConfirmHotkey/id/' + id + '/', {
        onSuccess: function(transport) {
            Modalbox.hide();
            doAlert("Hotkey has been Confirmed as claiming");
            refreshAll();
        }
    });
}

function freshdata_confirmHotkey(id, title) {

    cltitle = "Confirm Hotkey: " + title + "?";

    Modalbox.show('<div class=\'warning\'><p>Are you sure you want to mark this hotkey as <b>claiming</b>?</p> <input type=\'button\' value=\'Yes!\' onclick="freshdata_goConfirmHotkey(\'' + id + '\')" /> <input type=\'button\' value=\'No!\' onclick=\'Modalbox.hide()\' /></div>', {
        title: cltitle,
        width: 300
    });

}

function freshdata_goRemoveHotkey() {

    $('removeForm').request({
        onComplete: function() {
            Modalbox.hide();
            doAlert("Hotkey has been marked for deletion");
            refreshAll();
        }
    })

}

function freshdata_removeHotkey(id, title) {

    cltitle = "Remove Hotkey: " + title + "?";

    Modalbox.show('<form id=\'removeForm\' method=\'post\' action=\'http://' + document.domain + '/ajax/datasuppliers_goRemoveHotkey/id/' + id + '/\'><div class=\'warning\'><p>To mark this claim for deletion please give a reason below.</p><p><textarea name=\'comment\' class=\'decPopup\'></textarea></p><input type=\'Button\' value=\'Decline\' onclick=\'freshdata_goRemoveHotkey()\' /> <input type=\'button\' value=\'Cancel\' onclick=\'Modalbox.hide()\' /></div></form>', {
        title: cltitle,
        width: 600
    });

}

function freshdata_goDeclineHotkey() {

    $('removeForm').request({
        onComplete: function() {
            Modalbox.hide();
            doAlert("Hotkey has been Confirmed as NOT claiming");
            refreshAll();
        }
    })

}

function addNewHotkey() {

    cltitle = "Add new hotkey data!";

    Modalbox.show('http://' + document.domain + '/ajax/datasuppliers_goAddHotkey/', {
        title: cltitle,
        width: 600
    });

}

function changePassword() {

    cltitle = "Change Password!";

    Modalbox.show('http://' + document.domain + '/ajax/login_changePassword/', {
        title: cltitle,
        width: 600
    });

}

function goChangePassword() {

    $('changePasswordForm').request({
        onComplete: function(transport) {
            Modalbox.hide();

            doAlert("Your password has now been changed! Please remember it!");
        }
    })

}

function viewHotkey(id) {

    cltitle = "Viewing hotkey data!";

    Modalbox.show('http://' + document.domain + '/ajax/datasuppliers_goViewHotkey/id/' + id + '/', {
        title: cltitle,
        width: 600
    });

}

function submit_addNewHotkey() {

    $('addHotkeyForm').request({
        onComplete: function() {
            Modalbox.hide();
            doAlert("Hotkey data has now been added");
        }
    })

}

function freshdata_declineHotkey(id, title) {

    cltitle = "Remove Hotkey: " + title + "?";

    Modalbox.show('<form id=\'removeForm\' method=\'post\' action=\'http://' + document.domain + '/ajax/datasuppliers_goDeclineHotkey/id/' + id + '/\'><div class=\'warning\'><p>To mark this claim as not claiming please give a reason below.</p><p><textarea name=\'comment\' class=\'decPopup\'></textarea></p><input type=\'Button\' value=\'Decline\' onclick=\'freshdata_goRemoveHotkey()\' /> <input type=\'button\' value=\'Cancel\' onclick=\'Modalbox.hide()\' /></div></form>', {
        title: cltitle,
        width: 600
    });

}

function makeUsername() {


    var fullname = $('fnames').value.toLowerCase() + $('snames').value.toLowerCase();
    var fullnamer = stripCharacter(fullname, " ");

    $('usernamebox').value = fullnamer;
    $('usernamet').show()
}

function checkUsername() {
    var namecheck = $('usernamebox').value;
    new Ajax.Request('http://' + document.domain + '/ajax/checkUsername/id/' + namecheck + '/', {
        onSuccess: function(transport) {
            if (transport.responseText == "valid") usernameNotUsed();
            else usernameUsed();
        }
    });

}

function newUserSubmit() {
    $('usernamebox').disabled = false;
    $('newuser').request({
        onComplete: function()
        {
            $('newuser').reset();
            $('password').hide();
            $('rank').hide();
            $('submiter').hide();
            $('usernamet').hide();
            $('lname').hide();
            $('checkButton').show();

            doAlert("New User has been added!");

        }
    })
}

function usernameUsed() {
    $('usernamet').removeClassName('adduseritem');
    $('usernamet').addClassName('adduseritemred');
    Effect.BlindDown('usernameMessage');
}

function usernameNotUsed() {
    $('usernamet').removeClassName('adduseritemred');
    $('usernamet').addClassName('adduseritem');
    Effect.BlindUp('usernameMessage');


    $('usernamebox').disabled = true;
    $('checkButton').hide();

    $('password').show();
    $('rank').show();
    $('submiter').show();

}

function verifyClaim(id, title) {

    cltitle = "Verify Claim: " + title + "?";

    Modalbox.show('<div class=\'warning\'><p>Are you sure to verify this Claim?</p> <input type=\'button\' value=\'Yes!\' onclick="goVerify(\'' + id + '\')" /> <input type=\'button\' value=\'No!\' onclick=\'Modalbox.hide()\' /></div>', {
        title: cltitle,
        width: 300
    });

}

function declineClaim(id, title) {

    cltitle = "Decline Claim: " + title + "?";

    Modalbox.show('<form id=\'decForm\' method=\'post\' action=\'http://' + document.domain + '/legalbid/decline/id/' + id + '/\'><div class=\'warning\'><p>To decline this claim please enter the reason below and click Decline.</p><p><textarea name=\'comment\' class=\'decPopup\'>Declined: </textarea></p><input type=\'Button\' value=\'Decline\' onclick=\'decSubmit()\' /> <input type=\'button\' value=\'Cancel\' onclick=\'Modalbox.hide()\' /></div></form>', {
        title: cltitle,
        width: 600
    });

}

function decSubmit() {
    $('decForm').request({
        onComplete: function() {
            doAlert("Claim has been Declined");
            Modalbox.hide();
        }
    })
}

function loginSubmit() {
    $('loginForm').request({
        onComplete: function() {
            window.location.reload();
            return false;
        }
    })
}

function goVerify(id) {

    new Ajax.Request('http://' + document.domain + '/ajax/legalbid_verify/id/' + id + '/', {
        onSuccess: function(transport) {
            Modalbox.hide();
            doAlert("Claim has been Verified");
        }
    });
}

function goTwitter(id) {
    claimq.stop();
    document['tweetload' + id].src = 'http://' + document.domain + '/skins/cash/images/load.gif';
    new Ajax.Request('http://' + document.domain + '/ajax/legalbid_tweet/id/' + id + '/', {
        onSuccess: function(transport) {
            doAlert("Claim has been Tweeted");
            claimq.start();
        }
    });
}

function goMail(id) {
    claimq.stop();
    document['mailload' + id].src = 'http://' + document.domain + '/skins/cash/images/load.gif';
    new Ajax.Request('http://' + document.domain + '/ajax/legalbid_mailall/id/' + id + '/', {
        onSuccess: function(transport) {
            doAlert("Claim has been E-Mailed");
            claimq.start();
        }
    });
}

function showAnnounce() {

    Effect.BlindDown('announcer');

}



function claimant_decline(id, title) {

    cltitle = "Decline Claimant: " + title + "?";

    Modalbox.show('<form id=\'decForm\' method=\'post\' action=\'http://' + document.domain + '/claimants/goDecline/id/' + id + '/\'><div class=\'warning\'><p>To decline this claimant please enter the reason below and click Decline.</p><p><textarea name=\'comment\' class=\'decPopup\'></textarea></p><input type=\'Button\' value=\'Decline\' onclick=\'claimant_decSubmit()\' /> <input type=\'button\' value=\'Cancel\' onclick=\'Modalbox.hide()\' /></div></form>', {
        title: cltitle,
        width: 600
    });

}

function claimant_decSubmit() {
    $('decForm').request({
        onComplete: function() {
            doAlert("Claimant has been Declined");
            Modalbox.hide();
		    hideClientPanel();
            refreshAll();
        }
    })
}









// ****************************** jQUERY
// CONVERTED jQUERY FUNCTIONS ARE BELOW!

	function doAlert(msg) { // Access the API to show a popup alert 
	    $j("body").rollingAlert('displayMessage', {
	        'message': msg
	    });
	}
		
	
	
	function showClientPanel(clientID) {
	
		$j.ajax({
			url: "http://" + document.domain + '/ajax/viewclaimantdetails/id/'+ clientID +'/',
			success: function(data) {
				
				$j("#claimantDetailsArea").html(data);
				$j('#bigAndBlack').show();
				$j('#claimantDetailsArea').show();
				mapFunction();
			} 
		});
	
	}
	
	function hideClientPanel() {
		$j('#bigAndBlack').hide();
		$j('#claimantDetailsArea').hide();
	}
		
		
	$j(document).ready(function(){
		
		$j("#datepicker").datetimepicker({
		    dateFormat: 'yy-mm-dd',
		    timeFormat: 'hh:mm:ss',
		});
		
		$j("#datepicker").datetimepicker({ disabled: true });
		
		var $window = $j(window),
	       	$stickyEl = $j('#callTimeSince');
	
	   	var elTop = $stickyEl.offset().top;
		
		
		$j('#bigAndBlack').click(function() {
			hideClientPanel();
		});
	
		$j('.claimant_details').live("click", function(event) {
			event.preventDefault();
			
			$url = $j(this).attr('href');
			
			
			$j.ajax({
				url: "http://" + document.domain +  $url,
				success: function(data) {
					
					$j("#claimantDetailsArea").html(data);
					$j('#bigAndBlack').show();
					$j('#claimantDetailsArea').show();
					mapFunction();
				} 
			});
		
			
		});
	
	
	 // Cache selectors outside callback for performance. 

	
	   $window.scroll(function() {
	        var windowTop = $window.scrollTop();
	
	        $stickyEl.toggleClass('sticky', windowTop > (elTop-5));
	    });


	});
	
	

	// Functions related to the Claimants section (Information that comes from a CSV)

		function getNewClaimant() { // Add new claimant to the claim queue 

		    cltitle = "Request a new Claimant!";

			var $message = $j('<div></div>').load('http://' + document.domain + '/ajax/claimants_goAddClaimant/', null, function(data) {
		        if (data == "1") {
					// We are assigning a claim
					var $messagex = $j('<div></div>').load('http://' + document.domain + '/ajax/claimants_goSubmitAddHotkey/', null, function(data) {
						$j("body").rollingAlert('displayMessage', {
					        'message': 'A new Claimant is now in your Claim Queue!',
							'icon' : 'http://admin.cash-ltd.co.uk/skins/cash/images/add.png'
					    });
			            refreshAll();
					});
				} else if (data == "5") {
					// Too many claims in queue
					var $dialog = $j('<div></div>')
				    .html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>You currently have 5 or more claimants in your queue.<br /><br />Please see to these claimants before adding more.</p>')
				    .dialog({
				        autoOpen: false,
				        title: cltitle,
				        resizable: false,
				        draggable: false,
				        height: 170,
				        width: 450,
				        modal: true,
				        buttons: {
				            "Close": function() {
				                $j(this).dialog("close");
				            }
				        }
				    });

				    $dialog.dialog('open');
				} else {
					// We just don't have any to assign
					var $dialog = $j('<div></div>')
				    .html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>There are currently no new Claimants available.<br /><br />Please inform an administrator!</p>')
				    .dialog({
				        autoOpen: false,
				        title: cltitle,
				        resizable: false,
				        draggable: false,
				        height: 170,
				        width: 450,
				        modal: true,
				        buttons: {
				            "Close": function() {
				                $j(this).dialog("close");
				            }
				        }
				    });

				    $dialog.dialog('open');
				}
			});

		}

		function claimant_sms(id) { // Send possible claimant a text message 
		    document.getElementById('sms' + id).src = 'http://' + document.domain + '/skins/cash/images/load.gif';
			var $message = $j('<div></div>').load('http://' + document.domain + '/ajax/claimants_sendtextmessage/id/' + id + '/', null, function() {
		        doAlert("Claimant has been sent a text message.");
		        document.getElementById('sms' + id).style.display = "none";
			})
		}

		function claimant_accept(id, title) { // Accept a claimant 
		    cltitle = "Accept Claimant: " + title + "?";
		    var $dialog = $j('<div></div>')
		    .html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to accept ' + title + '?</p>')
		    .dialog({
		        autoOpen: false,
		        title: cltitle,
		        resizable: false,
		        draggable: false,
		        height: 160,
		        width: 450,
		        modal: true,
		        buttons: {
		            "YES!": function() {
		                $j(this).load('http://' + document.domain + '/ajax/claimants_verify/id/' + id + '/', null,
		                function(responseText) {
		                    doAlert(title + " has been accepted.");
		                    $j(this).dialog("close");
		                    hideClientPanel();
		                    refreshAll();
		                });
		            },
		            "NO!": function() {
		                $j(this).dialog("close");
		            }
		        }
		    });

		    $dialog.dialog('open');
		}





		function claimant_callback(id, title) { // Mark a claimant as a callback 

		    cltitle = "Callback Claimant: " + title + "?";

		    var $dialog = $j('<div></div>')
		    .html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Please select a date and time for this callback.</p><p> <input id="datepicker" type="text" size="30" /> </p>')
		    .dialog({
		        autoOpen: false,
		        title: cltitle,
		        resizable: false,
		        draggable: false,
		        height: 160,
		        width: 450,
		        modal: true,
		        open: function(event, ui) {
		        	$j("#datepicker").blur();
			        $j("#datepicker").datetimepicker({ disabled: false, showOn: 'focus',  dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm:00', hourMin: 9, hourMax: 20, numberOfMonths: 3, minDate: new Date() });
			    },
			    close: function(event, ui) {
			        $j('#datepicker').datetimepicker({ disabled: true });
			    },
		        buttons: {
		            "YES!": function() {
		            	if ($j("#datepicker").val()) {
			                $j(this).load('http://' + document.domain + '/ajax/claimants_goCallback/id/' + id + '/', { 'date': $j("#datepicker").val() },
			                
			                function(responseText) {
			                    doAlert(title + " has been set to callback.");
			                    $j(this).dialog("close");
			                    hideClientPanel();
			                    refreshAll();
			                });
		                } else {
		                	alert("Please enter a Date and Time for the callback!");
		                }
		            },
		            "NO!": function() {
		                $j(this).dialog("close");
		            }
		        }
		    });

		    $dialog.dialog('open');

		}

		function claimant_noanswer(id, title) { // Mark a claimant as a No Answer 

		    cltitle = "No Answer: " + title + "?";

		    var $dialog = $j('<div></div>')
		    .html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to set ' + title + ' as a No Answer?</p>')
		    .dialog({
		        autoOpen: false,
		        title: cltitle,
		        resizable: false,
		        draggable: false,
		        height: 160,
		        width: 450,
		        modal: true,
		        buttons: {
		            "YES!": function() {
		                $j(this).load('http://' + document.domain + '/ajax/claimants_goNoAnswer/id/' + id + '/', null,
		                function(responseText) {
		                    doAlert(title + " has been set to No Answer.");
		                    $j(this).dialog("close");
		                    hideClientPanel();
		                    refreshAll();
		                });
		            },
		            "Left Message!": function() {
		                $j(this).load('http://' + document.domain + '/ajax/claimants_goNoAnswerMessage/id/' + id + '/', null,
		                function(responseText) {
		                    doAlert(title + " has been set to Left Message.");
		                    $j(this).dialog("close");
		                    hideClientPanel();
		                    refreshAll();
		                });
		            },
		            "NO!": function() {
		                $j(this).dialog("close");
		            }
		        }
		    });

		    $dialog.dialog('open');

		}

		function claimant_duplicate(id, title) { // Mark a claimant as a Duplicate 

		    cltitle = "Duplicate: " + title;

		    var $dialog = $j('<div></div>')
		    .html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to set ' + title + ' as a duplicate?</p>')
		    .dialog({
		        autoOpen: false,
		        title: cltitle,
		        resizable: false,
		        draggable: false,
		        height: 160,
		        width: 450,
		        modal: true,
		        buttons: {
		            "YES!": function() {
		                $j(this).load('http://' + document.domain + '/ajax/claimants_goDuplicate/id/' + id + '/', null,
		                function(responseText) {
		                    doAlert(title + " has been set to Duplicate.");
		                    $j(this).dialog("close");
		                    hideClientPanel();
		                    refreshAll();
		                });
		            },
		            "NO!": function() {
		                $j(this).dialog("close");
		            }
		        }
		    });

		    $dialog.dialog('open');
		}

		function claimant_history(id, title) { // Display the claimant's history 
		    cltitle = "History for: " + title + "?";
		    var $dialog = $j('<div></div>')
		    .dialog({
		        autoOpen: false,
		        title: cltitle,
		        resizable: true,
		        draggable: false,
		        height: 400,
		        width: 450,
		        modal: true,
		        buttons: {
		            "Close": function() {
		                $j(this).dialog("close");
		            }
		        }
		    });
		    $dialog.load('http://' + document.domain + '/ajax/claimants_claimanthistory/id/' + id + '/', null,
		    function() {
		        $dialog.dialog('open');
		    });
		}

