<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
if ((isset($_SESSION['managerID']) &&
    (!empty($_SESSION['managerID'])) &&
    (isset($_SESSION['email'])) &&
    (!empty($_SESSION['email'])) && $_SESSION['userStatus'] === 1)) {
    include_once "groupFinancialInfoFetch.php";
    $groupFinancialInfoFetch = new groupFinancialInfoFetch();

    //Below Code is only to find out the Current Month Total Amount
    for ($i = 0; $i < count($groupFinancialInfoFetch->getAllMemberList()); $i++) {
        $id = $groupFinancialInfoFetch->getAllMemberList()[$i]['id'];
        $amount = $groupFinancialInfoFetch->perUserMealCost($id) + $groupFinancialInfoFetch->getGroupFinancialDataInfo();
        $groupFinancialInfoFetch->setMonthGroupTotalCost($amount);
        $mealCost=$groupFinancialInfoFetch->perUserMealCost($id);
        $groupFinancialInfoFetch->setTotalMealCost($mealCost);

    }

    ?>
    <head>
        <meta charset="utf-8">
        <title><?=$groupFinancialInfoFetch->getGroupName()?> Financial Information</title>
        <?php
        include_once "managerHeader.php";
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
        <link rel="stylesheet" type="text/css" href="assets/css/inputDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/customTableDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/tileExtendedDesign.css">

        <style>
            .totalAmount {
                box-shadow: 10px 10px 15px 0 rgba(1, 10, 17, 0.34);
            }

            .totalAmount:hover {
                box-shadow: 10px 10px 15px 0 rgba(1, 10, 17, 0.74);
                transition: .4s;
            }

            .partialAmount {
                box-shadow: 5px 10px 15px 0 rgba(1, 10, 17, 0.20);
            }

            .partialAmount:hover {
                box-shadow: 10px 10px 15px 0 rgba(1, 10, 17, 0.74);
                transition: .4s;
            }
        </style>

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
                            <li class="active"><a href="groupFinancialInfo.php">Group Finnacial Details</a></li>
                        </ol>
                        <div class="container-fluid">
                            <div class="row" id="newBillCreationDiv">
                                <div class="text-center" id="newBillCreationResult"></div>
                                <div class="col-xs-12">
                                    <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <h3 class="text-center" style="color: white;"><i class="fa fa-plus"></i> New
                                                Bill Creation <span style="cursor: pointer;"
                                                                    id="closeNewBillCretionDiv"><i
                                                            class="fa fa-close pull-right"></i></span></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div id="horizontal-form">
                                                <form class="form-horizontal" name="newBillCreation"
                                                      id="newBillCreation">
                                                    <div class="form-group">
                                                        <label for="billName"
                                                               class="col-sm-2 control-label black-text-color">Bill
                                                            Name</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control black-text-color"
                                                                   id="billName"
                                                                   placeholder="Enter Bill Name">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <p class="help-block" id="billNameError"></p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="billAmount"
                                                               class="col-sm-2 control-label black-text-color">Bill
                                                            Amount</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control black-text-color"
                                                                   id="billAmount"
                                                                   placeholder="Enter Bill Amount">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <select name="billCurrencyType" id="billCurrencyType"
                                                                    class="form-control black-text-color">
                                                                <option value="TK">TK</option>
                                                                <option value="RUPEE">Rupee</option>
                                                                <option value="USDOLLAR">US Dollar</option>
                                                                <option value="EURO">Euro</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <p class="help-block black-text-color"
                                                               id="billAmountError"></p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    require_once "dynamicMonthSelection.php";
                                                    ?>

                                                    <div class="form-group">
                                                        <label for="newBillMonth"
                                                               class="col-sm-2 control-label black-text-color">Bill
                                                            For</label>
                                                        <div class="col-sm-8">
                                                            <?php
                                                            $dynamicMonth = new monthSelection();
                                                            echo $dynamicMonth->month_select_box('billingMonth', 'form-control black-text-color', 'billingMonth');
                                                            ?>
                                                        </div>
                                                        <div class="col-sm-2"></div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <button class="btn-primary btn" id="newBillAddButton">Create Bill
                                                    </button>
                                                    <button class="btn-default btn" id="cancelNewBillCreation">Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="currentMonthBillingSummary">
                                <div class="col-xs-12">
                                    <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls" data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'
                                                 data-action-refresh-demo='{"type": "circular"}'
                                                 id="refreshGroupFinancialInfo"></div>
                                            <h3 class="text-center" style="color: white;">
                                                <i class="fa fa-balance-scale" aria-hidden="true">
                                                </i> This Months Billing Summary </h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 col-sm-0 col-xs-0"></div>
                                                <div class="col-lg-6 col-md-4 col-sm-9 col-xs-8">
                                                    <div class="panel panel-info totalAmount"
                                                         data-widget='{"draggable": "false"}'
                                                         data-action-collapse='{"target": ".panel-body"}'
                                                         data-toggle="tooltip"
                                                         title="32 % more than previous month">
                                                        <div class="panel-heading">
                                                            <h3 class="text-center white-text-color">Total Amount</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <i class="pull-left fa fa-money fa-3x"></i>
                                                            <p class="black-text-color text-center"
                                                               style="font-family: Impact;font-size: 23px;"> <?php echo $groupFinancialInfoFetch->getMonthGroupTotalCost(); ?>
                                                                TK </p>
                                                            <span class="pull-right"><i
                                                                        class="ti ti-arrow-up">32%</i> more</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-4 col-sm-3 col-xs-4">
                                                    <button class="btn-block btn-info btn pull-right btn-getting"
                                                            id="addNewGroupBill" data-toggle="tooltip"
                                                            title="Create A New Bill">
                                                        <i class="fa fa-plus"></i> New Bill
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <?php
                                                    $groupFinancialInfoFetch->groupBillList();
                                                ?>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                                    <div class="info-tile info-tile-alt tile-blue partialAmount"
                                                         data-toggle="tooltip" title="22.4% more than previous month">
                                                        <div class="tile-icon"><i class="fa fa-cutlery"></i></div>
                                                        <div class="tile-heading"><span class="white-text-color">Total Shopping Cost</span>
                                                        </div>
                                                        <div class="tile-body">
                                                            <span>
                                                                <?php
                                                                echo $groupFinancialInfoFetch->getTotalMealCost();
                                                                ?>
                                                                <a type="button" href="managerShoppingCost.php" class="btn btn-default btn-link btn-sm editShoppingCostBtn">
                                                                    <i class="fa fa-edit"></i> Edit</a>
                                                        </div>
                                                        <div class="tile-footer">
                                                           </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                                    <div class="info-tile info-tile-alt tile-blue partialAmount"
                                                         data-toggle="tooltip" title="22.4% more than previous month">
                                                        <div class="tile-icon"><i class="fa fa-cutlery"></i></div>
                                                        <div class="tile-heading"><span class="white-text-color">Total No Of Meal</span>
                                                        </div>
                                                        <div class="tile-body">
                                                            <span>
                                                                <?php
                                                                echo $groupFinancialInfoFetch->getTotalNumberOfMeal();
                                                                ?>
                                                                <a type="button"
                                                                   class="btn btn-default btn-link btn-sm" href="groupMeal.php"> <i class="fa fa-edit"></i> Edit</a>
                                                                <!--<a type="button" class="btn btn-link btn-danger btn-sm white-text-color deleteBtn" style="cursor: pointer;">
                                                                    <i class="fa fa-trash"></i> Delete</a>-->
                                                        </div>
                                                        <div class="tile-footer">
                                                            <span style="color: white !important;">+22.4%</span></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                                    <div class="info-tile info-tile-alt tile-blue partialAmount"
                                                         data-toggle="tooltip" title="22.4% more than previous month">
                                                        <div class="tile-icon"><i class="fa fa-cutlery"></i>
                                                        </div>
                                                        <div class="tile-heading"><span class="white-text-color">Per Meal Cost</span>
                                                        </div>
                                                        <div class="tile-body">
                                                            <span>
                                                                <?php
                                                                echo $groupFinancialInfoFetch->getCurrentMonthMealCost()." TK";
                                                                ?>
                                                                <!--<a type="button"
                                                                   class="btn btn-default btn-link btn-sm editBtn"><i class="fa fa-edit"></i> Edit</a><a type="button" class="btn btn-link btn-danger btn-sm white-text-color deleteBtn" style="cursor: pointer;"><i class="fa fa-trash"></i> Delete</a>-->

                                                        </div>
                                                        <div class="tile-footer">
                                                            <span style="color: white !important;">+22.4%</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-blue" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls" data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'
                                                 data-action-refresh-demo='{"type": "circular"}'
                                                 id="refreshGroupFinancialInfo"></div>
                                            <h3 class="text-center white-text-color">Per Member Bill</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <table class="table table-bordered table-fill">
                                                        <thead>
                                                        <tr class="success">
                                                            <th colspan="2" class="text-center">
                                                                <strong>Showing for <?= date('F') ?></strong></th>
                                                            <!--<th colspan="3" class="text-center">Showing For <select
                                                                        class="black-text-color">
                                                                    <option value="3" class="black-text-color"
                                                                            id="next3MonthsBazarList">Next 3 Month
                                                                    </option>
                                                                    <option value="2" class="black-text-color"
                                                                            id="next2MonthsBazarList">Next 2 Month
                                                                    </option>
                                                                    <option value="1" class="black-text-color"
                                                                            id="next1MonthsBazaList">Next Months
                                                                    </option>
                                                                    <option value="0" class="black-text-color"
                                                                            id="today" selected>This Months
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
                                                                </select></th>-->
                                                        </tr>
                                                        <tr class="info">
                                                            <th><b>Member Name</b></th>
                                                            <th><b>Bill Amount(TK)</b></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php

                                                        for ($i = 0; $i < count($groupFinancialInfoFetch->getAllMemberList()); $i++) {
                                                            $idForTotalAmount = $groupFinancialInfoFetch->getAllMemberList()[$i]['id'];
                                                            $fullName = $groupFinancialInfoFetch->getAllMemberList()[$i]['fullName'];
                                                            $amount = $groupFinancialInfoFetch->perUserMealCost($idForTotalAmount) + $groupFinancialInfoFetch->getGroupFinancialDataInfo();
                                                            //echo $fullName." : ". ($g->perUserMealCost($id)+$g->getGroupFinancialDataInfo())."<br>";
                                                            echo "<tr>
                                                                    <td>" . $fullName . "</td>
                                                                    <td>" . $amount . "</td>
                                                                 </tr>";
                                                        }
                                                        ?>
                                                        </tbody>
                                                        <tfoot>
                                                        <tr class="text-center"
                                                            style="font-size: 20px;font-weight:bold">
                                                            <td><b>Total</b></td>
                                                            <td colspan="2">
                                                                <b><?= $groupFinancialInfoFetch->getMonthGroupTotalCost() ?>
                                                                    TK </b></td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls" data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'
                                                 data-action-refresh-demo='{"type": "circular"}'
                                                 id="refreshGroupFinancialInfo"></div>
                                            <span>
                                                    <h3 class="text-center white-text-color"><i
                                                                class="fa fa-group"></i> Your Group Members Details Bill
                                                    </h3>
                                                </span>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <?php
                                                for ($i = 0; $i < count($groupFinancialInfoFetch->getAllMemberList()); $i++) {
                                                    $idForMeal = $groupFinancialInfoFetch->getAllMemberList()[$i]['id'];
                                                    $fullName = $groupFinancialInfoFetch->getAllMemberList()[$i]['fullName'];
                                                    ?>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="panel panel-info"
                                                             data-widget='{"draggable": "false"}'>
                                                            <div class="panel-heading">
                                                                <div class="panel-ctrls" data-actions-container=""
                                                                     data-action-collapse='{"target": ".panel-body"}'
                                                                     data-action-refresh-demo='{"type": "circular"}'
                                                                     id="refreshGroupFinancialInfo"></div>
                                                                <h2><?= $fullName ?></h2>
                                                                <div class="options">
                                                                </div>
                                                            </div>
                                                            <div class="panel-body no-padding">
                                                                <table class="table table-bordered table-fill">
                                                                    <thead>
                                                                    <tr class="success">
                                                                        <th colspan="3" class="text-center">Showing For
                                                                            <select class="black-text-color">
                                                                                <option value="3"
                                                                                        class="black-text-color"
                                                                                        id="next3MonthsBazarList">Next 3
                                                                                    Month
                                                                                </option>
                                                                                <option value="2"
                                                                                        class="black-text-color"
                                                                                        id="next2MonthsBazarList">Next 2
                                                                                    Month
                                                                                </option>
                                                                                <option value="1"
                                                                                        class="black-text-color"
                                                                                        id="next1MonthsBazaList">Next
                                                                                    Months
                                                                                </option>
                                                                                <option value="0"
                                                                                        class="black-text-color"
                                                                                        id="today" selected>This Months
                                                                                </option>
                                                                                <option value="1"
                                                                                        class="black-text-color"
                                                                                        id="last1MonthsBazarList">
                                                                                    Previous
                                                                                    Months
                                                                                </option>
                                                                                <option value="2"
                                                                                        class="black-text-color"
                                                                                        id="last2MonthsBazarList">Last 2
                                                                                    Months
                                                                                </option>
                                                                                <option value="2"
                                                                                        class="black-text-color"
                                                                                        id="last3MonthsBazarList">Last 3
                                                                                    Months
                                                                                </option>
                                                                            </select></th>
                                                                    </tr>
                                                                    <tr class="info">
                                                                        <th>Bill Type</th>
                                                                        <th>Bill Amount</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    for ($j = 0; $j < count($groupFinancialInfoFetch->getAllBillWithoutMeal()); $j++) {
                                                                        $billName = $groupFinancialInfoFetch->getAllBillWithoutMeal()[$j]['billName'];
                                                                        $billAmount = $groupFinancialInfoFetch->getAllBillWithoutMeal()[$j]['billAmount'];
                                                                        //echo $billName." ".$billAmount."<br>";
                                                                        echo "<tr>
                                                                             <td>" . $billName . "</td>
                                                                             <td>" . $billAmount . "</td>
                                                                          </tr>";
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                        echo "<tr>
                                                                                <td>Meal Cost</td>
                                                                                <td>".$groupFinancialInfoFetch->perUserMealCost($idForMeal)."</td>
                                                                              </tr>";
                                                                    ?>
                                                                    </tbody>
                                                                    <tfoot>
                                                                    <tr class="text-center"
                                                                        style="font-size: 20px;font-weight:bold">
                                                                        <td><strong>Total</strong></td>
                                                                        <td colspan="2"><strong><?=($groupFinancialInfoFetch->perUserMealCost($idForMeal)+$groupFinancialInfoFetch->getGroupFinancialDataInfo())?></strong></td>
                                                                    </tr>
                                                                    <tr class="text-center">
                                                                        <td>Balance</td>
                                                                        <td><?=($groupFinancialInfoFetch->perUserBalance($idForMeal)-$groupFinancialInfoFetch->perUserMealCost($idForMeal))?></td>
                                                                    </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
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
    <script src="assets/js/statusManagement.js"></script>
    <script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="groupFinancialInfo.js"></script>


    <!-- End loading page level scripts-->


    </body>
    <?php
} else {
    header('location:logout.php');
}
?>
</html>