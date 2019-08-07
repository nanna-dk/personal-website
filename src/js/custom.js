'use strict';

jQuery(document).ready(function ($) {
  // Search
  var search = document.getElementById('search');
  var $clearSearch = $('#clearSearch');
  var btnSearch = document.getElementById('goSearch');
  // Send e-mail
  var contactFormModal = document.getElementById('contactFormModal');
  var contactform = document.getElementById('contactform');
  var $sendMsg = document.getElementById('sendMail');
  var messages = $('.feedback');
  // assignments
  var assignments = document.getElementById('assignments');
  var allAssignments = document.getElementById('defaultAssignments');
  var searchedAsssignments = document.getElementById('searchAssignments');
  // sorting
  var $sortHeader = $('.sorting');
  var $assignmentCategory = $('#categories');
  // Scroll
  var nav = $('#global-nav').outerHeight(true) + 10;
  var scroller = document.querySelector('.scrolltop');
  var $root = $('html, body');
  // Toggle button
  var toggle = $('[data-toggle="offcanvas"]');
  // geolocation
  var geo = document.getElementById('geo');
  // Statistik
  var $stats = $('#gitHubStats');

  // Namespaced functions:
  var NEL = {
    toggleNav: function () {
      // Toggle offcanvas
      var canvas = document.querySelector('.offcanvas-collapse');
      canvas.classList.toggle('open');
      scroller.classList.toggle('d-none');
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
          scroller.classList.add('show');
        } else {
          scroller.classList.remove('show');
        }
      }
    },
    scrollIndicator: function () {
      var progressBar = document.getElementById("scrollProgress");
      var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
      var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      var scrolled = Math.floor((winScroll / height) * 100);
      progressBar.setAttribute('aria-valuenow', scrolled);
      progressBar.style.width = scrolled + '%';
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
      var url = 'includes/search/searchAssignments.php'; //searchpdf.php
      var q = search.value;
      q = NEL.strip_html_tags(q);
      if (!q) {
        searchedAsssignments.innerHTML = '';
        allAssignments.classList.add('fadeIn');
        search.classList.add('is-invalid');
      } else {
        // Return stripped input to search field
        search.value = NEL.strip_html_tags(q);
        $.ajax({
          type: 'POST',
          url: url,
          data: {
            search: q
          },
          success: function (response) {
            allAssignments.style.display = 'none';
            NEL.clearErrors();
            //searchedAsssignments.style.display = 'none';
            searchedAsssignments.innerHTML = searchedAsssignments.innerHTML + response;
            searchedAsssignments.classList.add('show');
            // Append ?q=query to url for tracking purposes
            NEL.addParams('q', encodeURIComponent(q));
            NEL.setRatings();
          },
          error: function (xhr, status, error) {
            searchedAsssignments.innerHTML = 'S&oslash;gning kunne ikke udf&oslash;res - pr&oslash;v igen senere.';
            searchedAsssignments.classList.add('show');
            console.log(xhr.responseText);
          }
        });
        return false;
      }
    },
    sortAssignments: function (e) {
      // Sort assognments
      var sortOrder, getID, name, order, isAnchor;
      var target = $(e.currentTarget);
      if (target.prop("tagName").toLowerCase() == 'a') {
        isAnchor = true;
        var siblings = target.parent().siblings().find('a');
        sortOrder = target.data('id');
        getID = sortOrder.split('-');
        name = getID[0];
        order = getID[1];
      }
      var cat = $assignmentCategory.val();
      $.ajax({
        url: 'includes/downloads/sorting.php',
        type: 'POST',
        data: {
          'column': name || 'clicks',
          'sortOrder': order || 'desc',
          'category': cat
        },
        success: function (response) {
          //console.log(response);
          if (isAnchor) {
            target.removeClass('asc', 'desc');
            siblings.classList.remove('asc', 'desc');
            siblings.setAttribute('title', 'Sortér');
            var t = target.text().toLowerCase().trim();
            if (order == 'asc') {
              target.getAttribute('data-id', name + '-desc');
              target.setAttribute('title', 'Sortér ' + t + ' stigende');
              target.classList.add('desc');
            } else {
              target.getAttribute('data-id', name + '-asc');
              target.setAttribute('title', 'Sortér ' + t + ' faldende');
              target.classList.add('asc');
            }
          }
          allAssignments.innerHTML = '';
          //allAssignments.style.display = 'none';
          allAssignments.innerHTML = allAssignments.innerHTML + response;
          allAssignments.classList.add('fadeIn');
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
          type: 'POST',
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
      document.getElementById('name').value = '';
      document.getElementById('email').value = '';
      document.getElementById('msg').value = '';
      if (window.grecaptcha) {
        grecaptcha.reset();
      }
    },
    clearErrors: function () {
      // Clear form errors
      search.classList.remove('is-invalid');
    },
    trackThis: function (text) {
      // Google Analytics event tracking
      if (text) {
        gtag('event', text);
      }
    },
    getGitHubStats: function () {
      var user = "nanna-dk";
      var repo = "personal-website";
      var gitHubUrl = "https://github.com/" + user + "/" + repo + "/commit/";
      var url = "https://api.github.com/repos/" + user + "/" + repo + "/commits";
      $.ajax({
        type: 'GET',
        url: url,
        dataType: "json",
        success: function (data) {
          //console.log(data);
          var newData = data.reduce((acc, el) => {
            var date = el.commit.committer.date;
            var msg = el.commit.message;
            var sha = el.sha;
            var d = date.split('T')[0];
            var commitUrl = gitHubUrl + sha;
            var commit = ' <a href="' + commitUrl + '" target="_blank" rel="noopener">' + msg + '</a>';
            if (acc.hasOwnProperty(d))
              acc[d].push(commit);
            else
              acc[d] = [commit];
            return acc;
          }, {});

          Object.keys(newData).forEach(function (v, k) {
            var date = v;
            var t = new Date(date);
            var day = ("0" + (
              t.getDate())).slice(-2);
            var month = ("0" + (
              t.getMonth() + 1)).slice(-2);
            var year = t.getFullYear();

            $stats.append('<li>' + day + '.' + month + '.' + year + ': ' + newData[v] + '</li>');
          });
          $stats.children().wrapAll("<ul class='list-unstyled' />");
        },
        error: function (xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    },
    getLocation: function () {
      // Get users's location
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(NEL.showPosition);
      } else {
        geo.value = 'Geolocation is not supported by this browser.';
      }
    },
    showPosition: function (position) {
      var lat = position.coords.latitude;
      lat = lat.toFixed(6); // 6 decimals should be enough for our case
      var long = position.coords.longitude;
      long = long.toFixed(6);
      geo.value = lat + ", " + long;
    }
  };

  // Run on load:
  var query = NEL.urlParam('q');
  if (query) {
    $(search).val(decodeURIComponent(NEL.strip_html_tags(query)));
    NEL.trackThis("Search");
    $root.animate({
      scrollTop: assignments.offsetTop
    }, 500);
    NEL.searchDb();
  }

  NEL.setRatings();
  NEL.scroll();

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
  $clearSearch.click(function () {
    search.value = '';
    searchedAsssignments.innerHTML = '';
    allAssignments.style.display = 'block';
    NEL.clearErrors();
    // Remove url params
    NEL.addParams('q', '');
    NEL.trackThis("Clear button");
  });

  // Trigger search by Enter key
  document.getElementsByTagName('body')[0].addEventListener('keyup', function (e) {
    if (e.target.classList.contains("searchfield")) {
      var code = (e.keyCode ? e.keyCode : e.which);
      if ((code == 13) || (code == 10)) {
        btnSearch.click();
      }
    }
  }, false);

  // Sorting headers
  $sortHeader.click(function (e) {
    e.preventDefault();
    NEL.sortAssignments(e);
    NEL.trackThis("Sort");
  });

  $assignmentCategory.on('change', function (e) {
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


  var tags = document.querySelectorAll('.tags');
  tags.forEach(function (e) {
      e.addEventListener('click', function (f) {
        f.preventDefault();
        var query = f.target.getAttribute('data-tag');
        if (query) {
          search.value = decodeURIComponent(NEL.strip_html_tags(query));
          NEL.trackThis("Search by tag");
          NEL.searchDb();
        }
      });
  });

  // Send message
  $sendMsg.addEventListener('click', function () {
    NEL.sendMsg();
  });

  // Load Captcha when modal is opened
  // contactFormModal.on('show.bs.modal', function () {
  //   $.getScript("https://www.google.com/recaptcha/api.js?render=explicit&onload=onReCaptchaLoad")
  //     .done(function (s, Status) {})
  //     .fail(function (jqxhr, settings, exception) {
  //       console.log("Error loading script: " + exception);
  //     });
  // });

  // Clear feedback mmessages when modal is closed
  // contactFormModal.on('hidden.bs.modal', function () {
  //   messages.text('').removeClass('alert alert-danger alert-success');
  //   NEL.clearInput();
  // });

  // When 3D animation modal has been opened
  // $('#animation').on('shown.bs.modal', function (e) {
  //   NEL.trackThis('Watching 3D animation');
  // });

  if ($('#gitHubStats')) {
    NEL.getGitHubStats();
  }

  // Get location
  $('#generateCoords').click(function () {
    NEL.getLocation();
  });
  // Smooth scrolling from scroller
  scroller.click(function () {
    NEL.scrollToTop();
  });

  $(window).scroll(function () {
    NEL.scroll();
    NEL.scrollIndicator();
  });

  $('a[href*="#"]').not('[href="#"]').not('.accordion').click(function (event) {
    // On-page links
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $root.animate({
          //scrollTop: target.offset().top
          scrollTop: target.offsetTop
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
//   window.addEventListener('load', function () {
//     navigator.serviceWorker.register('sw.js').then(function (registration) {
//       // Registration was successful
//       //console.log('Service Worker registration successful with scope: ', registration.scope);
//     }, function (err) {
//       // registration failed :(
//       console.log('Service Worker registration failed: ', err);
//     });
//   });
// }
