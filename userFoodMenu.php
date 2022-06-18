<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">

<?php

if(isset($_SESSION['userID'])&& isset($_SESSION['email']) && $_SESSION['userStatus']==0)
{
    ?>
    <head>
        <meta charset="utf-8">
        <title>User Food Menu List</title>
        <?php
        include_once "userHeader.php";
        ?>
        <link type="text/css" href="assets/css/dropDownListDesign.css" rel="stylesheet">

        <!-- External Dropdown Design -->

        <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">

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
                    include_once "userSideNavBar.php";
                    ?>
                </div>
            </div>

            <div class="static-content-wrapper">
                <div class="static-content">
                    <?php
                    if (isset($_SESSION['groupID'])){
                    ?>
                    <div class="page-content">
                        <ol class="breadcrumb">

                            <li class="active"><a href="userHome.php">Home</a></li>
                            <li class="active"><a href="userFoodMenu.php">User Food Menu</a></li>

                        </ol>

                        <div class="container-fluid">

                            <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                <div class="row">
                                    <div class="panel-heading">
                                        <div class="panel-ctrls"
                                             data-actions-container=""
                                             data-action-collapse='{"target": ".panel-body"}'>
                                        </div>
                                        <h3 class="text-center" style="color: white;">
                                            <i class="fa fa-cutlery"></i> See Today's Food Menu</h3>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 col-sm-1 col-xs-0">
                                                </div>
                                                <div class="col-lg-7 col-md-4 col-sm-10 col-xs-12">
                                                    <select name="time" class="form-control input-lg mealShowTime"
                                                            id="mealShowTime" onchange="showMealList(this.value)">
                                                        <option value="" class="unselectedTime">Select Time To See Food
                                                            Menu
                                                        </option>
                                                        <option value="Breakfast">Breakfast
                                                        </option>
                                                        <option value="Lunch">Lunch</option>
                                                        <option value="Dinner">Dinner</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-sm-1 col-xs-0">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1 col-md-2 col-sm-1 col-xs-0">

                                                </div>
                                                <div class="col-lg-10 col-md-8 col-sm-10 col-xs-12">
                                                    <div id="showMealListData"></div>
                                                </div>
                                                <div class="col-lg-1 col-md-2 col-sm-1 col-xs-0">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-success" data-widget='{"draggable": "false"}'>
                                        <div class="panel-heading">
                                            <div class="panel-ctrls" data-actions-container=""
                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                            <h3 class="text-center" style="color: papayawhip;"><i
                                                        class="fa fa-calendar"></i> Select Date to See Food Menu <i
                                                        class="fa fa-cutlery"></i></h3>
                                        </div>
                                        <div class="panel-body">

                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-xs-2 col-sm-3">
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xs-8 col-sm-6">
                                                    <label class="control-label label label-purple"
                                                           for="datepickerForUserSelectedFoodMenu"
                                                           style="font-size: 22px;">Select Date:</label>
                                                    <input type="text" id="datepickerForUserSelectedFoodMenu"
                                                           name="dateforuserfoodmenu" placeholder="Click to Select Date"
                                                           class="form-control input input-lg"
                                                           style="border: 1px solid #e221ff;">
                                                    <br>
                                                    <button role="button" class="btn btn-primary btn-lg btn-getting"
                                                            id="getSpecificDateFoodMenu"> Go! get It
                                                    </button>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-xs-2 col-sm-3">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0">
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12"
                                                     id="showSpecifiedDateFoodMenu">
                                                </div>
                                                <div class="col-lg-1 col-md-1 col-sm-0 col-xs-0">
                                                </div>
                                            </div>
                                            <div class="row" style="display: none;">
                                                <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4">
                                                    <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <h2>Breakfast</h2>
                                                            <div class="panel-ctrls" data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                                            <div class="options">
                                                            </div>
                                                        </div>
                                                        <div class="panel-body no-padding" id="selectedDaysBreakfast">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <tr class="info">
                                                                    <th>SL No.</th>
                                                                    <th>Item Name</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4">
                                                    <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <h2>Lunch</h2>
                                                            <div class="panel-ctrls" data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                                        </div>
                                                        <div class="panel-body no-padding" id="selectedDaysLunch">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <tr class="info">
                                                                    <th>SL No.</th>
                                                                    <th>Item Name</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-xs-12 col-sm-4 col-lg-4">
                                                    <div class="panel panel-bluegray"
                                                         data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <h2 style="align:center;">Dinner</h2>
                                                            <div class="panel-ctrls" data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                                        </div>
                                                        <div class="panel-body no-padding" id="selectedDaysDinner">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                <tr class="info">
                                                                    <th>SL No.</th>
                                                                    <th>Item Name</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

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
                    <?php
                    }
                    else{
                        echo "<h1 class='text-center'><i class='fa fa-lock fa-5x'></i><br><b>You must have to be a group member</b><br><br><a href='userGroup.php'>Click Here <b>Join</b> or <b>Create</b> a Group</a></h1>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once "switcherCode.html";
    ?>
    <?php
    include_once "commonPlugin.html";
    ?>
    <script type="text/javascript" src="userFoodMenu.js"></script>
    </body>
    <?php
}
else{
    header("location:logout.php");
}
?>
</html>

