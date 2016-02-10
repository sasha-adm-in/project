<?php
//запускаем сессиюsession_start();
//подключаем необходимые файлы
require_once('models/model.php');
require_once('core/view.php');
require_once('controllers/controller.php');
require_once('core/route.php');//запускаем роутер
Route::start();