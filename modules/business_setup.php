<?php
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();
if (isset($_GET['institution'])) {
    $_SESSION['created_institution_id'] = $_GET['institution'];
}

if (!empty($_POST)) {
    $_SESSION['setup_our_branches'] = $_POST['setup_branches'];
    $_SESSION['setup_our_positions'] = $_POST['setup_positions'];
    $_SESSION['setup_our_loans'] = $_POST['setup_loan_types'];
    
    if ($_SESSION['setup_our_branches'] == 'YES') {
        App::redirectTo("?business_setup_branches");
    } else {
        if ($_SESSION['setup_our_positions'] == 'YES') {
            App::redirectTo("?business_setup_positions");
        } else {
            if ($_SESSION['setup_our_loans'] == 'YES') {
                App::redirectTo("?business_setup_loan_types");
            } else {                
                $system_administration->updateInstitutionSetupStatus();
                App::redirectTo("{$_SESSION['admin_url']}/?home&institution={$_SESSION['created_institution_id']}");
            }
        }
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
                        <h1>Environment Setup</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="?">Home</a></li>
                            <li class="active">Environment Setup</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Page Top End ***** -->

    <!-- ***** Page Content Start ***** -->
    <div class="page-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <h5 class="mbottom-30">Environment Setup</h5>
                    <div class="contact-text">
                        <p>Before logging into your area, let's do some quick setup to personalize your experience. Let's get started......</p>
                    </div>
                </div>

<?php
if (isset($_SESSION['add_success'])) {
    echo $_SESSION['feedback_message'];
    unset($_SESSION['feedback_message']);
    unset($_SESSION['add_success']);
}
?>
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <form class="contact-form" method="POST">
                        <input type="hidden" name="action" value="business_setup"/>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="general_business_details">General Business Details</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="setup_branches">Do you have branches within your organization? </label>
                                <select name="setup_branches" class="form-control" required="true"> 
                                    <option value="">Select Reply</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select> 
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="setup_positions">Do you have staff members within your organization? </label>
                                <select name="setup_positions" class="form-control" required="true"> 
                                    <option value="">Select Reply</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select> 
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <br />
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="setup_loan_types">Do you offer loans within your organization? </label>
                                <select name="setup_loan_types" class="form-control" required="true"> 
                                    <option value="">Select Reply</option>
                                    <option value="YES">YES</option>
                                    <option value="NO">NO</option>
                                </select> 
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <br />
                            </div>
                            <div class="col-lg-12">
                                <button class="btn-primary-line">Proceed</button>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$system_administration->updateInstitution($_SESSION['created_institution_id'], 'accept_approval', 'AUTO-APPROVED BY SYSTEM');
?>
