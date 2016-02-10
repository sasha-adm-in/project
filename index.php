<?php
$rout = explode('/', $_SERVER['REQUEST_URI']);
if(empty($rout[1])) header('Location: /ua/');



// ini_set('display_errors',0);
// error_reporting(A_ALL^E_STRICT);

ini_set('display_errors', 1);
require_once ('application/bootstrap.php');