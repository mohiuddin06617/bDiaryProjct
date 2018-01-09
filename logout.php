<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 12/21/2016
 * Time: 1:33 PM
 */
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['managerID'])){
session_destroy();
unset($_SESSION['email']);
unset($_SESSION['managerID']);

    setcookie("cookieEmail", "", time()-1);
    setcookie("cookiePassword", "", time()-1);
header("location:signin.php");

    }
else{
    setcookie("cookieEmail", "", time()-1);
    setcookie("cookiePassword", "", time()-1);
header("Location:signin.php");
session_destroy();
unset($_SESSION['email']);
    unset($_SESSION['managerID']);


}
?>