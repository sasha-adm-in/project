<?php

class Model{	
	//подключение БД
	public function DataBaseConnect() {
		$db_host = 'localhost';
		$db_user = 'root';
		$db_password = '';
		$db_name = 'test';	
		$charset = 	'utf8';
		
		try{
			$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$charset";
			$opt = array(
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			);
			$pdo = new PDO($dsn, $db_user, $db_password, $opt);
			return $pdo;
		}catch(Exception $e){
			return false;
		}
	}
	
	//авторизация пользователей
	public function login($mail, $pass){
		if($connect = $this->DataBaseConnect()){
			$stmt = $connect->prepare("SELECT * FROM `users` WHERE `mail` = ? AND `pass` = ? LIMIT 1");
			$stmt->execute(array($mail, $pass));
			
			if($profile = $stmt->fetch(PDO::FETCH_ASSOC)){
				return $this->stripslashes($profile);
			}
		}
	}

	//удаление экранирования данных
	public function stripslashes($value){
    	$value = is_array($value) ?
	        array_map('stripslashes', $value) :
	        stripslashes($value);
    	return $_SESSION['profile'] = $value;
	}

	//регистрация пользователя
	public function insert_user($user_data){
		if($connect = $this->DataBaseConnect()){
			$stmt = $connect->prepare("INSERT INTO `users` SET `surname`=?, `name`=?, `secondname`=?, `birthday`=?, `birthmonth`=?, `birthyear`=?, `sex`=?, `adress`=?, `tel`=?, `mail`=?, `pass`=?, `file`=?");
			try{
				return $stmt->execute($user_data);
			}catch(Exception $e){
		 		return false;
			}
		}
		
	}

	//загрузка файла
	public function insert_photo($file, $mail){
		$valid_types = array("gif", "jpg", "png");
		if (is_uploaded_file($file['file']['tmp_name'])){
			$filename = $file['file']['tmp_name'];
			$ext = substr($file['file']['name'], 1 + strrpos($file['file']['name'], "."));
			if(in_array($ext, $valid_types)){
				$path = '/home/localhost/www/files/';
				//$path = '/var/www/html/files/';
				try{
					return @move_uploaded_file($filename, $path.$mail."_".$file['file']['name']);
				}catch(Exception $e){
					return false;
				}
			}
		}
	}

	//выход пользователя
	public function destroy(){
		unset($_SESSION['profile']);
	}
}