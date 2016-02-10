<?php

class Controller{
	//конструктор создает экземпляр модели и генератора видов
	function __construct(){
        $this->model = new Model();
        $this->view = new View();		
    }	
	//главная страница
	public function index($language){
		if(!empty($_SESSION['profile']['name'])){
			$this->view->generate('profile_view.php', 'template_view.php', $language);		
		}else{
			$this->view->generate('main_view.php', 'template_view.php', $language);	
		}
	}
	//авторизация пользователя
	public function login($language){
		$lang = parse_ini_file("application/lang/".$language.".ini");

		if(isset($_POST['login'])){
			if(!empty($_POST['mail']) && !empty($_POST['pass'])){
				$mail = mysql_escape_string($_POST['mail']);
				$pass = MD5(mysql_escape_string($_POST['pass']));
				if($this->model->login($mail, $pass)){
					$this->view->generate('profile_view.php', 'template_view.php', $language);
				}else{
					$message = $lang['ADRESS'];
					$this->view->generate('main_view.php', 'template_view.php', $language, $message);
				}
			}else{
				$message = $lang['NO_GET_LOGIN'];
				$this->view->generate('main_view.php', 'template_view.php', $language, $message);
			}
		}elseif(!empty($_SESSION['profile']['name'])){
			$this->view->generate('profile_view.php', 'template_view.php', $language);
		}else{
			$this->view->generate('main_view.php', 'template_view.php', $language);
		}
	}
	//регистрация пользователя
	public function registration($language){
		$lang = parse_ini_file("application/lang/".$language.".ini");
		
		if(isset($_POST['pass2']) && 
		   !empty($_POST['surname']) && 
		   !empty($_POST['name']) && 
		   !empty($_POST['secondname']) && 
		   !empty($_POST['birthday']) && 
		   !empty($_POST['birthmonth']) && 
		   !empty($_POST['birthyear']) && 
		   !empty($_POST['sex']) && 
		   !empty($_POST['adress']) && 
		   !empty($_POST['tel']) && 
		   !empty($_POST['mail']) && 		   
		   !empty($_POST['pass']) && 
		   !empty($_POST['pass2']) &&
		   preg_match("/^[\w\.\d-_]+@[\w\.\d-_]+\.\w{2,4}$/i", $_POST['mail']) && 
		   preg_match("/^[0-9]{10}$/", $_POST['tel'])   
		   )
		{
			$surname = mysql_escape_string($_POST['surname']);
			$name = mysql_escape_string($_POST['name']);
			$secondname = mysql_escape_string($_POST['secondname']);
			$birthday = intval($_POST['birthday']);
			$birthmonth = intval($_POST['birthmonth']);
			$birthyear = intval($_POST['birthyear']);
			$sex = intval($_POST['sex']);
			$adress = mysql_escape_string($_POST['adress']);
			$tel = intval($_POST['tel']);
			$mail = mysql_escape_string($_POST['mail']);			
			$pass = MD5(mysql_escape_string($_POST['pass']));

			if($_FILES['file']['error'] == 0 && $_FILES['file']['size'] < 10000000){
				if($this->model->insert_photo($_FILES, $mail)){
					$file_name = $mail."_".$_FILES['file']['name'];
				}else{
					$file_name = false;
				}
			}

			$user_data = array($surname, $name, $secondname, $birthday, $birthmonth, $birthyear, $sex, $adress, $tel, $mail, $pass, $file_name);			
			if($this->model->insert_user($user_data)){
				$message = $lang['LOGIN_OK'];
				$this->view->generate('main_view.php', 'template_view.php', $language, $message);
			}else{
				$message = $lang['LOGIN_NO'];
				$this->view->generate('main_view.php', 'template_view.php', $language, $message);
			}
			
		}else{
			$this->view->generate('registration_view.php', 'template_view.php', $language);	
		}
	}
	
	//выход пользователя
	public function logout($language){
		$this->model->destroy();
		$this->view->generate('main_view.php', 'template_view.php', $language);
	}	
}