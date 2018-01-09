<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<script src="assets/js/jquery.min.js"></script>
<?php
include_once "sessionStartCheck.php";
include_once "DbFile/dbconfig.php";
if (isset($_SESSION['email']) && $_SESSION['userStatus'] == 0) {

    $groupId = "";
    $sql = "select id,group_id,userGroupStatus,userStatus from userinfo WHERE id='" . $_SESSION['userID'] . "'";
    $res = mysqli_query($conn, $sql);
    $ures = mysqli_fetch_assoc($res);
    $groupId = $ures['group_id'];

    //$_SESSION['managerID']=$ures['id'];
    /*echo $ures['id']."<br>";*/
    if ($ures['userGroupStatus'] == 1) {
        $sql2 = "select * from groupdetails,groupOtherDetails 
                where groupdetails.group_id='$groupId' and groupOtherDetails.group_id=groupdetails.group_id";
        $result = mysqli_query($conn, $sql2);
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['group_name'];
        }
    } else {
        echo "<h3 class='text-info text-center'>You are not a member fo any group</h3>";
        echo "";
        include_once "groupCreation.html";

    }
}
?>