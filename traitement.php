<html> 
    <head>
        <?php 
        $mail = $_POST["mail"];
        $dateDeb = $_POST["dateDeb"];
        $dateFin = $_POST["dateFin"]; 
        $activites = $_POST["activites"];

        $content = file_get_contents(__DIR__ . '/id.json');
        $users = json_decode($content, true);

        $nouvelId = count($users) + 1; // Générer un nouvel ID en fonction du nombre d'utilisateurs existants
        $nouvelUser = [
            "id" => $nouvelId,
            "email" => $mail,
            "mdp" => randomPassword(),
        ];

        $users[] = $nouvelUser;
        file_put_contents(__DIR__ . '/id.json', json_encode($users, JSON_PRETTY_PRINT));

        header('Location: index.php?envoi=success');
        exit();


        function randomPassword() { // fonction trouvée sur internet (mais j'aurais pu la coder moi même)
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphaLength);
                    $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }
        ?>
    </head>
</html>           