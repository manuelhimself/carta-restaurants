var estabCategNom = new Array();
$(document).ready(function () {
    var establiment;
    var poblacions;
    var categories;
    var estabPobNom;
    var id = sessionStorage.getItem("key");

    // comprova si sa sessio esta iniciada //
    if (id == null) {
        window.location.replace("login.php");
    }

    getEstabliment(id);
    getPoblacions();
    getCategoriesFromDB();

    //Update profile functions
    function updateNom(nom) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
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
        xhttp.onreadystatechange = function () {
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

    function updateCategories(categId) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log("Funciona per " + establiment.id + "-" + categId);
            }
        };
        xhttp.open(
            "GET",
            api +
            "/establiment_categoria/insert.php?Establiment_id=" +
            establiment.id +
            "&Categoria_id=" +
            categId,
            false
        );
        xhttp.send();
    }

    function deleteCategories() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) { }
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
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) { }
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
        var categ = getCategories();
        deleteCategories();
        for (var i = 0; i < categ.length; i++) {
            console.log(categ[i]);
            updateCategories(categ[i]);
        }
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
            if (checkbox.is(":checked")) {
                checkedboxes.push(checkboxId);
            }
        }
        return checkedboxes;
    }

    //Inicializer functions

    function getEstabliment(id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                establiment = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/establiment/readById.php?id=" + id, false);
        xhttp.send();
    }

    function getPoblacions() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                poblacions = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/poblacio/read.php", false);
        xhttp.send();
    }

    function getCategoriesFromDB() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                categories = JSON.parse(this.responseText);
            }
        };
        xhttp.open("POST", api + "/categoria/read.php", false);
        xhttp.send();
    }

    function placeEstablimentVars() {
        console.log(establiment);
        $("#nomEstabliment").text(establiment.nom);
        for (var i = 1; i <= 5; i++) {
            var div = $("<div/>", { class: "image-upload" });
            var form = $("<form/>", {
                enctype: "multipart/form-data",
                action: "canviaFotoEstabliment.php",
                method: "POST",
                id: "form-" + establiment.id + "-" + i,
            });
            var maxSizeFile = $("<input/>", {
                type: "hidden",
                name: "MAX_FILE_SIZE",
                value: "3000000",
            });
            var imgName = $("<input/>", {
                type: "hidden",
                id: "input-name-" + establiment.id + "-" + i,
                name: "filename",
                value: establiment.id + "-" + i + ".jpg",
            });
            var label = $("<label/>", {
                for: "file-input-" + establiment.id + "-" + i,
            });
            var input = $("<input/>", {
                type: "file",
                id: "file-input-" + establiment.id + "-" + i,
                name: "file",
                style: "display: none",
            });
            input.attr("type", "file");
            var img = $("<img/>");
            img.attr("id", "pic" + i);
            img.attr(
                "src",
                "images/establiment/" + establiment.id + "-" + i + ".jpg"
            );
            img.attr(
                "onerror",
                "this.onerror=null; this.src='images/establiment/default.jpg'"
            );
            img.attr("alt", "Restaurant Image");
            label.append(img);
            form.append(maxSizeFile);
            form.append(imgName);
            form.append(label);
            form.append(input);
            div.append(form);
            if (i != 1) {
                div.addClass("col-md-3 col-6");
                $("#smallPics").append(div);
            } else {
                div.addClass("col");
                $("#bigPic").append(div);
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
                    window.estabCategNom.push(categories[i].nom);
                    checkbox.attr("checked", "yes");
                }
            }

            $("#especialitats").append(checkbox, label, "<br>");
        }
    }


    function mapStuff() {
        document.getElementById("x").value = establiment.lat;
        document.getElementById("y").value = establiment.lng;
        if (establiment.lat == 0 && establiment.lng == 0) {
            var map = L.map("map").setView(
                [39.60017583077754, 2.9943578633572976],
                9
            );
        } else {
            var map = L.map("map").setView([establiment.lat, establiment.lng], 17);
            L.marker([establiment.lat, establiment.lng]).addTo(map).bindPopup("Les cordenades del restaurant son (" + establiment.lat + ", " + establiment.lng + ")").openPopup();
        }
        var url = "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
        L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
            maxZoom: 18,
        }).addTo(map);

        var popup = L.popup();


        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("Heu fet clic al mapa a " + e.latlng.toString())
                .openOn(map);

            var lat = e.latlng.lat.toString();
            var lng = e.latlng.lng.toString();

            document.getElementById("x").value = lat;
            document.getElementById("y").value = lng;
        }

        map.on("click", onMapClick);

        $("#b1").click(function () {
            var lat = $("#x").val();
            var lng = $("#y").val();

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    mark = this.responseText;
                    alert(mark);
                }
            };
            xhttp.open(
                "POST",
                api +
                "/establiment/setCoordenades.php?lat=" +
                lat +
                "&lng=" +
                lng +
                "&id=" +
                id,
                true
            );
            xhttp.send();
            location.reload();
        });
    }

    mapStuff();

    //Execution
    placeEstablimentVars();

    estabPobNom = $("#localitat").children("option:selected").val();
    var liPob = $("<li/>").html(
        "<i class='fa fa-map-marker'></i> " + estabPobNom
    );
    var liTel = $("<li/>").html(
        "<i class='fa fa-phone-alt'></i> " + establiment.telefon
    );
    var liEmail = $("<li/>").html(
        "<i class='fa fa-envelope'></i> " + establiment.correu_electronic
    );
    var liNcomens = $("<li/>").html(
        "<i class='fa fa-user'></i> " + establiment.num_comensals
    );
    var textEspecialitats = "<i class='fas fa-utensils'></i> ";
    for (var i = 0; i < window.estabCategNom.length; i++) {
        console.log(window.estabCategNom[i]);
        if (i == window.estabCategNom.length - 1) {
            textEspecialitats = textEspecialitats.concat(window.estabCategNom[i]);
        } else {
            textEspecialitats = textEspecialitats.concat(
                window.estabCategNom[i] + ", "
            );
        }
    }
    var liEspecialitats = $("<li/>").html(textEspecialitats);
    $("#altresEstabliment").append(liPob);
    $("#altresEstabliment").append(liTel);
    $("#altresEstabliment").append(liEmail);
    $("#altresEstabliment").append(liNcomens);
    $("#altresEstabliment").append(liEspecialitats);

    $(document).on("click", "#bEditaNom", function () {
        var nom = $("#input-nom").val();
        updateNom(nom);
    });
    $(document).on("click", "#bEditaDescripcio", function () {
        var descripcio = $("#input-descripcio").val();
        updateDescripcio(descripcio);
    });
    $(document).on("click", "#bEditaPerfil", function() {
        editaPerfil();
        location.reload();
    });

    $("#file-input-" + establiment.id + "-1").on("change", function () {
        $("#form-" + establiment.id + "-1").submit();
    });
    $("#file-input-" + establiment.id + "-2").on("change", function () {
        $("#form-" + establiment.id + "-2").submit();
    });
    $("#file-input-" + establiment.id + "-3").on("change", function () {
        $("#form-" + establiment.id + "-3").submit();
    });
    $("#file-input-" + establiment.id + "-4").on("change", function () {
        $("#form-" + establiment.id + "-4").submit();
    });
    $("#file-input-" + establiment.id + "-5").on("change", function () {
        $("#form-" + establiment.id + "-5").submit();
    });
});