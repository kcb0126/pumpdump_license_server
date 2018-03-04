<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 2/28/2018
 * Time: 6:39 PM
 */

require_once '../common/response.php';

require_once '../common/verifyAdmin.php';

if(array_key_exists('email', $_POST)) {
    $email = $_POST['email'];
} else {
    fail('You must input user\'s email to register a new user.');
}

if(array_key_exists('pwd', $_POST)) {
    $pwd = $_POST['pwd'];
} else {
    fail('You must input user\'s password to register a new user.');
}

if(findUser($email) != null) {
    fail('The email is used already');
}

registerUser($email, $pwd);

success();