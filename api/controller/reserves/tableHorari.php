<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');


$conn = new mysqli("localhost","root","password","restaurat");
$id = $_REQUEST['id'];
$select = $conn -> prepare("SELECT horari_obertura, horari_tancament, dia from horari where id_establiment=$id order BY dia ASC ");
$select -> execute();
$resultat = $select->get_result();
$mostrar = $resultat->fetch_all(MYSQLI_ASSOC);

echo json_encode($mostrar);
?>