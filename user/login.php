<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 2/28/2018
 * Time: 6:37 PM
 */

require_once '../common/response.php';
require_once '../common/dbmanager.php';

if(array_key_exists('email', $_POST)) {
    $email = $_POST['email'];
} else {
    fail('You must input user\'s email to log in');
}

if(array_key_exists('password', $_POST)) {
    $password = $_POST['password'];
} else {
    fail('You must input user\'s password to log in');
}

if(array_key_exists('uuid', $_POST)) {
    $uuid = $_POST['uuid'];
} else {
    fail('You must input user\'s uuid to log in');
}

$user = findUser($email);

if($user != null) {
    if($user['password'] != $password) {
        fail('Password is incorrect');
    }

    $cnt = 0;
    if ($user['uuid'] == $uuid) {
        success();
    } else if($user['uuid'] == '') {
        updateUser($email, $user['password'], $user['uuid']);
    } else {
        fail('This is a new device and you cannot use it');
    }
} else {
    fail('The user does not exist');
}

success();