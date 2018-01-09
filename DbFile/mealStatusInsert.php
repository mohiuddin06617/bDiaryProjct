<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 12/26/2016
 * Time: 6:56 PM
 */
session_start();
require('dbconfig.php');
$answer=$_POST['answer'];

$email= $_SESSION['email'];

date_default_timezone_set("Asia/Dhaka");
$hours=date("G");
$time='';
if($hours>=8 && $hours<=14){
    $time="Lunch";
}
else if($hours>=21 && $hours<=8){
    $time="Breakfast";
}
else if($hours>=15 && $hours<=21) {
    $time = "Dinner";

}


$sql="INSERT INTO mealstatus(email,answer,mealtime)
VALUES('$email','$answer','$time')";

$result=mysqli_query($conn,$sql);
if($result){
    echo "Added Successfully";
}
else{
     echo "Error: ".$sql."<br>".mysqli_error($conn);
}
mysqli_close($conn);

echo $answer."<br>";
echo $email."<br>";
echo $time;
?>