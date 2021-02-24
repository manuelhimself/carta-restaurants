<?php
// Headers
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE, GET, POST');

include_once '../../models/config/database.php';
include_once '../../models/establiment.php';

//DB
$db = new DataBase();
$dbConn = $db->connect();

//Establiment object
$establiment = new establiment($dbConn);

//Get establiment properties
if(isset($_REQUEST["lat"]) && isset($_REQUEST["lng"]) && isset($_REQUEST["id"])){
    //Set establiment properties
    $establiment->setId($_REQUEST["id"]);
    $establiment->setLat($_REQUEST["lat"]);
    $establiment->setLng($_REQUEST["lng"]);
}

//Create establiment
if ($establiment->setCoordenades()) {
	echo "Coordenades canviades";
} else {
	echo json_encode(array('result' => '0'));
}
