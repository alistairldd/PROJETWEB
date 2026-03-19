
$(function() {
    function demanderVoyage() {
        $('#demandeVoyage').show();
        $('#boutonform').hide();
    }

    window.demanderVoyage = demanderVoyage;

    function deconnect() {
        $('#nom').val('');
        $('#mdp').val('');
        $('#deconnect').hide();
        window.location.href = "index.php";
    }
                        
    window.deconnect = deconnect;

    $('#dateDeb, #dateFin').on('change', function() {
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
            .done(function(response) {
                var resp = $.trim(response);
                if (resp === 'disponible') {

                    $('#msg-dispo').html("<span style='color: green;'>Les dates sont disponibles.</span>");
                } else {
                    $('#msg-dispo').html("<span style='color: red;'>Les dates ne sont pas disponibles.</span>");
                }
            })
            .fail(function() {
                $('#msg-dispo').html("<span style='color: red;'>Erreur lors de la vérification des dates.</span>");
            });
        } else {
            $('#msg-dispo').empty();
        }
    });
});