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

function changeAdmin($newname, $newpassword) {
    global $mysqli;
    $mysqli->query("UPDATE `admin` SET `name`='$newname', `password`='$newpassword' WHERE TRUE");
}

function findUser($email) {
    global $mysqli;
    $res = $mysqli->query("SELECT `email`, `password`, `uuid` FROM `users` WHERE `email`='$email'");

    if($res->num_rows == 0) {
        return null;
    }
    else {
        $user = $res->fetch_assoc();
        return ['email'=>$email, 'password'=>$user['password'], 'uuid'=>$user['uuid']];
    }
}

function getUserList() {
    global $mysqli;
    $res = $mysqli->query("SELECT `email`, `password`, `uuid` FROM `users` WHERE TRUE");
    $users = [];
    while($row=$res->fetch_assoc()) {
        $users[] = ['email'=>$row['email'], 'password'=>$row['password'], 'uuid'=>$row['uuid']];
    }
    return $users;
}

function getUserListTest() {
    global $mysqli;
    $res = $mysqli->query("SELECT `email`, `password`, `uuid` FROM `users` WHERE TRUE");
    print_r($res->num_rows);
    while($row=$res->fetch_assoc()) {
        $users[] = ['email'=>$row['email'], 'password'=>$row['password'], 'uuid'=>$row['uuid']];
    }
    return $users;
}

function updateUser($email, $password, $uuid, $newemail=null) {
    global $mysqli;
    if($newemail == null) {
        $newemail = $email;
    }
    $mysqli->query("UPDATE `users` SET `email`='$newemail', `password`='$password', `uuid`='$uuid' WHERE `email`='$email'");
}

function registerUser($email, $password) {
    global $mysqli;
    $mysqli->query("INSERT INTO `users` (`email`, `password`) VALUES ('$email', '$password')");
}