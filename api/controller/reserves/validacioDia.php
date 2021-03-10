<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

$conn = new mysqli("localhost", "root", "password", "restaurat");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_REQUEST['idEstabliment']) && isset($_REQUEST['dia'])) {

    $idEstabliment = $_REQUEST['idEstabliment'];
    $dia = $_REQUEST['dia'];

    $sql = "SELECT DISTINCT dia FROM horari WHERE dayofweek('$dia')=dia and id_establiment=$idEstabliment and '$dia'>=curdate()";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        echo "true";
    }else{
        echo 'errorDia';
    }
}
