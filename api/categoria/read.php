<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');

include_once '../../models/config/database.php';
include_once '../../models/categoria.php';

$db = new DataBase();
$dbConn = $db->connect();

$categoria = new categoria($dbConn);
$result = $categoria->read();

$categories = array();

while ($row = $result->fetch_assoc()) {
	$categoriaActual = array(
		'idCategoria' => $row['idCategoria'],
		'nom' => $row['nom']
	);
	array_push($categories, $categoriaActual);
}

echo json_encode($categories);

?>