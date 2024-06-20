<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="icon" type="image/png" href="./images/logo.png">
    <title>Connexion</title>
</head>
<body>

<?php
require_once "./utils/navbar.php";
require_once "./utils/database.php";

if (!is_connected()) {
    header("Location: login.php");
    return;
}

?>


<div class="left-container"></div>
<div class="right-informations">
    <h1>Informations personnelles</h1>
    <p>Nom : <?= $_SESSION['lastname'] ?></p>
    <p>Prénom : <?= $_SESSION['firstname'] ?></p>
    <p>Adresse mail : <?= $_SESSION['email'] ?></p>
    <p>Date de création : <?= $_SESSION['created_at'] ?></p>
    <p>Fonction : <?= $_SESSION['fonction'] ?></p>
</div>

</body>
</html>
