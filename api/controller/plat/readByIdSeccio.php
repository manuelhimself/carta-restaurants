<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/plat.php';

$db = new DataBase();
$dbConn = $db->connect();

$plat = new Plat($dbConn);

$plats = array();

if (isset($_REQUEST['idSeccio'])) {
    $plat->setIdSeccio($_REQUEST['idSeccio']);
    $result = $plat->readBySeccio();
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
} else {
	die();
}

echo json_encode($plats);

?>