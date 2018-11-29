<<<<<<< HEAD
<?php
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();

if (!empty($_POST)) {
    $check_institution = $system_administration->checkIfInstitutionExists($_POST['institution_id']);
    if ($check_institution == false) {
        $_SESSION['check_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> There is no instituion identified by " . $_POST['institution_id'] . ". Please check and try again.";
    } else {
        App::redirectTo("{$_SESSION['admin_url']}/?home&institution={$_POST['institution_id']}");
    }
}
?>

<section class="page">
    <!-- ***** Page Top Start ***** -->
    <div class="cover" data-image="images/photos/parallax.jpg">
        <div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>User Login</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-bottom">
        <div class="container">
            <div class="row">
                <?php
                if (isset($_SESSION['check_fail'])) {
                    echo $_SESSION['feedback_message'];
                    unset($_SESSION['feedback_message']);
                    unset($_SESSION['check_fail']);
                }
                ?>
                <!-- ***** Contact Form Start ***** -->
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <form class="contact-form" method="POST">
                        <input type="hidden" name="action" value="institution_self_registration"/>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="institution_id">Institution ID</label>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <input type="text" name="institution_id" placeholder="Enter Institution ID" required="yes">
                            </div>
                            <div class="col-lg-12">
                                <button class="btn-primary-line">Proceed to Login</button>
                            </div>
                        </div>    
                    </form>
                </div>
                <!-- ***** Contact Form End ***** -->
            </div>
        </div>
    </div>
    <!-- ***** Page Content End ***** -->
</section>

