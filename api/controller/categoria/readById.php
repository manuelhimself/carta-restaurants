<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../models/config/database.php';
include_once '../../models/categoria.php';

$db = new DataBase();
$dbConn = $db->connect();

$categoria = new categoria($dbConn);
$result = $categoria->readById();


while ($row = $result->fetch_assoc()) {
	$categoria = array(
		'id' => $row['id'],
		'nom' => $row['nom']
	);
}

echo json_encode($categoria);
