<?php
class ControllerModuleBanner extends Controller {
	protected function index($setting) {
		static $module = 0;
		
		$this->load->model('design/banner');
		$this->load->model('tool/image');
		
		$this->document->addScript('catalog/view/javascript/jquery/jquery.cycle.js');
        
        if (isset($this->request->get['path'])) {
            $parts = explode('_', (string)$this->request->get['path']);
		
		    $category_id = (int)array_pop($parts);
        }
        
        switch ($this->request->get['route']) {
            case 'common/home':
                $this->data['category_id'] = 'main';
                break;
            case 'product/category':
                $this->data['category_id'] = $category_id;
                break;
        }
        
       // if (isset($this->request->get['route'])) {
//            $this->data['category_id'] = $category_id;
//        } else {
//            $this->data['category_id'] = 'main';
//        }
				
		$this->data['banners'] = array();
		
		$results = $this->model_design_banner->getBanner($setting['banner_id']);
		  
		$slides = $this->config->get('banner_module');

  			$pref_lang = $this->language->get('code'); if ($pref_lang == "ru") { $pref_lang = ""; }

		foreach ($results as $result) {
		    foreach ($slides as $slide) {
                if ($result['banner_id'] == $slide['banner_id']) {
                    if (file_exists(DIR_IMAGE . $result['image'])) {
                      if ($pref_lang != 'rus') {
    					$this->data['banners'][] = array(
                            'banner_id'   => $result['banner_id'],
                            'category_id' => $slide['category_id'],
    						'title'       => $result['title'],
    						'link'        => $result['link'],
    						'image'       => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
    					);
                      } else {
    					$this->data['banners'][] = array(
                            'banner_id'   => $result['banner_id'],
                            'category_id' => $slide['category_id'],
    						'title'       => $result['title'],
    						'link'        => $result['link'],
       						'image'       => str_replace('-x','',str_replace('cache/','',str_replace('bimage','bimage/' . $pref_lang , $this->model_tool_image->resize($result['image']))))
    					);
                      }
    				}
                }
            }
		}    
		
		$this->data['module'] = $module++;
				
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/banner.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/banner.tpl';
		} else {
			$this->template = 'default/template/module/banner.tpl';
		}
		
		$this->render();
	}
}
?>