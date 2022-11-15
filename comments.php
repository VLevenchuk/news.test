<?php

session_start();
require_once __DIR__ . '/lib/vendor/autoload.php';
require_once  __DIR__ . '/functions.php';

$db = getDB();

function addComments ($db, $news_id) {

    $query = $db->prepare("
            INSERT INTO myfirstbase.comments(`id`, `text`,`username`, `authors_id`,`news_id`)
            VALUES (NULL, :text, :username, :authors_id, :news_id)
        ");

    $query->execute([
        'text' => $_POST['text']??null,
        'username' => $_SESSION['user']['username']??null,
        'authors_id' => $_SESSION['user']['id']??null,
        'news_id' => $news_id??null
    ]);

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

//function comments($db)
//{
//    $query = $db->prepare("
//            SELECT c.authors_id, c.text, c.news_id, n.id, u.username, c.date
//            FROM myfirstbase.comments AS c
//            JOIN myfirstbase.news AS n ON n.id = c.news_id
//            JOIN myfirstbase.users AS u ON c.authors_id = u.id
//        ");
//
//    $query->execute([]);
//
//    return $query->fetchAll(PDO::FETCH_ASSOC);
//}  //

// обойти в цикле все новости и получить комментарии для каждой новости по отдельности по её id
//(не оптимально, но для понимания лучше)
// оптимально LEFT JOIN, но пока я его не знаю
// СДЕЛАНО!

// пробовать делать ответы на комментарии 15.11.22

function get_comment($db, $id) {
    $query = $db->prepare("
            SELECT text, authors_id, news_id, date, c.id AS comment_id, u.id AS user_id, u.username
            FROM myfirstbase.comments AS c
            JOIN myfirstbase.users AS u ON c.authors_id=u.id
            where news_id = :news_id 
        ");

    $query->execute([
        'news_id' => $id
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}



