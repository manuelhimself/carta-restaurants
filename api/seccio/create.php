<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once '../../models/config/database.php';
include_once '../../models/seccio.php';

$db = new DataBase();
$dbConn = $db->connect();

$seccio = new Seccio($dbConn);


$properties = json_decode(file_get_contents("php://input"));


$seccio->setIdSeccio($properties->idSeccio);
$seccio->setNom($properties->nom);
$seccio->setIdCarta($properties->$idCarta);


if ($seccio->create()) {
	echo json_encode(array('result' => '1'));
} else {
	echo json_encode(array('result' => '0'));
}

?>