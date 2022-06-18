<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 1/28/2018
 * Time: 3:37 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class managerShoppingCostEntry extends oodbconfig
{
    private $oodbconfig;
    private $groupId;
    private $managerId;

    function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->groupId=isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
        $this->managerId=isset($_SESSION['managerID'])?$_SESSION['managerID']:null;
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
if ($_SERVER['REQUEST_METHOD']=="POST"){
    $dailyCostApprovalEntry=new managerShoppingCostEntry();
    if (isset($_POST['action'])) {
        if (($_POST['action'] == 'deleteData') && !empty($_POST['deleteId'])) {
            $deleteId=isset($_POST['deleteId'])?$_POST['deleteId']:null;
            if ($dailyCostApprovalEntry->deleteShoppingData($deleteId)){
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
            if ($dailyCostApprovalEntry->updateShoppingData($sel_id,$item_name,$item_price,$quantity)){
                echo http_response_code(200);
            }
            else{
                echo "Not worked";
                echo $item_name." ".$item_price." ".$quantity." ".$sel_id;
            }
        }
        if (($_POST['action'] === 'deleteAllSameDateData') && !empty($_POST['specificSameDateAll'])){
            $spec_date=$_POST['specificSameDateAll'];
            if ($dailyCostApprovalEntry->deleteDateAllData($spec_date)){
                echo http_response_code(200);
            }//echo http_response_code(200);


        }

    }
}

?>