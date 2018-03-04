<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 2/28/2018
 * Time: 6:38 PM
 */

function success() {
    die(json_encode(['success'=>1, 'message'=>'']));
}

function successWithData($data) {
    die(json_encode(['success'=>1, 'message'=>'', 'data'=>$data]));
}

function fail($message='') {
    die(json_encode(['success'=>0, 'message'=>$message]));
}