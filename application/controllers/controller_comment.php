<?php

class Controller_comment extends Controller{
	function __construct()
    {
        $this->model = new model_comment();
        $this->view = new View();		
    }
	
	function action_index($language, $text){
		if(isset($_POST['comment_form'])){
			if(!empty($_POST['name'])){
					$name=$_POST['name'];
				}else $name="Аноним";
			if(!empty($_POST['comment']) && !empty($_POST['keystring'])){
				if(isset($_SESSION['captcha_keystring']) && strtolower($_SESSION['captcha_keystring']) == strtolower($_POST['keystring'])){
					$this->model->new_comment($name, $_POST['email'], $_POST['comment']);				
				}else{
					echo '<p style="color:#ff0f0f;">Ошибка - неправильный ввод числа</p>';
				}
			}else{
				echo '<p style="color:#ff0f0f;">Вы не заполнили обязательные поля</p>';	
			}
		}
		if($_SESSION['login'] == 'Admin'){
			$users = $this->model->nopublic_comments();
		}
		$adir = $this->model->all_comments();
		// if(!empty($dir)){
			// foreach($dir as $key=>$value){
				// if($key == 1){
					// $a[] = $value;
				// }
			// }
		// }
		// print_r($a);
		$this->view->generate('comment_view.php', 'template_view.php', $language, $text, $data, $adir, $users);		
	}

	
}