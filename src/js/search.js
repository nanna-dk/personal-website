module.exports = {
  searchDb: function () {
    var url = 'includes/search/searchAssignments.php';
    var q = search.val();
    q = strip_html_tags(q);
    if (!q) {
      searchedAsssignments.html('');
      allAssignments.show();
      search.addClass('is-invalid');
    } else {
      // Return stripped input to search field
      search.val(strip_html_tags(q));
      $.ajax({
        type: 'post',
        url: url,
        data: {
          search: q
        },
        success: function(response) {
          allAssignments.hide();
          clearErrors();
          searchedAsssignments.hide().html(response).fadeIn(600);
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
};
