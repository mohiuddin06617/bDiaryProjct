<?php
session_start();
include "DbFile/dbconfig.php";

$searchQuery = intval($_GET['q']);
$sql="SELECT * FROM userinfo WHERE email='$searchQuery' OR email LIKE '%$searchQuery%'";
$result = mysqli_query($conn,$sql);
echo $searchQuery;
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['firstName'] . "</td>";
    echo "<td>" . $row['lastName'] . "</td>";
    echo "</tr>";
}

//mysqli_close($conn);

?>