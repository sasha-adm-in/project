<?php
header("Content-type: text/html; charset=utf-8");
//**********************************************
if(empty($_POST['js'])){

$log =="";
$error="no"; //флаг наличия ошибки

		$posName = addslashes($_POST['posName']);
		$posName = htmlspecialchars($posName);
		$posName = stripslashes($posName);
		$posName = trim($posName);

		$posCompany = addslashes($_POST['posCompany']);
		$posCompany = htmlspecialchars($posCompany);
		$posCompany = stripslashes($posCompany);
		$posCompany = trim($posCompany);
		
		/*$posEmail = addslashes($_POST['posEmail']);
		$posEmail = htmlspecialchars($posEmail);
		$posEmail = stripslashes($posEmail);
		$posEmail = trim($posEmail);*/

		$posPhone = addslashes($_POST['posPhone']);
		$posPhone = htmlspecialchars($posPhone);
		$posPhone = stripslashes($posPhone);
		$posPhone = trim($posPhone);
		
		$posText = addslashes($_POST['posText']);
		$posText = htmlspecialchars($posText);
		$posText = stripslashes($posText);
		$posText = trim($posText);

//Проверка правильность имени    
if(!$posName || strlen($posName)>40 || strlen($posName)<3) {
$log.="<li>Не дійсне ім'я!</li>"; $error="yes"; }

//Проверка правильность Company   
if(!$posCompany || strlen($posCompany)>80 || strlen($posCompany)<3) {
$log.="<li>Не дійсна назва організації!</li>"; $error="yes"; }

//Проверка email адреса
/*function isEmail($posEmail)
            {
                return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i"
                        ,$posEmail));
            } 
			
if($posEmail == '')
                {
	$log .= "<li>Введіть email!</li>";
	$error = "yes";
                  
                }			

else if(!isEmail($posEmail))
                {
                   
	$log .= "<li>Не дійсний email!</li>";
	$error = "yes";
                }
*/

//Проверка Phone
function isPhone($posPhone)
            {
                return(preg_match("/^[0-9]{10,10}+$/"
                        ,$posPhone));
            } 
			
if($posPhone == '')
                {
	$log .= "<li>Введіть телефон!</li>";
	$error = "yes";
                  
                }			

else if(!isPhone($posPhone))
                {
                   
	$log .= "<li>Не дійсний телефон!</li>";
	$error = "yes";
                }

				
//Проверка наличия введенного текста комментария
if (empty($posText))
{
	$log .= "<li>Введіть повідомлення!</li>";
	$error = "yes";
}

//Проверка длины текста комментария
if(strlen($posText)>1010)
{
	$log .= "<li>Текст максимально 1000 символів!</li>";
	$error = "yes";
}

//Проверка на наличие длинных слов
$mas = preg_split("/[\s]+/",$posText);
foreach($mas as $index => $val)
{
  if (strlen($val)>60)
  {
	$log .= "<li>Занадто довгі слова (більш 60 символів) у тексті запису!</li>";
	$error = "yes";
	break;
  }
}
sleep(2);

//Если нет ошибок отправляем email  
if($error=="no")
{
//Отправка письма админу о новом комментарии
$to = "info@res.ua";//Ваш e-mail адрес
//$mes = "Cообщение с сайта res.ua от $posName: \n\nКомпания : $posCompany \n\nMail : $posEmail \n\nТелефон : $posPhone \n\nСообщение : $posText";

if($posCompany=="________"){$companny="";} else {$companny="\n\nКомпания : $posCompany";};
if($posText=="________"){$texxt="";} else {$texxt="\n\nСообщение : $posText";};

if($companny==""){$messig="Запрос на сотрудничество с ЭЛЕКТРИКАМИ";};
if($companny!=""){$messig="Запрос на сотрудничество с ПОСТАВЩИКАМИ";};

$mes = "$messig с сайта RES.ua \n\nОт: $posName $companny \n\nТелефон : $posPhone $texxt";

//$from = $posEmail;
$from = 'sun4eg77777@gmail.com';
$sub = '=?utf-8?B?'.base64_encode('RES.ua: Заявка на співпрацю').'?=';
$headers = "From: RES.ua Spivpracja<".$from.">\r\n";
$headers .= 'MIME-Version: 1.0';
$headers .= 'Content-type: text/plain; charset=utf-8
';
mail($to, $sub, $mes, $headers);
echo "1"; //Всё Ok!
}
else//если ошибки есть
{ 

if ($GLOBALS["langcur"] == 'rus' ) {
		echo "<p style='font: 13px Verdana;'><font color=#FF3333><strong>Error !</strong></font></p><ul style='list-style: none; font: 14px Verdana; color:#000; border:1px solid #c00; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; background-color:#fff; padding:10px; margin:5px 10px;'>".$log."</ul><br />"; //Нельзя отправлять пустые сообщения
} else {
		echo "<p style='font: 13px Verdana;'><font color=#FF3333><strong>Помилка !</strong></font></p><ul style='list-style: none; font: 14px Verdana; color:#000; border:1px solid #c00; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; background-color:#fff; padding:10px; margin:5px 10px;'>".$log."</ul><br />"; //Нельзя отправлять пустые сообщения
}

}
}