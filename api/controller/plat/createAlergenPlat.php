<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/carta.php';

$db = new DataBase();
$dbConn = $db->connect();

$plat = new Plat($dbConn);

if (isset($_REQUEST['idPlat']) && isset($_REQUEST['idAlergen'])) {
	$plat->setIdPlat($_REQUEST['idPlat']);
    $plat->setIdAlergen($_REQUEST['idAlergen']);
    $plat->createAlergenPlat();
} else {
	die();
}

?>