$(document).ready(function () {

    var carta;
    var seccions;
    var cartes;
    mostrarCartes();

    function getCarta(id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                carta = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", "../../api/carta/readByIdCarta.php?idCarta=" + id, false);
        xhttp.send();
    }

    function getCartes() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                cartes = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", "../../api/carta/read.php?", false);
        xhttp.send();
    }

    function getSeccions(idC) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                seccions = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", "../../api/seccio/readByIdCarta.php?idCarta=" + idC, false);
        xhttp.send();
    }

    function mostrarCartes() {
        $("#cartes").empty();
        getCartes();
        for (var i = 0; i < cartes.length; i++) {
            var nom = cartes[i].nom;
            var id = cartes[i].idCarta;
            var estat = cartes[i].actiu;
            if (i % 3 == 0) {
                var rowDIV = $("<div/>", { class: "row" });
                $("#cartes").append(rowDIV);
            }
            var colDIV = $("<div/>", { class: "col-md-4" });
            var cardDIV = $("<div/>", { class: "card", id: id });
            var cardBody = $("<div/>", { class: "card-body" });
            var cardIcon = $("<i/>", { class: "fa fa-trash" });
            var cardIcon1 = $("<i/>", { class: "fa fa-edit" });
            var cardH1 = $("<h1/>", { class: "card-title", text: nom });
            var cardA1 = $("<button/>", { type: "button", class: "editarCarta btn", id: "edC" + id, text: "Mostra seccions" });
            var cardA2 = $("<a/>", { class: "eliminarCarta btn", id: "elC" + id });
            var cardA3 = $("<button/>", { type: "button", class: "editarNomCarta btn", id: "edN" + id, text: "Editar Nom" });
            var divForm = $("<div/>", { class: "form-check form-switch" });
            var inputCheck = $("<input/>", { class: "form-check-input", type: "checkbox", id: "chk" + id });
            var labelCheck = $("<label/>", { class: "form-check-label", for: "chk" + id, text: "Activar/Desactivar" });
            /*var cardA4 = $("<button/>", { type: "button", class: "activarCarta btn", id: "actC" + idCarta, text: "Activar/Desactivar Carta" });*/
            divForm.append(inputCheck, labelCheck);
            cardA3.append(cardIcon1);
            cardA2.append(cardIcon);
            cardBody.append(cardH1, cardA1, cardA2, cardA3, divForm);
            cardDIV.append(cardBody);
            colDIV.append(cardDIV);
            rowDIV.append(colDIV);
        }
        aplicarEstilCartes();
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

    function mostrarSeccions(idC) {
        var divHead = $("<div/>");
        var botoAfegirSeccio = $("<button/>", { type: "button", class: "btn", id: "afegirSeccio", idCarta: idC, text: "Afegir secció" });
        var titol = $("<h1/>", { text: "Seccions", id: "titol" });
        divHead.append(titol, botoAfegirSeccio);
        $("#seccions").html(divHead);
        getSeccions(idC);
        for (var i = 0; i < seccions.length; i++) {
            var nom = seccions[i].nom;
            var id = seccions[i].idSeccio;
            var idCarta = seccions[i].idCarta;
            if (i % 1 == 0) {
                var rowDIV = $("<div/>", {
                    class: "row justify-content-md-center",
                });
                $("#seccions").append(rowDIV);
            }
            var colDIV = $("<div/>", { class: "col" });
            var cardDIV = $("<div/>", { class: "card", id: id });
            var cardBody = $("<div/>", { class: "card-body" });
            var rowCard = $("<div/>", { class: "row align-items-center" });
            var colDivButton = $("<div/>", { class: "col-md-3 col-sm-12" });
            var colDivH1 = $("<div/>", { class: "col-md-9 col-sm-12 d-flex justify-content-center" });
            var colDivButton = $("<div/>", { class: "col-md-3" });
            var divH1 = $("<div>", { class: "divH1" });
            var cardH1 = $("<h1/>", { class: "card-title", text: nom });
            var cardIcon1 = $("<i/>", { class: "fa fa-trash" });
            var cardA1 = $("<button/>", { type: "button", class: "editarSeccioNom btn", id: "edS" + id, idCarta: idCarta, text: "Editar Nom" });
            var cardA2 = $("<button/>", { type: "button", class: "editarPlats btn", id: "edP" + id, text: "Editar Plats" });
            var cardA3 = $("<a/>", { class: "eliminarSeccio btn", id: "elS" + id, idCarta: idCarta });
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

    function eliminarSeccio(idSeccio, idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarSeccions(idCarta);
            }
        };
        xhttp.open("POST", "../../api/seccio/delete1.php?idSeccio=" + idSeccio, false);
        xhttp.send();
    }

    function eliminarCarta(idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("POST", "../../api/carta/delete1.php?idCarta=" + idCarta, false);
        xhttp.send();
    }

    function actualitzarNomSeccio(idSeccio, nomSeccio) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var id = "#"+idSeccio+ " div div div div h1";
                console.log(id);
                $(id).text(nomSeccio);
            }
        };
        xhttp.open("POST", "../../api/seccio/update.php?idSeccio=" + idSeccio + "&nomSeccio=" + nomSeccio, true);
        xhttp.send();
    }

    function actualitzarNomCarta(idCarta, nomCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var id = "#"+idCarta+ " div h1";
                console.log(id);
                $(id).html(nomCarta);
            }
        };
        xhttp.open("POST", "../../api/carta/update.php?idCarta=" + idCarta + "&nomCarta=" + nomCarta, true);
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

    function afegirSeccio(nomSeccio, idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarSeccions(idCarta);
            }
        };
        xhttp.open("POST", "../../api/seccio/create.php?nomSeccio=" + nomSeccio + "&idCarta=" + idCarta, true);
        xhttp.send();
    }

    function activarCarta(idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("POST", "../../api/carta/activate.php?idCarta=" + idCarta, true);
        xhttp.send();
    }

    function desactivarCarta(idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("POST", "../../api/carta/desactivate.php?idCarta=" + idCarta, true);
        xhttp.send();
    }

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
        $("#modal1").modal("toggle");
        $("#idSeccioForm").val(idSeccio);
        $(document).on("click", ".nomModal", function () {
            var nomSeccio = $("#nomSeccioForm").val();
            idSeccio = $("#idSeccioForm").val();
            actualitzarNomSeccio(idSeccio, nomSeccio);
        });
    });
    
    $(document).on("click", ".editarNomCarta", function () {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        $("#modal4").modal("toggle");
        $("#idCartaForm").val(idCarta);
        $(document).on("click", ".bModificarCarta", function () {
            var nomCarta = $("#nomC").val();
            idCarta = $("#idCartaForm").val();
            actualitzarNomCarta(idCarta, nomCarta);
        });
    });   

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

    $(document).on("change", ".activarCarta", function () {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(4, idBoto.length);
        activarCarta(idCarta);
    });

});