module.exports = {
  sortAssignments: function (e) {
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
      success: function(response) {
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
        setRatings();
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  }
};
