<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Methods: DELETE');

$conn = new mysqli("localhost", "root", "password", "restaurat");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset(
    $_REQUEST['hora']
) && isset(
    $_REQUEST['idEstabliment']
)&& isset(
    $_REQUEST['dia']
)) {

    $idEstabliment = $_REQUEST['idEstabliment'];
    $hora = $_REQUEST['hora'];
    $dia = $_REQUEST['dia'];
}

$sql="SELECT horari.horari_obertura, horari.horari_tancament from establiment, horari WHERE 
establiment.id = horari.id_establiment and establiment.id=$idEstabliment and 
'$hora' BETWEEN (select horari.horari_obertura from horari,establiment WHERE 
establiment.id=horari.id_establiment AND horari.dia=dayofweek('$dia') and 
establiment.id=$idEstabliment) and (select horari.horari_tancament from horari,establiment WHERE 
establiment.id=horari.id_establiment and horari.dia=dayofweek('$dia') and 
establiment.id=$idEstabliment)";

$result = $conn->query($sql);

if($result->num_rows > 0){
    echo "true";
}else{
    echo 'errorHora';
}