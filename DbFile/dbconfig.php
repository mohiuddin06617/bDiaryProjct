<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 12/26/2016
 * Time: 1:19 PM
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname="bdiary_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
