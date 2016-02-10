<?php

class Controller_dop extends Controller{
	
	function action_index($language, $text){
		$data = Model::get_data($language, 'action');	
		$this->view->generate('action_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_work($language, $text){
		$data = Model::get_data($language, 'action/work');	
		$this->view->generate('work_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_certificates($language, $text){
		$data = Model::get_data($language, 'action/certificates');	
		$this->view->generate('certificates_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_adress($language, $text){
		$data = Model::get_data($language, 'action/adress');	
		$this->view->generate('adress_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_tel($language, $text){
		$data = Model::get_data($language, 'action/tel');	
		$this->view->generate('tel_view.php', 'template_view.php', $language, $text, $data);
	}
}