<?php
class ModelCheckoutNovaPoshta extends Model 
{
    private $key = '127b617852634587f3f02ac00300c52e';
    private $parseUrl = "http://orders.novaposhta.ua/xml.php";
    private $regions = array();
    private $cities = array();
    
    public function getRegions($defaultRegion = 'АРК') {
        $data_regions = '
            <?xml version="1.0" encoding="utf-8"?>
            <file>
                <auth>'.$this->key.'</auth>
                <city/>
            </file>
        ';
 
        $context_regions = stream_context_create(
            array(
                'http'=>array(
                    'header' => "Content-Type: text/xml",
                    'method' => 'POST',
                    'content' => $data_regions                
                )
            )
        );
        
        $defaultRegion = str_replace(' область', '', $defaultRegion);
         
        $contents_regions = file_get_contents($this->parseUrl, false, $context_regions);
        
        $response_obj_regions = simplexml_load_string($contents_regions);
        
        foreach($response_obj_regions->result->cities->city as $city) {
            if((string)$city->areaNameUkr == $defaultRegion) {
                $this->cities[] = (string)$city->nameUkr;
            }
            
            if (in_array((string)$city->areaNameUkr, $this->regions)) continue;
            $this->regions[] = (string)$city->areaNameUkr; 
        }
        
        $regions = array();
        
        setlocale(LC_ALL, 'uk_UA.utf8');
        
        if (asort($this->regions, SORT_LOCALE_STRING)) {
            foreach($this->regions as $region) {
                if ($region != 'АРК') {
                    $regions[] = $region.' область';
                } else {
                    $regions[] = $region;
                }
            }
        }
        
        return $regions;
    }
    
    public function getCities() {
        return $this->cities;
    }
    
    public function getWarenhouses($defaultWarenhouse = 'Алупка') {
        $warenhouses = array();
        
        $data_warenhouse = '
            <?xml version="1.0" encoding="utf-8"?>
            <file>
                <auth>'.$this->key.'</auth>
                <warenhouse/>
                <filter>'.$defaultWarenhouse.'</filter>
            </file>
        ';
        
        $context_warenhouse = stream_context_create(
            array(
                'http'=>array(
                    'header' => "Content-Type: text/xml",
                    'method' => 'POST',
                    'content' => $data_warenhouse                
                )
            )
        );
        
        $contents_warenhouses = file_get_contents($this->parseUrl, false, $context_warenhouse);
        
        $response_obj_warenhouses = simplexml_load_string($contents_warenhouses);
        
        foreach($response_obj_warenhouses->result->whs->warenhouse as $warenhouse) {
            $warenhouses[] = (string)$warenhouse->address; 
        }
        
        return $warenhouses;
    }
    
    public function getDeliveryCost($recipient, $mass, $height, $width, $depth, $price, $delivery_type, $delivery_quantity = 1, $redelivery = 0) {
        if ($redelivery) {
            $redev = '
                <additionalRedelivery>
                    <redeliveryPrice>'.$price.'</redeliveryPrice>
                    <redeliveryLoadTypeId>2</redeliveryLoadTypeId>
                </additionalRedelivery>
            ';
        } else {
            $redev = '';
        }

        $data = '
            <?xml version="1.0" encoding="utf-8"?>
            <file>
                <auth>'.$this->key.'</auth>
                <countPrice>
                    <senderCity>Вінниця</senderCity>
                    <recipientCity>'.$recipient.'</recipientCity>
                    <mass>'.$mass.'</mass>
                    <height>'.$height.'</height>
                    <width>'.$width.'</width>
                    <depth>'.$depth * $delivery_quantity.'</depth>
                    <publicPrice>'.$price.'</publicPrice>
                    <loadType_id>1</loadType_id>
                    <deliveryType_id>'.(int)$delivery_type.'</deliveryType_id>
                    <floor_count></floor_count>
                    <date>'.date('d.m.Y').'</date>'.$redev.'
                </countPrice>
            </file>
        ';

        //$this->log->write($data);
 
        $context = stream_context_create(
            array(
                'http'=>array(
                    'header' => "Content-Type: text/xml",
                    'method' => 'POST',
                    'content' => $data                
                )
            )
        );
         
        $delivery = file_get_contents($this->parseUrl, false, $context);
        
        $response_xml = simplexml_load_string($delivery);
        
        if (!isset($response_xml->cost)) {
            return false;
        }

        //$this->log->write($delivery);
        
        return $response_xml->cost;
    }
}
?>