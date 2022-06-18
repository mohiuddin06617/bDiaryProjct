<?php
require "DbFile/dbconfig.php";
session_start();
$updatedGroupName=mysqli_real_escape_string($conn,$_POST['updatedGroupname']);
$updateGrNaQuery="UPDATE groupDetails SET group_name='$updatedGroupName' WHERE manager_id='".$_SESSION['managerID']."'";
mysqli_query($conn,$updateGrNaQuery);

$getGroupName="SELECT group_name from groupdetails WHERE manager_id='".$_SESSION['managerID']."'";
$upadtedGN=mysqli_fetch_array(mysqli_query($conn,$getGroupName),MYSQLI_ASSOC);
echo $upadtedGN['group_name'];

?>