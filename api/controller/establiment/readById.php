<?php
session_start();
// Headers
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../models/config/database.php';
include_once '../../models/establiment.php';

//DB
$db = new DataBase();
$dbConn = $db->connect();

//Establiment object
$establiment = new establiment($dbConn);

if(isset($_REQUEST['id'])){
    $establiment->setId($_REQUEST ['id']);
}else{
    die();
}

//Establiments array;
$categories_arr = array();

$result = $establiment->readById();

while ($row = $result->fetch_assoc()){
    $establiment_item = array(
        'id' => $row['id'],
        'nom' => $row['nom'],
        'correu_electronic' => $row['correu_electronic'],
        'num_comensals' => $row['num_comensals'],
        'telefon' => $row['telefon'],
		'poblacio_id' => $row['Poblacio_id'],
		'descripcio' => $row['descripcio'],
        'lat' => $row['lat'],
        'lng' => $row['lng']
    );
    array_push($categories_arr, $row['id_categoria']);
}

$establiment_item['categories'] = $categories_arr;

//Return JSON
echo json_encode($establiment_item);
?>