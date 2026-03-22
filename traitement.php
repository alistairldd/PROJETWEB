<?php 

session_start();

// Pour la réservation
$mail = $_POST["mail"];
$dateDeb = $_POST["dateDeb"];
$dateFin = $_POST["dateFin"]; 
$nbPersonnes = $_POST["nbPersonnes"];

// pour l'identification
$nom = $_POST["nom"];
$mdp = $_POST["mdp"];



$demandes = json_decode(file_get_contents(__DIR__ . '/demandes.json'), true);

if (isset($mail) && isset($dateDeb) && isset($dateFin) && isset($nbPersonnes)) {
    $nouvelId = count($demandes) + 1;
    $nouvelleDemande = [
        "id" => $nouvelId,
        "email" => $mail,
        "dateDeb" => $dateDeb,
        "dateFin" => $dateFin,
        "nbPersonnes" => $nbPersonnes,
        "traite" => false
    ];
    $demandes[] = $nouvelleDemande;

    file_put_contents(__DIR__ . '/demandes.json', json_encode($demandes, JSON_PRETTY_PRINT));

    header('Location: index.php?envoi=success');exit();
} else if (isset($nom) && isset($mdp)) {
    $ids = json_decode(file_get_contents(__DIR__ . '/id.json'), true);
    error_log("Nom : $nom" . " | Mot de passe : $mdp");
    $correct = false;
    foreach ($ids as $id) {
        if (strtolower($id["email"]) === strtolower($nom) && $id["mdp"] === $mdp) {
            $correct = true;
            $_SESSION["user"] = $id;
            if (isset($id["admin"]) && $id["admin"]) {header('Location: admin.php'); exit();}
            else header('Location: client.php'); exit();
        }
    }
    if ($correct === false) header('Location: index.php?envoi=fail');
}
?>