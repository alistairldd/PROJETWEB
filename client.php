<?php
session_start();

if (!isset($_SESSION["user"]) && $_SESSION["user"]["admin"] === true) {
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
    <script src="script.js"></script>
    <title>Client</title>
</head>
<body>
    <p>Bienvenue sur votre espace</p>
</body>
</html>