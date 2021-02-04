<?php 

header('Access-Control-Allow-Origin: https://admin.restaurat.me'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/plat.php';

$db = new DataBase();
$dbConn = $db->connect();

$plat = new Plat($dbConn);
$result = $plat->read();

$plats = array();

while ($row = $result->fetch_assoc()) {
	$platActual = array(
		'idPlat' => $row['idPlat'],
		'nom' => $row['nom'],
        'descripcio' => $row['descripcio'],
        'preu' => $row['preu'],
        'idSeccio' => $row['Seccio_idSeccio']
	);
	array_push($plats, $platActual);
}

echo json_encode($plats);

?>