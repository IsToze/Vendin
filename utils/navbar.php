<?php

echo '<link rel="stylesheet" type="text/css" href="css/navbar.css">';

require_once './utils/database.php';

session_start();

$categories = ["Accueil", "Blog", "Contact"];

echo "<div class='categories-nav'>";

echo "<a href='index.php'><img class='navbar_logo' src='images/logo.png' alt='logo'></a>";

foreach ($categories as $category) {
    $link_category = strtolower($category).'.php';
    echo "<a class=navbar_category href=$link_category>$category</a>";
}

if (is_connected()) {
    echo "<a class=navbar_category href='profile.php'>Profil</a>";
    echo "<a class='navbar_category logout' href='logout.php'>Déconnexion</a>";
} else {
    echo "<a class='navbar_category register' href='register.php'>S'inscrire</a>";
    echo "<a class='navbar_category login' href='login.php'>Connexion</a>";
}

if(is_admin())
    echo "<a class=' navbar_category admin' href='admin.php'>Administration</a>";

echo "</div>";

echo "<div class='navbar_separator'></div>";

require_once 'cookies.php';


