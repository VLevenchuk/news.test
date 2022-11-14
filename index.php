<?php

// ФУНКЦИЮ МОЖНО ПРИСВОИТЬ К ПЕРЕМЕННОЙ, ИСПОЛЬЗОВАТЬ В ИФЕ, ВЫВЕСТИ В ECHO!!!!!!!

session_start();
require_once __DIR__ . '/lib/vendor/autoload.php';
require_once  __DIR__ . '/functions.php';

$command = $_GET['command'] ?? null;
$user = $_SESSION['user'] ?? null;
$username_or_email = $_POST['username_or_email'] ?? null;
$action_post = $_POST['action'] ?? null;

//const ERR_AGE = 1;

$db = getDB();

$user_online = !empty($_SESSION['user']);

echo renderTemplate(
    'index.twig',
    [   'username_value' => $_POST['username'] ?? null,
        'password_value' => $_POST['password'] ?? null,
        'email_value' => $_POST['email'] ?? null,
        'username' => $_SESSION['user']['username'] ?? null,
        'user_type' => $_SESSION['user']['user_type'] ?? null,
        'user_online' => $user_online]
);