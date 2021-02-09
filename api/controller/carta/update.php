<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

include_once '../../models/config/database.php';
include_once '../../models/carta.php';

$db = new DataBase();
$dbConn = $db->connect();

$carta = new Carta($dbConn);

if (isset($_REQUEST['idCarta'])&&isset($_REQUEST['nomCarta'])) {
	$carta->setIdCarta($_REQUEST['idCarta']);
	$carta->setNom($_REQUEST['nomCarta']);
    $carta->update();
} else {
	die();
}

?>