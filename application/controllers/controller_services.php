<?php

class Controller_services extends Controller{
	
	function action_index($language, $text){
		$data = Model::get_data($language, 'services');
		$this->view->generate('services_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_consultation($language, $text){
		$data = Model::get_data($language, 'services/consultation');
		$this->view->generate('consultation_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_delivery($language, $text){
		$data = Model::get_data($language, 'services/delivery');
		$this->view->generate('delivery_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_mounting($language, $text){
		$data = Model::get_data($language, 'services/mounting');
		$this->view->generate('mounting_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_warranty($language, $text){
		$data = Model::get_data($language, 'services/warranty');
		$this->view->generate('warranty_view.php', 'template_view.php', $language, $text, $data);
	}
}