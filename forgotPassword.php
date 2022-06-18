<?php
/**
 * Created by PhpStorm.
 * User: Mohiuddin
 * Date: 7/24/2017
 * Time: 12:53 PM
 */
?>
<!DOCTYPE html>
<html lang="en" class="coming-soon">
<head>
    <meta charset="utf-8">
    <title>Reset Password | bDiary</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">

    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600' rel='stylesheet' type='text/css'>
    <link type="text/css" href="assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">
    <link type="text/css" href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" href="assets/css/styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
    <link type="text/css" href="assets/css/ie8.css" rel="stylesheet">
    <![endif]-->

    <!-- The following CSS are included as plugins and can be removed if unused-->
<style>
    .boxShadowing{
        box-shadow: 10px 10px 15px rgba(75, 88, 81, 0.78);
    }
</style>
</head>

<body class="focused-form animated-content">


<div class="container" id="forgotpassword-form">
    <a href="signin.php" class="login-logo"><img src="assets/img/logo.png"></a>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default boxShadowing">
                <div class="panel-heading">
                    <h1 class="text-center black-text-color"><strong>Password Reset</strong></h1>
                </div>
                <div class="panel-body">
                    <form action="<?=$_SERVER['PHP_SELF']?>" class="form-horizontal" method="post">
                        <div class="form-group mb-n">
                            <div class="col-xs-12">
                                <h3 class="text-center text-gray black-text-color">Enter your email below to reset your password</h3>
                                <div class="input-group">
									<span class="input-group-addon">
										<i class="fa fa-user-circle fa-2x"></i>
									</span>
                                    <input type="email" class="form-control input-lg email black-text-color" name="email" placeholder="Enter Your Email Address Here" id="emailAddressInput" onblur="email_validation()" required>
                                    <span class="text-danger" id="emailError" style="font-size: larger;"></span>
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <button href="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" type="submit" class="btn btn-primary pull-right btn-lg btn-block">Reset</button>
                    </form>
                </div>
                <div class="panel-footer">
                    <div class="clearfix">
                        <a href="signin.php" class="btn btn-info-alt pull-left btn-block ">Back To Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Load site level scripts -->

<script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script> 							<!-- Load jQuery -->
<script type="text/javascript" src="assets/js/jqueryui-1.10.3.min.js"></script> 							<!-- Load jQueryUI -->
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script type="text/javascript" src="assets/js/enquire.min.js"></script> 									<!-- Load Enquire -->
<script type="text/javascript" src="forgotPassword.js"></script>

<script type="text/javascript" src="assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
<script type="text/javascript" src="assets/plugins/velocityjs/velocity.ui.min.js"></script>

<script type="text/javascript" src="assets/plugins/wijets/wijets.js"></script>     						<!-- Wijet -->

<script type="text/javascript" src="assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->
<script type="text/javascript" src="assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->

<script type="text/javascript" src="assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

<script type="text/javascript" src="assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script type="text/javascript" src="assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->

<script type="text/javascript" src="assets/js/application.js"></script>
<script type="text/javascript" src="assets/demo/demo.js"></script>
<script type="text/javascript" src="assets/demo/demo-switcher.js"></script>

<!-- End loading site level scripts -->
<!-- Load page level scripts-->

<!-- End loading page level scripts-->
</body>
</html>
