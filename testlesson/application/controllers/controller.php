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
		if(isset($_POST['login'])){
			if(!empty($_POST['mail']) && !empty($_POST['pass'])){
				$mail = htmlspecialchars($_POST['mail']);
				$pass = MD5(htmlspecialchars($_POST['pass']));
				if($this->model->login($mail, $pass)){
					$this->view->generate('profile_view.php', 'template_view.php', $language);
				}else{
					$message = "Не верно введён E-mail или пароль. Попробуйте ещё раз";
					$this->view->generate('main_view.php', 'template_view.php', $language, $message);
				}
			}else{
				$message = "Введите пожалуйста E-mail и Пароль";
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
			$surname = htmlspecialchars($_POST['surname']);
			$name = htmlspecialchars($_POST['name']);
			$secondname = htmlspecialchars($_POST['secondname']);
			$birthday = $_POST['birthday'];
			$birthmonth = $_POST['birthmonth'];
			$birthyear = $_POST['birthyear'];
			$sex = $_POST['sex'];
			$adress = htmlspecialchars($_POST['adress']);
			$tel = htmlspecialchars($_POST['tel']);
			$mail = htmlspecialchars($_POST['mail']);			
			$pass = MD5(htmlspecialchars($_POST['pass']));
			if($_FILES['file']['error'] == 0 && $_FILES['file']['size'] < 10000000){
				if($this->model->insert_photo($_FILES, $mail)) $file = $_FILES;
			}			
			if($this->model->insert_user($surname, $name, $secondname, $birthday, $birthmonth, $birthyear, $sex, $adress, $tel, $mail, $pass, $file)){
				$message = "Вы успешно зарегистрировались. Теперь можете войти используя свой аккаунт";
				$this->view->generate('main_view.php', 'template_view.php', $language, $message);
			}else{
				$message = "Ошибка при регистрации. Попробуйте ещё раз";
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