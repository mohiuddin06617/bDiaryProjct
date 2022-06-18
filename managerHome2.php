<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Bachelor's Diary To make your life easy">
    <meta name="author" content="KaijuThemes">

        <link type='text/css' href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet'>

        <link type="text/css" href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link type="text/css" href="assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">
        <!-- Themify Icons -->
        <link type="text/css" href="assets/css/styles.css" rel="stylesheet">
        <!-- Core CSS with all styles -->

        <link type="text/css" href="assets/plugins/codeprettifier/prettify.css" rel="stylesheet">
        <!-- Code Prettifier -->
        <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">
        <!-- iCheck -->

        <!--[if lt IE 10]>
        <script type="text/javascript" src="assets/js/media.match.min.js"></script>
        <script type="text/javascript" src="assets/js/respond.min.js"></script>
        <script type="text/javascript" src="assets/js/placeholder.min.js"></script>
        <![endif]-->
        <!-- The following CSS are included as plugins and can be removed if unused-->

        <link type="text/css" href="assets/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
        <!-- FullCalendar -->
        <link type="text/css" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet">
        <!-- jVectorMap -->
        <link type="text/css" href="assets/plugins/switchery/switchery.css" rel="stylesheet">
        <!-- Switchery -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <?php
        session_start();
        if(!empty($_SESSION['email'])){
    $email = $_SESSION['email'];
    include "DbFile/dbconfig.php";
    $row = mysqli_fetch_array(mysqli_query($conn, "SELECT firstName,userStatus from userinfo where email='$email'"), MYSQLI_ASSOC);
    echo "<title>" . $row['firstName'] . "s Profile</title>";
    ?>

</head>

<body class="animated-content">
<?php
if(isset($_SESSION['email']) && $row['userStatus']==1){
    $email=$_SESSION['email'];
?>

<header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">

    <div class="logo-area">
        <span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
            <a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
                <span class="icon-bg">
                    <i class="ti ti-menu"></i>
                </span>
            </a>
        </span>

        <a class="navbar-brand" href="managerHome.php">bDiary</a>

        <div class="toolbar-icon-bg hidden-xs" id="toolbar-search">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-btn"><button class="btn" type="button"><i class="ti ti-search"></i></button></span>

                <span class="input-group-btn"><button class="btn" type="button"><i class="ti ti-close"></i></button></span>
            </div>
        </div>

    </div><!-- logo-area -->

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
            <a href="#" class="toggle-fullscreen"><span class="icon-bg"><i class="ti ti-fullscreen"></i></span></i></a>
        </li>

        <li class="dropdown toolbar-icon-bg hidden-xs">
            <a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="ti ti-email"></i></span><span
                        class="badge badge-deeporange">2</span></a>
            <div class="dropdown-menu notifications arrow">
                <div class="topnav-dropdown-header">
                    <span>Messages</span>
                </div>
                <div class="scroll-pane">
                    <ul class="media-list scroll-content">
                        <li class="media notification-message">
                            <a href="#">
                                <div class="media-left">
                                    <img class="img-circle avatar" src="" alt="" />
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading"><strong>Vincent Keller</strong> <span class="text-gray">‒ Design should be ...</span></h4>
                                    <span class="notification-time">2 mins ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="media notification-message">
                            <a href="#">
                                <div class="media-left">
                                    <img class="img-circle avatar" src="" alt="" />
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading"><strong>Frend Pratt</strong> <span class="text-gray">‒ I will start with the ...</span></h4>
                                    <span class="notification-time">40 mins ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="media notification-message">
                            <a href="#">
                                <div class="media-left">
                                    <img class="img-circle avatar" src="" alt="" />
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading"><strong>Cynthia Hines</strong> <span class="text-gray">‒ Interior bits are ...</span></h4>
                                    <span class="notification-time">6 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="media notification-message">
                            <a href="#">
                                <div class="media-left">
                                    <img class="img-circle avatar" src="" alt="" />
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading"><strong>Robin Horton</strong> <span class="text-gray">‒ Are you even ...</span></h4>
                                    <span class="notification-time">8 days ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="media notification-message">
                            <a href="#">
                                <div class="media-left">
                                    <img class="img-circle avatar" src="" alt="" />
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading"><strong>Amanda Torrez</strong> <span class="text-gray">‒ The message is ...</span></h4>
                                    <span class="notification-time">16 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="media notification-message">
                            <a href="#">
                                <div class="media-left">
                                    <img class="img-circle avatar" src="" alt="" />
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading"><strong>Khan Farhan</strong> <span class="text-gray">‒ Expected the stuff ...</span></h4>
                                    <span class="notification-time">2 days ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="media notification-message">
                            <a href="#">
                                <div class="media-left">
                                    <img class="img-circle avatar" src="" alt="" />
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading"><strong>Will Whedon</strong> <span class="text-gray">‒ The movie of this ...</span></h4>
                                    <span class="notification-time">4 days ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="#">See all messages</a>
                </div>
            </div>
        </li>

        <li class="dropdown toolbar-icon-bg">
            <a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg">
                    <i class="ti ti-bell"></i></span><span class="badge badge-deeporange">2</span></a>
            <div class="dropdown-menu notifications arrow">
                <div class="topnav-dropdown-header">
                    <span>Notifications</span>
                </div>
                <div class="scroll-pane">
                    <ul class="media-list scroll-content">
                        <li class="media notification-success">
                            <a href="#">
                                <div class="media-left">
                                    <span class="notification-icon"><i class="ti ti-check"></i></span>
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading">Update 1.0.4 successfully pushed</h4>
                                    <span class="notification-time">8 mins ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="media notification-info">
                            <a href="#">
                                <div class="media-left">
                                    <span class="notification-icon"><i class="ti ti-check"></i></span>
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading">Update 1.0.3 successfully pushed</h4>
                                    <span class="notification-time">24 mins ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="media notification-teal">
                            <a href="#">
                                <div class="media-left">
                                    <span class="notification-icon"><i class="ti ti-check"></i></span>
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading">Update 1.0.2 successfully pushed</h4>
                                    <span class="notification-time">16 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="media notification-indigo">
                            <a href="#">
                                <div class="media-left">
                                    <span class="notification-icon"><i class="ti ti-check"></i></span>
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading">Update 1.0.1 successfully pushed</h4>
                                    <span class="notification-time">2 days ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="media notification-danger">
                            <a href="#">
                                <div class="media-left">
                                    <span class="notification-icon"><i class="ti ti-arrow-up"></i></span>
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading">Initial Release 1.0</h4>
                                    <span class="notification-time">4 days ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="#">See all notifications</a>
                </div>
            </div>
        </li>

        <li class="dropdown toolbar-icon-bg">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown">
                <img class="img-circle" src="" alt="" />
            </a>
            <ul class="dropdown-menu userinfo arrow">
                <li><a href="#/"><i class="ti ti-user"></i><span>Profile</span><span class="badge badge-info pull-right">80%</span></a></li>
                <li><a href="#/"><i class="ti ti-panel"></i><span>Account</span></a></li>
                <li><a href="#/"><i class="ti ti-settings"></i><span>Settings</span></a></li>
                <li class="divider"></li>
                <li><a href="#/"><i class="ti ti-stats-up"></i><span>Earnings</span></a></li>
                <li><a href="#/"><i class="ti ti-view-list-alt"></i><span>Statement</span></a></li>
                <li><a href="#/"><i class="ti ti-money"></i><span>Withdrawals</span></a></li>
                <li class="divider"></li>
                <li><a href="logout.php"><i class="ti ti-shift-right"></i><span>Sign Out</span></a></li>
            </ul>
        </li>

    </ul>

</header>        
<div id="wrapper">
    <div id="layout-static">
        <div class="static-sidebar-wrapper sidebar-default">
            <div class="static-sidebar">
                <div class="sidebar">
                    <div class="widget">
                        <div class="widget-body">
                            <div class="userinfo">
                                <div class="avatar">
                                    <img src="" class="img-responsive img-circle">
                                </div>
                                <div class="info">
                                    <span class="username">Jonathan Smith</span>
                                    <span class="useremail">jon@avenxo.com</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget stay-on-collapse" id="widget-sidebar">
                        <nav role="navigation" class="widget-body">
                            <ul class="acc-menu">
                                <li class="nav-separator"><span>Dashboard</span></li>

                                <li><a href="javascript:void(0);" id="managerStatus">
                                        <i class="ti ti-home"></i>
                                        <span>Home</span>
                                        <span class="badge badge-teal">2</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" id="dailyFoodMenuSelection">
                                        <i class="ti ti-bell"></i>
                                        <span>Select Today's Food menu</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" id="dailyCostApproval">
                                        <i class="ti ti-view-list-alt"></i>
                                        <span>Daily Cost Approval</span>
                                    </a>
                                </li>

                                <li> 
                                    <a href="javascript:void(0);" id="shoppingDatePersonSelection">
                                        <i class="fa fa-cutlery" aria-hidden="true"></i>
                                        <span>Select who is going to do shopping</span>
                                    </a>

                                </li>
                                <li>
                                    <a href="javascript:void(0);" id="groupDetailsManager">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                        <span>Group Info</span>
                                    </a>

                                </li>
                              
                                <li><a href="userProfile.php" id="profileForManager">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span> Profile</span>
                                    </a>
                                </li>
                                <!--<li><a href="javascript:;"><i class="ti ti-file"></i><span>Pages</span></a>
                                    <ul class="acc-menu">
                                        <li><a href="extras-profile.html">Profile</a></li>
                                        <li><a href="extras-invoice.html">Invoice</a></li>
                                        <li><a href="javascript:;">Email Templates</a>
                                            <ul class="acc-menu">
                                                <li><a href="responsive-email/basic.html">Basic</a></li>
                                                <li><a href="responsive-email/hero.html">Hero</a></li>
                                                <li><a href="responsive-email/sidebar.html">Sidebar</a></li>
                                                <li><a href="responsive-email/sidebar-hero.html">Sidebar Hero</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="coming-soon.html">Coming Soon</a></li>
                                        <li><a href="extras-faq.html">FAQ</a></li>
                                        <li><a href="extras-registration.html">Registration</a></li>
                                        <li><a href="extras-forgotpassword.html">Password Reset</a></li>
                                        <li><a href="extras-login.html">Login</a></li>
                                        <li><a href="extras-404.html">404 Page</a></li>
                                        <li><a href="extras-500.html">500 Page</a></li>
                                    </ul>
                                </li>-->

                                <li class="nav-separator"><span>Extras</span></li>
                                <li><a href="app-inbox.html"><i class="ti ti-email"></i><span>Inbox</span><span class="badge badge-danger">3</span></a></li>
                                <li><a href="extras-calendar.html"><i class="ti ti-calendar "></i><span>Calendar</span><span class="badge badge-orange">1</span></a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="widget" id="widget-progress">
                        <div class="widget-heading">
                            Progress
                        </div>
                        <div class="widget-body">

                            <div class="mini-progressbar">
                                <div class="clearfix mb-sm">
                                    <div class="pull-left">Bandwidth</div>
                                    <div class="pull-right">90%</div>
                                </div>

                                <div class="progress">
                                    <div class="progress-bar progress-bar-lime" style="width: 90%"></div>
                                </div>
                            </div>
                            <div class="mini-progressbar">
                                <div class="clearfix mb-sm">
                                    <div class="pull-left">Storage</div>
                                    <div class="pull-right">50%</div>
                                </div>

                                <div class="progress">
                                    <div class="progress-bar progress-bar-info" style="width: 50%"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="static-content-wrapper">
            <div class="static-content">
                <div class="page-content">
                    <ol class="breadcrumb">

                        <li class=""><a href="index.html">Home</a></li>
                        <li class="active"><a href="index.html">Dashboard</a></li>

                    </ol>
                    <div class="container-fluid">

                        <div class="row">

                            <div class="col-md-10">

                                <div id="siteContent">


                                </div>

                                <!-- ------------------------- Content Area  ------------------------------------ -->
                                <!--
                                <div class="row">
<div class="col-md-3">
<div class="info-tile tile-orange">
<div class="tile-icon"><i class="ti ti-shopping-cart-full"></i></div>
<div class="tile-heading"><span>Orders</span></div>
<div class="tile-body"><span>2,150</span></div>
<div class="tile-footer"><span class="text-success">22.5% <i class="fa fa-level-up"></i></span></div>
</div>
</div>
<div class="col-md-3">
<div class="info-tile tile-success">
<div class="tile-icon"><i class="ti ti-bar-chart"></i></div>
<div class="tile-heading"><span>Revenues</span></div>
<div class="tile-body"><span>$75,100</span></div>
<div class="tile-footer"><span class="text-danger">12.7% <i class="fa fa-level-down"></i></span></div>
</div>
</div>
<div class="col-md-3">
<div class="info-tile tile-info">
<div class="tile-icon"><i class="ti ti-stats-up"></i></div>
<div class="tile-heading"><span>Earnings</span></div>
<div class="tile-body"><span>$40,150</span></div>
<div class="tile-footer"><span class="text-success">5.2% <i class="fa fa-level-up"></i></span></div>
</div>
</div>
<div class="col-md-3">
<div class="info-tile tile-danger">
<div class="tile-icon"><i class="ti ti-bar-chart-alt"></i></div>
<div class="tile-heading"><span>Visitors</span></div>
<div class="tile-body"><span>12,600</span></div>
<div class="tile-footer"><span class="text-danger">10.5% <i class="fa fa-level-down"></i></span></div>
</div>
</div>
</div>
                                -->

                                <!-- <footer role="contentinfo" class="footer">
                                    <div class="clearfix">
                                        <ul class="list-unstyled list-inline pull-left">
                                            <li><h5 style="margin: 0;">&copy; 2015 Dreamers Space Ltd</h5></li>
                                        </ul>
                                        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
                                    </div>
                                </footer>
 -->
                            </div>
                        </div>
                    </div>


                    <!-- Switcher -->

                    <div class="demo-options">
                        <div class="demo-options-icon"><i class="ti ti-paint-bucket"></i></div>
                        <div class="demo-heading">Demo Settings</div>

                        <div class="demo-body">
                            <div class="tabular">
                                <div class="tabular-row">
                                    <div class="tabular-cell">Fixed Header</div>
                                    <div class="tabular-cell demo-switches"><input class="bootstrap-switch" type="checkbox" checked data-size="mini" data-on-color="success" data-off-color="default" name="demo-fixedheader" data-on-text="&nbsp;" data-off-text="&nbsp;"></div>
                                </div>
                                <div class="tabular-row">
                                    <div class="tabular-cell">Boxed Layout</div>
                                    <div class="tabular-cell demo-switches"><input class="bootstrap-switch" type="checkbox" data-size="mini" data-on-color="success" data-off-color="default" name="demo-boxedlayout" data-on-text="&nbsp;" data-off-text="&nbsp;"></div>
                                </div>
                                <div class="tabular-row">
                                    <div class="tabular-cell">Collapse Leftbar</div>
                                    <div class="tabular-cell demo-switches"><input class="bootstrap-switch" type="checkbox" data-size="mini" data-on-color="success" data-off-color="default" name="demo-collapseleftbar" data-on-text="&nbsp;" data-off-text="&nbsp;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="demo-body">
                            <div class="option-title">Topnav</div>
                            <ul id="demo-header-color" class="demo-color-list">
                                <li><span class="demo-cyan"></span></li>
                                <li><span class="demo-light-blue"></span></li>
                                <li><span class="demo-blue"></span></li>
                                <li><span class="demo-indigo"></span></li>
                                <li><span class="demo-deep-purple"></span></li>
                                <li><span class="demo-purple"></span></li>
                                <li><span class="demo-pink"></span></li>
                                <li><span class="demo-red"></span></li>
                                <li><span class="demo-teal"></span></li>
                                <li><span class="demo-green"></span></li>
                                <li><span class="demo-light-green"></span></li>
                                <li><span class="demo-lime"></span></li>
                                <li><span class="demo-yellow"></span></li>
                                <li><span class="demo-amber"></span></li>
                                <li><span class="demo-orange"></span></li>
                                <li><span class="demo-deep-orange"></span></li>
                                <li><span class="demo-midnightblue"></span></li>
                                <li><span class="demo-bluegray"></span></li>
                                <li><span class="demo-bluegraylight"></span></li>
                                <li><span class="demo-black"></span></li>
                                <li><span class="demo-gray"></span></li>
                                <li><span class="demo-graylight"></span></li>
                                <li><span class="demo-default"></span></li>
                                <li><span class="demo-brown"></span></li>
                            </ul>
                        </div>

                        <div class="demo-body">
                            <div class="option-title">Sidebar</div>
                            <ul id="demo-sidebar-color" class="demo-color-list">
                                <li><span class="demo-cyan"></span></li>
                                <li><span class="demo-light-blue"></span></li>
                                <li><span class="demo-blue"></span></li>
                                <li><span class="demo-indigo"></span></li>
                                <li><span class="demo-deep-purple"></span></li>
                                <li><span class="demo-purple"></span></li>
                                <li><span class="demo-pink"></span></li>
                                <li><span class="demo-red"></span></li>
                                <li><span class="demo-teal"></span></li>
                                <li><span class="demo-green"></span></li>
                                <li><span class="demo-light-green"></span></li>
                                <li><span class="demo-lime"></span></li>
                                <li><span class="demo-yellow"></span></li>
                                <li><span class="demo-amber"></span></li>
                                <li><span class="demo-orange"></span></li>
                                <li><span class="demo-deep-orange"></span></li>
                                <li><span class="demo-midnightblue"></span></li>
                                <li><span class="demo-bluegray"></span></li>
                                <li><span class="demo-bluegraylight"></span></li>
                                <li><span class="demo-black"></span></li>
                                <li><span class="demo-gray"></span></li>
                                <li><span class="demo-graylight"></span></li>
                                <li><span class="demo-default"></span></li>
                                <li><span class="demo-brown"></span></li>
                            </ul>
                        </div>

                    </div>

                </div>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <script>
                    $(document).ready(function () {





                        function search() {
                            var searchQuery = $("#searchAllUser").val();
                            if (searchQuery != "") {
                                
                                $.ajax({
                                    type: "POST",
                                    url: "searchBarCode.php",
                                    data: "searchQuery=" + searchQuery,
                                    success: function (data) {
                                        $("#result").html(data);
                                    }
                                });
                            }
                            else if(searchQuery==""){
                                $("#result").html("");
                            }
                            //document.getElementById("result").innerHTML="Search has coming handy";
                            console.log("Search have come in handy");
                        }

                        function gettingManagerStatusPage() {
                                    $.ajax({
                                        method: "POST",
                                        url: "managerStatus.php",
                                        dataType: "html"
                                    })
                                        .done(function (msg) {
                                            $('#siteContent').html(msg);
                                        });
                                }
                        function gettingDailyFoodMenuSelectionPage(){
                                    $.ajax({
                                        method: "POST",
                                        url: "dailyFoodMenuSelection.php",
                                        dataType: "html"
                                    })
                                        .done(function (msg) {
                                            $('#siteContent').html(msg);
                                            
                                        });
                                }
                        function gettingDailyCostApprovalPage(){
                                    $.ajax({
                                        method: "POST",
                                        url: "dailyCostApproval.php",
                                        dataType: "html"
                                    })
                                        .done(function (msg) {
                                            $('#siteContent').html(msg);
                                        });
                                }
                        function gettingDailyCostApprovalPage(){
                                    $.ajax({
                                        method: "POST",
                                        url: "dailyCostApproval.php",
                                        dataType: "html"
                                    })
                                        .done(function (msg) {
                                            $('#siteContent').html(msg);
                                            // alert( "Data Saved: " + msg );
                                        });
                                }

                        function gettingShoppingDatePersonSelectionPage(){
                                    $.ajax({
                                        method: "POST",
                                        url: "shoppingDatePersonSelection.php",
                                        dataType: "html"
                                    })
                                        .done(function (msg) {
                                            $('#siteContent').html(msg);
                                            // alert( "Data Saved: " + msg );
                                        });
                                }
                        function gettinggroupDetailsManagerPage(){
                                    $.ajax({
                                        method: "POST",
                                        url: "groupDetailsManager.php",
                                        dataType: "html"
                                    })
                                        .done(function (msg) {
                                            $('#siteContent').fadeIn(msg);
                                            // alert( "Data Saved: " + msg );
                                        });
                                }
                        $('#managerStatus').on('click',function () {
                                gettingManagerStatusPage();
                        });
                        $('#dailyFoodMenuSelection').on('click',function () {
                                gettingDailyFoodMenuSelectionPage();
                        });
                         $('#dailyCostApproval').on('click',function () {
                                gettingDailyCostApprovalPage();
                        });
                        $('#shoppingDatePersonSelection').on('click',function () {
                                gettingShoppingDatePersonSelectionPage();
                        });
                        $('#groupDetailsManager').on('click',function () {
                                gettinggroupDetailsManagerPage();
                        });






                        $("#searchIcon").click(function () {
                            search();
                        });
                        $("#searchAllUser").keyup(function () {
                            search();
                        });
                        $("#searchAllUser").focus(function (){
                            search();
                        });
                        gettingManagerStatusPage();
                    });
                </script>

                <!-- Switcher -->
                        <!-- Load site level scripts -->

                        <!-- <script type="text/javascript" src="assets/js/jquery-1.10.2.min.js"></script> -->
                        <!-- Load jQuery -->
                        <script type="text/javascript" src="assets/js/jqueryui-1.10.3.min.js"></script>
                        <!-- Load jQueryUI -->
                        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
                        <!-- Load Bootstrap -->
                        <script type="text/javascript" src="assets/js/enquire.min.js"></script>
                        <!-- Load Enquire -->

                        <script type="text/javascript" src="assets/plugins/velocityjs/velocity.min.js"></script>
                        <!-- Load Velocity for Animated Content -->
                        <script type="text/javascript" src="assets/plugins/velocityjs/velocity.ui.min.js"></script>

                        <script type="text/javascript" src="assets/plugins/wijets/wijets.js"></script>
                        <!-- Wijet -->

                        <script type="text/javascript" src="assets/plugins/codeprettifier/prettify.js"></script>
                        <!-- Code Prettifier  -->
                        <script type="text/javascript"
                                src="assets/plugins/bootstrap-switch/bootstrap-switch.js"></script>
                        <!-- Swith/Toggle Button -->

                        <script type="text/javascript"
                                src="assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>
                        <!-- Bootstrap Tabdrop -->

                        <script type="text/javascript" src="assets/plugins/iCheck/icheck.min.js"></script>
                        <!-- iCheck -->

                        <script type="text/javascript"
                                src="assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script>
                        <!-- nano scroller -->

                        <script type="text/javascript" src="assets/js/application.js"></script>
                        <script type="text/javascript" src="assets/demo/demo.js"></script>
                        <script type="text/javascript" src="assets/demo/demo-switcher.js"></script>

                        <!-- End loading site level scripts -->

                        <!-- Load page level scripts-->

                        <!-- Charts -->
                        <script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.min.js"></script>
                        <!-- Flot Main File -->
                        <script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.pie.min.js"></script>
                        <!-- Flot Pie Chart Plugin -->
                        <script type="text/javascript"
                                src="assets/plugins/charts-flot/jquery.flot.stack.min.js"></script>
                        <!-- Flot Stacked Charts Plugin -->
                        <script type="text/javascript"
                                src="assets/plugins/charts-flot/jquery.flot.orderBars.min.js"></script>
                        <!-- Flot Ordered Bars Plugin-->
                        <script type="text/javascript"
                                src="assets/plugins/charts-flot/jquery.flot.resize.min.js"></script>
                        <!-- Flot Responsive -->
                        <script type="text/javascript"
                                src="assets/plugins/charts-flot/jquery.flot.tooltip.min.js"></script>
                        <!-- Flot Tooltips -->
                        <script type="text/javascript" src="assets/plugins/charts-flot/jquery.flot.spline.js"></script>
                        <!-- Flot Curved Lines -->

                        <script type="text/javascript"
                                src="assets/plugins/sparklines/jquery.sparklines.min.js"></script>
                        <!-- Sparkline -->

                        <script type="text/javascript"
                                src="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
                        <!-- jVectorMap -->
                        <script type="text/javascript"
                                src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
                        <!-- jVectorMap -->

                        <script type="text/javascript" src="assets/plugins/switchery/switchery.js"></script>
                        <!-- Switchery -->
                        <script type="text/javascript"
                                src="assets/plugins/easypiechart/jquery.easypiechart.js"></script>
                        <script type="text/javascript" src="assets/plugins/fullcalendar/moment.min.js"></script>
                        <!-- Moment.js Dependency -->
                        <script type="text/javascript" src="assets/plugins/fullcalendar/fullcalendar.min.js"></script>
                        <!-- Calendar Plugin -->

                        <!--  <script type="text/javascript" src="assets/demo/demo-index.js"></script>       -->                    <!-- Initialize scripts

for this page-->

                        <!-- End loading page level scripts-->


<?php
}
else{
header("Location:logout.php");
}
?>






<!--
 <script>
     $(document).ready(function(){
         $("#datepickerforfoodmenu").datepicker();
     });
 </script>
-->


<?php
}
else
{
    header("Location:logout.php");
}

