<?php 
	if(isset($_POST['button'])){
		$value = $_POST['button'];
		setcookie("button", $value, time()+3600);
	}
	if(isset($_POST['getbutton'])){
	if($_POST['getbutton'] == 'da' && $_POST['otherbuttons'] == 'uri') {
		//$value = $_POST['getbutton'];
		echo '<label class="clear">
                                <input type="radio" name="person" value="0"  id="no-register"/>
                                <span class="tab1_1">Оформити замовлення без реєстрації</span>
                            </label>
                            <label class="clear">
                                <input type="radio" name="person" value="1" id="register-fiz" />
                                <span class="tab1_2">Фізична особа </span>
                            </label>
                            <label class="clear">
                                <input type="radio" name="person" value="2" checked="cheked" id="register-uri" />
                                <span class="tab1_3">Юридична особа</span>
                            </label>';
		}
	else if($_POST['getbutton'] == 'da' && $_POST['otherbuttons'] == 'fiz') {
	echo '<label class="clear">
                                <input type="radio" name="person" value="0"  id="no-register"/>
                                <span class="tab1_1">Оформити замовлення без реєстрації</span>
                            </label>
                            <label class="clear">
                                <input type="radio" name="person" value="1" checked="cheked" id="register-fiz" />
                                <span class="tab1_2">Фізична особа </span>
                            </label>
                            <label class="clear">
                                <input type="radio" name="person" value="2" id="register-uri" />
                                <span class="tab1_3">Юридична особа</span>
                            </label>';
	}
	else {
	echo '<label class="clear">
                                <input type="radio" name="person" value="0"  checked="checked" id="no-register"/>
                                <span class="tab1_1">Оформити замовлення без реєстрації</span>
                            </label>
                            <label class="clear">
                                <input type="radio" name="person" value="1"  id="register-fiz" />
                                <span class="tab1_2">Фізична особа </span>
                            </label>
                            <label class="clear">
                                <input type="radio" name="person" value="2" id="register-uri" />
                                <span class="tab1_3">Юридична особа</span>
                            </label>';
	}
	}
	
?>