<?php
// Headers
<<<<<<< Updated upstream
header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Credentials', 'true');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization");

include_once '../../models/config/database.php';
=======
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Methods: GET');

include_once '../../config/database.php';
>>>>>>> Stashed changes
include_once '../../models/establiment.php';

//DB
$db = new DataBase();
$dbConn = $db->connect();

//Establiment object
$establiment = new establiment($dbConn);

if (isset($_REQUEST['id'])) {
	$establiment->setId($_REQUEST['id']);
} else {
	die();
}

//Establiments array;
$categories_arr = array();

$result = $establiment->readById();

while ($row = $result->fetch_assoc()){
    $establiment_item = array(
        'id' => $row['id'],
        'nom' => $row['nom'],
        'correu_electronic' => $row['correu_electronic'],
        'num_comensals' => $row['num_comensals'],
        'telefon' => $row['telefon'],
		'poblacio_id' => $row['Poblacio_id'],
		'descripcio' => $row['descripcio']
    );
    array_push($categories_arr, $row['id_categoria']);
}

$establiment_item['categories'] = $categories_arr;

<<<<<<< Updated upstream
header('Content-Type: application/json');
//Return JSON
echo json_encode ($establiment_item);
=======
//Return JSON
echo json_encode($establiment_item);

>>>>>>> Stashed changes
?>