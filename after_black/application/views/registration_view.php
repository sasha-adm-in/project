<form class="form_registration" action='/<?=$language?>/registration' method="post" enctype="multipart/form-data" name="myform" id="myform" accept-charset="utf-8">
	<table class="reg_table">
		<tr>
			<td colspan='3'><h1><?=$lang["REGISTRATION"]?></h1></td>
		</tr>
		<tr>
			<th><p><?=$lang["SURNAME"]?></p></th>
			<td><input type="text" title="<?=$lang['IN_SURNAME']?>" name="surname"/></td>
		</tr>
		<tr>
			<th><p><?=$lang["NAME"]?></p></th>
			<td><input type="text"  title="<?=$lang['IN_NAME']?>" name="name"/></td>
		</tr>
		<tr>
			<th><p><?=$lang["SECONDNAME"]?></p></th>
			<td><input type="text"  title="<?=$lang['IN_SECONDNAME']?>" name="secondname"/></td>
		</tr>
		<tr>
			<th><p><?=$lang["BIRTHDAY"]?></p></th>
			<td>
				<select title="<?=$lang['IN_DATE']?>" name="birthday">
					<option value selected="selected"><?=$lang['DAY']?></option>
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
				<select title="<?=$lang['IN_MONTH']?>" name="birthmonth">
					<option value selected="selected"><?=$lang['MONTH']?></option>
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
				<select title="<?=$lang['IN_YEAR']?>" name="birthyear">
					<option value selected="selected"><?=$lang['YEAR']?></option>
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
			<th><?=$lang["SEX"]?></th>
			<td>
				<input type="radio" name="sex" value="1" title="<?=$lang['IN_SEX']?>"/><?=$lang["SEXM"]?>
				<input type="radio" name="sex" value="2" title="<?=$lang['IN_SEX']?>"/><?=$lang["SEXW"]?>
				<small id="sex"><small></small></small>
			</td>
		</tr>
		<tr>
			<th><p><?=$lang["ADRESS"]?></p></th>
			<td><input type="text" name="adress" title="<?=$lang['IN_ADDRESS']?>"/></td>
		</tr>
		<tr>
			<th><p><?=$lang["TEL"]?> +38</p></th>
			<td><input type="text" name="tel" title="<?=$lang['IN_TEL']?>"/></td>
		</tr>
		<tr>
			<th><p>E-mail</p></th>
			<td><input type="email" name="mail" title="<?=$lang['IN_MAIL']?>"/></td>
		</tr>
		<tr>
			<th><p><?=$lang["PASS"]?></p></th>
			<td><input type="password" name="pass" title="<?=$lang['IN_PASS']?>"/></td>
		</tr>	
		<tr>
			<th><p><?=$lang["PASS2"]?></p></th>
			<td><input type="password" name="pass2" title="<?=$lang['PASS2']?>"/></td>
		</tr>	
		<tr>
			<th><p><?=$lang["PHOTO"]?></p></th>
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