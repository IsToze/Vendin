<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="icon" type="image/png" href="./images/logo.png">
    <title>Accueil</title>
</head>
<body>

<?php require_once "./utils/navbar.php";

if (!is_connected() || !is_admin())
    header('Location: ./index.php');

?>

<div class="left-choice">
    <a href="./admin.php">> Liste des utilisateurs</a>
</div>

<div class="red-margin"></div>

<div class="users">

    <h1>Administration</h1>
    <?php require_once "./utils/user-display.php" ?>

</div>

<h1>Dernier post du blog</h1>
<br>

<?php
require_once "./utils/blog.php";
$post = get_last_post();

if (!isset($post['title'])) {
    echo "<p class='post-not-found'>Aucun post n'a été trouvé</p>";
    return;
}