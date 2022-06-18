<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 12/4/2017
 * Time: 1:41 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class userProfileFetch extends oodbconfig
{
    private $oodbconfig;
    private $groupName;
    private $userId;
    private $groupId;
    private $houseAddress;
    private $fullName;
    private $birthDate;
    private $gender;
    private $accountCreationDate;
    private $phoneNumber;
    private $userGroupStatus;
    private $permanentAddress;
    private $currentAddress;
    private $secondaryEmail;
    private $emergencyNumber;
    private $shortDescription;
    private $firstName;
    private $lastName;


    function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        $this->userId = $_SESSION['userID'];
        $this->groupId=isset($_SESSION['groupID'])?$_SESSION['groupID']:null;
        $this->setGroupName();
        $this->userInfo();
        $this->userOtherInfo();
    }

    private function setGroupName()
    {
        $conn = $this->oodbconfig->get_connection();
        $groupNameGettingQuery = "SELECT group_name FROM groupdetails WHERE groupdetails.group_id='$this->groupId'";
        $groupNameGettingResult = $conn->query($groupNameGettingQuery);
        if ($conn->affected_rows > 0) {
            $row = $groupNameGettingResult->fetch_assoc();
            $this->groupName = $row['group_name'];
        }
    }

    private function userInfo()
    {
        $conn = $this->oodbconfig->get_connection();
        $userInfoQuery = "select *from userinfo where id='$this->userId'";
        $userInfoResult = $conn->query($userInfoQuery);
        if ($userInfoResult->num_rows>0) {
            while ($row = $userInfoResult->fetch_assoc()) {
                $this->phoneNumber = $row['phoneNumber'];
                $phpdate = strtotime( $row['accountCreationDate'] );//Mysql to normal php format
                $mysqldate = date( 'd-M-Y', $phpdate );
                $this->accountCreationDate=$mysqldate;

                $this->fullName = $row['firstName'] . " " . $row['lastName'];
                $this->fullName = ucwords($this->fullName);
                $this->firstName=$row['firstName'];
                $this->lastName=$row['lastName'];
                if ($row['userGroupStatus'] == 1 && $row['userStatus'] == 1) {
                    $this->userGroupStatus = 'Manager';
                } elseif ($row['userGroupStatus'] == 1 && $row['userStatus'] == 0) {
                    $this->userGroupStatus = 'User';
                }
            }
        }
    }
    private function userOtherInfo(){
        $conn=$this->oodbconfig->get_connection();
        $userOtherInfoQuery="select *from userOtherInfo where user_id='$this->userId'";
        $userOtherInfoResult=$conn->query($userOtherInfoQuery);
        if ($userOtherInfoResult->num_rows>0){
            while ($row=$userOtherInfoResult->fetch_assoc()){
                $this->birthDate=$row['birthDate'];
                $this->gender=$row['gender'];
                $this->permanentAddress=$row['permanentAddress'];
                $this->currentAddress=$row['currentAddress'];
                $this->secondaryEmail=$row['secondaryEmail'];
                $this->emergencyNumber=$row['emergencyNumber'];
                $this->shortDescription=$row['shortDescription'];

            }
        }
    }
    public function getGroupName()
    {
        return $this->groupName;
    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function getHouseAddress()
    {
        return $this->houseAddress;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return mixed
     */
    public function getAccountCreationDate()
    {
        return $this->accountCreationDate;
    }


    /**
     * @return mixed
     */
    public function getUserGroupStatus()
    {
        return $this->userGroupStatus;
    }


    /**
     * @return mixed
     */
    public function getPermanentAddress()
    {
        return $this->permanentAddress;
    }

    /**
     * @return mixed
     */
    public function getCurrentAddress()
    {
        return $this->currentAddress;
    }

    /**
     * @return mixed
     */
    public function getSecondaryEmail()
    {
        return $this->secondaryEmail;
    }
    /**
     * @return mixed
     */
    public function getEmergencyNumber()
    {
        return $this->emergencyNumber;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }
    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }


}

?>