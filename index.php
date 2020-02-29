<!DOCTYPE html><html class="no-js" lang="da"><head> <?php include('includes/functions.php'); ?> <meta charset="utf-8"><meta http-equiv="x-ua-compatible" content="ie=edge"><meta name="robots" content=""><meta content="width=device-width,initial-scale=1,shrink-to-fit=no" name="viewport"><meta content="Nanna Ellegaard, Cand.it i Multimedier og frontend-udvikler med speciale indenfor html5, sass/less, javaScript, jQuery, node.js, git, PHP mv. Se CV og opgaver fra Aarhus Universitet." name="description"><meta property="og:type" content="website"><meta property="og:title" content="Cand.it i Multimedier og frontend-udvikler"><meta property="og:image" content="<?php echo siteUrl(); ?>/img/icons/social-article-img.png"><meta property="og:image:width" content="1200"><meta property="og:image:height" content="627"><meta property="og:description" content="Nanna Ellegaard, Cand.it i Multimedier og frontend-udvikler med speciale indenfor html5, sass/less, javaScript, jQuery, node.js, git, PHP mv. Se CV og opgaver fra Aarhus Universitet."><meta property="og:url" content="<?php echo siteUrl(); ?>"><link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png"><link rel="icon" type="image/png" sizes="32x32" href="img/icons/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="img/icons/favicon-16x16.png"><link rel="shortcut icon" href="favicon.ico"><link rel="manifest" href="manifest.json"><link rel="mask-icon" href="img/icons/safari-pinned-tab.svg" color="#d75959"><meta name="msapplication-TileColor" content="#d75959"><meta name="theme-color" content="#d75959"><title>Cand.it i Multimedier og frontend-udvikler</title> <?php include('includes/db.php'); ?> <link href="dist/css/style.min.css?v=<?php echo $version_number;?>" rel="stylesheet"> <?php include_once('includes/tracking/analyticsTracking.php'); ?> <script type="application/ld+json">{"@context":"http://schema.org","@type":"WebSite","url":"<?php echo siteUrl(); ?>","name":"Nanna Ellegard, Cand.it i Multimedier","description":"Nanna Ellegaard, Cand.it i Multimedier og frontend-udvikler med speciale indenfor html5, sass/less, javaScript, jQuery, node.js, git, PHP mv. Se CV og opgaver fra Aarhus Universitet.","publisher":"Nanna Ellegaard","potentialAction":{"@type":"SearchAction","target":"<?php echo siteUrl(); ?>?q={search_term_string}","query-input":"required name=search_term_string"}}</script><script type="application/ld+json">{"@context":"http://schema.org","@type":"Person","address":{"@type":"PostalAddress","addressLocality":"Copenhagen, Denmark"},"image":"<?php echo siteUrl(); ?>/img/nanna_ellegaard.jpg","jobTitle":"Front end developer","name":"Nanna Ellegaard","gender":"female","nationality":"Danish","owns":{"@type":"Website","name":"https://www.studenterforum.dk"},"worksFor":{"@type":"EducationalOrganization","name":"University of Copenhagen, Denmark"},"url":"<?php echo siteUrl(); ?>","sameAs":["https://www.facebook.com/nanna.ellegaard","https://www.linkedin.com/in/nannaellegaard/","https://plus.google.com/102076494911232201521?rel=author","https://github.com/nanna-dk/"]}</script></head><body><nav aria-label="Spring til indhold på siden" class="jumpbox" title="Spring til indhold på siden"><ul class="jump"><li><a accesskey="1" class="btn btn-primary btn-small" href="#global-nav" title="Spring til sidens menu">Emnenavigation</a></li><li><a accesskey="2" class="btn btn-primary btn-small" href="#about" title="Spring til indhold på siden">Indhold</a></li><li><a accesskey="3" class="btn btn-primary btn-small" href="#footer" title="Spring til footer">Footerlinks</a></li></ul></nav> <?php include('includes/downloads/displayInfo.php'); ?> <div class="progress scrollProgress"><div id="scrollProgress" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div><nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" id="global-nav" aria-label="Global navigation" itemscope itemtype="https://schema.org/SiteNavigationElement"><div class="container"><a class="navbar-brand mr-auto mr-lg-3" aria-label="Forside" href="/"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-code"></use></svg> </a><button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas"><span class="sr-only">Toggle mobile menu</span> <span class="navbar-toggler-icon"></span></button><div class="navbar-collapse offcanvas-collapse"><ul class="navbar-nav mr-auto"><li class="nav-item"><a title="Forside" class="nav-link" itemprop="url" href="/#about">Start <span class="sr-only">home</span></a></li><li class="nav-item"><a title="Nannas CV" class="nav-link" itemprop="url" href="/#cv">CV</a></li><li class="nav-item"><a title="Opgaver" class="nav-link" itemprop="url" href="/#assignments">Opgaver</a></li><li class="nav-item"><a title="Kontakt" class="nav-link" href="" itemprop="url" data-toggle="modal" data-target="#contactFormModal">Kontakt</a></li></ul><div class="utility-icons"><ul class="navbar-nav" itemscope itemtype="https://schema.org/Person"><li class="nav-item"><a title="Facebook" class="nav-link" href="https://www.facebook.com/nanna.ellegaard" target="_blank" rel="noopener" itemprop="sameAs"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-facebook"></use></svg></a></li><li class="nav-item"><a title="LinkedIn" class="nav-link" href="https://www.linkedin.com/in/nannaellegaard/" target="_blank" rel="noopener" itemprop="sameAs"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-linkedin"></use></svg></a></li><li class="nav-item"><a title="send besked via webformular" class="nav-link" href="" data-toggle="modal" data-target="#contactFormModal" itemprop="url"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-mail"></use></svg></a></li><li class="nav-item"><a title="GitHub" class="nav-link" href="https://github.com/nanna-dk/" target="_blank" rel="noopener" itemprop="sameAs"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-github"></use></svg></a></li><li class="nav-item"><a title="Skype" class="nav-link" href="skype:nanna_dk?chat" rel="noopener" itemprop="sameAs"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-skype"></use></svg></a></li><li class="nav-item"><a title="RSS" class="nav-link" href="includes/rss/" rel="noopener" target="_blank" itemprop="url"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-rss"></use></svg></a></li></ul></div></div></div></nav><div class="content"><section class="about" id="about"><div class="container"><div class="card"><div class="card-body"><h1>Nannas website</h1><p>Website tilhørende Nanna Ellegaard. Dette er min interaktive legeplads.<br><br>Desuden kan man finde mit <a title="Find CV" href="#cv">CV</a> og diverse <a href="#assignments" title="Søg i opgaver">opgaver</a> fra Spansk, Europastudier og Cand.it i Multimedier - alle sammen skrevet i min tid på Aarhus Universitet.</p><p>Jeg kan kontaktes via <a href="" data-toggle="modal" data-target="#contactFormModal">kontaktformularen</a>.</p></div></div></div></section><section class="cv" id="cv"><div class="container"><div class="card"><div class="card-body"><h2>Erhvervserfaring</h2><div class="experience"><ul><li class="date">Nov. 2015 -</li><li class="company"><a href="https://www.ku.dk" target="_blank" rel="noopener">Københavns Universitet</a></li><li class="position">Front-end developer</li></ul><ul><li class="date">Maj 2012 - okt. 2015</li><li class="company"><a href="https://www.telenor.dk" target="_blank" rel="noopener">Telenor A/S</a></li><li class="position">Webmaster / front-end developer</li></ul><ul><li class="date">Dec. 2005 - maj 2012</li><li class="company"><a href="https://www.lumesse.dk" target="_blank" rel="noopener">Lumesse A/S</a> (tidl. StepStone Solutions A/S)</li><li class="position">Web consultant / web developer</li></ul><ul><li class="date">Dec. 2003 - &infin;</li><li class="company"><a href="https://www.studenterforum.dk" target="_blank" rel="noopener">Studenterforum.dk</a></li><li class="position">Medstifter og webansvarlig</li></ul></div><h2>Uddannelse</h2><div class="experience"><ul><li class="date">2001 - 2005</li><li class="company"><a class="no-event">Cand.it i multimedier ved IT-Vest, Aarhus Universitet</a></li><li class="position"><a href="includes/downloads/downloads.php?id=10" target="_blank" rel="noopener"> <?php displayTitle(10) ?> </a><br>Oprettet: <?php displayDate(10) ?>.<br>Downloads: <?php displayHits(10) ?>.</li></ul><ul><li class="date">1998 - 2001</li><li class="company"><a class="no-event">Bachelor i Spansk og Europastudier, Aarhus Universitet</a></li><li class="position">Bachelorprojekt: <a href="includes/downloads/downloads.php?id=9" target="_blank" rel="noopener"> <?php displayTitle(9) ?> </a><br>Oprettet: <?php displayDate(9) ?>.<br>Downloads: <?php displayHits(9) ?>.</li></ul><ul><li class="date">1993 - 1996</li><li class="company"><a class="no-event">Sproglig student ved Svendborg Statsgymasium</a></li><li class="position"><ul><li>Spansk og engelsk på højniveau.</li><li>Billedkunst på mellemniveau.</li></ul></li></ul></div></div></div></div></section><section class="assignments" id="assignments"><div class="container"><div class="card"><div class="card-body"><div class="row"><div class="col-xs-12 col-md-5"><h2>Opgaver</h2></div><div class="col-xs-12 col-md-7 mt-2 mb-3 mt-md-0"><div class="input-group mb-3"><label class="sr-only-focusable mr-2" for="search" id="search-label">Søg i opgaver</label> <input type="text" class="form-control" id="search" placeholder="Søg efter opgaver..." aria-label="search-label" required><div class="input-group-append"><button class="btn btn-secondary" type="reset" title="Ryd" id="clearSearch" aria-label="Ryd">X</button> <button class="btn btn-primary" type="button" id="goSearch" accesskey="s" title="Søg ved tryk på [Alt] + s" aria-label="Søg">Søg</button></div><div class="invalid-feedback">Indtast et eller flere søgeord.</div></div></div></div><div class="row"><div class="col-sm-12"><p>Opgaverne er ment som inspiration - ikke til copy/paste. :-)<br>Hyppigste søgeord: <?php include('includes/tags/tags.php'); ?> </p><ul class="nav nav-pills"><li class="nav-item"><a class="nav-sort-label">Sorter efter:</a></li><li class="nav-item"><a data-id="title-asc" title="Sortér" href="" class="nav-link sorting">Titel <svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-angle-up"></use></svg></a></li><li class="nav-item"><a data-id="clicks-asc" title="Sorterer hits faldende" href="" class="nav-link sorting desc">Hits <svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-angle-up"></use></svg></a></li><li class="nav-item"><a data-id="dates-asc" title="Sortér dato" href="" class="nav-link sorting">Dato <svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-angle-up"></use></svg></a></li><li class="nav-item"><a data-id="rating-asc" title="Sortér rating" href="" class="nav-link sorting">Rating <svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-angle-up"></use></svg></a></li><li class="nav-item"><label for="categories" class="sr-only">Kategorier</label> <select class="form-control form-control-sm" id="categories" aria-label="Søg i kategori"><option value="0">Alle kategorier</option><option value="2">Cand.it i multimedier</option><option value="1">Spansk og Europastudier</option></select></li></ul></div></div><div id="allAssignments"> <?php include ('includes/downloads/allAssignments.php') ?> </div></div></div></div></section></div><div class="modal fade" id="contactFormModal" role="dialog" aria-labelledby="responseLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><form id="contactform" method="POST"><div class="modal-header"><h5 class="modal-title" id="responseLabel">Kontakt</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="form-group"><input type="text" name="name" class="form-control" id="name" aria-label="Indtast navn" placeholder="Navn" autofocus required></div><div class="form-group"><input type="email" name="email" class="form-control" id="email" aria-label="Indtast e-mailadresse" placeholder="E-mail" required></div><div class="form-group"><textarea rows="6" name="message" class="form-control" id="msg" aria-label="Skriv besked" placeholder="Besked"></textarea></div><div class="feedback" role="alert" aria-atomic="true"></div><input type="hidden" value="" id="g-recaptcha-response" name="g-recaptcha-response"><div class="captcha-box"><div class="g-recaptcha" id="recaptcha" data-callback="" aria-label="Captcha" data-theme="light"></div></div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Luk</button> <button type="submit" class="btn btn-primary" id="sendMail">Send</button></div></form></div></div></div><div class="modal fade" id="cd-cover" tabindex="-1" role="dialog" aria-labelledby="coverTitle" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="coverTitle">Cover til CD-rom</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><picture itemprop="image" itemscope itemtype="https://schema.org/ImageObject"><source itemprop="url contentUrl" srcset="img/it-cover.webp" type="image/webp"><source itemprop="url contentUrl" srcset="img/it-cover.jpg" type="image/jpeg"><img src="img/it-cover.jpg" alt="Cover" width="600" height="450" loading="lazy" class="img-fluid"><meta itemprop="width" content="600"><meta itemprop="height" content="450"></picture></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Luk</button></div></div></div></div><div class="modal fade" id="animation" tabindex="-1" role="dialog" aria-labelledby="animationTitle" aria-hidden="true"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="animationTitle">3D-modellering: Return of the Mac. <small class="text-muted">Mp4 m. lyd</small></h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body text-center"><div class="embed-responsive embed-responsive-16by9 video-wrapper" itemprop="video" itemscope itemtype="https://schema.org/VideoObject"><video class="embed-responsive-item video-style" poster="img/3d-modellering.jpg" controls playsinline><source itemprop="contentUrl" src="includes/downloads/downloads.php?id=2">I’m sorry, your browser doesn’t support HTML5 video.</video><meta itemprop="name" content="3D modellering"><meta itemprop="description" content="Return of the Mac - en animation."><meta itemprop="duration" content="PT1M44S"><meta itemprop="uploadDate" content="2003-01-17T15:16:09+01:00"><meta itemprop="thumbnailUrl" content="img/3d-modellering.jpg"></div>Copyright © 2003 Nanna Ellegaard og Allan Lysholt</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Luk</button></div></div></div></div><footer id="footer" class="site-footer"><div class="container"><div class="row"><div class="col-xs-12 col-md-6"><ul class="list-inline footer-links"><li class="list-inline-item"><a href="index.php#about" title="Naviger til forside">Forside</a></li><li class="list-inline-item"><a href="index.php#cv">CV</a></li><li class="list-inline-item"><a href="index.php#assignments" title="Find opgaver">Opgaver</a></li><li class="list-inline-item"><a href="" data-toggle="modal" data-target="#contactFormModal" title="Åbn kontaktformular">Kontakt</a></li></ul></div><div class="col-xs-12 col-md-6 text-lg-right text-xs-center mt-3 mt-sm-1"><p class="copyright-text">Sidst opdateret: <time datetime="<?php echo date(" Y-m-d " , getlastmod()) ?>"> <?php echo strftime( "%d. %m. %Y", getlastmod() ); ?></time><br>Copyright © <?php echo date("Y"); ?> <span itemprop="author" itemscope="itemscope" itemtype="https://schema.org/Person"><a href="admin.php" rel="author" itemprop="url"><span itemprop="name">Nanna Ellegaard</span></a></span></p></div></div></div></footer><nav aria-label="Scroll til toppen"><a class="scrolltop fade" title="Til top" href="#about"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-angle-up"></use></svg></a></nav><script src="dist/js/script.min.js?v=<?php echo $version_number;?>"></script><script src="dist/js/svgxuse.min.js" defer="defer"></script></body></html>