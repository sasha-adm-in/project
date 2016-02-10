<?php

global $__wr360Path; $__wr360Path = 'catalog';
if(defined('DIR_APPLICATION')) $__wr360Path = preg_replace('/.*\/([^\/].*)\//is', '$1', DIR_APPLICATION);
include $__wr360Path.'/controller/module/wr360/wr360header.php';

class ControllerCommonHeader extends Controller {
	protected function index() {
		//$this->data['title'] = $this->document->getTitle();
        $ttlm = $this->document->getTitle();
        if (gettype($ttlm) == "array"){$ttl=$ttlm[0];$ttl2=$ttlm[1];}else{$ttl=$ttlm;}
        if ($this->language->get('code')=='ru'){$ttl=str_replace(' страница '.$this->request->get['page'],'',$ttl);
        }else{$ttl=str_replace(' page '.$this->request->get['page'],'',$ttl);}

        $this->data['title'] = $ttl;
        $this->data['title2'] = $ttl2;

		$this->data['sku'] = $GLOBALS["sku23"];
		$this->data['seotitle25'] = $GLOBALS["seotitle25"];

		$this->data['page'] = $this->request->get['page'];

//  $this->load->model('catalog/product');

//--------------------------------- ADD FOR TITLE +CAT

  $this->load->model('catalog/category');

	$countcat=0;

  if (isset($this->request->get['path'])) {
   $path = '';

   foreach (explode('_', $this->request->get['path']) as $path_id) {
   $countcat=$countcat+1;
	if (!$path) {
	 $path = $path_id;
	} else {
	 $path .= '_' . $path_id;
	}

	$category_info = $this->model_catalog_category->getCategory($path_id);

	if ($category_info && $countcat=='4') {
    	if ($category_info['name'] != $this->document->getTitle()){
    	 $this->data['cat_stage5'] = $category_info['name'].' ';
        }
	}
   }
  }

//--------------------------------- ADD FOR TITLE +CAT
   
   
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		$this->data['base'] = $server;
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
		$this->data['lang'] = $this->language->get('code');
		$this->data['direction'] = $this->language->get('direction');
		$this->data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		$this->data['name'] = $this->config->get('config_name');

$this->data['current_page'] = $this->document->getCurrent();
        
        if (isset($this->session->data['compare'])) {
            $this->data['compared_total'] = count($this->session->data['compare']);
        } else {
            $this->data['compared_total'] = 0;
        }

        if ($this->cart->hasProducts()) {
            $this->data['cart_products'] = true;
        } else {
            $this->data['cart_products'] = false;
        }
		
		if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$this->data['icon'] = '';
		}
		
