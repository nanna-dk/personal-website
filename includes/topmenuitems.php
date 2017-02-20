<?php
echo
'<nav class="navbar navbar-toggleable-sm bg-faded" data-toggle="affix">
    <div class="container pl-3 pl-sm-0">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <a class="navbar-brand" href="/"><span class="icon-code"></span> <span class="brand-name hidden-sm-up">Nannas website</span></a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto mt-2 mt-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Start <span class="sr-only">home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#cv">CV</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#portfolio">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Kontakt</a>
                </li>
            </ul>
            <nav class="nav social-nav pull-right hidden-sm-down">';
                include('socialitems.php');
                echo '</nav>
        </div>
    </div>
</nav>';
?>
