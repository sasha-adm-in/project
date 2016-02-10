<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));

$this->document->setCurrent('home');

		$this->data['heading_title'] = $this->config->get('config_title');
        
        $this->load->model('catalog/category');
		
		$this->load->model('catalog/product');

	$this->language->load('common/home');

        //add-----------------------
		
		$this->data['text_home_title'] = $this->language->get('text_home_title');
		$this->data['text_zavl1'] = $this->language->get('text_zavl1');
		$this->data['text_zavl2'] = $this->language->get('text_zavl2');
		$this->data['text_zavl3'] = $this->language->get('text_zavl3');
		$this->data['text_zavl4'] = $this->language->get('text_zavl4');
		$this->data['text_zavl5'] = $this->language->get('text_zavl5');
		$this->data['text_home_sertif'] = $this->language->get('text_home_sertif');
		$this->data['text_home_sertifmore'] = $this->language->get('text_home_sertifmore');

		$this->data['pref_lang'] = $this->language->get('pref_lang');

		//add-----------------------
        
        $this->data['categories_home'] = array();
					
		$categories = $this->model_catalog_category->getCategories(0);
		
		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();
				
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				
				foreach ($children as $child) {

					if ($this->config->get('config_product_count')) {
						$data = array(
							'filter_category_id'  => $child['category_id'],
							'filter_sub_category' => true
						);
						
						$product_total = $this->model_catalog_product->getTotalProducts($data);
					}
									
					$children_data[] = array(
						'name'  => $child['name'], //. ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])	
					);						
				}
                
                $this->load->model('tool/image');
                
                if ($category['image']) {
    				$thumb = $this->model_tool_image->resize($category['image'], 107, 187);
    			} else {
    				$thumb = $this->model_tool_image->resize('no_image.jpg', 107, 187);
    			}
				
				// Level 1
				$this->data['categories_home'][] = array(
					'name'     => $category['name'],
                    'thumb'    => $thumb,
					'children' => $children_data,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/home.tpl';
		} else {
			$this->template = 'default/template/common/home.tpl';
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
?>