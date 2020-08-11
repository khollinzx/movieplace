<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");

// 
unset($_SESSION['user_details']);
unset($_SESSION['admin_details']);

require ROOT_PATH . "vendor/autoload.php";

use \Firebase\JWT\JWT;

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

extract($_POST);
$user = new Admin();

try {

    $remember = (Input::get('remember') === 'on') ? true : false;
    $login = $user->login($email_address, $password, $remember, "admin_table", "email");

    if ($login === true) {
        $user_metadata = array(
            $payload,
            "data" => array(
                "id" => $user->data()->id,
                "email" => $user->data()->email,
                "token_id" => $user->data()->token_id
            )
        );

        $jwtToken = JWT::encode($user_metadata, $key);

        $_SESSION['admin_details'] = $user->data();
        $json[] = [
            "code" => '200',
            "msgs" => 'OK',
            "token" => $jwtToken
        ];

        $data['value'] = $json;

        echo json_encode($data);
    } else {
        $json[] = [
            "code" => '400',
            "msgs" => 'Invalid Email Or Password',
            "token" => null
        ];

        $data['value'] = $json;

        echo json_encode($data);
    }
} catch (Exception $e) {
    die($e->getMessage());
}
