<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <?php

    if ((isset($_SESSION['userID']) && isset($_SESSION['email'])) /*|| (isset($_SESSION['userID']) && $_SESSION['userStatus']===1)*/) {
    ?>
    <title>User Home Page</title>
    <?php
    include_once "userHomeFetch.php";
    include_once "userShoppingDateFetch.php";
    include_once "userMealFetch.php";
    include_once "userFinancialInfoFetch.php";
    $userHomeFetch=new userHomeFetch();
    $userShoppingDateFetch = new userShoppingDateFetch();
    $userMealFetch = new userMealFetch();

    $userFinancialInfoFetch = new userFinancialInfoFetch();
    for ($i = 0; $i < count($userFinancialInfoFetch->getAllMemberList()); $i++) {
        $idForTotalCost = $userFinancialInfoFetch->getAllMemberList()[$i]['id'];
        $amount = $userFinancialInfoFetch->perUserMealCost($idForTotalCost) + $userFinancialInfoFetch->getGroupFinancialDataInfo();
        $userFinancialInfoFetch->setMonthGroupTotalCost($amount);
        $mealCost = $userFinancialInfoFetch->perUserMealCost($idForTotalCost);
        $userFinancialInfoFetch->setTotalMealCost($mealCost);
    }

    include "userHeader.php";
    ?>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customTableDesign.css">
    <link rel="stylesheet" type="text/css" href="assets/css/tileExtendedDesign.css">
</head>
<body class="animated-content">

<header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">

    <?php
    include_once "userLogoSearch.php";
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
        include_once "userMessage.php";
        ?>
        <?php
        include_once "userNotification.php";
        ?>
        <?php
        include_once "userOptionTopNav.php";
        ?>
    </ul>

</header>

<div id="wrapper">
    <div id="layout-static">
        <div class="static-sidebar-wrapper sidebar-default">
            <div class="static-sidebar">
                <?php
                require_once "userSideNavBar.php";
                ?>
            </div>
        </div>

        <div class="static-content-wrapper">
            <div class="static-content">
                <?php
                if (isset($_SESSION['groupID'])) {
                    ?>
                    <div class="page-content">
                        <ol class="breadcrumb">

                            <li class=""><a href="userHome.php">Home</a></li>
                            <li class="active"><a href="userHome.php">User Dashboard</a></li>

                        </ol>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" title="12.7% less than previous month">
                                    <div class="info-tile info-tile-alt tile-success btn-getting"
                                         id="currentMonthTotalCostTile">
                                        <div class="tile-icon"><i class="fa fa-money"></i></div>
                                        <div class="tile-heading"><span
                                                    class="tile-head-span-text"><b>Your Total Cost</b></span></div>
                                        <div class="tile-body"><span class="tile-body-span-text">
                                                <?php
                                                echo round($userFinancialInfoFetch->perUserMealCost($userFinancialInfoFetch->getUserId())
                                                    + $userFinancialInfoFetch->getGroupFinancialDataInfo(), 2);
                                                ?> TK</span></div>
                                        <div class="tile-footer"><span class="text-success">5.2% <i
                                                        class="fa fa-level-up"></i></span></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" title="2 more order than yesterday">
                                    <div class="info-tile info-tile-alt tile-blue-gray btn-getting"
                                         id="todaysBazarListStatusTile">
                                        <div class="tile-icon"><i class="fa fa-cutlery"></i></div>
                                        <div class="tile-heading"><span class="tile-head-span-text">Per Meal Cost</span>
                                        </div>
                                        <div class="tile-body"><span
                                                    class="tile-body-span-text"><?= $userFinancialInfoFetch->getCurrentMonthMealCost() ?>
                                                TK</span></div>
                                        <div class="tile-footer"><span class="text-muted">2 <i
                                                        class="fa fa-level-up"></i></span></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" title="5.2% More than previous month">
                                    <div class="info-tile info-tile-alt tile-info btn-getting"
                                         id="todayShopperNameTile">
                                        <div class="tile-icon"><i class="fa fa-shopping-bag"></i></div>
                                        <div class="tile-heading"><span
                                                    class="tile-head-span-text">Next Shopping Date</span></div>
                                        <div class="tile-body"><span
                                                    class="tile-body-span-text" style="font-size: 75%">
                                                <?= ($userShoppingDateFetch->user_next_shopping_date($_SESSION['userID']))?$userShoppingDateFetch->user_next_shopping_date($_SESSION['userID']):"No Date Selected"; ?></span>
                                        </div>
                                        <div class="tile-footer"><span class="text-danger">12.7% <i
                                                        class="fa fa-level-down"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-blue" data-widget='{"draggable": "false"}'>
                                <div class="panel-heading">
                                    <div class="panel-ctrls" data-actions-container=""
                                         data-action-collapse='{"target": ".panel-body"}'
                                         data-action-refresh-demo='{"type": "circular"}'></div>
                                    <h2 class="text-center white-text-color">Meal Status Summary</h2>
                                </div>
                                <div class="panel-body table-fill">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                                            <div class="info-tile info-tile-alt tile-blue btn-getting">
                                                <div class="tile-icon"><i class="ti ti-arrow-right"></i></div>
                                                <div class="tile-heading"><span class="tile-head-span-text">Todays total no. of meal</span>
                                                </div>
                                                <div class="tile-body">
                                                <span class="tile-body-span-text">
                                                    <?php
                                                    if ($userMealFetch->getTodayTotalNoOfMeal()) {
                                                        echo $userMealFetch->getTodayTotalNoOfMeal();
                                                    } else {
                                                        echo "0";
                                                    } ?>
                                                </span>
                                                </div>
                                                <div class="tile-footer"><span class="text-succss">+15.4%</span></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 userMealConfirmationTile">
                                            <div class="info-tile info-tile-alt tile-purple btn-getting">
                                                <div class="tile-icon"><i class="ti ti-arrow-right"></i></div>
                                                <div class="tile-heading"><span class="tile-head-span-text">Your Current Month Total Meal</span>
                                                </div>
                                                <div class="tile-body"><span
                                                            class="tile-body-span-text"><?= $userMealFetch->getUserTotalNoOfMeal() ?></span>
                                                </div>
                                                <div class="tile-footer"><span class="text-succss">+15.4%</span></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 userMealConfirmationTile">
                                            <div class="info-tile info-tile-alt tile-gray btn-getting">
                                                <div class="tile-icon"><i class="ti ti-arrow-right"></i></div>
                                                <div class="tile-heading"><span class="tile-head-span-text">This months total no. of meal</span>
                                                </div>
                                                <div class="tile-body"><span class="tile-body-span-text">
                                                    <?php
                                                    if ($userMealFetch->getMonthTotalNoOfMeal()) {
                                                        echo $userMealFetch->getMonthTotalNoOfMeal();
                                                    } else {
                                                        echo "0";
                                                    }
                                                    ?>
                                                </span>
                                                </div>
                                                <div class="tile-footer"><span class="text-succss">+15.4%</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls"
                                                 data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'>
                                            </div>
                                            <h3 class="text-center white-text-color">
                                                <strong>
                                                    Todays Food Menu
                                                </strong>
                                            </h3>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table table-stripped table-fill">
                                                <thead>
                                                <tr class="info">
                                                    <th><b>Time</b></th>
                                                    <th><b>Menu Item</b></th>
                                                </tr>
                                                </thead>
                                                <tbody id="memberPayableAmount">
                                                <?=$userHomeFetch->todayFoodMenu();?>
                                                </tbody>
                                            </table>
                                            <!--<div id="chartdiv"
                                                 style="width: 100%; height: 400px; background-color: #FFFFFF;"></div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <?php
                } else {
                    echo "<h1 class='text-center'><i class='fa fa-lock fa-5x'></i><br><b>You must have to be a group member</b><br><br><a href='userGroup.php'>Click Here <b>Join</b> or <b>Create</b> a Group</a></h1>";
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php
include_once "switcherCode.html";
include_once "commonPlugin.html";
?>
</body>
<?php
}
else {
    header('Location:logout.php');
}
?>

</html>