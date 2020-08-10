<?php
ini_set('display_errors', 1);
require_once("../../starter/header.php");
$dataValue = select_all("genre_table");

if ($dataValue != null) {
    foreach ($dataValue as $row) {
        $json[] = [
            "id"                => $row["id"],
            "name"     => $row["genre_name"],
            "count"            => selectValueCount("movies_table", "genre_id", $row["id"])
        ];
    }

    $data = ['data' => $json];
} else {
    $data = ['data' => 'zero'];
}




echo json_encode($data);
