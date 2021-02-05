<?php 

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../config/database.php';
include_once '../../models/plat.php';

$db = new DataBase();
$dbConn = $db->connect();

$plat = new Plat($dbConn);

$properties = json_decode(file_get_contents("php://input"));

$plat->setIdPlat($properties->idPlat);
$plat->setNom($properties->nom);
$plat->setDescripcio($properties->descripcio);
$plat->setPreu($properties->preu);
$plat->setIdSeccio($properties->idSeccio);

if ($plat->update()) {
	echo json_encode(array('result' => '1'));
} else {
	echo json_encode(array('result' => '0'));
}

?>