<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?php

    if (isset($_SESSION['userID']) && isset($_SESSION['email']) && ($_SESSION['userStatus']) == 0) {
    include_once "userMealFetch.php";
    $userMealFetch = new userMealFetch();
    ?>
    <title>User Meal Confirmation</title>
    <?php
    include_once "userHeader.php";
    ?>


    <link rel="stylesheet" type="text/css" href="assets/css/checkboxStyle.css">
    <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">
    <link rel="stylesheet" type="text/css" href="assets/css/modalDesign.css">
    <link rel="stylesheet" type="text/css" href="assets/css/inputModalDesign.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customTableDesign.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/tileExtendedDesign.css">

    <!-- External checkbox,modal and Input Design -->

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
            <a href="#" class="toggle-fullscreen"><span class="icon-bg"><i class="ti ti-fullscreen"></i></span>
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
                include_once "userSideNavBar.php";
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

                            <li class="active"><a href="userHome.php">Home</a></li>
                            <li class="active"><a href="userMeal.php">User Meal Confirmation</a></li>
                        </ol>
                        <div class="container-fluid">
                            <div class="text-center alert alert-success black-text-color slide-up"
                                 id="mealStatusResult"></div>
                            <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                <div class="row">
                                    <div class="panel-heading">
                                        <div class="panel-ctrls"
                                             data-actions-container=""
                                             data-action-collapse='{"target": ".panel-body"}'>
                                        </div>
                                        <h3 class="text-center" style="color: antiquewhite">Your Todays Meal Status</h3>
                                        <h5 class="text-center">
                                            <span style="color: white">Today is : </span>
                                            <span class="label label-midnightblue"><?php echo date('D , d / M / Y'); ?></span>
                                        </h5>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
                                            <ul class="list">
                                                <li class="list-item">
                                                    <?php
                                                    if ($userMealFetch->getBreakfastCheck() == true) {
                                                        ?>
                                                        <input type="checkbox" class="hidden-box selectedMealTime"
                                                               id="Breakfast" value="Breakfast"/>
                                                        <?php
                                                    } elseif ($userMealFetch->getBreakfastCheck() == false) {
                                                        ?>
                                                        <input type="checkbox" class="hidden-box selectedMealTime"
                                                               id="Breakfast" value="Breakfast" checked/>
                                                        <?php
                                                    }
                                                    ?>

                                                    <label for="Breakfast" class="check--label">
                                                        <span class="check--label-box"></span>
                                                        <span class="check--label-text">Breakfast</span>
                                                    </label>
                                                    <span class="badge badge-warning pull-right"
                                                          id="breakfastNumberOfMealResult">
                                                        <?php
                                                        echo "<h3>" . $userMealFetch->getBreakFastNoOfMeal() . "</h3>";
                                                        ?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
                                            <ul class="list">
                                                <li class="list-item">
                                                    <?php
                                                    if ($userMealFetch->getLunchCheck() == true) {
                                                        ?>
                                                        <input type="checkbox" class="hidden-box selectedMealTime"
                                                               id="Lunch" value="Lunch"/>
                                                        <?php
                                                    } elseif ($userMealFetch->getLunchCheck() == false) {
                                                        ?>
                                                        <input type="checkbox" class="hidden-box selectedMealTime"
                                                               id="Lunch" value="Lunch" checked/>
                                                        <?php
                                                    }
                                                    ?>
                                                    <label for="Lunch" class="check--label">
                                                        <span class="check--label-box"></span>
                                                        <span class="check--label-text">Lunch</span>
                                                    </label>
                                                    <span class="badge badge-warning pull-right"
                                                          id="lunchNumberOfMealResult">
                                                        <?php
                                                        echo "<h3>" . $userMealFetch->getLunchNoOfMeal() . "</h3>";
                                                        ?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
                                            <ul class="list">
                                                <li class="list-item">
                                                    <?php
                                                    if ($userMealFetch->getDinnerCheck() == true) {
                                                        ?>
                                                        <input type="checkbox" class="hidden-box selectedMealTime"
                                                               id="Dinner" value="Dinner"/>
                                                        <?php
                                                    } elseif ($userMealFetch->getDinnerCheck() == false) {
                                                        ?>
                                                        <input type="checkbox" class="hidden-box selectedMealTime"
                                                               id="Dinner" value="Dinner" checked/>
                                                        <?php
                                                    }
                                                    ?>
                                                    <label for="Dinner" class="check--label">
                                                        <span class="check--label-box"></span>
                                                        <span class="check--label-text">Dinner</span>
                                                    </label>

                                                    <span class="badge badge-warning pull-right"
                                                          id="dinnerNumberOfMealResult">
                                                        <?php
                                                        echo "<h3>" . $userMealFetch->getDinnerNoOfMeal() . "</h3>";
                                                        ?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="row" style="text-align: center">
                                        <div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
                                            <button type="button" class="btn btn-primary btn-responsive btn-lg"
                                                    id="moreThanOneBreakfast">1+ Meal ?
                                            </button>
                                        </div>
                                        <div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
                                            <button type="button" class="btn btn-success btn-responsive btn-lg"
                                                    id="moreThanOneLunch">1+ Meal ?
                                            </button>
                                        </div>
                                        <div class="col-md-4 col-xs-4 col-lg-4 col-sm-4">
                                            <button type="button" class="btn btn-info btn-responsive btn-lg"
                                                    id="moreThanOneDinner">1+ Meal ?
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <!-- The Modal -->
                                        <div id="myModal" class="modal" role="dialog" aria-hidden="true">
                                            <!-- Modal content -->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <span class="close" id="closeButton">&times;</span>
                                                    <h2 id="headerMeal">Enter Todays Total Number Of Meal for <span
                                                                id="selected_header_time"></span></h2>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <span id="slide_up">
                                                            <input class="slide-up" id="noOfMeal" type="number"
                                                                   placeholder="Enter No of Meal Here"
                                                                   style="color: black;" max="50" min="2"/>
                                                            <label for="noOfMeal">No. of Meal</label>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row">
                                                        <div class="col-sm-6 col-sm-offset-3">
                                                            <div class="btn-toolbar">
                                                                <button type="button"
                                                                        class="btn btn-default btn-responsive btn-lg"
                                                                        style="color: black" id="cancelButton">Cancel
                                                                </button>
                                                                <button type="button"
                                                                        class="btn btn-primary btn-responsive btn-lg"
                                                                        id="saveMoreThanOneButton">
                                                                    Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4">
                                        <div class="info-tile info-tile-alt tile-blue-gray btn-getting"
                                             alt="7 More Than Yesterday">
                                            <div class="tile-icon"><i class="ti ti-info-alt"></i></div>
                                            <div class="tile-heading">
                                                <span class="tile-head-span-text">Todays total meal in breakfast</span>
                                            </div>
                                            <div class="tile-body">
                                                <span class="tile-body-span-text">
                                                <?php
                                                if ($userMealFetch->getBreakfastTotalMeal()) {
                                                    echo $userMealFetch->getBreakfastTotalMeal();
                                                } else {
                                                    echo "0";
                                                }
                                                ?></span></div>
                                            <div class="tile-footer"><span class="text-danger">+7</span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 userMealConfirmationTile">
                                        <div class="info-tile info-tile-alt tile-indigo btn-getting">
                                            <div class="tile-icon"><i class="ti ti-info-alt"></i></div>
                                            <div class="tile-heading"><span class="tile-head-span-text">Todays total meal in Lunch</span></div>
                                            <div class="tile-body">
                                                <span class="tile-body-span-text">
                                                    <?php
                                                    if ($userMealFetch->getLunchTotalMeal()) {
                                                        echo $userMealFetch->getLunchTotalMeal();
                                                    } else {
                                                        echo "0";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="tile-footer"><span class="text-success">+15.4%</span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 userMealConfirmationTile">
                                        <div class="info-tile info-tile-alt tile-info btn-getting">
                                            <div class="tile-icon"><i class="ti ti-info-alt"></i></div>
                                            <div class="tile-heading"><span class="tile-head-span-text">Todays total meal in Dinner</span></div>
                                            <div class="tile-body">
                                                <span class="tile-body-span-text">
                                                    <?php
                                                    if ($userMealFetch->getDinnerTotalMeal()) {
                                                        echo $userMealFetch->getDinnerTotalMeal();
                                                    } else {
                                                        echo "0";
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="tile-footer"><span class="text-danger">-22.4%</span></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 userMealConfirmationTile">
                                        <div class="info-tile info-tile-alt tile-blue btn-getting">
                                            <div class="tile-icon"><i class="ti ti-arrow-right"></i></div>
                                            <div class="tile-heading"><span class="tile-head-span-text">Todays total no. of meal</span></div>
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
                                            <div class="tile-heading"><span  class="tile-head-span-text">Your Current Month Total Meal</span></div>
                                            <div class="tile-body"><span    class="tile-body-span-text"><?=$userMealFetch->getUserTotalNoOfMeal()?></span></div>
                                            <div class="tile-footer"><span class="text-succss">+15.4%</span></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 userMealConfirmationTile">
                                        <div class="info-tile info-tile-alt tile-gray btn-getting">
                                            <div class="tile-icon"><i class="ti ti-arrow-right"></i></div>
                                            <div class="tile-heading"><span class="tile-head-span-text">This months total no. of meal</span></div>
                                            <div class="tile-body"><span  class="tile-body-span-text">
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
                                    <div class="col-md-4 col-xs-4 col-sm-4 col-lg-4 userMealConfirmationTile">
                                        <div class="info-tile info-tile-alt tile-purple btn-getting">
                                            <div class="tile-icon"><i class="fa fa-money"></i></div>
                                            <div class="tile-heading"><span class="tile-head-span-text">Per Meal Cost</span></div>
                                            <div class="tile-body"><span class="tile-body-span-text"><?=$userMealFetch->getPerMealCost()?> TK</span></div>
                                            <div class="tile-footer"><span class="text-succss">+15.4%</span></div>
                                        </div>
                                    </div>
                                </div>

                                <?php

                                function get7DaysDates($days, $format = 'd/m')
                                {
                                    $m = date("m");
                                    $de = date("d");
                                    $y = date("Y");
                                    $dateArray = array();
                                    for ($i = 0; $i <= $days - 1; $i++) {
                                        $dateArray[] = date($format, mktime(0, 0, 0, $m, ($de - $i), $y));
                                    }
                                    return array_reverse($dateArray);
                                }

                                $last7DaysDate = get7DaysDates(8, 'd-m-Y');
                                $oneDayAgoDate = $last7DaysDate[6];
                                $twoDayAgoDate = $last7DaysDate[5];
                                $threeDayAgoDate = $last7DaysDate[4];
                                $fourDayAgoDate = $last7DaysDate[3];
                                $fiveDayAgoDate = $last7DaysDate[2];
                                $sixDayAgoDate = $last7DaysDate[1];
                                $sevenDayAgoDate = $last7DaysDate[0];
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-primary" data-widget='{"draggable":"false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls" data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                            <h5 class="text-center" style="color: papayawhip;font-size: 25px;"><i
                                                        class="fa fa-calendar-times-o"></i> Select Specific Date Meal
                                                Status</h5>
                                        </div>
                                        <div class="panel-body">
                                            <form class="form-inline" method="post"
                                                  action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                                  id="specificDateMealConfirmation">
                                                <div class="row">
                                                    <div class="col-lg-1 col-md-1"></div>
                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="label label-deeppurple"
                                                                   for="datepickerForUserMealConfirmation"
                                                                   style="font-size: 15px;">Select Date:</label>
                                                            <input type="text" id="datepickerForUserMealConfirmation"
                                                                   name="datepickerForUserMealConfirmation"
                                                                   placeholder="Click to Select Date"
                                                                   class="form-control input-lg"
                                                                   style="border: 1px solid #e221ff" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="label label-deeppurple"
                                                                   for="specificUserConfirmationTime"
                                                                   style="font-size: 15px;">Select Food Menu
                                                                Time:</label>
                                                            <select name="specificUserConfirmationTime"
                                                                    class="form-control input-lg selectSpecificConfirmationTime"
                                                                    id="specificUserConfirmationTime"
                                                                    style="border: 1px solid #e221ff">
                                                                <option value="" class="unselectedTime">Select Time of
                                                                    food menu
                                                                </option>
                                                                <option value="Breakfast" class="breakfastTime">
                                                                    Breakfast
                                                                </option>
                                                                <option value="Lunch" class="lunchTime">Lunch</option>
                                                                <option value="Dinner" class="dinnerTime">Dinner
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="label label-deeppurple"
                                                                   for="numberOfSpecificDateConfirmation"
                                                                   style="font-size: 15px;">Enter No of meal:</label>
                                                            <input type="number"
                                                                   class="form-control input-lg alt-border"
                                                                   name="numberOfSpecificDateConfirmation"
                                                                   id="numberOfSpecificDateConfirmation" value="1"
                                                                   max="50" min="1"
                                                                   style="border: 1px solid #e221ff"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-1 col-xs-1"></div>
                                                    <div class="col-lg-4 col-md-4 col-sm-10 col-xs-10">
                                                        <br>
                                                        <button type="button"
                                                                class="btn btn-primary btn-lg btn-getting btn-block"
                                                                id="saveSpecifiicSelectedMealConfirmation">SAVE
                                                        </button>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-1 col-xs-1"></div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="panel-footer">
                                            <div id="specificDateMealConfirmationResult"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls" data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                            <h3 class="text-center" style="color: papayawhip; font-size: 30px;"><i
                                                        class="fa fa-calendar"></i> Your last 7 days Meal Status</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                                                    <div class="panel panel-primary"
                                                         data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <h2>Breakfast</h2>
                                                            <input type="hidden" value="Breakfast" class="selected_time">
                                                            <div class="panel-ctrls" data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                                            <div class="options">
                                                            </div>
                                                        </div>
                                                        <div class="panel-body no-padding">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <tr class="info black-text-color">
                                                                    <th>Date</th>
                                                                    <th>No Of Meal</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                $userMealFetch->lastSevenDaysBreakfastFetch();
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <div class="panel panel-blue" data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <h2>Lunch</h2>
                                                            <input type="hidden" value="Lunch" class="selected_time">
                                                            <div class="panel-ctrls" data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                                        </div>
                                                        <div class="panel-body no-padding">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <tr class="success black-text-color">
                                                                    <th>Date</th>
                                                                    <th>No Of Meal</th>
                                                                    <th>Action</th>

                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                $userMealFetch->lastSevenDaysLunchFetch();
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <div class="panel panel-bluegray"
                                                         data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <h2>Dinner</h2>
                                                            <input type="hidden" value="Dinner" class="selected_time">
                                                            <div class="panel-ctrls" data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                                        </div>
                                                        <div class="panel-body no-padding">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <tr class="info black-text-color">
                                                                    <th>Date</th>
                                                                    <th>No Of Meal</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                $userMealFetch->lastSevenDaysDinnerFetch();
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
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls" data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                            <h3 class="text-center" style="color: papayawhip; font-size: 30px;"><i
                                                        class="fa fa-calendar"></i> Your Next 7 days Meal Status</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                                                    <div class="panel panel-primary"
                                                         data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <h2>Breakfast</h2>
                                                            <input type="hidden" value="Breakfast" class="selected_time">
                                                            <div class="panel-ctrls" data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                                            <div class="options">
                                                            </div>
                                                        </div>
                                                        <div class="panel-body no-padding">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <tr class="info black-text-color">
                                                                    <th>Date</th>
                                                                    <th>No Of Meal</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                $userMealFetch->nextSevenDaysBreakfastFetch();
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <div class="panel panel-blue" data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <h2>Lunch</h2>
                                                            <input type="hidden" value="Lunch" class="selected_time">
                                                            <div class="panel-ctrls" data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                                        </div>
                                                        <div class="panel-body no-padding">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <tr class="success black-text-color">
                                                                    <th>Date</th>
                                                                    <th>No Of Meal</th>
                                                                    <th>Status</th>

                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                $userMealFetch->nextSevenDaysLunchFetch();
                                                                ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <div class="panel panel-bluegray"
                                                         data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <h2>Dinner</h2>
                                                            <input type="hidden" value="Dinner" class="selected_time">
                                                            <div class="panel-ctrls" data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                                        </div>
                                                        <div class="panel-body no-padding">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <tr class="info black-text-color">
                                                                    <th>Date</th>
                                                                    <th>No Of Meal</th>
                                                                    <th>Satus</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                $userMealFetch->nextSevenDaysDinnerFetch();
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
                    </div>
                    <!-- Switcher -->
                    <?php
                } else {
                    echo "<h1 class='text-center'><i class='fa fa-lock fa-5x'></i><br><b>You must have to be a group member</b><br><br><a href='userGroup.php'>Click Here <b>Join</b> or <b>Create</b> a Group</a></h1>";
                }
                ?>
                <?php
                include_once "switcherCode.html";
                ?>
            </div>
        </div>
    </div>
</div>
<?php
include_once "commonPlugin.html";
?>
<!--<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
-->
<script type="text/javascript" src="assets/plugins/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="userMeal.js"></script>
<script type="text/javascript" src="assets/js/modalCode.js"></script>

</body>
<?php
}
else {
    header("Location:logout.php");
}
?>

</html>
