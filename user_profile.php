<?php

session_start();
require_once __DIR__ . '/lib/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

function user_profile($db): array
{

    $query = $db->prepare("
            SELECT *
            FROM myfirstbase.users
            WHERE id = :id
        ");

    $query->execute([
        'id' => $_SESSION['user']['id'],
    ]);

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function edit_profile($db): array
{
    $err = [];

    if (($_POST['action'] ?? null) === 'edit_profile') { // вынести за функцию

        $err = validate([
            'age' => $_POST['age'],
            'phone' => $_POST['phone'],
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'email' => $_POST['email']]);

        if (empty($err['username']) && empty($err['password']) && empty($err['email']) && empty($err['phone']) && empty($err['age'])) {

            $query = $db->prepare("
            UPDATE myfirstbase.users SET age=:age, phone=:phone, username=:username, password=:password, email=:email where id=:id; ");

            $query->execute([
                'age' => $_POST['age'],
                'phone' => $_POST['phone'],
                'id' => $_SESSION['user']['id'],
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'email' => $_POST['email']]);
        }
    }
    return $err;
}

$db = getDB();
$err = edit_profile($db);
$command = $_GET['command'] ?? null;
$action_post = $_POST['action'] ?? null;

$user_online = $_SESSION['user'];
$edit_profile = ($command === 'edit_profile');

if ($user_online) {
    $personal_profile = user_profile($db);
} else {
    header('Location: /index.php');
    exit;
}

echo renderTemplate(
    'user_profile.twig',
    ['user_online' => $user_online,
        'edit_profile' => $edit_profile,
        'err' => $err,
        'err_username' => $err['username'] ?? null,
        'err_password' => $err['password'] ?? null,
        'err_email' => $err['email'] ?? null,
        'err_age' => $err['age'] ?? null,
        'age_validation_err_1' => $_POST['age'] ?? null,
        'err_phone' => $err['phone'] ?? null,
        'user_profile' => $personal_profile ?? null]
);