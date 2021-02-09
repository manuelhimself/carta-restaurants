<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/alergen.php';

$db = new DataBase();
$dbConn = $db->connect();

$carta = new Alergen($dbConn);
$result = $carta->read();

$alergens = array();

while ($row = $result->fetch_assoc()) {
	$alergenActual = array(
		'idAlergen' => $row['id'],
		'nom' => $row['nom'],
	);
	array_push($alergens, $alergenActual);
}

echo json_encode($alergens);

?>