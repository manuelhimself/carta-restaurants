<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/alergen.php';

$db = new DataBase();
$dbConn = $db->connect();

$alergen = new Alergen($dbConn);

if (isset($_REQUEST['idPlat'])) {
    $alergen->setIdPlat($_REQUEST['idPlat']);
    $alergen->deleteAllAlergenByIdPlat();
} else {
	die();
}

?>