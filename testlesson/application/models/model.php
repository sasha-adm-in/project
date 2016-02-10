<?php

class Model{	
	//подключение БД
	public function DataBaseConnect() {
		$db_host = 'localhost';
		$db_user = 'root';
		$db_password = '';
		$db_name = 'test';	
		$charset = 'utf8';
		
		
		
		$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$charset";
		$opt = array(
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		);
		$pdo = new PDO($dsn, $db_user, $db_password, $opt);
		if ($pdo) {
			return $pdo;
		}
	}	
		
		
		
		
		
		
		/* $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
		$mysqli->query("SET NAMES 'utf8'");
		if ($mysqli->connect_error) {
			die('Ошибка подключения (' . $mysqli->connect_errno . ') '
				. $mysqli->connect_error);
		}
		else return $mysqli;		
		
		
		
		$connect = @mysql_connect($db_host, $db_user, $db_password) or die(mysql_error());
		mysql_query("SET NAMES utf8");
		mysql_select_db($db_name, $connect) or die(mysql_error()); 
		return $connect; */
	
	//авторизация пользователей
	public function login($mail, $pass){
		$connect = $this->DataBaseConnect();
		$stmt = $connect->prepare("SELECT * FROM users WHERE `mail` = ? AND `pass` = ?");
		$stmt->execute(array($mail, $pass));
		
		if($profile = $stmt->fetch(PDO::FETCH_LAZY)){						
			$_SESSION['profile'] = $profile;			
			return true;
		}else return false;
	}	
	//регистрация пользователя
	public function insert_user($surname, $name, $secondname, $birthday, $birthmonth, $birthyear, $sex, $adress, $tel, $mail, $pass, $file){
		$connect = $this->DataBaseConnect();
		$file_name = $mail."_".$file['file']['name'];
		$insert_user_query = "INSERT INTO users SET surname='".$surname."', name='".$name."', secondname='".$secondname."', birthday='".$birthday."', birthmonth='".$birthmonth."', birthyear='".$birthyear."', sex='".$sex."', adress='".$adress."', tel='".$tel."', mail='".$mail."', pass='".$pass."', file='".$file_name."'";
		$insert_user_data = mysql_query($insert_user_query, $connect );
		if($insert_user_data){			
			return true;
		}else{
			return false;
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
				if(move_uploaded_file($filename, $path.$mail."_".$file['file']['name'])) return true;
			}
		}
	}
	//выход пользователя
	public function destroy(){
		unset($_SESSION['profile']);
	}
}