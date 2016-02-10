<div class="animate_window">
	<button id="animate_window_close">X</button>
	<form action="/<?=$language?>/question" method="post">
		<input type="text" name="name" placeholder="Ваше имя"/><br/>
		<input type="text" name="mail" placeholder="Ваш email"/><br/>
		<input type="text" name="tel" placeholder="Ваш номер телефона"/><br/>
		<textarea cols="50" rows="11" name="question" placeholder="Ваш вопрос"></textarea><br/>
		<input type="submit" name="ask_question" value="Задать"/>
	</form>
</div>

<div class="right_banner">		
	<div class="right_banner_show">
		<a href="/<?=$language?>/call"><p class="right_banner_show1">Вызов замерщика с сайта - скидка 2%</p></a>
		<a href="#"><p class="right_banner_show2">Задать вопрос профессионалу</p></a>
		<a href="/<?=$language?>/comment"><p class="right_banner_show3">Оставить отзыв о компании</p></a>
	</div>
	<div class="hide"><span>о<br/>б<br/>р<br/>а<br/>т<br/>н<br/>а<br/>я<br/><br/>с<br/>в<br/>я<br/>з<br/>ь</span></div>		
</div>