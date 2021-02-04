<?php

<<<<<<< Updated upstream
header('Access-Control-Allow-Origin: https://admin.restaurat.me'); 
header('Access-Control-Allow-Credentials', 'true');

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../models/config/database.php';
=======
<<<<<<<< Updated upstream:api/controller/seccio/delete.php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');

========
header('Access-Control-Allow-Origin: *');
>>>>>>>> Stashed changes:api/seccio/delete.php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../config/database.php';
>>>>>>> Stashed changes
include_once '../../models/seccio.php';

$db = new DataBase();
$dbConn = $db->connect();

$seccio = new Seccio($dbConn);

$properties = json_decode(file_get_contents("php://input"));

$seccio->setIdSeccio($properties->idSeccio);

if ($seccio->delete()) {
	echo json_encode(array('result' => '1'));
} else {
	echo json_encode(array('result' => '0'));
}

?>