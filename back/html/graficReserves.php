<?php
session_start();

if(isset ($_SESSION ['establiment'])){
    $id = $_SESSION ['establiment'];
}else{
    echo 'inci de sesio no valid';
}


$conn = new mysqli("localhost","root","","restaurants");
$select = $conn -> prepare("SELECT ELT(MONTH(reserva.data), 'Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Decembre') as mes,
COUNT(id_reserva) as suma FROM reserva WHERE reserva.Establiment_id=$id GROUP BY month(reserva.data) + year(reserva.data)");
//$select = $conn -> prepare("SELECT COUNT(id_reserva) as suma, MONTHNAME(reserva.data) as mes FROM reserva WHERE reserva.Establiment_id= $id GROUP BY month(reserva.data)");
$select -> execute();
$resultat = $select->get_result();
$mostrar = $resultat->fetch_all(MYSQLI_ASSOC);

echo json_encode($mostrar);
?>

