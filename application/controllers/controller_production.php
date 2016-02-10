<?php

class Controller_production extends Controller{
	
	function action_index($language, $text){
		$data = Model::get_data($language, 'production');
		$this->view->generate('production_view.php', 'template_view.php', $language, $text, $data);
	}	
	function action_windows($language, $text){
		$data = Model::get_data($language, 'production/windows');
		$this->view->generate('windows_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_doors($language, $text){
		$data = Model::get_data($language, 'production/doors');
		$this->view->generate('doors_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_nostandart($language, $text){
		$data = Model::get_data($language, 'production/nostandart');
		$this->view->generate('nostandart_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_energy($language, $text){
		$data = Model::get_data($language, 'production/energy');
		$this->view->generate('energy_view.php', 'template_view.php', $language, $text, $data);
	}
	
	
	
	function action_windows1($language, $text){
		$data = Model::get_data($language, 'production/windows1');
		$this->view->generate('windows1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_windows2($language, $text){
		$data = Model::get_data($language, 'production/windows2');
		$this->view->generate('windows1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_windows3($language, $text){
		$data = Model::get_data($language, 'production/windows3');
		$this->view->generate('windows1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_windows4($language, $text){
		$data = Model::get_data($language, 'production/windows4');
		$this->view->generate('windows1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_windows5($language, $text){
		$data = Model::get_data($language, 'production/windows5');
		$this->view->generate('windows1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_windows6($language, $text){
		$data = Model::get_data($language, 'production/windows6');
		$this->view->generate('windows1_view.php', 'template_view.php', $language, $text, $data);
	}
	
	
	function action_door1($language, $text){
		$data = Model::get_data($language, 'production/door1');
		$this->view->generate('door1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_door2($language, $text){
		$data = Model::get_data($language, 'production/door2');
		$this->view->generate('door1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_door3($language, $text){
		$data = Model::get_data($language, 'production/door3');
		$this->view->generate('door1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_door4($language, $text){
		$data = Model::get_data($language, 'production/door4');
		$this->view->generate('door1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_door5($language, $text){
		$data = Model::get_data($language, 'production/door5');
		$this->view->generate('door1_view.php', 'template_view.php', $language, $text, $data);
	}
}