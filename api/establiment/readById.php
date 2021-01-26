<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

include_once '../../models/config/database.php';
include_once '../../models/establiment.php';

//DB
$db = new DataBase();
$dbConn = $db->connect();

//Establiment object
$establiment = new establiment($dbConn);

if (isset($_REQUEST['id'])) {
	$establiment->setId($_REQUEST['id']);
} else {
	die();
}

$result = $establiment->readById();

//Return JSON
echo json_encode($result);

?>