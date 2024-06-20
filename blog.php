<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/blog.css">
    <link rel="icon" type="image/png" href="./images/logo.png">
    <title>Blog</title>
</head>
<body>

<?php require_once "./utils/navbar.php";
require_once "./utils/database.php";
require_once "./utils/blog.php";

if (isset($_POST['title']) && isset($_POST['content'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_link = "";
    $author = $_SESSION['full_name'];

    unset($_POST['title']);
    unset($_POST['content']);

    create_post($title, $content, $image_link, $author);

}

if (is_connected() && $_SESSION['fonction'] !== 'user') {
    echo "
        <div class='create-post'>
        <form action='blog.php' method='post' class='form'>
            <h1>Créer un article</h1>
            <input type='text' name='title' placeholder='Titre' required>
            <textarea name='content' placeholder='Contenu' required></textarea>
            <input type='submit' value='Créer le post'>
        </form>
        </div>
        <br>
    ";
}

$posts = get_20_last_posts(1);

foreach ($posts as $post) {
    echo "
        <div class='post'>
            <h3>{$post['title']}</h3>
            <div class='post-content'>
                <textarea class='content'>{$post['content']}</textarea>
                <img src='{$post['image_link']}' alt=''>
                <p>Posté le {$post['created_at']} par {$post['author']}</p>
            </div>
            <br>
        </div>
        <br>
    ";
}

echo "
        <script>
            const textareas = document.querySelectorAll('textarea.content');
            textareas.forEach(textarea => textarea.readOnly = true);
        </script>
";
