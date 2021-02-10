<?php
session_start();

if(isset ($_SESSION ['establiment'])){
    $id = $_SESSION ['establiment'];
}else{
    echo 'inci de sesio no valid';
}


$conn = new mysqli("localhost","root","","restaurat");
$select = $conn -> prepare("SELECT ELT(MONTH(reserva.data), 'Gener', 'Febrer', 'Març', 'Abril', 'Maig', 'Juny', 'Juliol', 'Agost', 'Setembre', 'Octubre', 'Novembre', 'Decembre') as mes,
COUNT(id_reserva) as suma FROM reserva WHERE reserva.Establiment_id=$id GROUP BY month(reserva.data) + year(reserva.data)");
$select -> execute();
$resultat = $select->get_result();
$mostrar = $resultat->fetch_all(MYSQLI_ASSOC);

echo json_encode($mostrar);
?>

