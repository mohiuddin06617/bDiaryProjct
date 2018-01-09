<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<?php
/**
 * Created by PhpStorm.
 * User: Biplob
 * Date: 12/21/2017
 * Time: 5:52 PM
 */
include_once "DbFile/dbconfig.php";
include_once "sessionStartCheck.php";
function getGroupId($conn, $userdId)
{

    $sql = "select id,group_id,userGroupStatus,userStatus from userinfo WHERE id='" . $userdId . "'";
    $res = mysqli_query($conn, $sql);
    $ures = mysqli_fetch_assoc($res);
    $groupId = $ures['group_id'];
    return $groupId;
}

function getManagerId($conn, $groupId)
{

    $mangerIdQuery = "select * from groupdetails where groupdetails.group_id='" . $groupId . "'";
    $mangerIdRes = mysqli_query($conn, $mangerIdQuery);
    $mangerId = mysqli_fetch_assoc($mangerIdRes);

    $manId = $mangerId['manager_id'];
    return $manId;
}

function getSelectedPersonName($conn, $id)
{

    $personNameQuery = "select firstName,lastName from userinfo where userinfo.id='" . $id . "'";
    $personQueryRes = mysqli_query($conn, $personNameQuery);
    $personName = mysqli_fetch_assoc($personQueryRes);
    $man = $personName['firstName'] . " " . $personName['lastName'];
    return $man;
}

$groupId = "";
$groupId = getGroupId($conn, $_SESSION['userID']);
$mId = getManagerId($conn, $groupId);
$query = "select * from shoppingpersonselection where MONTH(selected_date)=MONTH(CURRENT_DATE) and manager_id='" . $mId . "'";
$result = mysqli_query($conn, $query);
echo "<h1 class='text-center text-primary'>Current Month Bazar List</h1>";
if (mysqli_num_rows($result) > 0) {
    echo "<table class=\"table table-bordered\">
    <thead>
      <tr>
        <th>Name</th>
        <th>Selected Date</th>
        
      </tr>
    </thead>
    <tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . getSelectedPersonName($conn, $row['selected_person_id']) . "</td><td>" . $row['selected_date'] . "</td></tr>";
    }
    echo "</tbody></table>";
}
?>