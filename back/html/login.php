<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script type="text/javascript" src="/js/login.js"></script>
    <link rel="stylesheet" href="/css/dist/style.css">
    <link rel="stylesheet" href="/css/dist/login.css">
</head>


<?php
include_once 'navbarLoginRegister.php';
?>

<body>
<div id="contenidorPrincipal">
        <div class="container" id="contenidorSecundari">
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-12" id="contenidor">
                    <div class="col-12">
                        <h2>Inici de sessió</h2>
                    </div>
                    <div class="form-group col-12">
                        <label>Email : </label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                    </div>
                    <div class="form-group col-12">
                        <label>Contrasenya : </label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <span id="m1" class="font-weight-bold ml-3">
                    </span>
                    <div class="col-12" id="botons">
                        <button id='inici' class="btn" onclick="logIn();">Inicia sessió</button>
                        <a href="registrer.php" class="btn">Registrar-se</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
include_once 'footer.php';
?>

</html>