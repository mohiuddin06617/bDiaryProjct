<?php
/**
 * Created by PhpStorm.
 * User: p9
 * Date: 03-Jan-17
 * Time: 11:20 AM
 */

/*
 * JQURY DYNAMIC INPUT
 * <label for="quantity1">Quantity Item<span class="box-number">1</span></label>
                        <input type="text" name="quantities[]" value="" id="quantity1" class="itemName2"/>
                        <br>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;


var box_html = $('<p class="text-box"><label for="item' + n + '">Item <span class="box-number">' + n +
    '</span></label> <input type="text" name="items[]" value="" id="item' + n + '" class="itemName2" />' +
    '<label for="quantity'+ n +'">Quantity Item<span class="box-number">'+ n +'</span></label>'+
    '<input type="text" name="quantities[]" value="" id="quantity'+ n +'" class="itemName2"><br>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;'+
    '<label for="price'+ n +'">Price <span class="box-number">' + n + '</span></label>' +
    '<input type="text" name="prices[]" value="" id="price' + n + '" class="itemName2"/>' +
    '<a href="#" class="remove-box">Remove</a></p>');
*/


include_once "sessionStartCheck.php";

require "DbFile/dbconfig.php";
echo $_SESSION['email'];
//echo count($_POST['field_name']);

if (!empty($_POST['sendForApproval'])) {
    echo "No of Item:" . count($_POST['items']) . "<br>";
    //echo count($_POST['prices'])."<br>";
    $itemCount = count($_POST['items']);
    $itemNameList = array();
    $itemPriceList = array();
    $dateForUserDailyCost = $_POST['dateforuserdailycost'];
    echo $dateForUserDailyCost;
    /*$allItemName = array();
    $allItemValue = array();
    for ($i = 0; $i < $itemCount; $i++) {
        array_push($allItemName, $_POST['items'][$i]);
    }
    for ($i = 0; $i < $itemCount; $i++) {
        array_push($allItemValue, $_POST['prices'][$i]);
    }
    foreach ($allItemName as $name) {
        echo "$name <br>";
    }
    foreach ($allItemValue as $value) {
        echo "$value <br>";
    }
    */
    $gettingUserIdQuery = "SELECT id,group_id from userinfo WHERE email='" . $_SESSION['email'] . "'";
    $resultGettingUserId = mysqli_fetch_array(mysqli_query($conn, $gettingUserIdQuery), MYSQLI_ASSOC);
    $gettingMangerGroupQuery = "SELECT manager_id,group_id from groupdetails WHERE group_id='" . $resultGettingUserId['group_id'] . "'";
    $resultManagerGroupId = mysqli_fetch_array(mysqli_query($conn, $gettingMangerGroupQuery), MYSQLI_ASSOC);
    echo "User Id : " . $resultGettingUserId['id'] . " Group Id : " . $resultGettingUserId['group_id'] . "<br>";
    echo "Manager Id : " . $resultManagerGroupId['manager_id'] . "Group Id : " . $resultGettingUserId['group_id'] . "<br>";
    $userID = $resultGettingUserId['id'];
    $managerID = $resultManagerGroupId['manager_id'];
    $group_id = $resultGettingUserId['group_id'];


    $query = "INSERT INTO userdailycost (user_id,group_id,manager_id,entry_time_date,item_name,item_price) VALUES ";
    $queryValue = "";
    $itemValues = 0;
    for ($i = 0; $i < $itemCount; $i++) {
        if (!empty($_POST["items"][$i])) {
            $itemValues++;
            if ($queryValue != "") {
                $queryValue .= ",";
            }
            $queryValue .= "('$userID','$managerID','$group_id','$dateForUserDailyCost','" . $_POST["items"][$i] . "','" . $_POST["prices"][$i] . "')";
        }
    }

    $sql = $query . $queryValue;
    if ($itemValues != 0) {
        $result = mysqli_query($conn, $sql);
        if (!empty($result)){
            $message = "Added Successfully.";
        }
        else {
            echo "Unsucessful" . mysqli_error();
        }
    }
    function updateBazarStatus(){

    }

}



?>