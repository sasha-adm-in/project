<form class="form_registration" action='/<?=$language?>/registration' method="post" enctype="multipart/form-data" name="myform" id="myform">
	<table class="reg_table">
		<tr>
			<td colspan='3'><h1><?=$lang["REGISTRATION"]?></h1></td>
		</tr>
		<tr>
			<td><p><?=$lang["SURNAME"]?></p></td>
			<td><input type="text" title="Введите фамилию" name="surname"/></td>
		</tr>
		<tr>
			<td><p><?=$lang["NAME"]?></p></td>
			<td><input type="text"  title="Введите имя" name="name"/></td>
		</tr>
		<tr>
			<td><p><?=$lang["SECONDNAME"]?></p></td>
			<td><input type="text"  title="Введите отчество" name="secondname"/></td>
		</tr>
		<tr>
			<td><p><?=$lang["BIRTHDAY"]?></p></td>
			<td>
				<select title="Укажите число рождения" name="birthday">
					<option value selected="selected">Д</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select>
				<select title="Укажите месяц рождения" name="birthmonth">
					<option value selected="selected">М</option>
					<option value="1">Январь</option>
					<option value="2">Февраль</option>
					<option value="3">Март</option>
					<option value="4">Апрель</option>
					<option value="5">Май</option>
					<option value="6">Июнь</option>
					<option value="7">Июль</option>
					<option value="8">Август</option>
					<option value="9">Сентябрь</option>
					<option value="10">Октябрь</option>
					<option value="11">Ноябрь</option>
					<option value="12">Декабрь</option>
				</select>
				<select title="Укажите год рождения" name="birthyear">
					<option value selected="selected">Г</option>
					<option value="2009">2009</option>
					<option value="2008">2008</option>
					<option value="2007">2007</option>
					<option value="2006">2006</option>
					<option value="2005">2005</option>
					<option value="2004">2004</option>
					<option value="2003">2003</option>
					<option value="2002">2002</option>
					<option value="2001">2001</option>
					<option value="2000">2000</option>
					<option value="1999">1999</option>
					<option value="1998">1998</option>
					<option value="1997">1997</option>
					<option value="1996">1996</option>
					<option value="1995">1995</option>
					<option value="1994">1994</option>
					<option value="1993">1993</option>
					<option value="1992">1992</option>
					<option value="1991">1991</option>
					<option value="1990">1990</option>
					<option value="1989">1989</option>
					<option value="1988">1988</option>
					<option value="1987">1987</option>
					<option value="1986">1986</option>
					<option value="1985">1985</option>
					<option value="1984">1984</option>
					<option value="1983">1983</option>
					<option value="1982">1982</option>
					<option value="1981">1981</option>
					<option value="1980">1980</option>
				</select>
				<small id="birth"><small></small></small>
			</td>
		</tr>
		<tr>
			<td><?=$lang["SEX"]?></td>
			<td>
				<input type="radio" name="sex" value="1" title="Укажите пол"/><?=$lang["SEXM"]?>
				<input type="radio" name="sex" value="2" title="Укажите пол"/><?=$lang["SEXW"]?>
				<small id="sex"><small></small></small>
			</td>
		</tr>
		<tr>
			<td><p><?=$lang["ADRESS"]?></p></td>
			<td><input type="text" name="adress" title="Введите адрес"/></td>
		</tr>
		<tr>
			<td><p><?=$lang["TEL"]?> +38</p></td>
			<td><input type="text" name="tel" title="Введите номер телефона"/></td>
		</tr>
		<tr>
			<td><p>E-mail</p></td>
			<td><input type="email" name="mail" title="Введите эл.адрес"/></td>
		</tr>
		<tr>
			<td><p><?=$lang["PASS"]?></p></td>
			<td><input type="password" name="pass" title="Введите пароль"/></td>
		</tr>	
		<tr>
			<td><p><?=$lang["PASS2"]?></p></td>
			<td><input type="password" name="pass2" title="Введите пароль ещё раз"/></td>
		</tr>	
		<tr>
			<td><p><?=$lang["PHOTO"]?></p></td>
			<td>
				<label class="uploadbutton">
					<div class="button" ><?=$lang["SELECT"]?></div>
					<div id="file" class='input'><?=$lang["SELECT2"]?></div>
					<input type="file" name="file" onchange="this.previousSibling.previousSibling.innerHTML = this.value"/>
				</label>
			</td>
		</tr>
	</table>
	<input class="save_submit" type="button" onclick="validate(this.form)" name="save_user" value="<?=$lang["SAVE"]?>" title="Нажмите чтоб создать профиль"/>
</form>