<?php 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<TITLE>Отправить ошибку</TITLE>
<style type="text/css">
body {
margin: 20px 25px;
font-size:14px;
font-family:Helvetica, Sans-serif, Arial;
line-height:2em;
}
.bgsoo {
background: url(/image/data/bgsoo.jpg) no-repeat center 0px;
}
form
{margin: 0;}
.text {
font-weight: bold;
font-size:12px;
color:#777;
}
.copyright
{
font-size:11px;
color:#777;
}
.submitform {
	width:243px;
	height:55px;
}

.submitform input {
	cursor: pointer;
	margin-left: 14px;
	margin-top: 17px;
	border: 0px #ccc solid;
	width: 98px;
    height: 30px;
    padding: 0 10px;
    color: #fff;
    font-size: 14px;
    border-radius: 5px;
    background: #b1d753; /* Old browsers */
    /* IE9 SVG, needs conditional override of 'filter' to 'none' */
    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2IxZDc1MyIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM2OGEyMDgiIHN0b3Atb3BhY2l0eT0iMSIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
    background: -moz-linear-gradient(top,  #b1d753 0%, #68a208 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#b1d753), color-stop(100%,#68a208)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  #b1d753 0%,#68a208 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  #b1d753 0%,#68a208 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  #b1d753 0%,#68a208 100%); /* IE10+ */
    background: linear-gradient(to bottom,  #b1d753 0%,#68a208 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b1d753', endColorstr='#68a208',GradientType=0 ); /* IE6-8 */
}

.submitform input:hover {
    background: #A0C83C; /* Old browsers */
    /* IE9 SVG, needs conditional override of 'filter' to 'none' */
    background: -moz-linear-gradient(top,  #A0C83C 0%, #68a208 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#A0C83C), color-stop(100%,#68a208)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  #A0C83C 0%,#68a208 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  #A0C83C 0%,#68a208 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  #A0C83C 0%,#68a208 100%); /* IE10+ */
    background: linear-gradient(to bottom,  #A0C83C 0%,#68a208 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#A0C83C', endColorstr='#68a208',GradientType=0 ); /* IE6-8 */
}

textarea, input{
	width:243px;
	resize: none;
}
textarea {
	height:79px;
}

.text{color:#68a208; height:12px;}
.text2{color:#68a208; font-size:20px; height:20px;}
</style>

<script language="JavaScript"> 
var p=parent;
function readtxt()
{ if(p!=null)document.forms.mistake.url.value=p.loc
 if(p!=null)document.forms.mistake.mis.value=p.mis
}
function hide()
{ var win=p.document.getElementById('mistake');
win.parentNode.removeChild(win);
}
</script>

<?php 
if (isset($_POST['submit'])) { 

$title = 'Сообщение об ошибке на сайте ' . $_SERVER['HTTP_HOST'];
$ip = getenv("REMOTE_ADDR");
$url = (trim($_POST['url']));
$mis =  substr(htmlspecialchars(trim($_POST['mis'])), 0, 100000);
$comment =  substr(htmlspecialchars(trim($_POST['comment'])), 0, 100000);
                       
                $mess = '
                Адрес страницы: '.$url.'
                Ошибка: '.$mis.'
                Комментарий: '.$comment.'                               
                IP: '.$ip.'
                '.$_POST['mess'];
# Email адрес, на который должны приходить сообщения:               
$to = 'info@res.ua';
# Email адрес, от кого пришло сообщение:
$mymail='res@' . $_SERVER['HTTP_HOST'];
# Вместо "yousite.ru" указжите имя вашего сайта:  
        $from = "From: =?utf-8?B?". base64_encode(strtoupper($_SERVER['HTTP_HOST']) . " Mistake"). "?= < $mymail >\n";
        $from .= "X-Sender: < $mymail >\n";
        $from .= "Content-Type: text/plain; charset=utf-8\n";
               
mail($to, $title, $mess, $from);
echo '<div class="bgsoo"><br><br><br><center>Повідомлення надіслано.<br>Дякуємо за Вашу увагу<br>та приділений час!<br><br><br><input onclick="hide()" type="button" value="Закрити" id="close" name="close"><br><br><br><center></div>'; 
exit();
}  
?>


</head>
<body onload=readtxt()>
<span class="text2">
Повідомити про помилку<br />
 </span>
<span class="text">
Адреса сторінки :
 </span>
<br /> 
<form name="mistake" action="" method=post>
		  <input type="text" name="url" size="30" readonly="readonly">
          <br />
          <span class="text">
          Помилка :
          </span>
          <br /> 
          <textarea rows="5" name="mis" cols="30" readonly="readonly"></textarea> 
          <br />
          <span class="text">
          Коментар :
          </span>
          <br /> 
          <textarea rows="5" name="comment" cols="30"></textarea> 
          <div class="submitform"style="margin-top: 7px"><input class="buttton" type="submit" value="Повідомити" name="submit">
          <input class="buttton" onclick="hide()" type="button" value="Відхилити" id="close" name="close"> 
          </div>
</form> 

</body></html>