		if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
			if ($this->language->get('code') == "rus") {
				$this->data['logo'] = $server . 'image/' . str_replace("/logo","/logo_rus",$this->config->get('config_logo'));
			} else {
				$this->data['logo'] = $server . 'image/' . $this->config->get('config_logo');
			}
		} else {
			$this->data['logo'] = '';

		}		

		$this->language->load('common/header');


        if ($this->language->get('code') == 'ru') {
        $localurl = str_replace('http://'.$_SERVER['SERVER_NAME'],'',(isset($this->request->server['HTTPS']) ? HTTPS_SERVER : HTTP_SERVER) . substr($this->request->server['REQUEST_URI'], 1, (strlen($this->request->server['REQUEST_URI'])-1)));
        } else {
        $localurl = str_replace('http://'.$_SERVER['SERVER_NAME'].'/rus','',(isset($this->request->server['HTTPS']) ? HTTPS_SERVER : HTTP_SERVER) . substr($this->request->server['REQUEST_URI'], 1, (strlen($this->request->server['REQUEST_URI'])-1)));
        }
	    $this->data['uk_url'] = 'http://'.$_SERVER['SERVER_NAME'] . $localurl;
	    $this->data['ru_url'] = 'http://'.$_SERVER['SERVER_NAME'] .'/rus' . $localurl;


		$this->data['og_url'] = (isset($this->request->server['HTTPS']) ? HTTPS_SERVER : HTTP_SERVER) . substr($this->request->server['REQUEST_URI'], 1, (strlen($this->request->server['REQUEST_URI'])-1));
		$this->data['og_image'] = $this->document->getOgImage();

        if ($this->customer->getFirstName()) {
            $firstname = $this->customer->getFirstName();
        } else {
            $firstname = $this->language->get('text_cabinet');
        }
		
		$this->data['text_home'] = $this->language->get('text_home');
		$this->data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$this->data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
    	$this->data['text_search'] = $this->language->get('text_search');
		$this->data['text_welcome'] = sprintf($this->language->get('text_welcome'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
		$this->data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $firstname, $this->url->link('account/logout', '', 'SSL'));
		$this->data['text_account'] = $this->language->get('text_account');
		$this->data['text_checkout'] = $this->language->get('text_checkout');
		$this->data['text_page'] = $this->language->get('text_page');

		$this->data['contact'] = $this->url->link('information/contact');
		
        //add-----------------------
		
		$this->data['text_header_telephopt'] = $this->language->get('text_header_telephopt');
		$this->data['text_header_compare'] = $this->language->get('text_header_compare');
		$this->data['text_header_login'] = $this->language->get('text_header_login');
		$this->data['text_header_mail'] = $this->language->get('text_header_mail');
		$this->data['text_header_password'] = $this->language->get('text_header_password');
		$this->data['text_header_register'] = $this->language->get('text_header_register');
		$this->data['text_header_repas'] = $this->language->get('text_header_repas');
		$this->data['text_header_searchph'] = $this->language->get('text_header_searchph');
		$this->data['text_header_searchbtn'] = $this->language->get('text_header_searchbtn');
		$this->data['text_header_zakcall'] = $this->language->get('text_header_zakcall');
		$this->data['text_header_cartzak'] = $this->language->get('text_header_cartzak');
		$this->data['text_header_callback'] = $this->language->get('text_header_callback');
		$this->data['text_header_callback_inpname'] = $this->language->get('text_header_callback_inpname');
		$this->data['text_header_callback_inptel'] = $this->language->get('text_header_callback_inptel');
		$this->data['text_header_callback_callbtn'] = $this->language->get('text_header_callback_callbtn');
		$this->data['text_header_addtocop'] = $this->language->get('text_header_addtocop');
		$this->data['text_header_teleph1'] = $this->language->get('text_header_teleph1');
		$this->data['text_header_teleph2'] = $this->language->get('text_header_teleph2');
		$this->data['text_header_news'] = $this->language->get('text_header_news');
		$this->data['text_header_about'] = $this->language->get('text_header_about');
		$this->data['text_header_deliv'] = $this->language->get('text_header_deliv');
		$this->data['text_header_serv'] = $this->language->get('text_header_serv');
		$this->data['text_header_news'] = $this->language->get('text_header_news');
		$this->data['text_header_spivp'] = $this->language->get('text_header_spivp');
		$this->data['text_header_spklient'] = $this->language->get('text_header_spklient');
		$this->data['text_header_sppost'] = $this->language->get('text_header_sppost');
		$this->data['text_header_contact'] = $this->language->get('text_header_contact');
		$this->data['text_header_akcii'] = $this->language->get('text_header_akcii');
		$this->data['text_header_namemag'] = $this->language->get('text_header_namemag');
		$this->data['text_header_hmail'] = $this->language->get('text_header_hmail');
		$this->data['text_header_adr'] = $this->language->get('text_header_adr');
		$this->data['text_header_city'] = $this->language->get('text_header_city');
		$this->data['text_header_state'] = $this->language->get('text_header_state');
		$this->data['text_header_phone'] = $this->language->get('text_header_phone');
		$this->data['text_header_weekend'] = $this->language->get('text_header_weekend');
		$this->data['text_chapt'] = $this->language->get('text_chapt');
		$this->data['text_chaptu'] = $this->language->get('text_chaptu');
		$this->data['text_home_title_postadd'] = $this->language->get('text_home_title_postadd');
		$this->data['text_cat_title_postadd'] = $this->language->get('text_cat_title_postadd');
		$this->data['text_cat_title_postadd2str'] = $this->language->get('text_cat_title_postadd2str');
		$this->data['text_prod_title_postadd'] = $this->language->get('text_prod_title_postadd');
		$this->data['text_info_title_postadd'] = $this->language->get('text_info_title_postadd');
		$this->data['text_contact_title_postadd'] = $this->language->get('text_contact_title_postadd');
		$this->data['text_other_title_postadd'] = $this->language->get('text_other_title_postadd');
		$this->data['text_other2_title_postadd'] = $this->language->get('text_other2_title_postadd');
		$this->data['text_cat_descr_preadd'] = $this->language->get('text_cat_descr_preadd');
		$this->data['text_cat_descr_postadd'] = $this->language->get('text_cat_descr_postadd');
		$this->data['text_prod_descr_postadd'] = $this->language->get('text_prod_descr_postadd');
		$this->data['text_info_descr_postadd'] = $this->language->get('text_info_descr_postadd');
		$this->data['text_contact_descr_postadd'] = $this->language->get('text_contact_descr_postadd');
		$this->data['text_other2_descr_postadd'] = $this->language->get('text_other2_descr_postadd');
		$this->data['text_cat_keyw_postadd'] = $this->language->get('text_cat_keyw_postadd');
		$this->data['text_prod_keyw_postadd'] = $this->language->get('text_prod_keyw_postadd');
		$this->data['text_info_keyw_postadd'] = $this->language->get('text_info_keyw_postadd');
		$this->data['text_contact_keyw_postadd'] = $this->language->get('text_contact_keyw_postadd');
		$this->data['text_other_str'] = $this->language->get('text_other_str');

		//$this->data['pref_lang'] = $this->language->get('pref_lang');

		//add-----------------------
		
		$this->data['home'] = $this->url->link('common/home');
		$this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$this->data['logged'] = $this->customer->isLogged();
		$this->data['account'] = $this->url->link('account/account', '', 'SSL');
		$this->data['shopping_cart'] = $this->url->link('checkout/cart');
		$this->data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		
		// Daniel's robot detector
		$status = true;
		
		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", trim($this->config->get('config_robots')));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}

		// A dirty hack to try to set a cookie for the multi-store feature
		$this->load->model('setting/store');
		
		$this->data['stores'] = array();
		
		if ($this->config->get('config_shared') && $status) {
			$this->data['stores'][] = $server . 'catalog/view/javascript/crossdomain.php?session_id=' . $this->session->getId();
			
			$stores = $this->model_setting_store->getStores();

			foreach ($stores as $store) {
				$this->data['stores'][] = $store['url'] . 'catalog/view/javascript/crossdomain.php?session_id=' . $this->session->getId();
			}
		}
				
		// Search		
		if (isset($this->request->get['search'])) {
			$this->data['search'] = $this->request->get['search'];
		} else {
			$this->data['search'] = '';
		}
		
		// Menu
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		$this->load->model('catalog/category');
		
		$this->load->model('catalog/product');
        
        $this->load->model('catalog/information');
        
        $this->data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			$this->data['informations'][] = array(
				'title' => $result['title'],
				'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
			);
    	}
		
		$this->data['categories'] = array();
					
		$categories = $this->model_catalog_category->getCategories(0);
		
		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();
				
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				
				foreach ($children as $child) {
					//Будем вычислять кол-во товаров в категориях только если это кол-во надо показывать
					if ($this->config->get('config_product_count')) {
						$data = array(
							'filter_category_id'  => $child['category_id'],
							'filter_sub_category' => true
						);
						
						$product_total = $this->model_catalog_product->getTotalProducts($data);
					}
									
		
						$children_data[] = array(
							'name'  => $child['name'],// . ' (' . $product_total . ')',
							'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
						);					
										
				}
				
				// Level 1
				$data = array(
					'filter_category_id'  => $category['category_id'],
					'filter_sub_category' => true	
				);		
				$product_total = $this->model_catalog_product->getTotalProducts($data);

				if($product_total>0&&isset($product_total)){
					$this->data['categories'][] = array(
						'name'     => $category['name'],
						'children' => $children_data,
						'active'   => in_array($category['category_id'], $parts),
						'column'   => $category['column'] ? $category['column'] : 1,
						'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
					);
				}
			}
		}
		
		$this->children = array(
			'module/language',
			'module/currency',
			'module/cart'
		);
				
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/header.tpl';
		} else {
			$this->template = 'default/template/common/header.tpl';
		}
		
    	$this->render();
		
$this->output = addWR360Headers($this, $this->output, $this->db);
		
	} 	
}
?>
