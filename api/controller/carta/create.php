<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/carta.php';

$db = new DataBase();
$dbConn = $db->connect();

$carta = new Carta($dbConn);

if (isset($_REQUEST['nomCarta']) && isset($_REQUEST['idEstabliment'])) {
    $carta->setNom($_REQUEST['nomCarta']);
    $carta->setIdEstabliment($_REQUEST['idEstabliment']);
    $carta->create();
} else {
	die();
}

?>
