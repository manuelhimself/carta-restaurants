<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="js/api.js"></script>
    <script src="js/editaPlats.js"></script>
    <script src="js/closeSesion.js"></script>
    <link rel="stylesheet" href="/css/dist/style.css">
    <link rel="stylesheet" href="/css/dist/plats.css">

    <title>Plats</title>
</head>

<?php
include_once 'navBar.php';
?>

<body>
    <input type="file" id="file-input">
    <div class="container">
        <div class="modal fade" id="modal1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100">Editar plat</h4>
                    </div>
                    <div class="modal-body">
                        <form method="GET">
                            <input type="hidden" name="idPlat" id="idPlat">
                            <div class="row">
                                <div class="col-12">
                                    <label for="nomPlat">Nom plat:</label><br>
                                    <input type="text" name="nomPlat" id="nomPlat">
                                </div>
                                <div class="col-12">
                                    <label for="descripcioPlat" class= "mt-2">Descripció plat:</label><br>
                                    <input type="text" name="descripcioPlat" id="descripcioPlat">
                                </div>
                                <div class="col-12">
                                    <label for="preuPlat" class= "mt-2">Preu plat:</label><br>
                                    <input type="text" name="preuPlat" id="preuPlat">
                                </div>
                                <div class="col-4 offset-3">
                                    <div class="checkbox ml-3 text-left"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" id="edita" data-dismiss="modal">Desa</button>
                        <button type="button" class="btn" data-dismiss="modal">Tanca</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="modal2" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100">Estàs segur que vols eliminar el plat?</h4>
                    </div>
                    <div class="modal-body">
                        <button type="button" class="btn" id="esborrarPlat" data-dismiss="modal">Eliminar</button>
                        <button type="button" class="btn" data-dismiss="modal">Cancel·la</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal3" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100">Afegir plat</h4>
                    </div>
                    <div class="modal-body">
                        <form method="GET">
                            <label for="nomPlat">Nom plat:</label><br>
                            <input type="text" name="nomPlat" id="nomP">
                            <br>
                            <label for="descripcioPlat" class= "mt-2">Descripció plat:</label><br>
                            <input type="text" name="descripcioPlat" id="descripcioP">
                            <br>
                            <label for="preuPlat" class= "mt-2">Preu plat:</label><br>
                            <input type="text" name="preuPlat" id="preuP">
                            <div class="checkbox"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" id="afegir" data-dismiss="modal">Desa</button>
                        <button type="button" class="btn" data-dismiss="modal">Tanca</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <h1 id="titol">Plats</h1>
            <br>
            <button type="button" id="afegirPlat" class="btn">Afegir plat</button>
            <br>
            <form>
                <div class="form-group">
                    <select id="select" class="form-control">
                        <option value="0">Selecciona un alergen</option>
                    </select>
                </div>
            </form>
            <div id="plats"></div>
        </div>
    </div>
</body>

<?php
include_once 'footer.php';
?>

</html>