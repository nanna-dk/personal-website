var message = require('./message');
var track = require('./tracking');
var search = require('./search');
var params = require('./params');
var strip = require('./safety');
var sort = require('./sorting');
var scroll = require('./scroll');
var clearErrors = require('./clear');
var rating = require('./rating');

$(document).ready(function($) {
  //Search
  var search = $('#search');
  var clearSearch = $('#clearSearch');
  var btnSearch = $('#goSearch');
  // Send e-mail
  var contactform = $('#contactform');
  var sendMsg = $('#sendMail');
  var messages = $('.feedback');
  // assignments
  var allAssignments = $('#defaultAssignments');
  var searchedAsssignments = $('#searchAssignments');
  // sorting
  var sortHeader = $('.sorting');
  // Scroll
  var scroller = $('.scrolltop');
  // Toggle button
  var toggle = $('[data-toggle="offcanvas"]')

  // Run search on load if query is present
  var query = params.urlParam('q');
  if (query) {
    $(search).val(decodeURIComponent(strip.strip_html_tags(query)));
    track.trackThis("Search");
    $('html, body').animate({
      scrollTop: searchedAsssignments.offset().top
    }, 500);
    search.searchDb();
  }

  // Toggle off-canvas menu
  toggle.on('click', function() {
    $('.offcanvas-collapse').toggleClass('open');
    scroller.toggleClass('d-none');
  });

  $('.offcanvas-collapse .nav-link').on('click', function() {
    toggle.click();
  });

  rating.setRatings();

  $(document).on('mouseover', '.star', function() {
    $(this).prevAll().addBack().addClass('full');
  });

  $(document).on('mouseout', '.star', function() {
    $(this).removeClass('full');
  });

  $(document).on('click', '.star', function() {
    rating.vote();
  });

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
    clearErrors.clearErrors();
    // Remove url params
    params.addParams('q', '');
    track.trackThis("Clear button");
  });

  // Sorting headers
  sortHeader.click(function(e) {
    e.preventDefault();
    sort.sortAssignments(e);
    track.trackThis("Sort");
  });

  // Lazy load single image
  $('#cd-cover').on('show.bs.modal', function(e) {
    $('#cover').attr('src', 'img/it-cover.jpg');
  });

  // Smooth scrolling from anchors
  $('a[href*="#"]').not('.accordion').click(function() {
    scroll.smoothScroll();
  });

  // Send message
  sendMsg.click(function() {
    message.sendMessage();
  });

  // Clear feedback mmessages when modal is closed
  contactform.on('hidden.bs.modal', function() {
    messages.text('').removeClass('alert alert-danger alert-success');
    message.clearInput();
  })

  // Search assignments event
  btnSearch.click(function(e) {
    e.preventDefault();
    track.trackThis("Search");
    search.searchDb();
  });
});
