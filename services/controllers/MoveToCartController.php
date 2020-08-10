<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");

require ROOT_PATH . "vendor/autoload.php";

use \Firebase\JWT\JWT;

header('Content-Type: application/json');

$headers = apache_request_headers();

$token = $headers['Authorization'];

if (isset($_POST["movie_id"])) {
    $movie_id = $_POST["movie_id"];
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

        $checkMovie = checkIfMovieExist("cart_table", "user_id", $_SESSION["user_details"]->id, "movie_id", $movie_id);

        if ($checkMovie > 0) {
            $json[] = [
                "code" => '400',
                "msgs" => 'Product Already Exist in Cart'
            ];

            $data['value'] = $json;

            echo json_encode($data);
            die();
        } else {
            $user->create("cart_table", array(
                "movie_id"                         =>       $movie_id,
                "user_id"                         =>       $_SESSION["user_details"]->id,
                "price"                         =>       selectField2("movies_table", "price", "id", $movie_id),
            ));

            $json[] = [
                "code" => '200',
                "msgs" => 'Product Has Been Added to Cart'
            ];

            $data['value'] = $json;

            echo json_encode($data);
            die();
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
} else {

    $json[] = [
        "code" => '404',
        "msgs" => 'Not Authorized'
    ];

    $data['value'] = $json;

    echo json_encode($data);
    die();
}
