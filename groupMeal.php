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
    include_once "groupMealFetch.php";
    include_once "dynamicMonthSelection.php";
    $groupMealFetch=new groupMealFetch();

    ?>
    <head>
        <meta charset="utf-8">
        <title>Group Meal Details</title>
        <?php
        include_once "managerHeader.php";
        ?>
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/inputDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/modalDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/inputModalDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/customTableDesign.css">
        <style>
            @media screen and (max-width: 430px) {
                .tile-icon {
                    visibility: hidden;
                }
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
                            <li class="active"><a href="groupMeal.php">Group Meal Details</a></li>
                        </ol>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                    <div class="panel-heading">
                                        <div class="panel-ctrls"
                                             data-actions-container=""
                                             data-action-collapse='{"target": ".panel-body"}'>
                                        </div>
                                        <h3 class="text-center white-text-color">Meal Status</h3>
                                        <h5 class="text-center">
                                            <span style="color: white">Today is : </span>
                                            <span class="label label-midnightblue"><?php echo date('D , d / M / Y'); ?></span>
                                        </h5>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                                                <div class="info-tile info-tile-alt tile-blue-gray btn-getting"
                                                     alt="7 More Than Yesterday">
                                                    <div class="tile-icon"><i class="ti ti-info-alt"></i></div>
                                                    <div class="tile-heading">
                                                        <span>Todays total meal in breakfast</span>
                                                    </div>
                                                    <div class="tile-body">
                                                <span>
                                                <?=$groupMealFetch->getBreakfastTotalMeal(); ?>
                                                </span></div>
                                                    <div class="tile-footer"><span class="text-danger">+7</span></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 userMealConfirmationTile">
                                                <div class="info-tile info-tile-alt tile-blue btn-getting">
                                                    <div class="tile-icon"><i class="ti ti-info-alt"></i></div>
                                                    <div class="tile-heading"><span>Todays total meal in Lunch</span>
                                                    </div>
                                                    <div class="tile-body">
                                                <span>
                                                    <?=$groupMealFetch->getLunchTotalMeal(); ?>
                                                </span>
                                                    </div>
                                                    <div class="tile-footer"><span class="text-success">+15.4%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 userMealConfirmationTile">
                                                <div class="info-tile info-tile-alt tile-info btn-getting">
                                                    <div class="tile-icon"><i class="ti ti-info-alt"></i></div>
                                                    <div class="tile-heading"><span>Todays total meal in Dinner</span>
                                                    </div>
                                                    <div class="tile-body">
                                                <span>
                                                    <?=$groupMealFetch->getDinnerTotalMeal(); ?>
                                                </span>
                                                    </div>
                                                    <div class="tile-footer"><span class="text-danger">-22.4%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 userMealConfirmationTile">
                                                <div class="info-tile info-tile-alt tile-indigo btn-getting">
                                                    <div class="tile-icon"><i class="ti ti-arrow-right"></i></div>
                                                    <div class="tile-heading"><span>Todays total no. of meal</span>
                                                    </div>
                                                    <div class="tile-body">
                                                <span>
                                                    <?=$groupMealFetch->getTodayTotalNoOfMeal();?>
                                                </span>
                                                    </div>
                                                    <div class="tile-footer"><span class="text-succss">+15.4%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 userMealConfirmationTile">
                                                <div class="info-tile info-tile-alt tile-gray btn-getting">
                                                    <div class="tile-icon"><i class="ti ti-arrow-right"></i></div>
                                                    <div class="tile-heading"><span>This months total no. of meal</span>
                                                    </div>
                                                    <div class="tile-body"><span>
                                                    <?=$groupMealFetch->getMonthTotalNoOfMeal(); ?>
                                                </span>
                                                    </div>
                                                    <div class="tile-footer"><span class="text-succss">+15.4%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 userMealConfirmationTile">
                                                <div class="info-tile info-tile-alt tile-purple btn-getting">
                                                    <div class="tile-icon"><i class="fa fa-money"></i></div>
                                                    <div class="tile-heading"><span>Per Meal Cost</span></div>
                                                    <div class="tile-body">
                                                        <span><?= $groupMealFetch->getPerMealCost() ?></span></div>
                                                    <div class="tile-footer"><span class="text-succss">+15.4%</span>
                                                    </div>
                                                </div>
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
                                                 id="refreshMealReportStatus"></div>
                                            <h3 class="text-center" style="color: white;"><i
                                                        class="fa fa-info-circle"></i> Specific Date Meal Details</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <form class="form-horizontal row-border" id="validate-form"
                                                          data-parsley-validate>
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-md-3 col-sm-2 col-xs-12 control-label black-text-color"
                                                                   style="font-size: 21px;"
                                                                   for="specificMealDatePicker">Select Date : </label>
                                                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                                                                <input type="text"
                                                                       placeholder="Click To Select Specific Date"
                                                                       class="form-control input-lg black-text-color"
                                                                       id="specificMealDatePicker" required>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12"></div>
                                                            <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                                                                <input type="button"
                                                                       class="btn btn-getting btn-primary btn-lg btn-block"
                                                                       id="mealDataFetchButton" value="Get Meal Data ">
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-0 col-md-1"></div>
                                                <div class="col-lg-12 col-md-10">
                                                    <div id="specificMealDateDataResult"></div>
                                                </div>
                                                <div class="col-lg-0 col-md-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="specificDateMealDetailsDiv">
                                <div class="col-xs-12">
                                    <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <h3 class="text-center" style="color: white;"><i
                                                        class="fa fa-shopping-basket"></i>Meal Details
                                                <!--<span id="selectedSpecificDate">Specific Date </span>-->
                                                <span style="cursor: pointer;"
                                                      id="closeSpecificDateMealDetailsDiv"><i
                                                            class="fa fa-close pull-right"></i></span></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="text-center" id="specificDateMealResult">
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <button class="btn-info btn"
                                                            id="backToAllMealList">Back To Meal List
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="allMealList">
                                <div class="col-xs-12">
                                    <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls" data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                            <h3 class="text-center" style="color:white;font-size: 30px;"><i
                                                        class="fa fa-calendar"></i> Meal Status <?php
                                                $dynamicMonth = new monthSelection();
                                                echo $dynamicMonth->month_select_box('month', 'black-text-color input-lg', 'shoppingMonthDateList');
                                                ?>
                                            </h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <table class="table table-bordered table-fill">
                                                    <thead>
                                                    <tr class="info black-text-color">
                                                        <th>Date</th>
                                                        <th>No Of Meal</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $groupMealFetch->currentMonthGroupMealList();
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--------------------------- Content Area Finish ------------------------------------->
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
    <script src="groupMeal.js"></script>

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