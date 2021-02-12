<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

include_once '../../models/config/database.php';
include_once '../../models/plat.php';

$db = new DataBase();
$dbConn = $db->connect();

$plat = new Plat($dbConn);

if (isset($_REQUEST['idPlat'])&&isset($_REQUEST['nom'])&&isset($_REQUEST['descripcio'])&&isset($_REQUEST['preu'])) {
	$plat->setIdPlat($_REQUEST['idPlat']);
	$plat->setNom($_REQUEST['nom']);
	$plat->setDescripcio($_REQUEST['descripcio']);
	$plat->setPreu($_REQUEST['preu']);
    $plat->update();
} else {
	die();
}

?>