<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 2/10/2018
 * Time: 6:54 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";
class managerHomeFetch extends oodbconfig{

    private $oodbconfig;
    private $shopperId;
    private $shopperName;
    private $managerId;
    private $groupId;
    private $bazarStatus;

    function __construct()
    {
        $this->oodbconfig=new oodbconfig();
        $this->managerId=isset($_SESSION['managerID'])?$_SESSION['managerID']:null;
        $this->groupId=isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
        $this->setShopperId();
        $this->setShopperName();

    }
    private function setShopperId(){
        $conn=$this->oodbconfig->get_connection();
        $sql="select selected_person_id,bazar_status from shoppingpersonselection WHERE selected_date=CURRENT_DATE AND group_id='$this->groupId'";
        $result=$conn->query($sql);
        if ($conn->affected_rows>0){
            $row=$result->fetch_assoc();
            $this->shopperId=isset($row['selected_person_id'])?$row['selected_person_id']:null;
            $this->bazarStatus=isset($row['bazar_status'])?$row['bazar_status']:null;
        }
    }
    private function setShopperName(){
        $conn=$this->oodbconfig->get_connection();
        $sql="select firstName,lastName from userinfo WHERE id='".$this->getShopperId()."' AND group_id='$this->groupId'";
        $result=$conn->query($sql);
        if ($conn->affected_rows>0){
            $row=$result->fetch_assoc();
            $this->shopperName=isset($row['firstName'])?ucwords($row['firstName']." ".$row['lastName']):null;
        }
    }

    public function getShopperId()
    {
        return $this->shopperId;
    }

    public function getShopperName()
    {
        if ($this->shopperName) {
            return $this->shopperName;
        }
        else{
            return "No One Selected";
        }
    }

    public function getBazarStatus()
    {
        return $this->bazarStatus;
    }
}