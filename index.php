

<html>
    <head>
        <title>Tu préfères le soleil ou la lune</title>
        <link rel="stylesheet" type="text/css" href="style.css">


        <script src="script.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <?php

        $content = file_get_contents(__DIR__ . '/id.json');
        $users = json_decode($content, true);
        $admin = false;

        $nom = $_POST["nom"];
        $mdp = $_POST["mdp"];
        if (isset($nom) && isset($mdp)) {
            $correct = false;
            foreach ($users as $user) {
                if (strtolower($user["email"]) === strtolower($nom) && $user["mdp"] === $mdp) {
                    //$_SESSION["user"] = $user;
                    $id = $user["id"];
                    $correct = true;
                    if ($id === 1 || $id === 2) $admin = true;
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
            <?php if (($correct === false || $correct === NULL) && !isset($_GET["envoi"])): ?>
                    <?php
                    if ($correct === false):
                        echo "<p>Identifiants invalides.</p>";
                    endif;
                    ?>
                    <form method="post" action= "index.php">
                        <label for="nom">Identifiant :</label><br>
                        <input type="text" id="nom" name="nom" required><br>
                        <label for="mdp">Mot de Passe :</label><br>
                        <input type="password" id="mdp" name="mdp" required><br>
                        <input type='submit' value='Se connecter'><br>
                    </form>  

                    <p> Ou bien </p><br>
                    
                    <button id ="boutonform" type="button" onclick="demanderVoyage()">Demande de voyage</button>

                    <div id = "demandeVoyage" style="display:none;">

                        <form method="post" action="traitement.php">

                            <label for="mail">Adresse mail :</label><br>
                            <input type="email" id="mail" name="mail" required><br>
                            <label for="dateDeb">Date de début : </label>
                            <input type="date" id="dateDeb" name="dateDeb" required><br>
                            <label for="dateFin">Date de fin : </label>
                            <input type="date" id="dateFin" name="dateFin" required><br>
                            <label for="nbPersonnes">Nombre de personnes : </label>
                            <input type="number" id="nbPersonnes" name="nbPersonnes" min="1" max="10" required><br>
                            <label for="activites">Activités souhaitées : </label>
                            <select id="activites" name="activites">
                                <option value="rien">Aucune</option>
                                <option value="tennis">Tennis</option>
                                <option value="badminton">Badminton</option>
                                <option value="natation">Natation</option>
                                <option value="seh">Saut en hauteur</option>
                            </select><br>

                            <input type="submit" value="Demander">
                        </form>
                    </div>
            <?php else:

                if ($admin === true):
                    echo "<p>Bienvenue Patron !</p>";
                else:
                    echo "<p>Bienvenue sur votre espace</p>";
                endif;

                if (isset($_GET["envoi"]) && $_GET["envoi"] === "success") {
                    echo "<p>🚀 Vol vers la Lune enregistré ! <br> <br>

                            Votre demande a bien été transmise à nos administrateurs. <br>
                            Un email vous sera envoyé prochainement avec vos accès (url, nom, mot de passe) dès qu'on aura validé votre séjour. <br> <br>

                            Délai de réponse moyen : 24h terrestres. <br> </p>";
                } // Demander au prof si c'est mieux d'avoir plusieurs pages php pour chaque truc (genre traitement du mdp et tout avec redirection directe), ou 
                // tout faire dans la même page et faire du if pour afficher les trucs en fonction de ce qui a été envoyé ou pas
                // ou faire un switch case avec des includes 
            ?>
        </div>
        <?php endif; ?>
    </body>
</html>