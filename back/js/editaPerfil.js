$(document).ready(function() {
    var establiment;
    var poblacions;
    var categories;
    var id = sessionStorage.getItem("key");
    // comprova si sa sessio esta iniciada //
    if (id == null) {
        window.location.replace("login.html");
    }
    getEstabliment(id);
    getPoblacions();
    getCategoriesFromDB();

    //Update profile functions
    function updateNom(nom) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                $("#nomEstabliment").text(nom);
            }
        };
        xhttp.open(
            "POST",
            api + "/establiment/updateNom.php?id=" + establiment.id + "&nom=" + nom,
            false
        );
        xhttp.send();
    }

    function updateDescripcio(descripcio) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                $("#descripcioEstabliment").text(descripcio);
            }
        };
        xhttp.open(
            "POST",
            api +
            "/establiment/updateDescripcio.php?id=" +
            establiment.id +
            "&descripcio=" +
            descripcio,
            false
        );
        xhttp.send();
    }

    function updateCategories(i) {
        var categories = getCategories();
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {}
        };
        xhttp.open(
            "POST",
            api +
            "/establiment_categoria/insert.php?Establiment_id=" +
            establiment.id +
            "&CategoriaId=" +
            categories[i],
            false
        );
        xhttp.send();
    }

    function deleteCategories() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {}
        };
        xhttp.open(
            "POST",
            api +
            "/establiment_categoria/delete.php?Establiment_id=" +
            establiment.id,
            false
        );
        xhttp.send();
    }

    function updateOthers() {
        var pobId = getPoblacioId();
        console.log(pobId);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {}
        };
        xhttp.open(
            "POST",
            api +
            "/establiment/updateOthers.php?id=" +
            establiment.id +
            "&correu_electronic=" +
            $("#correu_electronic").val() +
            "&num_comensals=" +
            $("#nComensals").val() +
            "&telefon=" +
            $("#telefon").val() +
            "&poblacio_id=" +
            pobId,
            false
        );
        xhttp.send();
    }

    function editaPerfil() {
        //var categories = getCategories();
        //deleteCategories();
        //for (var i = 0; i < categories.length; i++) {
        //updateCategories(1);
        //}
        updateOthers();
    }

    function getPoblacioId() {
        var optionId = $("#localitat").children("option:selected").attr("id");
        optionId = optionId.replace("poblacio", "");
        console.log(optionId);
        return optionId;
    }

    function getCategories() {
        var checkedboxes = new Array();
        for (var i = 1; i < categories.length + 1; i++) {
            var checkbox = $("#boxCateg" + i);
            var checkboxId = checkbox.attr("id").replace("boxCateg", "");
            if (checkbox.attr("checked")) {
                checkedboxes.push(checkboxId);
            }
        }
        return checkedboxes;
    }

    //Inicializer functions

    function getEstabliment(id) {
        console.log(id);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                establiment = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/establiment/readById.php?id=" + id, false);
        xhttp.send();
    }

    function getPoblacions() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                poblacions = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/poblacio/read.php", false);
        xhttp.send();
    }

    function getCategoriesFromDB() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                categories = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/categoria/read.php", false);
        xhttp.send();
    }

    function placeEstablimentVars() {
        $("#nomEstabliment").text(establiment.nom);
        for (var i = 1; i <= 5; i++) {
            var link = $("<a/>");
            link.attr("id", "a" + i);
            var img = $("<img/>");
            img.attr("id", "pic" + i);
            img.attr(
                "src",
                "../images/establiment/" + establiment.id + "-" + i + ".jpg"
            );
            img.attr("alt", "Restaurant Image");
            if (i != 1) {
                link.addClass("col-md-3 col-sm-6");
                //img.addClass("col-md-3 col-sm-6");
                link.append(img);
                $("#smallPics").append(link);
            } else {
                link.addClass("col");
                //img.addClass("col");
                link.append(img);
                $("#bigPic").append(link);
            }
        }

        $("#descripcioEstabliment").text(establiment.descripcio);
        $("#input-nom").val(establiment.nom);
        $("#input-descripcio").val(establiment.descripcio);
        $("#nComensals").val(establiment.num_comensals);
        $("#correu_electronic").val(establiment.correu_electronic);
        $("#telefon").val(establiment.telefon);

        for (var i = 0; i < poblacions.length; i++) {
            var option = $("<option/>", {
                value: poblacions[i].nom,
                id: "poblacio" + poblacions[i].id,
            });
            if (poblacions[i].id == establiment.poblacio_id) {
                option.attr("selected", "selected");
            }
            option.html(poblacions[i].nom);
            $("#localitat").append(option);
        }

        for (var i = 0; i < categories.length; i++) {
            var label = $("<label/>", { for: "boxCateg" + categories[i].id });
            label.html(categories[i].nom);
            var checkbox = $("<input/>", {
                type: "checkbox",
                id: "boxCateg" + categories[i].id,
                name: "boxCateg" + categories[i].id,
                value: categories[i].id,
                class: "checkbox",
            });

            for (var j = 0; j < establiment.categories.length; j++) {
                if (categories[i].id == establiment.categories[j]) {
                    checkbox.attr("checked", "yes");
                }
            }

            $("#especialitats").append(checkbox, label, "<br>");
        }
    }

    //Execution
    placeEstablimentVars();
    $(document).on("click", "#bEditaNom", function() {
        var nom = $("#input-nom").val();
        updateNom(nom);
    });
    $(document).on("click", "#bEditaDescripcio", function() {
        var descripcio = $("#input-descripcio").val();
        updateDescripcio(descripcio);
    });
    $(document).on("click", "#bEditaPerfil", function() {
        editaPerfil();
    });
});