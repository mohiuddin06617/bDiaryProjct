<?php
include_once "DbFile/oodbconfig.php";

class signup extends oodbconfig
{
    private $oodbconfig;
    private $firstNameError;
    private $lastNameError;
    private $emailError;
    private $passwordError = array();
    private $confirmPasswordError;
    private $phoneNumberError;
    private $userCreationError;
    private $firstNameBool = false;
    private $lastNameBool = false;
    private $emailBool = false;
    private $passwordBool = false;
    private $confirmPasswordBool = false;
    private $phoneNumberBool = false;
    private $emailExistence = false;

    /*    function __construct($firstname,$lastname,$email,$pass,$confPass,$phoneNum*/
    function __construct()
    {
        $this->oodbconfig = new oodbconfig();
        /*$this->nameValidationCheck($firstname, $lastname);
        $this->emailValidationCheck($email);
        $this->passwordValidationCheck($pass);
        $this->confirmPasswordCheck($pass, $confPass);
        $this->phoneNumberCheck($phoneNum);*/
    }

    public function nameValidationCheck($firstname, $lastname)
    {
        $stat=false;
        if (!empty($firstname) && !empty($lastname)) {
            if (ctype_alpha($firstname[0]) && ctype_alpha($lastname[0])) {
                $this->firstNameBool = true;
                $this->lastNameBool = true;
                $stat=true;
            } else {
                $this->lastNameError = $this->firstNameError = "Name Must start with a character<br>";
            }
        } else {
            $this->firstNameError = $this->lastNameError = "Name can not be empty!";
        }
        return $stat;
    }

    private function emailExistenceCheck($email)
    {
        $stat = true; //false means email exist in the database
        $conn = $this->oodbconfig->get_connection();
        $sql = "select email from userinfo where userinfo.email='" . $email . "'";
        $result = $conn->query($sql);
        if ($conn->affected_rows == 0) {
            $stat = false;
        }
        return $stat;
    }

    public function emailValidationCheck($email)
    {
        $stat=false;
        if (!empty($email)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (!$this->emailExistenceCheck($email)) {
                    $this->emailBool = true;
                    $stat=true;
                } else {
                    $this->emailExistence = true;

                    $this->emailError = "Already a user is registered with this email<br>";
                }
            } else {
                $this->emailError = "Email Not properly validated<br>";
            }
        } else {
            $this->emailError = "Email can not be empty" . "<br>";
        }
        return $stat;
    }
// /^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z._-]{7,15}$/
// ^(?=.*\d.*\d)[0-9A-Za-z!@#$%*]{7,15}$
    public function passwordValidationCheck($password)
    {
        $stat=false;
        if (!empty($password)) {
            if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z._-]{7,15}$/', $password)) {
                $passwordError = '<span class="text-center text-danger">Password does not meet the requirements!<br></span>';
                $passwordRule1 = "<span class='text-center text-danger'>Must contain 7-15 letters<br></span>";
                $passwordRule2 = "<span class='text-danger text-center'>Must use combination of letter and numbers<br></span>";
                $passwordRule3 = "<span class='text-center text-danger'>May Contain Dot(.) Dash(-) Underscore(_)<br></span>";
                array_push($this->passwordError, $passwordError);
                array_push($this->passwordError, $passwordRule1);
                array_push($this->passwordError, $passwordRule2);
                array_push($this->passwordError, $passwordRule3);

            } else {
                $this->passwordBool = true;
                $stat=true;
            }
        } else {
            $this->passwordError = "Password can not be empty<br>";
        }
        return $stat;
    }

    public function confirmPasswordCheck($password, $confirmpassword)
    {
        $stat=false;
        if (!empty($confirmpassword)) {
            if ($confirmpassword === $password) {
                $this->confirmPasswordBool = true;
                $stat=true;
            } else {
                $this->confirmPasswordError = " *Password does not match<br>";
            }
        } else {
            $this->confirmPasswordError = " *Enter the above same password<br>";
        }
        return $stat;
    }

    public function phoneNumberCheck($phonenumber)
    {
        $stat=false;
        if (!empty($phonenumber)) {
            if (strlen($phonenumber) === 10 && is_numeric($phonenumber)) {
                $this->phoneNumberBool = true;
                $stat=true;
            } else {
                $this->phoneNumberError = "Phone Number Must have to be 10 number and numeric";
            }
        } else {
            $this->phoneNumberError = "Phone Number Can not be empty";
        }
        return $stat;
    }

    public function createUser($firstname,$lastname,$email,$confirmpassword,$phonenumber){
        $stat=false;
        $conn = $this->oodbconfig->get_connection();
        $sql = $conn->prepare("INSERT INTO userinfo (firstName, lastName, email,password,phoneNumber,userGroupStatus,userStatus, group_id)
        VALUES (?,?,?,?,?,?,?,?)");
        $userGroupStatus = 0;
        $userStatus = 0;
        $groupId = 0;
        $hashPassword=hash('sha512',$confirmpassword);
        $sql->bind_param('sssssiii', $firstname, $lastname, $email, $hashPassword, $phonenumber, $userGroupStatus, $userStatus, $groupId);
        if ($sql->execute()) {
            $stat=true;
        } else {
            $this->userCreationError= "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $conn->close();

        return $stat;
    }
    public function emailSending($email){

    }



    public function getFirstNameError()
    {
        return $this->firstNameError;
    }


    public function getLastNameError()
    {
        return $this->lastNameError;
    }


    public function getEmailError()
    {
        return $this->emailError;
    }


    public function getPasswordError(): array
    {
        return $this->passwordError;
    }


    public function getConfirmPasswordError()
    {
        return $this->confirmPasswordError;
    }


    public function getPhoneNumberError()
    {
        return $this->phoneNumberError;
    }

    public function getUserCreationError()
    {
        return $this->userCreationError;
    }
}

?>