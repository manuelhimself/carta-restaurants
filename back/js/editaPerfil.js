$(document).ready(function() {
    function editaTitol() {
        $("#edita-title").click(function() {});
    }

    function getEstabliment(id) {
        var establiment = -1;
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "../../api/establiment/readById.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id=" + id);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                establiment = JSON.parse(this.responseText);
            }
        };
        return establiment;
    }

    function placeEstablimentVars() {
        var establiment = getEstabliment(1);

        //Establiment vars
        var nom = establiment.nom;
        var descripcio = establiment.descripcio;
        var num_comensals = establiment.num_comensals;
        var poblacioId = establiment.PoblacioId;


    }
});