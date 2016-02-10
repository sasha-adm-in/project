<?php

class Model_Main extends Model
{

	public function view_description(){
		$connect = $this->DataBaseConnect();			
		$insert_user_query = "SELECT * FROM file_desc";
		$insert_user_data = mysql_query($insert_user_query, $connect ) or die(mysql_error());
		while($array_user_all = mysql_fetch_assoc($insert_user_data)){
			$result[] = $array_user_all;
		}
		
		return $result;		
	}
	
	public function delete_file($file){
		$connect = $this->DataBaseConnect();			
		$insert_user_query = "DELETE FROM file_desc WHERE file_name = '" . $file . "'";
		if($insert_user_data = mysql_query($insert_user_query, $connect ) or die(mysql_error()))
		return true;
	}
	public function update_file($file, $description){
		$connect = $this->DataBaseConnect();			
		$insert_user_query = "UPDATE file_desc SET file_description='".$description."' WHERE file_name = '".$file."'";
		if($insert_user_data = mysql_query($insert_user_query, $connect ) or die(mysql_error()))
		return true;
	}
		public function action_upload($files, $post){
		if($files['file']['error'] == 0){
			if($files['file']['filesize'] < 32000000){
				$filep = $files['file']['tmp_name']; 
				$ftp_server = 'ftp.shana-m.com.ua';
				$ftp_user_name = 'shanam';
				$ftp_user_pass = 'gf0v1oV0P'; 
				$paths = '/domains/shana-m.com.ua/public_html/download';
				$ftp_port= 21;
				// имя файла на сервере после того, как вы его загрузите
				$name = str_replace(" ","_",$files['file']['name']);	
				$conn_id = ftp_connect($ftp_server,$ftp_port);
				// входим при помощи логина и пароля
				if($conn_id){
					$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
				}
				// проверяем подключение
				if ((!$conn_id) || (!$login_result)) {
					echo "FTP connection has failed!";
					echo "Attempted to connect to $ftp_server for user: $ftp_user_name";
				exit;
				}
				$path=$paths.'/'.$name;

				// загружаем файл

				if($upload = ftp_put($conn_id, $path, $filep, FTP_BINARY)){
					$description = $post['description'];
					$connect = $this->DataBaseConnect();
					$insert_user_query = "INSERT INTO file_desc SET file_name= '" . $name . "' , file_description='" . $description . "'";
					$insert_user_data = mysql_query($insert_user_query, $connect ) or die(mysql_error());			
				//echo "Файл загружен";
				}//else echo "Ошибка загрузки файла";
				// проверяем статус загрузки
				if (!$upload) {
				echo "Error: FTP upload has failed!";
				} else{
				//echo "Файл загружен";
				}
				ftp_close($conn_id);
				set_time_limit(50);
			}else echo "Слишком большой файл";
		}else header( "Refresh: 0; url=".$_SERVER['HTTP_REFERER']."" );
	}
	
	
	
	
	
