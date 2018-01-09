<?php
include_once "sessionStartCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <noscript>
        <meta http-equiv="refresh" content="0;url=nojsSignin.php">
    </noscript>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/signin.css">
    <link rel="stylesheet" type="text/css" href="Resource/form_buttonDesign.css">
</head>
<body>

<!--<form method="post" action="" name="singinForm">
    <table align="center">
        <tr>
            <td><label for="email">Enter Email:</label></td>
            <td><input type="text" id="email" name="email" onblur="email_validation()" class="form-control"></td>
            <td><span id="emailError"></span></td>
        </tr>
        <tr>
            <td><label for="password">Enter Your Password:</label></td>
            <td><input type="password" id="password" name="password" onblur="password_validation()"
                       class="form-control"></td>
            <td><p id="passwordError"></p></td>
        </tr>
        <tr>
            <td><input type="checkbox" id="rememberMe" name="rememberMe" value="remember">Remeber Me</td>
            <td>Not a Member?<br><a href="signup.php"><b>Register</b></a></td>
        </tr>
        <tr>
            <td>
                <center><input type="submit" name="submitLogin" class="button" value="Login">
            <td><a href="index.html" class="mediumButton">Back to home</a></td>
            </center></td>
        </tr>
    </table>

</form>-->

<div class="container">
    <?php
    if (isset($_SESSION['registration_success'])){
        echo $_SESSION['registration_success'];
    }
    ?>
    <form class="form-signin" method="post" name="singinForm">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="email" class="control-label">Enter Email Address:</label>
        <input type="email" id="email" name="email" onblur="email_validation()" class="form-control"
               placeholder="Email address" autofocus>
        <p id="emailError"></p>
        <label for="password" class="control-label">Enter Your Password:</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password"
               onblur="password_validation()"
               class="form-control">
        <p id="passwordError"></p>
        <div class="siginUp">
            <label>
                Not a Member ?
                <a class="btn btn-link btn-lg" href="signup.php">Sign Up</a>
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitLogin">Sign in</button>
    </form>
</div>


<?php
require('DbFile/dbconfig.php');

/*if ((!empty($_COOKIE['cookieEmail'])) && !empty($_COOKIE['cookiePassword'])) {
    echo $row['userStatus'];
    if ($row['userStatus'] == 1) {
        header("Location:managerHome.php");

    } elseif ($row['userStatus'] == 0) {
        header("location:userHome.php");
    }
}*/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submitLogin'])) {
        $emailLogin = $_POST['email'];
        $passwordLogin = md5($_POST['password']);
        $sql = "select *from userinfo WHERE email='$emailLogin' AND password='$passwordLogin'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $_SESSION['email'] = $row['email'];

            $cookieEmail = $row['email'];
            $cookiePassword = $row['password'];
            $cookieName = $row['firstName'] . $row['lastName'];
            if ($row['userStatus'] == 1) {
                $_SESSION['userStatus'] = 1;
                $_SESSION['managerID'] = $row['id'];
                $_SESSION['email']=$emailLogin;
                if (isset($_POST['rememberMe'])) {
                    setcookie('cookieEmail', $cookieEmail);
                    setcookie('cookiePassword', $cookiePassword);
                    header("Location:managerHome.php");
                } else {
                    header("Location:managerHome.php");
                }
            } else if ($row['userStatus'] == 0) {
                $_SESSION['userStatus'] = 0;
                $_SESSION['userID'] = $row['id'];
                $_SESSION['email']=$row['email'];
                if (isset($_POST['rememberMe'])) {
                    setcookie('cookieEmail', $cookieEmail);
                    setcookie('cookiePassword', $cookiePassword);
                    header("Location:userHome.php");
                } else {
                    header("Location:userHome.php");
                }
            } else {
                header("location:login.php");
            }
        } else {
            echo "<h3 class='jumbotron text-center'>Login Not successful</h3>";
        }
    }

}
//var_dump($_COOKIE);
//var_dump($_SESSION);

?>


<script src="formValidation.js"></script>
</body>
</html>