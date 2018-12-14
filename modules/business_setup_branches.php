<?php
require_once WPATH . "modules/classes/System_Administration.php";
$system_administration = new System_Administration();

if (!empty($_GET["branch_action"])) {
    switch ($_GET["branch_action"]) {
        case "remove":
            if (!empty($_SESSION["branches_list"])) {
                foreach ($_SESSION["branches_list"] as $k => $v) {
                    if ($_GET["code"] == $v['branch_code'])
                        unset($_SESSION["branches_list"][$k]);
                    if (empty($_SESSION["branches_list"]))
                        unset($_SESSION["branches_list"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["branches_list"]);
            break;
    }
    App::redirectTo("?business_setup_branches");
}

if (!empty($_POST)) {
    if ($_POST['action'] == "update_branches_list") {
        $itemArray = array($_POST["branch_code"] => array('name' => $_POST["name"], 'branch_code' => $_POST["branch_code"], 'location' => $_POST["location"],
                'email' => $_POST["email"], 'phone_number' => $_POST["phone_number"]));

        if (!empty($_SESSION["branches_list"])) {
            $_SESSION["branches_list"] = array_merge($_SESSION["branches_list"], $itemArray);
        } else {
            $_SESSION["branches_list"] = $itemArray;
        }

        App::redirectTo("?business_setup_branches");
    } else if ($_POST['action'] == "proceed") {
        if ($_SESSION['setup_our_positions'] == 'YES') {
            App::redirectTo("?business_setup_positions");
        } else {
            if ($_SESSION['setup_our_loans'] == 'YES') {
                App::redirectTo("?business_setup_loan_types");
            } else {
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
                        <h1>Branches Setup</h1>
                    </div>
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="?">Home</a></li>
                            <li class="active">Branches Setup</li>
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
                    <h5 class="mbottom-30">Branches Setup</h5>
                    <div class="contact-text">
                        <p>Some quick setup to personalize your experience. Let's get get your branches up and running......</p>
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
                        <input type="hidden" name="action" value="update_branches_list"/>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="business_branches">BUSINESS BRANCHES</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="name">Branch Name</label>
                                <input type="text" name="name" placeholder="eg. Kigali" required="yes">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="branch_code">Branch Code/ID</label>
                                <input type="text" name="branch_code" placeholder="eg. 1001" required="yes">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="location">Location</label>
                                <input type="text" name="location" placeholder="eg. Kigali" required="yes">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" placeholder="eg. kigali@gmail.com" required="yes">
                            </div> 
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for="phone_number">Telephone Number</label>
                                <input type="tel" name="phone_number" placeholder="+256XXXXXXXXX" required="yes">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <br /><br /><br />
                            </div>
                            <div class="col-lg-12">
                                <button class="btn-primary-line">Add Branch</button>
                            </div>
                        </div>    
                    </form>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <br /><br />
                </div>

                <table class="table table-striped">
                    <tr>
                        <th>Branch Code/ID</th>
                        <th>Branch Name</th>
                        <th>Location</th>
                        <th>Email</th>
                        <th>Telephone</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if (!empty($_POST)) {
                        $info = $system_administration->execute();
                    } else {
                        if (isset($_SESSION["number_of_branches"]) AND $_SESSION["number_of_branches"] == 0) {
                            echo "<tr>";
                            echo "<td>  No record found.</td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            echo "</tr>";
                        } else {
                            if (isset($_SESSION["branches_list"])) {
                                foreach ($_SESSION["branches_list"] as $item) {
                                    echo '<tr>';
                                    echo '<td>' . $item['branch_code'] . '</td>';
                                    echo '<td>' . $item['name'] . '</td>';
                                    echo '<td>' . $item['location'] . '</td>';
                                    echo '<td>' . $item['email'] . '</td>';
                                    echo '<td>' . $item["phone_number"] . '</td>';
                                    echo '<td><a href="?business_setup_branches&branch_action=remove&code=' . $item['branch_code'] . '"><button class="btn btn-danger">Remove</button></a></td>';
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

