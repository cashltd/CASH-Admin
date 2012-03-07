(function($) {
    var settings = {
        'stylesheet': '../script/rollingAlert.css',
        'displayDelay': 8000,
        'currentMessage': 0,
        'containerClass': 'rollingAlertContainer',
    };
    var methods = {
        init: function(options) {
            if (options) {
                $.extend(settings, options);
            } else {
                $.error("No options specified for jQuery.rollingAlert, if your stylesheet isn't displaying this is why!");
            }
            $(this).rollingAlert('addStyleSheet');
            this.append('<div class="' + settings.containerClass + '" id="rollingAlertContainer' + this.attr('id') + '"></div>');
            return this;
        },
        displayMessage: function(m) {
            settings.currentMessage++;
            if (!m.divName) m.divName = 'rollingAlert';
            if (m.title) m.message = '<b>' + m.title + '</b><br />' + m.message;
            if (m.icon) m.message = '<img src="' + m.icon + '">' + m.message;
            $('#rollingAlertContainer' + this.attr('id')).append('<div class="' + m.divName + '" id="rollingAlertMessage' + settings.currentMessage + '">' + m.message + '</div>');
            $('#rollingAlertMessage' + settings.currentMessage).delay(settings.displayDelay).fadeOut('slow');
            return $('#rollingAlertMessage' + settings.currentMessage);
        },
        addStyleSheet: function() {
            $('head').append('<link rel="stylesheet" type="text/css" href="' + settings.stylesheet + '">');
        },
    };
    $.fn.rollingAlert = function(method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.rollingAlert');
        }
    }
})(jQuery);