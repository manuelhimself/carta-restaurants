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

//Get establiment properties
$properties = json_decode(file_get_contents("php://input"));

//Set establiment id
$establiment->setId($properties->id);

//Delete establiment
if ($establiment->delete()){
    echo json_encode(array('result' => '1'));
} else {
	echo json_encode(array('result' => '0'));
}
?>