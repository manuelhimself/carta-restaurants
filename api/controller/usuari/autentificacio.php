<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

$conn = new mysqli("localhost", "root", "", "restaurat");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$email = $_REQUEST["email"];
$psswd = $_REQUEST["password"];

$sql = "SELECT nom, password FROM usuari WHERE email = '" . $email . "' and password='".$psswd."';";

$query=mysqli_query($conn,$sql);
$counter=mysqli_num_rows($query);
if ($counter==1){
		$sqly = "SELECT idUsuari FROM usuari WHERE email = '" . $email . "' and password='".$psswd."';";
		$resultat = $conn->query($sqly);
    		if ($resultat){
        		while($row = $resultat->fetch_array()){
				$id = $row['idUsuari'];
				}
			}
		echo $id;
} else {
		echo "ERROR";
		
}


?>