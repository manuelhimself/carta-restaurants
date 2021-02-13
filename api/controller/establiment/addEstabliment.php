<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

$conn = new mysqli("localhost", "root", "password", "restaurat");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

if(isset($_POST['establiment'], $_POST['email'], $_POST['numComensals'],$_POST['tel'],$_POST['poblacio'],$_POST['paswd'])){

    $e = $_POST['establiment'];
    $email = $_POST['email'];
    $numCom = $_POST['numComensals'];
    $tlfn = $_POST['tel'];
    $poblacio = $_POST['poblacio'];
    $passwd = $_POST['paswd'];
    
}

$sql = " INSERT INTO establiment (nom,correu_electronic,num_comensals,telefon,Poblacio_id,password) VALUES ('$e','$email','$numCom','$tlfn','$poblacio','$passwd')";

if($conn->query($sql) === TRUE){

  $last_id = $conn->insert_id;
 
  $categoria=$_POST["id"];
  $count = count($categoria);
  for ($i = 0; $i < $count; $i++) {
      $idCateg = $categoria[$i];
      $cat = " INSERT INTO categoria_establiment (Establiment_id,Categoria_id) VALUES ('$last_id','$idCateg')";

      if ($conn->query($cat) === TRUE) {
        echo "New record created successfully";
        header("location: /back/html/login.html");
      } else {
        echo "error a l'registre intenteu de nou";
      }

  }
} else {
      echo "<script> 
      alert('No ha estat posible el registre, recordi omplir tots els camps); 
      window.location.href='/back/html/registrer.html'; 
      </script>"; 
}
?>