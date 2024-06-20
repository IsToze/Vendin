<?php

require_once "./utils/database.php";

if(isset($_GET['identifier'])){
    $response = 'Connexion réussie.';
    return;
}

if(!isset($_POST['email']) || !isset($_POST['password']))
    return;

$email = $_POST['email'];
$password = $_POST['password'];

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response = 'L\'adresse mail n\'est pas valide.';
    return;
}

if(!user_exists($email)) {
    $response = 'Aucun compte n\'existe avec cette adresse mail.';
    return;
}

if(strlen($password) < 8) {
    $response = 'Le mot de passe doit contenir au moins 8 caractères.';
    return;
}

if(!connect($email, $password)) {
    $response = 'Le mot de passe est incorrect.';
    return;
}

header('Location: login.php?identifier=success');
