<?php

session_start();
require_once __DIR__ . '/lib/vendor/autoload.php';

function getDB(): PDO
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=myfirstbase', 'root', '');

    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage();
        die();
    }
    return $db;
}

function getTwig(): \Twig\Environment
{
    $loader = new \Twig\Loader\FilesystemLoader('./templates'); // new - создает экземпляр\объект\сущность класса.
    // $loader содержит новый экземпляр класса 'FilesystemLoader'.

    return new \Twig\Environment($loader, [ // Environment - "Движок твига".
//    'cache' => '../cache',
    ]);
}

function renderTemplate(string $template, array $params): string
{
    $twig = getTwig();

    $context = array_merge(['tpl' => $template], $params);

    //echo renderTemplate('gav.twig', ['foo' => 'bar']); Если вызвать рендер страницы таким образом, то..
    //$context = ['tpl' => 'gav.twig' , 'foo' => 'bar']; Результат будет записан так.

    return $twig->render('skeleton.twig', $context); // вызывает метот render чтобы он отрисовал файл.
}

function loginUser(PDO $db, $username_or_email, $password): bool
{
    $log_good = true;

    if (empty($username_or_email) || empty($password)) {
        return false;
    }

    $query = $db->prepare("
            SELECT *
            FROM myfirstbase.users
            WHERE (username = :username_or_email OR email = :username_or_email) AND password = :password
        ");

    $query->execute([
        'username_or_email' => $username_or_email,
        'password' => $password,
    ]);

    $result = $query->fetch();

    if ($result) {
        $_SESSION['user'] = $result;
    } else $log_good = false;

    return $log_good;
}

function ClearData($value): string //Функция, которая очищает все некорректные символы
{
    $value = trim($value); //Удаляет случайные пробелы в начале и в конце.
    $value = stripcslashes($value); //Удаляет лишние слэши из строки.
    $value = strip_tags($value); //Удаляет HTML символы.
    $value = htmlspecialchars($value); //Преобразует HTML символы в специальные сущности.
    return $value;
}

function validate($params): array
{
    $err = [];
    $err['username'] = [] ?? null;
    $err['age'] = [] ?? null;
    $err['phone'] = [] ?? null;
    $err['password'] = [] ?? null;

    $pattern_phone = "/^\+?(375|380)/";
    $pattern_name = "/^[a-zA-Zа-яёА-ЯЁ]/";

    if (isset($params['username'])) {

        $username = ClearData($params['username']);

        if (!preg_match($pattern_name, $username) && (!empty($username))) { // Если preg_match нашел сходство с тем что мы ввели и с паттернами, то..
            $err['username'] = 1;
        } elseif (mb_strlen($username) > 10) {// Если количество символов, которые вернул mb_strlen выше 10 или пустые, то..
            $err['username'] = 2;
        } elseif (empty($username)) {
            $err['username'] = 3;
        }
    }
    if (isset($params['age'])) {

        $age = ClearData($params['age']);

        if (mb_strlen($age) > 2) { // Если количество символов, которые вернул mb_strlen выше 2 или пустые, то..
            $err['age'] = 1;
        } elseif (!filter_var($age, FILTER_VALIDATE_INT) && (!empty($age))) { // Если поле является НЕ целым числом, то мы выведем ошибку.
            $err['age'] = 2;
        } elseif (empty($age)) {
            $err['age'] = 3;
        }
    }
    if (isset($params['phone'])) {

        $phone = ClearData($params['phone']);

        if (!preg_match($pattern_phone, $phone) && (!empty($phone))) { // Если preg_match не нашел сходство с тем что мы ввели и с паттернами, то..
            $err['phone'] = 1;
        } elseif (empty($phone)) {
            $err['phone'] = 2;
        }
    }
    if (isset($params['email'])) {

        $email = ClearData($params['email']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && (!empty($email))) { // Если поле является НЕ целым числом, то мы выведем ошибку.
            $err['email'] = 1;
        } elseif (empty($email)) {
            $err['email'] = 2;
        }
    }
    if (isset($params['password'])) {

        $password = $params['password'];

        if (empty($password)) {
            $err['password'] = 1;
        } elseif (mb_strlen($password) < 5 && mb_strlen($password) > 0) {
            $err['password'] = 2;
        }
    }
    return $err;
}