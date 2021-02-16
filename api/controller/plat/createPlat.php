<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/plat.php';

$db = new DataBase();
$dbConn = $db->connect();

$plat = new Plat($dbConn);

if (isset($_REQUEST['nom']) && isset($_REQUEST['descripcio']) && isset($_REQUEST['preu']) && isset($_REQUEST['idSeccio'])) {
    $plat->setNom($_REQUEST['nom']);
	$plat->setDescripcio($_REQUEST['descripcio']);
	$plat->setPreu($_REQUEST['preu']);
	$plat->setIdSeccio($_REQUEST['idSeccio']);
    $plat->createPlat();
	$last_id = $dbConn->insert_id;
} else {
	die();
}

echo json_encode(['id'=>$last_id]);

?>
