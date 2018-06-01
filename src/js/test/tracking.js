// Google Analytics event tracking
module.exports = {
  trackThis: function(text) {
    gtag('send', 'event', {
      eventCategory: text,
      eventAction: 'Click'
    });
  }
};
