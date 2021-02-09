<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/plat.php';

$db = new DataBase();
$dbConn = $db->connect();

$plat = new Plat($dbConn);

if (isset($_REQUEST['idPlat'])) {
    $plat->setIdPlat($_REQUEST['idPlat']);
    $plat->delete();
} else {
	die();
}

?>