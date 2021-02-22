function tancarSessio() {
    sessionStorage.clear();
    window.location.replace("./login.php");
}

$(document).on("click","#tancaSessio", function(){
    tancarSessio();
});