<?php 

header('Access-Control-Allow-Origin: https://admin.restaurat.me'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
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