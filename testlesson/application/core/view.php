<?php
class View{		//генерация и запуск вида
	function generate($content_view, $template_view, $language, $message=null){		include 'application/views/'.$template_view;
	}
}