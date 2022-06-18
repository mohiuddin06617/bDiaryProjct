<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 12/10/2017
 * Time: 11:12 AM
 */
if (strpos($_SERVER['REQUEST_URI'], basename(__FILE__)) !== false) {

    header("Location:logout.php");
}
?>