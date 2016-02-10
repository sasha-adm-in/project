<?php
class ControllerCommonFooter extends Controller {
	protected function index() {
		$this->language->load('common/footer');
		
		$this->data['text_information'] = $this->language->get('text_information');
		$this->data['text_service'] = $this->language->get('text_service');
		$this->data['text_extra'] = $this->language->get('text_extra');
		$this->data['text_contact'] = $this->language->get('text_contact');
		$this->data['text_return'] = $this->language->get('text_return');
    	$this->data['text_sitemap'] = $this->language->get('text_sitemap');
		$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$this->data['text_voucher'] = $this->language->get('text_voucher');
		$this->data['text_affiliate'] = $this->language->get('text_affiliate');
		$this->data['text_special'] = $this->language->get('text_special');
		$this->data['text_account'] = $this->language->get('text_account');
		$this->data['text_order'] = $this->language->get('text_order');
		$this->data['text_wishlist'] = $this->language->get('text_wishlist');
		$this->data['text_newsletter'] = $this->language->get('text_newsletter');
		
		$this->data['scripts'] = $this->document->getScripts();
		$this->data['styles'] = $this->document->getStyles();

$this->data['current_page'] = $this->document->getCurrent();

		//add-----------------------
		
		$this->data['text_footer_zvjaz'] = $this->language->get('text_footer_zvjaz');
		$this->data['text_footer_mnogok'] = $this->language->get('text_footer_mnogok');
		$this->data['text_footer_tel1'] = $this->language->get('text_footer_tel1');
		$this->data['text_footer_tel2'] = $this->language->get('text_footer_tel2');
		$this->data['text_footer_graf'] = $this->language->get('text_footer_graf');
		$this->data['text_footer_grafm'] = $this->language->get('text_footer_grafm');
		$this->data['text_footer_dost'] = $this->language->get('text_footer_dost');
		$this->data['text_footer_garser'] = $this->language->get('text_footer_garser');
		$this->data['text_footer_about'] = $this->language->get('text_footer_about');
		$this->data['text_footer_nwsstat'] = $this->language->get('text_footer_nwsstat');
		$this->data['text_footer_spivp'] = $this->language->get('text_footer_spivp');
		$this->data['text_footer_spivpkli'] = $this->language->get('text_footer_spivpkli');
		$this->data['text_footer_spivppost'] = $this->language->get('text_footer_spivppost');
		$this->data['text_footer_socslidk'] = $this->language->get('text_footer_socslidk');
		$this->data['text_footer_doopl'] = $this->language->get('text_footer_doopl');
		$this->data['text_footer_podpiska'] = $this->language->get('text_footer_podpiska');
		$this->data['text_footer_subscribe'] = $this->language->get('text_footer_subscribe');
		$this->data['text_footer_copyright'] = $this->language->get('text_footer_copyright');
		$this->data['text_footer_podpis'] = $this->language->get('text_footer_podpis');
		$this->data['text_footer_vidg'] = $this->language->get('text_footer_vidg');
		$this->data[''] = $this->language->get('');
		$this->data[''] = $this->language->get('');
		
		$this->data['pref_lang'] = $this->language->get('pref_lang');
		
		//add-----------------------
		
		
		$this->load->model('catalog/information');
		
		$this->data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$this->data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
    	}

		$this->data['contact'] = $this->url->link('information/contact');
		$this->data['return'] = $this->url->link('account/return/insert', '', 'SSL');
    	$this->data['sitemap'] = $this->url->link('information/sitemap');
		$this->data['manufacturer'] = $this->url->link('product/manufacturer');
		$this->data['voucher'] = $this->url->link('account/voucher', '', 'SSL');
		$this->data['affiliate'] = $this->url->link('affiliate/account', '', 'SSL');
		$this->data['special'] = $this->url->link('product/special');
		$this->data['account'] = $this->url->link('account/account', '', 'SSL');
		$this->data['order'] = $this->url->link('account/order', '', 'SSL');
		$this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$this->data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');		

		$this->data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));
		
		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');
	
			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];	
			} else {
				$ip = ''; 
			}
			
			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];	
			} else {
				$url = '';
			}
			
			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];	
			} else {
				$referer = '';
			}
						
			$this->model_tool_online->whosonline($ip, $this->customer->getId(), $url, $referer);
		}		
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/footer.tpl';
		} else {
			$this->template = 'default/template/common/footer.tpl';
		}
		
		$this->render();
	}
}
?>