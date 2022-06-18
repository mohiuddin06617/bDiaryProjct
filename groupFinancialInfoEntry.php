<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 11/24/2017
 * Time: 10:44 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class groupFinancialInfoEntry extends oodbconfig{
    private $oodbconfig;
    private $managerId;
    private $groupId;
    public function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->managerId=isset($_SESSION['managerID'])?$_SESSION['managerID']:null;
        $this->groupId=isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
    }

    /**
     * @param $billName
     * @param $billAmount
     * @param $billCurrencyType
     * @param $billingMonth
     * @return string
     */
    public function saveBillInfo($billName, $billAmount, $billCurrencyType, $billingMonth){
        $conn=$this->oodbconfig->get_connection();
        $currentYear=date('Y');
        $insertQuery = $conn->prepare("INSERT INTO groupFinancialData
                        (billName, billAmount, currency,managerId,groupId,enteredMonth,enteredYear) 
                        VALUES (?, ?, ?,?,?,?,?)");
        $insertQuery->bind_param('sississ',$billName,$billAmount,$billCurrencyType,$this->managerId,$this->groupId,$billingMonth,$currentYear);
        $result=$insertQuery->execute();
        return "<span class='alert alert-success black-text-color slide-up'><strong>Success!</strong></span>";
/*        return $billName." ".$billAmount." ".$billCurrencyType." ".$billingMonth."<br/>";*/
    }
    public function updateGroupFinancialData($grpFinanId,$billName,$billAmount){
        $conn=$this->oodbconfig->get_connection();
        $currentMonth=date('m');
        $currentYear=date('Y');
        $updateQuery=$conn->prepare("Update groupFinancialData SET groupFinancialData.billName=?,groupFinancialData.billAmount=? 
            WHERE groupFinancialData.groupFinancialId=? AND groupFinancialData.groupId=? AND groupFinancialData.enteredMonth=? AND groupFinancialData.enteredYear=?");
        $updateQuery->bind_param('siiiis',$billName,$billAmount,$grpFinanId,$this->groupId,$currentMonth,$currentYear);
        if ($updateQuery->execute()) {
            /*echo $updateQuery->affected_rows . " Data Successfully Updated";*/
            if ($updateQuery->affected_rows>0){
                return true;
            }
            else{
                return false;
            }
        } else {
            return $updateQuery->error;
        }
    }
    public function deleteGroupFinancialData($deleteId){
        $conn=$this->oodbconfig->get_connection();
        $currentMonth=date('m');
        $currentYear=date('Y');
        $deleteQuery="DELETE from groupFinancialData WHERE groupFinancialId='$deleteId' AND groupId='$this->groupId' AND enteredMonth='$currentMonth' AND enteredYear='$currentYear'";
        $result=$conn->query($deleteQuery);
        if ($result){
            if ($conn->affected_rows>0){
                return true;
            }
            else{
                return false;
            }
        } else {
            return $conn->error;
        }
    }

}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    /* echo $_POST['billName'];
     echo $_POST['billAmount'];*/
    $groupFinancialInfoEntry = new groupFinancialInfoEntry();
    if (isset($_POST['creationData'])) {
        $billName = $billAmount = $billCurrencyType = $billingMonth = "";
        $billNameBool = $billAmountBool = false;

        if (isset($_POST['billName']) && !empty($_POST['billName'])) {
            $billName = $_POST['billName'];
            $billAmountBool = true;
            if (isset($_POST['billAmount']) && !empty($_POST['billAmount']) && is_numeric($_POST['billAmount'])) {
                $billAmount = $_POST['billAmount'];
                $billCurrencyType = $_POST['billCurrencyType'];
                $billingMonth = $_POST['billingMonth'];

/*                echo "<span class='alert alert-success'>".$billName." ".$billAmount." ".$billCurrencyType." ".$billingMonth."</span>";*/
                echo $groupFinancialInfoEntry->saveBillInfo($billName, $billAmount, $billCurrencyType, $billingMonth);
            } else {
                $billAmountError = "<span class='alert alert-danger black-text-color slide-up'><strong>Bill Amount can not be empty and must have to be a Number</strong></span>";
            }
        } else {
            $billNameError = "<span class='alert alert-danger black-text-color slide-up'><strong>Bill Name Can not be empty</strong></span>";
        }

        if ($billNameBool === true) {

            //callNewBillSaveMethod($billName, $billAmount, $billCurrencyType, $billingMonth);

        } else {
            if (!empty($billNameError)) {
                echo $billNameError;
            } elseif (!empty($billAmountError)) {
                echo $billAmountError;
            }
        }
    }
    if (isset($_POST['action'])) {
        if (($_POST['action'] == 'updateGroupFinInfo') && !empty($_POST['groupFinId'])) {
              $billA=$_POST['bAInlineInput'];
              $billN=$_POST['bNInlineInput'];
              $groupFinId=$_POST['groupFinId'];;
              if ($groupFinancialInfoEntry->updateGroupFinancialData($groupFinId,$billN,$billA)){
               echo http_response_code(200);
              }
        }
    }
    if (isset($_POST['groupFinDeleteId'])){
        $deleteId=$_POST['groupFinDeleteId'];
        if ($groupFinancialInfoEntry->deleteGroupFinancialData($deleteId)){
            echo http_response_code(200);
        }
    }
    /*if (isset($_POST['updateGroupFinInfo'])){
        foreach ($_POST['updateGroupFinInfo'] as $value){
            echo $value;
        }
    }*/


}
?>