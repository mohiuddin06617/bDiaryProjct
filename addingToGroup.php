<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 27-Dec-16
 * Time: 5:32 PM
 */
session_start();
$email=$_SESSION["email"];
$idExtra=$_SESSION["gettingID"];
$managerID=$_SESSION['managerID'];
require 'DbFile/dbconfig.php';
$sqlCheckMemberGroupInfo="SELECT *from userinfo WHERE id='$idExtra'";
$resultCheckMemberGroupInfo=mysqli_fetch_array(mysqli_query($conn,$sqlCheckMemberGroupInfo),MYSQLI_ASSOC);
 $resultMemberId=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM groupdetails WHERE manager_id='$managerID'"),MYSQLI_ASSOC);
// echo $resultCheckMemberGroupInfo['userGroupStatus'];
 $groupID=$resultMemberId['group_id'];
//echo  $groupID;
if($resultCheckMemberGroupInfo['userGroupStatus']==0){
    mysqli_query($conn,"UPDATE userinfo SET userGroupStatus='1',group_id='$groupID' WHERE userinfo.id='$idExtra'");
    echo "Successfuly Added to Your Group";
//mysqli_query($conn,"UPDATE groupdetails SET  member_id1='$idExtra'");
}
else if($resultCheckMemberGroupInfo['userGroupStatus']==1){

    echo "Already a member of a group!Add another person";

}


//Practice to get last row value and insert database table column dynamically
/*$sql = "SHOW COLUMNS FROM groupdetails";
$result = mysqli_query($conn,$sql);
$value=array();
while($row = mysqli_fetch_array($result)){

        $value = $row['Field'] . "<br>";
echo $value;
}
//echo $value;
//echo $resultMemberId["'$value'"];
//if($resultMemberId[$value]!=0){

//}
$sql2="SELECT 
COLUMN_NAME,
ORDINAL_POSITION
FROM information_schema.COLUMNS 
WHERE TABLE_SCHEMA = 'bDiary'
AND TABLE_NAME ='groupdetails'
ORDER BY ORDINAL_POSITION DESC 
LIMIT 1";                                                       //GETTING the last column name
$result2=mysqli_fetch_array(mysqli_query($conn,$sql2));
echo $result2[0]."<br>";
$lastColumnLength=strlen($result2[0])-1;
$lastColumnNameValue=$result2[0][$lastColumnLength];
echo $lastColumnNameValue;
echo $result2[1];

/*if($lastColumnNameValue==1){
    $addingCloumnDynamically="ALTER TABLE groupdetails
                          ADD member_id2 INT";
    mysqli_query($conn,$addingCloumnDynamically);
}
else if($lastColumnNameValue==2){
    $addingCloumnDynamically="ALTER TABLE groupdetails
                          ADD member_id3 INT";
   mysqli_multi_query($conn,$addingCloumnDynamically);
}
else if($lastColumnLength==3){
    $addingCloumnDynamically="ALTER TABLE groupdetails
                          ADD member_id4 INT";
    mysqli_query($conn,$addingCloumnDynamically);
}
else if($lastColumnLength==4){
    $addingCloumnDynamically="ALTER TABLE groupdetails
                          ADD member_id5 INT";
    mysqli_query($conn,$addingCloumnDynamically);
}
else if($lastColumnLength==5){
    $addingCloumnDynamically="ALTER TABLE groupdetails
                          ADD member_id6=0 INT(11)";
    mysqli_query($conn,$addingCloumnDynamically);
}
else if($lastColumnLength==6){
    $addingCloumnDynamically="ALTER TABLE groupdetails
                          ADD member_id7=0 INT(11)";
    mysqli_query($conn,$addingCloumnDynamically);
}
else if($lastColumnLength==7){
    $addingCloumnDynamically="ALTER TABLE groupdetails
                          ADD member_id8 INT";
    mysqli_query($conn,$addingCloumnDynamically);
}
else if($lastColumnLength==8){
    $addingCloumnDynamically="ALTER TABLE groupdetails
                          ADD member_id9 INT(11) SET DEFAULT 0";
    mysqli_query($conn,$addingCloumnDynamically);
}
else if($lastColumnNameValue==5){

}
*/

?>