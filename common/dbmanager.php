<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 2/28/2018
 * Time: 7:04 PM
 */

require_once 'config.php';
require_once 'response.php';

$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if($mysqli->connect_errno) {
    fail('DB connection error');
}

function verifyAdmin($name, $password) {
    global $mysqli;
    $res = $mysqli->query("SELECT `name`, `password` FROM `admin` WHERE `name`='$name'");

    if($res->num_rows == 0) {
        fail('Admin user does not exist');
    }

    $admin = $res->fetch_assoc();

    if($admin['password'] != $password) {
        fail('Password is incorrect');
    }

    return true;
}

function findUser($email) {
    global $mysqli;
    $res = $mysqli->query("SELECT `email`, `password`, `uuid`, `devicecount` FROM `users` WHERE `email`='$email'");

    if($res->num_rows == 0) {
        return null;
    }
    else {
        $user = $res->fetch_assoc();
        $uuid = explode(';', $user['uuid']);
        return ['email'=>$email, 'password'=>$user['password'], 'uuid'=>$uuid, 'devicecount'=>$user['devicecount']];
    }
}

function updateUser($email, $password, $uuid, $devicecount) {
    global $mysqli;
    $uuids = implode(';', $uuid);
    $mysqli->query("UPDATE `users` SET `password`='$password', `uuid`='$uuids', `devicecount`='$devicecount' WHERE `email`='$email'");
}

function registerUser($email, $password, $devicecount) {
    global $mysqli;
    $mysqli->query("INSERT INTO `users` (`email`, `password`, `devicecount`) VALUES ('$email', '$password', '$devicecount')");
}