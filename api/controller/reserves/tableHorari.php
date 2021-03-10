<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');


$conn = new mysqli("localhost","root","password","restaurat");
$id = $_REQUEST['id'];
$select = $conn -> prepare("SELECT horari_obertura, horari_tancament, case when dia=1 then 'Diumenge' when dia=2 then 'Dilluns' when dia=3 then 'Dimarts' when 
dia=4 then 'Dimecres' when dia=5 then 'Dijous' when dia=6 then 'Divendres' else 'Dissabte'end as dia from horari where id_establiment=$id");
$select -> execute();
$resultat = $select->get_result();
$mostrar = $resultat->fetch_all(MYSQLI_ASSOC);

echo json_encode($mostrar);
?>