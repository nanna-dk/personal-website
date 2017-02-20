<?php
echo <<<MENUITEMS
<nav class="navbar" id="nav">
    <div class="container">
        <a class="navbar-brand" href="index.html"><img alt="" src="img/logo-nav.png"></a> <button aria-expanded="false" class="navbar-toggler hidden-md-up pull-right collapsed" data-target="#navbar-collapse" data-toggle="collapse" type="button"><span class="sr-only">Toggle navigation</span>&#9776;</button>
        <div aria-expanded="false" class="navbar-toggleable-sm collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#about">About us <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#features">Features</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#portfolio">Portfolio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#team">Team</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
        </div>

        <nav class="nav social-nav pull-right hidden-sm-down">
            <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>
        </nav>
    </div>
</nav>
MENUITEMS;
?>
