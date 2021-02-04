<?php 

<<<<<<< Updated upstream
header('Access-Control-Allow-Origin: https://admin.restaurat.me'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');

include_once '../../models/config/database.php';
=======
<<<<<<<< Updated upstream:api/controller/carta/read.php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
========
header('Access-Control-Allow-Origin: *');
>>>>>>>> Stashed changes:api/carta/read.php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');

include_once '../../config/database.php';
>>>>>>> Stashed changes
include_once '../../models/carta.php';

$db = new DataBase();
$dbConn = $db->connect();

$carta = new Carta($dbConn);
$result = $carta->read();

$cartes = array();

while ($row = $result->fetch_assoc()) {
	$cartaActual = array(
		'idCarta' => $row['idCarta'],
		'nom' => $row['nom'],
        'actiu' => $row['actiu']
	);
	array_push($cartes, $cartaActual);
}

echo json_encode($cartes);

?>