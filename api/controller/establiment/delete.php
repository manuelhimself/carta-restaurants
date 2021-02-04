<?php
// Headers
// Headers
header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Credentials', 'true');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization");

include_once '../../models/config/database.php';
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