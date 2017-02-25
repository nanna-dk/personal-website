/**
 * --------------------------------------------------------------------------
 * Nanna Ellegaard custom scripts
 * --------------------------------------------------------------------------
 */

var custom = function($) {
    $(document).ready(function() {
        var toggleAffix = function(affixElement, scrollElement, wrapper) {
            var height = affixElement.outerHeight(),
                top = wrapper.offset().top;
            if (scrollElement.scrollTop() >= top) {
                wrapper.height(height);
                affixElement.addClass("affix");
            } else {
                affixElement.removeClass("affix");
                wrapper.height('auto');
            }
        };
        //Sticky navbar
        $('[data-toggle="affix"]').each(function() {
            var ele = $(this),
                wrapper = $('<div></div>');
            ele.before(wrapper);
            $(window).on('scroll resize', function() {
                toggleAffix(ele, $(this), wrapper);
            });
            // init
            toggleAffix(ele, $(window), wrapper);
        });

        // Collapse menu items on mobile
        $('.navbar-nav a').click(function() {
            if (window.innerWidth < 768) {
                $('.navbar-collapse').collapse('hide');
            }
        });

        // Smooth scrolling from anchors
        $('a[href*="#"]').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        //50px are added due to the sticky topmenu
                        scrollTop: target.offset().top - 50
                    }, 500);
                    return false;
                }
            }
        });
    });
}(jQuery);
