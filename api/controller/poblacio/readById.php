<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../models/config/database.php';
include_once '../../models/poblacio.php';

$db = new DataBase();
$dbConn = $db->connect();

$poblacio = new poblacio($dbConn);

if (isset($_REQUEST['id'])) {
	$poblacio->setId($_REQUEST['id']);
} else {
	die();
}

$result = $poblacio->readById();

$poblacio;

while ($row = $result->fetch_assoc()) {
	$poblacio = array(
		'id' => $row['id'],
		'nom' => $row['nom'],
		'cp' => $row['cp']
	);
}

echo json_encode($poblacio);
