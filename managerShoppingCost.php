<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
if ((isset($_SESSION['managerID']) &&
    (!empty($_SESSION['managerID'])) &&
    (isset($_SESSION['email'])) &&
    (!empty($_SESSION['email'])) &&
    $_SESSION['userStatus'] === 1)) {
    ?>
    <head>
        <meta charset="utf-8">
        <title>Group Shopping Cost Details</title>
        <?php
        include_once "managerHeader.php";
        ?>
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/inputDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/modalDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/inputModalDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/customTableDesign.css">
    </head>

    <body class="animated-content">

    <header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">

        <?php
        include_once "managerLogoSearch.php";
        ?>

        <ul class="nav navbar-nav toolbar pull-right">

            <li class="toolbar-icon-bg visible-xs-block" id="trigger-toolbar-search">
                <a href="#"><span class="icon-bg"><i class="ti ti-search"></i></span></a>
            </li>

            <li class="toolbar-icon-bg hidden-xs">
                <a href="#"><span class="icon-bg"><i class="ti ti-world"></i></span></i></a>
            </li>

            <li class="toolbar-icon-bg hidden-xs">
                <a href="#"><span class="icon-bg"><i class="ti ti-view-grid"></i></span></i></a>
            </li>

            <li class="toolbar-icon-bg hidden-xs" id="trigger-fullscreen">
                <a href="#" class="toggle-fullscreen"><span class="icon-bg"><i class="ti ti-fullscreen"></i></span></i>
                </a>
            </li>

            <?php
            include_once "managerMessage.php";
            include_once "managerNotification.php";
            include_once "managerOptionTopNav.php";
            ?>
        </ul>
    </header>

    <div id="wrapper">
        <div id="layout-static">
            <div class="static-sidebar-wrapper sidebar-default">
                <div class="static-sidebar">
                    <?php
                    include_once "managerSideNavBar.php";
                    ?>
                </div>
            </div>

            <div class="static-content-wrapper">
                <div class="static-content">
                    <div class="page-content">
                        <ol class="breadcrumb">
                            <li class="active"><a href="managerHome.php">Manager Home</a></li>
                            <li class="active"><a href="managerShoppingCost.php">Manager Daily Cost Handling</a></li>
                        </ol>
                        <div class="container-fluid">
                            <?php
                            include_once "managerShoppingCostFetch.php";
                            $dailyCostApprovalFetch = new managerShoppingCostFetch();
                            if ($dailyCostApprovalFetch->getBazarListStatus() == 0) {
                                ?>
                                <div class="row">
                                    <div class="col-lg-4 col-md-3 col-sm-2 col-xs-1"></div>
                                    <div class="col-lg-4 col-md-6 col-sm-8 col-xs-10">
                                        <div class="panel panel-midnightblue widget-progress"
                                             data-widget='{"draggable": "false"}'>
                                            <div class="panel-heading">
                                                <h2>Today Bazar List Status</h2>
                                                <div class="panel-ctrls button-icon-bg"
                                                     data-actions-container=""
                                                     data-action-refresh-demo='{"type": "circular"}'
                                                     id="refreshBazarReportStatus"
                                                >
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <div class="" id="progress">
                                                    <div class="white-text-color text-center">
                                                        <?php
                                                        if (!empty($dailyCostApprovalFetch->getShopperName())) {
                                                            ?>
                                                            <p style="font-size: 35px"><i class="fa fa-remove"></i> Not
                                                                Sent
                                                                <i class="ti ti-face-sad"></i></p>
                                                            <?php
                                                        } elseif (empty($dailyCostApprovalFetch->getShopperName())) {
                                                            ?>
                                                            <p style="font-size: 30px"><i class="fa fa-remove"></i> No
                                                                Member Assigned
                                                                <i class="ti ti-face-sad"></i></p>
                                                            <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                <div class="tabular">
                                                    <div class="tabular-row">
                                                        <div class="tabular-cell">
                                                            <button class="btn btn-success status-value"
                                                                    id="notifyUser"><i
                                                                        class="fa fa-bell" aria-hidden="true"></i>
                                                                Notify
                                                                <span id="userId">
                                                                <?php echo $dailyCostApprovalFetch->getShopperName(); ?>
                                                            </span>
                                                            </button>
                                                        </div>
                                                        <div class="tabular-cell">
                                                            <button class="btn btn-danger">
                                                                <i class="fa fa-edit" aria-hidden="true"></i> Change
                                                                <span><?php echo $dailyCostApprovalFetch->getShopperName(); ?></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-3 col-sm-2 col-xs-1"></div>
                                </div>
                                <?php
                            } elseif ($dailyCostApprovalFetch->getBazarListStatus() == 1) {
                                ?>
                                <div class="row" id="detailsTable">
                                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-1"></div>
                                    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-10">
                                        <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                            <div class="panel-heading">
                                                <div class="panel-ctrls" data-actions-container=""
                                                     data-action-collapse='{"target": ".panel-body"}'></div>
                                                <h3 class="text-center"
                                                    style="color: white; font-family: 'Bitter'; font-size: 22px;"><i
                                                            class="fa fa-th-list fa-lg"></i> Bazar List For
                                                    <?= date('d/M/Y') ?></h3>
                                            </div>
                                            <div class="panel-body">
                                                <table class="table table-bordered table-fill black-text-color">
                                                    <thead>
                                                    <tr class="success">
                                                        <th colspan="3" class="text-center">Sent By <a
                                                                    href="profile.php">Mohiuddin
                                                                Ahmed</a></th>
                                                    </tr>
                                                    <tr class="info">
                                                        <th class="text-center"><b>Item</b></th>
                                                        <th class="text-center"><b>Cost(BDT)</b></th>
                                                        <th class="text-center"><b>Action</b></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                    <?php
                                                    echo $dailyCostApprovalFetch->getTodayBazarList();
                                                    ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr class="text-center" style="font-size: 20px;font-style:">
                                                        <td><b>Total</b></td>
                                                        <td colspan="2"><?= $dailyCostApprovalFetch->getTodayTotalBazarCost(); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <button type="button"
                                                                    class="btn btn-info btn-lg btn-block tooltips"
                                                                    data-toggle="tooltip"
                                                                    title="Disabled if no table content is changed">Send
                                                                For
                                                                Edit
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-success btn-lg btn-block tooltips"
                                                                    data-toggle="tooltip"
                                                                    title="Disabled if any table content is changed">
                                                                Save
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-1"></div>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="row" id="specificDateBazarDetailsDiv">
                                <div class="col-xs-12">
                                    <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <h3 class="text-center" style="color: white;"><i
                                                        class="fa fa-shopping-basket"></i> Shopping Details Of
                                                <span id="selectedSpecificDate">Specific Date </span>
                                                <span style="cursor: pointer;"
                                                      id="closeSpecificDateBazarDetailsDiv"><i
                                                            class="fa fa-close pull-right"></i></span></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="text-center" id="specificDateBazarResult">

                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <button class="btn-info btn"
                                                            id="backToBazarList">Back To Bazar List
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="allBazarList">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls" data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'
                                                 data-action-refresh-demo='{"type": "circular"}'
                                                 id="refreshBazarReportStatus"></div>
                                            <h3 class="text-center" style="color: white;"><i
                                                        class="fa fa-th-list fa-lg"></i> Bazar List
                                                <select class="black-text-color">
                                                    <option value="3" class="black-text-color"
                                                            id="next3MonthsBazarList">Next 3 Month
                                                    </option>
                                                    <option value="2" class="black-text-color"
                                                            id="next2MonthsBazarList">Next 2 Month
                                                    </option>
                                                    <option value="1" class="black-text-color" id="next1MonthsBazaList">
                                                        Next Months
                                                    </option>
                                                    <option value="0" class="black-text-color" id="today" selected>This
                                                        Months
                                                    </option>
                                                    <option value="1" class="black-text-color"
                                                            id="last1MonthsBazarList">Previous Months
                                                    </option>
                                                    <option value="2" class="black-text-color"
                                                            id="last2MonthsBazarList">Last 2 Months
                                                    </option>
                                                    <option value="2" class="black-text-color"
                                                            id="last3MonthsBazarList">Last 3 Months
                                                    </option>
                                                </select></h3>

                                        </div>
                                        <div class="panel-body black-text-color">
                                            <div class="row" id="bazarList">
                                                <table class="table table-bordered table-responsive table-fill">
                                                    <thead>
                                                    <tr class="warning">
                                                        <th><strong>Bazar Date</strong></th>
                                                        <th><strong>Total Cost(BDT)</strong></th>
                                                        <th><strong>Shopper Name</strong></th>
                                                        <th><strong>Deatils</strong></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    echo $dailyCostApprovalFetch->getCurrentMonthBazarDetails();
                                                    ?>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr class="text-center"
                                                        style="font-size: 20px;font-family: 'Maven Pro', sans-serif">
                                                        <td><strong>Total Shopping Cost</strong></td>
                                                        <td colspan="4">
                                                            <strong><?= $dailyCostApprovalFetch->getCurrentMonthTotalBazarCost() ?></strong>
                                                        </td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls" data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'
                                                 data-action-refresh-demo='{"type": "circular"}'
                                                 id="refreshBazarReportStatus"></div>
                                            <h3 class="text-center" style="color: white;"><i
                                                        class="fa fa-info-circle"></i> Specific Date Bazar Details</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <form class="form-horizontal row-border" id="validate-form"
                                                          data-parsley-validate>
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-md-3 col-sm-2 col-xs-12 control-label black-text-color"
                                                                   style="font-size: 21px;"
                                                                   for="specificBazarDatePicker">Select Date : </label>
                                                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                                                                <input type="text"
                                                                       placeholder="Click To Select Specific Date"
                                                                       class="form-control input-lg black-text-color"
                                                                       id="specificBazarDatePicker" required>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12"></div>
                                                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
                                                                <input type="button"
                                                                       class="btn btn-getting btn-primary btn-lg btn-block"
                                                                       id="bazarDataFetchButton" value="Get Bazar Data">
                                                            </div>
                                                            <div class="col-lg-5 col-md-4 col-sm-5 col-xs-12"></div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-0 col-md-1"></div>
                                                <div class="col-lg-12 col-md-10">
                                                    <div id="specificBazarDateData"></div>
                                                </div>
                                                <div class="col-lg-0 col-md-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls" data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'
                                                 data-action-refresh-demo='{"type": "circular"}'
                                                 id="refreshBazarReportStatus"></div>
                                            <h3 class="text-center black-text-color"><i
                                                        class="fa fa-info-circle"></i> Other Bazar Information</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="card text-center"
                                                         style="width: 100%;box-shadow: 12px 10px 10px 2px rgba(0,0,0,0.24); border: 2px solid #00e5ff;">
                                                        <img class="card-img-top" src="Resource/cd-avatar.png"
                                                             alt="Card image cap">
                                                        <div class="card-block">
                                                            <h4 class="card-title">Next Bazar On Whom ?</h4>
                                                            <p class="card-text">Some quick example text to build on the
                                                                card title and make up the bulk of the card's
                                                                content.</p>
                                                            <button class="btn btn-success btn-lg btn-block"
                                                                    id="notifyUser"><i class="fa fa-bell"
                                                                                       aria-hidden="true"></i> Notify
                                                                <span id="userId"><?= $dailyCostApprovalFetch->getNextShopperName() ?></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="card text-center"
                                                         style="width: 100%;box-shadow: 12px 10px 10px 2px rgba(0,0,0,0.24);border: 2px solid #00e5ff;">
                                                        <img class="card-img-top" src="Resource/icon-taka.png"
                                                             alt="Card image cap">
                                                        <div class="card-block">
                                                            <h3 class="card-title"><span style="font-size: x-large">This month's total Bazar cost</span>
                                                            </h3>
                                                            <a class="btn btn-danger btn-lg btn-block" id="totalAmount"
                                                               style="font-size: 24px;"><i class="fa fa-dollar"
                                                                                           aria-hidden="true"></i> <span
                                                                        id="totalCost">
                                                                    <?= $dailyCostApprovalFetch->getCurrentMonthTotalBazarCost() ?>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-midnightblue" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <h2>Form Validation</h2>
                                            <div class="panel-ctrls" data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body, .panel-footer"}'></div>
                                        </div>
                                        <div class="panel-body">
                                            <form class="form-horizontal row-border" id="validate-form"
                                                  data-parsley-validate>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Item 1</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" placeholder="Enter Food Menu item Here"
                                                               required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Min-length</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" data-parsley-minlength="6"
                                                               placeholder="At least 6 characters" required
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </form>
                                            <table class="table table-striped">

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ------------------------- Content Area Finish ------------------------------------->
        </div>
    </div>


    <!-- Switcher -->

    <?php
    include_once "managerSwitchCode.html";
    include_once "managerJSPlaugin.html";
    ?>
    <!-- Initialize scripts for this page-->

    <script src="assets/js/searchBarCode.js"></script>
    <!-- <script src="assets/js/generalModalCode.js"></script>-->
    <script src="assets/js/statusManagement.js"></script>
    <script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="managerShoppingCost.js"></script>


    <!-- End loading page level scripts-->


    <?php
    /*require "DbFile/dbconfig.php";
    echo $_SESSION['email'];
    //echo count($_POST['field_name']);

    if (!empty($_POST['sendForApproval'])) {
        echo "No of Item:" . count($_POST['items']) . "<br>";
        //echo count($_POST['prices'])."<br>";
        $itemCount = count($_POST['items']);
        $itemNameList = array();
        $itemPriceList = array();
        $dateForUserDailyCost = $_POST['dateforuserdailycost'];
        echo $dateForUserDailyCost;
    //    $allItemName = array();
    //    $allItemValue = array();
    //    for ($i = 0; $i < $itemCount; $i++) {
    //        array_push($allItemName, $_POST['items'][$i]);
    //    }
    //    for ($i = 0; $i < $itemCount; $i++) {
    //        array_push($allItemValue, $_POST['prices'][$i]);
    //    }
    //    foreach ($allItemName as $name) {
    //        echo "$name <br>";
    //    }
    //    foreach ($allItemValue as $value) {
    //        echo "$value <br>";
    //    }


        $gettingUserIdQuery = "SELECT id,group_id from userinfo WHERE email='" . $_SESSION['email'] . "'";
        $resultGettingUserId = mysqli_fetch_array(mysqli_query($conn, $gettingUserIdQuery), MYSQLI_ASSOC);
        $gettingMangerGroupQuery = "SELECT manager_id,group_id from groupdetails WHERE group_id='" . $resultGettingUserId['group_id'] . "'";

        $resultManagerGroupId = mysqli_fetch_array(mysqli_query($conn, $gettingMangerGroupQuery), MYSQLI_ASSOC);
        echo "User Id : " . $resultGettingUserId['id'] . " Group Id : " . $resultGettingUserId['group_id'] . "<br>";
        echo "Manager Id : " . $resultManagerGroupId['manager_id'] . "Group Id : " . $resultGettingUserId['group_id'] . "<br>";

        $userID = $resultGettingUserId['id'];
        $managerID = $resultManagerGroupId['manager_id'];
        $group_id = $resultGettingUserId['group_id'];
        $quantity;

        $query = "INSERT INTO userdailycost (user_id,group_id,manager_id,entry_time_date,item_name,item_price,quantity) VALUES ";
        $queryValue = "";
        $itemValues = 0;
        for ($i = 0; $i < $itemCount; $i++) {
            if (!empty($_POST["items"][$i])) {
                $itemValues++;
                if ($queryValue != "") {
                    $queryValue .= ",";
                }
                $queryValue .= "('$userID','$group_id','$managerID','$dateForUserDailyCost','" . $_POST["items"][$i] . "','" . $_POST["prices"][$i] . "','" . $_POST["quantities"][$i] . "')";
            }
        }

        $sql = $query . $queryValue;
        if ($itemValues != 0) {
            $result = mysqli_query($conn, $sql);
            if (!empty($result)) $message = "Added Successfully.";
            else {
                echo "Unsucessful" . mysqli_error();
            }
        }

    }

    }
    else
    {
        header("Location:signin.php");
    }*/
    ?>
    <script>

    </script>


    </body>
    <?php
} else {
    header('location:logout.php');
}
?>
</html>