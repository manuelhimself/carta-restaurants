<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

if(!empty($_REQUEST['nom']) && !empty($_REQUEST['correu']) ){
    $nom = $_REQUEST['nom'];
    $mail = $_REQUEST['correu'];
    

    $msg = "Benvingu@ a Restaurat \n el seu compte s'ha creat correctament";

// use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

// send email
mail("$mail","My subject",$msg);
}

?>