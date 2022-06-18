<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 12/8/2017
 * Time: 9:49 PM
 */
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";

class profileForUserEntry extends oodbconfig
{
    private $oodbconfig;
    private $csrfToken;

    private $userId;
    private $groupId;

    function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        $this->csrfToken = sha1($_SESSION['email']);
        $this->userId = $_SESSION['userID'];
        /*if(isset($_SESSION['groupID']))
        {
            $this->groupId = $_SESSION['groupID'];
        }*/
        $this->groupId = isset($_SESSION['userID']) ? $_SESSION['userID'] : null;

    }

    public function saveProfileData($firstname, $lastname, $email, $gender, $phoneNumber, $birthDate, $permanentAddr, $currentAddr, $country, $emergencyPhone, $secondEmail, $shortDesc)
    {
        $conn = $this->oodbconfig->get_connection();
        $editQuery = $conn->prepare("UPDATE userinfo,userotherinfo
        SET userinfo.firstName = ?, userinfo.lastName = ?, userinfo.email = ?,userinfo.phoneNumber=?,
        userotherinfo.birthDate=?,userotherinfo.gender=?,userotherinfo.permanentAddress=?,userotherinfo.currentAddress=?,
        userotherinfo.country=?,userotherinfo.emergencyNumber=?,userotherinfo.secondaryEmail=?,userotherinfo.shortDescription=?
        WHERE userinfo.id = ? AND userotherinfo.user_id = userinfo.id ");
        $editQuery->bind_param('sssisssssissi', $firstname, $lastname, $email, $phoneNumber, $birthDate, $gender, $permanentAddr, $currentAddr, $country, $emergencyPhone, $secondEmail, $shortDesc, $this->userId);

        if ($editQuery->execute()) {
            echo $editQuery->affected_rows . " Data Successfully Updated";
        } else {
            trigger_error($editQuery->error, E_USER_ERROR);
        }
    }

    public function idCheckExistense()
    {
        $stat = false;
        $conn = $this->oodbconfig->get_connection();
        $checkQuery = "select user_id from userotherinfo WHERE user_id='$this->userId'";
        $result = $conn->query($checkQuery);
        if ($conn->affected_rows == 1) {
            $stat = true;
        }
        return $stat;
    }

    public function dataCreation()
    {
        $conn = $this->oodbconfig->get_connection();
        $sql = "insert into userotherinfo(birthDate,gender,permanentAddress,currentAddress,country,emergencyNumber,secondaryEmail,shortDescription,user_id) 
            VALUES ('1980-01-01' ,'male','sadasd,sdsada','sads,asdsa','bangldesh',12324,'email@email.com' ,'asjdasjdsfsjfbsd' ,'$this->userId')";
        $result = $conn->query($sql);
        if ($conn->affected_rows == 1) {
            return true;
        }
        return false;
    }

    public function setCsrfToken($token)
    {
        $this->csrfToken = $token;
    }

    public function getCsrfTokenResult()
    {
        if (hash_equals(sha1($_SESSION['email']), $this->csrfToken)) {
            return true;
        }
        return false;
    }
    public function passwordUpdate($oldPassword,$newPassword){
        $conn = $this->oodbconfig->get_connection();
        $oldHashPassword=md5($oldPassword);
        $newHashPassword=md5($newPassword);
        $editQuery = $conn->prepare("UPDATE userinfo SET userinfo.password = ? WHERE userinfo.id = ?");
        $editQuery->bind_param('si', $newHashPassword,$this->userId);
        if ($editQuery->execute()) {
            echo $editQuery->affected_rows . " Data Successfully Updated";
        } else {
            trigger_error($editQuery->error, E_USER_ERROR);
        }
    }

}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $profileForUserEntry = new profileForUserEntry();
    if (isset($_POST['csrfToken'])) {
        $firstname = $_POST['userFirstName'];
        $lastname = $_POST['userLastName'];
        $email = $_POST['userEmail'];
        $phoneNumber = $_POST['userPhoneNumber'];
        $gender = $_POST['userGender'];
        $birthDate = $_POST['userBirthDate'];
        $permanentAddr = $_POST['userPermanentAddress'];
        $currentAddr = $_POST['userCurrentAddress'];
        $secondEmail = $_POST['userSecondaryEmail'];
        $country = $_POST['userCountry'];
        $emergencyPhone = $_POST['userEmergencyPhone'];
        $shortDesc = $_POST['userShortDescription'];

        $profileForUserEntry->setCsrfToken($_POST['csrfToken']);

        if ($profileForUserEntry->getCsrfTokenResult() == true) {
            if ($profileForUserEntry->idCheckExistense()) {
                $profileForUserEntry->saveProfileData($firstname, $lastname, $email,
                    $gender, $phoneNumber, $birthDate, $permanentAddr, $currentAddr,
                    $country, $emergencyPhone, $secondEmail, $shortDesc);
            } else {
                if ($profileForUserEntry->dataCreation()) {
                    $profileForUserEntry->saveProfileData($firstname, $lastname, $email,
                        $gender, $phoneNumber, $birthDate, $permanentAddr, $currentAddr,
                        $country, $emergencyPhone, $secondEmail, $shortDesc);
                } else {
                    echo "some errror";
                }
            }
        } else {
            echo "Anti Forgey Request";
        }
    }
}
?>