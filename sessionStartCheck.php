<?php
/**
 * Created by PhpStorm.
 * User: mohiuddin
 * Date: 11/27/2017
 * Time: 12:21 PM
 */


date_default_timezone_set('Asia/Dhaka');
function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? true : false;
        } else {
            return session_id() === '' ? false : true;
        }
    }
    return false;
}


if ( is_session_started() === false ) session_start();
?>