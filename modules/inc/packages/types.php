
<?php
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
$partner_countries = $system_administration->getAllPartnerCountries();
$staqpesa_packages = $system_administration->getAllStaqpesaPackages();
?>

<!-- ***** Page Content Start ***** -->
<div class="page-bottom pbottom-70">
    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="contact-text">
                    <p>Just like you, we are also flexible. Staqpesa is charged on a monthly, quarterly or annual basis, depending on your preferences. <br />
                        We have local bases in Kenya, Uganda, Ethiopia, South Africa and Nigeria. More countries are also coming on board with time.<br />
                        Please select your country of operation below.</p>
                </div>

                <?php
                if (count($partner_countries) == 0) {
                    echo "No partner country record found.";
                } else {
                    echo " | ";
                    foreach ($partner_countries as $data) {
                        echo "<a href='?packages&package_country_code=" . $data['id'] . "'><img src='images/partner_countries/{$data['flag_logo']}'>" . ' ' . $data['name'] . "</a> | ";
                    }
                }
                ?>
            </div>
            
            <div class="col-lg-12 col-md-12 col-sm-12">
                <br /><br />
            </div>

            <?php
            if (isset($_SESSION['package_country_code'])) {
                if (count($staqpesa_packages) == 0) {
                    echo "No package record found.";
                } else {
                    foreach ($staqpesa_packages as $data) {
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="page-app">
                                <div class="icon">
                                    <img src="images/packages/<?php echo $data['package_logo']; ?>" alt="">
                                </div>
                                <div class="app-content">
                                    <h5 class="title"><?php echo $data['name']; ?></h5>
                                    <ul class="stars">
                                        <li><i class="fa fa-star active"></i></li>
                                        <li><i class="fa fa-star active"></i></li>
                                        <li><i class="fa fa-star active"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li>(144)</li>
                                    </ul>
                                    <div class="text">
                                        Members : 1-20  <br />
                                        Free SMS Package: <?php echo $data['sms_bundle']; ?>   <br />
                                        Available Modules: All Modules <br />
                                        Monthly Fee: <?php echo $_SESSION['package_country_details']['currency'] . " " . $data['dollar_monthly_fee'] * $_SESSION['package_country_details']['dollar_currency_factor']; ?> <br />
                                        Quarterly Fee: <?php echo $_SESSION['package_country_details']['currency'] . " " . $data['dollar_monthly_fee'] * $_SESSION['package_country_details']['dollar_currency_factor'] * 3; ?> <br />
                                        Annual Fee: <?php echo $_SESSION['package_country_details']['currency'] . " " . $data['dollar_monthly_fee'] * $_SESSION['package_country_details']['dollar_currency_factor'] * 12; ?>
                                    </div>
                                    <a href="?app_excite" class="btn-primary-line">Package Details</a><br />
                                    <a href="?institution_self_registration" class="btn-primary-line">Subscribe</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- ***** Page Content End ***** -->