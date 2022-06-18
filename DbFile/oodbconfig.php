<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 1/15/2017
 * Time: 9:46 PM
 */
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdiary";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}*/

class oodbconfig{
    protected $conn;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "bdiary_db";

    function __construct(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }
    public function get_connection(){
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }

}
?>