<?php

$conn = new mysqli("localhost", "root", "", "restaurat");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$email = $_REQUEST["email"];
$psswd = $_REQUEST["password"];

$sql = "SELECT nom, password FROM establiment WHERE correu_electronic = '" . $email . "' and password='".$psswd."';";

$query=mysqli_query($conn,$sql);
$counter=mysqli_num_rows($query);
if ($counter==1){
		$sqly = "SELECT id FROM establiment WHERE correu_electronic = '" . $email . "' and password='".$psswd."';";
		$resultat = $conn->query($sqly);
    		if ($resultat){
        		while($row = $resultat->fetch_array()){
				$id = $row['id'];
				}
			}
		session_start();
		$_SESSION['establiment'] = $id;
		echo "OK";
} else {
		echo "ERROR";
		
}

?>