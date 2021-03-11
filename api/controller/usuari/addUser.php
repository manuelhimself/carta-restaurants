<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

$conn = new mysqli("localhost", "root", "password", "restaurat");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    if(!empty($_REQUEST['nom']) && !empty($_REQUEST['llinatge']) && !empty($_REQUEST['correu']) && !empty($_REQUEST['telefon']) && !empty($_REQUEST['password']) ){
      $nom = $_REQUEST['nom'];
      $llinatge = $_REQUEST['llinatge'];
      $correu = $_REQUEST['correu'];
      $telefon = $_REQUEST['telefon'];
      $password = $_REQUEST['password'];
    
    
  $sql = " INSERT INTO usuari (nom,llinatge,password,telefon,correu) VALUES ('$nom','$llinatge','$password','$telefon','$correu')";


if($conn->query($sql) === TRUE){
    echo"OK";

} else{ 
  echo"ERROR";
}

}else{
echo 'ERROR';
}
include_once 'mail.php';
?>