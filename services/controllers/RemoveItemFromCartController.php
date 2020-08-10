<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");

require ROOT_PATH . "vendor/autoload.php";

use \Firebase\JWT\JWT;

header('Content-Type: application/json');

$headers = apache_request_headers();

$token = $headers['Authorization'];

if (isset($_POST["cart_id"])) {
    $cart_id = $_POST["cart_id"];
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

        $user->delete("cart_table", "id", $cart_id);

        $json[] = [
            "code" => '200',
            "msgs" => 'Product Removed From Cart'
        ];

        $data['value'] = $json;

        echo json_encode($data);
        die();
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
    die();
}
