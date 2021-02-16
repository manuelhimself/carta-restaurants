<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/alergen.php';

$db = new DataBase();
$dbConn = $db->connect();

$alergen = new Alergen($dbConn);

$alergens = array();

if (isset($_REQUEST['idPlat'])) {
    $alergen->setIdPlat($_REQUEST['idPlat']);
    $result = $alergen->readByIdPlat();
    while ($row = $result->fetch_assoc()) {
        $alergenActual = array(
            'idAlergen' => $row['Alergen_id']
        );
        array_push($alergens, $alergenActual);
    }
} else {
	die();
}

echo json_encode($alergens);

?>