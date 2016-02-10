<?php
class ControllerModuleSlideshow extends Controller {
	protected function index($setting) {
		static $module = 0;
	$this->data['current_page'] = $this->document->getCurrent();
		$this->load->model('design/banner');
		$this->load->model('tool/image');
		
		$this->document->addScript('catalog/view/javascript/jquery/nivo-slider/jquery.nivo.slider.pack.js');
		
		if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/slideshow.css')) {
			$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/slideshow.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/slideshow.css');
		}
		
		$this->data['width'] = $setting['width'];
		$this->data['height'] = $setting['height'];
        
        if (isset($this->request->get['path'])) {
            $parts = explode('_', (string)$this->request->get['path']);

		    $category_id = (int)array_pop($parts);
        }
        
       // if (isset($this->request->get['route'])) {
//            $this->data['category_id'] = $category_id;
//        } else {
//            $this->data['category_id'] = 'main';
//        }
        
        switch ($this->request->get['route']) {
            case 'common/home':
                $this->data['category_id'] = 'main';
                break;
            case 'product/category':
                $this->data['category_id'] = $category_id;
                break;
        }
		
		$this->data['banners'] = array();
		
		if (isset($setting['banner_id'])) {
			$results = $this->model_design_banner->getBanner($setting['banner_id']);
            
            $slides = $this->config->get('slideshow_module');

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
		}
		
		$this->data['module'] = $module++;
						
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/slideshow.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/slideshow.tpl';
		} else {
			$this->template = 'default/template/module/slideshow.tpl';
		}
		
		$this->render();
	}
}
?>