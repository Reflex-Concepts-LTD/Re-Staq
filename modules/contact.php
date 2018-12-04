
<?php
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
$partner_countries = $system_administration->getAllPartnerCountries();
if (isset($_GET['contact_country_code'])) {
    $_SESSION['contact_country_code'] = $_GET['contact_country_code'];
    $_SESSION['contact_country_details'] = $system_administration->fetchPartnerCountryDetails($_SESSION['contact_country_code']);
}
?>

<section class="page">
    <!-- ***** Page Top Start ***** -->
    <div class="cover" data-image="images/photos/parallax.jpg">
        <div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Contact Us</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="?">Home</a></li>
                            <li class="active">Contact Us</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Page Top End ***** -->

    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="contact-text">            
            <p>We have local bases in Kenya, Uganda, Ethiopia, South Africa and Nigeria. More countries are also coming on board with time.<br />
            Please select your country of operation below.</p>
        </div>

        <?php
        if (count($partner_countries) == 0) {
            echo "No partner country record found.";
        } else {
            echo " | ";
            foreach ($partner_countries as $data) {
                echo "<a href='?contact&contact_country_code=" . $data['id'] . "'><img src='images/partner_countries/{$data['flag_logo']}'>" . ' ' . $data['name'] . "</a> | ";
            }
        }
        ?>
    </div>

    <!-- ***** Page Content Start ***** -->
    <div class="page-bottom">
        <div class="map-wrapper">
            <!-- ***** Google Maps Start ***** -->
<!--            <div class="map-canvas"
                 data-zoom="17"
                 data-lat="-1.2808975"
                 data-lng="36.8184283"
                 data-type="roadmap"
                 data-hue="#ffc400"
                 data-title="staqpesa HQ"
                 data-icon-path="images/marker.png"
                 data-content="1st Flr, Rentford Hse<br>Muindi Mbingu St. NRB, KE<br><br><a href='mailto:hello@reflexconcepts.co.ke'>hello@reflexconcepts.co.ke</a>">
            </div>-->
            <!-- ***** Google Maps End ***** -->

            <!-- ***** Contact Informations Start ***** -->      
            <?php if (isset($_SESSION['contact_country_code'])) { ?>
                <div class="container">
                    <div class="row">
                        <div class="offset-lg-8 col-lg-4 col-md-12 col-sm-12">
                            <div class="contact-info">
                                <div class="item">
                                    <i class="fa fa-location-arrow"></i>
                                    <div class="txt">
                                        <span><?php echo $_SESSION['contact_country_details']['physical_address']; ?></span>
    <!--                                    <span>1st Flr, Rentford Hse<br>Muindi Mbingu St. NRB, KE</span>                   -->
                                    </div>
                                </div>
                                <div class="item">
                                    <i class="fa fa-phone"></i>
                                    <div class="txt">
                                        <span><?php echo "(+" . $_SESSION['contact_country_details']['code'] . ") " . $_SESSION['contact_country_details']['phone_number']; ?></span>
                                    </div>
                                </div>
                                <div class="item">
                                    <i class="fa fa-envelope"></i>
                                    <div class="txt">
                                        <span><a href="mailto:jenga@staqpesa.com"><?php echo $_SESSION['contact_country_details']['email']; ?></a></span>
                                    </div>
                                </div>
                                <ul class="social">
                                    <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                                    <li><a href="#"><i class="fa fa-github-square"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- ***** Contact Informations End ***** -->
        </div>

        <div class="container">
            <div class="row">
                <!-- ***** Contact Text Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <h5 class="mbottom-30">Get in touch</h5>
                    <div class="contact-text">
                        <p>We are very eager to talk to you.</p>
                        <p>Talk to us on how to mould you future in your business.</p>
                    </div>
                </div>
                <!-- ***** Contact Text End ***** -->

                <!-- ***** Contact Form Start ***** -->
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <input type="text" placeholder="Name, surname">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <input type="text" placeholder="E-Mail">
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Your message"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn-primary-line">SEND</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***** Contact Form End ***** -->
            </div>
        </div>
    </div>
    <!-- ***** Page Content End ***** -->
</section>

