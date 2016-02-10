<?php

$db_host = 'localhost';
$db_user = 'root';
$db_password = '';
$db_name = 'shanam_site';	

if(isset($_POST['key'])) $id = $_POST['key'];
if(isset($_POST['view'])) $public = $_POST['view'];

$connect = mysql_connect($db_host, $db_user, $db_password);
mysql_query("SET NAMES utf8");
mysql_select_db($db_name, $connect);
if($public == 0) $query = "UPDATE comments SET public = 1 WHERE id = '".$id."'";
if($public == 1) $query = "UPDATE comments SET public = 0 WHERE id = '".$id."'";
mysql_query($query, $connect);



$query2 = "SELECT * FROM `comments` WHERE `public` = '1' ORDER BY id";
$data1 = mysql_query($query2, $connect);
while($array_comments_all = mysql_fetch_assoc($data1)){
	$data["qq"][] = $array_comments_all;
}	

$query3 = "SELECT * FROM `comments` WHERE `public` = '0' ORDER BY id";
$data2 = mysql_query($query3, $connect);
while($array_comments = mysql_fetch_assoc($data2)){
	$data["qqq"][] = $array_comments;
}

	
echo json_encode($data);	