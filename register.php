<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/register.css">
    <link rel="icon" type="image/png" href="./images/logo.png">
    <title>Enregistrement</title>
</head>
<body>

<?php require_once "./utils/navbar.php";
require_once "./utils/user/register_user.php";
global $response;
?>


<img class="img_register" src="./images/register.jpg" alt="Photo Register">

<div class="register_container">

    <form class="form" action="./register.php" method="post">

        <h1>Créer un compte</h1>

        <label class="names" for="lastname">Nom</label>
        <input type="text" id="lastname" name="lastname" required>
        <label class="names" for="firstname">Prénom</label>
        <input type="text" id="firstname" name="firstname" required>

        <label for="email">Adresse mail</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirm">Confirmer le mot de passe</label>
        <input type="password" id="password_confirm" name="password_confirm" required>

        <button type="submit">Créer un compte</button>

        <br>
        <p id="response"><?= $response ?></p>

    </form>

</div>

</body>
</html>
