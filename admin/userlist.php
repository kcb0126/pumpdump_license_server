<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 3/4/2018
 * Time: 7:01 PM
 */

require_once '../common/response.php';

require_once '../common/verifyAdmin.php';

$users = getUserList();

successWithData($users);