<?php
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();

if (!empty($_POST)) {
    $check_email = $system_administration->checkIfEmailExists($_POST['email']);
    if ($check_email == true) {
        $_SESSION['add_fail'] = true;
        $_SESSION['feedback_message'] = "<strong>Error!</strong> The entered email is already in use. Please use a different email.";
    } else {
        $success = $system_administration->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
            $_SESSION['created_institution_id'] = $success['message'];
            $_SESSION['feedback_message'] = "<strong>Successful:</strong> Thank you for showing interest to use Staqpesa. We are reviewing your application and you shall be "
                    . "notified accordingly via email/phone once the review is finalised.";
            unset($_POST);
            App::redirectTo("?business_setup");
        } else {
            $_SESSION['add_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error creating the institution. The error message is: " . $success['message'] . ". Please check and try again.";
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
                        <h1>Organization/Group Registration</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="?">Home</a></li>
                            <li class="active">Organization/Group Registration</li>
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
                <!-- ***** Contact Text Start ***** -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <h5 class="mbottom-30">Add Institution</h5>
                    <div class="contact-text">
                        <p>Are you a Savings/Investments Group, MFI or Sacco? Let's partner in moulding your business' future.<br />                        
                            We are very eager to talk to you.</p>
                        <p>We have local bases in Kenya, Uganda, Ethiopia, South Africa and Nigeria. More countries are also coming on board with time.</p>
                    </div>
                </div>
                <!-- ***** Contact Text End ***** -->
                <?php
//                if (isset($_SESSION['add_success'])) {
//                    echo $_SESSION['feedback_message'];
//                    unset($_SESSION['feedback_message']);
//                    unset($_SESSION['add_success']);
//                } else 

                if (isset($_SESSION['add_fail'])) {
                    echo $_SESSION['feedback_message'];
                    unset($_SESSION['feedback_message']);
                    unset($_SESSION['add_fail']);
                }
                ?>
                <!-- ***** Contact Form Start ***** -->
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <form class="contact-form" method="POST">
                        <input type="hidden" name="action" value="institution_self_registration"/>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="organization_details">Organization/Group Details</label>
                                </div>
                            </div>
                            <?php if (!empty($_POST)) { ?>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" name="organization_name" value="<?php echo $_POST['organization_name']; ?>" placeholder="Name eg. Safaris Limited" required="yes">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <label for="country">Country of operation</label>
                                    <select id="country" name="country" class="form-control"> 
                                        <?php echo $system_administration->getPartnerCountries(); ?>
                                    </select> 
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <label for="organization_business_type">Business Type</label>
                                    <select name="organization_business_type" class="form-control" required="yes">          
                                        <?php echo $system_administration->getBusinessForms(); ?>
                                    </select> 
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <label for="package">Solution Package</label>
                                    <select id="package" name="package" class="form-control" required="true"> 
                                        <?php echo $system_administration->getStaqpesaPackages(); ?>
                                    </select> 
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">  
                                        <label for="date-group">Date Established/Incorporated</label>
                                        <div class="row" id="date-group">
                                            <div class="col-lg-3">
                                                <select id="day" name="day" class="form-control">          
                                                    <?php include 'modules/snippets/day.php'; ?>
                                                </select> 
                                            </div>
                                            <div class="col-lg-5">
                                                <select id="month" name="month" class="form-control">          
                                                    <?php include 'modules/snippets/month.php'; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <select id="year" name="year" class="form-control">  
                                                    <?php include 'modules/snippets/year.php'; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="admin_details">Account Administrator Details</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <input type="text" name="firstname" value="<?php echo $_POST['firstname']; ?>" placeholder="First Name" required="yes">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <input type="text" name="lastname" value="<?php echo $_POST['lastname']; ?>" placeholder="Last Name" required="yes">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <input type="tel" name="phone_number" value="<?php echo $_POST['phone_number']; ?>" placeholder="Telephone Number" required="yes">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <input type="email" name="email" value="<?php echo $_POST['email']; ?>" placeholder="Email Address" required="yes">
                                </div>                 
                            <?php } else { ?>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input type="text" name="organization_name" placeholder="Name eg. Safaris Limited" required="yes">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <label for="country">Country of operation</label>
                                    <select id="country" name="country" class="form-control"> 
                                        <?php echo $system_administration->getPartnerCountries(); ?>
                                    </select> 
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <label for="organization_business_type">Business Type</label>
                                    <select name="organization_business_type" class="form-control" required="yes">          
                                        <?php echo $system_administration->getBusinessForms(); ?>
                                    </select> 
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <label for="package">Solution Package</label>
                                    <select id="package" name="package" class="form-control" required="true"> 
                                        <!--<option value="">Select Package</option>-->
                                        <?php echo $system_administration->getStaqpesaPackages(); ?>
                                    </select> 
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">  
                                        <label for="date-group">Date Established/Incorporated</label>
                                        <div class="row" id="date-group">
                                            <div class="col-lg-3">
                                                <select id="day" name="day" class="form-control">          
                                                    <?php include 'modules/snippets/day.php'; ?>
                                                </select> 
                                            </div>
                                            <div class="col-lg-5">
                                                <select id="month" name="month" class="form-control">          
                                                    <?php include 'modules/snippets/month.php'; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <select id="year" name="year" class="form-control">  
                                                    <?php include 'modules/snippets/year.php'; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="admin_details">Account Administrator Details</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <input type="text" name="firstname" placeholder="First Name" required="yes">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <input type="text" name="lastname" placeholder="Last Name" required="yes">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <input type="tel" name="phone_number" placeholder="Telephone Number" required="yes">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <input type="email" name="email" placeholder="Email Address" required="yes">
                                </div>                    
                            <?php } ?>
                            <div class="col-lg-12">
                                <button class="btn-primary-line">Create Account</button>
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

