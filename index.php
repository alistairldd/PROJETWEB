<html>
    <head>
        <title>Mon site web</title>
        <link rel="stylesheet" type="text/css" href="style.css">


        <script src="script.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <?php

        $content = file_get_contents(__DIR__ . '/id.json');
        $users = json_decode($content, true);
        $correct = "inconnu";

        $name = $_GET["name"];
        $mdp = $_GET["mdp"];
        if (isset($name) && $name != null && $mdp != null) {
            $correct = false;
            foreach ($users as $user) {
                if ($user["email"] === $name && $user["mdp"] === $mdp) {
                    //$_SESSION["user"] = $user;

                    $correct = true;
                }
            }
        }

        ?>

    </head>

    <body >
        <div class="Titre">
            <h1>GROS TITRE DE LA LUNE</h1>
        </div>


        <div class = "Formulaire">
            <form method="get" action= "index.php">
                <label for="name">Nom :</label><br>
                <input type="text" id="name" name="name"><br>
                <label for="mdp">Mot de Passe :</label><br>
                <input type="password" id="mdp" name="mdp"><br>

                <?php if ($correct === true):
                    echo "<p>Connexion réussie !</p>";
                    elseif ($correct === false): 
                        echo "<p>Identifiants invalides.</p>";
                endif; ?>

                <input type="submit" value="Se connecter">
            </form> <br> 
            <p> Ou bien </p>
            <br>
            <button id ="boutonform" type="button" onclick="demanderVoyage()">Demande de voyage</button>

            <div id = "demandeVoyage" style="display:none;">
            <form method="post" action="index.php">
                <label for="mail">Adresse mail :</label><br>
                <input type="text" id="mail" name="mail"><br>
                <label for="date">Date :</label><br>
                <input type="date" id="date" name="date"><br>
                <input type="submit" value="Demander">
            </form>
        </div>

        </div>





    </body>
</html>