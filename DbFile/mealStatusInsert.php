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
$getUserId="SELECT id from userinfo WHERE email='".$_SESSION['email']."'";
$idResult=mysqli_fetch_array(mysqli_query($conn,$getUserId));
$id=$idResult['id'];

$getMealStatusQuery="SELECT *from mealstatus WHERE user_id='$id' ";
$mealStatusResult=mysqli_fetch_array(mysqli_query($conn,$getMealStatusQuery));

$mysqldate=$mealStatusResult['mealentrytime'];
$phpdate = strtotime( $mysqldate );
$mysqldate = date( 'Y-m-d', $phpdate );

echo $mysqldate."<br>";

$todaysDate= date("Y-m-d G:i:sa");
if($todaysDate===$mysqldate && $mealStatusResult['mealtime']==$time && empty($mealStatusResult['answer'])){



    $sql="INSERT INTO mealstatus(user_id,answer,mealtime)
          VALUES('$id','$answer','$time')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "Added Successfully";
        }
    else{
        echo "Error: ".$sql."<br>".mysqli_error($conn);
       }

}
else{
    echo "You have already entered your meal status and your answer is
     ".$mealStatusResult['answer']." for ".$mealStatusResult['mealtime']."<br>Would you like to change Meal Status?";
}


mysqli_close($conn);

?>