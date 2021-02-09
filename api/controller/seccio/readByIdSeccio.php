<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/seccio.php';

$db = new DataBase();
$dbConn = $db->connect();

$seccio = new Seccio($dbConn);

if (isset($_REQUEST['idSeccio'])) {
	$seccio->setIdSeccio($_REQUEST['idSeccio']);
} else {
	die();
}

$_seccio = $seccio->readByIdSeccio();

echo json_encode($_seccio);

?>