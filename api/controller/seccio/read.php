<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/seccio.php';

$db = new DataBase();
$dbConn = $db->connect();

$seccio = new Seccio($dbConn);
$result = $seccio->read();

$seccions = array();

while ($row = $result->fetch_assoc()) {
	$seccioActual = array(
		'idSeccio' => $row['idSeccio'],
		'nom' => $row['nom'],
        'idCarta' => $row['Carta_idCarta']
	);
	array_push($seccions, $seccioActual);
}

echo json_encode($seccions);

?>