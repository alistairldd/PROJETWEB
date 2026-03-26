function demanderVoyage() {
    $(`#demandeVoyage`).show();
    $(`#boutonform`).hide();
    $('#formConnexion').hide();
    $('#boutonConnexion').show();
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
    $('#boutonform').show();
    $('#boutonConnexion').hide();
}
$(document).ready(function() {
    /* Ajax pour la vérification des dates */
    $('#dateDeb, #dateFin').on('change', function () {
        var dateDeb = $('#dateDeb').val();
        var dateFin = $('#dateFin').val();

        $.ajax({
            url: 'check_dates.php',
            method: 'POST',
            data: {
                dateDeb: dateDeb,
                dateFin: dateFin
            },
            dataType: 'json'
        })
            .done(function (response) {
                $('#msg-dispo').removeClass('dispo-ok dispo-no');
                if (response.disponible){
                    $('#msg-dispo').text(response.message).addClass('dispo-ok').fadeIn();
                } else { 
                    $('#msg-dispo').text(response.message).addClass('dispo-no').fadeIn();
                }
            });

    });

    /* Ajax pour la connexion */

    $('#formuConnexion').on('submit', function(e) {
        e.preventDefault();
        var donnees = {
            nom: $('#nom').val(),
            mdp: $('#mdp').val()
        };

        $.ajax({
            url: 'traitement.php',
            method: 'POST',
            data: donnees,
            dataType: 'json'
        })
        .done(function(reponse) {
            if (reponse.success) {
                if (reponse.admin)  window.location.href = 'admin.php';
                else window.location.href = 'client.php'; 
            } else {
                $('#messageErreur').text(reponse.message);
                $('#messageErreur').fadeIn();
            }
        });
    });


    /* pour le formulaire de demande de Voyage */
    $('#mail, #dateDeb, #dateFin, #nbPersonnes').on('change', function () {
        var donnees = {
            mail: $('#mail').val(),
            dateDeb: $('#dateDeb').val(),
            dateFin: $('#dateFin').val(),
            nbPersonnes: $('#nbPersonnes').val()
        };

        if (donnees.mail && donnees.dateDeb && donnees.dateFin && donnees.nbPersonnes) {
            $('#demander').addClass('demander-ok');
            $('#demander').removeClass('demander-no');
        } else {
            $('#demander').addClass('demander-no');
            $('#demander').removeClass('demander-ok');
        }
    });

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
            $('#accepter-' + idDemande).hide();
            $('#refuser-' + idDemande).hide();
            $('#retourT-' + idDemande).fadeIn();

            var message = "Bienvenue : " + emailUser + "! <br>Votre demande pour un voyage sur la lune a été acceptée.<br> Vous pouvez dès à présent choisir vos activités!";

            $('#demandes').css('position', 'absolute');
            $('#demandes').css('top', '25%');
            $('#demandes').css('left', '15%');
            $('#messageEnvoi').html(message).show();
        },

        error: function () {
            alert("Une erreur est survenue lors de l'acceptation du voyage pour " + emailUser + ".");
        }
    })
}

function refuserVoyage(idDemande, emailUser){
    console.log(idDemande);
    $.ajax({
        url: 'refuser_demande.php',
        method: 'POST',
        data: {
            id: idDemande,
            mail: emailUser
        },
        success: function (reponse) {
            $('#accepter-' + idDemande).hide();
            $('#refuser-' + idDemande).hide();
            $('#retourF-' + idDemande).fadeIn();

        },

        error: function () {
            alert("Une erreur est survenue lors du refus du voyage pour " + emailUser + ".");
        }
    })
}