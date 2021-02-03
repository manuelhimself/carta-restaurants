<?php 

header('Access-Control-Allow-Origin: http://admin.restaurat.me'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/carta.php';

$db = new DataBase();
$dbConn = $db->connect();

$carta = new Carta($dbConn);

if (isset($_GET['idCarta'])) {
	$carta->setIdCarta($_GET['idCarta']);
} else {
	die();
}

$_carta = $carta->readById();

echo json_encode($_carta);

?>