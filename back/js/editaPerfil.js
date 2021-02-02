$(document).ready(function() {
    var establiment;
    var poblacions;
    var categories;
    getEstabliment(1);
    getPoblacions();
    getCategories();

    function editaNom() {

    }

    function editaDescripcio() {

    }

    function editaPerfil() {

    }

    function getEstabliment(id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                establiment = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", "../../api/establiment/readById.php?id=" + id, false);
        xhttp.send();
    }

    function getPoblacions() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                poblacions = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", "../../api/poblacio/read.php", false);
        xhttp.send();
    }

    function getCategories() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                categories = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", "../../api/categoria/read.php", false);
        xhttp.send();
    }

    function placeEstablimentVars() {
        $("#nomEstabliment").text(establiment.nom);
        for (var i = 1; i <= 5; i++) {
            var img = $("<img/>");
            img.attr("id", "pic" + i);
            img.attr(
                "src",
                "../../images/establiment/" + establiment.id + "/" + i + ".jpg"
            );
            img.attr("alt", "Restaurant Image");
            if (i != 1) {
                img.addClass("col-md-3 col-sm-6");
                $("#smallPics").append(img);
            } else {
                img.addClass("col");
                $("#bigPic").append(img);
            }
        }

        $("#descripcioEstabliment").text(establiment.descripcio);
        $("#input-nom").val(establiment.nom);
        $("#input-desripcio").val(establiment.descripcio);
        $("#nComensals").val(establiment.num_comensals);
        $("#correu_electronic").val(establiment.correu_electronic);

        for (var i = 0; i < poblacions.length; i++) {
            var option = $("<option/>", {
                value: poblacions[i].nom,
                id: "poblacio" + poblacions[i].id,
            });
            option.html(poblacions[i].nom);
            $("#localitat").append(option);
        }

        for (var i = 0; i < categories.length; i++) {
            var checkbox = $("<input/>", {
                type: "checkbox",
                id: "boxCateg" + categories.id,
                name: "boxCateg" + categories.id,
                value: categories.id,
            });
            for (var j = 0; j < establiment.categories.length; j++) {
                if (categories[i].id == establiment.categories[j].id) {
                    checkbox.attr("checked", "yes");
                }
            }
            var label = $("<label/>", { for: "boxCateg" + categories.id });
            label.html(categories.nom);
            checkbox.append(label);
            $("#especialitats").append(checkbox);
        }
    }
    placeEstablimentVars();
});