<!DOCTYPE html><html class="no-js" lang="da"><head><meta charset="utf-8"><meta http-equiv="x-ua-compatible" content="ie=edge"><meta name="robots" content="noindex"><meta content="width=device-width,initial-scale=1,shrink-to-fit=no" name="viewport"><meta content="Administrator - Statistik og oversigt" name="description"><link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png"><link rel="icon" type="image/png" sizes="32x32" href="img/icons/favicon-32x32.png"><link rel="icon" type="image/png" sizes="16x16" href="img/icons/favicon-16x16.png"><link rel="shortcut icon" href="favicon.ico"><link rel="manifest" href="manifest.json"><link rel="mask-icon" href="img/icons/safari-pinned-tab.svg" color="#d75959"><meta name="msapplication-TileColor" content="#d75959"><meta name="theme-color" content="#d75959"> <?php include('includes/functions.php'); ?> <title>Administrator-login</title><link href="dist/css/bootstrap.min.css" rel="stylesheet"> <?php include_once('includes/tracking/analyticsTracking.php'); ?> <script type="application/ld+json">{"@context":"http://schema.org","@type":"WebSite","url":"<?php echo siteUrl(); ?>","name":"Nanna Ellegard, Cand.it i Multimedier","description":"Administrator - Statistik og oversigt","publisher":"Nanna Ellegaard","potentialAction":{"@type":"SearchAction","target":"<?php echo siteUrl(); ?>?q={search_term_string}","query-input":"required name=search_term_string"}}</script><script type="application/ld+json">{"@context":"http://schema.org","@type":"Person","address":{"@type":"PostalAddress","addressLocality":"Copenhagen, Denmark"},"image":"<?php echo siteUrl(); ?>/img/nanna_ellegaard.jpg","jobTitle":"Front end developer","name":"Nanna Ellegaard","gender":"female","nationality":"Danish","owns":{"@type":"Website","name":"https://www.studenterforum.dk"},"worksFor":{"@type":"EducationalOrganization","name":"University of Copenhagen, Denmark"},"url":"<?php echo siteUrl(); ?>","sameAs":["https://www.facebook.com/nanna.ellegaard","https://www.linkedin.com/in/nannaellegaard/","https://plus.google.com/102076494911232201521?rel=author","https://github.com/nanna-dk/"]}</script></head><body> <?php include('includes/downloads/displayInfo.php'); ?> <div class="progress scrollProgress"><div id="scrollProgress" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div><nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" id="global-nav"><div class="container"><a class="navbar-brand mr-auto mr-lg-3" title="Forside" href="/"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-code"></use></svg> </a><button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas"><span class="sr-only">Toggle mobile menu</span> <span class="navbar-toggler-icon"></span></button><div class="navbar-collapse offcanvas-collapse"><ul class="navbar-nav mr-auto"><li class="nav-item"><a title="Forside" class="nav-link" href="/#about">Start <span class="sr-only">home</span></a></li><li class="nav-item"><a title="CV" class="nav-link" href="/#cv">CV</a></li><li class="nav-item"><a title="CV" class="nav-link" href="/#assignments">Opgaver</a></li><li class="nav-item"><a class="nav-link" href="" data-toggle="modal" data-target="#contactFormModal">Kontakt</a></li></ul><div class="utility-icons"><ul class="navbar-nav"><li class="nav-item"><a title="Facebook" class="nav-link" href="https://www.facebook.com/nanna.ellegaard" target="_blank" rel="noopener"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-facebook"></use></svg></a></li><li class="nav-item"><a title="LinkedIn" class="nav-link" href="https://www.linkedin.com/in/nannaellegaard/" target="_blank" rel="noopener"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-linkedin"></use></svg></a></li><li class="nav-item"><a title="send besked via webformular" class="nav-link" href="" data-toggle="modal" data-target="#contactFormModal"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-mail"></use></svg></a></li><li class="nav-item"><a title="GitHub" class="nav-link" href="https://github.com/nanna-dk/" target="_blank" rel="noopener"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-github"></use></svg></a></li><li class="nav-item"><a title="Skype" class="nav-link" href="skype:nanna_dk?chat" rel="noopener"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-skype"></use></svg></a></li><li class="nav-item"><a title="RSS" class="nav-link" href="includes/rss/" rel="noopener" target="_blank"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-rss"></use></svg></a></li></ul></div></div></div></nav><div class="content"> <?php
include(realpath(__DIR__ . '/includes/db.php'));
if (isset($_POST['submit'])) {
    $user = filter_var($_POST["username"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW);
    $psw  = filter_var($_POST["password"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW);

    $sql = "SELECT * FROM " . $userTable . " WHERE username = :username LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $user, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            $db_username = $row['username'];
            $db_password = $row['password'];
        }
        if (isset($db_username) && $user == $db_username && isset($db_password) && $psw == password_verify($psw, $db_password)) {
            // PASSWORD PROTECTED AREA STARTS HERE:
?> <section class="assignments" id="stats"><div class="container"><div class="card"><div class="card-body"><h5 class="card-title">Statistik</h5> <?php
                include('includes/stats/stats.php');
                ?> </div><div class="card-body"><div id="coords"><h5 class="card-title">Position</h5><div class="input-group mb-3"><div class="input-group-prepend"><button class="btn btn-secondary" type="button" id="generateCoords">Start</button></div><label for="generateCoords" class="sr-only">Find koordinater</label> <input id="geo" type="text" class="form-control" placeholder="Find koordinater" aria-label="Get coordiantes"></div></div></div><div class="card-body"><h5 class="card-title">Dev stats for dette website</h5><div id="gitHubStats"></div></div></div></div></section> <?php
            // PASSWORD PROTECTED AREA ENDS
        } else {
            echo '<div class="container p-3"><div class="alert alert-danger" role="alert">Brugernavn og/eller adgangskode er ikke korrekt.</div></div>';
        }
    } else {
        echo '<div class="container p-3"><div class="alert alert-danger" role="alert">Brugernavnet findes ikke - prøv igen.</div></div>';
    }
} else {
    // IF THE FORM WAS NOT SUBMITTED - SHOW FORM:
?> <div class="container px-3"><div class="card"><div class="card-body"><h5 class="card-title">Indtast login</h5><form method="post" class="mt-sm-4"><div class="form-group row"><label for="username" class="col-sm-3 col-form-label">Brugernavn</label><div class="col-sm-9"><input type="text" class="form-control" id="username" name="username" placeholder="Brugernavn" autofocus required></div></div><div class="form-group row"><label for="password" class="col-sm-3 col-form-label">Adgangskode</label><div class="col-sm-9"><input type="password" class="form-control" id="password" name="password" placeholder="Password" required></div></div><div class="form-group row"><div class="col-sm-9"><button type="submit" name="submit" class="btn btn-primary mb-2">Send</button></div></div></form></div></div></div> <?php
  // Closing
  $stmt = null;
  $pdo  = null;
}
?> </div><div class="modal fade" id="contactFormModal" role="dialog" aria-labelledby="responseLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="responseLabel">Kontakt</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><form id="contactform" method="POST"><div class="form-group"><input type="text" name="name" class="form-control" id="name" placeholder="Navn" autofocus required></div><div class="form-group"><input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required></div><div class="form-group"><textarea rows="6" name="message" class="form-control" id="msg" placeholder="Besked"></textarea></div><div class="feedback" role="alert"></div><div class="captcha-box"><div class="g-recaptcha" id="recaptcha" data-callback="onReCaptchaLoad" data-theme="light"></div></div></form></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Luk</button> <button type="submit" class="btn btn-primary" id="sendMail">Send</button></div></div></div></div><div class="modal fade" id="cd-cover" tabindex="-1" role="dialog" aria-labelledby="coverTitle" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="coverTitle">Cover til CD-rom</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><picture><source srcset="img/it-cover.webp" type="image/webp"><source srcset="img/it-cover.jpg" type="image/jpeg"><img src="img/it-cover.jpg" alt="Cover" loading="lazy" class="img-fluid"></picture></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Luk</button></div></div></div></div><div class="modal fade" id="animation" tabindex="-1" role="dialog" aria-labelledby="animationTitle" aria-hidden="true"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="animationTitle">3D-modellering: Return of the Mac. <small class="text-muted">Mp4 m. lyd</small></h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body text-center"><div class="embed-responsive embed-responsive-16by9 video-wrapper"><video class="embed-responsive-item video-style" poster="img/3d-modellering.jpg" controls playsinline><source src="includes/downloads/downloads.php?id=2"></video></div>Copyright © 2003 Nanna Ellegaard og Allan Lysholt</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Luk</button></div></div></div></div><footer class="site-footer"><div class="container"><div class="row"><div class="col-xs-12 col-md-6"><ul class="list-inline footer-links"><li class="list-inline-item"><a href="index.php#about">Forside</a></li><li class="list-inline-item"><a href="index.php#cv">CV</a></li><li class="list-inline-item"><a href="index.php#assignments">Opgaver</a></li><li class="list-inline-item"><a href="" data-toggle="modal" data-target="#contactFormModal">Kontakt</a></li></ul></div><div class="col-xs-12 col-md-6 text-lg-right text-xs-center mt-3 mt-sm-1"><p class="copyright-text">Sidst opdateret: <time datetime="<?php echo date(" Y-m-d " , getlastmod()) ?>"> <?php echo strftime( "%d. %m. %Y", getlastmod() ); ?></time><br>Copyright © <?php echo date("Y"); ?> <a href="admin.php" rel="noopener">Nanna Ellegaard</a></p></div></div></div></footer><a class="scrolltop fade" title="Til top" href="#about"><svg role="presentation"><use xlink:href="dist/img/icons.svg#icon-angle-up"></use></svg></a><script src="dist/js/bootstrap.min.js"></script><script src="dist/js/svgxuse.min.js" defer="defer"></script></body></html>