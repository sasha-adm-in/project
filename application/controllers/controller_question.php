<?php

class Controller_question extends Controller{
	function __construct()
    {
        $this->model = new model_question();
        $this->view = new View();		
    }
	
	function action_index($language, $text){
		if(isset($_POST['ask_question'])){
			if(!empty($_POST['question']) && !empty($_POST['tel']) && !empty($_POST['mail'])){		
				if(!empty($_POST['name'])){
					$name=$_POST['name'];
				}else $name="Аноним";
				$this->model->question($name, $_POST['tel'], $_POST['mail'], $_POST['question']);
			}else{
				echo '<p style="color:#ff0f0f;">Вы не заполнили обязательные поля</p>';	
			}
		}
		
		
		//$data = Model::get_data($language, 'question');	
		$this->view->generate('main_view.php', 'template_view.php', $language, $text, $data);
	}
}