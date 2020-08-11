<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");
$dataValue = select_all("movies_table");
$i = 1;
if ($dataValue != null) {
    foreach ($dataValue as $row) {
        $json[] = [
            "index"             => $i,
            "id"                => $row["id"],
            "photo"                => $row["photo"],
            "description"                => $row["description"],
            "name"              => $row["movie_title"],
            "genre"             => selectField2("genre_table", "genre_name", "id", $row["genre_id"]),
            "price"             => $row["price"]
        ];
        $i++;
    }

    $data = ['data' => $json];
} else {
    $data = ['data' => 'zero'];
}




echo json_encode($data);
