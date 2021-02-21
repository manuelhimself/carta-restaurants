$(document).ready(function () {

    var carta;
    var seccions;
    var cartes;
    var idC;
    var idS;
    var idEstabliment = sessionStorage.getItem('key');
    console.log(idEstabliment);

    if(idEstabliment == null){
        window.location.replace("login.php");
    }

    mostrarCartes();

    function getCarta(id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                carta = JSON.parse(this.responseText);
            }
        };
        xhttp.open("GET", "https://api.restaurat.me/controller/carta/readByIdCarta.php?idCarta=" + id, false);
        xhttp.send();
    }

    function getCartes() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                cartes = JSON.parse(this.responseText);
            }
        };
        xhttp.open("GET", "https://api.restaurat.me/controller/carta/readByIdEstabliment.php?idEstabliment=" + idEstabliment, false);
        xhttp.send();
    }

    function getSeccions(idC) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                seccions = JSON.parse(this.responseText);
            }
        };
        xhttp.open("GET", "https://api.restaurat.me/controller/seccio/readByIdCarta.php?idCarta=" + idC, false);
        xhttp.send();
    }

    function mostrarCartes() {
        $("#cartes").empty()
        getCartes();
        for (var i = 0; i < cartes.length; i++) {
            var nom = cartes[i].nom;
            var id = cartes[i].idCarta;
            if (i % 3 == 0) {
                var rowDIV = $("<div/>", { class: "row" });
                $("#cartes").append(rowDIV);
            }
            var colDIV = $("<div/>", { class: "col-md-4" });
            var cardDIV = $("<div/>", { class: "card", id: id });
            var cardBody = $("<div/>", { class: "card-body" });
            var cardIcon = $("<i/>", { class: "fa fa-trash" });
            var cardIcon1 = $("<i/>", { class: "fa fa-edit" });
            var cardIcon2 = $("<i/>", { class: "fa fa-eye"});
            var cardH1 = $("<h1/>", { class: "card-title", text: nom });
            var cardA1 = $("<button/>", { type: "button", class: "editarCarta btn", id: "edC" + id, text: "Mostra seccions" });
            var cardA2 = $("<a/>", { class: "eliminarCarta btn", id: "elC" + id });
            var cardA3 = $("<button/>", { type: "button", class: "editarNomCarta btn", id: "edN" + id });
            var divForm = $("<div/>", { class: "form-check form-switch" });
            var inputCheck = $("<input/>", { class: "form-check-input estatCarta", type: "checkbox", id: "chk" + id });
            var labelCheck = $("<label/>", { class: "form-check-label", for: "chk" + id, text: "Activar/Desactivar" });

            divForm.append(inputCheck, labelCheck);
            cardA1.append(cardIcon2);
            cardA3.append(cardIcon1);
            cardA2.append(cardIcon);
            cardBody.append(cardH1, cardA1, cardA2, cardA3, divForm);
            cardDIV.append(cardBody);
            colDIV.append(cardDIV);
            rowDIV.append(colDIV);
        }
        actualitzarCheckCartes();
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
            var colDIV = $("<div/>", { class: "col-md-6" });
            var cardDIV = $("<div/>", { class: "card", id: id });
            var cardBody = $("<div/>", { class: "card-body" });
            var rowCard = $("<div/>", { class: "row align-items-center" });
            var colDivButton = $("<div/>", { class: "col-md-4 d-flex justify-content-center" });
            var colDivH1 = $("<div/>", { class: "col-md-8 d-flex justify-content-center" });
            var divH1 = $("<div>", { class: "divH1" });
            var cardH1 = $("<h1/>", { class: "card-title", text: nom });
            var cardIcon1 = $("<i/>", { class: "fa fa-trash" });
            var cardA1 = $("<button/>", { type: "button", class: "editarSeccioNom btn", id: "edS" + id, idCarta: idCarta });
            var cardA2 = $("<a/>", { href: "editarPlats.html", class: "editarPlats btn", id: "edP" + id, text: "Mostrar Plats" });
            var cardA3 = $("<a/>", { class: "eliminarSeccio btn", id: "elS" + id, idCarta: idCarta });
            var cardIcon2 = $("<i/>", { class: "fa fa-eye" });
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
        
    }

    function eliminarSeccio(idSeccio, idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarSeccions(idCarta);
            }
        };
        xhttp.open("GET", "https://api.restaurat.me/controller/seccio/delete1.php?idSeccio=" + idSeccio, false);
        xhttp.send();
    }

    function eliminarCarta(idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("GET", "https://api.restaurat.me/controller/carta/delete1.php?idCarta=" + idCarta, false);
        xhttp.send();
    }

    function actualitzarNomSeccio(idSeccio, nomSeccio) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var id = "#" + idSeccio + " div div div div h1";
                $(id).text(nomSeccio);
            }
        };
        xhttp.open("GET", api + "https://api.restaurat.me/controller/seccio/update.php?idSeccio=" + idSeccio + "&nomSeccio=" + nomSeccio, true);
        xhttp.send();
    }

    function actualitzarNomCarta(idCarta, nomCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var id = "#" + idCarta + " div h1";
                $(id).text(nomCarta);
            }
        };
        xhttp.open("GET", "https://api.restaurat.me/controller/carta/update.php?idCarta=" + idCarta + "&nomCarta=" + nomCarta, true);
        xhttp.send();
    }

    function afegirCarta(nomCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarCartes();
            }
        };
        xhttp.open("GET", "https://api.restaurat.me/controller/carta/create.php?nomCarta=" + nomCarta + "&idEstabliment=" + idEstabliment, true);
        xhttp.send();
    }

    function afegirSeccio(nomSeccio, idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                mostrarSeccions(idCarta);
            }
        };
        xhttp.open("GET", "https://api.restaurat.me/controller/seccio/create.php?nomSeccio=" + nomSeccio + "&idCarta=" + idCarta, true);
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

    function actualitzarCheckCartes() {
        var idCarta;
        for (var i = 0; i < cartes.length; i++) {
            idCarta = cartes[i].idCarta;
            if (cartes[i].actiu == 0) {
                $("#chk" + idCarta).prop("checked", false);
            } else {
                $("#chk" + idCarta).prop("checked", true);
            }
        }
    }

    function activarCarta(idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

            }
        };
        xhttp.open("GET", "https://api.restaurat.me/controller/carta/activate.php?idCarta=" + idCarta, true);
        xhttp.send();
    }

    function desactivarCarta(idCarta) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {

            }
        };
        xhttp.open("GET", "https://api.restaurat.me/controller/carta/desactivate.php?idCarta=" + idCarta, true);
        xhttp.send();
    }

    $(document).on("click", ".editarCarta", function () {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        mostrarSeccions(idCarta);
    });

    $(document).on("click", ".eliminarSeccio", function () {
        var idBoto = $(this).attr("id");
        idS = idBoto.substr(3, idBoto.length);
        idC = $(this).attr("idCarta");
        $("#modal6").modal("toggle");
    });

    $(document).on("click", "#esborrarSeccio", function () {
        eliminarSeccio(idS, idC);
    });

    $(document).on("click", ".editarSeccioNom", function () {
        var idBoto = $(this).attr("id");
        var idSeccio = idBoto.substr(3, idBoto.length);
        var nomS = $("#" + idSeccio + " div div div div h1").text();
        $("#modal1").modal("toggle");
        $("#idSeccioForm").val(idSeccio);
        $("#nomSeccioForm").val(nomS);
    });

    $(document).on("click", ".nomModal", function () {
        var nomSeccio = $("#nomSeccioForm").val();
        var idSeccio = $("#idSeccioForm").val();
        actualitzarNomSeccio(idSeccio, nomSeccio);
    });

    $(document).on("click", ".editarNomCarta", function () {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        var nomC = $("#" + idCarta + " div h1").text();
        $("#modal4").modal("toggle");
        $("#nomC").val(nomC);
        $("#idCartaForm").val(idCarta);
    });

    $(document).on("click", ".bModificarCarta", function () {
        var nomCarta = $("#nomC").val();
        var idCarta = $("#idCartaForm").val();
        actualitzarNomCarta(idCarta, nomCarta);
    });

    $(document).on("click", ".eliminarCarta", function () {
        var idBoto = $(this).attr("id");
        idC = idBoto.substr(3, idBoto.length);
        $("#modal5").modal("toggle");
    });

    $(document).on("click", "#esborrarCarta", function () {
        eliminarCarta(idC);
        $("#seccions").empty();
    });

    $(document).on("click", "#afegirCarta", function () {
        $("#modal2").modal("toggle");
        $("#nomCartaForm").val("");
    });

    $(document).on("click", "#bAfegirCarta", function () {
        var nomCarta = $("#nomCartaForm").val();
        afegirCarta(nomCarta);
        $("#seccions").empty();
    });

    $(document).on("click", "#afegirSeccio", function () {
        $("#modal3").modal("toggle");
        $("#nomS").val("");
    });

    $(document).on("click", "#bAfegir", function () {
        var nomSeccio = $("#nomS").val();
        var idCarta = $("#afegirSeccio").attr("idCarta");
        afegirSeccio(nomSeccio, idCarta);
    });

    $(document).on("change", ".estatCarta", function () {
        var idBoto = $(this).attr("id");
        var idCarta = idBoto.substr(3, idBoto.length);
        getCarta(idCarta);
        if (carta.actiu == 1) {
            desactivarCarta(idCarta);
        } else {
            activarCarta(idCarta);
            desactivarAltresCartes(idCarta);
            $('.estatCarta').not(this).prop('checked', false);
        }
    });

    $(document).on("click", ".editarPlats", function () {
        var idBoto = $(this).attr("id");
        var idSeccio = idBoto.substr(3, idBoto.length);
        console.log(idSeccio);
        sessionStorage.setItem('idSeccio',idSeccio);
    });

});