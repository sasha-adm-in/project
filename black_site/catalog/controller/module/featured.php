<?php
class ControllerModuleFeatured extends Controller {
	protected function index($setting) {
		$this->language->load('module/featured'); 

      	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['button_cart'] = $this->language->get('button_cart');
		
		$this->load->model('catalog/product'); 
		
		$this->load->model('tool/image');

		$this->data['products'] = array();

		$products = explode(',', $this->config->get('featured_product'));		

		if (empty($setting['limit'])) {
			$setting['limit'] = 5;
		}
		
		$products = array_slice($products, 0, (int)$setting['limit']);

	$this->language->load('module/featured');
		
        //add-----------------------
		
		$this->data['text_feature_title'] = $this->language->get('text_feature_title');
		$this->data['text_feature_vidg'] = $this->language->get('text_feature_vidg');
		$this->data['text_feature_number'] = $this->language->get('text_feature_number');
		$this->data['text_feature_cur'] = $this->language->get('text_feature_cur');
		$this->data['text_feature_btnbuy'] = $this->language->get('text_feature_btnbuy');
		$this->data['text_feature_akcimg'] = $this->language->get('text_feature_akcimg');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		
		//add-----------------------

		
		foreach ($products as $product_id) {
			$product_info = $this->model_catalog_product->getProduct($product_id);
			
			if ($product_info) {
				if ($product_info['image'] && file_exists(DIR_IMAGE.$product_info['image'])) {
					$image = $this->model_tool_image->resize($product_info['image'], $setting['image_width'], $setting['image_height']);
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', $setting['image_width'], $setting['image_height']);
				}

				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->tax->calculate(number_format(round($product_info['price'], 2), 2, '.', ''), $product_info['tax_class_id'], $this->config->get('config_tax'));
				} else {
					$price = false;
				}
						
				if ((float)$product_info['special']) {
					$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
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

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/featured.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/featured.tpl';
		} else {
			$this->template = 'default/template/module/featured.tpl';
		}

		$this->render();
	}
}
?>