<?php 

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../models/config/database.php';
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