<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 4/9/2017
 * Time: 7:55 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>bDiary</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--    <link rel="stylesheet" href="<?php /*echo base_url();*/?>assets/fonts/font-awesome/css/font-awesome.min.css">
-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script

    <!-- jQuery UI CDN -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <script src="https://use.fontawesome.com/13d35ceee2.js"></script>

  <!--  <script src="<?/*=base_url();*/?>assets/js/custom.js"></script>-->

</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="userHomePractice.php">Bachelor's Diary</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <form class="navbar-form navbar-left">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">HTML</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">JavaScript</a></li>
                    </ul>
                </li>

                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class=""><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                <li class=""><a href="userHomePractice.php">Home</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="page-content">
    <div class="row">
        <div class="col-md-2">
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav" id="dashboard">
                    <!-- Main menu -->

                    <li class="nav-header"><a href="userMeal.php" target="iframe_user_all"><i class="glyphicon glyphicon-home"></i>Confirm Your Meal?</a></li>
                    <li class="nav-header"><a href="userShoppingCost.php" target="iframe_user_all"><i class="fa fa-bars" aria-hidden="true"></i> Enter Today's Shopping Cost</a></li>
                    <li class="nav-header"><a href="userFoodMenu.php" target="iframe_user_all"><i class="fa fa-usd" aria-hidden="true"></i> Today's Food Menu</a></li>
                    <li class="nav-header"><a href="showShoppingDateToUser.php" target="iframe_user_all"><i class="fa fa-usd" aria-hidden="true"></i>Show Shopping Date</a></li>
                    <li class="nav-header"><a href="whatsnew.php" target="iframe_user_all"><i class="fa fa-shopping-basket"></i> Group Details</a></li>
                    <li class="nav-header"><a href="profileForUser.php" target="iframe_user_all"><i class="glyphicon glyphicon-pencil"></i>Your Profile</a>
                    </li>
                    <li class="submenu">
                        <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Settings
                            <span class="caret pull-right"></span>
                        </a>
                        <!-- Sub menu -->
                        <ul>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="signup.html">Signup</a></li>
                        </ul>
                    </li>
                    <li class="nav-header"><a href="forms.html"><i class="glyphicon glyphicon-tasks"></i> Log Out</a></li>

                </ul>
            </div>
        </div>
        <div class="content-wrapper">
            <iframe style="position: absolute;border: 0;" height="100%" width="90%" src="userStatus.php" name="iframe_user_all"></iframe>
        </div>

        <!--<div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Bazar Entry Status</b>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">

                            <a href="#" class="list-group-item">
                                <span class="badge">7 minutes ago</span>
                                <i class="fa fa-fw fa-comment"></i> Commented on a post
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">16 minutes ago</span>
                                <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">36 minutes ago</span>
                                <i class="fa fa-fw fa-globe"></i> Invoice 653 has paid
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">1 hour ago</span>
                                <i class="fa fa-fw fa-user"></i> A new user has been added
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">1.23 hour ago</span>
                                <i class="fa fa-fw fa-user"></i> A new user has added
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">yesterday</span>
                                <i class="fa fa-fw fa-globe"></i> Saved the world
                            </a>
                        </div>
                        <div class="text-right">
                            <a href="#">More Tasks <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>-->


            </div>


