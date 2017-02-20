/**
 * --------------------------------------------------------------------------
 * Nanna Ellegaard custom scripts
 * Sticky top navbar
 * --------------------------------------------------------------------------
 */

var custom = function ($) {
    $(document).ready(function () {
        var toggleAffix = function (affixElement, scrollElement, wrapper) {
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

        $('[data-toggle="affix"]').each(function () {
            var ele = $(this),
                wrapper = $('<div></div>');
            ele.before(wrapper);
            $(window).on('scroll resize', function () {
                toggleAffix(ele, $(this), wrapper);
            });
            // init
            toggleAffix(ele, $(window), wrapper);
        });
        
        // Collapse menu items on mobile
        $('.navbar-nav a').click(function () {
            if (window.innerWidth < 768) {
                $('.navbar-collapse').collapse('hide');
            }
        });
    });
}(jQuery);
