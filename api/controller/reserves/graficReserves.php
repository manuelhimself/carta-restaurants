<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

session_start();


$id=$_REQUEST['id'];

$conn = new mysqli("localhost","root","password","restaurat");
$select = $conn -> prepare("SELECT MONTHNAME(reserva.data) as mes, COUNT(id_reserva) as suma FROM reserva WHERE reserva.Establiment_id=$id GROUP BY MONTHNAME(reserva.data)");
$select -> execute();
$resultat = $select->get_result();
$mostrar = $resultat->fetch_all(MYSQLI_ASSOC);

echo json_encode($mostrar);
?>

