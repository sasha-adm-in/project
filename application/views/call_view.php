<div class="text">
	<h1><?=$lang["CALL"]?></h1> 
	<?=$data[0]['text']?>	
	
	
	<div class="call">
		<form action="/<?=$language?>/call" method="post">
			<table>
				<tr>
					<td><p>*Ваше имя:</p></td>
					<td><input type="text" name="name_people"/></td>
				</tr>
				<tr>
					<td><p>*Номер телефона:</p></td>
					<td><input type="text" name="tel_people"/></td>
				</tr>
				<tr>
					<td><p>Коментарий:</p></td>
					<td><textarea rows="5" cols="31" name="comment_people"></textarea></td>
				</tr>
				<tr>
					<td><br/><br/>
						<p>*Введите текст с картинки</p>
						<img title="Если Вы не видите число на картинке, нажмите на картинку мышкой" onclick="this.src=this.src+'&amp;'+Math.round(Math.random())" src="/js/captcha/imaga.php?<?php echo session_name()?>=<?php echo session_id()?>"/><br/>
						<small>Если не видишь код - кликни по картинке</small><br/>
						<input type="text" name="keystring">
					</td>				
				</tr>
				<tr>
					<td><input type="submit" value="Отправить"  name="call"></td>
				</tr>
			</table>
		</form>
	</div>
	<div class="call_img">
		<img src="/images/call.jpg" alt=""/>
	</div>
		
		
		
		
		
		

	
</div>