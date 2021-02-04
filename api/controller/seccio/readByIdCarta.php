<?php 

<<<<<<< Updated upstream
header('Access-Control-Allow-Origin: https://admin.restaurat.me'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
=======
<<<<<<<< Updated upstream:api/controller/seccio/readByIdCarta.php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
========
header('Access-Control-Allow-Origin: *');
>>>>>>>> Stashed changes:api/seccio/readByIdCarta.php
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/database.php';
>>>>>>> Stashed changes
include_once '../../models/seccio.php';

$db = new DataBase();
$dbConn = $db->connect();

$seccio = new Seccio($dbConn);

$seccions = array();

if (isset($_GET['idCarta'])) {
    $seccio->setIdCarta($_GET['idCarta']);
    $result = $seccio->readByIdCarta();
    while ($row = $result->fetch_assoc()) {
        $seccioActual = array(
            'idCarta' => $row['Carta_idCarta'],
            'idSeccio' => $row['idSeccio'],
            'nom' => $row['nom']
        );
        array_push($seccions, $seccioActual);
    }
} else {
	die();
}

echo json_encode($seccions);

?>