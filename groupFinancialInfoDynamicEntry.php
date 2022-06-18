<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 11/24/2017
 * Time: 10:44 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class groupFinancialInfoDynamicEntry extends oodbconfig{
    private $oodbconfig;
    private $managerId;
    private $groupId;
    public function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->managerId=$_SESSION['managerID'];
        $this->groupId=$_SESSION['groupID'];
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

}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    /* echo $_POST['billName'];
     echo $_POST['billAmount'];*/
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
                $groupFinancialInfoDynamicEntry = new groupFinancialInfoDynamicEntry();
/*                echo "<span class='alert alert-success'>".$billName." ".$billAmount." ".$billCurrencyType." ".$billingMonth."</span>";*/
                echo $groupFinancialInfoDynamicEntry->saveBillInfo($billName, $billAmount, $billCurrencyType, $billingMonth);
            } else {
                $billAmountError = "<span class='alert alert-danger black-text-color slide-up'><strong>Bill Amount can not be empty and must have to be a Number</strong></span>";
            }
        } else {
            $billNameError = "<span class='alert alert-danger black-text-color slide-up'><strong>Bill Name Can not be empty</strong></span>";
        }

        /** @var TYPE_NAME $billNameBool */
        if ($billNameBool === true) {

            //callNewBillSaveMethod($billName, $billAmount, $billCurrencyType, $billingMonth);

        } else {
            if (!empty($billNameError)) {
                echo $billNameError;
            } elseif (!empty($billAmountError)) {
                echo $billAmountError;
            }
        }

        function callNewBillSaveMethod($billName, $billAmount, $billCurrencyType, $billingMonth)
        {

        }
    }


}
?>