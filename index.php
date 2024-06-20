<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/blog.css">
    <link rel="icon" type="image/png" href="./images/logo.png">
    <title>Accueil</title>
</head>
<body>

<?php require_once "./utils/navbar.php" ?>

<h1>Bienvenue sur le site de Vendin-Le-Vieil</h1>

<img class="img_accueil" src="./images/accueil.jpg" alt="Photo Accueil">

<br>
<br>

<h2>Dernier post du blog</h2>

<?php
require_once "./utils/blog.php";
$post = get_last_post();

if (!isset($post['title'])) {
    echo "<br><p class='post-not-found'>Aucun post n'a été trouvé</p>";
    return;
}

echo "

        <br>    

        <div class='post'>
            <h3>{$post['title']}</h3>
            <textarea class='content'>{$post['content']}</textarea>
            <img src='{$post['image_link']}' alt=''>
           <p>Posté le {$post['created_at']} par {$post['author']}, {$post['fonction']}</p>
        </div>
        
        <br>
        
        <script>
            const textareas = document.querySelectorAll('textarea.content');
            textareas.forEach(textarea => textarea.readOnly = true);
        </script>
        
    ";

?>

</body>
</html>