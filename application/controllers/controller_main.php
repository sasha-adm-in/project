<?php

class Controller_main extends Controller{
	function __construct()
    {
        $this->model = new model_main();
        $this->view = new View();		
    }
	
	
	public function action_index($language, $text, $arg = null){
		
		if(isset($arg)){
			Session::destroy();
		}
		$data = Model::get_data($language, 'main');		
		$this->view->generate('main_view.php', 'template_view.php', $language, $text, $data);		
	}
	
	
	
	
	
	
	public function action_login($language, $text, $id){
		if(isset($_FILES)) $files = $_FILES;
		if(isset($_POST)) $post = $_POST;
		if(isset($post['submitt']) && $files['file']['error'] == 0){
			$this->model->action_upload($files, $post);
			echo "<script language='JavaScript'>window.location.pathname = '/".$language."/main/login'</script>";
		}
		if(!empty($id)){
			$view_user = $this->model->view_user($id);
		}
		$adir = $this->model->view_description();
		$data = Model::get_data($language, 'main/login');
		
		
		$users = $this->model->all_users();
		
		if(isset($_SESSION['login'])){
			$this->view->generate('login_view.php', 'template_view.php', $language, $text, $data, $adir, $users, $view_user);					
		}else $this->view->generate('login_panel_view.php', 'template_view.php', $language, $text, $data, $adir, $users, $view_user);					
	}	
	
	public function action_logout(){
		Session::destroy();
		echo "<script language='JavaScript'>window.location.pathname = '/".$language."/main'</script>";	
	}
	
	
	public function action_update($language){
		if(isset($_POST['delete'])){	
			if(unlink('download/'.$_POST['file']) && $this->model->delete_file($_POST['file'])){
				echo "<script language='JavaScript'>window.location.pathname = '/".$language."/main/login/'</script>";	
			}
		}
		if(isset($_POST['save'])){
			if($this->model->update_file($_POST['file'], $_POST['description'])){
				echo "<script language='JavaScript'>window.location.pathname = '/".$language."/main/login/'</script>";
			}
		}
	}
	
	
	
	public function action_create_user($language, $text, $id){
		if(isset($_POST['save'])){
			$surname = $_POST['surname'];
			$name = $_POST['name'];
			$secondname = $_POST['secondname'];
			$tel = $_POST['tel'];
			$address = $_POST['address'];
			$login = $_POST['login'];
			$access = $_POST['access'];
			$shana = $_POST['shana'];
			$id = $_POST['id'];
			
			
			if(!empty($id)){
				if($this->model->update_user($id, $access, $surname, $name, $secondname, $tel, $address, $login, $shana)){
					echo "<script language='JavaScript'>
					alert('Пользователь сохранён');
					window.location.pathname = '/".$language."/main/login/'</script>";
				}else echo "Ошибка при редактировании пользователя";
			}
			else{
				if($this->model->insert_user($access, $surname, $name, $secondname, $tel, $address, $login, $shana)){
					echo "<script language='JavaScript'>
					alert('Пользователь создан');
					window.location.pathname = '/".$language."/main/login/'</script>";
				}else echo "Ошибка при создании пользователя";
			}
		}
	}
	public function action_send($language){
		if(isset($_POST['send'])){
			foreach ($_POST as $key => $value) {
				if($value == 'on') $data_id[] = $key;
			}
			$data = $this->model->all_users($data_id);
		}
		if(isset($_POST['mail_go'])){
			$this->model->mail_go();
		}
	$this->view->generate('send_view.php', 'template_view.php', $language, $text, $data, $adir, $users, $view_user);
	}
	
	public function action_search($language){
		if(isset($_POST['search_sub']) && isset($_POST['search'])){
			$data = $this->model->search($_POST['search'], $language);
		}
	$this->view->generate('search_view.php', 'template_view.php', $language, $text, $data);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}