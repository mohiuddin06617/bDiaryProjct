<?php
include_once "sessionStartCheck.php";
include_once "DbFile/oodbconfig.php";
class forgotPasswordHandler extends oodbconfig{
    private $oodbconfig;
    private $emailExistence;
    private $emailSender;
    private $generatedHash;

    function __construct()
    {
        $this->oodbconfig=new oodbconfig();
    }
    public function checkEmailExistence($email){
        $stat=false;
        $conn=$this->oodbconfig->get_connection();
        $sql="select email from userinfo WHERE email='".$email."'";
        $result=$conn->query($sql);
        if ($conn->affected_rows>0){
            $stat=true;
        }
        return $stat;
    }
    public function sendEmail($email){
        
    }
}