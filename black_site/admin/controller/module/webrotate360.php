<?php
class ControllerModuleWebrotate360 extends Controller {
	
	public function index() {
        $this->language->load('module/webrotate360');

		$this->document->setTitle($this->language->get('heading_title'));
		
        $this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $settingsToSave = array();
            $submitProducts = null;
            foreach($this->request->post as $key => $value) {
                if ($key != "submitProducts")
                    $settingsToSave[$key] = $value;
                else
                    $submitProducts = $value;
            }
            $this->model_setting_setting->editSetting('webrotate360', $settingsToSave);
            
            if ($submitProducts != null && strlen($submitProducts) > 0) {
                $submitProducts = str_replace('&quot;', '"', $submitProducts);
                $submitProducts = json_decode($submitProducts, true);
                if ($submitProducts != null) {
                    foreach($submitProducts as &$product) {
                        if ($product['wr360_enabled'] == 'Yes') {
                            $product['wr360_enabled'] = '1';
                        } else {
                            $product['wr360_enabled'] = '0';
                        }
                    }
			        $this->load->model('catalog/webrotate360');
                    $this->model_catalog_webrotate360->saveProducts($submitProducts);
                }
            }

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['image'])) {
			$this->data['error_image'] = $this->error['image'];
		} else {
			$this->data['error_image'] = array();
		}
				
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/webrotate360', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/webrotate360', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['token'] = $this->session->data['token'];

		$this->loadSetting('webrotate360_status');
        $this->loadSetting('configFileURL');
        $this->loadSetting('graphicsPath', 'html/img/basic');
        $this->loadSetting('divID', '.product-info .image');
        $this->loadSetting('viewerWidth', '250px');
        $this->loadSetting('viewerHeight', '250px');
        $this->loadSetting('skinCSS', 'basic.css');
        $this->loadSetting('baseWidth');
        
        $this->load->model('catalog/webrotate360');
        $this->model_catalog_webrotate360->ensureTableExists();
		
        $this->template = 'module/webrotate360.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
    
    private function loadSetting($name, $defaultIfConfigEmpty = null)
    {
        if (isset($this->request->post[$name])) {
            $this->data[$name] = $this->request->post[$name];
        } else {
            $this->data[$name] = $this->config->get($name);
            
            if (!isset($this->data[$name]) && $defaultIfConfigEmpty) {
                $this->data[$name] = $defaultIfConfigEmpty;
            }
        }
    }
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/webrotate360')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
    
    public function getproducts()
    {
        $this->load->model('catalog/webrotate360');
        $products = $this->model_catalog_webrotate360->getProducts();
        foreach($products as &$product) {
            if ($product['wr360_enabled'] == null || $product['wr360_enabled'] == '0')
                $product['wr360_enabled'] = "No";
            else
                $product['wr360_enabled'] = "Yes";
            
            if ($product['root_path'] == null)
                $product['root_path'] = "";
            
            if ($product['config_file_url'] == null)
                $product['config_file_url'] = "";
        }
        $resp = json_encode($products);
        $this->response->setOutput($resp);
    }
}
?>