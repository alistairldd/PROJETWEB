

<html>
    <head>
        <title>Tu préfères le soleil ou la lune</title>
        <link rel="stylesheet" type="text/css" href="style.css">


        <script src="script.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <?php

        $content = file_get_contents(__DIR__ . '/id.json');
        $users = json_decode($content, true);
        $correct = "inconnu";

        $nom = $_GET["nom"];
        $mdp = $_GET["mdp"];
        if (isset($nom) && $nom != null && $mdp != null) {
            $correct = false;
            foreach ($users as $user) {
                if (strtolower($user["email"]) === strtolower($nom) && $user["mdp"] === $mdp) {
                    //$_SESSION["user"] = $user;
                    $id = $user["id"];
                    $correct = true;
                }
            }
        }

        ?>

    </head>

    <body >
        <div class="Titre">
            <h1>LA GROSSE LUNE </h1>
        </div>

        <div class = "Deconnect" style =   "position: absolute; top: 25px; right: 10px;">
            <?php if ($correct === true): ?>
                <button id="deconnect" type="button" onclick="deconnect()">Déconnexion</button>
            <?php endif; ?>
        </div>
        <div class = "Principale">
            <?php if ($correct === false || $correct === 'inconnu'): ?> 
                    <?php
                    if ($correct === false):
                        echo "<p>Identifiants invalides.</p>";
                    endif;
                    ?>

                    <form method="get" action= "index.php">
                        <label for="nom">Identifiant :</label><br>
                        <input type="text" id="nom" name="nom"><br>
                        <label for="mdp">Mot de Passe :</label><br>
                        <input type="password" id="mdp" name="mdp"><br>
                        <input type='submit' value='Se connecter'><br>
                    </form>  

                    <p> Ou bien </p><br>
                    
                    <button id ="boutonform" type="button" onclick="demanderVoyage()">Demande de voyage</button>

                    <div id = "demandeVoyage" style="display:none;">
                        <form method="post" action="index.php">
                            <label for="mail">Adresse mail :</label><br>
                            <input type="text" id="mail" name="mail"><br>
                            <label for="dateDeb">Date de début :</label><br>
                            <input type="date" id="dateDeb" name="dateDeb"><br>
                            <label for="dateFin">Date de fin :</label><br>
                            <input type="date" id="dateFin" name="dateFin"><br>
                            <input type="submit" value="Demander">
                        </form>
                    </div>
            <?php else: ?>
            <?php
                if ($id === 1 || $id === 2):
                    echo "<p>Bienvenue Patron !</p>";
                else:
                    echo "<p>Bienvenue sur votre espace</p>";
                endif;        
            ?>
        </div>
        <?php endif; ?>
    </body>
</html>