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
$result = $poblacio->getPieChartJson();

$poblacions = array();

while ($row = $result->fetch_assoc()) {
	$poblacioActual = array(
		'nom' => $row['nom'],
		'nRestaurants' => $row['nRestaurants'],
	);
	array_push($poblacions, $poblacioActual);
}

echo json_encode($poblacions);
