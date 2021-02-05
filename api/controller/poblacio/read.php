<?php 

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../config/database.php';
include_once '../../models/poblacio.php';

$db = new DataBase();
$dbConn = $db->connect();

$poblacio = new poblacio($dbConn);
$result = $poblacio->read();

$poblacions = array();

while ($row = $result->fetch_assoc()) {
	$poblacioActual = array(
		'id' => $row['id'],
        'nom' => $row['nom'],
        'cp' => $row['cp']
	);
	array_push($poblacions, $poblacioActual);
}

echo json_encode($poblacions);

?>