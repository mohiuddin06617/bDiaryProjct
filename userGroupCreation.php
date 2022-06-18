<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 10/3/2017
 * Time: 9:06 AM
 */
?>


<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<?php
if(isset($_SESSION['userID']) && $_SESSION['userStatus']==0 && isset($_SESSION['email'])) {
    ?>
    <?php
    include_once "userHeader.php";
    ?>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/css/profileCardDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">
        <link rel="stylesheet" type="text/css" href="assets/css/socialMediaButtonDesign.css">

        <!-- External checkbox,modal and Input Design -->

        <style>
            @media screen and (min-width: 760px) {
                #groupMenuTabNav{
                    margin-top: 15%;
                }
            }
            #groupMenuTabNav{
                color: black;
            }

            table,tr,thead,th,td{
                border: 1px solid wheat;
            }
            .black-color{
                color: black;
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
                    <div class="page-content">
                        <ol class="breadcrumb">

                            <li class="active"><a href="userHome.php">Home</a></li>
                            <li class="active"><a href="userGroup.php"> User Group Details</a></li>

                        </ol>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3" id="groupMenuTabNav">
                                    <!-- panel -->
                                    <div class="list-group list-group-alternate mb-n nav nav-tabs">
                                        <div class="panel panel-profile">
                                            <div class="panel-body">
                                                <a href="userGroup.php" style="font-size: 25px;" class="text-primary"><?php     print_r($_SESSION); ?>bDiary</a>
                                            </div>
                                        </div>
                                        <hr>
                                        <a href="#tab-details" 	role="tab" data-toggle="tab" class="list-group-item active">
                                            <i class="ti ti-user"></i>Group Details <span class="badge badge-primary">80%</span></a>
                                        <a href="#tab-member" role="tab" data-toggle="tab" class="list-group-item">
                                            <i class="ti ti-time"></i> Members</a>
                                        <a href="#tab-activity" 	role="tab" data-toggle="tab" class="list-group-item">
                                            <i class="ti ti-view-grid"></i> Activiy</a>
                                        <a href="#tab-discussion" role="tab" data-toggle="tab" class="list-group-item">
                                            <i class="ti ti-view-list-alt"></i> Discussion</a>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab-discussion">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h2>Projects</h2>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table m-n">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Project Title</th>
                                                                <th>Description</th>
                                                                <th>Progress</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <th scope="row">1.</th>
                                                                <td><strong>Avenxo</strong></td>
                                                                <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
                                                                <td class="vam">
                                                                    <div class="progress m-n">
                                                                        <div class="progress-bar progress-bar-success" style="width: 20%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">2.</th>
                                                                <td><strong>Phoenix</strong></td>
                                                                <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
                                                                <td class="vam">
                                                                    <div class="progress m-n">
                                                                        <div class="progress-bar progress-bar-success" style="width: 50%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">3.</th>
                                                                <td><strong>Arvin</strong></td>
                                                                <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
                                                                <td class="vam">
                                                                    <div class="progress m-n">
                                                                        <div class="progress-bar progress-bar-success" style="width: 10%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">4.</th>
                                                                <td><strong>Flip3</strong></td>
                                                                <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
                                                                <td class="vam">
                                                                    <div class="progress m-n">
                                                                        <div class="progress-bar progress-bar-success" style="width: 75%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">5.</th>
                                                                <td><strong>Appboom</strong></td>
                                                                <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
                                                                <td class="vam">
                                                                    <div class="progress m-n">
                                                                        <div class="progress-bar progress-bar-success" style="width: 25%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">6.</th>
                                                                <td><strong>Xavant</strong></td>
                                                                <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit</td>
                                                                <td class="vam">
                                                                    <div class="progress m-n">
                                                                        <div class="progress-bar progress-bar-success" style="width: 15%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div><!-- /.table-responsive -->
                                                </div> <!-- /.panel-body -->
                                            </div>
                                        </div> <!-- #tab-projects -->

                                        <div class="tab-pane active" id="tab-details">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h1 class="text-center black-color"><span style="font-family: Impact;">bDiary </span><button class="btn btn-link btn-sm"><i class="fa fa-edit"></i> Edit</button></h1>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="about-area">
                                                        <h3><span class="black-color">Description </span><button class="btn btn-link btn-sm"><span class="fa fa-edit"></span> Edit</button></h3>
                                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores in eveniet sapiente error fuga tenetur ex ea dignissimos voluptas ab molestiae eos totam quo dolorem maxime illo neque quia itaque.</p>
                                                        <p>Asperiores in eveniet sapiente error fuga tenetur ex ea dignissimos voluptas ab molestiae eos totam quo dolorem maxime illo neque quia itaque.</p>

                                                    </div>
                                                    <div class="about-area">
                                                        <h4>Basic Information</h4>
                                                        <div class="table table-bordered black-color">
                                                            <table class="table">
                                                                <tbody>
                                                                <tr>
                                                                    <th>House Address</th>
                                                                    <td> Dhaka, Bangladesh</td>
                                                                    <td><button class="btn btn-link"><i class="fa fa-edit"></i> Edit</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Total Member</th>
                                                                    <td>8</td>
                                                                    <td><button class="btn btn-link"><i class="fa fa-edit"></i> Edit</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Maid Name</th>
                                                                    <td>Maid Name </td>
                                                                    <td><button class="btn btn-link"><i class="fa fa-edit"></i> Edit</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Maid Phone</th>
                                                                    <td>+111111111111</td>
                                                                    <td><button class="btn btn-link"><i class="fa fa-edit"></i> Edit</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Maid Address</th>
                                                                    <td>Dhaka, Bangladesh</td>
                                                                    <td><button class="btn btn-link"><i class="fa fa-edit"></i> Edit</button></td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="about-area">
                                                        <h4>Personal Information</h4>
                                                        <div class="table-responsive">
                                                            <table class="table about-table">
                                                                <tbody>
                                                                <tr>
                                                                    <th>Full Name</th>
                                                                    <td>Jonathan Davison Smith</td>
                                                                    <td><button class="btn btn-link">Edit</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Birth Date</th>
                                                                    <td>1 January</td>
                                                                    <td><button class="btn btn-link">Edit</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Birth Year</th>
                                                                    <td>1980</td>
                                                                    <td><button class="btn btn-link">Edit</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Gender</th>
                                                                    <td>Male</td>
                                                                    <td><button class="btn btn-link">Edit</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Languages</th>
                                                                    <td>English</td>
                                                                    <td><button class="btn btn-link">Edit</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>City</th>
                                                                    <td>Canbera</td>
                                                                    <td><button class="btn btn-link">Edit</button></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Country</th>
                                                                    <td>Australia</td>
                                                                    <td><button class="btn btn-link">Edit</button></td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab-member">
                                            <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                                <div class="row">
                                                    <div class="panel-heading">
                                                        <div class="panel-ctrls"
                                                             data-actions-container=""
                                                             data-action-collapse='{"target": ".panel-body"}'>
                                                        </div>
                                                        <h3 class="text-center" style="color: white; font-size: 25px;"><i class="fa fa-user-secret fa-lg"></i> Manager </h3>
                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
                                                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                                                            <div class="card">
                                                                <img src="Resource/LuffyImage2.png" class="card-img" style="width:100%">
                                                                <div class="card-container">
                                                                    <h3 class="text-primary"><a href="userProfile.php">Manager Name</a></h3>
                                                                    <p class="card-title">CEO & Founder, Example</p>
                                                                    <p>Harvard University</p>

                                                                    <div>
                                                                        <a href="https://www.facebook.com" target="_parent">
                                                                            <i class="fa fa-facebook socialButton"></i></a>
                                                                        <a href="#"><i class="fa fa-twitter socialButton"></i></a>
                                                                        <a href="#"><i class="fa fa-linkedin socialButton"></i></a>
                                                                        <a href="#"><i class="fa fa-google-plus socialButton"></i></a>
                                                                    </div>
                                                                    <p><button class="btn btn-getting btn-lg">Message</button></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-1 col-xs-0"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                                                <div class="panel-heading">
                                                    <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body"}'></div>
                                                    <h3 class="text-center" style="color: papayawhip;"><i class="fa fa-group"></i> Group Members List</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                            <div class="card">
                                                                <img src="Resource/LuffyImage.png" class="card-img" style="width:100%">
                                                                <div class="card-container">
                                                                    <h3 class="text-primary"><a href="userProfile.php">User Name 1</a></h3>
                                                                    <p class="card-title">CEO & Founder, Example</p>
                                                                    <p>Harvard University</p>
                                                                    <div style="margin: 10px 0;">
                                                                        <a href="#"><i class="fa fa-dribbble fa-lg socialButton"></i></a>
                                                                        <a href="#"><i class="fa fa-twitter fa-lg socialButton"></i></a>
                                                                        <a href="#"><i class="fa fa-linkedin fa-lg socialButton"></i></a>
                                                                        <a href="#"><i class="fa fa-facebook fa-lg socialButton"></i></a>
                                                                    </div>
                                                                    <p><button class="btn btn-getting btn-lg">Message</button></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                            <div class="card">
                                                                <img src="Resource/LuffyImage2.png" class="card-img" style="width:100%">
                                                                <div class="card-container">
                                                                    <h3 class="text-primary"><a href="userProfile.php">User Name 2</a></h3>
                                                                    <p class="card-title">CEO & Founder, Example</p>
                                                                    <p>Harvard University</p>
                                                                    <div style="margin: 10px 0;">
                                                                        <a href="#"><i class="fa fa-dribbble fa-lg socialButton"></i></a>
                                                                        <a href="#"><i class="fa fa-twitter fa-lg socialButton"></i></a>
                                                                        <a href="#"><i class="fa fa-linkedin fa-lg socialButton"></i></a>
                                                                        <a href="#"><i class="fa fa-facebook fa-lg socialButton"></i></a>
                                                                    </div>
                                                                    <p><button class="btn btn-getting btn-lg">Message</button></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                            <div class="card">
                                                                <img src="Resource/LuffyImage.png" class="card-img" style="width:100%">
                                                                <div class="card-container">
                                                                    <h3 class="text-primary"><a href="userProfile.php">User Name 3</a></h3>
                                                                    <p class="card-title">CEO & Founder, Example</p>
                                                                    <p>Harvard University</p>
                                                                    <div style="margin: 10px 0;">
                                                                        <a href="#"><i class="fa fa-dribbble fa-lg socialButton"></i></a>
                                                                        <a href="#"><i class="fa fa-twitter fa-lg socialButton"></i></a>
                                                                        <a href="#"><i class="fa fa-linkedin fa-lg socialButton"></i></a>
                                                                        <a href="#"><i class="fa fa-facebook fa-lg socialButton"></i></a>
                                                                    </div>
                                                                    <p><button class="btn btn-getting btn-lg">Message</button></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab-activity">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 col-md-12">
                                                    <div class="panel panel-gray" data-widget='{"draggable": "false"}'>
                                                        <div class="panel-heading">
                                                            <h2>Recent Activities</h2>
                                                            <div class="panel-ctrls button-icon-bg"
                                                                 data-actions-container=""
                                                                 data-action-collapse='{"target": ".panel-body"}'
                                                                 data-action-colorpicker=''
                                                                 data-action-refresh-demo='{"type": "circular"}'
                                                            >
                                                            </div>
                                                        </div>
                                                        <div class="panel-body">
                                                            <ul class="mini-timeline">
                                                                <li class="mini-timeline-lime">
                                                                    <div class="timeline-icon"></div>
                                                                    <div class="timeline-body">
                                                                        <div class="timeline-content">
                                                                            <a href="#/" class="name">Vincent Keller</a> added new task <a href="#/">Admin Dashboard UI</a>
                                                                            <span class="time">4 mins ago</span>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li class="mini-timeline-deeporange">
                                                                    <div class="timeline-icon"></div>
                                                                    <div class="timeline-body">
                                                                        <div class="timeline-content">
                                                                            <a href="#/" class="name">Shawna Owen</a> added <a href="#/" class="name">Alonzo Keller</a> and <a href="#/" class="name">Mario Bailey</a> to project <a href="#/">Wordpress eCommerce Template</a>
                                                                            <span class="time">6 mins ago</span>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li class="mini-timeline-info">
                                                                    <div class="timeline-icon"></div>
                                                                    <div class="timeline-body">
                                                                        <div class="timeline-content">
                                                                            <a href="#/" class="name">Christian Delgado</a> commented on thread <a href="#/">Frontend Template PSD</a>
                                                                            <span class="time">12 mins ago</span>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li class="mini-timeline-indigo">
                                                                    <div class="timeline-icon"></div>
                                                                    <div class="timeline-body">
                                                                        <div class="timeline-content">
                                                                            <a href="#/" class="name">Jonathan Smith</a> added <a href="#/" class="name">Frend Pratt</a> and <a href="#/" class="name">Robin Horton</a> to project <a href="#/">Material Design Admin Template</a>
                                                                            <span class="time">6 hours ago</span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li class="mini-timeline-default">
                                                                    <div class="timeline-body ml-n">
                                                                        <div class="timeline-content">
                                                                            <button type="button" data-loading-text="Loading..." class="loading-example-btn btn btn-sm btn-default">See more</button>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="panel-body scroll-pane" style="height: 320px;">
                                                            <div class="scroll-content">
                                                                <ul class="mini-timeline">
                                                                    <li class="mini-timeline-lime">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Vincent Keller</a> added new task <a href="#/">Admin Dashboard UI</a>
                                                                                <span class="time">4 mins ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li class="mini-timeline-deeporange">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Shawna Owen</a> added <a href="#/" class="name">Alonzo Keller</a> and <a href="#/" class="name">Mario Bailey</a> to project <a href="#/">Wordpress eCommerce Template</a>
                                                                                <span class="time">6 mins ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li class="mini-timeline-info">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Christian Delgado</a> commented on thread <a href="#/">Frontend Template PSD</a>
                                                                                <span class="time">12 mins ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li class="mini-timeline-indigo">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Jonathan Smith</a> added <a href="#/" class="name">Frend Pratt</a> and <a href="#/" class="name">Robin Horton</a> to project <a href="#/">Material Design Admin Template</a>
                                                                                <span class="time">6 hours ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="mini-timeline-lime">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Vincent Keller</a> added new task <a href="#/">Admin Dashboard UI</a>
                                                                                <span class="time">4 mins ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li class="mini-timeline-deeporange">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Shawna Owen</a> added <a href="#/" class="name">Alonzo Keller</a> and <a href="#/" class="name">Mario Bailey</a> to project <a href="#/">Wordpress eCommerce Template</a>
                                                                                <span class="time">6 mins ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li class="mini-timeline-info">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Christian Delgado</a> commented on thread <a href="#/">Frontend Template PSD</a>
                                                                                <span class="time">12 mins ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>

                                                                    <li class="mini-timeline-indigo">
                                                                        <div class="timeline-icon"></div>
                                                                        <div class="timeline-body">
                                                                            <div class="timeline-content">
                                                                                <a href="#/" class="name">Jonathan Smith</a> added <a href="#/" class="name">Frend Pratt</a> and <a href="#/" class="name">Robin Horton</a> to project <a href="#/">Material Design Admin Template</a>
                                                                                <span class="time">6 hours ago</span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <li class="mini-timeline-default">
                                                                        <div class="timeline-body ml-n">
                                                                            <div class="timeline-content">
                                                                                <button type="button" data-loading-text="Loading..." class="loading-example-btn btn btn-sm btn-default">See more</button>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- .tab-content -->
                                </div>
                                <!-- col-sm-8 -->
                            </div>
                        </div>
                        <?php
                        include_once "switcherCode.html";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    include_once "commonPlugin.html";
    ?>

    </body>
    <?php
}
else{
    header("location:logout.php");
}
?>

</html>
