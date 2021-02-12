<?php 

session_start();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/carta.php';

$db = new DataBase();
$dbConn = $db->connect();

$carta = new Carta($dbConn);

if(isset ($_SESSION ['establiment'])){
    $id = $_SESSION ['establiment'];
}else{
    die();
}

if (isset($_REQUEST['nomCarta'])) {
    $carta->setNom($_REQUEST['nomCarta']);
    $carta->setIdEstabliment($id);
    $carta->create();
} else {
	die();
}

?>
