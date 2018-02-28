// ******
// © Nanna Ellegaard custom scripts
// http://www.e-nanna.dk 2018
// ******

var custom = function($) {
  $(document).ready(function() {
    // Search
    var search = $('#search');
    var clearSearch = $('#clearSearch');
    var btnSearch = $('#goSearch');
    // Send e-mail
    var contactform = $('#contactform');
    var sendMsg = $('#sendMail');
    var messages = $('.feedback');
    //Mobile navigation
    var mobileNavIcon = $('#navbarSideButton');
    var navBarSide = $('#navbarSide');
    var overlay = $('.overlay');
    var menuItems = $('#menuItems').children().clone();
    navBarSide.prepend(menuItems);
    // assignments
    var allAssignments = $('#defaultAssignments');
    var searchedAsssignments = $('#searchAssignments');
    // sorting
    var sortHeader = $('.sorting');

    // Run search on load if query is present
    $.urlParam = function(name) {
      var results = new RegExp('[\?&]' + name + '=([^]*)').exec(window.location.href);
      if (results == null) {
        return null;
      } else {
        return results[1] || 0;
      }
    }

    var query = $.urlParam('q');
    if (query) {
      $(search).val(decodeURIComponent(query));
      trackThis("Search");
      $('html, body').animate({
        scrollTop: searchedAsssignments.offset().top
      }, 500);
      searchDb();
    }

    // Lazy load single image
    setTimeout(function() {
      $('#cover').attr('src', 'img/it-cover.jpg');
    }, 5000);

    // Mobile sidebar init
    $('#navbarSideButton, #navbarSide, .overlay, .nav-link').click(function() {
      mobileNavIcon.toggleClass("open");
      navBarSide.toggleClass('reveal');
      overlay.toggle();
    });

    // Sticky navbar function
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

    // Sorting headers
    sortHeader.click(function(e) {
      sortAssignments(e);
      trackThis("Sort");
    });

    // Send message
    sendMsg.click(function() {
      // Serialize the form data.
      var formData = $(contactform).serialize();
      var url = 'includes/mail/mail_ajax.php';
      $.ajax({
        type: 'post',
        url: url,
        beforeSend: function() {
          $(messages).html('<div class="progress mb-4"><div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div></div>');
        },
        data: formData
      }).done(function(response) {
        $(messages).removeClass('alert alert-danger');
        $(messages).addClass('alert alert-success');
        $(messages).text(response);
        clearInput();
        trackThis("Message sent");
      }).fail(function(data) {
        $(messages).removeClass('alert alert-success');
        $(messages).addClass('alert alert-danger');
        if (data.responseText !== '') {
          $(messages).text(data.responseText);
        } else {
          $(messages).text('Der er sket en fejl. Beskeden er ikke blevet sendt.');
        }
      });
    });

    // Clear feedback mmessages when modal is closed
    contactform.on('hidden.bs.modal', function() {
      messages.text('').removeClass('alert alert-danger alert-success');
      clearInput();
    })

    // Search assignments
    btnSearch.click(function(e) {
      e.preventDefault();
      trackThis("Search");
      searchDb();
    });

    // Search assignments
    function searchDb() {
      var url = 'includes/search/searchAssignments.php';
      var q = search.val();
      if (q == '') {
        searchedAsssignments.html('');
        allAssignments.show();
        search.parent().addClass('has-danger');
        search.addClass('form-control-danger');
      } else {
        $.ajax({
          type: 'post',
          url: url,
          data: {
            search: q
          },
          success: function(response) {
            allAssignments.hide();
            clearErrors();
            searchedAsssignments.html(response).show();
            // Append ?q=query to url for tracking purposes
            addParams('q', encodeURIComponent(q));
            setRatings();
          },
          error: function(xhr, status, error) {
            searchedAsssignments.html('Søgning kunne ikke udføres - prøv igen senere.').show();
            console.log(xhr.responseText);
          }
        });
        return false;
      }
    }

    // Sort assognments
    function sortAssignments(e) {
      var target = $(e.currentTarget);
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
        success: function(response) {
          target.removeClass('asc desc');
          target.siblings().removeClass('asc desc');
          target.siblings().attr('title', 'Sortér');
          var t = target.text().toLowerCase().trim();
          if (order == 'asc') {
            target.data('id', name + '-desc');
            target.attr('title', 'Sortérer ' + t + ' stigende');
            target.addClass('desc');
          } else {
            target.data('id', name + '-asc');
            target.attr('title', 'Sortérer ' + t + ' faldende');
            target.addClass('asc');
          }
          allAssignments.empty();
          allAssignments.append(response);
          // Update Ratings
          setRatings();
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }

    // Trigger search by Enter key
    search.keypress(function(e) {
      var code = (
        e.keyCode
        ? e.keyCode
        : e.which);
      if ((code == 13) || (code == 10)) {
        btnSearch.click();
      }
    });

    // Clear search field
    clearSearch.click(function() {
      search.val('');
      searchedAsssignments.html('');
      allAssignments.show();
      clearErrors();
      trackThis("Clear button");
    });

    // Social icons clicked
    $('.social-nav a').click(function() {
      var channel = $(this).attr('title');
      if (channel) {
        trackThis(channel);
      }
    });

    // Accordion border fixed
    $('#stats').on('hide.bs.collapse', function() {
      $(this).find('.card-header').css('border-bottom', '0');
    })
    $('#stats').on('show.bs.collapse', function() {
      $(this).find('.card-header').css('border-bottom', '1px solid rgba(0,0,0,0.125)');
      trackThis("Expanding statistics");
    });

    setRatings();
  });

  // Append queries to url
  function addParams(key, value) {
    var baseUrl = [location.protocol, '//', location.host, location.pathname].join(''),
      urlQueryString = document.location.search,
      newParam = key + '=' + value,
      params = '?' + newParam;
    // If the "search" string exists, then build params from it
    if (urlQueryString) {
      updateRegex = new RegExp('([\?&])' + key + '[^&]*');
      removeRegex = new RegExp('([\?&])' + key + '=[^&;]+[&;]?');
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
  };

  // Clear the form fields
  function clearInput() {
    $('#name').val('');
    $('#email').val('');
    $('#msg').val('');
    grecaptcha.reset();
  }

  // Clear form errors
  function clearErrors() {
    $(search).parent().removeClass('has-danger');
    $(search).removeClass('form-control-danger');
  }

  // Google Analytics event tracking
  function trackThis(text) {
    gtag('send', 'event', {
      eventCategory: text,
      eventAction: 'Click'
    });
  }

  // Rating
  function setRatings() {
    $('.ratings').each(function() {
      var average = $(this).attr('data-avg');
      average = (Number(average) * 20);
      $(this).find('.bg').css('width', 0);
      $(this).find('.bg').animate({
        width: average + '%'
      }, 500);
    });
  }

  $(document).on('mouseover', '.star', function() {
    $(this).prevAll().addBack().addClass('full');
  });

  $(document).on('mouseout', '.star', function() {
    $(this).removeClass('full');
  });

  $(document).on('click', '.star', function() {
    var itemId = $(this).closest('.ratings').attr('data-id');
    var vote = $(this).attr('data-vote');
    // Cookie 'Rating' is set in vote.php:
    var cookieExists = (document.cookie.indexOf('Rating') > -1)
      ? true
      : false;
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
        success: function(data) {
          var rated = $(".ratings[data-id='" + itemId + "']");
          rated.attr('data-avg', data.average);
          var average = data.average;
          average = (Number(average) * 20);
          rated.find('.bg').css('width', 0);
          rated.find('.bg').animate({
            width: average + '%'
          }, 500);
          var suffix = (data.votes == 1)
            ? "bedømmelse"
            : "bedømmelser";
          rated.find('.votes').html(data.votes + " " + suffix);
          trackThis("Rated assignment no. " + itemId + " with " + vote);
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    } else {
      $(this).closest('.ratings').find('.votes').html('Du har allerede afgivet en bedømmelse - vend tilbage senere.');
    }
  });

  // var loadMore = $('#load');
  // var limit = 4;
  // var offset = 0;

  // function displayRecords(lim, off) {
  //   $.ajax({
  //     type: 'GET',
  //     url: $path + '/includes/paging/loadmore.php',
  //     data: 'limit=' + lim + '&offset=' + off,
  //     cache: false,
  //     beforeSend: function() {
  //       loadMore.text("Henter...");
  //     },
  //     success: function(data) {
  //       allAssignments.hide().append(data).fadeIn(300);
  //       loadMore.appendTo(allAssignments);
  //       if (data == "") {
  //         loadMore.html('');
  //         loadMore.html('<button data-atr="nodata" class="btn btn-primary disabled" type="button" disabled>No more records.</button>').show()
  //       } else {
  //         loadMore.html('<button class="btn btn-primary" type="button">Vis flere...</button>').show();
  //       }
  //     },
  //     error: function(xhr, status, error) {
  //       console.log(xhr.responseText);
  //     }
  //   });
  // }

  // start to load the first set of data
  // displayRecords(limit, offset);
  // loadMore.click(function() {
  //    if it has no more records no need to fire ajax request
  //   var d = loadMore.find("button").attr("data-atr");
  //   if (d != "nodata") {
  //     offset = limit + offset;
  //     displayRecords(limit, offset);
  //   }
  // });
}(jQuery);
