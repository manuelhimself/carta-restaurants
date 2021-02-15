function logIn() {
    var u = $("#email").val();
    var p = $("#password").val();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var resposta = this.responseText;
            $("#m1").css("color", "red");
            if (resposta == "ERROR") {
                $("#m1").html("Email o contrasenya introduïts no valids");
            } else {
                sessionStorage.setItem('key', id);
                window.location.replace("editarPerfil.html");
            }
        }
    };
    xhttp.open(
        "POST",
        api + "/sessio/autentificacio.php?email=" + u + "&password=" + p,
        true
    );
    xhttp.send();
}