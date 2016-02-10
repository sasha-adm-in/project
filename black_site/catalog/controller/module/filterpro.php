<?php
class ControllerModuleFilterPro extends Controller {
	protected function index($setting) {
		$this->language->load('module/filterpro');

		$this->data['text_tax'] = $this->language->get('text_tax');
		$this->data['button_cart'] = $this->language->get('button_cart');
		$this->data['button_wishlist'] = $this->language->get('button_wishlist');
		$this->data['button_compare'] = $this->language->get('button_compare');
		$this->data['text_price_range'] = $this->language->get('text_price_range');
		$this->data['text_manufacturers'] = $this->language->get('text_manufacturers');
		$this->data['text_attributes'] = $this->language->get('text_attributes');
		$this->data['text_all'] = $this->language->get('text_all');
		$this->data['clear_filter'] = $this->language->get('clear_filter');
		
        //add-----------------------
		
		$this->data['text_filter_help'] = $this->language->get('text_filter_help');
		$this->data['text_filter_ot'] = $this->language->get('text_filter_ot');
		$this->data['text_filter_do'] = $this->language->get('text_filter_do');
		$this->data['text_filter_available'] = $this->language->get('text_filter_available');
		$this->data['text_filter_podzak'] = $this->language->get('text_filter_podzak');
		$this->data['text_filter_kolvo'] = $this->language->get('text_filter_kolvo');
		$this->data['text_filter_dostavka'] = $this->language->get('text_filter_dostavka');
		$this->data['text_filter_buy'] = $this->language->get('text_filter_buy');
		$this->data['text_filter_cenyyto4'] = $this->language->get('text_filter_cenyyto4');
		$this->data['text_filter_cur'] = $this->language->get('text_filter_cur');
		$this->data['text_filter_akcimg'] = $this->language->get('text_filter_akcimg');
		$this->data['text_filter_term'] = $this->language->get('text_filter_term');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		
		//add-----------------------
		

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['pds_sku'] = $this->language->get('pds_sku');
		$this->data['pds_upc'] = $this->language->get('pds_upc');
		$this->data['pds_location'] = $this->language->get('pds_location');
		$this->data['pds_model'] = $this->language->get('pds_model');
		$this->data['pds_brand'] = $this->language->get('pds_brand');
		$this->data['pds_stock'] = $this->language->get('pds_stock');
		
		$this->data['setting'] = $setting;

		if(VERSION == '1.5.0') {
			$filterpro_setting = unserialize($this->config->get('filterpro_setting'));
		} else {
			$filterpro_setting = $this->config->get('filterpro_setting');
		}

		$category_id = 0;
		$this->data['path'] = "";
		if(isset($this->request->get['path'])) {
			$this->data['path'] = $this->request->get['path'];
			$parts = explode('_', (string)$this->request->get['path']);
			$category_id = array_pop($parts);
		}
		$this->data['category_id'] = $category_id;

		$this->load->model('module/filterpro');

		$this->data['manufacturers'] = false;
		if($filterpro_setting['display_manufacturer'] != 'none') {
			$this->data['manufacturers'] = $this->model_module_filterpro->getManufacturersByCategoryId($category_id);
			$this->data['display_manufacturer'] = $filterpro_setting['display_manufacturer'];
		}
		$this->data['options'] = $this->model_module_filterpro->getOptionsByCategoryId($category_id);
		foreach($this->data['options'] as $i => $option) {
			$display_option = $filterpro_setting['display_option_' . $option['option_id']];
			if($display_option != 'none') {
				$this->data['options'][$i]['display'] = $display_option;
			} else {
				unset($this->data['options'][$i]);
			}
		}

		$this->data['attributes'] = $this->model_module_filterpro->getAttributesByCategoryId($category_id);

		foreach($this->data['attributes'] as $j => $attribute_group) {
			foreach($attribute_group['attribute_values'] as $attribute_id => $attribute) {
				$display_attribute = $filterpro_setting['display_attribute_' . $attribute_id];
				if($display_attribute != 'none') {
					$this->data['attributes'][$j]['attribute_values'][$attribute_id]['display'] = $display_attribute;
				} else {
					unset($this->data['attributes'][$j]['attribute_values'][$attribute_id]);
					if(!$this->data['attributes'][$j]['attribute_values']) {
						unset($this->data['attributes'][$j]);
					}
				}
			}
		}

		$this->data['price_slider'] = $filterpro_setting['price_slider'];

		if($this->data['options'] || $this->data['manufacturers'] || $this->data['attributes'] ||$this->data['price_slider']) {
			//$this->document->addScript('catalog/view/javascript/jquery/jquery.tmpl.min.js');
//			$this->document->addScript('catalog/view/javascript/jquery/jquery.deserialize.js');
//			$this->document->addScript('catalog/view/javascript/filterpro.min.js');
//			$this->document->addStyle('catalog/view/theme/default/stylesheet/filterpro.css');
		}

		if(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/filterpro.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/filterpro.tpl';
		} else {
			$this->template = 'default/template/module/filterpro.tpl';
		}

		$this->render();
	}

