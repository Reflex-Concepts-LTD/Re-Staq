<?php
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();

if (!empty($_GET["position_action"])) {
    switch ($_GET["position_action"]) {
        case "remove":
            if (!empty($_SESSION["positions_list"])) {
                foreach ($_SESSION["positions_list"] as $k => $v) {
                    if ($_GET["code"] == $v['name'])
                        unset($_SESSION["positions_list"][$k]);
                    if (empty($_SESSION["positions_list"]))
                        unset($_SESSION["positions_list"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["positions_list"]);
            break;
    }
    App::redirectTo("?business_setup_positions");
}

if (!empty($_POST)) {
    if ($_POST['action'] == "update_positions_list") {
        $itemArray = array($_POST["name"] => array('name' => $_POST["name"]));

        if (!empty($_SESSION["positions_list"])) {
            $_SESSION["positions_list"] = array_merge($_SESSION["positions_list"], $itemArray);
        } else {
            $_SESSION["positions_list"] = $itemArray;
        }

        App::redirectTo("?business_setup_positions");
    } else if ($_POST['action'] == "proceed") {
        if ($_SESSION['setup_our_loans'] == 'YES') {
            App::redirectTo("?business_setup_loan_types");
        } else {
            App::redirectTo("{$_SESSION['admin_url']}/?home&institution={$_SESSION['created_institution_id']}");
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
                        <h1>Positions Setup</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="?">Home</a></li>
                            <li class="active">Positions Setup</li>
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
                    <h5 class="mbottom-30">Positions Setup</h5>
                    <div class="contact-text">
                        <p>Some quick setup to personalize your experience. Let's get get your office positions up and running......</p>
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
                        <input type="hidden" name="action" value="update_positions_list"/>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="business_positions">BUSINESS POSITIONS</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="name">Position Name</label>
                                <input type="text" name="name" placeholder="eg. Credit Officer" required="yes">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <br /><br /><br />
                            </div>
                            <div class="col-lg-12">
                                <button class="btn-primary-line">Add Position</button>
                            </div>
                        </div>    
                    </form>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <br /><br />
                </div>

                <table class="table table-striped">
                    <tr>
                        <th>Position Name</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if (!empty($_POST)) {
                        $info = $system_administration->execute();
                    } else {
                        if (isset($_SESSION["number_of_positions"]) AND $_SESSION["number_of_positions"] == 0) {
                            echo "<tr>";
                            echo "<td>  No record found.</td>";
                            echo "<td> </td>";
                            echo "</tr>";
                        } else {
                            if (isset($_SESSION["positions_list"])) {
                                foreach ($_SESSION["positions_list"] as $item) {
                                    echo '<tr>';
                                    echo '<td>' . $item['name'] . '</td>';
                                    echo '<td><a href="?business_setup_positions&position_action=remove&code=' . $item['name'] . '"><button class="btn btn-danger">Remove</button></a></td>';
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

