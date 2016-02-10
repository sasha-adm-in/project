<?php 
$rout = explode('/', $_SERVER['REQUEST_URI'], 3);
?>


<div class="logo">
	<a href="/<?=$language?>"><img src="/images/logo.png" alt="logo"/></a>
</div>
<div class="top_right">
	<div class="lang">		
		<a href="/ua/<?=$rout['2']?>"><img src="/images/ua.jpg" width="20px" alt="ua"/></a>
		<a href="/ru/<?=$rout['2']?>"><img src="/images/ru.png" width="20px" alt="ru"/></a>
	</div>	
	<div class="tel">		
		<p>(096)832-40-45<br/>
		(0432)57-20-19</p>
		<form name="search_form" action="/<?=$language?>/main/search" method="post">
			<input type="text" name="search" placeholder="Поиск"/>
			<input type="submit" name="search_sub" value=""/>
		</form>
	</div>
</div>
