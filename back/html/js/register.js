$(document).ready(function () {

    function loadPoblacio() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var poblacio = JSON.parse(this.responseText);
                for (c in poblacio) {
                    var idPoblacio = poblacio[c].id;
                    var nom = poblacio[c].nom;
                    var item = $("<option/>", {
                        value: idPoblacio,
                        text: nom
                    });
                    $("#poblacio").append(item);
                }
            }
        };
        xhttp.open("GET", "https://api.restaurat.me/controller/poblacio/poblacio.php", true);
        xhttp.send();
    }

    function loadCategoria() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var categoria = JSON.parse(this.responseText);
                for (c in categoria) {
                    var idCat = categoria[c].id;
                    var nom = categoria[c].nom;
                    var div = $('<div/>', {
                        class: "form-check form-check-inline"
                    });
                    var item = $("<input>", {
                        class: "form-check-input",
                        type: 'checkbox',
                        name: 'id[]',
                        value: idCat
                    });
                    var label = $('<label/>', {
                        class: "form-check-label",
                        text: nom
                    });
                    div.append(item, label);
                    $("#checkBox").append(div);


                }
            }
        };
        xhttp.open("GET", "https://api.restaurat.me/controller/categoria/categoria.php", true);
        xhttp.send();
    }

    loadPoblacio();
    loadCategoria();
    bootstrapValidate('#nom', 'required:Aquest camp es obligatori!');
    bootstrapValidate('#email', 'required:email:Enter a valid E-Mail Address!');
    bootstrapValidate('#comensals', 'numeric:Caracter no valid');
    bootstrapValidate('#poblacio', 'required:Aquest camp es obligatori!');
    bootstrapValidate('#tlfn', 'numeric:Caracter no valid');
    bootstrapValidate('#pswd', 'Les contrasenyes han de coincidir!');
    bootstrapValidate('#pswdR', 'matches:#pswd:Les contrasenyes han de coincidir!');

});