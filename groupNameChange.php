<!DOCTYPE html>
<html>
<head>

</head>
<body>
<?php
$changedGroupName="";
session_start();
if(!empty($_SESSION['email']) && !empty($_SESSION['managerID']) && $_SESSION['managerID']!=0){
require "DbFile/dbconfig.php";
$sum = $_SESSION['email'];
$groupNameGettingQuery="SELECT group_name from groupdetails WHERE manager_id='".$_SESSION['managerID']."'";
$resultGettingGroupName=mysqli_fetch_array(mysqli_query($conn,$groupNameGettingQuery),MYSQLI_ASSOC);
$groupName=$resultGettingGroupName['group_name'];
?>
<div id="cgname">
    <form method="POST" role="form">
       Group Name: <input type="text" name="changedGroupName" id="changedGroupName" value="<?= $groupName ?>"/>

    <input type="button" id="save" name="saveChangedGroupName" value="Save"/>

    <input type="submit" id="cancel" value="Cancel">

    </form>

  </div>
<?php



echo '<div id="updatedGroupName"></div>';


?>

<script type="text/javascript">
$(document).ready(function () {

   $('#cancel').click(function(e){
        e.preventDefault();
        window.location.href = 'groupDetailsManager.php';

        // prevent default behavior of button
        return false;
    });
    $('#save').click(function(e) {
        e.preventDefault();
        var updatedGroupname=$("#changedGroupName").val();
        $("#cgname").hide();
        var uGN=$(document).find('#updatedGroupName');
        $.ajax({
            type: 'POST',
            url: 'groupNameUpdate.php',
            data:"updatedGroupname="+updatedGroupname,
            success: function (data) {
                $(uGN).html(data);
            }
        });
    });
});
</script>
</body>
</html>

<?php

/**
 * Created by PhpStorm.
 * User: rian
 * Date: 1/7/2017
 * Time: 8:58 PM
 */
//if($_SERVER['REQUEST_METHOD']=="POST") {
////    if ($_POST['saveChangedGroupName']) {
//        $changedGroupName = $_POST['changedGroupName'];
//        echo $changedGroupName;
//
//    }
}
?>