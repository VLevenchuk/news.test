<?php

session_start();
require_once __DIR__ . '/lib/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

$db = getDB();

$user_online = !empty($_SESSION['user']);


echo renderTemplate(
    'about.twig',
    ['user_online' => $user_online]
);
