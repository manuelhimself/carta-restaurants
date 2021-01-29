$(document).ready(function() {

    var establiment = getEstabliment(1);
    var poblacions = getPoblacions();
    var categories = getCategories();

    function editaTitol() {
        $("#edita-title").click(function() {});
    }

    function getEstabliment(id) {
        var establiment = -1;
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../../api/establiment/readById.php?id=" + id, false);
        xhttp.send();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                establiment = JSON.parse(this.responseText);
            }
        };
        return establiment;
    }

    function getPoblacions() {
        var xhttp = new XMLHttpRequest();
        var pob = -1;
        xhttp.open("POST", "../../api/poblacio/read.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                pob = JSON.parse(this.responseText);
            }
        };
        return pob;
    }

    function getCategories() {
        var categor = -1;
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../../api/categoria/read.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                categor = JSON.parse(this.responseText);
            }
        };
        return categor;
    }

    function placeEstablimentVars() {

        //Establiment vars
        var nom = establiment.nom;
        var correu_electronic = establiment.correu_electronic;
        var num_comensals = establiment.num_comensals;
        var poblacioId = establiment.PoblacioId;
        var descripcio = establiment.descripcio;
        var categories = establiment.categories;
        console.log(establiment);
        console.log(nom + " " + descripcio);


        $("#nomEstabliments").text(nom);
        $("#descripcioEstabliment").text(descripcio);
        $("#input-nom").val(nom);
        $("#input-desripcio").val(descripcio);
        $("#localitat").val(descripcio);
        $("#nComensals").val(num_comensals);
        $("#correu_electronic").val(correu_electronic);
    }

    placeEstablimentVars();
});