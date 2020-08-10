<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");

require ROOT_PATH . "vendor/autoload.php";

use \Firebase\JWT\JWT;

header('Content-Type: application/json');

$headers = apache_request_headers();

$token = $headers['Authorization'];

if (!isset($_POST)) {
    $json[] = [
        "code" => '404',
        "msgs" => 'Input Not Found',
        "token" => null
    ];

    $data['value'] = $json;

    echo json_encode($data);
    die();
}

$jwt = strval($token);
$decoded = JWT::decode($jwt, $key, array('HS256'));

if (!$decoded) {
    $json[] = [
        "code" => '400',
        "msgs" => 'Authentication Failed',
        "token" => null
    ];

    $data['value'] = $json;

    echo json_encode($data);
    die();
}
$encodeId = json_encode(intval($decoded->data->id));

if ($_SESSION["user_details"]->id == $encodeId) {
    try {
        $user =  new Admin();
        $userDetails = new UserDetails();
        $uservalue = $userDetails->store_post($_POST);

        $user->update('users_table', "id",  $_SESSION["user_details"]->id, array(
            "user_details"                     =>        json_encode($uservalue),
        ));

        $findUser = $user->find($_SESSION["user_details"]->email, "users_table", "email");

        if ($findUser === true) {
            $_SESSION["user_details"] = $user->data();
        }

        $json[] = [
            "code" => '200',
            "msgs" => 'OK'
        ];

        $data['value'] = $json;

        echo json_encode($data);
    } catch (Exception $e) {
        die($e->getMessage());
    }
} else {

    $json[] = [
        "code" => '404',
        "msgs" => 'Not Authorized',
        "token" => null
    ];

    $data['value'] = $json;

    echo json_encode($data);
}
