<?php
class ControllerProductProduct extends Controller {
	private $error = array(); 
    
    public function getRegions() {
        $this->load->model('checkout/nova_poshta');	
        
        if (
            isset($this->request->post['region']) &&
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) 
        {
            $this->model_checkout_nova_poshta->getRegions($this->request->post['region']);
            $cities = $this->model_checkout_nova_poshta->getCities();
            
            exit(json_encode($cities));
        } elseif (
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) 
        {
            $regions = $this->model_checkout_nova_poshta->getRegions();
            exit(json_encode($regions));
        }
    }

	
	public function index() { 
		$this->language->load('product/product');

$this->document->setCurrent('product'); 	
$this->data['product_id'] = $product_info['product_id'];

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),			
			'separator' => false
		);
		
		$this->load->model('catalog/category');	
		
		if (isset($this->request->get['path'])) {
			$path = '';
			
			$parts = explode('_', (string)$this->request->get['path']);
            
            $category_ids = $parts;
			
			$category_id = (int)array_pop($parts);
				
			foreach ($parts as $path_id) {
				if (!$path) {
					$path = $path_id;
				} else {
					$path .= '_' . $path_id;
				}
				
				$category_info = $this->model_catalog_category->getCategory($path_id);
				
				if ($category_info) {
					$this->data['breadcrumbs'][] = array(
						'text'      => $category_info['name'],
						'href'      => $this->url->link('product/category', 'path=' . $path),
						'separator' => $this->language->get('text_separator')
					);
				}
			}
			
			// Set the last category breadcrumb
			$category_info = $this->model_catalog_category->getCategory($category_id);
				
			if ($category_info) {			
				$url = '';
				
				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}	
	
				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}	
				
				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}
				
				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}
										
				$this->data['breadcrumbs'][] = array(
					'text'      => $category_info['name'],
					'href'      => $this->url->link('product/category', 'path=' . $this->request->get['path']),
					'separator' => $this->language->get('text_separator')
				);
			}
		}
		
		$this->load->model('catalog/manufacturer');	        
		
		if (isset($this->request->get['manufacturer_id'])) {
			$this->data['breadcrumbs'][] = array( 
				'text'      => $this->language->get('text_brand'),
				'href'      => $this->url->link('product/manufacturer'),
				'separator' => $this->language->get('text_separator')
			);	
	
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}	
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
							
			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

			if ($manufacturer_info) {	
				$this->data['breadcrumbs'][] = array(
					'text'	    => $manufacturer_info['name'],
					'href'	    => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url),					
					'separator' => $this->language->get('text_separator')
				);
			}
		}
		
		if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
			$url = '';
			
			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}
						
			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}
						
			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}
			
			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}	

			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
												
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_search'),
				'href'      => $this->url->link('product/search', $url),
				'separator' => $this->language->get('text_separator')
			); 	
		}
		
		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}
		
		$this->load->model('catalog/product');
        $this->load->model('checkout/nova_poshta');
		
		$product_info = $this->model_catalog_product->getProduct($product_id);        	
        
        if (
            isset($this->request->post['region']) &&
            isset($this->request->post['city']) &&
            isset($this->request->post['delivery_type']) &&
            isset($this->request->post['delivery_calc']) &&
            isset($this->request->post['delivery_quantity']) &&
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        ) 
        {
            $product_info = $this->model_catalog_product->getProduct((int)$this->request->post['product_id']);
            
            $cost = $this->model_checkout_nova_poshta->getDeliveryCost($this->request->post['city'], $product_info['weight'], $product_info['height'], $product_info['width'], $product_info['length'], $product_info['price'], $this->request->post['delivery_type'], $this->request->post['delivery_quantity']);
            
            exit(json_encode(array('cost' => $cost)));
        }
		
		if ($product_info) {
			$url = '';
			
			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}
						
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}
						
			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}			

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}
						
			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}
			
			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}	
						
			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}
			
			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}	
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}	
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
																		
			$this->data['breadcrumbs'][] = array(
				'text'      => $product_info['name'],
				'href'      => $this->url->link('product/product', $url . '&product_id=' . $this->request->get['product_id']),
				'separator' => $this->language->get('text_separator')
			);			
			
			if ($product_info['seo_title']) {
				$this->document->setTitle($product_info['seo_title']);
		$GLOBALS["seotitle25"] = 'ON';
			} else {
			    $this->document->setTitle($product_info['name']);
		$GLOBALS["seotitle25"] = '';
			}

			$this->document->setDescription($product_info['meta_description']);
			$this->document->setKeywords($product_info['meta_keyword']);
			$this->document->addLink($this->url->link('product/product', 'product_id=' . $this->request->get['product_id']), 'canonical');
			$this->document->addScript('catalog/view/javascript/jquery/tabs.js');
			$this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js');
			$this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');
			
			if ($product_info['seo_h1']) {
				$this->data['heading_title'] = $product_info['seo_h1'];
			} else {
			    $this->data['heading_title'] = $product_info['name'];
			}

			$this->data['text_select'] = $this->language->get('text_select');
			$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$this->data['text_model'] = $this->language->get('text_model');
			$this->data['text_reward'] = $this->language->get('text_reward');
			$this->data['text_points'] = $this->language->get('text_points');	
			$this->data['text_discount'] = $this->language->get('text_discount');
			$this->data['text_stock'] = $this->language->get('text_stock');
			$this->data['text_price'] = $this->language->get('text_price');
			$this->data['text_tax'] = $this->language->get('text_tax');
			$this->data['text_discount'] = $this->language->get('text_discount');
			$this->data['text_option'] = $this->language->get('text_option');
			$this->data['text_qty'] = $this->language->get('text_qty');
			$this->data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
			$this->data['text_or'] = $this->language->get('text_or');
			$this->data['text_write'] = $this->language->get('text_write');
			$this->data['text_note'] = $this->language->get('text_note');
			$this->data['text_share'] = $this->language->get('text_share');
			$this->data['text_wait'] = $this->language->get('text_wait');
			$this->data['text_tags'] = $this->language->get('text_tags');

		//add-----------------------
		
		$this->data['text_prod_alltov'] = $this->language->get('text_prod_alltov');
		$this->data['text_prod_code'] = $this->language->get('text_prod_code');
		$this->data['text_prod_akcija'] = $this->language->get('text_prod_akcija');
		$this->data['text_prod_buy'] = $this->language->get('text_prod_buy');
		$this->data['text_prod_val'] = $this->language->get('text_prod_val');
		$this->data['text_prod_akcdie'] = $this->language->get('text_prod_akcdie');
		$this->data['text_prod_akcend'] = $this->language->get('text_prod_akcend');
		$this->data['text_prod_week'] = $this->language->get('text_prod_week');
		$this->data['text_prod_day'] = $this->language->get('text_prod_day');
		$this->data['text_prod_hour'] = $this->language->get('text_prod_hour');
		$this->data['text_prod_min'] = $this->language->get('text_prod_min');
		$this->data['text_prod_sec'] = $this->language->get('text_prod_sec');
		$this->data['text_prod_kil'] = $this->language->get('text_prod_kil');
		$this->data['text_prod_zvjz'] = $this->language->get('text_prod_zvjz');
		$this->data['text_prod_cinytoch'] = $this->language->get('text_prod_cinytoch');
		$this->data['text_prod_available'] = $this->language->get('text_prod_available');
		$this->data['text_prod_podzakaz'] = $this->language->get('text_prod_podzakaz');
		$this->data['text_prod_rozrah'] = $this->language->get('text_prod_rozrah');
		$this->data['text_prod_rozrahh'] = $this->language->get('text_prod_rozrahh');
		$this->data['text_prod_gorod'] = $this->language->get('text_prod_gorod');
		$this->data['text_prod_tipysl'] = $this->language->get('text_prod_tipysl');
		$this->data['text_prod_tipysl1'] = $this->language->get('text_prod_tipysl1');
		$this->data['text_prod_tipysl2'] = $this->language->get('text_prod_tipysl2');
		$this->data['text_prod_tipysl3'] = $this->language->get('text_prod_tipysl3');
		$this->data['text_prod_tipysl4'] = $this->language->get('text_prod_tipysl4');
		$this->data['text_prod_kilk'] = $this->language->get('text_prod_kilk');
		$this->data['text_prod_summi'] = $this->language->get('text_prod_summi');
		$this->data['text_prod_share'] = $this->language->get('text_prod_share');
		$this->data['text_prod_soo'] = $this->language->get('text_prod_soo');
		$this->data['text_prod_opis'] = $this->language->get('text_prod_opis');
		$this->data['text_prod_xarak'] = $this->language->get('text_prod_xarak');
		$this->data['text_prod_otzuv'] = $this->language->get('text_prod_otzuv');
		$this->data['text_prod_otzuvv'] = $this->language->get('text_prod_otzuvv');
		$this->data['text_prod_otzuvov'] = $this->language->get('text_prod_otzuvov');
		$this->data['text_prod_napotzuv'] = $this->language->get('text_prod_napotzuv');
		$this->data['text_prod_rejt'] = $this->language->get('text_prod_rejt');
		$this->data['text_prod_name'] = $this->language->get('text_prod_name');
		$this->data['text_prod_text'] = $this->language->get('text_prod_text');
		$this->data['text_prod_captcha'] = $this->language->get('text_prod_captcha');
		$this->data['text_prod_sxojitov'] = $this->language->get('text_prod_sxojitov');
		$this->data['text_prod_vubobl'] = $this->language->get('text_prod_vubobl');
		$this->data['text_prod_vubgor'] = $this->language->get('text_prod_vubgor');
		$this->data['text_prod_totaldost'] = $this->language->get('text_prod_totaldost');
		$this->data['text_prod_akcimg'] = $this->language->get('text_prod_akcimg');
		$this->data['text_prod_dost'] = $this->language->get('text_prod_dost');
		$this->data['text_prod_oplata'] = $this->language->get('text_prod_oplata');
		$this->data['text_prod_gar'] = $this->language->get('text_prod_gar');
		$this->data['text_prod_dost_text'] = $this->language->get('text_prod_dost_text');
		$this->data['text_prod_oplata_text'] = $this->language->get('text_prod_oplata_text');
		$this->data['text_prod_gar_text'] = $this->language->get('text_prod_gar_text');
		$this->data['text_popup_dost'] = $this->language->get('text_popup_dost');
		$this->data['text_popup_opl'] = $this->language->get('text_popup_opl');
		$this->data['text_popup_gar'] = $this->language->get('text_popup_gar');
		$this->data['text_prod_term'] = $this->language->get('text_prod_term');
		$this->data['text_prod_review'] = $this->language->get('text_prod_review');
		$this->data['text_prod_iz'] = $this->language->get('text_prod_iz');
		$this->data['text_prod_naosn'] = $this->language->get('text_prod_naosn');
		$this->data['text_prod_ocenok'] = $this->language->get('text_prod_ocenok');
		$this->data['text_prod_otzuvov'] = $this->language->get('text_prod_otzuvov');

		//add-----------------------
			
			$this->data['entry_name'] = $this->language->get('entry_name');
			$this->data['entry_review'] = $this->language->get('entry_review');
			$this->data['entry_rating'] = $this->language->get('entry_rating');
			$this->data['entry_good'] = $this->language->get('entry_good');
			$this->data['entry_bad'] = $this->language->get('entry_bad');
			$this->data['entry_captcha'] = $this->language->get('entry_captcha');
			
			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_wishlist'] = $this->language->get('button_wishlist');
			$this->data['button_compare'] = $this->language->get('button_compare');			
			$this->data['button_upload'] = $this->language->get('button_upload');
			$this->data['button_continue'] = $this->language->get('button_continue');
			
			$this->load->model('catalog/review');

			$this->data['tab_description'] = $this->language->get('tab_description');
			$this->data['tab_attribute'] = $this->language->get('tab_attribute');
			$this->data['tab_review'] = sprintf($this->language->get('tab_review'), $product_info['reviews']);
			$this->data['tab_related'] = $this->language->get('tab_related');
			
			$this->data['product_id'] = $this->request->get['product_id'];
			$this->data['manufacturer'] = $product_info['manufacturer'];
			$this->data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
			$this->data['model'] = $product_info['model'];
			$this->data['reward'] = $product_info['reward'];
			$this->data['points'] = $product_info['points'];
			$this->data['upc'] = $product_info['upc'];
			$this->data['sku'] = $product_info['sku'];
	$GLOBALS["sku23"] = $product_info['sku'];
            $this->data['unit'] = $product_info['unit'];
            
            /**
             *   ������� ������ �������������� � �������� ������
             */
            
            if (isset($this->request->get['path'])) {
                $category_names = array();
                
                foreach ($category_ids as $cat_id) {
                    $cat = $this->model_catalog_category->getCategory($cat_id);
                    
                    $category_names[$cat_id] = $cat['name'];
                }
                
                foreach ($category_names as $id => $category_name) {                    
                    if (mb_strtolower($category_name, 'UTF-8') == mb_strtolower($product_info['manufacturer'], 'UTF-8')) {
                        
                        /**
                         *  $main_cat_id   - id родителя категории, имя которой совпадает с производителем
                         *  $manufacturer_category_id - id категории, имя которой совпадает с производителем
                         *  $manufacturer_category_name - имя категории, имя которой совпадает с производителем
                         *  $main_cat_name - имя родителя категории, имя которой совпадает с производителем
                         */
                         
                        $main_cat_id = $this->model_catalog_category->getCategoryParentId($id);

                        //$manufacturer_category_id = $id;
                        //$manufacturer_category_name = $this->model_catalog_category->getCategoryName($id);

                        $main_cat_name = $this->model_catalog_category->getCategoryName($main_cat_id);
                        
                        break;
                    }
                }
                
                if (isset($main_cat_id)) {
                    $manufacturers = $this->model_catalog_category->getCategoryManufacturers($main_cat_id);

                    $children_categories = $this->model_catalog_category->getCategories($main_cat_id);

                    $categories = array();

                    foreach ($children_categories as $category) {
                        $categories[] = array(
                            'name' => $category['name'],
                            'category_id' => $category['category_id']
                        );
                    }

                    $final_manufacturers = array();
                    
                    foreach ($manufacturers as $manufacturer) {
                        if (!$manufacturer['manuf_name']) continue;
                        
                        if (!array_key_exists($manufacturer['manuf_name'], $final_manufacturers)) {
                            $final_manufacturers[$manufacturer['manuf_name']] = array();

                            foreach ($categories as $category) {
                                if (mb_strtolower($category['name'], 'UTF-8') == mb_strtolower($manufacturer['manuf_name'], 'UTF-8')) {
                                    $main_cat_id = $category['category_id'];
                                }
                            }

                            $final_manufacturers[$manufacturer['manuf_name']]['category'] = array(
                                'name' => $main_cat_name,
                                'href' => $this->url->link('product/category', 'path=' . $main_cat_id),
                            );
                        }
                        
                        $final_manufacturers[$manufacturer['manuf_name']]['products'][] = array(
                            'href' => $this->url->link('product/product', 'product_id=' . $manufacturer['product_id']),
                            'name' => $manufacturer['product_name']
                        );
                    }
                    
                    $this->data['manufacturers_left'] = $final_manufacturers;
                } else {
                    $this->data['products_left'] = array();

                    $cat_name = $this->model_catalog_category->getCategoryName($category_id);

                    $this->data['products_left']['category'] = array(
                        'name' => $cat_name,
                        'href' => $this->url->link('product/category', 'path=' . $category_id),
                    );

                    $data = array(
                        'filter_category_id' => $category_id,
                        'filter_filter'      => '',
                        'sort'               => 'p.sort_order',
                        'order'              => 'ASC'
                    );

                    $results = $this->model_catalog_product->getProducts($data);

                    foreach ($results as $result) {
                        $this->data['products_left']['products'][] = array(
                            'name'        => $result['name'],
                            'href'        => $this->url->link('product/product', 'path=' . $this->request->get['path'] . '&product_id=' . $result['product_id'] . $url)
                        );
                    }
                }
            }

            $this->data['compare_link'] = '<a href="javascript:;" onclick="addToCompare(\''.$product_id.'\', this);">' . $this->language->get('text_addtocompare') . '</a>';

$pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }
			
            if (isset($this->session->data['compare'])) {
                foreach ($this->session->data['compare'] as $prod_id) {
                    if ($prod_id == $product_id) {
                        $this->data['compare_link'] = '<a href="' . $pref_lang . '/compare-products/">' . $this->language->get('text_intocompare') . '</a>';
                        break;
                    }
                }
            }
			
			if ($product_info['quantity'] <= 0) {
				$this->data['stock'] = '0';
			} elseif ($this->config->get('config_stock_display')) {
				$this->data['stock'] = $product_info['quantity'];
			} else {
				$this->data['stock'] = $this->language->get('text_instock');
			}
			
			$this->load->model('tool/image');

			if ($product_info['image'] && file_exists(DIR_IMAGE.$product_info['image'])) {
				$this->data['popup'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
			} else {
				$this->data['popup'] = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
			}
			
			if ($product_info['image'] && file_exists(DIR_IMAGE.$product_info['image'])) {
				$this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
				$this->document->setOgImage($this->data['thumb']);
			} else {
				$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
			}
			
			$this->data['images'] = array();
			
			$results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);
			
			foreach ($results as $result) {
				$this->data['images'][] = array(
					'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
					'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
				);
			}	
						
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$this->data['price'] = $this->tax->calculate(number_format(round($product_info['price'], 2), 2, '.', ''), $product_info['tax_class_id'], $this->config->get('config_tax'));
			} else {
				$this->data['price'] = false;
			}
						
			$special = $this->model_catalog_product->getProductSpecialData($this->request->get['product_id']);
			if ((float)$product_info['special']) {
				$this->data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
            $this->data['special'] = str_replace($this->language->get('text_prod_val'),"",$this->data['special']);
				//$this->data['special_end'] = explode("-", $special['date_end']);
				$special_end_pre = explode(" ", $special['date_end']);
				$this->data['special_end'] = explode("-", $special_end_pre[0]); //3274//
				$this->data['special_end_time'] = explode(":", $special_end_pre[1]); //3274//
			} else {
				$this->data['special'] = false;
			}
			
			if ($this->config->get('config_tax')) {
				$this->data['tax'] = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
			} else {
				$this->data['tax'] = false;
			}
			
			$discounts = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);
			
			$this->data['discounts'] = array(); 
			
			foreach ($discounts as $discount) {
				$this->data['discounts'][] = array(
					'quantity' => $discount['quantity'],
					'price'    => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')))
				);
			}
			
			$this->data['options'] = array();
			
			foreach ($this->model_catalog_product->getProductOptions($this->request->get['product_id']) as $option) { 
				if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') { 
					$option_value_data = array();
					
					foreach ($option['option_value'] as $option_value) {
						if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
							if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
								$price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
							} else {
								$price = false;
							}
							
							$option_value_data[] = array(
								'product_option_value_id' => $option_value['product_option_value_id'],
								'option_value_id'         => $option_value['option_value_id'],
								'name'                    => $option_value['name'],
								'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
								'price'                   => $price,
								'price_prefix'            => $option_value['price_prefix']
							);
						}
					}
					
					$this->data['options'][] = array(
						'product_option_id' => $option['product_option_id'],
						'option_id'         => $option['option_id'],
						'name'              => $option['name'],
						'type'              => $option['type'],
						'option_value'      => $option_value_data,
						'required'          => $option['required']
					);					
				} elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
					$this->data['options'][] = array(
						'product_option_id' => $option['product_option_id'],
						'option_id'         => $option['option_id'],
						'name'              => $option['name'],
						'type'              => $option['type'],
						'option_value'      => $option['option_value'],
						'required'          => $option['required']
					);						
				}
			}
							
			if ($product_info['minimum']) {
				$this->data['minimum'] = $product_info['minimum'];
			} else {
				$this->data['minimum'] = 1;
			}
			
			$this->data['review_status'] = $this->config->get('config_review_status');
			$this->data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$product_info['reviews']);
			$this->data['reviews_text'] = sprintf($this->language->get('text_reviews'), '');
			$this->data['reviews_counter'] = (int)$product_info['reviews'];
			$this->data['rating'] = (int)$product_info['rating'];
			$this->data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
			$this->data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
			
			$this->data['products'] = array();

            $results = $this->model_catalog_product->getProductSimilar($this->request->get['product_id'], 4);
			
			foreach ($results as $result) {
                $compare_link_related = '<a href="javascript:;" onclick="addToCompare(\''.$result['product_id'].'\', this);">' . $this->language->get('text_addtocompare') . '</a>';

$pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }

                if (isset($this->session->data['compare'])) {
                    foreach ($this->session->data['compare'] as $prod_id) {
                        if ($prod_id == $result['product_id']) {
                            $compare_link_related = '<a href="' . $pref_lang . '/compare-products/">' . $this->language->get('text_intocompare') . '</a>';
                            break;
                        }
                    }
                }

				if ($result['image'] && file_exists(DIR_IMAGE.$result['image'])) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				}
				
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}
						
				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
                    $special = str_replace($this->language->get('text_prod_val'),"",$special);
				} else {
					$special = false;
				}
				
				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

                $price = str_replace($this->language->get('text_prod_val'),"",$price);

                $attribute_groups = $this->model_catalog_product->getShortProductAttributes($result['product_id']);
							
				$this->data['products'][] = array(
					'product_id' => $result['product_id'],
                    'compare_link_related' => $compare_link_related,
					'thumb'   	 => $image,
					'name'    	 => $result['name'],
                    'attribute_groups' => $attribute_groups,
					'price'   	 => $price,
					'special' 	 => $special,
					'rating'     => $rating,
					'reviews'    => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
					'href'    	 => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}
			
			$this->data['tags'] = array();
			
			if ($product_info['tag']) {		
				$tags = explode(',', $product_info['tag']);
				
				foreach ($tags as $tag) {
					$this->data['tags'][] = array(
						'tag'  => trim($tag),
						'href' => $this->url->link('product/search', 'tag=' . trim($tag))
					);
				}
			}
			
			$this->model_catalog_product->updateViewed($this->request->get['product_id']);
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/product.tpl';
			} else {
				$this->template = 'default/template/product/product.tpl';
			}
			
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
						
			$this->response->setOutput($this->render());
		} else {
			$url = '';
			
			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}
						
			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}	
						
			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}			

			if (isset($this->request->get['search'])) {
				$url .= '&search=' . $this->request->get['search'];
			}	
					
			if (isset($this->request->get['tag'])) {
				$url .= '&tag=' . $this->request->get['tag'];
			}
							
			if (isset($this->request->get['description'])) {
				$url .= '&description=' . $this->request->get['description'];
			}
					
			if (isset($this->request->get['category_id'])) {
				$url .= '&category_id=' . $this->request->get['category_id'];
			}
			
			if (isset($this->request->get['sub_category'])) {
				$url .= '&sub_category=' . $this->request->get['sub_category'];
			}	
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}	
			
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
														
      		$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('product/product', $url . '&product_id=' . $product_id),
        		'separator' => $this->language->get('text_separator')
      		);			
		
      		$this->document->setTitle($this->language->get('text_error'));

      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}
			
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
						
			$this->response->setOutput($this->render());
    	}
  	}
	
	public function review() {
    	$this->language->load('product/product');
		
		$this->load->model('catalog/review');

		$this->data['text_on'] = $this->language->get('text_on');
		$this->data['text_no_reviews'] = $this->language->get('text_no_reviews');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  
		
		$this->data['reviews'] = array();
		
		$review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);
			
		$results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);
      		
		foreach ($results as $result) {
        	$this->data['reviews'][] = array(
        		'author'     => $result['author'],
				'text'       => $result['text'],
				'rating'     => (int)$result['rating'],
        		'reviews'    => sprintf($this->language->get('text_reviews'), (int)$review_total),
        		'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
        	);
      	}			
			
		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = 5; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('product/product/review', 'product_id=' . $this->request->get['product_id'] . '&page={page}');
			
		$this->data['pagination'] = $pagination->render();
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/review.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/product/review.tpl';
		} else {
			$this->template = 'default/template/product/review.tpl';
		}
		
		$this->response->setOutput($this->render());
	}
	
	public function write() {
		$this->language->load('product/product');
		
		$this->load->model('catalog/review');
		
		$json = array();
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['name']) < 2) || (utf8_strlen($this->request->post['name']) > 25)) {
				$json['error'] = $this->language->get('error_name');
			}
			
			if ((utf8_strlen($this->request->post['text']) < 10) || (utf8_strlen($this->request->post['text']) > 1000)) {
				$json['error'] = $this->language->get('error_text');
			}
	
			if (empty($this->request->post['rating'])) {
				$json['error'] = $this->language->get('error_rating');
			}
	
			if (empty($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
				$json['error'] = $this->language->get('error_captcha');
			}
				
			if (!isset($json['error'])) {
				$this->model_catalog_review->addReview($this->request->get['product_id'], $this->request->post);
				
				$json['success'] = $this->language->get('text_success');
			}
		}
		
		$this->response->setOutput(json_encode($json));
	}
	
	public function captcha() {
		$this->load->library('captcha');
		
		$captcha = new Captcha();
		
		$this->session->data['captcha'] = $captcha->getCode();
		
		$captcha->showImage();
	}
	
	public function upload() {
		$this->language->load('product/product');
		
		$json = array();
		
		if (!empty($this->request->files['file']['name'])) {
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));
			
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
        		$json['error'] = $this->language->get('error_filename');
	  		}	  	

			// Allowed file extension types
			$allowed = array();
			
			$filetypes = explode("\n", $this->config->get('config_file_extension_allowed'));
			
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
			
			if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
       		}	
			
			// Allowed file mime types		
		    $allowed = array();
			
			$filetypes = explode("\n", $this->config->get('config_file_mime_allowed'));
			
			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}
							
			if (!in_array($this->request->files['file']['type'], $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
			}
						
			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
		} else {
			$json['error'] = $this->language->get('error_upload');
		}
		
		if (!$json && is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
			$file = basename($filename) . '.' . md5(mt_rand());
			
			// Hide the uploaded file name so people can not link to it directly.
			$json['file'] = $this->encryption->encrypt($file);
			
			move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . $file);
						
			$json['success'] = $this->language->get('text_upload');
		}	
		
		$this->response->setOutput(json_encode($json));		
	}
}
?>