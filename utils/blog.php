<?php

require_once "database.php";

function create_post($title, $content, $image_link, $author): bool
{

    global $pdo;
    $sql = "INSERT INTO vendin_blog (title, content, image_link, author) VALUES (:title, :content, :image_link, :author)";
    $query = $pdo->prepare($sql);

    return $query->execute([
        'title' => $title,
        'content' => $content,
        'image_link' => $image_link,
        'author' => $author
    ]);

}

function get_20_last_posts($page)
{

    global $pdo;

    $offset = ($page - 1) * 20;

    $query = $pdo->prepare("SELECT * FROM vendin_blog ORDER BY created_at DESC LIMIT 20 OFFSET $offset");
    $query->execute();

    return $query->fetchAll();

}

function get_last_post()
{

    global $pdo;

    $query = $pdo->prepare("SELECT * FROM vendin_blog ORDER BY created_at DESC LIMIT 1");
    $query->execute();

    return $query->fetch();

}