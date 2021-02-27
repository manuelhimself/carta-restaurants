<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/dist/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.2/js/all.js" data-auto-replace-svg="nest"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- css -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <!-- js -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <link rel="icon" href="images/icon/icon.png">
    <script type="text/javascript" src="js/api.js"></script>
    <script type="text/javascript" src="js/editaPerfil.js"></script>
    <script src="js/closeSesion.js"></script>
    <title>Edita perfil</title>
</head>

<?php
include_once 'navBar.php';
?>

<body>

    <div class="container" id="perfilContainer">
        <div class="card" id="perfilCard">
            <div>
                <div class="wrapper row">
                    <div class="col-md-6">
                        <div class="nav" id="images">
                            <div class="row" id="bigPic">
                            </div>
                            <div class="row" id="smallPics">
                            </div>
                        </div>
                    </div>
                    <div class="details col-md-6">
                        <div class="establiment-title-div">
                            <div class="col-md-12 d-flex">
                                <h3 class="establiment-nom" id="nomEstabliment"></h3>
                                <button id="edita-nom" data-toggle="modal" data-target="#modalEditaNom" class="btn float-right realBtn"><i class="fa fa-edit"></i></button>
                            </div>
                        </div>
                        <div class="establiment-description-div">
                            <p class="establiment-descripcio" id="descripcioEstabliment"></p>
                            <button id="edita-description" data-toggle="modal" data-target="#modalEditaDescripcio" class="btn float-right realBtn">Edita descripcio</button>
                        </div>
                        <br>
                        <div class="establiment-altres-div col-md-12 d-flex">
                            <li class="establiment-altres" id="altresEstabliment"></li>
                        </div>
                        <br>
                        <div class="action col-md-12">
                            <button class="float-right btn realBtn mb-3" data-toggle="modal" data-target="#modalEditaPerfil" type="button" id="edita-perfil">Edita perfil</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Leaflet map-->
    <div class="container" id="perfilContainer">
        <div class="card" id="perfilCard">
            <div>
                <div class="wrapper row">
                    <div class="col-md-6">
                        <div class="wrapper col-" id="map" style="width:100%;height:400px; float:left;"></div>
                    </div>
                    <div class="details col-md-6 my-auto">
                        <div class="row justify-content-center mr-2 mt-2">
                            <div class="col-12 offset-2">
                                <h4>Coordenades :</h4>
                            </div>
                            <div class="col-5">
                                <label for="inlineFormCustomSelect">Lat: </label>
                                <input type="text" class="form-control" id="x" value="0">
                            </div>
                            <div class="col-5">
                                <label for="inlineFormCustomSelect">Lng: </label>
                                <input type="text" class="form-control" id="y" value="0">
                            </div>
                            <div class="col-10">
                                <button id="b1" class="btn realBtn float-right mt-3 mb-3">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Edita nom -->
    <div id="modalEditaNom" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- header modal -->

                <div class="modal-header justify-content-center">
                    <h4 class="modal-title" id="exampleModalLabel">Edita nom de l'establiment</h4>
                </div>

                <!-- body modal -->
                <div class="modal-body">
                    <form role="form" name="formEdita" action="edita.php" method="get">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label>Nom:</label>
                                <input id="input-nom" type="text" class="form-control" name="nom">
                            </div>
                        </div>
                    </form>
                </div>

                <!-- footer modal -->

                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Tancar</button>
                    <button id="bEditaNom" type="button" class="btn realBtn" data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Edita Descripció -->
    <div id="modalEditaDescripcio" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- header modal -->

                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="exampleModalLabel">Edita descripció de l'establiment</h5>
                </div>


                <!-- body modal -->


                <div class="modal-body">
                    <form role="form" name="formEdita" action="edita.php" method="get">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <label>Descripció:</label>
                                <textarea id="input-descripcio" type="text" class="form-control" name="descripcio" style="height: 150px;"></textarea>
                            </div>
                        </div>
                    </form>
                </div>


                <!-- footer modal -->

                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Tancar</button>
                    <button id="bEditaDescripcio" type="button" class="btn realBtn" data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edita Perfil -->
    <div id="modalEditaPerfil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <!-- header modal -->

                <div class="modal-header justify-content-center">
                    <h5 class="modal-title" id="exampleModalLabel">Edita establiment</h5>
                </div>


                <!-- body modal -->


                <div class="modal-body">
                    <form role="form" name="formEdita" action="edita.php" method="get">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label>Localitat:</label>
                                <select name="localitat" id="localitat" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label>Telefon:</label>
                                <input name="telefon" id="telefon" class="form-control">

                                </input>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label>Correu electrònic:</label>
                                <input type="email" name="correu_electronic" id="correu_electronic" class="form-control"></select>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label>Nombre de comensals:</label>
                                <input type="number" id="nComensals" name="nComensals" class="form-control">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <span>Especialitats:</span>
                                <fieldset id="especialitats">
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>


                <!-- footer modal -->

                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Tancar</button>
                    <button id="bEditaPerfil" type="button" class="btn realBtn" data-dismiss="modal">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
include_once 'footer.php';
?>

</html>