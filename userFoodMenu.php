<?php
/**
 * Created by PhpStorm.
 * User: Biplob
 * Date: 12/21/2017
 * Time: 5:47 PM
 */
include_once "DbFile/dbconfig.php";
include_once "sessionStartCheck.php";
$group_id="";
$sql = "SELECT group_id FROM userinfo WHERE id='" . $_SESSION['userID'] . "'";
$res =mysqli_query($conn, $sql);
while ($row= mysqli_fetch_assoc($res)){
$group_id = $row['group_id'];
}
$query = "SELECT * FROM foodmenu WHERE group_id='$group_id' and str_to_date(inserted_date,'%d/%m/%Y')=CURRENT_DATE";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["item_name"] . " - Name: " . $row["inserted_date"] . " " . $row["inserted_time"] . "<br>";
    }
} else {
    echo "<h2 class='text-danger'>No Food menu to show</h2>";
}

?>

