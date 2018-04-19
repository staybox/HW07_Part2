<?php
// Включаем вывод ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// начинаем работать с сессией
session_start();

require("vendor/autoload.php");

$app = new \App\Core\Bootstrap();
$app->run();
