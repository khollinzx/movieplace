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
        "msgs" => 'Authentication Failed'
    ];

    $data['value'] = $json;

    echo json_encode($data);
    die();
}
$encodeId = json_encode(intval($decoded->data->id));

extract($_POST);
$user = new Admin();

if ($_SESSION["admin_details"]->id == $encodeId) {








    if (isset($_FILES["edit_photo"])) {
        $extensions = array("jpg", "jpeg", "png");
        $file_name = $_FILES["edit_photo"]["name"];
        $round_code = rand(100000000000, 999999999999);
        $tmp_name = $_FILES["edit_photo"]["tmp_name"];
        $file_size =  $_FILES["edit_photo"]["size"];
        $file_type =  $_FILES["edit_photo"]["type"];
        $file_extension = explode('.', $_FILES["edit_photo"]["name"]);
        $test = end($file_extension);
        $file_ext = strtolower($test);


        if (in_array($file_ext, $extensions) === false) {
            $json[] = [
                "code" => '404',
                "msgs" => 'Only documents Images allowed'
            ];

            $data['value'] = $json;

            echo json_encode($data);
            die();
        }

        if ($file_size > 2097152) {
            $json[] = [
                "code" => '404',
                "msgs" => 'File size must be exactly 2 MB'
            ];

            $data['value'] = $json;

            echo json_encode($data);
            die();
        }


        $name = $round_code . "-" . $file_name;
        $location = ROOT_PATH . "uploads/photos/" . $name;
        move_uploaded_file($tmp_name, $location);

        $unlink_file = selectField2("movies_table", "photo", "id", $edit_movie_id);
        unlink(ROOT_PATH . "uploads/photos/" . $unlink_file);
    }

    try {
        $user->update('movies_table', "id", $edit_movie_id, array(
            "movie_title"      =>    $edit_name,
            "price"            =>    $edit_price,
            "genre_id"         =>    $edit_genre_type,
            "photo"            =>    $name,
            "description"      =>    $edit_movie_description,
        ));

        $json[] = [
            "code" => '200',
            "msgs" => 'OK'
        ];

        $data['value'] = $json;

        echo json_encode($data);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {

    $json[] = [
        "code" => '404',
        "msgs" => 'Authorization Failed'
    ];

    $data['value'] = $json;

    echo json_encode($data);
}
