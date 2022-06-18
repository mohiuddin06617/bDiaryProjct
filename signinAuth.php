<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 6/9/2017
 * Time: 8:30 PM
 */

/*Previous Page Code*/
/*
 * $token=$_SESSION['token']=md5(uniqid(mt_rand(),true));*/
include_once "sessionStartCheck.php";
include 'DbFile/oodbconfig.php';


class signinAuth extends oodbconfig
{
    private $email;
    protected $password;
    private $passmd5;
    public $errors = array('emailErr' => null, 'passErr' => null, 'connErr' => null);
    private $access;
    private $token;
    private $securedEmail;
    private $securedPassword;
    private $num_attempt;
    private $loggedin = 0;
    public $errorList;

    function __construct()
    {
        $this->errors = array();
        $this->access = 0;
        //$this->token=$_POST['token'];
        $this->securedEmail = false;
        $this->securedPassword = false;
    }

    //Don't user that function
    public function filter($var)
    {
        return preg_replace('/[^a-zA-Z0-9]/', '', $var);
    }


    public function sanitize_email($email)
    {
        $oodbconfig = new oodbconfig();
        $conn = $oodbconfig->get_connection();
        if (!empty($email)) {
            $this->email = strip_tags($email);
            $this->email = trim($this->email);
            $this->email = stripslashes($this->email);
            $this->email = htmlspecialchars($this->email);
            $this->email = mysqli_real_escape_string($conn, $this->email);
            return $this->email;
        }
    }

    public function validate_email($email)
    {
        $stat = false;
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->securedEmail = true;
            $stat = true;
        }
        return $stat;
    }

    public function check_password_validation($password)
    {
        $stat = false;
        $this->password = $password;
        $password_pattern = "/^[a-zA-Z0-9@-_]+$/";
        if (!empty($password)) {
            if (strlen($password) > 6 && strlen($password) < 16) {
                if (preg_match_all($password_pattern, $password)) {
                    $this->securedPassword = true;
                    $stat = true;
                }
            }
        }
        return $stat;
    }

    public function check_db_credintial($email, $password)
    {
        $stat = false;
        $oodbconfig = new oodbconfig();
        $conn = $oodbconfig->get_connection();
        if ($this->securedEmail === true) {
            if ($this->securedPassword === true) {
                $loginQuery = $conn->prepare("select id,email,userGroupStatus,userStatus,group_id from userinfo WHERE email=? AND password=? LIMIT 1");
                $hashedPassword=hash('sha512',$password);
                $loginQuery->bind_param('ss', $email, $hashedPassword);
                $loginQuery->execute();
                $result = $loginQuery->get_result();
                if ($conn->affected_rows == 1) {
                    while ($row = $result->fetch_assoc()) {
                        //return "<br>Name is : " . $row['firstName'] . " " . $row['lastName'] . "<br>Email is : " . $row['email'] . "<br>Group ID is : " . $row['group_id'] . "<br>User Status : " . $row['userStatus'] . "<br>User Group Status : " . $row['userGroupStatus'];
                        if ($row['userGroupStatus'] == 1) {
                            if ($row['userStatus'] == 1) {
                                //for manager
                                $this->access=2;
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['managerID'] = $row['id'];
                                $_SESSION['groupID'] = $row['group_id'];
                                $_SESSION['userStatus'] = $row['userStatus'];
                                $_SESSION['userID'] = $row['id'];

                            } elseif ($row['userStatus'] == 0) {
                                //For group user
                                $this->access=1;
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['userID'] = $row['id'];
                                $_SESSION['groupID'] = $row['group_id'];
                                $_SESSION['userStatus'] = $row['userStatus'];

                            }
                        } elseif ($row['userGroupStatus'] == 0) {
                            //For non Group user
                            $this->access=0;
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['userID'] = $row['id'];
                            $_SESSION['userStatus'] = $row['userStatus'];

                        }
                    }
                    $stat = true;
                }
            }
        }
        return $stat;
    }


    public function url_forwarding($email, $password)
    {
        if ($this->check_db_credintial($email, $password)&& $this->access === 2) {
            header('location:managerHome.php');
        } elseif ($this->check_db_credintial($email, $password) && $this->access === 1) {
            header('location:userHome.php');
        } elseif ($this->check_db_credintial($email, $password) && $this->access === 0) {
            header('location:userHome.php');
        }
    }
}

/*$signinAuth = new signinAuth();
if ($_SERVER['REQUEST_METHOD']==="POST"){
    if (isset($_POST['login'])){
        $emailLogin=isset($_POST['email'])?$_POST['email']:null;
        $passwordLogin=isset($_POST['password'])?$_POST['password']:null;
        $rememberMe=isset($_POST['rememberMe'])?$_POST['rememberMe']:null;
    }
}*/
?>