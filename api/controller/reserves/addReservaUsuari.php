<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

$conn = new mysqli("localhost", "root", "password", "restaurat");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset(
    $_GET['idEstabliment'])&&isset(
    $_GET['nom'])&&isset(
    $_GET['llinatges'])&&isset(
    $_GET['tel'])&&isset(
    $_GET['correu'])&&isset(
    $_GET['dia'])&&isset(
    $_GET['hora'])&&isset(
    $_GET['comensals'])&&isset(
    $_GET['observacions'])
) {

    $idEstabliment = $_GET['idEstabliment'];
    $nom = $_GET['nom'];
    $llinatges = $_GET['llinatges'];
    $tlfn = $_GET['tel'];
    $correu = $_GET['correu'];
    $dia = $_GET['dia'];
    $_date = date("Ymd", strtotime($dia));
    $hora = $_GET['hora'];
    $comensals = $_GET['comensals'];
    $observacions = $_GET['observacions'];
}

$sql = "INSERT INTO usuari (nom,llinatge,telefon,correu) VALUES ('$nom','$llinatges',$tlfn,'$correu')";
echo $sql;

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;

    $sql1 = "INSERT INTO reserva (Usuari_idUsuari,Establiment_id, data, num_comensals, hora, observacions) VALUES ($last_id,$idEstabliment,'$_date',$comensals,'$hora','$observacions')";
    echo $sql1;

    if ($conn->query($sql1) === TRUE) {

    } else {
        
    }
} else {
    
}