<?php 

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

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