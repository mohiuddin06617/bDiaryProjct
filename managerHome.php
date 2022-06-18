<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
if ((isset($_SESSION['managerID']) && isset($_SESSION['email']))) {
    ?>
    <head>
        <meta charset="utf-8">

        <?php
        $email = $_SESSION['email'];
        include "DbFile/dbconfig.php";
        $row = mysqli_fetch_array(mysqli_query($conn, "SELECT firstName,lastName,userStatus from userinfo where email='$email'"), MYSQLI_ASSOC);
        echo "<title>Manager: " . ucwords($row['firstName']. " " .$row['lastName']) . " Dashboard</title>";
        mysqli_close($conn);
        /*if(isset($_SESSION['email']) && $row['userStatus']==1)
        {*/
        $email = $_SESSION['email'];

        include_once "managerHomeFetch.php";
        include_once "groupFinancialInfoFetch.php";
        include_once "groupMealFetch.php";

        $groupFinancialInfoFetch=new groupFinancialInfoFetch();
        $managerHomeFetch=new managerHomeFetch();
        $groupMealFetch=new groupMealFetch();

        for ($i = 0; $i < count($groupFinancialInfoFetch->getAllMemberList()); $i++) {
            $idForTotalAmount = $groupFinancialInfoFetch->getAllMemberList()[$i]['id'];
            $amount = $groupFinancialInfoFetch->perUserMealCost($idForTotalAmount) + $groupFinancialInfoFetch->getGroupFinancialDataInfo();
            $groupFinancialInfoFetch->setMonthGroupTotalCost($amount);
            $mealCost=$groupFinancialInfoFetch->perUserMealCost($idForTotalAmount);
            $groupFinancialInfoFetch->setTotalMealCost($mealCost);
        }
        include_once "managerHeader.php";
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/inputDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/customTableDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/tileExtendedDesign.css">
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
                            <li class="active"><a href="managerHome.php">Manager Dashboard</a></li>
                        </ol>
                        <div class="container-fluid">
                            <div class="row" id="overallView">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" title="12.7% less than previous month">
                                    <div class="info-tile info-tile-alt tile-success btn-getting"
                                         id="currentMonthTotalCostTile">
                                        <div class="tile-icon"><i class="fa fa-money"></i></div>
                                        <div class="tile-heading"><span><b>Total Cost</b></span></div>
                                        <div class="tile-body"><span class="tile-body-span-text"><?php echo $groupFinancialInfoFetch->getMonthGroupTotalCost(); ?> TK</span></div>
                                        <div class="tile-footer"><span class="text-success">5.2% <i
                                                        class="fa fa-level-up"></i></span></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" title="2 more order than yesterday">
                                    <div class="info-tile info-tile-alt tile-blue-gray btn-getting"
                                         id="todaysBazarListStatusTile">
                                        <div class="tile-icon"><i class="fa fa-cutlery"></i></div>
                                        <div class="tile-heading"><span>Per Meal Cost</span></div>
                                        <div class="tile-body"><span class="tile-body-span-text"><?=$groupFinancialInfoFetch->getCurrentMonthMealCost()?> TK</span></div>
                                        <div class="tile-footer"><span class="text-muted">2 <i
                                                        class="fa fa-level-up"></i></span></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" title="5.2% More than previous month">
                                    <div class="info-tile info-tile-alt tile-info btn-getting"
                                         id="todayShopperNameTile">
                                        <div class="tile-icon"><i class="fa fa-shopping-bag"></i></div>
                                        <div class="tile-heading"><span>Todays Shopper</span></div>
                                        <div class="tile-body"><span class="tile-body-span-text"><?=$managerHomeFetch->getShopperName();?></span></div>
                                        <div class="tile-footer"><span class="text-danger">12.7% <i
                                                        class="fa fa-level-down"></i></span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                <div class="panel-heading">
                                    <div class="panel-ctrls" data-actions-container=""
                                         data-action-collapse='{"target": ".panel-body"}'
                                         data-action-refresh-demo='{"type": "circular"}'></div>
                                    <h2 class="text-center">Todays No of Meal</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6"
                                             title="2 more order than yesterday">
                                            <div class="info-tile info-tile-alt tile-primary btn-getting">
                                                <div class="tile-icon"><i class="fa fa-cutlery"></i></div>
                                                <div class="tile-heading"><span>In Breakfast</span></div>
                                                <div class="tile-body">
                                                    <span>
                                                        <?=$groupMealFetch->getBreakfastTotalMeal(); ?>
                                                    </span>
                                                </div>
                                                <div class="tile-footer"><span class="text-muted">2 <i
                                                                class="fa fa-level-up"></i></span></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6"
                                             title="12.7% less than previous month">
                                            <div class="info-tile info-tile-alt tile-success btn-getting"
                                                 id="currentMonthTotalCostTile">
                                                <div class="tile-icon"><i class="fa fa-cutlery"></i></div>
                                                <div class="tile-heading"><span>In Lunch</span></div>
                                                <div class="tile-body">
                                                    <span>
                                                        <?=$groupMealFetch->getLunchTotalMeal(); ?>
                                                    </span>
                                                </div>
                                                <div class="tile-footer"><span class="text-success">5.2% <i
                                                                class="fa fa-level-up"></i></span></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-0 col-md-0 col-sm-4 col-xs-3"></div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6"
                                             title="5.2% More than previous month">
                                            <div class="info-tile info-tile-alt tile-info btn-getting">
                                                <div class="tile-icon"><i class="fa fa-cutlery"></i></div>
                                                <div class="tile-heading"><span> In Dinner</span></div>
                                                <div class="tile-body">
                                                    <span>
                                                        <?=$groupMealFetch->getDinnerTotalMeal(); ?>
                                                    </span>
                                                </div>
                                                <div class="tile-footer"><span class="text-danger">12.7% <i
                                                                class="fa fa-level-down"></i></span></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-0 col-md-0 col-sm-4 col-xs-3"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls"
                                                 data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'>
                                            </div>
                                            <h3 class="text-center white-text-color">
                                                <strong>
                                                    Member's Current Month Payable Amount
                                                </strong>
                                            </h3>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table table-stripped table-fill">
                                                <thead>
                                                <tr class="info">
                                                    <th><b>Member Name</b></th>
                                                    <th><b>Amount</b></th>
                                                </tr>
                                                </thead>
                                                <tbody id="memberPayableAmount">
                                                </tbody>
                                            </table>
                                            <!--<div id="chartdiv"
                                                 style="width: 100%; height: 400px; background-color: #FFFFFF;"></div>-->
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-md-6">
                                    <div class="panel panel-bluegray" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <h2>Earnings Stats</h2>
                                            <div class="panel-ctrls button-icon-bg"
                                                 data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'
                                                 data-action-colorpicker=''
                                                 data-action-refresh-demo='{"type": "circular"}'
                                            >
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div id="earnings" style="height: 272px;" class="mt-sm mb-sm"></div>
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ------------------------- Content Area Finish ------------------------------------->
        </div>
    </div>
    <?php
    include_once "managerSwitchCode.html";

    include_once "managerJSPlaugin.html";
    ?>
    <!-- Initialize scripts for this page-->


    <script src="assets/js/searchBarCode.js"></script>
    <script src="assets/js/statusManagement.js"></script>
    <script type="text/javascript">

        /*  function gettingManagerStatusPage() {
         $.ajax({
         method: "POST",
         url: "managerStatus.php",
         dataType: "html"
         })
         .done(function (msg) {
         $('#siteContent').html(msg);
         });
         }*/



        /*
         $('#managerStatus').on('click',function () {
         gettingManagerStatusPage();
         });
         */


    </script>

    <script src="assets/js/searchBarCode.js"></script>
    <script type="text/javascript" src="assets/plugins/amcharts/amcharts.js"></script>
    <script type="text/javascript" src="assets/plugins/amcharts/serial.js"></script>
    <script type="text/javascript" src="managerHome.js"></script>



    </body>
    <?php

} else {
    header("Location:logout.php");
}
?>

</html>