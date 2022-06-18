<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 6/20/2017
 * Time: 4:51 AM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";
include_once "DbFile/dbconfig.php";

class userShoppingCostEntry extends oodbconfig{
    private $oodbconfig;
    private $groupId;
    private $userId;

    function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->groupId=isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
        $this->managerId=isset($_SESSION['userID'])?$_SESSION['userID']:null;
    }

    public function updateShoppingData($selId,$item_name,$item_price,$quantity){
        $stat=false;
        $conn=$this->oodbconfig->get_connection();
        $updateQuery=$conn->prepare("Update userDailyCost SET userDailyCost.item_name=?,userDailyCost.item_price=?,userdailycost.quantity=?
        WHERE userDailyCost.dailyCostTableId=? AND userDailyCost.group_id=?");
        $updateQuery->bind_param('sdsii',$item_name,$item_price,$quantity,$selId,$this->groupId);
        $result=$updateQuery->execute();
        if ($result){
            $stat=true;
            /*if ($updateQuery->affected_rows>0){

            }*/
        }
        return $stat;
    }

    public function deleteShoppingData($selected_id)
    {
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $sql = "DELETE from userDailyCost WHERE userDailyCost.group_id='$this->groupId' AND userDailyCost.dailyCostTableId='$selected_id'";
        $result = $conn->query($sql);
        if ($conn->affected_rows > 0) {
            $stat = true;
        }
        return $stat;
    }
    public function deleteDateAllData($selected_date)
    {
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $sql = "DELETE from userDailyCost WHERE userDailyCost.group_id='$this->groupId' AND userDailyCost.entry_time_date='$selected_date'";
        $result = $conn->query($sql);
        if ($conn->affected_rows > 0) {
            $stat = true;
        }
        return $stat;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['items'])) {
        $totalItems = count($_POST['items']);
        $dateForUserDailyCost = validate_input($_POST['dateforuserdailycost']);


        $items = array();
        $quantities = array();
        $prices = array();

        for ($i = 0; $i < $totalItems; $i++) {
            if (!empty($_POST['items'][$i])) {
                array_push($items, validate_input($_POST['items'][$i]));
            } else {
                echo "<span class='text-danger'>Item Name can not be empty</span><br>";
            }

            array_push($quantities, validate_input($_POST['quantities'][$i]));

            if (!empty($_POST['prices'][$i])) {
                array_push($prices, validate_input($_POST['prices'][$i]));
            } else {
                echo "<span class='text-danger'>Item Price can not be empty</span><br>";
            }
        }


        if (!empty($_POST['dateforuserdailycost']) && !empty($_POST['items']) && !empty($_POST['quantities']) && !empty($_POST['prices'])) {
            $date = DateTime::createFromFormat('d/m/Y', $dateForUserDailyCost);
            $dateForUserDailyCost = $date->format('Y-m-d');
            $itemCount = count($items);
            //    $allItemName = array();
            //    $allItemValue = array();
            //    for ($i = 0; $i < $itemCount; $i++) {
            //        array_push($allItemName, $_POST['items'][$i]);
            //    }
            //    for ($i = 0; $i < $itemCount; $i++) {
            //        array_push($allItemValue, $_POST['prices'][$i]);
            //    }
            //    foreach ($allItemName as $name) {
            //        echo "$name <br>";
            //    }
            //    foreach ($allItemValue as $value) {
            //        echo "$value <br>";
            //    }


            $gettingUserIdQuery = "SELECT id,group_id from userinfo WHERE email='" . $_SESSION['email'] . "'";
            $resultGettingUserId = mysqli_fetch_array(mysqli_query($conn, $gettingUserIdQuery), MYSQLI_ASSOC);
            $gettingMangerGroupQuery = "SELECT manager_id,group_id from groupdetails WHERE group_id='" . $resultGettingUserId['group_id'] . "'";

            $resultManagerGroupId = mysqli_fetch_array(mysqli_query($conn, $gettingMangerGroupQuery), MYSQLI_ASSOC);
            $userID = $resultGettingUserId['id'];
            $managerID = $resultManagerGroupId['manager_id'];
            $group_id = $resultGettingUserId['group_id'];
            $quantity = "";

            $query = "INSERT INTO userdailycost (user_id,group_id,manager_id,entry_time_date,item_name,item_price,quantity) VALUES ";
            $queryValue = "";
            $itemValues = 0;
            for ($i = 0; $i < $itemCount; $i++) {
                if (!empty($items[$i])) {
                    $itemValues++;
                    if ($queryValue != "") {
                        $queryValue .= ",";
                    }
                    $queryValue .= "('$userID','$group_id','$managerID','$dateForUserDailyCost','" . $items[$i] . "','" . $prices[$i] . "','" . $quantities[$i] . "')";
                }
            }

            $sql = $query . $queryValue;
            if ($itemValues != 0) {
                $result = mysqli_query($conn, $sql);
                if (!empty($result)) {
                    $message = "<h3 class='text-success'>Added Successfully.</h3>";
                    updateBazarListStatus($conn, $dateForUserDailyCost);
                    echo $message;
                } else {
                    echo "Unsucessful" . mysqli_error($conn);

                }
            }

        } else {
            echo "<h3 class='text-danger'>Input not successful</h3>";
        }
    }

    if (isset($_POST['action'])){
        $userShoppingCostEntry=new userShoppingCostEntry();
        if (($_POST['action'] == 'deleteAllSameDateData') && !empty($_POST['specificSameDateAll'])){
            $spec_date=$_POST['specificSameDateAll'];
            if ($userShoppingCostEntry->deleteDateAllData($spec_date)){
                echo http_response_code(200);
            }//echo http_response_code(200);
        }
        if (($_POST['action'] == 'deleteData') && !empty($_POST['deleteId'])) {
            $deleteId=isset($_POST['deleteId'])?$_POST['deleteId']:null;
            if ($userShoppingCostEntry->deleteShoppingData($deleteId)){
                echo http_response_code(200);
            }
            else{
                echo "Not worked";
            }
        }
        if (($_POST['action'] == 'updateShoppingData') && !empty($_POST['sel_id'])) {
            $item_name=isset($_POST['item_name'])?$_POST['item_name']:null;
            $item_price=isset($_POST['item_price'])?$_POST['item_price']:null;
            $quantity=isset($_POST['quantity'])?$_POST['quantity']:null;
            $sel_id=$_POST['sel_id'];
            if ($userShoppingCostEntry->updateShoppingData($sel_id,$item_name,$item_price,$quantity)){
                echo http_response_code(200);
            }
            else{
                echo "Not worked";
                echo $item_name." ".$item_price." ".$quantity." ".$sel_id;
            }
        }
    }
} else {
    echo "<h3>404  Can not Accessible</h3>";
}
function updateBazarListStatus($conn,$date){
    $updateQuery = "UPDATE shoppingpersonselection SET bazar_status=1 WHERE selected_date='$date'";
    $result=mysqli_query($conn,$updateQuery);
}
function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>