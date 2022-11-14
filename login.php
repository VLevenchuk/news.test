<?php

session_start();
require_once __DIR__ . '/lib/vendor/autoload.php';
require_once  __DIR__ . '/functions.php';

$db = getDB();
$user = $_SESSION['user'] ?? null;
$username_or_email = $_POST['username_or_email'] ?? null;
$password = $_POST['password'] ?? null;
$log_good = true;
$command = $_GET['command'] ?? null;


function logout()
{
    $_SESSION = [];
    header('Location:/index.php');
}

if (($_POST['action'] ?? '') === 'login') {
    $log_good = loginUser($db, $_POST['username_or_email'], $_POST['password']);
}

$user_online = !empty($_SESSION['user']);
if ($user_online === true) {
    header('Location: /user_profile.php');
}

if ($command === 'logout') {
    logout();
}

echo renderTemplate(
    'login.twig',
    [   'log_good' => $log_good,
        'username' => $_SESSION['user']['username'] ?? null,
        'user_online' => $user_online]
);