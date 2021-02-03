<?php 

header('Access-Control-Allow-Origin: https://admin.restaurat.me'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/seccio.php';

$db = new DataBase();
$dbConn = $db->connect();

$seccio = new Seccio($dbConn);

if (isset($_GET['idSeccio'])) {
	$seccio->setIdSeccio($_GET['idSeccio']);
} else {
	die();
}

$_seccio = $seccio->readByIdSeccio();

echo json_encode($_seccio);

?>