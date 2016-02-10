<div class="text">
	<h1><?=$lang["MENU5.2"]?></h1> 
		
		<?php			
			if(!empty($adir)) echo "<h3>Скачать:</h3>";
			for($i=0; $i<count($adir); $i++){
				if($_SESSION['login'] == 'Admin'){
				echo 
					"<form class='file' action='/".$language."/main/update' method='post'>
						<fieldset>
						<legend><a href='/download/".$adir[$i]['file_name']."' download>".$adir[$i]['file_name']."</a></legend>
						<input type='hidden' name='file' value=".$adir[$i]['file_name'].">																							
						<textarea name='description' cols='79' rows='5' style='resize: vertical'>".$adir[$i]['file_description']."</textarea>
						</fieldset>
						<input type='submit' name='save' value='Сохранить описание'>
						<input type='submit' name='delete' value='Удалить файл'>
					</form><hr/>
					";
				}
				else
					echo
					"<form class='file' action='/".$language."/main/update' method='post'>
						<fieldset>
						<legend><a href='/download/".$adir[$i]['file_name']."' download>".$adir[$i]['file_name']."</a></legend>
						<input type='hidden' name='file' value=".$adir[$i]['file_name'].">																							
						<textarea name='description' cols='79' rows='5' style='resize: vertical'>".$adir[$i]['file_description']."</textarea>
						</fieldset>
					</form><hr/>	
					";	
			}
		if($_SESSION['login'] == 'Admin'):
		?>
			<h3>Загрузить:</h3>
		<form action = "/<?=$language?>/main/login" enctype="multipart/form-data" method="post">										
			<input type = "file" name = "file"	id="file"><br/>
			<textarea name="description" cols="79" rows="5" style="resize: vertical" placeholder=" описание"></textarea><br/>
			<input type = "submit" name = "submitt" value="Разместить">
		</form>
		<h3>База дилеров</h3>
		
		<a href="#" onclick="diplay_hide('#hidden_content');return false;">Создать нового дилера</a><br/><br/><br/>

		
			
		<form action="/<?=$language?>/main/create_user" method="post" id="hidden_content" style="<?php if(!isset($view_user)) echo 'display: none;'?>"> 
			<table class="form_reg">
				<tr colspan="4">												
					<td>
						<p>Доступ:</p>
						<input type="radio" name="access" value="on" <?php if(!isset($view_user['access']) || $view_user['access'] == 'on') echo 'checked'?>>да<br/>
						<input type="radio" name="access" value="off" <?php if($view_user['access'] == 'off') echo 'checked'?>>нет
						</td>
						<td>
						<p>Работает:</p>
						<input type="radio" name="shana" value="1" <?php if(!isset($view_user['shana']) || $view_user['shana'] == '1') echo 'checked'?>>да<br/>
						<input type="radio" name="shana" value="0" <?php if($view_user['shana'] == '0') echo 'checked'?>>нет
					</td>
				</tr>
				<tr>
					<td>
						<small>Фамилия</small>
					</td>
					<td>
						<small>Имя</small>
					</td>
					<td>
						<small>Отчество</small>
					</td>
					<td>
						<?php if($view_user['password']) echo "<small>Пароль</small>" ?>
					</td>
				</tr>
				
				<tr>
					<td>
						<input type="text" name="surname" value="<?php echo $view_user['surname'] ?>" <?php if(isset($view_user)) echo 'autofocus'?>>
					</td>
					<td>
						<input type="text" name="name" value="<?php echo $view_user['name'] ?>">
					</td>
					<td>
						<input type="text" name="secondname" value="<?php echo $view_user['secondname'] ?>">
					</td>
					<td>
						<?php if($view_user['password']) echo $view_user['password'] ?>
					</td>	
				</tr>
				
				<tr>												
					<td>
						<small>Адрес</small>
					</td>
					<td>
						<small>Телефон</small>
					</td>
					<td>
						<small>E-mail</small>
					</td>
				</tr>
				<tr>
					<td>
						<input type="text" name="address" value="<?php echo $view_user['address'] ?>">
					</td>
					<td>
						<input type="text" name="tel" value="<?php echo $view_user['tel'] ?>">
					</td>
					<td>
						<input type="text" name="login" value="<?php echo $view_user['login'] ?>"><input type = "submit" name = "save" value="Сохранить">
					</td>
				</tr>
			</table>											
			<input type="hidden" name="id" value="<?php echo $view_user['id'] ?>">											
		</form>
		
		<form action="/<?=$language?>/main/login" method="POST">
			<input type="text"  name="search" placeholder="Поиск"/>
			
			
			<input type="submit" value="Найти" name="search_butt"/>
			
			<input type="submit" value="Все" name="all_butt"/>
			<input type="submit" value="Работают" name="yes_butt"/>
			<input type="submit" value="Неработают" name="no_butt"/><br/><br/>
			
			
			
		</form>
		
		<form action="/<?=$language?>/main/send" method="POST" name='form_name1'>
		<input type="submit" name="send" value="Отправить почту"/><br/><br/>
		<a href="javascript:sel_all()" title="Выделить всех/снять выделение">Выделить всех/снять выделение</a><br/>		
		<?php foreach($users as $key => $value):	
			if($value['shana'] == "1"){
				$color = "shest_green";
			}
			elseif($value['shana'] == "0"){
				$color = "shest_red";
			}?>
			<table class="base_table" id="<?=$color?>">			
				<tr style>				
					<td><input type="checkbox" id="cheks" name="<?php echo $value['id']?>"></td>
					<td class='base_td'>
						<?=$value['surname']?>
					</td>
					<td class='base_td'>
						<?=$value['name']?>
					</td>
					<td class='base_td'>
						<?=$value['secondname']?>
					</td>
					<td class='base_td'>
						<?=$value['tel']?>
					</td>
					<td class='base_td'>
						<?=$value['address']?>
					</td>
					<td class='base_td'>
						<?=$value['login']?>
					</td>
					<td class='base_td'>
						<?=$value['password']?>
					</td>					
					<td class='base_td'>
						<?=$value['date']?>
					</td>
					<td class='base_td'>
						<a href="/<?=$language?>/main/login/<?=$value['id'] ?>">ред.</a>
					</td>				
				</tr>				
			</table>	
		<?php endforeach?>
		</form>				
		<?php 
			endif;
				
		?>	
		

</div>