?>
</body>
</html>

<!-- <script>
    jQuery(document).ready(function ($) {
        $('.my_form .add-box').click(function () {
            var n = $('.text_box').length + 1;
            if (5 < n) {
                alert('Stop it!');
                return false;
            }
            var item_textBox = $('<p class="text_box">' +
                '<label for="item' + n + '">ITEM <span class="item_number">' + n + '</span></label>' +
                ' <input type="text" name="itemList[]" value="" id="item' + n + '" />' +
                ' <a href="#" class="remove-box">Remove</a></p>');
            item_textBox.hide();
            $('.my_form p.text_box:last').after(item_textBox);
            item_textBox.fadeIn('slow');
            return false;
        });
        $('.my_form').on('click', '.remove-box', function () {
            $(this).parent().css('background-color', '#FF6C6C');
            $(this).parent().fadeOut("slow", function () {
                $(this).remove();
                $('.item_number').each(function (index) {
                    $(this).text(index + 1);
                });
            });
            return false;
        });
    });
</script> -->
</html>

<?php
//practice database connection
/*if(!empty($_POST["save"])) {
    $conn = mysqli_connect("localhost","root","","foodmenu");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $itemCount = count($_POST["itemList"]);
    $itemValues=0;
    $query = "INSERT INTO item (item_name) VALUES ";
    $queryValue = "";
    for($i=0;$i<$itemCount;$i++) {
        if(!empty($_POST["itemList"][$i])){
            $itemValues++;
            if($queryValue!="") {
                $queryValue .= ",";
            }
            $queryValue .= "('" . $_POST["itemList"][$i] . "')";
        }
    }
    $sql = $query.$queryValue;
    if($itemValues!=0) {
        $result = mysqli_query($conn,$sql);
        if(!empty($result)) $message = "Added Successfully.";
        else{
            echo "Unsucessful".mysqli_error();
        }
    }
}*/
?>