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
    $_REQUEST['data']
) && isset(
    $_REQUEST['idEstabliment']
) && isset(
    $_REQUEST['comensals']
)) {

    $idEstabliment = $_REQUEST['idEstabliment'];
    $comensals = $_REQUEST['comensals'];
    $data = $_REQUEST['data'];
}

$sql = "SELECT if(((select COALESCE(sum(num_comensals),0) from reserva WHERE data = '$data' and reserva.Establiment_id = $idEstabliment) + $comensals) <= 
(select num_comensals from establiment where id=$idEstabliment), 'si', 'no') as result";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row['result'] == 'si'){
        echo 'true';
    }else{
        echo 'errorComensals';
    }
} else {
    echo 'errorComensals';
}
