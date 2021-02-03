<?php 

header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Credentials', 'true');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization");

include_once '../../models/config/database.php';
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