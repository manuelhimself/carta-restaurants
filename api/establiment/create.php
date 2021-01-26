<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

include_once '../../models/config/database.php';
include_once '../../models/establiment.php';

//DB
$db = new DataBase();
$dbConn = $db->connect();

//Establiment object
$establiment = new establiment($dbConn);

//Get establiment properties
$properties = json_decode(file_get_contents("php://input"));

//Set establiment properties
//Set establiment properties
$establiment->setId($properies->id);
$establiment->setNom($properies->nom);
$establiment->setCorreu_electronic($properies->correu_electronic);
$establiment->setNum_comensals($properies->num_comensals);
$establiment->setTelefon($properies->telefon);
$establiment->setPoblacio_id($properies->poblacio_id);
$establiment->setPassword($properies->password);

//Create establiment
if ($establiment->create()) {
	echo json_encode(array('result' => '1'));
} else {
	echo json_encode(array('result' => '0'));
}

?>