<?php
// Headers
<<<<<<< Updated upstream
// Headers
header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Credentials', 'true');
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization");

include_once '../../models/config/database.php';
=======
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

include_once '../../config/database.php';
>>>>>>> Stashed changes
include_once '../../models/establiment.php';

//DB
$db = new DataBase();
$dbConn = $db->connect();

//Establiment object
$establiment = new establiment($dbConn);
$result = $establiment->read();

//Establiments array;
$establiments_arr = array();

while ($row = $result->fetch_assoc()){
    $establiment_item = array(
        'id' => $row['id'],
        'nom' => $row['nom'],
        'correu_electronic' => $row['correu_electronic'],
        'num_comensals' => $row['num_comensals'],
        'telefon' => $row['telefon'],
        'poblacio_id' => $row['Poblacio_id'],
        'password' => $row['password']
    );
    array_push($establiments_arr, $establiment_item);
}

<<<<<<< Updated upstream
header('Content-Type: application/json');
=======
>>>>>>> Stashed changes
//Return JSON
echo json_encode($establiments_arr);

?>