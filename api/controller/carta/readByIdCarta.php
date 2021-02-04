<?php 

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../config/database.php';
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