<!DOCTYPE html>
<html>
<head>
    <title>Search Box in action</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>


</body>
</html>

<?php

session_start();
if($_SESSION['email']) {
    require('DbFile/dbconfig.php');
    $searchQuery = $_POST['searchQuery'];
    $query = "SELECT * FROM userinfo WHERE email='$searchQuery' OR email LIKE '%$searchQuery%'";
    $result = mysqli_query($conn, $query);
//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    $found = mysqli_num_rows($result);
    $currentSessionEmail = $_SESSION['email'];
    if ($found > 0) {
        while ($row = mysqli_fetch_array($result))
        {
            echo "

<div class='row'> 
<div class='col-lg-12 col-md-12 col-md-12 col-xs-12 media-body'>
<a href='userProfile.php'><p style='color: black;background-color: navajowhite;'>" . $row['firstName'] . " " . $row['lastName'] . "</p></a>
</div>
</div>";

              //Show the profile in answer

          /*    require_once("profile.php");
            $groupObj=new group();
           $groupObj->profile($row['id']);*/

            if ($_SESSION['gettingID'] == $row['id']) {
                $_SESSION['gettingID'] = $row['id'];
            } else {
                $_SESSION['gettingID'] = $row['id'];
            }
        }
    } else {
        echo "<span style='color: black;background-color:oldlace; '>None</span>";
    }
}
else{
    header("location:logout.php");
}
?>
