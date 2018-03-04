<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 2/28/2018
 * Time: 6:42 PM
 */

require_once '../common/response.php';

require_once '../common/verifyAdmin.php';

if(array_key_exists('newname', $_POST)) {
    $newname = $_POST['newname'];
} else {
    fail('You must input new name.');
}

if(array_key_exists('newpassword', $_POST)) {
    $newpassword = $_POST['newpassword'];
} else {
    fail('You must input new password');
}

changeAdmin($newname, $newpassword);

success();