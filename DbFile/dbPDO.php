<?php
/**
 * Created by PhpStorm.
 * User: rian
 * Date: 6/13/2017
 * Time: 11:41 AM
 */
$servername='localhost';
$username='root';
$password='';
$dbname='bdiary';

try{
    $conn=new PDO('mysql:host=$servername;dbname=$dbname',$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully";
}
catch(PDOException $e){
    echo "Connection Failed " . $e->getMessage();
}
?>