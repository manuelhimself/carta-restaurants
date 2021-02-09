<?php
// Headers
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../config/database.php';
include_once '../../models/establiment__categoria.php';

//DB
$db = new DataBase();
$dbConn = $db->connect();

//establiment_categoria object
$establiment_categoria = new establiment_categoria($dbConn);

//Get establiment_categoria properties
$properties = json_decode(file_get_contents("php://input"));

//Set establiment_categoria id
$establiment_categoria->setEstabliment_id($properties->Establiment_id);

//Delete establiment_categoria
if ($establiment_categoria->delete()){
    echo json_encode(array('result' => '1'));
} else {
	echo json_encode(array('result' => '0'));
}
?>