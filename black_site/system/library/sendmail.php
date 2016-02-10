<?php
header('Content-type: text/html; charset=utf-8');

$flag = false;

if (
    isset($_POST['name']) && 
    isset($_POST['phone']) && 
    isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
   ) 
{
	$name = strip_tags($_POST['name']);
	$phone = strip_tags($_POST['phone']);
    
    $flag = true;
    
    $fromEmail = 'RES.ua<feedback@res.ua>';

    $message = "<b>Ім'я:</b> ".$name.
               "\n<b>Телефон:</b> ".$phone;
    
    $message = nl2br($message);
    $title = 'Замовлення зворотнього дзвінка з сайту RES.ua';
    $to = 'sun4eg77777@gmail.com'; 
    
    if ($flag) {
        $res = mail($to, $title, $message, 'From:'.$fromEmail. "\r\n" . "MIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8");
        
        if ($res) {
            echo 'Ваша заявка успішно відправлена';
        }
    }
}