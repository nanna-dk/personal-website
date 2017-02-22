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
        include('includes/mail/sendmail.php');
        include('includes/clicks/displayClicks.php');
    ?>
  </head>
  <body>
    <?php
    include('includes/menus/topmenuitems.php');
    ?>
    <!-- About -->
    <section class="about" id="about">
      <div class="container text-xs-center">
        <h2>
          About Bell Theme
        </h2>
        <p>
          Voluptua scripserit per ad, laudem viderer sit ex. Ex alia corrumpit voluptatibus usu, sed unum convenire id. Ut cum nisl moderatius, per nihil dicant commodo an. Eum tacimates erroribus ad. Atqui feugiat euripidis ea pri, sed veniam tacimates ex. Menandri
          temporibus an duo.
        </p>
      </div>
    </section>
    <!-- /About -->
    <!-- Cv -->
    <section class="cv" id="cv">
      <div class="container">
        <h2>CV</h2>
        <div id="pro-experience">
               <h3>Employment</h3>
               <div class="experience">
                  <ul class="">
                     <li class="date">02/2008 - 04/2010</li>
                     <li class="company">
                        <a href="#">
                           ABC Brodcast Inc. New York.
                        </a>
                     </li>
                     <li class="position">Junior Designer</li>
                  </ul>
                  <ul class="">
                     <li class="date">04/2010 - 06/2012</li>
                     <li class="company">
                        <a href="#">
                           Leo Burnett London Office
                        </a>
                     </li>
                     <li class="position">Senior Designer</li>
                  </ul>
                  <ul class="">
                     <li class="date">06/2012 - present</li>
                     <li class="company">
                        <a href="#">
                           Google Inc. Dublin.
                        </a>
                     </li>
                     <li class="position">UI/UX Designer</li>
                  </ul>
               </div>
         </div>
      </div>
    </section>
    <!-- /Cv -->
    <section>
        <div class="container">
          <h2>Opgaver</h2>
          <ul class="assignments clearfix">
            <li><a href="includes/clicks/click.php?id=1">Google</a> <?php displayHits(1) ?></li>
            <li><a href="includes/clicks/click.php?id=2">Ku.dk</a> <?php displayHits(2) ?></li>
        </ul>
        <div class="card-columns">
        <div class="card">
            <h4 class="card-header">Mod nye forståelser af udvikling af teknologi</h4>
              <div class="card-block">
                <p class="card-text">Informationsvidenskab og nye opfattelser af teknologi. Analyse af de begreber, indsigter og problemstillinger som bl.a. CSCW-feltet har bragt på banen. Herunder vurderes forskellige perspektiver på menneskelig handling, og hvad disse betyder for opfattelser af arbejde, teknologianvendelse og design.</p>
                <a href="#" class="btn btn-primary">Download</a>
              </div>
          <div class="card-footer clearfix text-muted">
              <div class="float-left">Oprettet: 12. 11. 2005</div>
              <div class="float-right">Downloads: 2.404</div>
          </div>
        </div>
        <div class="card">
            <h4 class="card-header">Mod nye forståelser af udvikling af teknologi</h4>
              <div class="card-block">
                <p class="card-text">Informationsvidenskab og nye opfattelser af teknologi. Analyse af de begreber, indsigter og problemstillinger som bl.a. CSCW-feltet har bragt på banen. Herunder vurderes forskellige perspektiver på menneskelig handling, og hvad disse betyder for opfattelser af arbejde, teknologianvendelse og design.</p>
                <a href="#" class="btn btn-primary">Download</a>
              </div>
          <div class="card-footer clearfix text-muted">
              <div class="float-left">Oprettet: 12. 11. 2005</div>
              <div class="float-right">Downloads: 2.404</div>
          </div>
        </div>
        <div class="card">
            <h4 class="card-header">Mod nye forståelser af udvikling af teknologi</h4>
              <div class="card-block">
                <p class="card-text">Informationsvidenskab og nye opfattelser af teknologi. Analyse af de begreber, indsigter og problemstillinger som bl.a. CSCW-feltet har bragt på banen. Herunder vurderes forskellige perspektiver på menneskelig handling, og hvad disse betyder for opfattelser af arbejde, teknologianvendelse og design.</p>
                <a href="#" class="btn btn-primary">Download</a>
              </div>
          <div class="card-footer clearfix text-muted">
              <div class="float-left">Oprettet: 12. 11. 2005</div>
              <div class="float-right">Downloads: 2.404</div>
          </div>
        </div>
        <div class="card">
            <h4 class="card-header">Mod nye forståelser af udvikling af teknologi</h4>
              <div class="card-block">
                <p class="card-text">Informationsvidenskab og nye opfattelser af teknologi. Analyse af de begreber, indsigter og problemstillinger som bl.a. CSCW-feltet har bragt på banen. Herunder vurderes forskellige perspektiver på menneskelig handling, og hvad disse betyder for opfattelser af arbejde, teknologianvendelse og design.</p>
                <a href="#" class="btn btn-primary">Download</a>
              </div>
          <div class="card-footer clearfix text-muted">
              <div class="float-left">Oprettet: 12. 11. 2005</div>
              <div class="float-right">Downloads: 2.404</div>
          </div>
        </div>
        <div class="card">
            <h4 class="card-header">Mod nye forståelser af udvikling af teknologi</h4>
              <div class="card-block">
                <p class="card-text">Informationsvidenskab og nye opfattelser af teknologi. Analyse af de begreber, indsigter og problemstillinger som bl.a. CSCW-feltet har bragt på banen. Herunder vurderes forskellige perspektiver på menneskelig handling, og hvad disse betyder for opfattelser af arbejde, teknologianvendelse og design.</p>
                <a href="#" class="btn btn-primary">Download</a>
              </div>
          <div class="card-footer clearfix text-muted">
              <div class="float-left">Oprettet: 12. 11. 2005</div>
              <div class="float-right">Downloads: 2.404</div>
          </div>
        </div>
        <div class="card">
            <h4 class="card-header">Mod nye forståelser af udvikling af teknologi</h4>
              <div class="card-block">
                <p class="card-text">Informationsvidenskab og nye opfattelser af teknologi. Analyse af de begreber, indsigter og problemstillinger som bl.a. CSCW-feltet har bragt på banen. Herunder vurderes forskellige perspektiver på menneskelig handling, og hvad disse betyder for opfattelser af arbejde, teknologianvendelse og design.</p>
                <a href="#" class="btn btn-primary">Download</a>
              </div>
          <div class="card-footer clearfix text-muted">
              <div class="float-left">Oprettet: 12. 11. 2005</div>
              <div class="float-right">Downloads: 2.404</div>
          </div>
        </div>
        <div class="card">
            <h4 class="card-header">Mod nye forståelser af udvikling af teknologi</h4>
              <div class="card-block">
                <p class="card-text">Informationsvidenskab og nye opfattelser af teknologi. Analyse af de begreber, indsigter og problemstillinger som bl.a. CSCW-feltet har bragt på banen. Herunder vurderes forskellige perspektiver på menneskelig handling, og hvad disse betyder for opfattelser af arbejde, teknologianvendelse og design.</p>
                <a href="#" class="btn btn-primary">Download</a>
              </div>
          <div class="card-footer clearfix text-muted">
              <div class="float-left">Oprettet: 12. 11. 2005</div>
              <div class="float-right">Downloads: 2.404</div>
          </div>
        </div>
        <div class="card">
            <h4 class="card-header">Mod nye forståelser af udvikling af teknologi</h4>
              <div class="card-block">
                <p class="card-text">Informationsvidenskab og nye opfattelser af teknologi. Analyse af de begreber, indsigter og problemstillinger som bl.a. CSCW-feltet har bragt på banen. Herunder vurderes forskellige perspektiver på menneskelig handling, og hvad disse betyder for opfattelser af arbejde, teknologianvendelse og design.</p>
                <a href="#" class="btn btn-primary">Download</a>
              </div>
          <div class="card-footer clearfix text-muted">
              <div class="float-left">Oprettet: 12. 11. 2005</div>
              <div class="float-right">Downloads: 2.404</div>
          </div>
        </div>
    </div>
