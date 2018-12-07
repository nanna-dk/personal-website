'use strict';
jQuery(document).ready(function ($) {
  // Search
  var search = $('#search');
  var clearSearch = $('#clearSearch');
  var btnSearch = $('#goSearch');
  // Send e-mail
  var contactFormModal = $('#contactFormModal');
  var contactform = $('#contactform');
  var sendMsg = $('#sendMail');
  var messages = $('.feedback');
  // assignments
  var assignments = $('#assignments');
  var allAssignments = $('#defaultAssignments');
  var searchedAsssignments = $('#searchAssignments');
  // sorting
  var sortHeader = $('.sorting');
  // Scroll
  var nav = $('#global-nav').outerHeight(true) + 10;
  var scroller = $('.scrolltop');
  var $root = $('html, body');
  // Toggle button
  var toggle = $('[data-toggle="offcanvas"]');
  // geolocation
  var geo = $('#geo');

  // Namespaced functions:
  var NEL = {
    toggleNav: function () {
      // Toggle offcanvas
      $('.offcanvas-collapse').toggleClass('open');
      scroller.toggleClass('d-none');
    },
    scrollToTop: function () {
      // Smooth scroll to top
      $root.animate({
        scrollTop: 0
      }, 500);
      return false;
    },
    scroll: function () {
      if (scroller) {
        if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
          scroller.addClass('show');
        } else {
          scroller.removeClass('show');
        }
      }
    },
    urlParam: function (name) {
      // Get query string from url
      var results = new RegExp('[\?&]' + name + '=([^]*)').exec(window.location.href);
      if (results == null) {
        return null;
      } else {
        return results[1] || 0;
      }
    },
    searchDb: function () {
      // Search assignments
      var url = 'includes/search/searchAssignments.php';
      var q = search.val();
      q = NEL.strip_html_tags(q);
      if (!q) {
        searchedAsssignments.html('');
        allAssignments.show();
        search.addClass('is-invalid');
      } else {
        // Return stripped input to search field
        search.val(NEL.strip_html_tags(q));
        $.ajax({
          type: 'post',
          url: url,
          data: {
            search: q
          },
          success: function (response) {
            allAssignments.hide();
            NEL.clearErrors();
            searchedAsssignments.hide().html(response).fadeIn(600);
            // Append ?q=query to url for tracking purposes
            NEL.addParams('q', encodeURIComponent(q));
            NEL.setRatings();
          },
          error: function (xhr, status, error) {
            searchedAsssignments.html('Søgning kunne ikke udføres - prøv igen senere.').show();
            console.log(xhr.responseText);
          }
        });
        return false;
      }
    },
    sortAssignments: function (e) {
      // Sort assognments
      var target = $(e.currentTarget);
      var siblings = target.parent().siblings().find('a');
      var sortOrder = target.data('id');
      var getID = sortOrder.split('-');
      var name = getID[0];
      var order = getID[1];
      $.ajax({
        url: 'includes/downloads/sorting.php',
        type: 'post',
        data: {
          'column': name,
          'sortOrder': order
        },
        success: function (response) {
          target.removeClass('asc desc');
          siblings.removeClass('asc desc');
          siblings.attr('title', 'Sortér');
          var t = target.text().toLowerCase().trim();
          if (order == 'asc') {
            target.data('id', name + '-desc');
            target.attr('title', 'Sortér ' + t + ' stigende');
            target.addClass('desc');
          } else {
            target.data('id', name + '-asc');
            target.attr('title', 'Sortér ' + t + ' faldende');
            target.addClass('asc');
          }
          allAssignments.empty();
          allAssignments.hide().append(response).fadeIn(600);
          // Update Ratings
          NEL.setRatings();
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    },
    setRatings: function () {
      $('.ratings').each(function () {
        var average = $(this).attr('data-avg');
        average = (Number(average) * 20);
        $(this).find('.bg').css('width', 0);
        $(this).find('.bg').animate({
          width: average + '%'
        }, 500);
      });
    },
    rate: function (itemId, vote) {
      // Cookie 'Rating' is set in vote.php:
      var cookieExists = (document.cookie.indexOf('Rating') > -1) ? true : false;
      if (cookieExists == false) {
        $.ajax({
          url: 'includes/rating/vote.php',
          type: 'POST',
          dataType: 'json',
          data: {
            vote: 'yes',
            item: itemId,
            point: vote
          },
          success: function (data) {
            //console.log(data);
            var rated = $(".ratings[data-id='" + itemId + "']");
            rated.attr('data-avg', data.average);
            var average = data.average;
            average = (Number(average) * 20);
            rated.find('.bg').css('width', 0);
            rated.find('.bg').animate({
              width: average + '%'
            }, 500);
            var suffix = (data.votes == 1) ? "bedømmelse" : "bedømmelser";
            rated.find('.votes').html(data.votes + " " + suffix);
            NEL.trackThis("Rated assignment no. " + itemId + " with " + vote);
          },
          error: function () {
            console.log('Error setting rating.');
          }
        });
      } else {
        $(".ratings[data-id='" + itemId + "']").find('.votes').html('Du har allerede afgivet en bedømmelse - vend tilbage senere.');
      }
    },
    strip_html_tags: function (str) {
      // Strip html tags
      if ((str === null) || (str === '')) {
        return false;
      } else {
        str = str.toString();
        return str.replace(/<\/?[^>]+(>|$)/g, '');
      }
    },
    addParams: function (key, value) {
      // Append queries to url
      var baseUrl = [location.protocol, '//', location.host, location.pathname].join(''),
        urlQueryString = document.location.search,
        newParam = key + '=' + value,
        params = '?' + newParam;
      // If the "search" string exists, then build params from it
      if (urlQueryString) {
        var updateRegex = new RegExp('([\?&])' + key + '[^&]*');
        var removeRegex = new RegExp('([\?&])' + key + '=[^&;]+[&;]?');
        if (typeof value == 'undefined' || value == null || value == '') { // Remove param if value is empty
          params = urlQueryString.replace(removeRegex, "$1");
          params = params.replace(/[&;]$/, "");
        } else if (urlQueryString.match(updateRegex) !== null) { // If param exists already, update it
          params = urlQueryString.replace(updateRegex, "$1" + newParam);
        } else { // Otherwise, add it to end of query string
          params = urlQueryString + '&' + newParam;
        }
      }
      window.history.replaceState({}, "", baseUrl + params);
    },
    sendMsg: function () {
      // Serialize the form data.
      var formData = $(contactform).serialize();
      var url = 'includes/mail/mail_ajax.php';
      $.ajax({
          type: 'post',
          url: url,
          beforeSend: function () {
            $(messages).html('<div class="p-2 mb-4">Vent venligst...</div>');
          },
          data: formData
        })
        .done(function (response) {
          $(messages).removeClass('alert alert-danger');
          $(messages).addClass('alert alert-success');
          $(messages).text(response);
          NEL.clearInput();
          NEL.trackThis("Message sent");
        })
        .fail(function (data) {
          $(messages).removeClass('alert alert-success');
          $(messages).addClass('alert alert-danger');
          if (data.responseText !== '') {
            $(messages).text(data.responseText);
          } else {
            $(messages).text('Der er sket en fejl. Beskeden er ikke blevet sendt.');
          }
        });
    },
    clearInput: function () {
      // Clear form fields
      $('#name').val('');
      $('#email').val('');
      $('#msg').val('');
      if (window.grecaptcha) {
        grecaptcha.reset();
      }
    },
    clearErrors: function () {
      // Clear form errors
      $(search).removeClass('is-invalid');
    },
    trackThis: function (text) {
      // Google Analytics event tracking
      if (text) {
        gtag('event', text);
      }
    },
    getLocation: function () {
      // Get users's location
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(NEL.showPosition);
      } else {
        geo.text("Geolocation is not supported by this browser.");
      }
    },
    showPosition: function (position) {
      var dither = 0.0001;
      var lat = position.coords.latitude;
      lat = lat.toFixed(5); // 5 decimals should be enough for our case
      var long = position.coords.longitude;
      long = long.toFixed(5);
      geo.text(lat + ", " + long);
    }
  };

  // Run on load:
  var query = NEL.urlParam('q');
  if (query) {
    $(search).val(decodeURIComponent(NEL.strip_html_tags(query)));
    NEL.trackThis("Search");
    $root.animate({
      scrollTop: assignments.offset().top
    }, 500);
    NEL.searchDb();
  }

  NEL.setRatings();
  NEL.scroll();
  NEL.getLocation();

  // Events:
  // Toggle off-canvas menu
  toggle.on('click', function () {
    NEL.toggleNav();
  });

  $('.offcanvas-collapse .nav-link').on('click', function () {
    toggle.click();
  });

  // Social icons clicked
  $('.utility-icons .nav-item a').click(function () {
    var channel = $(this).attr('title');
    if (channel) {
      NEL.trackThis(channel);
    }
  });

  // Search assignments event
  btnSearch.click(function (e) {
    e.preventDefault();
    NEL.trackThis("Search");
    NEL.searchDb();
  });

  // Clear search field
  clearSearch.click(function () {
    search.val('');
    searchedAsssignments.html('');
    allAssignments.show();
    NEL.clearErrors();
    // Remove url params
    NEL.addParams('q', '');
    NEL.trackThis("Clear button");
  });

  // Trigger search by Enter key
  search.keypress(function (e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if ((code == 13) || (code == 10)) {
      btnSearch.click();
    }
  });

  // Sorting headers
  sortHeader.click(function (e) {
    e.preventDefault();
    NEL.sortAssignments(e);
    NEL.trackThis("Sort");
  });

  $(document).on('mouseover', '.star', function () {
    $(this).prevAll().addBack().addClass('full');
  });

  $(document).on('mouseout', '.star', function () {
    $(this).removeClass('full');
  });

  $(document).on('click', '.star', function () {
    var itemId = $(this).closest('.ratings').attr('data-id');
    var vote = $(this).attr('data-vote');
    if (itemId && vote) {
      NEL.rate(itemId, vote);
      NEL.trackThis("Rated");
    }
  });

  $('.tags').click(function (e) {
    e.preventDefault();
    var query = $(this).attr('data-tag');
    if (query) {
      $(search).val(decodeURIComponent(NEL.strip_html_tags(query)));
      NEL.trackThis("Search by tag");
      NEL.searchDb();
    }
  });

  // Send message
  sendMsg.click(function () {
    NEL.sendMsg();
  });

  // Load Captcha when modal is opened
  contactFormModal.on('show.bs.modal', function () {
    $.getScript("https://www.google.com/recaptcha/api.js?render=explicit&onload=onReCaptchaLoad")
      .done(function (s, Status) {})
      .fail(function (jqxhr, settings, exception) {
        console.log("Error loading script: " + exception);
      });
  });

  // Clear feedback mmessages when modal is closed
  contactFormModal.on('hidden.bs.modal', function () {
    messages.text('').removeClass('alert alert-danger alert-success');
    NEL.clearInput();
  });

  // Lazy load single image
  $('#cd-cover').on('show.bs.modal', function (e) {
    $('#cover').attr('src', 'img/it-cover.jpg');
  });

  // Smooth scrolling from scroller
  scroller.click(function () {
    NEL.scrollToTop();
  });

  $(window).scroll(function () {
    NEL.scroll();
  });

  $('a[href*="#"]').not('[href="#"]').not('.accordion').click(function (event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $root.animate({
          scrollTop: target.offset().top
        }, 500, function () {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          }
        });
      }
    }
  });

});

var myCaptcha = null;
var onReCaptchaLoad = function () {
  if (myCaptcha === null) {
    myCaptcha = grecaptcha.render('recaptcha', {
      sitekey: '6LdXbXcUAAAAALIJ58R3GYrXGr0vgz6eS_SXuWcS',
      callback: function (response) {
        //console.log(grecaptcha.getResponse(myCaptcha));
      }
    });
  } else {
    grecaptcha.reset(myCaptcha);
  }
};

// Start service worker
// if ('serviceWorker' in navigator && (window.location.protocol === 'https:')) {
//   window.addEventListener('load', function() {
//     navigator.serviceWorker.register('sw.js').then(function(registration) {
//       // Registration was successful
//       //console.log('Service Worker registration successful with scope: ', registration.scope);
//     }, function(err) {
//       // registration failed :(
//       console.log('Service Worker registration failed: ', err);
//     });
//   });
// }
