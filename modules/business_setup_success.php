<?php
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
if (isset($_GET['package_country_code'])) {
    $_SESSION['package_country_code'] = $_GET['package_country_code'];
    $_SESSION['package_country_details'] = $system_administration->fetchPartnerCountryDetails($_SESSION['package_country_code']);
}
?>

<section class="page">
    <!-- ***** Page Top Start ***** -->
    <div class="cover" data-image="images/photos/parallax.jpg">
        <div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Packages</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="?">Home</a></li>
                            <li class="active">Packages</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Page Top End ***** -->


    <!-- ***** Page Content Start ***** -->
    <div class="page-bottom pbottom-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="contact-text">
                        <p>Congratulations...we are done with the setup. <br />
                            Please <li><a href="<?php echo $_SESSION['admin_url'] . "/?home&institution=" . $_SESSION['created_institution_id']; ?>" class="btn-nav-line">CLICK HERE</a></li> to log into the system using the credentials sent to the registered administrator's email.
                        </p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <br /><br />
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Page Content End ***** -->
</section>
