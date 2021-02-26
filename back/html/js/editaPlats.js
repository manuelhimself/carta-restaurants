$(document).ready(function() {

    var alergens;
    var alergensPlat;
    var idSeccio = sessionStorage.getItem('idSeccio');
    var plats;
    var idP;
    var last_idPlat;

    if (idSeccio == null) {
        window.location.replace("login.php");
    }

    setNomSeccioTitol(idSeccio);
    selectAlergen();
    mostraPlats();

    function setTitol() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var seccio = JSON.parse(this.responseText);
                $("#direccioPlats").text("Plats de la secció " + seccio.nom);
            }
        };
        xhttp.open("POST", api + "/plat/readByIdSeccio.php?idSeccio=" + idSeccio, false);
        xhttp.send();
    }

    function setNomSeccioTitol(idSeccio){
        var xhttp = new XMLHttpRequest();
        var titol = $("#titol");
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var seccio = JSON.parse(this.responseText);
                var nom = seccio.nom;
                titol.empty();
                titol.text("Plats de la secció " + nom);
            }
        };
        xhttp.open("POST", api + "/seccio/readByIdSeccio.php?idSeccio=" + idSeccio, false);
        xhttp.send();
    }

    function getAlergens() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alergens = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/alergen/read.php", false);
        xhttp.send();
    }

    function selectAlergen() {
        getAlergens();
        for (a in alergens) {
            var nom = alergens[a].nom;
            var id = alergens[a].idAlergen;
            var selectAlergen = $("<option/>", { value: id, text: nom });
            $("#select").append(selectAlergen);
        }
    }

    function totsPlats(idS) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                plats = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/plat/readByIdSeccio.php?idSeccio=" + idS, false);
        xhttp.send();
    }

    function platsAlergen(idAlergen, idS) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                plats = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/plat/readByIdAlergen.php?idAlergen=" + idAlergen + "&idSeccio=" + idS, false);
        xhttp.send();
    }

    function mostraPlats() {
        $("#plats").empty();
        var idS = idSeccio;
        var idAlergen = $("#select").val();
        if (idAlergen == 0) {
            totsPlats(idS);
        } else {
            platsAlergen(idAlergen, idS);
        }
        for (var i = 0; i < plats.length; i++) {
            var nom = plats[i].nom;
            var idPlat = plats[i].idPlat;
            var descripcio = plats[i].descripcio;
            var preu = plats[i].preu;
            if (i % 3 == 0) {
                var rowDIV = $("<div/>", { class: "row" });
                $("#plats").append(rowDIV);
            }

            var colDIV = $("<div/>", { class: "col-md-4" });
            var cardDIV = $("<div/>", { class: "card rounded border-0 h-100", id: idPlat });
            var cardBody = $("<div/>", { class: "card-body p-4" });
            var divImg = $("<div/>", { class: "image-upload" });
            var cardImg = $("<img/>", { class: "img-fluid d-block mx-auto mb-3 imgRodona", alt: "plat", src: "/images/plat/" + idPlat + ".jpg", onerror:"this.onerror=null; this.src= '/images/plat/default.jpg'"});
            var cardIcon = $("<i/>", { class: "fa fa-trash" });
            var cardIcon1 = $("<i/>", { class: "fa fa-edit" });
            var cardDivP = $("<div/>");
            var cardDivBotons = $("<div/>", { class: "botons" });
            var cardInfo = $("<p/>", { class: "card-text font-italic" });
            var spanPreu = $("<span/>", { text: 'Preu: ' + preu });
            var spanDescripcio = $("<span/>", { text: descripcio });
            var br = $("<br>");
            var cardH4 = $("<h4/>", { text: nom });
            var cardA1 = $("<button/>", { type: "button", class: "editarPlat btn", id: "edP" + idPlat, text: "Edita" });
            var cardA2 = $("<a/>", { class: "eliminarPlat btn", id: "elP" + idPlat });
            var labelFileInput = $("<label/>", { for: "file-input" });
            cardA1.prepend(cardIcon1);
            cardA2.append(cardIcon);
            cardInfo.append(spanDescripcio, br, spanPreu);
            labelFileInput.append(cardImg);
            divImg.append(labelFileInput);
            cardDivBotons.append(cardA2, cardA1);
            cardDivP.append(cardInfo);
            cardBody.append(cardH4, cardDivP, cardDivBotons);
            cardDIV.append(divImg, cardBody);
            colDIV.append(cardDIV);
            rowDIV.append(colDIV);
        }
    }

    function eliminarPlat(idPlat) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                mostraPlats();
            }
        };
        xhttp.open("POST", api + "/plat/delete.php?idPlat=" + idPlat, false);
        xhttp.send();
    }

    function modificarPlat(idPlat, nom, descripcio, preu) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                mostraPlats();
            }
        };
        xhttp.open("POST", api + "/plat/update.php?idPlat=" + idPlat + "&nom=" + nom + "&descripcio=" + descripcio + "&preu=" + preu, false);
        xhttp.send();
    }

    function afegirCheckbox() {
        $(".checkbox").empty();
        var form = $(".checkbox");
        for (var i = 0; i < alergens.length; i++) {
            var id = alergens[i].idAlergen;
            var nom = alergens[i].nom;
            var checkbox = $("<input/>", { type: "checkbox", name: "idAlergens", value: nom, id: "chk" + id });
            var label = $("<label>", { for: alergens[i].nom, text: alergens[i].nom });
            form.append("<br>", label, checkbox);
        }
    }

    function getAlergensPlat(idPlat) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alergensPlat = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/alergen/readByIdPlat.php?idPlat=" + idPlat, false);
        xhttp.send();
    }

    function checkAlergens(idPlat) {
        getAlergensPlat(idPlat);
        for (var i = 0; i < alergens.length; i++) {
            for (var j = 0; j < alergensPlat.length; j++) {
                var idAlergen = alergensPlat[j].idAlergen;
                if (alergens[i].idAlergen == alergensPlat[j].idAlergen) {
                    $("#chk" + idAlergen).prop("checked", true);
                }
            }
        }
    }

    function eliminarAlergensPlat(idPlat) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

            }
        };
        xhttp.open("POST", api + "/alergen/deleteAllAlergenByIdPlat.php?idPlat=" + idPlat, false);
        xhttp.send();
    }

    function afegirPlat(nom, descripcio, preu, idS) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var plat = JSON.parse(this.responseText);
                last_idPlat = plat.id;
            }
        };
        xhttp.open("POST", api + "/plat/createPlat.php?nom=" + nom + "&descripcio=" + descripcio + "&preu=" + preu + "&idSeccio=" + idS, false);
        xhttp.send();
    }

    function afegirAlergenPlat(idAlergen, idPlat) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {}
        };
        xhttp.open("POST", api + "/plat/createAlergenPlat.php?idPlat=" + idPlat + "&idAlergen=" + idAlergen, false);
        xhttp.send();
    }

    function cambiarFile(idCard) {
        const input = document.getElementById('file-input');
        $("#" + idCard + " div label img").attr("src", "../images/plat/" + input.files[0].name);
    }

    $(document).on("change", "#select", function() {
        $("#select option[value=0]").text("Tots els plats");
        mostraPlats();
    });

    $(document).on("click", ".eliminarPlat", function() {
        var idBoto = $(this).attr("id");
        idP = idBoto.substr(3, idBoto.length);
        $("#modal2").modal("toggle");
    });

    $(document).on("click", "#esborrarPlat", function() {
        eliminarPlat(idP);
    });

    $(document).on("click", ".editarPlat", function() {
        afegirCheckbox();
        var idBoto = $(this).attr("id");
        idP = idBoto.substr(3, idBoto.length);
        checkAlergens(idP);
        var nomP = $("#" + idP + " div h4").text();
        var desc = $("#" + idP + " div p").find("span:eq(0)").text();
        var textPreu = $("#" + idP + " div div p").find("span:eq(1)").text();
        var preu = textPreu.substr(6, textPreu.length);
        $("#modal1").modal("toggle");
        $("#idPlat").val(idP);
        $("#nomPlat").val(nomP);
        $("#descripcioPlat").val(desc);
        $("#preuPlat").val(preu);
    });

    $(document).on("click", "#edita", function() {
        var nom = $("#nomPlat").val();
        idP = $("#idPlat").val();
        var preu = $("#preuPlat").val();
        var descripcio = $("#descripcioPlat").val();
        modificarPlat(idP, nom, descripcio, preu);
        var alergensChecked = Array();
        $("input:checkbox[name=idAlergens]:checked").each(function() {
            alergensChecked.push($(this).attr("id").substr(3, $(this).attr("id").length));
        });
        eliminarAlergensPlat(idP);
        for (var i = 0; i < alergensChecked.length; i++) {
            var idAlergen = alergensChecked[i];
            afegirAlergenPlat(idAlergen, idP);
        }

    });

    $(document).on("click", "#afegirPlat", function() {
        afegirCheckbox();
        $("#modal3").modal("toggle");
    });

    $(document).on("click", "#afegir", function() {
        var nom = $("#nomP").val();
        var descripcio = $("#descripcioP").val();
        var preu = $("#preuP").val();
        afegirPlat(nom, descripcio, preu, idSeccio);
        var alergensChecked = Array();
        $("input:checkbox[name=idAlergens]:checked").each(function() {
            alergensChecked.push($(this).attr("id").substr(3, $(this).attr("id").length));
        });
        for (var i = 0; i < alergensChecked.length; i++) {
            var idAlergen = alergensChecked[i];
            afegirAlergenPlat(idAlergen, last_idPlat);
        }
        mostraPlats();
    });

    $(document).on("change", "#file-input", function() {
        cambiarFile(59);
    });

});