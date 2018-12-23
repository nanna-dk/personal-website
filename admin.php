<!DOCTYPE html><html class="no-js" lang="da"><head><meta charset="utf-8"><meta http-equiv="x-ua-compatible" content="ie=edge"><meta content="width=device-width,initial-scale=1,shrink-to-fit=no" name="viewport"><meta content="Nanna Ellegaard, Cand.it i Multimedier og frontend-udvikler med speciale indenfor html5, sass/less, javaScript, jQuery, node.js, git, mv. Se CV og opgaver fra Aarhus Universitet." name="description"><link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png"><link rel="icon" type="image/png" sizes="32x32" href="img/icons/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="img/icons/favicon-16x16.png"><link rel="shortcut icon" href="favicon.ico"><link rel="manifest" href="manifest.json"><link rel="mask-icon" href="img/icons/safari-pinned-tab.svg" color="#d75959"><meta name="msapplication-TileColor" content="#d75959"><meta name="theme-color" content="#d75959"> <?php include('includes/functions.php'); ?> <link rel="alternate" href="<?php echo siteUrl(); ?>" hreflang="da"><title>Nanna Ellegaard, Cand.it i Multimedier og frontend-udvikler</title><link href="dist/css/bootstrap.min.css" rel="stylesheet"> <?php include_once('includes/tracking/analyticsTracking.php'); ?> <script type="application/ld+json">{
      "@context": "http://schema.org",
      "@type": "WebSite",
      "url": "<?php echo siteUrl(); ?>",
      "name": "Nanna Ellegard, Cand.it i Multimedier",
      "description": "Nanna Ellegaard, Cand.it i Multimedier og frontend-udvikler med speciale indenfor html5, sass/less, javaScript, jQuery, node.js, git, mv. Se CV og opgaver fra fra Aarhus Universitet.",
      "publisher": "Nanna Ellegaard",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "<?php echo siteUrl(); ?>?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }</script><script type="application/ld+json">{
      "@context": "http://schema.org",
      "@type": "Person",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Copenhagen, Denmark"
      },
      "image": "<?php echo siteUrl(); ?>/img/nanna_ellegaard.jpg",
      "jobTitle": "Front end developer",
      "name": "Nanna Ellegaard",
      "gender": "female",
      "nationality": "Danish",
      "owns": {
        "@type": "Website",
        "name": "https://www.studenterforum.dk"
      },
      "worksFor": {
        "@type": "EducationalOrganization",
        "name": "University of Copenhagen, Denmark"
      },
      "url": "<?php echo siteUrl(); ?>",
      "sameAs": ["https://www.facebook.com/nanna.ellegaard", "https://www.linkedin.com/in/nannaellegaard/", "https://plus.google.com/102076494911232201521?rel=author", "https://github.com/nanna-dk/"]
    }</script></head><body> <?php include('includes/downloads/displayInfo.php'); ?> <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" id="global-nav"><div class="container"><a class="navbar-brand mr-auto mr-lg-3" title="Start" href="index.php"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-code"></use></svg> </a><button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas"><span class="sr-only">Toggle mobile menu</span> <span class="navbar-toggler-icon"></span></button><div class="navbar-collapse offcanvas-collapse"><ul class="navbar-nav mr-auto"><li class="nav-item"><a title="Start" class="nav-link" href="index.php#about">Start <span class="sr-only">home</span></a></li><li class="nav-item"><a title="CV" class="nav-link" href="index.php#cv">CV</a></li><li class="nav-item"><a title="CV" class="nav-link" href="index.php#assignments">Opgaver</a></li><li class="nav-item"><a class="nav-link" href="" data-toggle="modal" data-target="#contactFormModal">Kontakt</a></li></ul><div class="utility-icons"><ul class="navbar-nav"><li class="nav-item"><a title="Facebook" class="nav-link" href="https://www.facebook.com/nanna.ellegaard" target="_blank" rel="noopener"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-facebook"></use></svg></a></li><li class="nav-item"><a title="LinkedIn" class="nav-link" href="https://www.linkedin.com/in/nannaellegaard/" target="_blank" rel="noopener"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-linkedin"></use></svg></a></li><li class="nav-item"><a title="send besked via webformular" class="nav-link" href="" data-toggle="modal" data-target="#contactFormModal"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-mail"></use></svg></a></li><li class="nav-item"><a title="GitHub" class="nav-link" href="https://github.com/nanna-dk/" target="_blank" rel="noopener"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-github"></use></svg></a></li><li class="nav-item"><a title="Skype" class="nav-link" href="skype:nanna_dk?chat" rel="noopener"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-skype"></use></svg></a></li><li class="nav-item"><a title="RSS" class="nav-link" href="includes/rss/index.php" rel="noopener" target="_blank"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-rss"></use></svg></a></li></ul></div></div></div></nav><section class="assignments" id="stats"><div class="container"><div class="card"><div class="card-body"><h5 class="card-title">Statistik</h5><div class="card-body"> <?php include('includes/stats/stats.php'); ?> </div></div><div class="card-body"><div id="coords"><h5 class="card-title">Position</h5><div class="input-group mb-3"><div class="input-group-prepend"><button class="btn btn-secondary" type="button" id="generateCoords">Start</button></div><label for="generateCoords" class="sr-only">Find koordinater</label> <input id="geo" type="text" class="form-control" placeholder="Find koordinater" aria-label="Get coordiantes"></div></div></div><div class="card-body"><h5 class="card-title">Dev stats for dette website</h5><div id="gitHubStats"></div></div></div></div></section><div class="modal fade" id="contactFormModal" role="dialog" aria-labelledby="responseLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="responseLabel">Kontakt</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><form id="contactform" method="POST"><div class="form-group"><input type="text" name="name" class="form-control" id="name" placeholder="Navn"></div><div class="form-group"><input type="email" name="email" class="form-control" id="email" placeholder="E-mail"></div><div class="form-group"><textarea rows="6" name="message" class="form-control" id="msg" placeholder="Besked"></textarea></div><div class="feedback" role="alert"></div><div class="captcha-box"><div class="g-recaptcha" id="recaptcha" data-callback="onReCaptchaLoad" data-theme="light"></div></div></form></div><div class="modal-footer"><button type="button" class="btn btn-default float-left" data-dismiss="modal">Luk</button> <button type="submit" class="btn btn-primary float-right" id="sendMail">Send</button></div></div></div></div><footer class="site-footer"><div class="container"><div class="row"><div class="col-xs-12 col-md-6"><ul class="list-inline footer-links"><li class="list-inline-item"><a href="#about">Start</a></li><li class="list-inline-item"><a href="#cv">CV</a></li><li class="list-inline-item"><a href="#assignments">Opgaver</a></li><li class="list-inline-item"><a href="" data-toggle="modal" data-target="#contactFormModal">Kontakt</a></li></ul></div><div class="col-xs-12 col-md-6 text-lg-right text-xs-center mt-3 mt-sm-1"><p class="copyright-text">Sidst opdateret: <time datetime="<?php echo date(" Y-m-d " , getlastmod()) ?>"> <?php echo strftime( "%d. %m. %Y", getlastmod() ); ?></time><br>Copyright © <?php echo date("Y"); ?> <a href="admin.php#about">Nanna Ellegaard</a></p></div></div></div></footer><a class="scrolltop fade" title="top" href="#about"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-angle-up"></use></svg></a><script src="dist/js/bootstrap.min.js"></script><script src="dist/js/svgxuse.min.js" defer="defer"></script></body></html>