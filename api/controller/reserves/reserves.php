<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');

$d = $_REQUEST['data'];
$_date = date("Ymd", strtotime($d));

if(isset ($_SESSION ['establiment'])){
    $id = $_SESSION ['establiment'];
}else{
    echo 'inci de sesio no valid';
}


$conn = new mysqli("localhost","root","password","restaurat");
$query = "SELECT usuari.nom, reserva.hora, reserva.data, reserva.num_comensals 
FROM usuari, reserva, establiment 
where reserva.Establiment_id = establiment.id and usuari.idUsuari = reserva.Usuari_idUsuari and establiment.id = ? and reserva.data = ?;";
$stmt = $conn->prepare($query);
$stmt->bind_param('is', $id, $_date);
$stmt->execute();
$result = $stmt->get_result();

$reserves = array();

while ($row = $result->fetch_assoc()) {
    $reservaActual = array(
        'nomUsuari' => $row['nom'],
        'hora' => $row['hora'],
        'data' => $row['data'],
        'comensals' => $row['num_comensals']
    );
    array_push($reserves, $reservaActual);
}

echo json_encode($reserves);

?>