</div>
    </section>
    <footer class="site-footer" id="contact">
      <div class="container">
        <div class="row">
          <div class="footer-col col-sm-12">
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
                <textarea type="text" class="form-control" rows="5" placeholder="Besked..." required name="message"><?php echo !empty($message)?$message:''; ?></textarea>
              </div>
              <div class="col-sm-10 col-sm-offset-2 captcha-box">
                <div class="g-recaptcha" data-theme="dark" data-sitekey="6LdqpBIUAAAAAAq17acWDx1oHuJsrQOdVQFb88rh">
                </div>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php if(!empty($succMsg)): ?>
                    <?php echo $succMsg; ?>
                    <?php endif; ?>
                  </div>
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
            <nav class="nav social-nav footer-social-nav">
              <?php
                include('includes/menus/socialitems.php');
                ?>
            </nav>
          </div>
        </div>
      </div>
      <div class="bottom">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-xs-12">
              <?php
                include('includes/menus/bottommenuitems.php');
                ?>
            </div>
            <div class="col-md-4 col-xs-12 text-lg-right text-xs-center pt-3 pt-sm-0">
              <p class="copyright-text">
                Copyright © 2017 Nanna Ellegaard
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <a class="scrolltop" href="#"><span class="icon-angle-up"></span></a>
  </body>
</html>
