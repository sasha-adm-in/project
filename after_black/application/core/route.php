<?php
class Route
{
    static function start(){
        //действие по умолчанию		
        $action = 'index';
		
		//название хоста
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		
		//разбор строки запроса
        $routes = explode('/', $_SERVER['REQUEST_URI']);
		
		//получаем язык
		$language = $routes[1];
		
        // получаем имя экшена
        if(!empty($routes[2])){
            $action = $routes[2];
        }
		
        // создаем контроллер
        $controller = new Controller;    
		
        // вызываем действие контроллера
        if(method_exists($controller, $action)){            
            $controller->$action($language);
        }else{
            header('Location:'.$host);           
        }    
    }
}