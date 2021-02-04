<?php 

<<<<<<< Updated upstream
header('Access-Control-Allow-Origin: https://admin.restaurat.me'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
=======
<<<<<<<< Updated upstream:api/controller/seccio/read.php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
========
header('Access-Control-Allow-Origin: *');
>>>>>>>> Stashed changes:api/seccio/read.php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/database.php';
>>>>>>> Stashed changes
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