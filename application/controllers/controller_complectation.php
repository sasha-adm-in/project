<?php

class Controller_complectation extends Controller{
	
	function action_index($language, $text){
		$data = Model::get_data($language, 'complectation');
		$this->view->generate('complectation_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_system($language, $text){
		$data = Model::get_data($language, 'complectation/system');
		$this->view->generate('system_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_glass($language, $text){
		$data = Model::get_data($language, 'complectation/glass');
		$this->view->generate('glass_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_implement($language, $text){
		$data = Model::get_data($language, 'complectation/implement');
		$this->view->generate('implement_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_more($language, $text){
		$data = Model::get_data($language, 'complectation/more');
		$this->view->generate('more_view.php', 'template_view.php', $language, $text, $data);
	}
}