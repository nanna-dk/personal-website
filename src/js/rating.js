module.exports = {
  setRatings: function () {
    $('.ratings').each(function() {
      var average = $(this).attr('data-avg');
      average = (Number(average) * 20);
      $(this).find('.bg').css('width', 0);
      $(this).find('.bg').animate({
        width: average + '%'
      }, 500);
    });
  },
  vote: function () {
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
          //  console.log(data);
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
  }
};
