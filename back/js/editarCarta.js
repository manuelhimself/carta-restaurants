$(document).ready(function () {

    function mostrarCartes() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                $("#cards").html(this.responseText);
                var cartes = JSON.parse(this.responseText);
                console.log(cartes);
                var i = 0;
                for (c in cartes) {

                    if (i % 2 == 0) {
                        var rowDIV = $("<div/>", { class: "row" });
                        $("#cards").append(rowDIV);
                    }
                    i++;

                    var nom = cartes[c].nom;
                    var idCarta = cartes[c].idCarta;
                    var actiu = cartes[c].actiu;

                    var colDIV = $("<div/>", { class: "col-md-4" });
                    var cardIMG = $("<img/>", { class: "card-img-top", src: "", alt: "card image", style: "width:100%" });
                    var cardDIV = $("<div/>", { class: "card", id: idCarta });
                    var cardBody = $("<div/>", { class: "card-body" });
                    var cardH4 = $("<h4/>", { class: "card-title", text: nom });
                    var cardP = $("<p/>", { class: "card-text", text: nom });
                    var cardA1 = $("<button/>", { type: "button", class: "editarCarta btn btn-primary", id: "edC" + idCarta, text: "Mostra seccions" });
                    var cardA2 = $("<button/>", { type: "button", class: "eliminarCarta btn btn-secondary", id: "elC" + idCarta, text: "Eliminar" });
                    cardDIV.append(cardIMG);
                    cardBody.append(cardH4, cardP, cardA1, cardA2);
                    cardDIV.append(cardBody);
                    colDIV.append(cardDIV);
                    rowDIV.append(colDIV);
                }
            }
        };
        xhttp.open("POST", "../../api/carta/read.php", true);
        xhttp.send();
    }



    function mostrarSeccions(idC) {
        var xhttp = new XMLHttpRequest();
        console.log("mostrar seccions fora");
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log("mostrar seccions dins");
                $("#seccions").html(this.responseText);
                var seccions = JSON.parse(this.responseText);
                var botoAfegirSeccio = $("<button/>", { type: "button", class: "btn btn-secondary", id: "afegirSeccio", idCarta: idC, text: "Afegir secció" });
                $("#seccions").append(botoAfegirSeccio);
                var i = 0;
                for (s in seccions) {

                    if (i % 2 == 0) {
                        var rowDIV = $("<div/>", {
                            class: "row",
                        });
                        $("#seccions").append(rowDIV);
                    }
                    i++;

                    var idCarta = seccions[s].idCarta;
                    var idSeccio = seccions[s].idSeccio;
                    var nom = seccions[s].nom;

                    var colDIV = $("<div/>", { class: "col-md-4" });
                    var cardDIV = $("<div/>", { class: "card" });
                    var cardBody = $("<div/>", { class: "card-body" });
                    var cardH4 = $("<h4/>", { class: "card-title", text: nom });
                    var cardP = $("<p/>", { class: "card-text", text: idCarta + " " + idSeccio });
                    var cardA1 = $("<button/>", { type: "button", class: "editarSeccioNom btn btn-primary", id: "edS" + idSeccio, idCarta: idCarta, text: "Editar Nom" });
                    var cardA2 = $("<button/>", { type: "button", class: "editarPlats btn btn-secondary", id: "edP" + idSeccio, text: "Editar Plats" });
                    var cardA3 = $("<button/>", { type: "button", class: "eliminarSeccio btn btn-info", id: "elS" + idSeccio, idCarta: idCarta, text: "Eliminar" });
                    cardBody.append(cardH4, cardP, cardA1, cardA2, cardA3);
                    cardDIV.append(cardBody);
                    colDIV.append(cardDIV);
                    rowDIV.append(colDIV);
                }
            }
        };
        xhttp.open("POST", "../../api/seccio/readByIdCarta.php?idCarta=" + idC, true);
        xhttp.send();
    }

    function eliminarSeccio(idS, idC) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarSeccions(idC);
            }
        };
        xhttp.open("POST", "../../api/seccio/delete1.php?idSeccio=" + idS, false);
        xhttp.send();
    }

    function eliminarCarta(idC) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("POST", "../../api/carta/delete1.php?idCarta=" + idC, true);
        xhttp.send();
    }

    function actualitzarNomSeccio(idC, idS, nomSeccio) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarSeccions(idC);
            }
        };
        xhttp.open("POST", "../../api/seccio/update.php?idSeccio=" + idS + "&idCarta=" + idC + "&nomSeccio=" + nomSeccio, false);
        xhttp.send();
    }

    function afegirCarta(nomCarta){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("POST", "../../api/carta/create.php?nomCarta=" + nomCarta, true);
        xhttp.send();
    }

    function afegirSeccio(nomSeccio,idC){
        console.log("afegirSeccio fora");
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log("afegirSeccio dins");
                mostrarSeccions(idC);
            }
        };
        xhttp.open("POST", "../../api/seccio/create.php?nomSeccio=" + nomSeccio + "&idCarta=" + idC, true);
        xhttp.send();
    }

    mostrarCartes();

    $(document).on("click", ".editarCarta", function () {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        mostrarSeccions(idCarta);
    });

    $(document).on("click", ".eliminarSeccio", function () {
        var idBoto = $(this).attr("id");
        var idSeccio = idBoto.substr(3, idBoto.length);
        var idCarta = $(this).attr("idCarta");
        eliminarSeccio(idSeccio, idCarta);
    });

    $(document).on("click", ".editarSeccioNom", function () {
        var idBoto = $(this).attr("id");
        var idSeccio = idBoto.substr(3, idBoto.length);
        var idCarta = $(this).attr("idCarta");
        $("#modal1").modal("toggle");
        $(document).on("click", ".nomModal", function () {
            var nomSeccio = $("#nomSeccioForm").val();
            actualitzarNomSeccio(idCarta, idSeccio, nomSeccio);
        });
    });

    $(document).on("click", ".eliminarCarta", function () {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        eliminarCarta(idCarta);
    });

    $(document).on("click", "#afegirCarta", function () {
        $("#modal2").modal("toggle");
    });

    $(document).on("click", "#bAfegirCarta", function () {
        console.log("dins");
        var nomCarta = $("#nomCartaForm").val();
        console.log(nomCarta);
        afegirCarta(nomCarta);
    });

    $(document).on("click", "#afegirSeccio", function () {
        $("#modal3").modal("toggle");
    });

    $(document).on("click", "#bAfegir", function () {
        var nomSeccio = $("#nomS").val();
        var idCarta = $("#afegirSeccio").attr("idCarta");
        afegirSeccio(nomSeccio,idCarta);
    });

});