<?php
session_start();

require_once __DIR__ . '/lib/vendor/autoload.php';

function getDB() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=myfirstbase', 'root', '');

    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage();
        die();
    }
    return $db;
}

function getTwig() {
    $loader = new \Twig\Loader\FilesystemLoader('./templates'); // new - создает экземпляр\объект\сущность класса.
    // $loader содержит новый экземпляр класса 'FilesystemLoader'.

    return new \Twig\Environment($loader, [ // Environment - "Движок твига".
//    'cache' => '../cache',
    ]);
}

function renderTemplate(string $template, array $params): string {
    $twig = getTwig();

    $context = array_merge(['tpl' => $template], $params);

    //echo renderTemplate('gav.twig', ['foo' => 'bar']); Если вызвать рендер страницы таким образом, то..
    //$context = ['tpl' => 'gav.twig' , 'foo' => 'bar']; Результат будет записан так.

    return $twig->render('skeleton.twig', $context); // вызывает метот render чтобы он отрисовал файл.
}



//var_dump($_GET['profile']);

if (!empty($_GET['profile'])) {
    $db = getDB();
    $query = $db->prepare("
            SELECT *
            FROM myfirstbase.users
            WHERE id = :id
        ");

    $query->execute([
        'id' => $_GET['profile']
    ]);

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    echo renderTemplate(
        'users_list.twig',
        ['base' => $result]
    );
}


