<form class="form_login" action='/<?=$language?>/login' method="post">
	<div class="login"><?=$lang["AUTHORIZATION"]?></div>
	<div class="username-text">E-mail:</div>
	<div class="password-text">Пароль:</div>
	<div class="username-field">
		<input type='text' name='mail'>
	</div>
	<div class="password-field">
		<input type='password' name='pass'>
	</div>	
	<div class="forgot-usr-pwd"><a href='/<?=$language?>/registration'><?=$lang["REGISTRATION"]?></a></div>
	<input class="submit_login" type='submit' name='login' value='<?=$lang["IN"]?>'>
</form>