$(document).ready(function() {

    var carta;
    var seccions;
    var cartes;
    var idC;
    var idS;
    var idEstabliment = sessionStorage.getItem('key');
    console.log(idEstabliment);

    if (idEstabliment == null) {
        window.location.replace("login.php");
    }

    mostrarCartes();

    function getCarta(id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                carta = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/carta/readByIdCarta.php?idCarta=" + id, false);
        xhttp.send();
    }

    function getCartes() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                cartes = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/carta/readByIdEstabliment.php?idEstabliment=" + idEstabliment, false);
        xhttp.send();
    }

    function getSeccions(idC) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                seccions = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/seccio/readByIdCarta.php?idCarta=" + idC, false);
        xhttp.send();
    }

    function mostrarCartes() {
        $("#cartes").empty()
        getCartes();
        for (var i = 0; i < cartes.length; i++) {
            var nom = cartes[i].nom;
            var id = cartes[i].idCarta;
            if (i % 6 == 0) {
                var rowDIV = $("<div/>", { class: "row" });
                $("#cartes").append(rowDIV);
            }
            var colDIV = $("<div/>", { class: "col-md-6 col-lg-4 col-sm-12" });
            var cardDIV = $("<div/>", { class: "card border-0 h-100", id: "idC" + id });
            var cardBody = $("<div/>", { class: "card-body p-4" });
            var cardRow = $("<div/>", { class: "row" });
            var cardCol1 = $("<div/>", { class: "col-12 text-center my-auto" });
            var cardCol2 = $("<div/>", { class: "col-12 text-center botons" });
            var cardIcon = $("<i/>", { class: "fa fa-trash" });
            var cardIcon1 = $("<i/>", { class: "fa fa-edit" });
            var cardIcon2 = $("<i/>", { class: "fa fa-eye" });
            var cardIcon3 = $("<i/>", { class: "fa fa-power-off" });
            var cardH3 = $("<h3/>", { text: nom });
            var cardA1 = $("<a/>", { type: "button", class: "editarCarta btn", id: "edC" + id});
            var cardA4 = $("<a/>", { type: "button", class: "estatCarta btn", id: "actC" + id });
            var cardA2 = $("<a/>", { class: "eliminarCarta btn", id: "elC" + id });
            var cardA3 = $("<button/>", { type: "button", class: "editarNomCarta btn", id: "edN" + id });
            var abbrSeccions = $("<abbr/>", {title: "Mostrar seccions"});
            var abbrEliminar = $("<abbr/>", {title: "Eliminar"});
            var abbrModificar = $("<abbr/>", {title: "Editar"});
            var abbrEstat = $("<abbr/>", {title: "Activar/Desactivar"});

            cardCol1.append(cardH3);
            cardA1.prepend(cardIcon2);
            abbrSeccions.append(cardA1);
            cardA3.append(cardIcon1);
            abbrModificar.append(cardA3);
            cardA2.append(cardIcon);
            abbrEliminar.append(cardA2);
            cardA4.append(cardIcon3);
            abbrEstat.append(cardA4);

            cardCol2.append(abbrModificar, abbrSeccions, abbrEliminar, abbrEstat);
            cardRow.append(cardCol1, cardCol2);
            cardBody.append(cardRow);
            cardDIV.append(cardBody);
            colDIV.append(cardDIV);
            rowDIV.append(colDIV);
        }
        actualitzarColorCartes();
    }

    function mostrarSeccions(idC) {
        var divRow = $("<div/>", {class: "row"});
        var divColTitol = $("<div/>", {class: "col-md-8"});
        var divColBoto = $("<div/>", {class: "col-md-4"});
        var botoAfegirSeccio = $("<button/>", { type: "button", class: "btn float-right mt-2", id: "afegirSeccio", idCarta: idC, text: "Afegir secció" });
        getCarta(idC);
        var titol = $("<h3/>", { text: "Seccions de la carta " + carta.nom, id: "titol" });
        divColTitol.append(titol);
        divColBoto.append(botoAfegirSeccio);
        divRow.append(divColTitol, divColBoto);
        $("#seccions").html(divRow);
        getSeccions(idC);
        for (var i = 0; i < seccions.length; i++) {
            var nom = seccions[i].nom;
            var id = seccions[i].idSeccio;
            var idCarta = seccions[i].idCarta;
            if (i % 2 == 0) {
                var rowDIV = $("<div/>", { class: "row rowSeccions" });
                $("#seccions").append(rowDIV);
            }
            var colDIV = $("<div/>", { class: "col-md-6" });
            var cardDIV = $("<div/>", { class: "card border-0 h-100", id: "idS" + id });
            var cardBody = $("<div/>", { class: "card-body p-4" });
            var rowCard = $("<div/>", { class: "row" });
            var colDivButton = $("<div/>", { class: "col-md-6 text-center botonsSeccio" });
            var colDivH3 = $("<div/>", { class: "col-md-6 text-center my-auto" });
            var cardH3 = $("<h3/>", { text: nom });
            var cardIcon1 = $("<i/>", { class: "fa fa-trash" });
            var cardA1 = $("<button/>", { type: "button", class: "editarSeccioNom btn", id: "edS" + id, idCarta: idCarta });
            var cardA2 = $("<a/>", { href: "editarPlats.php", class: "editarPlats btn", id: "edP" + id});
            var cardA3 = $("<a/>", { class: "eliminarSeccio btn", id: "elS" + id, idCarta: idCarta });
            var cardIcon2 = $("<i/>", { class: "fa fa-eye" });
            var cardIcon3 = $("<i/>", { class: "fa fa-edit" });
            var abbrPlats = $("<abbr/>", {title: "Mostrar plats"});
            var abbrEliminar = $("<abbr/>", {title: "Eliminar"});
            var abbrModificar = $("<abbr/>", {title: "Editar"});

            cardA1.append(cardIcon3);
            abbrModificar.append(cardA1);
            cardA2.prepend(cardIcon2);
            abbrPlats.append(cardA2);
            cardA3.append(cardIcon1);
            abbrEliminar.append(cardA3);
            colDivH3.append(cardH3);
            colDivButton.append(abbrModificar, abbrPlats, abbrEliminar);
            rowCard.append(colDivH3, colDivButton);
            cardBody.append(rowCard);
            cardDIV.append(cardBody);
            colDIV.append(cardDIV);
            rowDIV.append(colDIV);
        }

    }

    function eliminarSeccio(idSeccio, idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                mostrarSeccions(idCarta);
            }
        };
        xhttp.open("POST", api + "/seccio/delete1.php?idSeccio=" + idSeccio, false);
        xhttp.send();
    }

    function eliminarCarta(idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("POST", api + "/carta/delete1.php?idCarta=" + idCarta, false);
        xhttp.send();
    }

    function actualitzarNomSeccio(idSeccio, nomSeccio) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var id = "#idS" + idSeccio + " div div div h3";
                $(id).text(nomSeccio);
            }
        };
        xhttp.open("POST", api + "/seccio/update.php?idSeccio=" + idSeccio + "&nomSeccio=" + nomSeccio, true);
        xhttp.send();
    }

    function actualitzarNomCarta(idCarta, nomCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var id = "#idC" + idCarta + " div div div h3";
                $(id).text(nomCarta);
            }
        };
        xhttp.open("POST", api + "/carta/update.php?idCarta=" + idCarta + "&nomCarta=" + nomCarta, true);
        xhttp.send();
    }

    function afegirCarta(nomCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("POST", api + "/carta/create.php?nomCarta=" + nomCarta + "&idEstabliment=" + idEstabliment, true);
        xhttp.send();
    }

    function afegirSeccio(nomSeccio, idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                mostrarSeccions(idCarta);
            }
        };
        xhttp.open("POST", api + "/seccio/create.php?nomSeccio=" + nomSeccio + "&idCarta=" + idCarta, true);
        xhttp.send();
    }

    function desactivarAltresCartes(idC) {
        var id;
        for (var j = 0; j < cartes.length; j++) {
            if (cartes[j].idCarta != idC) {
                id = cartes[j].idCarta;
                desactivarCarta(id);
            }
        }
    }

    function actualitzarColorCartes() {
        var idCarta;
        for (var i = 0; i < cartes.length; i++) {
            idCarta = cartes[i].idCarta;
            if (cartes[i].actiu == 0) {
                $("#idC" + idCarta).css("background-color","#84878a");
            } else {
                $("#idC" + idCarta).css("background-color","#545658");
            }
        }
    }

    function activarCarta(idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                $("#idC" + idCarta).css("background-color","#545658");
            }
        };
        xhttp.open("POST", api + "/carta/activate.php?idCarta=" + idCarta, true);
        xhttp.send();
    }

    function desactivarCarta(idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                $("#idC" + idCarta).css("background-color","#84878a");
            }
        };
        xhttp.open("POST", api + "/carta/desactivate.php?idCarta=" + idCarta, true);
        xhttp.send();
    }

    $(document).on("click", ".editarCarta", function() {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        mostrarSeccions(idCarta);
        var altura = $("#cartes").height();
        window.scrollTo(0,altura+90);
    });

    $(document).on("click", ".eliminarSeccio", function() {
        var idBoto = $(this).attr("id");
        idS = idBoto.substr(3, idBoto.length);
        idC = $(this).attr("idCarta");
        $("#modal6").modal("toggle");
    });

    $(document).on("click", "#esborrarSeccio", function() {
        eliminarSeccio(idS, idC);
    });

    $(document).on("click", ".editarSeccioNom", function() {
        var idBoto = $(this).attr("id");
        var idSeccio = idBoto.substr(3, idBoto.length);
        var nomS = $("#idS" + idSeccio + " div div div h3").text();
        $("#modal1").modal("toggle");
        $("#idSeccioForm").val(idSeccio);
        $("#nomSeccioForm").val(nomS);
    });

    $(document).on("click", ".nomModal", function() {
        var nomSeccio = $("#nomSeccioForm").val();
        var idSeccio = $("#idSeccioForm").val();
        actualitzarNomSeccio(idSeccio, nomSeccio);
    });

    $(document).on("click", ".editarNomCarta", function() {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        var nomC = $("#idC" + idCarta + " div div div h3").text();
        $("#modal4").modal("toggle");
        $("#nomC").val(nomC);
        $("#idCartaForm").val(idCarta);
    });

    $(document).on("click", ".bModificarCarta", function() {
        var nomCarta = $("#nomC").val();
        var idCarta = $("#idCartaForm").val();
        actualitzarNomCarta(idCarta, nomCarta);
    });

    $(document).on("click", ".eliminarCarta", function() {
        var idBoto = $(this).attr("id");
        idC = idBoto.substr(3, idBoto.length);
        $("#modal5").modal("toggle");
    });

    $(document).on("click", "#esborrarCarta", function() {
        eliminarCarta(idC);
        $("#seccions").empty();
    });

    $(document).on("click", "#afegirCarta", function() {
        $("#modal2").modal("toggle");
        $("#nomCartaForm").val("");
    });

    $(document).on("click", "#bAfegirCarta", function() {
        var nomCarta = $("#nomCartaForm").val();
        afegirCarta(nomCarta);
        $("#seccions").empty();
    });

    $(document).on("click", "#afegirSeccio", function() {
        $("#modal3").modal("toggle");
        $("#nomS").val("");
    });

    $(document).on("click", "#bAfegir", function() {
        var nomSeccio = $("#nomS").val();
        var idCarta = $("#afegirSeccio").attr("idCarta");
        afegirSeccio(nomSeccio, idCarta);
    });

    $(document).on("click", ".estatCarta", function() {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(4, idBoto.length);
        getCarta(idCarta);
        if (carta.actiu == 1) {
            desactivarCarta(idCarta);
        } else {
            activarCarta(idCarta);
            desactivarAltresCartes(idCarta);
        }
    });

    $(document).on("click", ".editarPlats", function() {
        var idBoto = $(this).attr("id");
        var idSeccio = idBoto.substr(3, idBoto.length);
        console.log(idSeccio);
        sessionStorage.setItem('idSeccio', idSeccio);
    });

});