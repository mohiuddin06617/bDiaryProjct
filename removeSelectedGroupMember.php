<?php
session_start();
include "DbFile/dbconfig.php";

$selected_person_id=mysqli_real_escape_string($conn,$_POST['selected_person_id']);
if(!empty($selected_person_id)){
$deleteGroupMemberQuery="UPDATE userinfo SET userGroupStatus=0,group_id=0 WHERE id='$selected_person_id'";
$executeRemove=mysqli_query($conn,$deleteGroupMemberQuery);
    if(!$executeRemove){
        echo "Not successfully Remove!";
    }
    echo "Removed";
}
?>