<!DOCTYPE html>
<html lang="da">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="Nanna Ellegaard, frontend-udvikler" name="description">
    <meta name="theme-color" content="#c14343">
    <meta name="google-site-verification" content="MV2MazdIeTTrYsADXu2ARdwg44eWp_co_c7P2LZ7oyc">
    <link href="img/favicon.ico" rel="icon">
    <title>Nannas website</title>
    <link href="dist/css/style.css" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <?php
    include( 'includes/mail/sendmail.php');
    include( 'includes/clicks/displayClicks.php');
    ?>
  </head>

<body>
    <?php include( 'includes/menus/topmenuitems.php'); ?>
    <!-- About -->
    <section class="about" id="about">
        <div class="container text-xs-center">
            <h2>About Bell Theme</h2>
            <p> Voluptua scripserit per ad, laudem viderer sit ex. Ex alia corrumpit voluptatibus usu, sed unum convenire id. Ut cum nisl moderatius, per nihil dicant commodo an. Eum tacimates erroribus ad. Atqui feugiat euripidis ea pri, sed veniam tacimates ex. Menandri temporibus an duo. </p>
        </div>
    </section>
    <!-- /About -->
    <!-- Cv -->
    <section class="cv" id="cv">
        <div class="container">
            <h2>CV</h2>
            <div id="pro-experience">
                <h3>Erhvervserfaring</h3>
                <div class="experience">
                    <ul>
                        <li class="date">10/2015 -</li>
                        <li class="company"> <a href="http.//www.ku.dk">
                           Københavns Universitet
                        </a> </li>
                        <li class="position">Front-end developer</li>
                    </ul>
                    <ul>
                        <li class="date">05/2012 - 10/2015</li>
                        <li class="company"> <a href="http://www.telenor.dk">
                           Telenor A/S
                        </a> </li>
                        <li class="position">Webmaster / front-end developer</li>
                    </ul>
                    <ul>
                        <li class="date">12/2005 - 05/2012</li>
                        <li class="company"> <a href="http://www.lumesse.dk">
                          Lumesse A/S
                        </a> </li>
                        <li class="position">Web consultant / web developer</li>
                    </ul>
                    <ul>
                        <li class="date">12/2003 - &infin;</li>
                        <li class="company"> <a href="http://www.studenterforum.dk">
                          Studenterforum.dk
                        </a> </li>
                        <li class="position">Medstifter og webansvarlig</li>
                    </ul>
                </div>
                <h3>Kurser</h3>
                <div class="experience">
                    <ul>
                        <li class="date">2015</li>
                        <li class="company"> <a href="http://www.superusers.dk/kursus/su0093/">
                        jQuery - Det samlede client web-udviklingsforløb
                     </a> </li>
                        <li class="position">3 dage</li>
                    </ul>
                    <ul>
                        <li class="date">2014</li>
                        <li class="company"> <a href="http://www.episerver.com/Training/available-courses/developers/episerver-cms-development-fundamentals/">
                        EPiServer 7 CMS - Development Fundamentals
                     </a> </li>
                        <li class="position">3 dage</li>
                    </ul>
                    <ul>
                        <li class="date">2008</li>
                        <li class="company">
                          <a class="no-event">grundlæggende XML</a>
                        </li>
                        <li class="position">2 dage</li>
                    </ul>
                    <ul>
                        <li class="date">2006</li>
                        <li class="company">
                          <a class="no-event">Digital billedbehandling med Adobe Photoshop CS2</a>
                        </li>
                        <li class="position">2 dage</li>
                    </ul>
                    <ul>
                        <li class="date">2005</li>
                        <li class="company">
                            <a class="no-event">It-supporter med MCP-certificering: MCP (Microsoft Certified Professional) Exam 70-270</a>
                        </li>
                        <li class="position">6 uger</li>
                    </ul>
                </div>
                <h3>Uddannelse</h3>
                <div class="experience">
                  <ul>
                      <li class="date">2001 - 2005</li>
                      <li class="company">
                          <a class="no-event">Cand.it i multimedier ved IT-Vest, Aarhus Universitet</a>
                      </li>
                      <li class="position">Speciale: Samarbejde, CSCW, artikulationsarbejde og awareness</li>
                  </ul>
                  <ul>
                      <li class="date">1998 - 2001</li>
                      <li class="company">
                          <a class="no-event">Bachelor i Spansk og Europastudier, Aarhus Universitet</a>
                      </li>
                      <li class="position">Bachelorprojekt: Sprog og identitet i Baskerlandet og Katalonien</li>
                  </ul>
                  <ul>
                      <li class="date">1993 - 1996</li>
                      <li class="company">
                          <a class="no-event">Sproglig student ved Svendborg Statsgymasium</a>
                      </li>
                      <li class="position">
                        <ul>
                          <li>Spansk og engelsk på højniveau</li>
                          <li>Billedkunst på mellemniveau</li>
                        </ul>
                      </li>
                  </ul>
                </div>
            </div>
    </section>
    <!-- /Cv -->
    <section class="assignments" id="assignments">
        <div class="container">
            <h2>Opgaver</h2>
            <ul class="assignments clearfix">
                <li><a href="includes/clicks/click.php?id=1">Google</a>
                    <?php displayHits(1) ?> </li>
                <li><a href="includes/clicks/click.php?id=2">Ku.dk</a>
                    <?php displayHits(2) ?> </li>
            </ul>
              <div class="card">
                  <h4 class="card-header">Mod nye forståelser af udvikling af teknologi</h4>
                  <div class="card-block">
                      <p class="card-text">Informationsvidenskab og nye opfattelser af teknologi. Analyse af de begreber, indsigter og problemstillinger som bl.a. CSCW-feltet har bragt på banen. Herunder vurderes forskellige perspektiver på menneskelig handling, og hvad disse betyder for opfattelser af arbejde, teknologianvendelse og design.</p> <a href="#" class="btn btn-primary">Download</a> </div>
                  <div class="card-footer clearfix text-muted">
                      <div class="float-left">Oprettet: 12. 11. 2005</div>
                      <div class="float-right">Downloads: 2.404</div>
                  </div>
              </div>
              <div class="card">
                  <h4 class="card-header">3D-modellering: arbejdsrapport</h4>
                  <div class="card-block">
                      <p class="card-text">Arbejdsrapport tilhørende 3D-animation Return of the Mac.</p> <a href="#" class="btn btn-primary">Download</a> </div>
                  <div class="card-footer clearfix text-muted">
                      <div class="float-left">Oprettet: 12. 11. 2005</div>
                      <div class="float-right">Downloads: 2.404</div>
                  </div>
              </div>
              <div class="card">
                  <h4 class="card-header">3D-modellering: Return of the Mac</h4>
                  <div class="card-block">
                      <p class="card-text">3D-animation lavet i Maya™ 4.0.2 fra Alias|Wavefront. 1:44 min. DivX. Arbejdsrapport herover.</p> <a href="#" class="btn btn-primary">Download</a> </div>
                  <div class="card-footer clearfix text-muted">
                      <div class="float-left">Oprettet: 12. 11. 2005</div>
                      <div class="float-right">Downloads: 2.404</div>
                  </div>
              </div>
              <div class="card">
                  <h4 class="card-header">Multimedieæstetik</h4>
                  <div class="card-block">
                      <p class="card-text">Opgave om HCI-interfaces vs. kulturelle interfaces. Komparativ analyse af browserne Internet Explorer og Web Stalker. Er desktop-metaforen som kompleksitetsreducerende begreb stadig gyldig?</p> <a href="#" class="btn btn-primary">Download</a> </div>
                  <div class="card-footer clearfix text-muted">
                      <div class="float-left">Oprettet: 12. 11. 2005</div>
                      <div class="float-right">Downloads: 2.404</div>
                  </div>
              </div>
              <div class="card">
                  <h4 class="card-header">Human-computer interaction (HCI) II</h4>
                  <div class="card-block">
                      <p class="card-text">Uddybende opgave om ovenstående evaluering af MS PowerPoint 2000.</p> <a href="#" class="btn btn-primary">Download</a> </div>
                  <div class="card-footer clearfix text-muted">
                      <div class="float-left">Oprettet: 12. 11. 2005</div>
                      <div class="float-right">Downloads: 2.404</div>
                  </div>
              </div>
              <div class="card">
                  <h4 class="card-header">Human-computer interaction (HCI)</h4>
                  <div class="card-block">
                      <p class="card-text">Evaluering af MS PowerPoint 2000 på baggrund af teorier om interface og usability. Inkl. transkriptioner og screenshots.</p> <a href="#" class="btn btn-primary">Download</a> </div>
                  <div class="card-footer clearfix text-muted">
                      <div class="float-left">Oprettet: 12. 11. 2005</div>
                      <div class="float-right">Downloads: 2.404</div>
                  </div>
              </div>
              <div class="card">
                  <h4 class="card-header">Multimediedesign - arbejdsrapport</h4>
                  <div class="card-block">
                      <p class="card-text">Arbejdsrapport om designforløb, brugerscenarier og user-centered design i forbindelse med udviklingen af en prototypisk it-lærings-cd-rom for seniorer. Herunder gøres rede for teorier og metoder anvendt i processen.</p> <a href="#" class="btn btn-primary">Download</a> </div>
                  <div class="card-footer clearfix text-muted">
                      <div class="float-left">Oprettet: 12. 11. 2005</div>
                      <div class="float-right">Downloads: 2.404</div>
                  </div>
              </div>
              <div class="card">
                  <h4 class="card-header">Multimediedesign - IT-nøgle for seniorer</h4>
                  <div class="card-block">
                      <p class="card-text">Multimediedesign. Cd-image af it-lærings-cd-rom for seniorer.
                      Med dansk tale og tilhørende cd-cover. Arbejdsrapport tilgængelig herover.</p> <a href="#" class="btn btn-primary">Download</a> </div>
                  <div class="card-footer clearfix text-muted">
                      <div class="float-left">Oprettet: 12. 11. 2005</div>
                      <div class="float-right">Downloads: 2.404</div>
                  </div>
              </div>
        </div>
    </section>
    <footer class="site-footer" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-7">
                    <h2>Kontakt</h2>
                    <!-- Form -->
                    <form action="#send-message" method="POST" class="row" id="send-message">
                        <div class="col-md-4 mb-3">
                            <input type="text" class="form-control" value="<?php echo !empty($contact_name)?$contact_name:''; ?>" placeholder="Navn" name="contact_name" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="email" class="form-control" value="<?php echo !empty($email)?$email:''; ?>" placeholder="E-mailadresse" name="email" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <input type="phone" class="form-control" value="<?php echo !empty($email)?$email:''; ?>" placeholder="Evt. telefon" name="phone">
                        </div>
                        <div class="col-md-12 my-3 mt-md-0">
                            <textarea type="text" class="form-control" rows="7" placeholder="Besked..." required name="message"><?php echo !empty($message)?$message: ''; ?></textarea>
                        </div>
                        <div class="col-sm-10 col-sm-offset-2 captcha-box">
                            <div class="g-recaptcha" data-theme="dark" data-sitekey="6LdqpBIUAAAAAAq17acWDx1oHuJsrQOdVQFb88rh"> </div>
                        </div>
                        <div class="col-sm-10 col-sm-offset-2 mt-3">
                            <button class="btn btn-default" type="submit" name="submit">Send</button>
                        </div>
                    </form>
                    <!-- Modal -->
                    <div class="modal fade" id="response" tabindex="-1" role="dialog" aria-labelledby="responseLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="responseLabel">Beskeden er sendt</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                                </div>
                                <div class="modal-body">
                                    <?php if(!empty($succMsg)): ?>
                                    <?php echo $succMsg; ?>
                                    <?php endif; ?> </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Luk</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($errMsg)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $errMsg; ?>
                    </div>
                    <?php endif; ?>
                    <!-- Form end -->
                </div>
                <div class="col-xs-12 col-lg-5">
                  <nav class="nav social-nav footer-social-nav">
                      <?php include( 'includes/menus/socialitems.php'); ?>
                  </nav>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <?php include( 'includes/menus/bottommenuitems.php'); ?>
                    </div>
                    <div class="col-md-4 col-xs-12 text-lg-right text-xs-center pt-3 pt-sm-0">
                        <p class="copyright-text"> Copyright © 2017 Nanna Ellegaard </p>
                    </div>
                </div>
            </div>
        </div>
    </footer> <a class="scrolltop" href="#"><span class="icon-angle-up"></span></a> </body>

</html>
