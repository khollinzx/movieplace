<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");
$dataValue = select_all_value("cart_table", "*", "user_id", $_SESSION["user_details"]->id);
$i = 1;
if ($dataValue != null) {
    foreach ($dataValue as $row) {
        $json[] = [
            "id"                => $row["id"],
            "name"              => selectField2("movies_table", "movie_title", "id", $row["movie_id"]),
            "photo"             => selectField2("movies_table", "photo", "id", $row["movie_id"]),
            "price"             => selectField2("movies_table", "price", "id", $row["movie_id"]),
        ];
        $i++;
    }

    $data = ['data' => $json];
} else {
    $data = ['data' => 'zero'];
}

echo json_encode($data);
