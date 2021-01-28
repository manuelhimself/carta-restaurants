$(document).ready(function () {

    function cartes() {
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
                    var cardA1 = $("<button/>", { type: "button", class: "editarCarta btn btn-primary", id: "edC" + idCarta, text: "Editar" });
                    var cardA2 = $("<button/>", { type: "button", class: "eliminarCarta btn btn-secondary", id: "elC" + idCarta, text: "Eliminar" });
                    cardDIV.append(cardIMG);
                    cardBody.append(cardH4, cardP, cardA1, cardA2);
                    cardDIV.append(cardBody);
                    colDIV.append(cardDIV);
                    rowDIV.append(colDIV);
                }
            }
        };
        xhttp.open("GET", "../../api/carta/read.php", true);
        xhttp.send();
    }



    function mostrarSeccions(idC) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                $("#seccions").html(this.responseText);
                var seccions = JSON.parse(this.responseText);
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
        xhttp.open("GET", "../../api/seccio/readByIdCarta.php?idCarta=" + idC, true);
        xhttp.send();
    }

    function eliminarSeccio(idS,idC) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarSeccions(idC);
            }
        };
        xhttp.open("GET", "../../api/seccio/delete1.php?idSeccio=" + idS, false);
        xhttp.send();
    }

    cartes();

    $(document).on("click", ".editarCarta", function () {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        mostrarSeccions(idCarta);
    });

    $(document).on("click", ".eliminarSeccio", function () {
        var idBoto = $(this).attr("id");
        var idSeccio = idBoto.substr(3, idBoto.length);
        var idCarta = $(this).attr("idCarta");
        eliminarSeccio(idSeccio,idCarta);
    });
});