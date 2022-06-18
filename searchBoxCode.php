<?php
session_start();
include "DbFile/dbconfig.php";
$searchQuery = $_POST['searchQuery'];
$sql="SELECT * FROM userinfo WHERE email='$searchQuery' /*OR email LIKE '%$searchQuery%'*/";
$result = mysqli_query($conn,$sql);
$found=mysqli_num_rows($result);
if($found!=0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><a href='profile.php'> " . $row['firstName'] . " " . $row['lastName'] . "</a><br></td>";
        $_SESSION['gettingID']=$row['id'];
        if($_SESSION['gettingID']!=$row['id']){
            $_SESSION['gettingID']=$row['id'];
        }
        else{
            $_SESSION['gettingID']=$row['id'];
        }
        echo "<td>" . "</td>";
        echo "</tr>";
    }
}
else{
    echo "None";
}

//mysqli_close($conn);

?>