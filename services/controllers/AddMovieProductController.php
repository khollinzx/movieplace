<?php
// This controller is used to add new movie values to the movie table
ini_set('display_errors', 1);
require_once("../../starter/header.php");

// requiring firebase/php-jwt dependencies
require ROOT_PATH . "vendor/autoload.php";

// using the dependency
use \Firebase\JWT\JWT;

// declearing the content to be a JSON format
header('Content-Type: application/json');

// calling the HTTP headers
$headers = apache_request_headers();

// extracting the token from the headers
$token = $headers['Authorization'];

// converting the string object to a string varaible
$jwt = strval($token);

// decoding the token
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

// extracting the user id from the jwt token and encoding it to a json string
$encodeId = json_encode(intval($decoded->data->id));

// extracting the POST variables
extract($_POST);

// initiliazing the Admin class
$user = new Admin();

// checking if the session user id is equal to the token user id
if ($_SESSION["admin_details"]->id == $encodeId) {


    // checking if POST contains a file
    if (isset($_FILES["photo"])) {
        $extensions = array("jpg", "jpeg", "png");
        $file_name = $_FILES["photo"]["name"];
        $round_code = rand(100000000000, 999999999999);
        $tmp_name = $_FILES["photo"]["tmp_name"];
        $file_size =  $_FILES["photo"]["size"];
        $file_type =  $_FILES["photo"]["type"];
        $file_extension = explode('.', $_FILES["photo"]["name"]);
        $test = end($file_extension);
        $file_ext = strtolower($test);


        // validating if file is an images
        if (in_array($file_ext, $extensions) === false) {
            $json[] = [
                "code" => '404',
                "msgs" => 'Only Images allowed (jpeg, jpg, png)'
            ];

            $data['value'] = $json;

            echo json_encode($data);
            die();
        }

        // vaidatig if file is above 2MB
        if ($file_size > 2097152) {
            $json[] = [
                "code" => '404',
                "msgs" => 'File size must be exactly 2 MB'
            ];

            $data['value'] = $json;

            echo json_encode($data);
            die();
        }

// Ecrypting the image name and moving file to the require Directory
        $name = $round_code . "-" . $file_name;
        $location = ROOT_PATH . "uploads/photos/" . $name;
        move_uploaded_file($tmp_name, $location);
    }

    try {
        // saving POST variables
        $user->create('movies_table', array(
            "movie_title"      =>    $productTitle,
            "price"            =>    $price,
            "genre_id"         =>    $genre_type,
            "photo"            =>    $name,
            "description"      =>    $description,
            "token_id"         =>    Token::generate(),
            "created_at"       =>    date("Y-m-d")
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
