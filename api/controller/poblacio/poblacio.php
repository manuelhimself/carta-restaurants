<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

$conn = new mysqli("localhost","root","password","restaurat");
$select = $conn -> prepare("SELECT * from poblacio ");
$select -> execute();
$resultat = $select->get_result();
$mostrar = $resultat->fetch_all(MYSQLI_ASSOC);

echo json_encode($mostrar);
?>