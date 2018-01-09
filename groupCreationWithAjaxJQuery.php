
<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 27-Dec-16
 * Time: 7:59 PM
 */
include_once "DbFile/dbconfig.php";
include_once "sessionStartCheck.php";
$groupName=$_POST['groupName'];
$userID=$_SESSION['userID'];


$sql="INSERT into groupdetails (group_name ,manager_id) VALUES ('$groupName','$userID')";

$result= mysqli_query($conn,$sql);
if($result){
    echo "Added Successfully";
}
else{
    echo "Error: ".$sql."<br>".mysqli_error($conn);
}

include_once "DbFile/dbconfig.php";
mysqli_query($conn,"UPDATE userinfo SET userGroupStatus='1',userStatus='1' WHERE id='$userID'");
$group_id=mysqli_fetch_array(mysqli_query($conn,"SELECT group_id from groupdetails WHERE manager_id='$userID'"),MYSQLI_ASSOC);
$gid=$group_id['group_id'];
mysqli_query($conn,"UPDATE userinfo SET group_id='$gid' WHERE id='$userID'");

mysqli_close($conn);
?>