	private function array_clean(array $haystack) {
		foreach($haystack as $key => $value) {
			if(is_array($value)) {
				$haystack[$key] = $this->array_clean($value);
				if(!count($haystack[$key])) {
					unset($haystack[$key]);
				}
			} elseif(is_string($value)) {
				$value = trim($value);
				if(!$value) {
					unset($haystack[$key]);
				}
			}
		}
		return $haystack;
	}

	public function getProducts() {

		//		$cache = md5(http_build_query($this->request->post));
		//		$json = $this->cache->get('filterpro.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $cache);
		//		if(!$json) {

		$this->language->load('module/filterpro');

		if(VERSION == '1.5.0') {
			$filterpro_setting = unserialize($this->config->get('filterpro_setting'));
		} else {
			$filterpro_setting = $this->config->get('filterpro_setting');
		}


		$page = 1;
		if(isset($this->request->post['page'])) {
			$page = (int)$this->request->post['page'];
		}

		if(isset($this->request->post['sort'])) {
			$sort = $this->request->post['sort'];
		} else {
			$sort = 'rating';
            //$sort = 'p.sort_order';
		}

		if(isset($this->request->post['order'])) {
			$order = $this->request->post['order'];
		} else {
			$order = 'ASC';
		}

		if(isset($this->request->post['limit'])) {
			$limit = $this->request->post['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}


		$this->load->model('module/filterpro');
		$this->load->model('catalog/product');
		$this->load->model('tool/image');

		$manufacturer = false;
		if(isset($this->request->post['manufacturer'])) {
			$manufacturer = $this->array_clean($this->request->post['manufacturer']);
			if(!count($manufacturer)) {
				$manufacturer = false;
			}
		}

		$option_value = false;
		if(isset($this->request->post['option_value'])) {
			$option_value = $this->array_clean($this->request->post['option_value']);
			if(!count($option_value)) {
				$option_value = false;
			}
		}

		$attribute_value = false;
		if(isset($this->request->post['attribute_value'])) {
			$attribute_value = $this->array_clean($this->request->post['attribute_value']);
			if(!count($attribute_value)) {
				$attribute_value = false;
			}
		}

		$data = array(
			'option_value' => $option_value,
			'manufacturer' => $manufacturer,
			'attribute_value' => $attribute_value,
			'category_id' => $this->request->post['category_id'],
			'min_price' => $this->request->post['min_price'],
			'max_price' => $this->request->post['max_price'],
			'start' => ($page - 1) * $limit,
			'limit' => $limit,
			'sort' => $sort,
			'order' => $order
		);

		$product_total = $this->model_module_filterpro->getTotalProducts($data);

		$totals_manufacturers = $this->model_module_filterpro->getTotalManufacturers($data);

		$totals_options = $this->model_module_filterpro->getTotalOptions($data);

		$totals_attributes = $this->model_module_filterpro->getTotalAttributes($data);

//        if ($sort == 'pd.name') {
//            $full = true;
//        } else {
//            $full = false;
//        }

		$products = $this->model_module_filterpro->getProducts($data);

//        if ($sort == 'pd.name') {
//            $products = array_slice($products, ($page - 1) * $limit, $limit);
//
//            $keys = array();
//            $values = array();
//
//            foreach ($products as $product_id => $row) {
//                $key = $row['name'];
//                $keys[$product_id] = $key;
//                $values[$product_id] = $row;
//            }
//
//            natsort($keys);
//
//            $products = array();
//
//            foreach($keys as $product_id => $index) {
//                $products[$product_id] = $values[$product_id];
//            }
//        }


		$result = array();

		$min_price = false;
		$max_price = false;

		if(isset($this->request->post['getPriceLimits']) && $this->request->post['getPriceLimits']) {
			$priceLimits = $this->model_module_filterpro->getPriceLimits($data);
			$min_price = $priceLimits['min_price'];
			$max_price = $priceLimits['max_price'];
		}

		foreach($products as $product) {
            $compare_link = '<a href="javascript:;" onclick="addToCompare(\''.$product['product_id'].'\', this);">' . $this->language->get('text_addtocompare') . '</a>';

			$pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }

            if (isset($this->session->data['compare'])) {
                foreach ($this->session->data['compare'] as $prod_id) {
                    if ($prod_id == $product['product_id']) {
                        $compare_link = '<a href="' . $pref_lang . '/compare-products/">' . $this->language->get('text_intocompare') . '</a>';
                        break;
                    }
                }
            }

            $attribute_groups = $this->model_catalog_product->getShortProductAttributes($product['product_id']);
			$attribute_groups2 = $this->model_catalog_product->getProductAttributes($product['product_id']);

			if($product['image'] && file_exists(DIR_IMAGE.$product['image'])) {
				$image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
			}

			if(($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = false;
			}
			if((float)$product['special']) {
				$special = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$special = '';
			}

			if($this->config->get('config_tax')) {
				$tax = $this->currency->format((float)$product['special'] ? $product['special'] : $product['price']);
			} else {
				$tax = false;
			}

			if($this->config->get('config_review_status')) {
				$rating = (int)$product['rating'];
			} else {
				$rating = false;
			}

			$description = function_exists('utf8_substr') ? utf8_substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..' :
					substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..';

			if($product['quantity'] <= 0) {
				$rstock = $product['stock_status'];
			} elseif($this->config->get('config_stock_display')) {
				$rstock = $product['quantity'];
			} else {
				$rstock = $this->language->get('text_instock');
			}
			//$specialstr = strlen($price);
			$result[] = array(
				'product_id' => $product['product_id'],
                'compare_link' => $compare_link,
				//'sku' => $filterpro_setting['sku_display'] ? $product['sku'] : false,
				'sku' => $product['sku'],
				'model' => $filterpro_setting['model_display'] ? $product['model'] : false,
				'brand' => $filterpro_setting['brand_display'] ? $product['manufacturer'] : false,
				'location' => $filterpro_setting['location_display'] ? $product['location'] : false,
				'upc' => $filterpro_setting['upc_display'] ? $product['upc'] : false,
				'stock' => $filterpro_setting['stock_display'] ? $rstock : false,
                'attribute_groups' => $attribute_groups,
				'attribute_groups2' => $attribute_groups2,
				'text_filter_term' => $this->language->get('text_filter_term'),
				'image' => $image,
				'thumb' => $image,
				'special' => $special,
				'tax' => $tax,
				'rating' => $rating,
				'name' => $product['name'],
				'description' => $description,
				'price' => $price,
				//'specialstr' => $specialstr,

				'unit' => $product['unit'],
				'quantity' => $product['quantity'],

				'href' => $this->url->link('product/product', (isset($this->request->post['path']) ? 'path=' . $this->request->post['path']
						: '') . '&product_id=' . $product['product_id'])
			);
		}

		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = 'page={page}';
//		$pagination->url = $this->url->link('product/product', (isset($this->request->post['path']) ? 'path=' . $this->request->post['path']: '')) . 'page-{page}';

		$min_price = $this->currency->convert($min_price, $this->config->get('config_currency'), $this->currency->getCode());
		$max_price = $this->currency->convert($max_price, $this->config->get('config_currency'), $this->currency->getCode());
		$json = json_encode(array('result' => $result, 'min_price' => $min_price, 'max_price' => $max_price, 'pagination' => $pagination->render(),
								 'totals_data' => array('manufacturers' => $totals_manufacturers, 'options' => $totals_options, 'attributes' => $totals_attributes)));

		//			$this->cache->set('filterpro.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $cache, $json);
		//		}

		$this->response->setOutput($json);
	}
}

?>