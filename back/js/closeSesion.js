function tancarSessio() {
    sessionStorage.clear();
    window.location.replace("../html/login.html");
}

$(document).on("click","#tancaSessio", function(){
    tancarSessio();
});