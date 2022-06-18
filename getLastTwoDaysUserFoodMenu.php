<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 1/12/2017
 * Time: 3:46 PM
 */
require "DbFile/dbconfig.php";
session_start();
/*echo "<b>Manager Email is: </b>".$_SESSION['email']."<br>";*/
echo "Last Two days User Food Menu";
$email=$_SESSION['email'];
$mId=$_SESSION['managerID'];


?>
</body>
</html>
