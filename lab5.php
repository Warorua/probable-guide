<?php
include './includes/core_identity.php';

$tokenObj = json_decode(myToken(), true);
if (isset($tokenObj['data']['generateToken']['token'])) {
    $token = $tokenObj['data']['generateToken']['token'];
    echo GetCustomerInfo($token) . '<br/><br/>';
    echo queryMyNumbers($token) . '<br/><br/>';
} else {
    $token = 'unavailable';
}


