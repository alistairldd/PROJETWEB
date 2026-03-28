<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["admin"] !== true) {
    header('Location: index.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Admin - Gestion des demandes</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

    <div class="Titre">
        <h1>LA GROSSE LUNE </h1>
    </div>

     <div class = "Deconnect" style =   "position: absolute; top: 25px; right: 10px;">
            
        <button id="deconnect" type="button" onclick="deconnect()">Déconnexion</button>
            
    </div>

    <div class = "PrincipaleAdmin">

   

    <?php
        echo "<p>Bienvenue Patron !</p><br>";

        

        
        echo "
        <button id='afficherDemande' onclick='afficherDemande()' style = 'position:absolute; left:25%; top:10%;'>Afficher les demandes</button>
        <button id='cacherDemande' onclick='cacherDemande()' style='display:none;position:absolute; left:25%; top:10%'>Cacher les demandes</button>

        <button id='afficherVoyage' onclick='afficherVoyage()' style = 'position:absolute; left:46.5%; top:10%;'>Afficher les voyages</button>
        <button id='cacherVoyage' onclick='cacherVoyage()' style='display:none;position:absolute; left:46.5%; top:10%'>Cacher les voyages</button>

        <button id='afficherChambreLibre' onclick='afficherChambreLibre()' style = 'position:absolute; right:25%; top:10%;'>Afficher les chambres libres</button>
        <button id='cacherChambreLibre' onclick='cacherChambreLibre()' style='display:none;position:absolute; right:25%; top:10%'>Cacher les chambres libres</button>
        
        <br> <br>
        ";

        $demandes = json_decode(file_get_contents("demandes.json"), true);
        $texte = "";

        echo "
        <div id = 'divDemande' style = 'display:none'>

        <div id = 'demandes'>
        <p> Demandes en attente : </p> ";
        foreach ($demandes as $demande){
            $traite = $demande['traite'];
            if (!$traite){
                $email = $demande['email'];
                $id = $demande['id'];
                echo "
                    
                    <div id = 'demande-{$id}' style ='display:flex'>
                        Email : {$email} | Dates : du {$demande['dateDeb']} au {$demande['dateFin']}
                        <div id='retourT-{$id}' style='display:none; color: green;'>
                            &nbsp;&nbsp;ACCEPTEE
                        </div>
                        <div id='retourF-{$id}' style='display:none; color: red;'>
                            &nbsp;&nbsp;REFUSEE
                        </div>

                        <button id='accepter-{$id}' onclick = 'accepterVoyage({$id},\"{$email}\")'>Accepter</button>
                        <button id='refuser-{$id}' onclick = 'refuserVoyage({$id},\"{$email}\")'>Refuser</button>
                        
                    </div>
                    <br>
                    
                ";
            }
        }
        

        echo "
            </div>
            <div id='messageEnvoi'>{$texte}</div>
            </div>
        ";
    ?>

    </div>
</body>
</html>