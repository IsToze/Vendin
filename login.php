<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="icon" type="image/png" href="./images/logo.png">
    <title>Connexion</title>
</head>
<body>

<?php
require_once "./utils/navbar.php";
require_once "./utils/user/login_user.php";
global $response;
?>


<img class="img_login" src="./images/login.jpg" alt="Photo Login">

<div class="register_container">

    <form class="form" action="./login.php" method="post">

        <h1>Se Connecter</h1>

        <label for="email">Adresse mail</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Se Connecter</button>

        <br>
        <p id="response"><?= $response ?></p>

    </form>

</div>

</body>
</html>
