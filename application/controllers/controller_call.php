<?php

class Controller_call extends Controller{
	function __construct()
    {
        $this->model = new model_call();
        $this->view = new View();		
    }
	
	function action_index($language, $text){
		if(isset($_POST['call'])){
			if(!empty($_POST['name_people']) && !empty($_POST['tel_people']) && !empty($_POST['keystring'])){
				if(isset($_SESSION['captcha_keystring']) && strtolower($_SESSION['captcha_keystring']) == strtolower($_POST['keystring'])){
					$this->model->call($_POST['name_people'], $_POST['tel_people'], $_POST['comment_people']);				
				}else{
					echo '<p style="color:#ff0f0f;">Ошибка - неправильный ввод числа</p>';
				}
			}else{
				echo '<p style="color:#ff0f0f;">Вы не заполнили обязательные поля</p>';	
			}
		}
		
		
		$data = Model::get_data($language, 'call');	
		$this->view->generate('call_view.php', 'template_view.php', $language, $text, $data);
	}
}