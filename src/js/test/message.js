// Send message
module.exports = {
  sendMessage: function() {
    // Serialize the form data.
    var formData = $(contactform).serialize();
    var url = 'includes/mail/mail_ajax.php';
    $.ajax({
      type: 'post',
      url: url,
      beforeSend: function() {
        $(messages).html('<div class="px-2 mb-4">Vent venligst...</div>');
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
  },
  clearInput: function() {
    function clearInput() {
      $('#name').val('');
      $('#email').val('');
      $('#msg').val('');
      grecaptcha.reset();
    }
  }
}
