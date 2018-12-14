<?php
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();

if (!empty($_GET["loan_type_action"])) {
    switch ($_GET["loan_type_action"]) {
        case "remove":
            if (!empty($_SESSION["loan_types_list"])) {
                foreach ($_SESSION["loan_types_list"] as $k => $v) {
                    if ($_GET["code"] == $v['name'])
                        unset($_SESSION["loan_types_list"][$k]);
                    if (empty($_SESSION["loan_types_list"]))
                        unset($_SESSION["loan_types_list"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["loan_types_list"]);
            break;
    }
    App::redirectTo("?business_setup_loan_types");
}

if (!empty($_POST)) {
    if ($_POST['action'] == "update_loan_types_list") {
        $itemArray = array($_POST["name"] => array('name' => $_POST["name"], 'qualification_time' => $_POST["qualification_time"], 'qualification_amount' => $_POST["qualification_amount"],
                'interest_rate' => $_POST["interest_rate"], 'maximum_duration' => $_POST["maximum_duration"], 'instalment_frequency' => $_POST["instalment_frequency"], 'default_rate' => $_POST["default_rate"]));

        if (!empty($_SESSION["loan_types_list"])) {
            $_SESSION["loan_types_list"] = array_merge($_SESSION["loan_types_list"], $itemArray);
        } else {
            $_SESSION["loan_types_list"] = $itemArray;
        }

        App::redirectTo("?business_setup_loan_types");
    } else if ($_POST['action'] == "proceed") {
        App::redirectTo("?business_setup_loan_processing_fees");
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
                        <h1>Loan Types Setup</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="?">Home</a></li>
                            <li class="active">Loan Types Setup</li>
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
                    <h5 class="mbottom-30">Loan Types Setup</h5>
                    <div class="contact-text">
                        <p>Some quick setup to personalize your experience. Let's get get your loan packages up and running......</p>
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
                        <input type="hidden" name="action" value="update_loan_types_list"/>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="business_loan_types">BUSINESS LOAN TYPES</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="name">Type Name</label>
                                <input type="text" name="name" placeholder="eg. Emergency Loan" required="yes">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="qualification_time">Qualification Time (Months)</label>
                                <input type="text" name="qualification_time" placeholder="eg. 6" required="yes">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="qualification_amount">Amount Multiplier</label>
                                <input type="text" name="qualification_amount" placeholder="eg. 3" required="yes">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="interest_rate">Percentage Interest Rate (Monthly)</label>
                                <input type="text" name="interest_rate" placeholder="eg. 2" required="yes">
                            </div> 
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="maximum_duration">Maximum Duration (Months)</label>
                                <input type="text" name="maximum_duration" placeholder="eg. 72" required="yes">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="instalment_frequency">Instalment Frequency</label>
                                <select name="instalment_frequency" class="form-control" required="yes">          
                                    <?php echo $system_administration->getInstalmentFrequencies(); ?>
                                </select> 
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="default_rate">Percentage Loan Default Rate (Monthly)</label>
                                <input type="text" name="default_rate" placeholder="eg. 3" required="yes">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <br /><br /><br />
                            </div>
                            <div class="col-lg-12">
                                <button class="btn-primary-line">Add Loan Type</button>
                            </div>
                        </div>    
                    </form>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <br /><br />
                </div>

                <table class="table table-striped">
                    <tr>
                        <th>Type Name</th>
                        <th>Qualification Time</th>
                        <th>Amount Multiplier</th>
                        <th>Interest Rate</th>
                        <th>Maximum Duration</th>
                        <th>Instalment Frequency</th>
                        <th>Default Rate</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if (!empty($_POST)) {
                        $info = $system_administration->execute();
                    } else {
                        if (isset($_SESSION["number_of_loan_types"]) AND $_SESSION["number_of_loan_types"] == 0) {
                            echo "<tr>";
                            echo "<td>  No record found.</td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "</tr>";
                        } else {
                            if (isset($_SESSION["loan_types_list"])) {
                                foreach ($_SESSION["loan_types_list"] as $item) {
                                    echo '<tr>';
                                    echo '<td>' . $item['name'] . '</td>';
                                    echo '<td>' . $item['qualification_time'] . '</td>';
                                    echo '<td>' . $item['qualification_amount'] . '</td>';
                                    echo '<td>' . $item['interest_rate'] . '</td>';
                                    echo '<td>' . $item["maximum_duration"] . '</td>';
                                    echo '<td>' . $item['instalment_frequency'] . '</td>';
                                    echo '<td>' . $item['default_rate'] . '</td>';
                                    echo '<td><a href="?business_setup_loan_types&loan_type_action=remove&code=' . $item['name'] . '"><button class="btn btn-danger">Remove</button></a></td>';
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
                        <input type="hidden" name="action" value="proceed"/>
                        <p /><p />
                        <button type="submit" class="btn btn-info">Proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

