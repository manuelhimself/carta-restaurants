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
    $_REQUEST['idEstabliment'])&&isset(
    $_REQUEST['nom'])&&isset(
    $_REQUEST['llinatges'])&&isset(
    $_REQUEST['tel'])&&isset(
    $_REQUEST['correu'])&&isset(
    $_REQUEST['dia'])&&isset(
    $_REQUEST['hora'])&&isset(
    $_REQUEST['comensals'])&&isset(
    $_REQUEST['observacions'])
) {

    $idEstabliment = $_REQUEST['idEstabliment'];
    $nom = $_REQUEST['nom'];
    $llinatges = $_REQUEST['llinatges'];
    $tlfn = $_REQUEST['tel'];
    $correu = $_REQUEST['correu'];
    $dia = $_REQUEST['dia'];
    $_date = date("Ymd", strtotime($dia));
    $hora = $_REQUEST['hora'];
    $comensals = $_REQUEST['comensals'];
    $observacions = $_REQUEST['observacions'];
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