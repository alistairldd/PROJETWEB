function demanderVoyage() {
    $(`#demandeVoyage`).show();
    $(`#boutonform`).hide();
}


function deconnect() {
    $('#nom').val('');
    $('#mdp').val('');
    $('#deconnect').hide();
    window.location.href = "index.php";
}

function seConnecter() {
    $('#formConnexion').show();
    $('#demandeVoyage').hide();
}

$('#dateDeb, #dateFin').on('change', function () {
    var dateDeb = $('#dateDeb').val();
    var dateFin = $('#dateFin').val();

    if (dateDeb !== '' && dateFin !== '') {
        $.ajax({
            url: 'check_dates.php',
            method: 'POST',
            data: {
                dateDeb: dateDeb,
                dateFin: dateFin
            },
        })
            .done(function (response) {
                var resp = $.trim(response);
                if (resp === 'disponible') {

                    $('#msg-dispo').html("<span style='color: green;'>Les dates sont disponibles.</span>");
                } else {
                    $('#msg-dispo').html("<span style='color: red;'>Les dates ne sont pas disponibles.</span>");
                }
            })
            .fail(function () {
                $('#msg-dispo').html("<span style='color: red;'>Erreur lors de la vérification des dates.</span>");
            });
    } else {
        $('#msg-dispo').empty();
    }
});


function accepterVoyage(idDemande, emailUser) {
    console.log(idDemande);
    $.ajax({
        url: 'valider_demande.php',
        method: 'POST',
        data: {
            id: idDemande,
            mail: emailUser
        },
        success: function (reponse) {
            alert("Un voyage a été accepté pour " + emailUser + " !");
            $('#demande-' + idDemande).remove();
        },

        error: function () {
            alert("Une erreur est survenue lors de l'acceptation du voyage pour " + emailUser + ".");
        }
    })
}
