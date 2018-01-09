<?php

include_once "DbFile/dbconfig.php";
include_once "sessionStartCheck.php";

if (isset($_POST['addToGroupId'])){
    $query="UPDATE userinfo SET userinfo.group_id='".$_SESSION['groupID']."',userGroupStatus=1 where id='".$_POST['addToGroupId']."'";
    $result=mysqli_query($conn,$query);
    if ($result){
        echo "Added To Group";
    }
}
?>