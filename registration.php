<?php

session_start();
require_once __DIR__ . '/lib/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$db = getDB();
$err = register();

function register(): array
{
    $err = [];
    if (!empty($_POST)) {
        $db = getDB();
        if ($_POST['action'] === 'register') {

            $err = validate([
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email']]);

            if (!empty($err['username']) || !empty($err['password']) || !empty($err['email'])) {
            } else {
                $query = $db->prepare("
                    INSERT INTO myfirstbase.users(`id`, `username`, `password`, `user_type`, `email`, `phone`,`age`)
                    VALUES (NULL, :username, :password, :user_type, :email, '','') ");

                $query->execute([
                    'username' => $_POST['username'],
                    'password' => $_POST['password'],
                    'user_type' => 'user',
                    'email' => $_POST['email'],
                ]);

                // проверить успешный ли execute
                loginUser($db, $_POST['username'], $_POST['password']);
            }
        }
    }
    return $err;
}

$user_online = !empty($_SESSION['user']);

if ($user_online === true) {
    header('Location: /user_profile.php');
    exit;
}

echo renderTemplate(
    'registration.twig',
    ['err_username' => $err['username'] ?? null,
        'err_password' => $err['password'] ?? null,
        'err_email' => $err['email'] ?? null]
);