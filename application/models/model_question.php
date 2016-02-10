<?php

class model_question extends Model
{

	public function rpHash($value) {
		$hash = 5381;
		$value = strtoupper($value);
		for($i = 0; $i < strlen($value); $i++) {
			$hash = (($hash << 5) + $hash) + ord(substr($value, $i));
		}
		return $hash;
	}
	
	
	
	
public function question($name, $tel, $mail, $question){

  $to = 'sasha_yaremko@mail.ru';
  $from = $mail; // поменять на свой адрес
  $subject = 'Вопрос для профессионала';
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
		Информация о потенциальном заказчике:<br/>
		Имя - ".$name."<br/>
		Телефон - ".$tel."<br/>
		Email - ".$mail."<br/>
		Вопрос - ".$question."<br/>";
   $message.="
--$boundary--";

  if ($filesize < 20000000) { // проверка на общий размер всех файлов. Многие почтовые сервисы не принимают вложения больше 10 МБ
    if(mail($to, $subject, $message, $headers)){
		echo "
			<script>
				alert('Ваша заявка отправлена');
			</script>
			";	
	}else echo "
			<script>
				alert('Ошибка отправки заявки');
			</script>
			";
  } else {
    echo "
			<script>
				alert('Ошибка отправки заявки');
			</script>
			";
  }
}



}