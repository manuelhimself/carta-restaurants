$(document).ready(function() {

    function cartes() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
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
        xhttp.open("GET", api + "/carta/read.php", true);
        xhttp.send();
    }



    function mostrarSeccions(idC) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
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
                    var cardA1 = $("<button/>", { type: "button", class: "editarSeccio btn btn-primary", id: "edS" + idSeccio, text: "Editar" });
                    var cardA2 = $("<button/>", { type: "button", class: "eliminarSeccio btn btn-secondary", id: "elS" + idSeccio, text: "Eliminar" });
                    cardBody.append(cardH4, cardP, cardA1, cardA2);
                    cardDIV.append(cardBody);
                    colDIV.append(cardDIV);
                    rowDIV.append(colDIV);
                }
            }
        };
        xhttp.open("GET", api + "/seccio/readByIdCarta.php?idCarta=" + idC, true);
        xhttp.send();
    }

    function eliminarSeccio(idS) {
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", api + "/seccio/delete1.php?idSeccio=" + idS, true);
        xhttp.send();
    }

    function idCartaSeccio(idS) {
        var idCarta = -1;
        console.log("1");
        var xhttp = new XMLHttpRequest();
        console.log("2");
        console.log("3");
        xhttp.open("GET", api + "/seccio/readByIdSeccio.php?idSeccio=" + idS, false);
        console.log("4");
        xhttp.send();
        console.log("5");
        xhttp.onreadystatechange = function() {
            console.log("6");
            console.log("readystate: " + this.readyState);
            if (this.readyState == 4 && this.status == 200) {
                console.log("7");
                var seccions = JSON.parse(this.responseText);
                console.log(seccions);
                console.log("8");
                var idCarta = seccions.Carta_idCarta;
                console.log("idCarta= " + idCarta)
                console.log("9");
            }
        };
        return idCarta;
    }

    cartes();

    $(document).on("click", ".editarCarta", function() {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        mostrarSeccions(idCarta);
    });

    $(document).on("click", ".eliminarSeccio", function() {
        var idBoto = $(this).attr("id");
        console.log(idBoto);
        var idSeccio = idBoto.substr(3, idBoto.length);
        console.log(idSeccio);
        //eliminarSeccio(idSeccio);
        var idCarta = idCartaSeccio(idSeccio);
        console.log(idCarta);
        //mostrarSeccions(idCarta);
    });
});