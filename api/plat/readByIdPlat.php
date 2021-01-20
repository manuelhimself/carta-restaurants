<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/database.php';
include_once '../../models/plat.php';

$db = new DataBase();
$dbConn = $db->connect();

$plat = new Plat($dbConn);

if (isset($_GET['idPlat'])) {
	$plat->setIdPlat($_GET['idPlat']);
} else {
	die();
}

$_plat = $plat->readById();

echo json_encode($_plat);

?>