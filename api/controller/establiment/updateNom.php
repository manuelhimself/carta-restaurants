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
if (isset($_REQUEST['id']) && isset($_REQUEST['nom'])) {
    $establiment->setId($_REQUEST['id']);
    $establiment->setNom($_REQUEST['nom']);
}else{
    die();
}

//Update establiment
if ($establiment->updateNom()) {
    echo json_encode(array('result' => '1'));
} else {
    echo json_encode(array('result' => '0'));
}
