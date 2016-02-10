<?php

class Controller_about extends Controller{
	
	function action_index($language, $text){
		$data = Model::get_data($language, 'about');	
		$this->view->generate('about_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_history($language, $text){
		$data = Model::get_data($language, 'about/history');	
		$this->view->generate('history_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_personal($language, $text){
		$data = Model::get_data($language, 'about/personal');	
		$this->view->generate('personal_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_fabrication($language, $text){
		$data = Model::get_data($language, 'about/fabrication');	
		$this->view->generate('fabrication_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_partners($language, $text){
		$data = Model::get_data($language, 'about/partners');	
		$this->view->generate('partners_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_vacancies($language, $text){
		$data = Model::get_data($language, 'about/vacancies');	
		$this->view->generate('vacancies_view.php', 'template_view.php', $language, $text, $data);
	}	
	function action_contacts($language, $text){
		$data = Model::get_data($language, 'about/contacts');	
		$this->view->generate('contacts_view.php', 'template_view.php', $language, $text, $data);
	}
}