<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 2/28/2018
 * Time: 7:03 PM
 */

require_once '../common/config.php';
require_once '../common/response.php';
require_once '../common/dbmanager.php';

if(array_key_exists('name', $_POST)) {
    $name = $_POST['name'];
} else {
    fail('You must input your name for admin action.');
}

if(array_key_exists('password', $_POST)) {
    $password = $_POST['password'];
} else {
    fail('You must input your password for admin action.');
}

verifyAdmin($name, $password);

function endsWith($haystack, $needle) {
    $length = strlen($needle);

    return $length === 0 || (substr($haystack, -$length) === $needle);
}

if(endsWith($_SERVER['REQUEST_URI'], 'verifyAdmin')) {
    success();
}