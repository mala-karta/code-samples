(function (ns) {
    "use strict";

    ns.splashPage = function () {
        this.construct.apply(this, arguments);
    };

    var proto = ns.splashPage.prototype;

    proto.construct = function (options) {
        this.options = $.extend({
            containerId: 'splashSlide'
        }, options);
        this.initSplashPage();
    };

    proto.initSplashPage = function () {
        if ($(window).width() > 480) {
            this.initFancybox();
            $('#' + this.options.containerId + ' a.btn-close').bind('click', function(){
                $.fancybox.close();
            });
        }
    };

    proto.initFancybox = function () {
        $.fancybox({
            'hideOnOverlayClick': false,
            'padding': 0,
            'cyclic': true,
            'centerOnScroll' : true,
            'overlayColor' : '#000',
            'titleShow' : false,
            'content': $('#' + this.options.containerId),
            'autoScale': true
        });
    };

})(qs.defineNS('app.splash'));
