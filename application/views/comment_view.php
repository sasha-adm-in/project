<div class="text">
	<h1><?=$lang["COMMENT"]?></h1> 
	<?=$data[0]['text']?>	
	
	<button id="create_comment">Оставить отзыв</button>
	<div class="comment">
		<form action="/<?=$language?>/comment" method="post">
			<table>
				<tr>
					<td><p>*Ваше имя:</p></td>
					<td><input type="text" name="name"/></td>
				</tr>
				<tr>
					<td><p>*Ваш email:</p></td>
					<td><input type="text" name="email"/></td>
				</tr>
				<tr>
					<td><p>Ваш отзыв:</p></td>
					<td><textarea rows="5" cols="31" name="comment"></textarea></td>
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
					<td><input type="submit" value="Отправить"  name="comment_form"></td>
				</tr>
			</table>
		</form>
	</div>
	<div class="comment_list">
		<div class="comment_area">
			<?php
				if(!empty($adir)):
				foreach($adir as $key => $value):
				if($_SESSION['login'] == 'Admin'):
			?>		
				<input type="button" class="button_public_comment" value="Скрыть" onclick="runAjax(<?=$value['id']?>, <?=$value['public']?>)"/>
				<?php endif;?>
			
				<p>
					<small><?=$value['name']."(".$value['date'].")";?></small><br/>
					<span><?=$value['comment']?></span>
				</p>
			<?php 
				endforeach;
				endif;
			?>
		</div>
		<div class="comment_area_nopublic">			
			<?php
				if(!empty($users)):
					foreach($users as $key => $value):
			?>			<input type="button" class="button_public_comment" value="Опубликовать" onclick="runAjax(<?=$value['id']?>, <?=$value['public']?>)"/>
						<p>
							<small><?=$value['name']."(".$value['date'].")";?></small><br/>
							<span><?=$value['comment']?></span>
						</p>
			<?php 
				endforeach;
				endif;
			?>
		</div>
		
	</div>
		
		
		
		
		
		

	
</div>