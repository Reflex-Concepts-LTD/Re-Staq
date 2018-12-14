<?php
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();

if (!empty($_GET["loan_processing_fee_action"])) {
    switch ($_GET["loan_processing_fee_action"]) {
        case "remove":
            if (!empty($_SESSION["loan_processing_fees_list"])) {
                foreach ($_SESSION["loan_processing_fees_list"] as $k => $v) {
                    if ($_GET["code"] == $v['start'])
                        unset($_SESSION["loan_processing_fees_list"][$k]);
                    if (empty($_SESSION["loan_processing_fees_list"]))
                        unset($_SESSION["loan_processing_fees_list"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["loan_processing_fees_list"]);
            break;
    }
    App::redirectTo("?business_setup_loan_processing_fees");
}

if (!empty($_POST)) {
    if ($_POST['action'] == "update_loan_processing_fees_list") {
        $itemArray = array($_POST["start"] => array('start' => $_POST["start"], 'end' => $_POST["end"], 'amount_type' => $_POST["amount_type"], 'amount' => $_POST["amount"]));

        if (!empty($_SESSION["loan_processing_fees_list"])) {
            $_SESSION["loan_processing_fees_list"] = array_merge($_SESSION["loan_processing_fees_list"], $itemArray);
        } else {
            $_SESSION["loan_processing_fees_list"] = $itemArray;
        }

        App::redirectTo("?business_setup_loan_processing_fees");
    } else if ($_POST['action'] == "set_up_new_institution_business_environment") {
        $success = $system_administration->execute();
        if ($success['status'] == 200) {
            $_SESSION['add_success'] = true;
            App::redirectTo("?business_setup_success");
        } else {
            $_SESSION['add_fail'] = true;
            $_SESSION['feedback_message'] = "<strong>Error!</strong> There was an error setting up your institution environment. Please check and try again later.";
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
                        <h1>Loan Processing Fees Setup</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="?">Home</a></li>
                            <li class="active">Loan Processing Fees Setup</li>
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
                    <h5 class="mbottom-30">Loan Processing Fees Setup</h5>
                    <div class="contact-text">
                        <p>We are almost done personalizing your environment. Let's set up your loan processing items......</p>
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
                        <input type="hidden" name="action" value="update_loan_processing_fees_list"/>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="business_loan_processing_fees">BUSINESS LOAN PROCESSING FEES</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="start">Start/Lower Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                <input type="number" name="start" placeholder="eg. 0" required="yes">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="end">End/Upper Amount <?php echo '(' . $_SESSION['currency'] . ')'; ?></label>
                                <input type="number" name="end" placeholder="eg. 100000" required="yes">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="amount_type">Amount Type</label>
                                <select name="amount_type" class="form-control" required="yes">          
                                    <option value="CASH">CASH(<?php echo $_SESSION['currency']; ?>)</option>
                                    <option value="PERCENT">PERCENTAGE(%)</option>
                                </select> 
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="amount">Amount<?php echo '(' . $_SESSION['currency'] . ')'; ?>/Value(%) </label>
                                <input type="number" name="amount" placeholder="eg. 100" required="yes">
                            </div> 
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <br />
                            </div>
                            <div class="col-lg-12">
                                <button class="btn-primary-line">Add Loan Processing Fee</button>
                            </div>
                        </div>    
                    </form>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <br /><br />
                </div>

                <table class="table table-striped">
                    <tr>
                        <th>Start/Lower Amount</th>
                        <th>End/Upper Amount</th>
                        <th>Amount Type</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if (!empty($_POST)) {
                        $info = $system_administration->execute();
                    } else {
                        if (isset($_SESSION["number_of_loan_processing_fees"]) AND $_SESSION["number_of_loan_processing_fees"] == 0) {
                            echo "<tr>";
                            echo "<td>  No record found.</td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "</tr>";
                        } else {
                            if (isset($_SESSION["loan_processing_fees_list"])) {
                                foreach ($_SESSION["loan_processing_fees_list"] as $item) {
                                    echo '<tr>';
                                    echo '<td>' . $item['start'] . '</td>';
                                    echo '<td>' . $item['end'] . '</td>';
                                    echo '<td>' . $item['amount_type'] . '</td>';
                                    echo '<td>' . $item['amount'] . '</td>';
                                    echo '<td><a href="?business_setup_loan_processing_fees&loan_processing_fee_action=remove&code=' . $item['start'] . '"><button class="btn btn-danger">Remove</button></a></td>';
                                    echo '</tr>';
                                }
                            }
                        }
                    }
                    ?>
                </table>

                <div class="col-lg-10 col-md-12 col-sm-12">
                    <br />
                </div>
                <div class="col-lg-2 col-md-12 col-sm-12">
                    <form role="form" method="POST">
                        <input type="hidden" name="action" value="set_up_new_institution_business_environment"/>
                        <p /><p />
                        <button type="submit" class="btn btn-info">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

