<!DOCTYPE html>
    <html>
<head>

        <?php
        session_start();
        if(!empty($_SESSION['email'])){
        $email=$_SESSION['email'];
        include "DbFile/dbconfig.php";
        $row=mysqli_fetch_array(mysqli_query($conn,"SELECT * from userinfo where email='$email'"),MYSQLI_ASSOC);
        echo "<title>".$row['firstName']."s Profile</title>";
        ?>

    <link rel="stylesheet" type="text/css" href="Resource/form_buttonDesign.css">
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 03-Jan-17
 * Time: 1:01 PM
 */


    echo "<table align='center' border='1' style='font-size: 150%'>
        <th style='text-align: center;' colspan='2'>Your Profile</th>
            <tr>
                <td>Name:</td><td>".$row['firstName']." ".$row['lastName']."</td>
            </tr>
            <tr>
            <td>Email:</td><td>".$row['email']."</td>
             </tr>
             <tr>
             <td>Password: </td><td>As Specified</td>
             </tr>
             <tr colspan='2'>
             <td></td>
             <td><button type='mediumButton' class='button'>Change Password</button></td>
             </tr>

             <tr>
             <td>Phone Number:</td><td>".$row['phoneNumber']."</td>
             </tr>
             <tr>
             <td>Account is active since : </td><td>".$row['accountCreationDate']."</td>
             </tr>";
$groupName=mysqli_fetch_array(mysqli_query($conn,"SELECT group_name,manager_id from groupdetails WHERE group_id='".$row['group_id']."'"),MYSQLI_ASSOC);
                if($row['userStatus']==1 && $row['userGroupStatus']==1) {
                    echo "<tr><td>You Group Stat:</td><td>Manager</td></tr>";
                    echo "<tr><td>You Group Name:</td><td>".$groupName['group_name']."</td></tr>";
                }
                else{
                    if($row['userGroupStatus']==1){
                        echo "<tr><td>You Group Stat:</td></td><td>User</td></tr>";
                    }
                    else{
                        echo "<tr><td>You Group Stat:</td></td><td>Currently Not a memeber of group!</td></tr>";
                    }

                }
?>

<?php
}
else{


}
?>
</body>
</html>

