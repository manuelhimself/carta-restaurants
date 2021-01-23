<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

include_once '../../models/database.php';
include_once '../../models/establiment.php';

//DB
$db = new DataBase();
$dbConn = $db->connect();

//Establiment object
$establiment = new establiment($dbConn);
$result = $establiment->readById();

//Establiments array;
$establiments_arr = array();

while ($row = $result->fetch_assoc()){
    $establiment_item = array(
        'id' => $row['id'],
        'nom' => $row['com'],
        'correu_electronic' => $row['correu_electronic'],
        'num_comensals' => $row['num_comensals'],
        'telefon' => $row['telefon'],
        'poblacio_id' => $row['poblacio_id'],
        'password' => $row['password'],
    );
    array_push($establiments_arr, $establiment_item);
}

//Return JSON
json_encode($establiments_arr);

?>