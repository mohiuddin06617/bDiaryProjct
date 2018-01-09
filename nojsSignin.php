<?php
$emailLogin=$passwordLogin=" ";
$emailError=$passwordError="";
$emailBool=$passwordBool=false;



if($_SERVER['REQUEST_METHOD']=="POST") {
    $emailLogin = $_POST['email'];
    $passwordLogin = md5($_POST['password']);
    if (!empty($emailLogin)) {
        if (filter_var($emailLogin, FILTER_VALIDATE_EMAIL)) {
            $emailBool=true;
        } else {
            $emailError = " *Email Not properly validated";
        }
    } else {
        $emailError = "*Email can not be empty" . "<br>";
    }

if(!empty($passwordLogin)) {
    if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z._-]{7,15}$/', $passwordLogin)) {
        $passwordError='the password does not meet the requirements!<br>';
    } else {
        //echo "Password is secured and password: " . $password."<br>";
        $passwordBool=true;
    }
}
else{
    $passwordError="*Password can not be empty";
}

if($emailBool==true && $passwordBool==true){
    require 'DbFile/dbconfig.php';
    $sql="SELECT * from userinfo WHERE email='$emailLogin' AND password='$passwordLogin'";
    $res=mysqli_query($conn,$sql);
    $result=mysqli_fetch_array($res,MYSQLI_ASSOC);
    session_start();
    if(count($res)==1) {
        if ($result['userStatus'] == 1) {
            header("Location:managerHome.php");
            $_SESSION['email'] = $emailLogin;
        } else if ($result['userStatus'] == 0) {
            header("Location:userHome.php");
            $_SESSION['email'] = $emailLogin;
        }
    }
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Sign in</title>
</head>
<body>
<form method="post" action="" name="singinForm">
    <table align="center">
        <tr>
            <td><label for="email">Enter Email:</label></td>
            <td><input type="text" id="email" name="email" "></td>
            <td><?= $emailError?></td>
        </tr>
        <tr>
            <td><label for="password">Enter Your Password:</label></td>
            <td><input type="text" id="password" name="password"></td>
            <td><?= $passwordError?></td>
        </tr>
        <tr>
            <td><input type="checkbox" id="rememberPassword" name="rememberPassword" value="remember">Remeber Me</td><td>Not a Member?<br><a href="signup.php"><b>Register</b></a></td>
        </tr>
        <tr>
            <td><input type="submit" name="submitLogin"></td>
        </tr>
    </table>

<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 28-Dec-16
 * Time: 7:32 AM
 */
?>
</body>
</html>
