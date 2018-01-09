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
require('DbFile/dbconfig.php');
$searchQuery=$_POST['searchQuery'];
$query="SELECT * FROM userinfo WHERE email='$searchQuery' OR email LIKE '%$searchQuery%'";
$result=mysqli_query($conn,$query);
//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$count=mysqli_num_rows($result);
$found=mysqli_num_rows($result);
$currentSessionEmail=$_SESSION['email'];
if($found>0){
    while($row=mysqli_fetch_array($result)){
        echo "<p><a href='profile.php'>".$row['firstName']." ".$row['lastName']."</a></p>";
        require_once("profile.php");
        $groupObj=new group();
        $_SESSION['gettingID']=$row['id'];
       $groupObj->profile($row['id']/*,$row['email'],$row['firstName'],
            $row['lastName'],$row['phoneNumber'],$row['userGroupStatus'],$row['userStatus']*/);
    }
}else{
    echo "None";
}

?>
