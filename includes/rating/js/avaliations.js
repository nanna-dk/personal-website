$(function() {
  var average = $('.ratingAverage').attr('data-average');
  function getAvg(average) {
    average = (Number(average) * 20);
    $('.bg').css('width', 0);
    $('.bar .bg').animate({
      width: average + '%'
    }, 500);
  }

  getAvg(average);

  $('.star').on('mouseover', function() {
    var indexAtual = $('.star').index(this);
    for (var i = 0; i <= indexAtual; i++) {
      $('.star:eq(' + i + ')').addClass('full');
    }
  });

  $('.star').on('mouseout', function() {
    $('.star').removeClass('full');
  });

  $('.star').on('click', function() {
    var itemId = $('.item').attr('data-id');
    var vote = $(this).attr('data-vote');
    $.post('sys/vote.php', {
      vote: 'yes',
      item: itemId,
      point: vote
    }, function(data) {
      getAvg(data.average);
      $('.votes span').html(data.votos);
    }, 'jSON');
  });
});
