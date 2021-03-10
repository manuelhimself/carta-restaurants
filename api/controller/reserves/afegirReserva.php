<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

$conn = new mysqli("localhost", "root", "password", "restaurat");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (
    isset(
        $_REQUEST['idEstabliment']
    ) && isset(
        $_REQUEST['dia']
    ) && isset(
        $_REQUEST['hora']
    ) && isset(
        $_REQUEST['comensals']
    ) && isset(
        $_REQUEST['observacions']
    ) && isset(
        $_REQUEST['idUsuari']
    )
) {

    $idEstabliment = $_REQUEST['idEstabliment'];
    $idUsuari = $_REQUEST['idUsuari'];
    $dia = $_REQUEST['dia'];
    $_date = date("Ymd", strtotime($dia));
    $hora = $_REQUEST['hora'];
    $comensals = $_REQUEST['comensals'];
    $observacions = $_REQUEST['observacions'];
}


$sql = "INSERT INTO reserva (Usuari_idUsuari,Establiment_id, data, num_comensals, hora, observacions) VALUES ($idUsuari,$idEstabliment,'$_date',$comensals,'$hora','$observacions')";

if ($conn->query($sql) === TRUE) {
    echo 'ok';
} else {
    echo $conn->error;
}