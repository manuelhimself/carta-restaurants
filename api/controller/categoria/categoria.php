<?php

$conn = new mysqli("localhost","root","","restaurat");
$select = $conn -> prepare("SELECT * from categoria ");
$select -> execute();
$resultat = $select->get_result();
$mostrar = $resultat->fetch_all(MYSQLI_ASSOC);

echo json_encode($mostrar);
?>