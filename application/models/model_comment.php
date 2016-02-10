<?php

class model_comment extends Model{

	public function rpHash($value) {
		$hash = 5381;
		$value = strtoupper($value);
		for($i = 0; $i < strlen($value); $i++) {
			$hash = (($hash << 5) + $hash) + ord(substr($value, $i));
		}
		return $hash;
	}
	
	
	
	
public function comment(){

  $to = 'sasha_yaremko@mail.ru';
  $from = 'site'; // поменять на свой адрес
  $subject = 'Новый отзыв';
  $boundary = md5(date('r', time()));
  $filesize = '';  
  $headers  = "MIME-Version: 1.0\r\n"; 
  $headers .= "From: " . $from . "\r\n";
//  $headers .= "Reply-To: " . $from . "\r\n";
  $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";  
  $message="
Content-Type: multipart/mixed; boundary=\"$boundary\"

--$boundary
Content-Type: text/html; charset=\"utf-8\"
Content-Transfer-Encoding: 7bit

$message";
  for($i=0;$i<count($_FILES['fileFF']['name']);$i++) {
      if(is_uploaded_file($_FILES['fileFF']['tmp_name'][$i])) {
         $attachment = chunk_split(base64_encode(file_get_contents($_FILES['fileFF']['tmp_name'][$i])));
         $filename = $_FILES['fileFF']['name'][$i];
         $filetype = $_FILES['fileFF']['type'][$i];
         $filesize .= $_FILES['fileFF']['size'][$i];
         $message.="

--$boundary
Content-Type: \"$filetype\"; name=\"$filename\"
Content-Transfer-Encoding: base64
Content-Disposition: attachment; filename=\"$filename\"

$attachment";
     }
   }
      $message.="На сайте появился новый отзыв ожидающий подтверждения";
   $message.="
--$boundary--";

 
    mail($to, $subject, $message, $headers);
		
	
  
}

	public function all_comments(){
		$connect = $this->DataBaseConnect();
		$query = "SELECT * FROM `comments` WHERE `public` = '1' ORDER BY id DESC";		
		$data = mysql_query($query, $connect ) or die(mysql_error());
		while($array_comments_all = mysql_fetch_assoc($data)){
			$result[] = $array_comments_all;
		}		
		return $result;	
	}
	public function nopublic_comments(){
		$connect = $this->DataBaseConnect();
		$query = "SELECT * FROM `comments` WHERE `public` = '0' ORDER BY id DESC";		
		$data = mysql_query($query, $connect ) or die(mysql_error());
		while($array_comments_all = mysql_fetch_assoc($data)){
			$result[] = $array_comments_all;
		}		
		return $result;	
	}

	public function new_comment($name, $email = null, $comment){
		$connect = $this->DataBaseConnect();
		$date = date('d.m.Y');
		$query = "INSERT INTO comments SET name='".$name."', email='".$email."', comment='".$comment."', date='".$date."'";
		$data = mysql_query($query, $connect ) or die(mysql_error());
		if($data){
			$this->comment();
			echo "<script>alert('Ваш отзыв принят на проверку');</script>";
		}else echo "<script>alert('Ошибка добавления отзыва');</script>";		
	}
}