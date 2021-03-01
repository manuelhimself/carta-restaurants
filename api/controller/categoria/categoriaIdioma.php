<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');


$conn = new mysqli("localhost","root","password","restaurat");
$select = $conn -> prepare("SELECT c.id, tc.nom
FROM categoria c
inner join traduccio_categoria tc on tc.id_categoria = c.id
inner join llenguatge l on l.id = tc.id_llenguatge and l.nom = 'en'  ");
$select -> execute();
$resultat = $select->get_result();
$mostrar = $resultat->fetch_all(MYSQLI_ASSOC);

echo json_encode($mostrar);
?>