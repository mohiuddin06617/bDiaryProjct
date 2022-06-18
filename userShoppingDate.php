<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
if(isset($_SESSION['userID'])&& isset($_SESSION['email']) && $_SESSION['userStatus']==0)
{
    include_once 'userShoppingDateFetch.php';
    include_once 'dynamicMonthSelection.php';

?>

    <head>
        <meta charset="utf-8">
        <title>Your Shopping Date Details List</title>
        <?php
        include_once "userHeader.php";
        ?>
        <link rel="stylesheet" type="text/css" href="assets/css/customTableDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/tileExtendedDesign.css">
        <link href='https://fonts.googleapis.com/css?family=Bitter' rel='stylesheet'>
        <!-- External checkbox,modal and Input Design -->
        <style>
            @media screen and (max-width: 430px) {
                .tile-icon {
                    visibility: hidden;
                }
            }

            table, tr, thead, th, td {
                border: 1px solid #00acc1 !important;
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
            <a href="#"><span class="icon-bg"><i class="ti ti-world"></i></span></a>
        </li>

        <li class="toolbar-icon-bg hidden-xs">
            <a href="#"><span class="icon-bg"><i class="ti ti-view-grid"></i></span></a>
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
                if (isset($_SESSION['groupID'])){
                ?>
                <div class="page-content">
                    <ol class="breadcrumb">

                        <li class="active"><a href="userHome.php">Home</a></li>
                        <li class="active"><a href="userShoppingDate.php">User Shopping Date Details</a></li>

                    </ol>

                    <div class="container-fluid">

                        <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                            <div class="row">
                                <div class="panel-heading">
                                    <div class="panel-ctrls"
                                         data-actions-container=""
                                         data-action-collapse='{"target": ".panel-body"}'>
                                    </div>
                                    <h3 class="text-center" style="color: white; font-size: 25px;"><i class="fa fa-calendar fa-lg"></i> Your Shopping Date Details</h3>
                                </div>
                            </div>


                            <div class="panel-body">
                                <div class="row" style="display: none;">
                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
                                    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                                    <div class="well well-lg tooltips" data-trigger="hover" data-original-title="Hurry up and do the shopping!" style="background: #d6ff06;color: #0e0e0e; box-shadow: 10px 10px 10px #000000;">
                                        <p class="text-center" style="font-size: 25px; font-family:Impact;">Your Shopping Date is Today</p>
                                    </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-1 col-sm-0 col-xs-0"></div>
                                    <div class="col-lg-6 col-md-10 col-sm-12 col-xs-12">
                                        <table class="table table-striped table-fill">
                                            <thead>
                                            <tr>
                                                <th colspan="2" class="text-center" style="background: #00e676 !important;"><span style="font-size: 20px !important;  font-family: 'Arial Black';">Your Next Shopping Date</span></th>
                                            </tr>
                                            <!--<tr class="info">
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>-->
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td style="font-weight: bolder;font-size: larger;">
                                                    <?php
                                                    $userShoppingDateFetch=new userShoppingDateFetch();
                                                    if ($userShoppingDateFetch->user_next_shopping_date($_SESSION['userID'])){
                                                       echo $userShoppingDateFetch->user_next_shopping_date($_SESSION['userID']);
                                                    }else{
                                                        echo "No Data is Selected by manager for you";
                                                    }
                                                    ?>
                                                </td>
                                                <!--<td>
                                                    <button class="btn btn-success btn-getting editBtn">
                                                        <i class="fa fa-edit fa-lg" aria-hidden="true"></i> Change Date</button>
                                                </td>-->
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-3 col-md-1 col-sm-0 col-xs-0"></div>
                                </div>
                                &nbsp;
                                <br>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                            <div class="panel-heading">
                                                <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                                                <h3 class="text-center" style="color: white; font-family: 'Bitter'; font-size: 22px;"><i class="fa fa-th-list fa-lg"></i> My Shopping Dates
                                                    <?php
                                                    $dynamicMonth = new monthSelection();
                                                    echo $dynamicMonth->month_select_box('month', 'input-lg black-text-color', 'userShoppingMonthDateList');
                                                    ?>
                                                </h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-0 col-md-1 col-sm-0 col-xs-0"></div>
                                                    <div class="col-lg-12 col-md-10 col-sm-12 col-xs-12">
                                                        <table class='table table-striped table-fill'>
                                                            <thead>
                                                            <tr class='info black-text-color'>
                                                                <th>Date</th>
                                                                <th>Status</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="selectedMonthResult">
                                                            <?php
                                                            $userShoppingDateFetch->user_shopping_list($_SESSION['userID']);
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-lg-0 col-md-1 col-sm-0 col-xs-0"></div>
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
                                        <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                                        <h3 class="text-center" style="color: papayawhip;"><i class="fa fa-group"></i> <b>Group Members Shopping Date List</b></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <?php
                                            $totalMember=count($userShoppingDateFetch->return_group_members_name($_SESSION['groupID']));
                                            for($i=0;$i<$totalMember;$i++) {
                                                ?>
                                                <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                                                    <div class="panel panel-info" data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <div class="panel-ctrls" data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'></div>
                                                            <h2><?php
                                                                echo $userShoppingDateFetch->return_group_members_name($_SESSION['groupID'])[$i];
                                                                ?>
                                                            </h2>
                                                            <div class="options">
                                                            </div>
                                                        </div>
                                                        <div class="panel-body no-padding">
                                                            <table class='table table-striped table-fill'>
                                                                <thead>
                                                                <tr class='info black-text-color'>
                                                                    <th>Date</th>
                                                                    <th>Bazar Status</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                $userShoppingDateFetch->group_members_bazar_date_list($userShoppingDateFetch->return_group_member_id()[$i]);
                                                                ?>
                                                                </tbody>
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
                    <?php
                }
                else{
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
<script type="text/javascript" src="assets/plugins/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="userShoppingDate.js"></script>
<?php
}
else{
    header('Location:logout.php');
}
?>
</body>

</html>


<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 05-Jan-17
 * Time: 7:28 AM
 */
/*session_start();
if(isset($_SESSION['email'])) {

    require "DbFile/dbconfig.php";
    $sqlForSelectedPerson = "SELECT selected_date from shoppingpersonselection WHERE selected_person_id='".$_SESSION['userID']."'";
    $resultForSelectedPerson=mysqli_query($conn,$sqlForSelectedPerson);


    while ($row=mysqli_fetch_array($resultForSelectedPerson,MYSQLI_ASSOC)) {

        echo "<h4>Your Shopping Date is: </h4><h3>". $row['selected_date']." </h3><br>";

    }

}
else{

}*/
?>