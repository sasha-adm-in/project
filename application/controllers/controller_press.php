<?php

class Controller_press extends Controller{
	
	function action_index($language, $text){
		$data = Model::get_data($language, 'press');
		$this->view->generate('press_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_news($language, $text){
		$data = Model::get_data($language, 'press/news');
		$this->view->generate('news_view.php', 'template_view.php', $language, $text, $data);
	}	
	function action_topnews($language, $text){
		$data = Model::get_data($language, 'press/topnews');
		$this->view->generate('topnews_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_topnews2($language, $text){
		$data = Model::get_data($language, 'press/topnews2');
		$this->view->generate('topnews_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_art($language, $text){
		$data = Model::get_data($language, 'press/art');
		$this->view->generate('art_view.php', 'template_view.php', $language, $text, $data);
	}
	
	
	
	
	
	
	function action_art1($language, $text){
		$data = Model::get_data($language, 'press/art1');
		$this->view->generate('art1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_art2($language, $text){
		$data = Model::get_data($language, 'press/art2');
		$this->view->generate('art1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_art3($language, $text){
		$data = Model::get_data($language, 'press/art3');
		$this->view->generate('art1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_art4($language, $text){
		$data = Model::get_data($language, 'press/art4');
		$this->view->generate('art1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_art5($language, $text){
		$data = Model::get_data($language, 'press/art5');
		$this->view->generate('art1_view.php', 'template_view.php', $language, $text, $data);
	}
	function action_art6($language, $text){
		$data = Model::get_data($language, 'press/art6');
		$this->view->generate('art6_view.php', 'template_view.php', $language, $text, $data);
	}
}