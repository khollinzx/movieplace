<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");

require ROOT_PATH . "vendor/autoload.php";

use \Firebase\JWT\JWT;

header('Content-Type: application/json');

$headers = apache_request_headers();

$token = $headers['Authorization'];

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
        $value = selectValueCount('cart_table', 'user_id', $_SESSION['user_details']->id);

        if ($value != null) {
            $output = '';
            $output .= '<sup class="badge badge-danger top">' . $value . '</sup>';

            echo json_encode($output);
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
}
