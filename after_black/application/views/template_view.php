<?php
if($language == 'ru' || $language == 'ua' || $language == 'be' || $language == 'en' || $language == 'de'){
}else $language = 'ru';
$lang = parse_ini_file("application/lang/".$language.".ini");

$rout = spliti('/', $_SERVER['REQUEST_URI'], 3);
if(isset($message)){
	echo "
		<script type='text/javascript'>
			alert('".$message."');
		</script>
	";		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Тест</title>	
	<meta http-equiv="Content-Type" content="charset=UTF-8"/>
	<link rel="stylesheet" type="text/css" href="/css/style.css"/>
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#showPortfolio").click(function(){
				$("#portfolio").animate({width:"1024px", opacity:"1"}, 800);
				
			});
		});
	</script>
	
</head>
<body>	
	<div id="container">
		<div class="lang">
			<a href="/ru/<?=$rout['2']?>"><img src="/images/ru.png" width="20px" alt="ru" title="ru"/></a>
			<a href="/ua/<?=$rout['2']?>"><img src="/images/ua.png" width="20px" alt="ua" title="ua"/></a>
			<a href="/be/<?=$rout['2']?>"><img src="/images/be.png" width="20px" alt="be" title="be"/></a>
			<a href="/en/<?=$rout['2']?>"><img src="/images/en.png" width="20px" alt="en" title="en"/></a>
			<a href="/de/<?=$rout['2']?>"><img src="/images/de.png" width="20px" alt="de" title="de"/></a>	
		</div>
		<?php include 'application/views/'.$content_view?>
		<input type="button" value="Push" id="showPortfolio"/>
		<div id="portfolio">
			
		</div>
	</div>



<?php include "./js/js.php";?>





</body>
</html>