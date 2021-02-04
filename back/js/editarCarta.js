$(document).ready(function () {

    function mostrarCartes() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var cartes = JSON.parse(this.responseText);
                var p = $("<p/>")
                $("#cartes").html(p);
                var i = 0;
                for (c in cartes) {

                    if (i % 3 == 0) {
                        var rowDIV = $("<div/>", { class: "row" });
                        $("#cartes").append(rowDIV);
                    }
                    i++;

                    var nom = cartes[c].nom;
                    var idCarta = cartes[c].idCarta;
                    var actiu = cartes[c].actiu;

                    var colDIV = $("<div/>", { class: "col-md-4" });
                    var cardDIV = $("<div/>", { class: "card", id: idCarta });
                    var cardBody = $("<div/>", { class: "card-body" });
                    var cardIcon = $("<i/>", { class: "fa fa-trash" });
                    var cardIcon1 = $("<i/>", { class: "fa fa-edit" });
                    var cardH1 = $("<h1/>", { class: "card-title", text: nom });
                    var cardA1 = $("<button/>", { type: "button", class: "editarCarta btn", id: "edC" + idCarta, text: "Mostra seccions" });
                    var cardA2 = $("<a/>", { class: "eliminarCarta btn", id: "elC" + idCarta });
                    var cardA3 = $("<button/>", { type: "button", class: "editarNomCarta btn", id: "edN" + idCarta, text: "Editar Nom" });
                    var divForm = $("<div/>", {class: "form-check form-switch"});
                    var inputCheck = $("<input/>", {class: "form-check-input", type: "checkbox", id: "chk" + idCarta});
                    var labelCheck = $("<label/>", {class: "form-check-label", for:"chk"+idCarta});
                    /*var cardA4 = $("<button/>", { type: "button", class: "activarCarta btn", id: "actC" + idCarta, text: "Activar/Desactivar Carta" });*/
                    inputCheck.append(labelCheck);
                    divForm.append(inputCheck);
                    cardA3.append(cardIcon1);
                    cardA2.append(cardIcon);
                    cardBody.append(cardH1, cardA1, cardA2, cardA3, divForm);
                    cardDIV.append(cardBody);
                    colDIV.append(cardDIV);
                    rowDIV.append(colDIV);

                }
                aplicarEstilCartes();
            }
        };
        xhttp.open("POST", "../../api/carta/read.php", true);
        xhttp.send();
    }

    function mostrarSeccions(idC) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var seccions = JSON.parse(this.responseText);
                var divHead = $("<div/>");
                var botoAfegirSeccio = $("<button/>", { type: "button", class: "btn", id: "afegirSeccio", idCarta: idC, text: "Afegir secció" });
                var titol = $("<h1/>", { text: "Seccions", id: "titol" });
                divHead.append(titol, botoAfegirSeccio);
                $("#seccions").html(divHead);
                var i = 0;
                for (s in seccions) {

                    if (i % 1 == 0) {
                        var rowDIV = $("<div/>", {
                            class: "row justify-content-md-center",
                        });
                        $("#seccions").append(rowDIV);
                    }
                    i++;

                    var idCarta = seccions[s].idCarta;
                    var idSeccio = seccions[s].idSeccio;
                    var nom = seccions[s].nom;

                    var colDIV = $("<div/>", { class: "col" });
                    var cardDIV = $("<div/>", { class: "card" });
                    var cardBody = $("<div/>", { class: "card-body" });
                    var rowCard = $("<div/>", { class: "row align-items-center" });
                    var colDivButton = $("<div/>", { class: "col-md-3 col-sm-12" });
                    var colDivH1 = $("<div/>", { class: "col-md-9 col-sm-12 d-flex justify-content-center" });
                    var colDivButton = $("<div/>", { class: "col-md-3" });
                    var divH1 = $("<div>", { class: "divH1" });
                    var cardH1 = $("<h1/>", { class: "card-title", text: nom });
                    var cardIcon1 = $("<i/>", { class: "fa fa-trash" });
                    var cardA1 = $("<button/>", { type: "button", class: "editarSeccioNom btn", id: "edS" + idSeccio, idCarta: idCarta, text: "Editar Nom" });
                    var cardA2 = $("<button/>", { type: "button", class: "editarPlats btn", id: "edP" + idSeccio, text: "Editar Plats" });
                    var cardA3 = $("<a/>", { class: "eliminarSeccio btn", id: "elS" + idSeccio, idCarta: idCarta });
                    var cardIcon2 = $("<i/>", { class: "fa fa-edit" });
                    var cardIcon3 = $("<i/>", { class: "fa fa-edit" });
                    var groupButton = $("<div/>", { class: "btn-group" });
                    var list = $("<ul/>", { id: "llistaBotons" });
                    var li1 = $("<li/>");
                    var li2 = $("<li/>");
                    var li3 = $("<li/>");
                    cardA1.append(cardIcon3);
                    cardA2.append(cardIcon2);
                    cardA3.append(cardIcon1);
                    li1.append(cardA1);
                    li2.append(cardA2);
                    li3.append(cardA3);
                    list.append(li1, li2, li3);
                    groupButton.append(list);
                    divH1.append(cardH1);
                    colDivButton.append(groupButton);
                    colDivH1.append(divH1);
                    rowCard.append(colDivH1, colDivButton);
                    cardBody.append(rowCard);
                    cardDIV.append(cardBody);
                    colDIV.append(cardDIV);
                    rowDIV.append(colDIV);
                }
                aplicarEstilSeccions();
            }
        };
        xhttp.open("POST", "../../api/seccio/readByIdCarta.php?idCarta=" + idC, true);
        xhttp.send();
    }

    function aplicarEstilCartes() {
        $(".card").css("background-color", "#414749");
        $(".card").css("color", "#FFFFFF");
        $(".btn").css("background-color", " #A33E3E");
        $(".btn").css("border-color", " #FFFFFF");
        $(".btn").css("color", " #FFFFFF");
        $("a").css("color", "#FFFFFF");
        $(".card").css("height", "100%");
    }

    function aplicarEstilSeccions() {
        $(".card").css("background-color", "#414749");
        $(".card").css("color", "#FFFFFF");
        $(".btn").css("background-color", " #A33E3E");
        $(".btn").css("border-color", " #FFFFFF");
        $(".btn").css("color", " #FFFFFF");
        $("h4").css("float", "left");
        $("ul").css("list-style-type", "none");
        $("li").css("margin-top", "5%");
        $(".divH1").css("width", "80%");
        $(".divH1").css("float", "left");
        $(".divH1").css("text-align", "center");
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
        xhttp.open("POST", "../../api/seccio/update.php?idSeccio=" + idS + "&idCarta=" + idC + "&nomSeccio=" + nomSeccio, true);
        xhttp.send();
    }

    function actualitzarNomCarta(idC, nomCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("POST", "../../api/carta/update.php?idCarta=" + idC + "&nomCarta=" + nomCarta, true);
        xhttp.send();
    }

    function afegirCarta(nomCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("POST", "../../api/carta/create.php?nomCarta=" + nomCarta, true);
        xhttp.send();
    }

    function afegirSeccio(nomSeccio, idC) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarSeccions(idC);
            }
        };
        xhttp.open("POST", "../../api/seccio/create.php?nomSeccio=" + nomSeccio + "&idCarta=" + idC, true);
        xhttp.send();
    }

    function activarCarta(idC){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("POST", "../../api/carta/activate.php?idCarta=" + idC, true);
        xhttp.send();
    }

    function desactivarCarta(idC){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("POST", "../../api/carta/desactivate.php?idCarta=" + idC, true);
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

    $(document).on("click", ".editarNomCarta", function () {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        $("#modal4").modal("toggle");
        $(document).on("click", ".bModificarCarta", function () {
            var nomCarta = $("#nomC").val();
            actualitzarNomCarta(idCarta, nomCarta);
        });
    });

    /*$(document).on("click", ".editarNomCarta", function () {
        $("#modal4").modal("toggle");
    });

    $(document).on("click", ".bModificarCarta", function () {
        var nomCarta = $("#nomC").val();
        var idBoto = $(".editarNomCarta").attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        actualitzarNomCarta(idCarta, nomCarta);
    })*/


    $(document).on("click", ".eliminarCarta", function () {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        eliminarCarta(idCarta);
        $("#seccions").empty();
    });

    $(document).on("click", "#afegirCarta", function () {
        $("#modal2").modal("toggle");
    });

    $(document).on("click", "#bAfegirCarta", function () {
        var nomCarta = $("#nomCartaForm").val();
        afegirCarta(nomCarta);
        $("#seccions").empty();
    });

    $(document).on("click", "#afegirSeccio", function () {
        $("#modal3").modal("toggle");
    });

    $(document).on("click", "#bAfegir", function () {
        var nomSeccio = $("#nomS").val();
        var idCarta = $("#afegirSeccio").attr("idCarta");
        afegirSeccio(nomSeccio, idCarta);
    });

    $(document).on("click", ".activarCarta", function () {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(4, idBoto.length);
        activarCarta(idCarta);
    });

});