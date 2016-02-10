<?php

class Controller_cooperation extends Controller{
	
	function action_index($language, $text){
		$data = Model::get_data($language, 'cooperation');
		$this->view->generate('cooperation_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_private($language, $text){
		$data = Model::get_data($language, 'cooperation/private');
		$this->view->generate('private_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_login($language, $text){
		$data = Model::get_data($language, 'cooperation/login');
		if(!empty($_SESSION['login'])){
			$this->view->generate('login_view.php', 'template_view.php', $language, $text, $data);
		}else{
			$this->view->generate('nologin_view.php', 'template_view.php', $language, $text, $data);
		}
	}
	function action_corp($language, $text){
		$data = Model::get_data($language, 'cooperation/corp');
		$this->view->generate('corp_view.php', 'template_view.php', $language, $text, $data);
	}
}