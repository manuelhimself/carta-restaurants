function tancarSessio() {
    sessionStorage.clear();
    window.location.replace("../html/login.php");
}

$(document).on("click","#tancaSessio", function(){
    tancarSessio();
});