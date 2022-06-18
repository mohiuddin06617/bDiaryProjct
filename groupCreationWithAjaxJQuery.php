
<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 27-Dec-16
 * Time: 7:59 PM
 */
require_once "DbFile/dbconfig.php";
session_start();
$groupName=$_POST['groupName'];
$managerID=$_SESSION['managerID'];
echo $managerID=$_SESSION['managerID'];

$sql="INSERT into groupdetails (group_name ,manager_id) VALUES ('$groupName','$managerID')";

$result= mysqli_query($conn,$sql);
if($result){
    echo "Added Successfully";
}
else{
    echo "Error: ".$sql."<br>".mysqli_error($conn);
}

//$updateResult=mysqli_query($conn,$updateQuery);
mysqli_close($conn);
?>
<?php
require "DbFile/dbconfig.php";
mysqli_query($conn,"UPDATE userinfo SET userGroupStatus='1',userStatus='1' WHERE id='$managerID'");
$group_id=mysqli_fetch_array(mysqli_query($conn,"SELECT group_id from groupdetails WHERE manager_id='$managerID'"),MYSQLI_ASSOC);
$gid=$group_id['group_id'];
mysqli_query($conn,"UPDATE userinfo SET group_id='$gid' WHERE id='$managerID'");
mysqli_close($conn);
?>

