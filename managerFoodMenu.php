<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php

if (isset($_SESSION['managerID']) && !empty($_SESSION['managerID']) &&
    !empty($_SESSION['email']) && $_SESSION['userStatus'] == 1) {
    include_once "managerFoodMenuFetch.php";
    $dailyFoodMenuSelectionFetch = new managerFoodMenuFetch();
    ?>
    <head>
        <meta charset="utf-8">
        <title>Food Menu Selection</title>
        <?php
        include_once "managerHeader.php";
        ?>

        <link rel="stylesheet" type="text/css" href="assets/css/inputDesign.css">

        <!-- Some Problem With DatePicker in customTableDesign-->
        <link rel="stylesheet" type="text/css" href="assets/css/customTableDesign.css">

        <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">
        <link href='https://fonts.googleapis.com/css?family=Bitter' rel='stylesheet'>
        <style>
            #datepickerManagerFoodMenu {
                z-index: 20000 !important;
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
                            <li class="active"><a href="managerFoodMenu.php">Manager Food Menu Selection</a></li>
                        </ol>
                        <div class="container-fluid">
                            <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                <div class="panel-heading">
                                    <div class="panel-ctrls" data-actions-container=""
                                         data-action-collapse='{"target": ".panel-body"}'></div>
                                    <h3 class="text-center" style="color: white;"><i class="material-icons">restaurant_menu</i>
                                        Select Preferred Date Food Menu</h3>
                                </div>
                                <div class="panel-body">
                                    <div id="foodMenuSavingResult"></div>
                                    <div class="my_form">
                                        <form name="foodMenuInputForm" method="post" id="saveFoodMenuItemDate"
                                              class="form-horizontal row-border"
                                              action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                            <div id="dateAndTimePicking">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0"></div>
                                                    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                                                        <select name="time"
                                                                class="form-control input-lg black-text-color"
                                                                id="managerFoodMenuTimeSelection">
                                                            <option value="" class="unselectedTime">Select Food Menu
                                                                Time
                                                            </option>
                                                            <option value="Breakfast" class="breakfastTime">Breakfast
                                                            </option>
                                                            <option value="Lunch" class="lunchTime">Lunch</option>
                                                            <option value="Dinner" class="dinnerTime">Dinner</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0">
                                                        <span id="timePickingError"></span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0"></div>
                                                    <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                                                    <span>
                                                       <!-- <label for="datepickerManagerFoodMenu" class="white-text-color" style="color: white !important;">Preferred Date</label>-->
                                                        <input class="form-control input-lg black-text-color"
                                                               name="datepickerManagerFoodMenu"
                                                               id="datepickerManagerFoodMenu" type="text"
                                                               placeholder="Click here To Select Date" required/>
                                                    </span>
                                                    </div>
                                                    <div class="col-lg-3 col-md-2 col-sm-1 col-xs-0">
                                                        <div class="datepickerManagerFoodMenuResult"
                                                             id="datepickerManagerFoodMenuResult"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-1 col-xs-0"></div>
                                                <div class="col-lg-7 col-md-6 col-sm-10 col-xs-12">
                                                    <p class="text_box">
                                                        <label class="label-input-lg" for="item">ITEM <span
                                                                    class="item_number"> 1 :</span></label>
                                                        <input type="text" class="form-control input-lg slide-up"
                                                               name="itemList[]" value="" id="item1"
                                                               placeholder="Please Enter Your Food Menu Item Here"
                                                               required/>
                                                        <!--<span id="itemListError0"></span>-->
                                                    </p>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-1 col-xs-0"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
                                                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                                                    <input type="button"
                                                           class="button btn btn-primary btn-lg btn-getting" name="save"
                                                           id="saveFoodmenu" value="SUBMIT">
                                                    <a class="add-box btn btn-info-alt btn-lg" href="#">Add More</a>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-primary" data-widget='{"draggable": "false"}'
                                 id="foodMenuShowPanel">
                                <div class="panel-heading">
                                    <div class="panel-ctrls button-icon"
                                         data-actions-container=""
                                         data-action-collapse='{"target": ".panel-body"}'
                                         data-action-refresh-demo='{"type": "circular"}'
                                    >
                                    </div>
                                    <h3 class="text-center white-text-color"
                                        style="font-family: 'Bitter'; font-size: 22px;">
                                        <i class="fa fa-cutlery fa-lg"></i> Food Menu
                                        <select class="black-text-color input-lg" id="selectedDayToSawFoodMenu">
                                            <option value="14" class="black-text-color" id="next7day">Next 7 Days
                                            </option>
                                            <option value="13" class="black-text-color" id="next6day">Next 6 Days
                                            </option>
                                            <option value="12" class="black-text-color" id="next5day">Next 5 Days
                                            </option>
                                            <option value="11" class="black-text-color" id="next4day">Next 4 Days
                                            </option>
                                            <option value="10" class="black-text-color" id="next3day">Next 3 Days
                                            </option>
                                            <option value="9" class="black-text-color" id="next2day">Next 2 Days
                                            </option>
                                            <option value="8" class="black-text-color" id="next1day">Tomorrows</option>
                                            <option value="7" class="black-text-color" id="today" selected>Todays
                                            </option>
                                            <option value="6" class="black-text-color" id="yesterday">Yesterdays
                                            </option>
                                            <option value="5" class="black-text-color" id="last2day">Last 2 Days
                                            </option>
                                            <option value="4" class="black-text-color" id="last3day">Last 3 Days
                                            </option>
                                            <option value="3" class="black-text-color" id="last4day">Last 4 Days
                                            </option>
                                            <option value="2" class="black-text-color" id="last5day">Last 5 Days
                                            </option>
                                            <option value="1" class="black-text-color" id="last6day">Last 6 Days
                                            </option>
                                            <option value="0" class="black-text-color" id="last7day">Last 7 Days
                                            </option>
                                        </select>
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <div id="selectedDateFoodMenuDataReslut">
                                        <div class="panel panel-success" data-widget='{"draggable": "false"}'>
                                            <div class="panel-heading">
                                                <div class="panel-ctrls button-icon"
                                                     data-actions-container=""
                                                     data-action-collapse='{"target": ".panel-body"}'
                                                     data-action-expand=''
                                                     data-action-refresh='{"type":"circular","url":"../bdiary/dailyFoodMenuSelectionFetch.php"}'
                                                >
                                                </div>
                                                <h2><?= date('d / M / Y') ?></h2>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                                                        <div class="panel panel-info"
                                                             data-widget='{"draggable": "false"}'>
                                                            <div class="panel-heading">
                                                                <div class="panel-ctrls" data-actions-container=""
                                                                     data-action-collapse='{"target": ".panel-body"}'></div>
                                                                <h2>Breakfast</h2>
                                                                <div class="options">
                                                                </div>
                                                            </div>
                                                            <div class="panel-body no-padding">
                                                                <table class="table table-striped table-fill">
                                                                    <thead>
                                                                    <tr class="info">
                                                                        <th>Item Name</th>
                                                                        <th>Date</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="breakfastUserFoodMenu">
                                                                    <?php
                                                                    $dailyFoodMenuSelectionFetch->setTodayBreakfastFoodMenu();
                                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="panel panel-info"
                                                             data-widget='{"draggable": "false"}'>
                                                            <div class="panel-heading">
                                                                <div class="panel-ctrls" data-actions-container=""
                                                                     data-action-collapse='{"target": ".panel-body"}'></div>
                                                                <h2>LUNCH</h2>
                                                                <div class="options">
                                                                </div>
                                                            </div>
                                                            <div class="panel-body no-padding">
                                                                <table class="table table-striped table-fill">
                                                                    <thead>
                                                                    <tr class="info">
                                                                        <th>Item Name</th>
                                                                        <th>Date</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="lunchUserFoodMenu">
                                                                    <?php
                                                                    $dailyFoodMenuSelectionFetch->setTodayLunchFoodMenu();
                                                                    ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="panel panel-info"
                                                             data-widget='{"draggable": "false"}'>
                                                            <div class="panel-heading">
                                                                <div class="panel-ctrls" data-actions-container=""
                                                                     data-action-collapse='{"target": ".panel-body"}'></div>
                                                                <h2>DINNER</h2>
                                                                <div class="options">
                                                                </div>
                                                            </div>
                                                            <div class="panel-body no-padding">
                                                                <table class="table table-striped table-fill">
                                                                    <thead>
                                                                    <tr class="info">
                                                                        <th>Item Name</th>
                                                                        <th>Date</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="dinnerUserFoodMenu">
                                                                    <?php
                                                                    $dailyFoodMenuSelectionFetch->setTodayDinnerFoodMenu();
                                                                    ?>
                                                                    </tbody>
                                                                    <!--<tfoot>
                                                                    <tr>
                                                                        <td>Total No Of meal</td>
                                                                        <td colspan="2" id="totalNoOfDinner">5</td>
                                                                    </tr>
                                                                    </tfoot>-->
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
                            <div class="panel panel-blue" data-widget='{"draggable": "false"}'>
                                <div class="panel-heading">
                                    <h2>Specific Date Food menu</h2>
                                    <div class="panel-ctrls" data-actions-container=""
                                         data-action-collapse='{"target": ".panel-body"}'></div>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-1"></div>
                                        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-10">
                                            <input class="form-control input-lg b   lack-text-color"
                                                   id="datepickerforManagerSelectedDateMenu" type="text"
                                                   placeholder="Click To Select Bazar Date"/>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-1"></div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-1"></div>
                                        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-10">
                                            <button type="button" class="btn btn-success btn-block btn-lg"
                                                    id="specificDateFoodMenuButton">Get Data!
                                            </button>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-2 col-xs-1"></div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div id="specificDateFoodMenu">
                                            <div class=" col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                                    <div class="panel-heading">
                                                        <div class="panel-ctrls" data-actions-container=""
                                                             data-action-collapse='{"target": ".panel-body"}'></div>
                                                        <h2>Breakfast</h2>
                                                        <div class="options">
                                                        </div>
                                                    </div>
                                                    <div class="panel-body no-padding">
                                                        <table class="table table-striped table-fill">
                                                            <thead>
                                                            <tr class="info">
                                                                <th>Item Name</th>
                                                                <th>Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="specificDateBreakfastMenu">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                                    <div class="panel-heading">
                                                        <div class="panel-ctrls" data-actions-container=""
                                                             data-action-collapse='{"target": ".panel-body"}'></div>
                                                        <h2>Lunch</h2>
                                                        <div class="options">
                                                        </div>
                                                    </div>
                                                    <div class="panel-body no-padding">
                                                        <table class="table table-striped table-fill">
                                                            <thead>
                                                            <tr class="info">
                                                                <th>Item Name</th>
                                                                <th>Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="specificDateLunchMenu">
                                                            </tbody>
                                                            <!--<tfoot>
                                                            <tr>
                                                                <td>Total No Of meal</td>
                                                                <td id="totalNoOfBreakfast">5</td>
                                                            </tr>
                                                            </tfoot>-->
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                                    <div class="panel-heading">
                                                        <div class="panel-ctrls" data-actions-container=""
                                                             data-action-collapse='{"target": ".panel-body"}'></div>
                                                        <h2>Dinner</h2>
                                                        <div class="options">
                                                        </div>
                                                    </div>
                                                    <div class="panel-body no-padding">
                                                        <table class="table table-striped table-fill">
                                                            <thead>
                                                            <tr class="info">
                                                                <th>Item Name</th>
                                                                <th>Date</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="specificDateDinnerMenu">
                                                            </tbody>
                                                            <!--<tfoot>
                                                            <tr>
                                                                <td>Total No Of meal</td>
                                                                <td id="totalNoOfLunch">5</td>
                                                            </tr>
                                                            </tfoot>-->
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
            </div>
            <!-- ------------------------- Content Area Finish ------------------------------------->
        </div>
    </div>
    <?php
    include_once "managerSwitchCode.html";
    include_once "managerJSPlaugin.html";
    ?>

    <!-- Switcher -->


    <!----------Dynamic Table Editing------------>
    <script src="assets/js/statusManagement.js"></script>
    <script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="managerFoodMenu.js"></script>

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

    </body>
    <?php
} else {
    header("location:logout.php");
}
?>
</html>