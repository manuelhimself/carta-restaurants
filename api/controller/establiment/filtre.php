<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');


if(isset($_REQUEST['categoria'])){
   $categoria = $_REQUEST['categoria']; 
}

if(isset($_REQUEST['poblacio'])){
   $poblacio = $_REQUEST['poblacio'];
}

if(isset($_REQUEST['nom'])){
   $nom = $_REQUEST['nom']; 
}

$conn = new mysqli("localhost","root","password","restaurat");
   
$sql="SELECT distinct establiment.nom as nom, establiment.id as id, establiment.correu_electronic, poblacio.nom as p, establiment.telefon
FROM establiment, categoria_establiment, categoria, poblacio where establiment.id = categoria_establiment.Establiment_id
and categoria_establiment.Categoria_id = categoria.id and establiment.Poblacio_id = poblacio.id ";  

if ( !empty($categoria) ) {
   $sql = $sql . "and categoria.id =". $categoria ; 
}
if ( !empty($poblacio) ){
   $sql = $sql ." and poblacio.id =". $poblacio;
}


$select = $conn -> prepare($sql);



$select -> execute();
$resultat = $select->get_result();
$mostrar = $resultat->fetch_all(MYSQLI_ASSOC);

echo json_encode($mostrar);

?>