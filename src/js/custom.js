'use strict';

document.addEventListener("DOMContentLoaded", function () {
  // Search
  var search = document.getElementById('search');
  var clearSearch = document.getElementById('clearSearch');
  var btnSearch = document.getElementById('goSearch');
  // Send e-mail
  var contactform = document.querySelector('#contactform');
  var sendMsg = document.getElementById('sendMail');
  var messages = document.querySelector('.feedback');
  // assignments
  var assignments = document.getElementById('assignments');
  var allAssignments = document.getElementById('defaultAssignments');
  var searchedAsssignments = document.getElementById('searchAssignments');
  // sorting
  var sortHeader = document.querySelectorAll('.sorting');
  var assignmentCategory = document.getElementById('categories');
  // Ratings
  var stars = document.querySelectorAll(".star");
  // tags
  var tags = document.querySelectorAll(".tags");
  // Scroll
  var scroller = document.querySelector('.scrolltop');
  var root = document.body;
  var anchors = document.querySelectorAll('a[href*="#"], a:not([href="#"]), div:not(.accordion)');
  // Toggle button
  var toggle = document.querySelector('[data-toggle="offcanvas"]');
  // geolocation
  var geo = document.getElementById('geo');
  var getCoords = document.getElementById('#generateCoords');
  // Statistik
  var stats = document.getElementById('gitHubStats');
  // Modals
  var contactFormModal = document.querySelectorAll('a[data-target="#contactFormModal"]');
  var animationModal = document.querySelector('a[data-target="#animation"]');

  // Namespaced functions:
  var NEL = {
    toggleNav: function () {
      // Toggle offcanvas
      var canvas = document.querySelector('.offcanvas-collapse');
      canvas.classList.toggle('open');
      scroller.classList.toggle('d-none');
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
        q = NEL.strip_html_tags(q);
        var data = {
          search: q
        };
        // Serialize an array of data or a set of key/values into a query string
        var params = Object.keys(data).map(function (k) {
          return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
        }).join('&');
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
          if (this.readyState == 4) {
            if (this.status == 200) {
              //console.log(this.responseText);
              allAssignments.style.display = 'none';
              NEL.clearErrors();
              searchedAsssignments.innerHTML = this.responseText;
              searchedAsssignments.classList.add('show');
              // Append ?q=query to url for tracking purposes
              NEL.addParams('q', encodeURIComponent(q));
              NEL.setRatings();
              return false;
            } else {
              searchedAsssignments.innerHTML = 'S&oslash;gning kunne ikke udf&oslash;res - pr&oslash;v igen senere.';
              searchedAsssignments.classList.add('show');
              console.log(this.responseText);
            }
          }
        };
        xhr.send(params);
      }
    },
    sortAssignments: function (e) {
      // Sort assognments
      var sortOrder, getID, name, order, isAnchor;
      var target = e.currentTarget;
      if (target.classList.contains('nav-link')) {
        isAnchor = true;
        var siblings = NEL.getSiblings(target.parentElement);
        sortOrder = target.getAttribute('data-id');
        getID = sortOrder.split('-');
        name = getID[0];
        order = getID[1];
      }
      var cat = assignmentCategory.value;
      var data = {
        'column': name || 'clicks',
        'sortOrder': order || 'desc',
        'category': cat
      };
      // Serialize an array of data or a set of key/values into a query string
      var params = Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
      }).join('&');

      var url = 'includes/downloads/sorting.php';
      var xhr = new XMLHttpRequest();
      xhr.open('POST', url, true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
          if (this.status == 200) {
            //console.log(this.responseText);
            if (isAnchor) {
              target.classList.remove('asc', 'desc');
              [].forEach.call(siblings, function (el) {
                var sort = el.children;
              [].forEach.call(sort, function (e) {
                  e.classList.remove('asc', 'desc');
                  e.setAttribute('title', 'Sortér');
                });
              });
              var text = target.textContent || target.innerText;
              text = text.toLowerCase().trim();
              if (order == 'asc') {
                target.setAttribute('data-id', name + '-desc');
                target.setAttribute('title', 'Sortér ' + text + ' stigende');
                target.classList.add('desc');
              } else {
                target.setAttribute('data-id', name + '-asc');
                target.setAttribute('title', 'Sortér ' + text + ' faldende');
                target.classList.add('asc');
              }
            }
            allAssignments.innerHTML = this.responseText;
            allAssignments.classList.add('fadeIn');
            // Update Ratings
            NEL.setRatings();
          } else {
            console.log(this.responseText);
          }
        }
      };
      xhr.send(params);
    },
    setRatings: function () {
      var ratings = document.querySelectorAll('.ratings');
      var i;
      for (i = 0; i < ratings.length; ++i) {
        var average = ratings[i].getAttribute('data-avg');
        average = (Number(average) * 20);
        var bg = ratings[i].querySelector('.bg');
        bg.style.width = 0;
        bg.style.width = average + '%';
      }
    },
    rate: function (itemId, vote) {
      var data = {
        vote: 'yes',
        item: itemId,
        point: vote
      };

      var params = Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
      }).join('&');

      var url = 'includes/rating/vote.php';
      // Cookie 'Rating' is set in vote.php:
      var cookieExists = (document.cookie.indexOf('Rating') > -1) ? true : false;
      if (cookieExists == false) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
          if (this.readyState == 4) {
            if (this.status == 200) {
              var data = JSON.parse(this.responseText);
              //console.log(data);
              var rated = document.querySelector(".ratings[data-id='" + itemId + "']");
              var bg = rated.querySelector('.bg');
              var average = data.average;
              average = (Number(average) * 20);
              bg.setAttribute('data-avg', data.average);
              bg.style.width = 0;
              bg.style.width = average + '%';
              var suffix = (data.votes == 1) ? "bedømmelse" : "bedømmelser";
              rated.querySelector('.votes').innerHTML = data.votes + " " + suffix;
              NEL.trackThis("Rated assignment no. " + itemId + " with " + vote);
            } else {
              console.log(this.responseText);
            }
          }
        };
        xhr.send(params);
      } else {
        var voted = document.querySelector(".ratings[data-id='" + itemId + "']");
        voted.querySelector('.votes').innerHTML = 'Du har allerede afgivet en bedømmelse - vend tilbage senere.';
      }
    },
    sendMsg: function () {
      messages.innerHTML = '<div class="p-2 mb-4 alert alert-info">Vent venligst...</div>';
      var url = 'includes/mail/mail_ajax.php';
      var formData = NEL.serializeForm(contactform);

      // Return stripped input to search field
      var xhr = new XMLHttpRequest();
      xhr.open('POST', url, true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
          if (this.status == 200) {
            console.log(this.responseText);
            //if (this.responseText !== '') {
            messages.classList.remove('alert-danger', 'alert-info');
            messages.classList.add('alert', 'alert-success');
            messages.innerHTML = this.responseText;
            //}
          } else if (this.status !== 200) {
            messages.classList.remove('alert-success', 'alert-info');
            messages.classList.add('alert', 'alert-danger');
            messages.innerHTML = this.responseText;
          }
        }
      };
      xhr.send(formData);
    },
    clearInput: function () {
      // Clear form fields
      contactform.reset();
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

      var xhr = new XMLHttpRequest();
      xhr.open('GET', url, true);
      xhr.setRequestHeader('Content-type', 'application/json');
      xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
          if (this.status == 200) {
            console.log(this.responseText);
            var data = JSON.parse(this.responseText);
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
              var li = document.createElement('li');
              li.innerHTML = day + '.' + month + '.' + year + ': ' + newData[v];
              stats.appendChild(li);
            });
            var items = stats.innerHTML;
            var ul = "<ul class='list-unstyled'>" + items + "</ul>";
            stats.innerHTML = ul;
          } else {
            console.log(this.responseText);
          }
        }
      };
      xhr.send(null);
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
    scrollAnimation: function (el) {
      var destination = el;
      window.scrollTo({
        'behavior': 'smooth',
        'left': 0,
        'top': destination.offsetTop
      });
    },
    getSiblings: function (elem) {
      // Setup siblings array and get the first sibling
      var siblings = [];
      var sibling = elem.parentNode.firstChild;
      // Loop through each sibling and push to the array
      while (sibling) {
        if (sibling.nodeType === 1 && sibling !== elem) {
          siblings.push(sibling);
        }
        sibling = sibling.nextSibling;
      }
      return siblings;
    },
    getClosest: function (elem, selector) {
      // Traverse upwards until first match is found (.closest()):
      // Element.matches() polyfill
      if (!Element.prototype.matches) {
        Element.prototype.matches =
          Element.prototype.matchesSelector ||
          Element.prototype.mozMatchesSelector ||
          Element.prototype.msMatchesSelector ||
          Element.prototype.oMatchesSelector ||
          Element.prototype.webkitMatchesSelector ||
          function (s) {
            var matches = (this.document || this.ownerDocument).querySelectorAll(s),
              i = matches.length;
            while (--i >= 0 && matches.item(i) !== this) {}
            return i > -1;
          };
      }
      // Get closest match
      for (; elem && elem !== document; elem = elem.parentNode) {
        if (elem.matches(selector)) return elem;
      }
      return null;
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
    serializeForm: function (form) {
      //Serialize all form data into a query string
      var serialized = [];
      // Loop through each field in the form
      for (var i = 0; i < form.elements.length; i++) {
        var field = form.elements[i];
        // Don't serialize fields without a name, submits, buttons, file and reset inputs, and disabled fields
        if (!field.name || field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button') continue;

        // If a multi-select, get all selections
        if (field.type === 'select-multiple') {
          for (var n = 0; n < field.options.length; n++) {
            if (!field.options[n].selected) continue;
            serialized.push(encodeURIComponent(field.name) + "=" + encodeURIComponent(field.options[n].value));
          }
        }

        // Convert field data to a query string
        else if ((field.type !== 'checkbox' && field.type !== 'radio') || field.checked) {
          serialized.push(encodeURIComponent(field.name) + "=" + encodeURIComponent(field.value));
        }
      }
      return serialized.join('&');
    },
    getScript: function (source, callback) {
      // Replacement for jQuery.getScript
      var script = document.createElement('script');
      var prior = document.getElementsByTagName('script')[0];
      script.async = 1;
      script.onload = script.onreadystatechange = function (_, isAbort) {
        if (isAbort || !script.readyState || /loaded|complete/.test(script.readyState)) {
          script.onload = script.onreadystatechange = null;
          script = undefined;
          if (!isAbort && callback) setTimeout(callback, 0);
        }
      };
      script.src = source;
      prior.parentNode.insertBefore(script, prior);
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
    urlParam: function (name) {
      // Get query string from url
      var results = new RegExp('[\?&]' + name + '=([^]*)').exec(window.location.href);
      if (results == null) {
        return null;
      } else {
        return results[1] || 0;
      }
    },
  };

  // Run on load:
  var query = NEL.urlParam('q');
  if (query) {
    search.value = decodeURIComponent(NEL.strip_html_tags(query));
    NEL.trackThis("Search");
    NEL.scrollAnimation(assignments);
    NEL.searchDb();
  }

  NEL.setRatings();
  NEL.scroll();


  // Click events
  if (toggle) {
    toggle.addEventListener('click', function () {
      // Toggle off-canvas menu
      NEL.toggleNav();
    }, false);
  }

  var menuitems = document.querySelectorAll('.offcanvas-collapse .nav-link');
  // Close mobile menu when menu items are clicked
  Array.prototype.forEach.call(menuitems, function (item) {
    item.addEventListener("click", function () {
      toggle.click();
    });
  });

  var socialIcon = document.querySelectorAll('.utility-icons .nav-item a');
  // Social items clicked
  Array.prototype.forEach.call(socialIcon, function (icon) {
    icon.addEventListener("click", function () {
      var channel = icon.getAttribute('title');
      if (channel) {
        NEL.trackThis(channel);
      }
    });
  });


  if (btnSearch) {
    // Search assignments event
    btnSearch.addEventListener('click', function (e) {
      e.preventDefault();
      NEL.trackThis("Search");
      NEL.searchDb();
    }, false);
  }

  if (clearSearch) {
    // Clear search field
    clearSearch.addEventListener('click', function (e) {
      search.value = '';
      searchedAsssignments.innerHTML = '';
      allAssignments.style.display = 'block';
      NEL.clearErrors();
      // Remove url params
      NEL.addParams('q', '');
      NEL.trackThis("Clear button");
    }, false);
  }

  Array.prototype.forEach.call(sortHeader, function (heading) {
    // Sorting headers
    heading.addEventListener("click", function (e) {
      e.preventDefault();
      NEL.sortAssignments(e);
      NEL.trackThis("Sort");
    });
  });

  if (sendMsg) {
    // Send message
    sendMsg.addEventListener('click', function () {
      NEL.sendMsg();
    }, false);
  }

  if (getCoords) {
    // Get location
    getCoords.addEventListener('click', function () {
      NEL.getLocation();
    }, false);
  }

  if (scroller) {
    // Smooth scrolling from scroller
    scroller.addEventListener('click', function () {
      NEL.scrollAnimation(root);
    }, false);
  }

  Array.prototype.forEach.call(anchors, function (anchor) {
    // Smooth scrolling from anchors
    anchor.addEventListener("click", NEL.scrollAnimation(anchors));
  });

  Array.prototype.forEach.call(tags, function (tag) {
    // Tags initiate search
    tag.addEventListener("click", function (e) {
      e.preventDefault();
      var query = tag.getAttribute('data-tag');
      if (query) {
        search.value = decodeURIComponent(NEL.strip_html_tags(query));
        NEL.trackThis("Search by tag");
        NEL.searchDb();
      }
    });
  });

  if (search) {
    // Trigger search by Enter key
    search.addEventListener('keyup', function (e) {
      if (e.which === 13 || e.keyCode === 13 || e.key === "Enter") {
        btnSearch.click();
      }
    });
  }

  if (assignmentCategory) {
    assignmentCategory.onchange = function (e) {
      NEL.sortAssignments(e);
      NEL.trackThis("Sort");
    };
  }

  stars.forEach(function (star) {
    // Rating animations
    star.addEventListener("mouseover", function (e) {
      var siblings = NEL.getSiblings(star);
      star.classList.add('full');
    });
    star.addEventListener("mouseout", function (e) {
      this.classList.remove('full');
    });
  });

  stars.forEach(function (star) {
    // Rate
    star.addEventListener("click", function (e) {
      var rating = NEL.getClosest(star, '.ratings');
      var itemId = rating.getAttribute('data-id');
      var vote = star.getAttribute('data-vote');
      if (itemId && vote) {
        NEL.rate(itemId, vote);
        NEL.trackThis("Rated");
      }
    });
  });

  Array.prototype.forEach.call(contactFormModal, function (contactModal) {
    // Load Captcha when modal is opened
    contactModal.addEventListener("click", function () {
      messages.innerHTML = '';
      messages.classList.remove('alert', 'alert-danger', 'alert-success', 'alert-info');
      NEL.getScript('https://www.google.com/recaptcha/api.js?render=explicit&onload=onReCaptchaLoad');
      NEL.clearInput();
    });
  });

  // if (animationModal) {
  //   animationModal.addEventListener("click", function (e) {
  //     NEL.trackThis('Watching 3D animation');
  //   });
  // }
  // When 3D animation modal has been opened
  // $('#animation').on('shown.bs.modal', function (e) {
  //   NEL.trackThis('Watching 3D animation');
  // });

  if (stats) {
    NEL.getGitHubStats();
  }

  window.addEventListener('scroll', function () {
    NEL.scroll();
    NEL.scrollIndicator();
  });

}, false);

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
