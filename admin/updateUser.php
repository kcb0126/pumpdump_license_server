<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 3/4/2018
 * Time: 6:21 PM
 */

require_once '../common/response.php';

require_once '../common/verifyAdmin.php';

if(array_key_exists('email', $_POST)) {
    $email = $_POST['email'];
} else {
    fail('You must input user\'s email to register a new user.');
}

$user = findUser($email);

if($user == null) {
    fail('The email is not registered.');
}

if(array_key_exists('newemail', $_POST)) {
    $newemail = $_POST['newemail'];
} else {
    $newemail = $email;
}

if(array_key_exists('newpassword', $_POST)) {
    $newpassword = $_POST['newpassword'];
} else {
    $newpassword = $user['password'];
}
if($newpassword === '') {
    $newpassword = $user['password'];
}

if(array_key_exists('refresh', $_POST)) {
    $refresh = $_POST['refresh'];
} else {
    $refresh = false;
}
$uuid = $refresh ? '' : $user['uuid'];

updateUser($email, $newpassword, $uuid, $newemail);

success();