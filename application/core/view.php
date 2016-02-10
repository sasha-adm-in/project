<?php

class View{
	
	function generate($content_view, $template_view, $language, $text=null, $data = null, $adir = null, $users = null, $view_user=null){
		
		if(is_array($data)){
			extract($data);
		}
		include 'application/views/'.$template_view;
	}
}