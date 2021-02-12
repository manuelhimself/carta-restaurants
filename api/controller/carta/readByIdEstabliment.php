<?php 

session_start();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');

include_once '../../models/config/database.php';
include_once '../../models/carta.php';

$db = new DataBase();
$dbConn = $db->connect();

$carta = new Carta($dbConn);

if(isset ($_SESSION ['establiment'])){
    $id = $_SESSION ['establiment'];
}else{
    die();
}

$cartes = array();


    $carta->setIdEstabliment($id);
    $result = $carta->readByIdEstabliment();
    while ($row = $result->fetch_assoc()) {
        $cartaActual = array(
            'idCarta' => $row['idCarta'],
		    'nom' => $row['nom'],
            'actiu' => $row['actiu']
        );
        array_push($cartes, $cartaActual);
    }


echo json_encode($cartes);

?>