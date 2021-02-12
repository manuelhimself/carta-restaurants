<?php
session_start();

if(isset ($_SESSION ['establiment'])){
    $id = $_SESSION ['establiment'];
}else{
    echo 'inci de sesio no valid';
}


$conn = new mysqli("localhost","root","password","restaurat");
$select = $conn -> prepare("SELECT MONTHNAME(reserva.data) as mes, COUNT(id_reserva) as suma FROM reserva WHERE reserva.Establiment_id=$id GROUP BY MONTHnAME(reserva.data)");
$select -> execute();
$resultat = $select->get_result();
$mostrar = $resultat->fetch_all(MYSQLI_ASSOC);

echo json_encode($mostrar);
?>

