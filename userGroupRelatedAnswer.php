<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 28-Dec-16
 * Time: 10:57 AM
 */
session_start();
$answer=$_POST['answer'];
$requiredEmail=$_SESSION['email'];

require_once 'DbFile/dbconfig.php';
echo "Answer is: "." ".$answer;
if($answer=='no') {
echo "You have successfully unsubscribed from blife";
}

if($answer=='no'){
    $sql="UPDATE userinfo SET userGroupStatus='0',group_id='0' WHERE email='$requiredEmail'";
    mysqli_query($conn,$sql);
echo "Successfully Removed";
}
else if($answer=='yes'){
    $sql="UPDATE userinfo SET userGroupStatus='1',group_id='6' WHERE email='$requiredEmail'";
    mysqli_query($conn,$sql);
    echo "SUCCESSFUlly Added";
}

?>