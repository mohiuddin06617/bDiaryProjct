<?php
/**
 * Created by PhpStorm.
 * User: Mohiuddin
 * Date: 7/28/2017
 * Time: 11:33 AM
 */
if ( ($_SERVER['REQUEST_METHOD']=='GET'/* ||$_SERVER['REQUEST_METHOD']=='POST'*/) && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    /*
       Up to you which header to send, some prefer 404 even if
       the files does exist for security
    */
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

    /* choose the appropriate page to redirect users */
   die( header( 'location:logout.php' ) );

}

session_start();

class managerStatusManagement{

    private function set_user_status(){
        $_SESSION['userStatus']=0;
    }
    private function set_manager_status(){
        $_SESSION['userStatus']=1;
    }
    public function redirecting_to_userHome(){
        $this->set_user_status();
    }

    public function redirecting_to_managerHome(){
        $this->set_manager_status();
    }

}

$managerStatusManagement=new managerStatusManagement();
$statusValue=$_POST['statusValue'];
if (!empty($statusValue)) {
    if ($statusValue == 'user') {
        $managerStatusManagement->redirecting_to_userHome();
    } elseif ($statusValue == 'manager') {
        $managerStatusManagement->redirecting_to_managerHome();
    }
}
?>