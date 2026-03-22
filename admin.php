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
    <script src="script.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

    <div class="Titre">
        <h1>LA GROSSE LUNE </h1>
    </div>

     <div class = "Deconnect" style =   "position: absolute; top: 25px; right: 10px;">
            
        <button id="deconnect" type="button" onclick="deconnect()">Déconnexion</button>
            
    </div>

    <div class = "Principale">

   

    <?php
        echo "<p>Bienvenue Patron !</p><br>";

        echo "<h3> Demandes en attente : </h3><br>";

        $demandes = json_decode(file_get_contents(__DIR__ . '/demandes.json'), true) ?? [];

        foreach ($demandes as $demande){
            $traite = $demande['traite'];
            if (!$traite){
                $email = $demande['email'];
                $id = $demande['id'];
                echo "<div id = 'demande-{$id}'>
                        Email : {$email} | Dates : du {$demande['dateDeb']} au {$demande['dateFin']}
                        <button onclick = 'accepterVoyage({$id},\"{$email}\")'>Accepter</button>
                    </div> ";
            };
        }
    ?>

    </div>
</body>
</html>