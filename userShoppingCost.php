<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php

if (isset($_SESSION['userID']) && isset($_SESSION['email']) && $_SESSION['userStatus'] == 0) {
    ?>
    <head>
        <meta charset="utf-8">
        <title>Your Shopping Cost & Related Details</title>
        <?php
        include_once "userHeader.php";
        ?>

        <link rel="stylesheet" type="text/css" href="assets/css/inputDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/customTableDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">

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
                <?php
                include_once "userSideNavBar.php";
                ?>
            </div>
            <?php
            require "userShoppingCostFetch.php";
            $userShoppingCostFetch = new userShoppingCostFetch();
            ?>
            <div class="static-content-wrapper">
                <div class="static-content">
                    <?php
                    if (isset($_SESSION['groupID'])) {
                        ?>
                        <div class="page-content">
                            <ol class="breadcrumb">
                                <li class=""><a href="userHome.php">Home</a></li>
                                <li class="active"><a href="userShoppingCost.php">User Bazar Details</a>
                                </li>
                            </ol>
                            <div class="container-fluid">
                                <div data-widget-group="group1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                                <div class="panel-heading">
                                                    <div class="panel-ctrls" data-actions-container=""
                                                         data-action-collapse='{"target": ".panel-body"}'></div>
                                                    <h3 class="text-center" style="color: #000;"><i
                                                                class="fa fa-list"></i> Enter Bazar Cost</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="my-form">
                                                                <form class="form-inline" method="post"
                                                                      id="add_shopping_list"
                                                                      action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                                                    <div class=" col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                    </div>
                                                                    <div id="datePicking"
                                                                         class=" col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label class="label label-deeppurple"
                                                                                   for="datepickerforuserdailycost">Select
                                                                                Date:</label>
                                                                            <input type="text"
                                                                                   id="datepickerforuserdailycost"
                                                                                   name="dateforuserdailycost"
                                                                                   placeholder="Click to Select Date"
                                                                                   class="form-control input-lg"
                                                                                   style="border: 1px solid #e221ff">
                                                                            &nbsp;
                                                                        </div>
                                                                        <div id="dateError"></div>
                                                                        <br>
                                                                    </div>
                                                                    <div class="text-box">
                                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="item1">Item Name:</label>
                                                                                <input type="text"
                                                                                       class="form-control input-without-label input-lg item_name"
                                                                                       name="items[]" id="item1"
                                                                                       placeholder="Enter Item Name Here"
                                                                                       required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="quantity1">Quantity
                                                                                    :</label>
                                                                                <input type="text"
                                                                                       class="form-control input-without-label input-lg item_quantity"
                                                                                       name="quantities[]"
                                                                                       id="quantity1"
                                                                                       placeholder="(Optional) Enter Quantity Here"
                                                                                       required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                            <div class="form-group">
                                                                                <label for="price1">Price :</label>
                                                                                <input type="number"
                                                                                       class="form-control input-without-label input-lg item_price"
                                                                                       name="prices[]" id="price1"
                                                                                       placeholder="Enter Price Here" min="1"
                                                                                       required>
                                                                            </div>
                                                                        </div>&nbsp;
                                                                    </div>
                                                                    <div class="row text-center">
                                                                        <div id="shopping_reply"></div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-sm-offset-4">
                                                                            <button type="button"
                                                                                    class="add-box btn btn-primary btn-lg"
                                                                                    id="add_more">Add More
                                                                            </button>
                                                                            <button type="button"
                                                                                    class="btn btn-success btn-lg"
                                                                                    name="sendForApproval"
                                                                                    id="send_to_manager">Send For
                                                                                Approval
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--<div class="my-form">
                                                        <form class="form" method="post">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class=" col-lg-4 col-md-4 col-sm-0 col-xs-0">
                                                                    </div>
                                                                    <div id="datePicking"
                                                                         class=" col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                                        <div class="form-group">
                                                                            <label class="label label-deeppurple"
                                                                                   for="datepickerforuserdailycost">Select
                                                                                Date:</label>
                                                                            <input type="text"
                                                                                   id="datepickerforuserdailycost"
                                                                                   name="dateforuserdailycost"
                                                                                   placeholder="Click to Select Date"
                                                                                   class="form-control input-lg"
                                                                                   style="border: 1px solid #e221ff">
                                                                            &nbsp;
                                                                        </div>
                                                                        <div id="dateError"></div>
                                                                    </div>
                                                                    <div class=" col-lg-4 col-md-4 col-sm-0 col-xs-0">
                                                                    </div>
                                                                </div>
                                                                <div class="text-box">
                                                                <div class="row">
                                                                        <div class="col-lg-1 col-xs-12">
                                                                            <label class="control-label black-text-color"
                                                                                   for="item1">Item
                                                                                name:</label>
                                                                        </div>
                                                                        <div class="col-lg-3 col-xs-12">
                                                                            <input type="text"
                                                                                   class="form-control input-lg"
                                                                                   name="items[]"
                                                                                   id="item1"
                                                                                   placeholder="Enter Item Name Here"
                                                                                   required>
                                                                        </div>
                                                                        <div class="col-lg-1 col-xs-12">
                                                                            <label class="control-label black-text-color"
                                                                                   id="quantity1">Quantity
                                                                                (Optional):</label>
                                                                        </div>
                                                                        <div class="col-lg-3 col-xs-12">
                                                                            <input type="text"
                                                                                   class="form-control input-lg"
                                                                                   placeholder="Enter Quantity Here"
                                                                                   name="quantities[]"
                                                                                   id="quantity1" required>
                                                                        </div>
                                                                        <div class="col-lg-1 col-xs-12 black-text-color">
                                                                            <label class="control-label" for="price1">Item
                                                                                Price:</label>
                                                                        </div>
                                                                        <div class="col-lg-3 col-xs-12">
                                                                            <input type="number"
                                                                                   class="form-control input-lg"
                                                                                   placeholder="Enter Item Price Here"
                                                                                   name="prices[]"
                                                                                   id="price1" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-8 col-sm-offset-4">
                                                                        <button type="button"
                                                                                class="add-box btn btn-primary btn-lg"
                                                                                id="add_more">Add More
                                                                        </button>
                                                                        <button type="button"
                                                                                class="btn btn-success btn-lg"
                                                                                name="sendForApproval"
                                                                                id="send_to_manager">Send For
                                                                            Approval
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                                <div class="panel-heading">
                                                    <div class="panel-ctrls" data-actions-container=""
                                                         data-action-collapse='{"target": ".panel-body"}'
                                                         data-action-refresh-demo='{"type": "circular"}'></div>
                                                    <h3 class="text-center white-text-color"><i
                                                                class="fa fa-shopping-bag"></i> Your Shopping Entry</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4 col-lg-4">
                                                            <div class="info-tile info-tile-alt tile-blue btn-getting">
                                                                <div class="tile-icon"><i class="ti ti-arrow-right"></i>
                                                                </div>
                                                                <div class="tile-heading">
                                                                    <span>Total No. of Shopping Days</span></div>
                                                                <div class="tile-body">
                                                                    <span><?php $userShoppingCostFetch->userTotalNoOfBazarDate(); ?></span>
                                                                    Times
                                                                </div>
                                                                <div class="tile-footer"><span class="text-succss">+15.4%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-lg-4">
                                                            <div class="info-tile info-tile-alt tile-indigo btn-getting">
                                                                <!--<div class="tile-icon"><i class="ti ti-check"></i></div>
                                                                <div class="tile-heading"><span>Status From Manager About Todays Bazar</span>
                                                                </div>
                                                                <div class="tile-body"
                                                                     style="font-size: 24px; color: black;">
                                                                    <span>Not Answered Yet</span>
                                                                </div>-->
                                                                <?php

                                                                $userShoppingCostFetch->latestBazarDateManagerResponse();

                                                                ?>
                                                                <div class="tile-footer"><span class="text-succss">+15.4%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-lg-4">
                                                            <div class="info-tile info-tile-alt tile-purple btn-getting">
                                                                <div class="tile-icon"><i class="ti ti-money"></i></div>
                                                                <div class="tile-heading"><span>Current Month Total Shopping Cost</span>
                                                                </div>
                                                                <div class="tile-body">
                                                                    <span><?php $userShoppingCostFetch->userCurrentMonthTotalBazarCost(); ?></span>
                                                                </div>
                                                                <div class="tile-footer"><span class="text-succss">+15.4%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="specificDateBazarDetailsDiv">
                                                        <div class="col-xs-12">
                                                            <div class="panel panel-primary"
                                                                 data-widget='{"draggable": "false"}'>
                                                                <div class="panel-heading">
                                                                    <h3 class="text-center" style="color: white;"><i
                                                                                class="fa fa-shopping-basket"></i>
                                                                        Shopping Details Of
                                                                        <span id="selectedSpecificDate">Specific Date </span>
                                                                        <span style="cursor: pointer;"
                                                                              id="closeSpecificDateBazarDetailsDiv"><i
                                                                                    class="fa fa-close pull-right"></i></span>
                                                                    </h3>
                                                                </div>
                                                                <div class="panel-body">
                                                                    <div class="text-center"
                                                                         id="specificDateBazarResult">

                                                                    </div>
                                                                </div>
                                                                <div class="panel-footer">
                                                                    <div class="row">
                                                                        <div class="col-sm-8 col-sm-offset-2">
                                                                            <button class="btn-primary-alt btn black-text-color"
                                                                                    id="backToBazarList">Back To Bazar
                                                                                List
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" id="allBazarList">
                                                        <div class="col-xs-12">
                                                            <div class="panel panel-primary">
                                                                <div class="panel-heading">
                                                                    <h3 class="text-center text-capitalize"
                                                                        style="color:white;">Your Shopping Dates
                                                                        List</h3>
                                                                    <div class="panel-ctrls"></div>
                                                                </div>
                                                                <div class="panel-body no-padding">
                                                                    <?php
                                                                    $userShoppingCostFetch->userBazarDateCostList();
                                                                    ?>
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
                                            <div class="panel panel-success" data-widget='{"draggable": "false"}'>
                                                <div class="panel-heading">
                                                    <div class="panel-ctrls" data-actions-container=""
                                                         data-action-collapse='{"target": ".panel-body"}'></div>
                                                    <h3 class="text-center" style="color: white;">Specific Date Shopping
                                                        Details</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-0 col-xs-0"></div>
                                                        <div class="col-md-6 col-sm-9 col-xs-9">
                                                            <span>
                                                                <input class="slide-up" id="bazarDateList" type="text"
                                                                       placeholder="Select Date to see Bazar list"/><label
                                                                        for="bazarDateList">Bazar Details</label>
                                                            </span>
                                                        </div>

                                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                                            <button class="btn btn-primary btn-lg text-capitalize"
                                                                    id="specificBazarDateDataWithCost">Submit
                                                            </button>
                                                        </div>

                                                    </div>
                                                    <br>
                                                    &nbsp;
                                                    <div class="row">
                                                        <div class="bazarDateListResult" id="bazarDateListResult">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            include_once "userFooter.php";
                                            ?>
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
                <!-- ------------------------- Content Area Finish ------------------------------------->
            </div>
        </div>
    </div>


    <?php
    include_once "switcherCode.html";
    ?>
    <?php
    include_once "commonPlugin.html";
    ?>

    <script type="text/javascript" src="js/userHomeJS.js"></script>
    <script type="text/javascript" src="assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript" src="assets/plugins/form-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="userShoppingCost.js"></script>

    <!-- End loading page level scripts-->

    <script>
        /* document.getElementsByClassName("editBtn").addEventListener("click", sample);
        function sample() {
             swal("Edit Button");
         }*/
    </script>
    </body>
    <?php

} else {
    header('location:logout.php');
}
?>
</html>

