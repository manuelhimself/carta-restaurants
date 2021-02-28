<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- Script per validar -->
    <script src="https://cdn.rawgit.com/PascaleBeier/bootstrap-validate/v2.2.0/dist/bootstrap-validate.js"></script>
    <link rel="stylesheet" href="/css/dist/register.css">
    <link rel="stylesheet" href="/css/dist/style.css">
    <script src="js/register.js"></script>

</head>


<?php
include_once 'navbarLoginRegister.php';
?>

<body>

    <div id="contenidorPrincipal">
        <div class="container" id="contenidorSecundari">
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12 mt-2" id="contenidor">
                    <h2 class="mt-2">Registre</h2>
                    <form method="POST" id="formulari" action="https://api.restaurat.me/controller/establiment/addEstabliment.php">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nom restaurant</label>
                                <input id="nom" class="form-control" name="establiment" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input id="email" class="form-control" name="email" type="email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Màxim comensals</label>
                                <input id="comensals" class="form-control" name="numComensals" type="number" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="poblacio">Localitat</label>
                                <select id="poblacio" class="form-control" name="poblacio" required>
                                    <option selected>Selecciona</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Telèfon</label>
                                <input id="tlfn" class="form-control" name="tel" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12" id="checkBox">
                                <label class="col-12">Especialització: </label>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Contrasenya</label>
                                <input id="pswd" type="password" class="form-control" name="paswd" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Repeteix contrasenya</label>
                                <input id="pswdR" type="password" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn pull-right">Registrar-se</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
include_once 'footer.php';
?>

</html>