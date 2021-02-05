<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../config/database.php';
include_once '../../models/carta.php';

$db = new DataBase();
$dbConn = $db->connect();

$carta = new Carta($dbConn);

$properties = json_decode(file_get_contents("php://input"));

$carta->setIdCarta($properties->idCarta);

if ($carta->delete()) {
	echo json_encode(array('result' => '1'));
} else {
	echo json_encode(array('result' => '0'));
}

?>