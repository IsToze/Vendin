<?php

require_once "./utils/database.php";

if(!isset($_POST['lastname']))
    return;

$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if($password != $password_confirm) {
    $response = 'Les mots de passe ne correspondent pas.';
    return;
}

if(strlen($password) < 8) {
    $response = 'Le mot de passe doit contenir au moins 8 caractères.';
    return;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response = 'L\'adresse mail n\'est pas valide.';
    return;
}

if(strlen($lastname) < 2 || strlen($firstname) < 2) {
    $response = 'Le nom et le prénom doivent contenir au moins 2 caractères.';
    return;
}

$response = create_user($lastname, $firstname, $email, $password);
