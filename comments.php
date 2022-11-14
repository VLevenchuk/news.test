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


function allComments ($db) {
    $query = $db->prepare("
            SELECT *
            FROM myfirstbase.comments
        ");

    $query->execute([ ]);

    return $query->fetchAll(PDO::FETCH_ASSOC);
}
