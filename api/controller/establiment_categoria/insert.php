<?php

// Headers
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once '../../models/config/database.php';
include_once '../../models/establiment_categoria.php';

//DB
$db = new DataBase();
$dbConn = $db->connect();

//Establiment object
$establiment_categoria = new establiment_categoria($dbConn);

//Get establiment_categoria properties
if (isset($_REQUEST['Establiment_id']) && isset($_REQUEST['Categoria_id'])) {
    $establiment_categoria->setEstabliment_id($_REQUEST['Establiment_id']);
    $establiment_categoria->setCategoria_id($_REQUEST['Categoria_id']);
}else{
    die();
}

//Update establiment
if($establiment_categoria->insert()){
    echo json_encode(array('result' => '1'));
} else{
    echo json_encode(array('result' => '0'));
}
?>