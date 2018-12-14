<?php
// Before anything is sent, set the appropriate header
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set("Africa/Nairobi");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="staqpesa is an integrated, transparent, accounting solution for savings/investment groups." />
        <meta name="keywords" content="staqpesa, chamaa, savings/investment group, accounting, transparency" />
        <meta name="author" content="Reflex Concepts [KE,UG] LTD"/>
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="images/favicon.png" />
        <!-- Bootstrap & Plugins CSS -->
        <link href="web/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="web/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="web/css/magnific-popup.css" rel="stylesheet" type="text/css">
        <!-- Custom CSS -->
        <link href="web/css/style.css" rel="stylesheet" type="text/css">
        <!--Listing FILTER END-->
        <?php
        /*         * *
         * This section specifies the page header
         */

        // The page title
        if ($templateResource = TemplateResource::getResource('title')) {
            ?>
            <title><?php echo $templateResource; ?></title>
        <?php } ?>	
        <!-- Basic CSS -->
        <!-- End of basic CSS -->
        <?php
        // The CSS included
        if ($templateResource = TemplateResource::getResource('css')) {
            ?>
            <!-- Additional CSS -->
            <?php
            foreach ($templateResource as $style) {
                $style = "web/$style";
                ?>
                <link rel="stylesheet" href="<?php echo $style; ?>" />
                <?php
            }
            ?>
            <!-- Additional CSS end -->
            <?php
        }
        ?>
        <!-- Favicon and touch icons -->
    </head>
    <!--    <body>-->
    <body>
        <!-- ***** Preloader Start ***** -->
        <div class="loader-wrapper">
            <div class="center">
                <div class="dot dot-one"></div>
                <div class="dot dot-two"></div>
                <div class="dot dot-three"></div> 
                <div class="dot dot-four"></div>  
                <div class="dot dot-five"></div>
            </div>
        </div>
        <!-- ***** Preloader End ***** -->



        <?php
        require_once "header.php";
        require_once $currentPage;
        require_once "footer.php";
        ?>

        <!-- Basic scripts -->  
        <!-- jQuery -->
        <script src="web/js/jquery-2.1.0.min.js"></script>

        <!-- Bootstrap -->
        <script src="web/js/popper.js"></script>
        <script src="web/js/bootstrap.min.js"></script>

        <!-- Plugins -->
        <script src="web/js/scrollreveal.min.js"></script>
        <script src="web/js/parallax.min.js"></script>
        <script src="http://maps.google.com/maps/api/js?key=AIzaSyAh7IjQgbQ6Sqx1L6J0mO7_Zftl0gVKF9E"></script>
	<script src="web/js/map-script.js"></script>
        <script src="web/js/waypoints.min.js"></script>
	<script src="web/js/jquery.counterup.min.js"></script>
        <script src="web/js/jquery.magnific-popup.min.js"></script>
        <script src="web/js/imgfix.min.js"></script>

        <!-- Global Init -->
        <script src="web/js/custom.js"></script>
        
        <!-- End of basic scripts -->



        <?php
        /*         * *
         * Specify the scripts that are to be added.
         */
        if ($templateResource = TemplateResource::getResource('js')) {
            ?>
            <!-- Additional Scripts -->
            <?php
            foreach ($templateResource as $js) {
                $js = "web/$js";
                ?>
                <script src="<?php echo $js; ?>"></script>
                <?php
            }
            ?>
            <?php
        }
        ?>
        <?php if (!App::isLoggedIn()) { ?>
            <script>
                jQuery(document).ready(function () {
                    App.initLogin();
                });
            </script>
        <?php } else { ?>
            <script>
                jQuery(document).ready(function () {
                    // initiate layout and plugins
                    App.init();
                    //App.setMainPage(true);

                });
            </script>
            <?php
        }
        ?>
    </body>
</html>
