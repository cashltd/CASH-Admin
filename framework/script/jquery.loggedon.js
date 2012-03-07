(function($) {

	var settings = {
		'checkDelay' : 25000,
	};
	var onlinelist = new Array("FIRST");
	
	var methods = {
		
		// Method to initialize the Logon alert system
		init : function(options) {
			if (options) {
                $.extend(settings, options);
            }
		
			$(this).loggedon('getLoggedOn');
		
			return this;
		},
		
		// Method to get a JSON of everyone logged on and also set timestamp in database
		getLoggedOn : function() {
			$.getJSON("http://" + document.domain + "/api/getLoggedOn/",function(data){
				
				var tempArray = new Array();

				$.each(data, function(i,item){
					if ($.inArray(item.fname + ' ' + item.sname,onlinelist) >= -1) {
						tempArray.push(item.fname + ' ' + item.sname);
						if ($.inArray("FIRST",onlinelist) > -1) {
							
						} else {
							if ($.inArray(item.fname + ' ' + item.sname,onlinelist) == -1) {
								$('body').rollingAlert('displayMessage', {
							        'message': item.fname + ' ' + item.sname + " is now Online."
							    });
							}
						}
					
					}
				});
				
				onlinelist = tempArray;
				
				
				console.log(onlinelist);



				setTimeout(function() { $(this).loggedon('getLoggedOn') }, settings.checkDelay);

				return this;
				
			});
			

		}
		
	};
	
	
	
    $.fn.loggedon = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.rollingAlert');
        }
    }

})(jQuery);