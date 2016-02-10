<?php
class SmsFly
{
    private $sms_url = "http://sms-fly.com/api/api.php";
    private $user = "380932044125";
    private $password = "13971397";
    private $rate = 120;
    private $livetime = 4;
    private $source = 'RES.UA'; // Alfaname
    
    public function sendToClient($phone = '380988348220', $order_id) {
        switch (strlen($order_id)) {
            case 1:
               $order_id = '00'.$order_id;
               break; 
            case 2:
               $order_id = '0'.$order_id;
               break;
        }
        
        $data = '
            <?xml version="1.0" encoding="utf-8"?>
            <request>
                <operation>SENDSMS</operation>
                <message start_time="AUTO" end_time="AUTO" livetime="'.$this->livetime.'" rate="'.$this->rate.'" desc="Замовлення успішно оформлено" source="'.$this->source.'">
                    <body>Дякуємо за замовлення №'.$order_id.'. Наш менеджер зв\'яжеться з Вами.</body> 
                    <recipient>'.str_replace('+', '', $phone).'</recipient>
                </message>
            </request>
        ';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERPWD , $this->user.':'.$this->password);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $this->sms_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml", "Accept: text/xml"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
    }
    
    public function sendToAdmin($phone, $order_id) {
        switch (strlen($order_id)) {
            case 1:
               $order_id = '00'.$order_id;
               break; 
            case 2:
               $order_id = '0'.$order_id;
               break;
        }
        
        $data = '
            <?xml version="1.0" encoding="utf-8"?>
            <request>
                <operation>SENDSMS</operation>
                <message start_time="AUTO" end_time="AUTO" livetime="'.$this->livetime.'" rate="'.$this->rate.'" desc="Нове замовлення на сайті RES.UA" source="'.$this->source.'">
                    <body>У Вас нове замовлення №'.$order_id.' на сайті RES.UA</body> 
                    <recipient>'.str_replace('+', '', $phone).'</recipient>
                </message>
            </request>
        ';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERPWD , $this->user.':'.$this->password);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $this->sms_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml", "Accept: text/xml"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
    } 
    
    public function sendToClientStatus($phone = '380988348220', $order_id, $order_status) {
        // выводить order_name R0307001 из базы, а не генерить на лету
        $data = '
            <?xml version="1.0" encoding="utf-8"?>
            <request>
                <operation>SENDSMS</operation>
                <message start_time="AUTO" end_time="AUTO" livetime="'.$this->livetime.'" rate="'.$this->rate.'" desc="Замовлення успішно оформлено" source="'.$this->source.'">
                    <body>Статус Вашого замовлення №'.$order_id.' змінено на '.$order_status.'.</body> 
                    <recipient>'.str_replace('+', '', $phone).'</recipient>
                </message>
            </request>
        ';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERPWD , $this->user.':'.$this->password);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $this->sms_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml", "Accept: text/xml"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}
?>