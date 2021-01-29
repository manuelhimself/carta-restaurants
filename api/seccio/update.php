<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

include_once '../../models/config/database.php';
include_once '../../models/seccio.php';

$db = new DataBase();
$dbConn = $db->connect();

$seccio = new Seccio($dbConn);

if (isset($_REQUEST['idSeccio'])&&isset($_REQUEST['nomSeccio'])&&isset($_REQUEST['idCarta'])) {
	$seccio->setIdSeccio($_REQUEST['idSeccio']);
	$seccio->setIdCarta($_REQUEST['idCarta']);
	$seccio->setNom($_REQUEST['nomSeccio']);
    $seccio->update();
} else {
	die();
}

?>