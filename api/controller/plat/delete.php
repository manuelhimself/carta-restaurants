<?php

<<<<<<< Updated upstream
header('Access-Control-Allow-Origin: https://admin.restaurat.me'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../models/config/database.php';
=======
<<<<<<<< Updated upstream:api/controller/plat/delete.php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
========
header('Access-Control-Allow-Origin: *');
>>>>>>>> Stashed changes:api/plat/delete.php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../config/database.php';
>>>>>>> Stashed changes
include_once '../../models/plat.php';

$db = new DataBase();
$dbConn = $db->connect();

$plat = new Plat($dbConn);

$properties = json_decode(file_get_contents("php://input"));

$plat->setIdPlat($properties->idPlat);

if ($plat->delete()) {
	echo json_encode(array('result' => '1'));
} else {
	echo json_encode(array('result' => '0'));
}

?>