<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");

require ROOT_PATH . "vendor/autoload.php";

use \Firebase\JWT\JWT;

header('Content-Type: application/json');

$headers = apache_request_headers();

$token = $headers['x_auth_token'];

if (isset($_POST["movie_id"])) {
    $movie_id = $_POST["movie_id"];
}

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

if ($_SESSION["user_details"]->id == $encodeId) {

    if (!$_SERVER['REQUEST_METHOD'] == 'POST' || !isset($_POST['reference'])) {
        die("Transaction reference not found");
    }

    $accountID = 1;
    //set reference to a variable @ref
    $reference = $_POST['reference'];

    //The parameter after verify/ is the transaction reference to be verified
    $url = 'https://api.paystack.co/transaction/verify/' . $reference;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        [
            'Authorization: Bearer sk_test_c580a643eee31e5021d93899b1adb19beb1316ca'
        ]
    );

    //send request
    $request = curl_exec($ch);
    //close connection
    curl_close($ch);
    //declare an array that will contain the result 
    $result = array();

    if ($request) {
        $result = json_decode($request, true);
    }

    if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
        //Perform necessary action


        $amount = substr($result['data']['amount'], 0, (strlen($result['data']['amount'])) - 2);
        $gateway_response = $result['data']['gateway_response'];
        $transaction_id = substr($reference, 1);
        $token_id = $_SESSION["user_details"]->token_id;
        $user_id = $_SESSION["user_details"]->id;
        $paid_at = substr($result['data']['paid_at'], 0, 10);


        if ($gateway_response == "Successful") {
            $user = new Admin();

            $status = 1;

            try {
                $user->create('purchase_table', array(
                    "bag_id"                     =>    $transaction_id,
                    "bag_token"                     =>    Token::generate(),
                    "amount"                 =>    $amount,
                    "user_id"                 =>    $user_id,
                    "purchase_date"                 =>    $paid_at,
                ));

                $cartItems = select_all_value("cart_table", "*", "user_id", $user_id);
                foreach ($cartItems as $value) {
                    $user->create('items_table', array(
                        "user_id"                     =>    $user_id,
                        "movie_id"                     =>    $value["movie_id"],
                        "price"                 =>    $value["movie_id"],
                        "trans_date"                 =>    $paid_at,
                        "status"                 =>    $status,
                        "purchase_id"                 =>    $transaction_id,
                    ));
                }

                $user->delete("cart_table", "user_id", $user_id);

                echo json_encode(['success' => 'true']);
            } catch (Exception $e) {
                //throw $th;
                die($e->getMessage());
            }
        }
    } else {


        echo json_encode(['error' => 'false']);

        die();
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
