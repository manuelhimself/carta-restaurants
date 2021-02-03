<?php 

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://admin.restaurat.me'); 
header('Access-Control-Allow-Credentials', 'true');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization");

include_once '../../models/config/database.php';
include_once '../../models/categoria.php';

$db = new DataBase();
$dbConn = $db->connect();

$categoria = new categoria($dbConn);
$result = $categoria->read();

$categories = array();

while ($row = $result->fetch_assoc()) {
	$categoriaActual = array(
		'id' => $row['id'],
		'nom' => $row['nom']
	);
	array_push($categories, $categoriaActual);
}

echo json_encode($categories);

?>