<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    if (isset($_SESSION['managerID']) && $_SESSION['userStatus'] == 1 && isset($_SESSION['email']))
    {
    include "dynamicMonthSelection.php";
    ?>
    <meta charset="utf-8">
    <title><?php
        include "DbFile/oodbconfig.php";
        $oodbconfig = new oodbconfig();
        $conn = $oodbconfig->get_connection();
        $groupNameQuery = $conn->prepare('SELECT group_name from groupDetails WHERE group_id=? LIMIT 1');
        $groupNameQuery->bind_param('i', $_SESSION["groupID"]);
        $groupNameQuery->execute();
        $groupNameResult = $groupNameQuery->get_result();
        if ($groupNameResult->num_rows == 1) {
            while ($row = $groupNameResult->fetch_assoc()) {
                echo $row["group_name"];
            }
        } else {
            echo 'Group Name';
        }

        ?> Shopper Selection</title>
    <?php
    include_once "managerHeader.php";
    ?>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">


    <link rel="stylesheet" type="text/css" href="assets/css/inputDesign.css">
    <link rel="stylesheet" type="text/css" href="assets/css/customTableDesign.css">
    <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">


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

        .impact-font {
            background-color: #009ac1 !important;
            font-family: Impact, Charcoal, sans-serif;

            font-size: 25px;
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
                        <?php require "dynamicTable.php"; ?>
                        <div class="row">
                            <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">
                                <div class="panel panel-blue" data-widget='{"draggable": "false"}'>
                                    <div class="panel-heading">
                                        <div class="panel-ctrls" data-actions-container=""
                                             data-action-collapse='{"target": ".panel-body"}'
                                             data-action-refresh-demo='{"type": "circular"}'
                                             id="refreshGroupFinancialInfo"></div>
                                        <h3 class="text-center white-text-color"><i class="fa fa-shopping-bag"></i>
                                            Select Who is going in shopping</h3>
                                    </div>
                                    <div class="showSelectionAnswer text-center" id="showSelectionAnswer"></div>
                                    <div class="panel-body">
                                        <div class="col-lg-3 col-md-4 col-sm-1 col-xs-1"></div>
                                        <div class="col-lg-6 col-md-4 col-sm-10 col-xs-10">
                                            <form method="post" role="form" id="shoppingPersonSelection"
                                                  name="shoppingPersonSelection">
                                                <?php
                                                $memberListQuery = "SELECT id,firstName,lastName from userinfo WHERE group_id='" . $_SESSION['groupID'] . "'";
                                                $memberList = $conn->query($memberListQuery);
                                                $groupMemberName = array();
                                                $groupMemberId = array();
                                                echo '<div class="form-group"><label for="selectedShopper" class="control-label">Select Shopper From Below User List : </label>';
                                                if ($memberList->num_rows > 0) {
                                                    $select = '<select name="selectedShopper" class="form-control input-lg" id="selectedShopper"><option value="0">Select User From Below</option>';
                                                    while ($member = $memberList->fetch_assoc()) {
                                                        /*                                                        echo "<option value='".$row['id']."' id='selectedShopper'>".$row['firstname']." ".$row['lastname']."</option>";*/
                                                        $select .= '<option value="' . $member['id'] . '">' . $member['firstName'] . " " . $member['lastName'] . '</option>';
                                                        array_push($groupMemberName, $member['firstName'] . ' ' . $member['lastName']);
                                                        array_push($groupMemberId, $member['id']);
                                                    }
                                                    $select .= '</select>';
                                                    echo $select;
                                                }
                                                ?>

                                                <div class="form-group form-horizontal">
                                                    <label for="selectedDateForShopper" class="control-label">Select
                                                        Date
                                                        Below : </label>
                                                    <input type="text" id="selectedDateForShopper"
                                                           class="dateSlector form-control"
                                                           name="selectedDateForShopper"
                                                           placeholder="Click To Select Date">
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary" id="saveShopperBtn">
                                                        Save and Send !
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-1 col-xs-1"></div>
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
                                             data-action-refresh-demo='{"type": "circular"}'>
                                        </div>
                                        <span>
                                            <h3 class="text-center"><span class="white-text-color"><i
                                                            class="fa fa-calendar"></i> Members Shopping Date</span>
                                                <?php
                                                $dynamicMonth = new monthSelection();
                                                echo $dynamicMonth->month_select_box('month', 'input-lg', 'shoppingMonthDateList');
                                                ?>
                                            </h3>
                                        </span>
                                    </div>
                                    <div class="panel-body">

                                        <div class="row">
                                            <?php
                                            for ($i = 0; $i < count($groupMemberName); $i++) {
                                                ?>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <div class="panel panel-primary"
                                                         data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <div class="panel-ctrls" data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'
                                                                 data-action-refresh-demo='{"type": "circular"}'
                                                                 id="refreshGroupFinancialInfo"></div>
                                                            <h2 class="white-text-color"><?= $groupMemberName[$i] ?></h2>
                                                        </div>
                                                        <div class="panel-body no-padding">
                                                            <?php
                                                            $dynamicTable = new dynamicTable();
                                                            $dynamicTable->get_shopping_date_by_id($groupMemberId[$i]);
                                                            ?>
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

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="panel panel-midnightblue" data-widget='{"draggable": "false"}'>
                                    <div class="panel-heading">
                                        <h2>Form Validation</h2>
                                        <div class="panel-ctrls" data-actions-container=""
                                             data-action-collapse='{"target": ".panel-body, .panel-footer"}'></div>
                                    </div>
                                    <div class="panel-body">
                                        <form class="form-horizontal row-border" id="validate-form">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Item 1</label>
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="Enter Food Menu item Here"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Min-length</label>
                                                <div class="col-sm-6">
                                                    <input type="text" placeholder="At least 6 characters"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </form>
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
?>
<?php
include_once "managerJSPlaugin.html";
?>
<!-- Initialize scripts for this page-->


<script src="assets/js/searchBarCode.js"></script>
<script src="assets/js/statusManagement.js"></script>
<script src="shoppingDatePersonSelection.js"></script>

</body>
<?php
}
else {
    header('Location:logout.php');
}
?>
</html>





