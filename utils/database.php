<?php

$user = 'p9D9b38pupy79bvGUD23Kk888B95354q';
$password = '7E2qBfe6dG4y65J2jbGLCPcE7u7d8a3gJHcy9K7S6VuJN92k2L4c76uRCaYwwU89';
$table = 'vendin_site';
$ip = 'localhost';
$pdo = new PDO("mysql:host=$ip;dbname=$table", $user, $password);

$sql = "CREATE TABLE IF NOT EXISTS vendin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fonction VARCHAR(255) NOT NULL DEFAULT 'user'
)";

$pdo->exec($sql);

$sql = "CREATE TABLE IF NOT EXISTS vendin_blog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_link VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$pdo->exec($sql);

function get_user($email)
{
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM vendin_users WHERE email = :email");
    $query->execute(['email' => $email]);
    return $query->fetch();
}

function connect($email, $password): string
{

    $user = get_user($email);

    if (!$user)
        return false;

    if (!password_verify($password, $user['password']))
        return false;

    $_SESSION['id'] = $user['id'];
    $_SESSION['lastname'] = $user['lastname'];
    $_SESSION['firstname'] = $user['firstname'];
    $_SESSION['full_name'] = $user['firstname'] . ' ' . $user['lastname'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['created_at'] = $user['created_at'];
    $_SESSION['fonction'] = $user['fonction'];

    return true;

}

function is_connected(): bool
{
    return isset($_SESSION['id']);
}

function is_admin(): bool
{
    return is_connected() && $_SESSION['fonction'] === 'admin';
}

function create_user($lastname, $firstname, $email, $password): string
{

    global $pdo;

    $email = strtolower($email);

    if (user_exists($email))
        return 'Un compte existe déjà avec cette adresse mail';

    $password = password_hash($password, PASSWORD_DEFAULT);
    $role = 'user';

    if ($lastname === 'admin' && $firstname === 'admin') {

        if (admin_exist())
            return 'Un compte administrateur existe déjà';

        $response = 'Compte administrateur créé';
        $role = 'admin';

    } else {
        $response = 'Compte créé avec succès';
    }

    $query = $pdo->prepare('INSERT INTO vendin_users (lastname, firstname, email, password, fonction) VALUES
                                                                    (:lastname, :firstname, :email, :password, :fonction)');
    $query->execute([
        'lastname' => $lastname,
        'firstname' => $firstname,
        'email' => $email,
        'password' => $password,
        'fonction' => $role
    ]);

    return $response;

}

function admin_exist(): bool{

    global $pdo;

    $query = $pdo->prepare("SELECT * FROM vendin_users WHERE fonction = :admin");
    $query->execute(['admin' => 'admin']);

    return $query->rowCount() > 0;

}

function user_exists($email): bool{

    global $pdo;

    $query = $pdo->prepare("SELECT * FROM vendin_users WHERE email = :email");
    $query->execute(['email' => $email]);

    return $query->rowCount() > 0;

}

function get_all_users(){

    global $pdo;

    $query = $pdo->prepare("SELECT * FROM vendin_users");
    $query->execute();

    return $query->fetchAll();

}

function change_role($id, $role){

    global $pdo;

    $query = $pdo->prepare("UPDATE vendin_users SET fonction = :role WHERE id = :id");
    $query->execute(['role' => $role, 'id' => $id]);

}

function delete_user($id){

    global $pdo;

    $query = $pdo->prepare("DELETE FROM vendin_users WHERE id = :id");
    $query->execute(['id' => $id]);

}

function disconnect(){
    session_start();
    unset($_SESSION['id']);
    unset($_SESSION['lastname']);
    unset($_SESSION['firstname']);
    unset($_SESSION['full_name']);
    unset($_SESSION['email']);
    unset($_SESSION['created_at']);
    unset($_SESSION['fonction']);
    session_destroy();
}