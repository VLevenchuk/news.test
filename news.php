<?php
session_start();
require_once __DIR__ . '/lib/vendor/autoload.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/comments.php';

$db = getDB();
$action_post = $_POST['action'] ?? null;
$command = $_GET['command'] ?? null;
$user_online = !empty($_SESSION['user']);

function addNews($db)
{

    $query = $db->prepare("
            INSERT INTO myfirstbase.news(`id`, `header`, `text`,`author`)
            VALUES (NULL, :header, :text, :author)
        ");

    $query->execute([
        'header' => $_POST['header'],
        'text' => $_POST['text'],
        'author' => $_POST['author']
    ]);
}

function comments($db)
{
    $query = $db->prepare("
            SELECT *
            FROM myfirstbase.news AS n
            JOIN myfirstbase.users AS u ON u.id = n.id
        ");

    $query->execute([]);
}

function allNews($db)
{
    $query = $db->prepare("
            SELECT *
            FROM myfirstbase.news
        ");

    $query->execute([]);

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

$allNews = allNews($db);
$allComments = allComments($db);

$add_news_input = $command === 'add_news_input';


if ($action_post === 'add_news') {
    addNews($db);
}

if ($action_post === 'add_comment') {
    addComments($db, $_POST['news_id']);
}


echo renderTemplate(
    'news.twig',
    ['user_online' => $user_online,
        'user_type' => $_SESSION['user']['user_type'] ?? null,
        'all_news' => $allNews,
        'all_comments' => allComments($db),
        'add_news_input' => $add_news_input]
);

