<?php
class ControllerModuleViewed extends Controller {
	protected function index($setting) {
    
        $viewed_products = array();
        
        if (isset($this->request->cookie['viewed'])) {
            $viewed_products = explode(',', $this->request->cookie['viewed']);
        } else if (isset($this->session->data['viewed'])) {
      		$viewed_products = $this->session->data['viewed'];
    	}
        
        if (isset($this->request->get['route']) && $this->request->get['route'] == 'product/product') {
            
            $product_id = $this->request->get['product_id'];   
               
            $viewed_products = array_diff($viewed_products, array($product_id));
            
            array_unshift($viewed_products, $product_id);
            
            setcookie('viewed', implode(',',$viewed_products), time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
        
            if (!isset($this->session->data['viewed']) || $this->session->data['viewed'] != $viewed_products) {
          		$this->session->data['viewed'] = $viewed_products;
        	}
        } 
        
        $show_on_product = $this->config->get('show_on_product');
        
        if (isset($this->request->get['route']) && $this->request->get['route'] == 'product/product' && (!isset($show_on_product) || !$show_on_product)) {
            return;
        }
        
        $viewed_count = $this->config->get('viewed_count');
        
        $products = array();
            
        if (isset($viewed_count) && $viewed_count > 0) {
            for ($i = 0; $i < $viewed_count; $i++) {
            
                $key = isset($product_id) ? $i + 1 : $i;
                
                if (isset($viewed_products[$key])) {
                    $products[] = $viewed_products[$key];
                }
            }
        }
        
        
		$this->language->load('module/viewed'); 

      	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['button_cart'] = $this->language->get('button_cart');
		
        //add-----------------------
		
		$this->data['text_viewed_title'] = $this->language->get('text_viewed_title');
		$this->data['text_viewed_otzuv'] = $this->language->get('text_viewed_otzuv');
		$this->data['text_viewed_kilk'] = $this->language->get('text_viewed_kilk');
		$this->data['text_viewed_cur'] = $this->language->get('text_viewed_cur');
		$this->data['text_viewed_buy'] = $this->language->get('text_viewed_buy');
		$this->data['text_viewed_akcimg'] = $this->language->get('text_viewed_akcimg');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		
		//add-----------------------
		
		
		$this->load->model('catalog/product'); 
		
		$this->load->model('tool/image');

		$this->data['products'] = array();

		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);
			
			if ($product_info) {
				if ($product_info['image'] && file_exists(DIR_IMAGE.$product_info['image'])) {
					$image = $this->model_tool_image->resize($product_info['image'], $setting['image_width'], $setting['image_height']);
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', $setting['image_width'], $setting['image_height']);;
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->tax->calculate(number_format(round($product_info['price'], 2), 2, '.', ''), $product_info['tax_class_id'], $this->config->get('config_tax'));
                    $price = str_replace($this->language->get('text_viewed_cur'),"",$price);
				} else {
					$price = false;
				}

				if ((float)$product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                    $special = str_replace($this->language->get('text_viewed_cur'),"",$special);
				} else {
					$special = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $product_info['rating'];
				} else {
					$rating = false;
				}

                $compare_link = '<a href="javascript:;" onclick="addToCompare(\''.$product_id.'\', this);">' . $this->language->get('text_addtocompare') . '</a>';

				$pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }

				
                if (isset($this->session->data['compare'])) {
                    foreach ($this->session->data['compare'] as $prod_id) {
                        if ($prod_id == $product_id) {
                            $compare_link = '<a href="' . $pref_lang . '/compare-products/">' . $this->language->get('text_intocompare') . '</a>';
                            break;
                        }
                    }
                }
					
				$this->data['products'][] = array(
					'product_id' => $product_info['product_id'],
					'thumb'   	 => $image,
                    'compare_link' => $compare_link,
					'name'    	 => $product_info['name'],
					'price'   	 => $price,
					'special' 	 => $special,
					'rating'     => $rating,
					'reviews'    => sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']),
					'href'    	 => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
				);
			}
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/viewed.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/viewed.tpl';
		} else {
			$this->template = 'default/template/module/viewed.tpl';
		}

		$this->render();
	}
}
?>