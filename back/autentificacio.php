<?php

$conn = new mysqli("localhost", "root", "", "restaurants");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$nom = $_POST["usuari"];
$psswd = $_POST["password"];

$sql = "SELECT nom, password FROM establiment WHERE nom = '" . $nom . "' and password='".$psswd."';";

$query=mysqli_query($conn,$sql);
$counter=mysqli_num_rows($query);
if ($counter==1){
		$sqly = "SELECT id FROM establiment WHERE nom = '" . $nom . "' and password='".$psswd."';";
		$resultat = $conn->query($sqly);
    		if ($resultat){
        		while($row = $resultat->fetch_array()){
				$id = $row['id'];
				}
			}
		$_SESSION['restaurant'] = $id;
		header("location: addEstb.html");
	
} else {
	header("location: iniciSesio.html");
}

?>