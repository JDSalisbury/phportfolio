<?php include 'includes/functions.php' ?>
<nav class=" navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <a class="navbar-brand" href="">
                        <img style="transform: scaleX(-1); margin-left: -35px; margin-top: -25px;" src="images/preg.png" width="150" height="150" alt="Brand">
                    </a>
                    <a class="navbar-brand" href="/phportfolio/index">HOME</a>
                    <?php
                        navBarCategoriesDisplay();
                        echo "<li><a href='/phportfolio/about'>ABOUT</a></li>";
                        echo "<li><a href='/phportfolio/services'>SERVICES</a></li>";
                        echo "<li><a href='/phportfolio/admin'>ADMIN</a></li>";
                    ?>  
                </ul>
            </div>
        </div>
    </nav>