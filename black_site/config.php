<?php
// HTTP
$host = $_SERVER['HTTP_HOST'];
define('HTTP_SERVER', 'http://'.$host.'/');
define('HTTP_IMAGE', 'http://'.$host.'/image/');
define('HTTP_ADMIN', 'http://'.$host.'/admin/');

// HTTPS
define('HTTPS_SERVER', 'http://'.$host.'/');
define('HTTPS_IMAGE', 'http://'.$host.'/image/');

// DIR
$dir = dirname(__FILE__);
define('DIR_APPLICATION', $dir . '/catalog/');
define('DIR_SYSTEM', $dir . '/system/');
define('DIR_DATABASE', $dir . '/system/database/');
define('DIR_LANGUAGE', $dir . '/catalog/language/');
define('DIR_TEMPLATE', $dir . '/catalog/view/theme/');
define('DIR_CONFIG', $dir . '/system/config/');
define('DIR_IMAGE', $dir . '/image/');
define('DIR_CACHE', $dir . '/system/cache/');
define('DIR_DOWNLOAD', $dir . '/download/');
define('DIR_LOGS', $dir . '/system/logs/');


// DB
define('DB_DRIVER', 'mysql');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'abw00_db');
define('DB_PREFIX', '');
?>