function demanderVoyage() {
    $(`#demandeVoyage`).show();
    $(`#boutonform`).hide();
}


function deconnect() {
    $('#name').val('');
    $('#mdp').val('');
    $('#deconnect').hide();
    window.location.href = "index.php";
}
