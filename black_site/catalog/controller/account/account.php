<?php 
class ControllerAccountAccount extends Controller { 
	public function index() {
		if (!$this->customer->isLogged()) {
	  		$this->session->data['redirect'] = $this->url->link('account/account', '', 'SSL');
	  
	  		$this->redirect($this->url->link('account/login', '', 'SSL'));
    	}

		$this->language->load('account/account');

		$this->document->setTitle($this->language->get('heading_title'));

      	$this->data['breadcrumbs'] = array();

      	$this->data['breadcrumbs'][] = array(
        	'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
        	'separator' => false
      	); 

      	$this->data['breadcrumbs'][] = array(       	
        	'text'      => $this->language->get('text_account'),
			'href'      => $this->url->link('account/account', '', 'SSL'),
        	'separator' => $this->language->get('text_separator')
      	);
		
		if (isset($this->session->data['success'])) {
    		$this->data['success'] = $this->session->data['success'];
			
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
    	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['text_my_account'] = $this->language->get('text_my_account');
		$this->data['text_my_orders'] = $this->language->get('text_my_orders');
		$this->data['text_my_newsletter'] = $this->language->get('text_my_newsletter');
    	$this->data['text_edit'] = $this->language->get('text_edit');
    	$this->data['text_password'] = $this->language->get('text_password');
    	$this->data['text_address'] = $this->language->get('text_address');
		$this->data['text_wishlist'] = $this->language->get('text_wishlist');
    	$this->data['text_order'] = $this->language->get('text_order');
    	$this->data['text_download'] = $this->language->get('text_download');
		$this->data['text_reward'] = $this->language->get('text_reward');
		$this->data['text_return'] = $this->language->get('text_return');
		$this->data['text_transaction'] = $this->language->get('text_transaction');
		$this->data['text_newsletter'] = $this->language->get('text_newsletter');

		//add-----------------------
		
		$this->data['text_mycabinet_options'] = $this->language->get('text_mycabinet_options');
		$this->data['text_mycabinet_zakaz'] = $this->language->get('text_mycabinet_zakaz');
		$this->data['text_mycabinet_pidpr'] = $this->language->get('text_mycabinet_pidpr');
		$this->data['text_mycabinet_exit'] = $this->language->get('text_mycabinet_exit');
		$this->data['text_mycabinet_hello'] = $this->language->get('text_mycabinet_hello');
		$this->data['text_mycabinet_name'] = $this->language->get('text_mycabinet_name');
		$this->data['text_mycabinet_email'] = $this->language->get('text_mycabinet_email');
		$this->data['text_mycabinet_phone'] = $this->language->get('text_mycabinet_phone');
		$this->data['text_mycabinet_addres'] = $this->language->get('text_mycabinet_addres');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		
		//add-----------------------		
		
    	$this->data['edit'] = $this->url->link('account/edit', '', 'SSL');
    	$this->data['password'] = $this->url->link('account/password', '', 'SSL');
		$this->data['address'] = $this->url->link('account/address', '', 'SSL');
		$this->data['wishlist'] = $this->url->link('account/wishlist');
    	$this->data['order'] = $this->url->link('account/order', '', 'SSL');
    	$this->data['download'] = $this->url->link('account/download', '', 'SSL');
		$this->data['return'] = $this->url->link('account/return', '', 'SSL');
		$this->data['transaction'] = $this->url->link('account/transaction', '', 'SSL');
		$this->data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');

        $this->data['firstname'] = $this->customer->getFirstname();
        $this->data['email'] = $this->customer->getEmail();
        $this->data['telephone'] = $this->customer->getTelephone();

        $address = $this->customer->getAddress();

        $this->data['city'] = $address['city'];
		
		if ($this->config->get('reward_status')) {
			$this->data['reward'] = $this->url->link('account/reward', '', 'SSL');
		} else {
			$this->data['reward'] = '';
		}
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/account.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/account/account.tpl';
		} else {
			$this->template = 'default/template/account/account.tpl';
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