<div class="text">
	<h1>Отправка почты</h1>  
	<form action="/<?=$language?>/main/send" enctype="multipart/form-data" method="post" id="feedback-form">	
		<input type="text" name="contactFF" id="contactFF" required x-autocompletetype="email" placeholder="E-mail" 
			value="<?php 
				if(isset($data)){
					foreach($data as $key => $value){
						if($value['login'] == "Admin"){
							unset($value['login']);
						}else  echo $value['login'].", ";}
				}
			?>"><br/>		
		<input type="text" name="subjectFF" id="subjectFF" x-autocompletetype="name" placeholder="Тема" class="w100 border"><br/>
		
		<input type="file" name="fileFF[]" multiple id="fileFF" class="w101"><br/>
		<input value="Отправить" type="submit" name="mail_go" id="submitFF"><br/><br/>
		<textarea name="messageFF" id="messageFF" rows="5" class="w100 border"></textarea>
		<br/>	
	</form>
	
</div>