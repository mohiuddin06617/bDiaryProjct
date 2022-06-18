<?php
include_once "sessionStartCheck.php";

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    if (isset($_SESSION['managerID']) && !empty($_SESSION['managerID'])) {
        header("location:managerHome.php");
    } elseif (isset($_SESSION['userID']) && !empty($_SESSION['userID'])) {
        if (isset($_SESSION['userID']) && $_SESSION['userStatus'] === 0 && isset($_SESSION['groupID'])) {
            header("location:userHome.php");
        } elseif (isset($_SESSION['userID']) && $_SESSION['userStatus'] === 0 && !isset($_SESSION['groupID'])) {
            header("location:userHome.php");
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once "signinAuth.php";
    $signinAuth = new signinAuth();
    $emailLoginBool=false;
    $passwordLoginBool=false;
    $emailLogin = $signinAuth->sanitize_email($_POST['email']);
    $passwordLogin=$_POST['password'];
    $emailLoginBool = $signinAuth->validate_email($_POST['email']);
    $passwordLoginBool = $signinAuth->check_password_validation($_POST['password']);

    if ((!isset($_SESSION['managerID']) && empty($_SESSION['managerID'])) || (!isset($_SESSION['userID']) && empty($_SESSION['userID']))) {
        if ($emailLoginBool && $passwordLoginBool) {
            if ($signinAuth->check_db_credintial($emailLogin,$passwordLogin)){
                $signinAuth->url_forwarding($emailLogin, $passwordLogin);
            }
            else{
                echo "<div class='row'>
                        <div class='col-lg-4'></div>
                        <div class='well col-lg-4'>
                           <h3 class='text-center text-danger'>Incorrect Email or Password</h3>
                        </div>
                        <div class='col-lg-4'></div>
                      </div>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign in to bDairy</title>
    <noscript>
        <style>
            html {
                display: none;
            }
        </style>
        <meta http-equiv="refresh" content="0.0;url=nojsSignin.php">
    </noscript>
    <link rel="stylesheet" type="text/css" href="Resource/form_buttonDesign.css">
    <link rel="stylesheet" type="text/css" href="css/signin.css">
    <link rel="stylesheet" type="text/css" href="Resource/indexDesign.css">
    <link rel="stylesheet" type="text/css" href="assets/css/buttonDesign.css">
    <link rel="stylesheet" type="text/css" href="assets/css/checkboxStyle.css">

    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">


    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">


    <style>

        #bg {
            width: 100%;
            height: 100%;
        }

        #bg img {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            min-width: 80%;
            min-height: 80%;
        }

    </style>


</head>
<body>

<?php
/*include('DbFile/oodbconfig.php');*/


?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="loginResult"></div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="loginDiv">
            <?php

            if (!isset($_SESSION['count'])) {
                $_SESSION['count'] = 1;
            } else {
                $_SESSION['count']++;
            }

            if(isset($_SESSION['registration_success'])){
                if ($_SESSION['count']==1) {
                    echo $_SESSION['registration_success'];
                }
                else{
                    unset($_SESSION['registration_success']);
                    unset($_SESSION['count']);
                }
            }
            ?>
            <form class="form-signin" action="<?= $_SERVER['PHP_SELF']; ?>" method="post" name="singinForm">
                <h2 class="form-signin-heading">Please sign in to your account</h2>
                <label for="email" class="sr-only">Email address</label>
                <input type="email" id="email" name="email" onblur="email_validation()" class="form-control"
                       placeholder="Email address" required autofocus>
                <span id="emailError"></span>
                <br><br>
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password" onblur="password_validation()" class="form-control"
                       placeholder="Enter Your Password" required>
                <span id="passwordError"></span>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="rememberMe" value="remember-me"> Remember me
                    </label>
                </div>
                <div class="pull-right">
                    <label>
                        <a href="forgotPassword.php">Forgot Your Password ?</a>
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-getting" name="login" type="submit"
                        id="loginSubmit">Sign in
                </button>
            </form>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <!--<div class="col-lg-3 col-md-4 col-sm-2 col-xs-2"></div>
                    <div class="col-lg-6 col-md-4 col-sm-6 col-xs-6">-->
                    <div class="col-lg-offset-3">
                        <h3 class="text-left">Click Below To</h3>
                        <a class="btn btn-info btn-lg btn-getting" href="index.html" role="button">
                            <i class="fa fa-arrow-left"></i> Go Home</a>
                    </div>
                    <!--</div>
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4"></div>-->
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <!--<div class="col-lg-2 col-md-4 col-sm-2 col-xs-2"></div>
                    <div class="col-lg-8 col-md-4 col-sm-6 col-xs-6">-->
                    <div class="col-lg-offset-3">
                        <h3 class="text-left">No a User Yet?</h3>
                        <a class="btn btn-info btn-lg btn-getting" href="signup.php" role="button">
                            Create Account <i class="fa fa-arrow-right"></i></a>
                    </div>
                    <!--</div>
                    <div class="col-lg-8 col-md-4 col-sm-4 col-xs-4"></div>-->
                </div>

            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <a href="#">
                        <button class="button btn-getting" style="background-color: #0a377e !important;">
                            <i class="fa fa-facebook-official fa-lg"></i>
                            <span> Login With Facebook </span>
                        </button>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <a href="">
                        <button class=" button btn-getting" style="background-color: #3cba54 !important;">
                            <i class="fa fa-google fa-lg"></i>
                            <span>Login With Google</span>
                        </button>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <a href="#">
                        <button class="button btn-getting" style="background-color: #651CFF !important;">
                            <i class="fa fa-instagram fa-lg"></i>
                            <span>Login With Instagram </span>
                        </button>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <a href="#">
                        <button class="button btn-getting" style="background-color: #00e5ff !important;">
                            <i class="fa fa-twitter-square fa-lg"></i>
                            <span>Login With Twitter </span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

   <script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>-->
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="formValidation.js"></script>

</body>
</html>