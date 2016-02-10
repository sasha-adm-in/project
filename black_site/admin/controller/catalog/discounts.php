<?php    
class ControllerCatalogDiscounts extends Controller { 
	private $error = array();
  
  	public function index() {
		$this->load->language('catalog/discounts');
		
		$this->document->setTitle($this->language->get('heading_title'));
				 
		$this->load->model('catalog/discounts');
		
    	$this->getForm();
  	}
    
  	private function getForm() {
    	$this->data['heading_title'] = $this->language->get('heading_title');
  
    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		$this->data['button_add_image'] = $this->language->get('button_add_image');
		
		$this->data['button_remove'] = $this->language->get('button_remove');
        
        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }
	  
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/discounts', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);					
		
		$this->data['action'] = HTTPS_SERVER . 'index.php?route=catalog/discounts/update&token=' . $this->session->data['token'];
		
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=catalog/discounts&token=' . $this->session->data['token'];

		$this->data['token'] = $this->session->data['token'];
        
    	if (isset($this->request->post['discounts'])) {
			$this->data['discounts'] = $this->request->post['discounts'];
		} else { 
			$this->data['discounts'] = $this->model_catalog_discounts->getDiscounts();
		}

		$this->template = 'catalog/discounts_form.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}  
    
    public function update() {
		$this->load->language('catalog/discounts');

    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/discounts');
		
    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_discounts->editDiscounts($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect(HTTPS_SERVER . 'index.php?route=catalog/discounts&token=' . $this->session->data['token']);
		}
    
    	$this->getForm();
  	} 
	 
  	private function validateForm() {
    	if (!$this->user->hasPermission('modify', 'catalog/discounts')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}
        
        foreach($this->request->post['discounts'] as $discount) {
            if (!is_numeric($discount['discount_from'])) {
                $this->error['warning'] = 'Поля не должны быть пустыми и должны быть числами';
            }
            
            if (!$discount['discount_to'] || !is_numeric($discount['discount_to'])) {
                $this->error['warning'] = 'Поля не должны быть пустыми и должны быть числами';
            }
            
            if (!is_numeric($discount['percent'])) {
                $this->error['warning'] = 'Поля не должны быть пустыми и должны быть числами';
            }
        }
		
		if (!$this->error) {
	  		return TRUE;
		} else {
	  		return FALSE;
		}
  	}    

}
?>