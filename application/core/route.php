<?php
class Route
{
    static function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';
        
        $routes = explode('/', $_SERVER['REQUEST_URI']);
		
		$language = $routes[1];

        // получаем имя контроллера
        if ( !empty($routes[2]) )
        {	
            $controller_name = $routes[2];
        }
        
        // получаем имя экшена
        if ( !empty($routes[3]) )
        {
            $action_name = $routes[3];
        }
		
		// получаем аргумент
        if ( !empty($routes[4]) )
        {
            $id = $routes[4];
        }

		
		
		
		if(isset($_POST['submit']) && !empty($_POST['login']) && !empty($_POST['pass'])){
			$login = $_POST['login'];
			$pass = $_POST['pass'];
			$log_in = new Model;
			$log_in->log_in($login, $pass);
		}
		

        // добавляем префиксы
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;

        // подцепляем файл с классом модели (файла модели может и не быть)

        $model_file = strtolower($model_name).'.php';
        $model_path = "application/models/".$model_file;
        if(file_exists($model_path))
        {
            include "application/models/".$model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "application/controllers/".$controller_file;
        }
        else
        {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Route::ErrorPage404();
        }
		
		$model_language = new Model;
		$text = $model_language->language($language);


		
		
        
        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;
        
        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            $controller->$action($language, $text, $id);
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }
    
    }
    
    function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        //header('HTTP/1.1 404 Not Found');
        //header("Status: 404 Not Found");
        header('Location:'.$host);
    }
}