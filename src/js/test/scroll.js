module.exports = {
  smoothScroll: function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length
        ? target
        : $('[name="' + this.hash.slice(1) + '"]');
      if (target.length) {
        $('html, body').animate({
          //Extra px are added due to the sticky topmenu
          scrollTop: target.offset().top - 60
        }, 500);
        return false;
      }
    }
  }
};
