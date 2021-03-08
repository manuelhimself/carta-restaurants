<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Credentials', 'true');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

if(!empty($_REQUEST['name']) && !empty($_REQUEST['email']) && !empty($_REQUEST['message']) ){
    $nom = $_REQUEST['name'];
    $msg = $_REQUEST['message'];
    $mail = $_REQUEST['email'];
    

// use wordwrap() if lines are longer 
$msg = wordwrap($msg,70);

// send email
mail($mail,$nom,$msg);
}

?>