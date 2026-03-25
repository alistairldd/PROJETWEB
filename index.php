<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Tu préfères le soleil ou la lune</title>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="script.js"></script>

        <?php $envoi = $_GET["envoi"] ?? null; ?>

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
            <?php
                if ($envoi === "success") {
                    echo "<p>Vol vers la Lune enregistré ! <br> <br>

                            Votre demande a bien été transmise à nos administrateurs. <br>
                            Un email vous sera envoyé prochainement avec vos accès (url, nom, mot de passe) dès qu'on aura validé votre séjour. <br> <br>

                            Délai de réponse moyen : 24h terrestres. <br> </p>";

                } else {
                    ?>

                    <button id="boutonConnexion" type="button" onclick="seConnecter()">Se connecter</button>

                    
                    
                    <div id="formConnexion" style="display:none;">
                        <p> Veuillez entrer vos identifiants pour vous connecter. </p>

                        <div id="messageErreur"></div> </form>

                        <form id="formuConnexion" method="post" action="traitement.php">
                            <label for="nom">Identifiant :</label><br>
                            <input type="email" id="nom" name="nom" required><br>
                            <label for="mdp">Mot de Passe :</label><br>
                            <input type="password" id="mdp" name="mdp" required><br>
                            <input type='submit' id="validerConnexion" value='Valider la connexion'><br>
                        </form>
                        <p> Pas encore de compte ? <br> Faites votre demande de voyage pour en créer un ! </p>
                    </div>  
                    
                    <button id ="boutonform" type="button" style="display:none;" onclick="demanderVoyage()">Demande de voyage</button>

                    <div id = "demandeVoyage">
                        <p> Bienvenue sur le site de la Grosse Lune ! <br> Completez le formulaire si dessous pour faire votre demande de voyage. </p>
                        <form method="post" action="traitement.php">

                            <label for="mail">Adresse mail :</label><br>
                            <input type="email" id="mail" name="mail" required><br>
                            <label for="dateDeb">Date de début : </label>
                            <input type="date" id="dateDeb" name="dateDeb" required> <br>
                            <label for="dateFin">Date de fin : </label>
                            <input type="date" id="dateFin" name="dateFin" required><div id="msg-dispo"></div><br>
                            <label for="nbPersonnes">Nombre de personnes : </label>
                            <input type="number" id="nbPersonnes" name="nbPersonnes" min="1" max="10" required><br>
                             <!-- <label for="activites">Activités souhaitées : </label>
                             <select id="activites" name="activites">
                                <option value="rien">Aucune</option>
                                <option value="tennis">Tennis</option>
                                <option value="badminton">Badminton</option>
                                <option value="natation">Natation</option>
                                <option value="seh">Saut en hauteur</option>
                            </select><br> -->

                            <input type="submit" value="Demander">
                        </form>
                        <?php } ?>
                    </div>
            <?php 

            ?>
        </div>
    </body>
</html>