<?php

class Model{
	public function DataBaseConnect() {
		$db_host = 'localhost';
		$db_user = 'root';
		$db_password = '';
		$db_name = 'shanam_site';	
		
		$connect = mysql_connect($db_host, $db_user, $db_password) or die(mysql_error());
		mysql_query("SET NAMES utf8");
		mysql_select_db($db_name, $connect) or die(mysql_error());
		return $connect;
	}
	
	public function language($language){
		$connect = Model::DataBaseConnect();
		$get_language_query = "SELECT * FROM ".$language." WHERE controller = 'template'";
		$get_language_data = mysql_query($get_language_query, $connect ) or die(mysql_error());

		while($array_user_all = mysql_fetch_assoc($get_language_data)){
			$result[] = $array_user_all;
		}
		
		return $result;
	}
	
	public function log_in($login, $pass){
		$connect = Model::DataBaseConnect();
		$date = date('d.m.Y');
		$get_user_query = "SELECT * FROM users WHERE login = '" . $login . "' AND password = '" . $pass . "'";
		$get_user_data = mysql_query($get_user_query, $connect ) or die(mysql_error());
		$array_user_all = mysql_fetch_assoc($get_user_data);
		if($array_user_all){
			$query = "UPDATE users SET date='".$date."' WHERE id = '".$array_user_all['id']."'";
			mysql_query($query, $connect ) or die(mysql_error());
		}		
		if($array_user_all['access'] == 'on'){
			$_SESSION['login'] = $array_user_all['name'];					
		}
	}
	
	
	
	
	
	public function get_data($language, $controller){
		$connect = Model::DataBaseConnect();
	$get_language_query = "SELECT * FROM {$language} WHERE `controller` = '" . $controller . "'";
		$get_language_data = mysql_query($get_language_query, $connect ) or die(mysql_error());
		while($array_user_all = mysql_fetch_assoc($get_language_data)){
			$result[] = $array_user_all;
		}
		
		return $result;
	}
}