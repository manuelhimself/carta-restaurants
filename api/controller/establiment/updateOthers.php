<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../models/config/database.php';
include_once '../../models/establiment.php';

//DB
$db = new DataBase();
$dbConn = $db->connect();

//Establiment object
$establiment = new establiment($dbConn);

//Get establiment properties
//Get establiment properties
if (
    isset($_REQUEST['id']) && isset($_REQUEST['correu_electronic']) &&
    isset($_REQUEST["num_comensals"]) && isset($_REQUEST["telefon"]) &&
    isset($_REQUEST["poblacio_id"])
) {
    //Set establiment properties
    $establiment->setId($_REQUEST['id']);
    $establiment->setCorreu_electronic($_REQUEST['correu_electronic']);
    $establiment->setNum_comensals($_REQUEST["num_comensals"]);
    $establiment->setTelefon($_REQUEST["telefon"]);
    $establiment->setPoblacio_id($_REQUEST["poblacio_id"]);
} else {
    die();
}

//Update establiment
if ($establiment->updateOthers()) {
    echo json_encode(array('result' => '1'));
} else {
    echo json_encode(array('result' => '0'));
}
