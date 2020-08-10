<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");

session_destroy();

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
$validate = new Validation();
$validateEmail = $validate->validate_email_domain($email_address);

if ($validateEmail === true) {
    if (strlen(trim($password)) <= 5) {
        $json[] = [
            "code" => '404',
            "msgs" => 'Maximum of 6 Characters is Required',
            "token" => null
        ];
        $data['value'] = $json;
        echo json_encode($data);
        die();
    }

    try {

        $checkIfExist = selectExistUser('users_table', 'email', $email_address);

        if ($checkIfExist !== 0) {
            $json[] = [
                "code" => '400',
                "msgs" => 'User already exist',
                "token" => null
            ];

            $data['value'] = $json;

            echo json_encode($data);
            die();
        } else {


            $userDetails = new UserDetails();
            $userDetails->full_name = $full_name;
            $userDetails->date_of_birth =  $date_of_birth;
            $userDetails->address = '';
            $userDetails->phone_no = '';

            $dob = strtotime($date_of_birth);
            $today_date = strtotime(date("Y-m-d"));

            // Formulate the Difference between two dates 
            $diff = abs($today_date - $dob);

            // To get the year divide the resultant date into 
            // total seconds in a year (365*60*60*24) 
            $years = floor($diff / (365 * 60 * 60 * 24));

            if ($years >= 18) {
                $user =  new Admin();
                $user->create("users_table", array(
                    "email"                         =>       $email_address,
                    "age"                           =>       $years,
                    "password"                         =>       Hash::make($password),
                    "user_details"                     =>        json_encode($userDetails),
                    "token_id"                        =>        Token::generate(),
                    "created_at"                        =>        date("Y-m-d H:i:s")
                ));

                $remember = (Input::get('remember') === 'on') ? true : false;
                $login = $user->login($email_address, $password, $remember, "users_table", "email");

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

                    $_SESSION["user_details"] = $user->data();

                    $json[] = [
                        "code" => '200',
                        "msgs" => 'OK',
                        "token" => $jwtToken
                    ];

                    $data['value'] = $json;

                    echo json_encode($data);
                }
            } else {
                $json[] = [
                    "code" => '400',
                    "msgs" => 'Your not up to 18+',
                    "token" => null
                ];

                $data['value'] = $json;

                echo json_encode($data);
                die();
            }
        }
    } catch (Exception $e) {
        die($e->getMessage());
    }
} else {
    $json[] = [
        "code" => '400',
        "msgs" => 'Invalid Email Address',
        "token" => null
    ];

    $data['value'] = $json;

    echo json_encode($data);
    die();
}
