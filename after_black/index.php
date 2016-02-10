<?php
//загружаем язык по умолчанию
$rout = explode('/', $_SERVER['REQUEST_URI']);
if(empty($rout[1])) header('Location: /ru/');


//отключаем вывод ошибок на экран
ini_set('display_errors', 0);

//запуск загрузочного файла
require_once ('application/bootstrap.php');