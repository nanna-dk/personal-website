//
// Nanna Ellegaard custom scripts
//

var custom = function($) {
  $(document).ready(function() {
    //Mobile navigation
    var menuItems = $('#menuItems').children().clone();
    var navBarSide = $('#navbarSide');
    var overlay = $('.overlay');
    navBarSide.prepend(menuItems);

    $('#navbarSideButton').click(function() {
      navBarSide.addClass('reveal');
      overlay.show();
    });

    $('#navbarSide, .overlay, .nav-link').click(function() {
      navBarSide.removeClass('reveal');
      overlay.hide();
    });

    var toggleAffix = function(affixElement, scrollElement, wrapper) {
      var height = affixElement.outerHeight(),
        top = wrapper.offset().top;
      if (scrollElement.scrollTop() >= top) {
        wrapper.height(height);
        affixElement.addClass('affix');
      } else {
        affixElement.removeClass('affix');
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

    // Smooth scrolling from anchors
    $('a[href*="#"]').not('.accordion').click(function() {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length
          ? target
          : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          $('html, body').animate({
            //50px are added due to the sticky topmenu
            scrollTop: target.offset().top - 50
          }, 500);
          return false;
        }
      }
    });

    // Send e-mail functions
    var form = $('#contactform');
    var messages = $('.feedback');

    $('#sendMail').click(function() {
      // Serialize the form data.
      var formData = $(form).serialize();
      var url = '../includes/mail/mail_ajax.php';
      $.ajax({
        type: 'POST',
        url: url,
        beforeSend: function() {
          $(messages).html('<div class="progress mb-4"><div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div></div>');
        },
        data: formData
      }).done(function(response) {
        $(messages).removeClass('alert alert-danger');
        $(messages).addClass('alert alert-success');

        // Set the message text.
        $(messages).text(response);
        clearInput()
      }).fail(function(data) {
        $(messages).removeClass('alert alert-success');
        $(messages).addClass('alert alert-danger');

        // Set the message text.
        if (data.responseText !== '') {
          $(messages).text(data.responseText);
        } else {
          $(messages).text('Der er sket en fejl. Beskeden er ikke blevet sendt.');
        }
      });
    });

    function clearInput() {
      // Clear the form fields
      $('#inputName').val('');
      $('#inputEmail').val('');
      $('#inputMessage').val('');
      grecaptcha.reset();
    }

    $('#contactForm').on('hidden.bs.modal', function() {
      // Clear feedback mmessages when modal is closed
      $('.feedback').text('').removeClass('alert alert-danger alert-success');
      clearInput();
    })

    // Search assignments
    $('#goSearch').click(function(e) {
      e.preventDefault();
      var allAssignments = $('#defaultAssignments');
      var searchedAsssignments = $('#searchAssignments');
      var url = '../includes/search/searchAssignments.php';
      var q = $('#search').val();

      if (q == '') {
        searchedAsssignments.html('');
        allAssignments.show();
      } else {
        $.ajax({
          type: 'POST',
          url: url,
          data: {
            search: q
          },
          success: function(response) {
            allAssignments.hide();
            searchedAsssignments.html(response).show();
          },
          error: function() {
            searchedAsssignments.html('Søgning kunne ikke udføres - prøv igen senere.').show();
          }
        });
        return false;
      }
    });

    // Trigger search by Enter key
    $('#search').keypress(function(e) {
      if (e.which === 13) {
        $('#goSearch').click();
      }
    });

    // Accordion border fixed
    $('#stats').on('hide.bs.collapse', function() {
      $(this).find('.card-header').css('border-bottom', '0');
    })
    $('#stats').on('show.bs.collapse', function() {
      $(this).find('.card-header').css('border-bottom', '1px solid rgba(0,0,0,0.125)');
    })
  });
}(jQuery);