	public function all_users($data_id = null){
		$connect = $this->DataBaseConnect();
		
		if(!empty($_POST['search'])) $search_name = $_POST['search'];
		if(isset($_POST['yes_butt'])) $yes_butt = $_POST['yes_butt'];
		if(isset($_POST['no_butt'])) $no_butt = $_POST['no_butt'];
		
		
		if(!empty($data_id)){
			$to = implode(", ", $data_id);
			$insert_user_query = "SELECT * FROM users WHERE id IN(".$to.")";
		}
		elseif(!empty($search_name)) $insert_user_query = 
		
		"SELECT * FROM users WHERE LOWER(surname) LIKE '%$search_name%' OR LOWER(name) LIKE '%$search_name%' OR LOWER(secondname) LIKE '%$search_name%' OR LOWER(tel) LIKE '%$search_name%' OR LOWER(address) LIKE '%$search_name%' OR LOWER(login) LIKE '%$search_name%' OR LOWER(date) LIKE '%$search_name%' ORDER BY surname";
		elseif(!empty($yes_butt)) $insert_user_query = "SELECT * FROM users WHERE shana = 1  ORDER BY surname";
		elseif(!empty($no_butt)) $insert_user_query = "SELECT * FROM users WHERE shana = 0  ORDER BY surname";
		else $insert_user_query = "SELECT * FROM users ORDER BY surname";
		
		$insert_user_data = mysql_query($insert_user_query, $connect ) or die(mysql_error());
		while($array_user_all = mysql_fetch_assoc($insert_user_data)){
			$result[] = $array_user_all;
		}
		
		return $result;	
	}
	public function insert_user($access, $surname, $name, $secondname, $tel, $address, $login, $shana){
		$password = $this->PasswordGenerator();
		$connect = $this->DataBaseConnect();
		$insert_user_query = "INSERT INTO users SET access='".$access."', surname='".$surname."', name='".$name."', secondname='".$secondname."', tel='".$tel."', address='".$address."', login='".$login."', password='".$password."', shana='".$shana."'";
		$insert_user_data = mysql_query($insert_user_query, $connect ) or die(mysql_error());
		return $insert_user_data;
	}
	public function view_user($id){
		$connect = $this->DataBaseConnect();
		$insert_user_query = "SELECT * FROM users WHERE id = '".$id."'";
		$insert_user_data = mysql_query($insert_user_query, $connect ) or die(mysql_error());
		$array_product_all = mysql_fetch_assoc($insert_user_data);
		return $array_product_all;
	}
	public function update_user($id, $access, $surname, $name, $secondname, $tel, $address, $login, $shana){
		$connect = $this->DataBaseConnect();
		$insert_user_query = "UPDATE users SET access='".$access."', surname='".$surname."', name='".$name."', secondname='".$secondname."', tel='".$tel."', address='".$address."', login='".$login."', shana='".$shana."' WHERE id = '".$id."'";
		$insert_user_data = mysql_query($insert_user_query, $connect ) or die(mysql_error());			
		return $insert_user_data;
	}	
	public function PasswordGenerator($length = 7) {
		$alpha = "abcdefghijklmnopqrstuvwxyz";
		//$alpha_upper = strtoupper($alpha);
		$numeric = "0123456789";
		$chars = "";
		$chars = $alpha . $numeric;
		$chars = str_shuffle($chars);
		$len = strlen($chars);
		$pw = '';
		
		for ($i=0;$i<$length;$i++)
			$pw .= substr($chars, rand(0, $len-1), 1);
		
		// the finished password
		$pw = str_shuffle($pw);
		
		return $pw;
	}
	
	
	
	
	
	
	public function search($search, $language){
		$connect = $this->DataBaseConnect();
		$search = strtolower($search);
		$query = "SELECT title, controller FROM ".$language." WHERE LOWER(title) LIKE '%".$search."%' OR LOWER(text) LIKE '%".$search."%'";
		$array_product_all = mysql_query($query, $connect ) or die(mysql_error());

		while($array_user_all = mysql_fetch_assoc($array_product_all)){
			$result[] = $array_user_all;
		}
		return $result;
	}

	
	
	
	
	
	
	
	
	
	
	
	
			public function mail_go(){
			if (isset ($_POST['contactFF'])) {
  $to = $_POST['contactFF'];
  $from = 'shana-m@z.ua'; // поменять на свой адрес
  $subject = $_POST['subjectFF'];
  $message = $_POST['messageFF'];
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
   $message.="
--$boundary--";

  if ($filesize < 20000000) { // проверка на общий размер всех файлов. Многие почтовые сервисы не принимают вложения больше 10 МБ
    if(mail($to, $subject, $message, $headers)){
		$output = "Ваше сообщение отправлено!";
	}else $outpu = "Ошибка отправки сообщения";
  } else {
    $output = '<script>alert("Извините, письмо не отправлено. Размер всех файлов превышает 10 МБ.");</script>';
  }
  unset($_POST['contactFF']);
}
return $output;
		}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    public function get_data(){
		
    }
	
}