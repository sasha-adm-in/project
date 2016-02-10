<?php
class ControllerModuleSearchAjax extends Controller {
	private $error = array (); 
	
	public function index() {
		$this->load->language('module/search_ajax');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['error_warning'] = FALSE;
		
		$this->data['link_targets'] = array (
			array (
				'name'   => $this->language->get('entry_target_self'),
				'target' => '_self'
			),
			array (
				'name'   => $this->language->get('entry_target_blank'),
				'target' => '_blank'
			),
		);
		
		$this->data['search_ajax_setting'] = array (
			'module_title'   => $this->language->get('heading_title'),
			'image_width'    => 50,
			'image_height'   => 50,
			'limit'          => 5,
			'link_target'    => '_self',
			'label_search'   => $this->language->get('label_search'),
			'label_name'     => $this->language->get('label_name'),
			'label_model'    => $this->language->get('label_model'),
			'label_sku'      => $this->language->get('label_sku'),
			'status_name'    => 0,
			'status_model'   => 0,
			'status_sku'     => 0,
			'status_image'   => 0,
			'status_price'   => 0,
			'status_special' => 0,
			'status_rating'  => 0,
			'status_description' => 0,
		);
		
		if (isset ($this->request->post['search_ajax_setting'])) {
			while (list ($key, $value) = each ($this->data['search_ajax_setting'])) {
				if (!isset ($this->request->post['search_ajax_setting'][$key]) || !$this->request->post['search_ajax_setting'][$key]) {
					$this->request->post['search_ajax_setting'][$key] = $this->data['search_ajax_setting'][$key];
				}
			}
		}
		
		if (isset ($this->request->post['search_ajax_module'])) {
			while (list ($key, $value) = each ($this->request->post['search_ajax_module'])) {
				if (!isset ($this->request->post['search_ajax_module'][$key]['input_id']) || !$this->request->post['search_ajax_module'][$key]['input_id']) {
					$this->request->post['search_ajax_module'][$key]['input_id'] = 'search_ajax_' . $key;
				}
				
				if (!isset ($this->request->post['search_ajax_module'][$key]['status_input']) || !$this->request->post['search_ajax_module'][$key]['status_input']) {
					$this->request->post['search_ajax_module'][$key]['status_input'] = 0;
				}
			}
		}
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('search_ajax', $this->request->post);
			
			$this->cache->delete('product');
			
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'       ] = $this->language->get('heading_title');
		
		$this->data['text_enabled'        ] = $this->language->get('text_enabled');
		$this->data['text_disabled'       ] = $this->language->get('text_disabled');
		$this->data['text_content_top'    ] = $this->language->get('text_content_top');
		$this->data['text_content_bottom' ] = $this->language->get('text_content_bottom');
		$this->data['text_column_left'    ] = $this->language->get('text_column_left');
		$this->data['text_column_right'   ] = $this->language->get('text_column_right');
		
		$this->data['entry_module_title'  ] = $this->language->get('entry_module_title');
		$this->data['entry_input_id'      ] = $this->language->get('entry_input_id');
		$this->data['entry_limit'         ] = $this->language->get('entry_limit');
		$this->data['entry_image'         ] = $this->language->get('entry_image');
		$this->data['entry_layout'        ] = $this->language->get('entry_layout');
		$this->data['entry_position'      ] = $this->language->get('entry_position');
		$this->data['entry_sort_order'    ] = $this->language->get('entry_sort_order');
		$this->data['entry_status'        ] = $this->language->get('entry_status');
		
		$this->data['entry_status_input'  ] = $this->language->get('entry_status_input');
		$this->data['entry_status_image'  ] = $this->language->get('entry_status_image');
		$this->data['entry_status_price'  ] = $this->language->get('entry_status_price');
		$this->data['entry_status_special'] = $this->language->get('entry_status_special');
		$this->data['entry_status_rating' ] = $this->language->get('entry_status_rating');
		$this->data['entry_status_description'] = $this->language->get('entry_status_description');
		
		$this->data['entry_link_target'   ] = $this->language->get('entry_link_target');
		$this->data['label_text'          ] = $this->language->get('label_text');
		
		$this->data['entry_search_label'  ] = $this->language->get('entry_search_label');
		$this->data['entry_search_name'   ] = $this->language->get('entry_search_name');
		$this->data['entry_search_model'  ] = $this->language->get('entry_search_model');
		$this->data['entry_search_sku'    ] = $this->language->get('entry_search_sku');
		
		$this->data['button_save'         ] = $this->language->get('button_save');
		$this->data['button_cancel'       ] = $this->language->get('button_cancel');
		$this->data['button_add_module'   ] = $this->language->get('button_add_module');
		$this->data['button_remove'       ] = $this->language->get('button_remove');
		
		$this->data['breadcrumbs'] = array(
			array (
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => FALSE
			),
			array (
				'text'      => $this->language->get('text_module'),
				'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => ' :: '
			),
			array (
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('module/search_ajax', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => ' :: '
			)
		);
		
		$this->data['action'] = $this->url->link('module/search_ajax', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module'  , 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset ($this->request->post['search_ajax_setting'])) {
			$this->data['search_ajax_setting'] = $this->request->post['search_ajax_setting'];
		} else if ($this->config->get('search_ajax_setting')) {
			$this->data['search_ajax_setting'] = $this->config->get('search_ajax_setting');
		}
		
		$this->data['modules'] = array ();
		
		if (isset ($this->request->post['search_ajax_module'])) {
			$this->data['modules'] = $this->request->post['search_ajax_module'];
		} else if ($this->config->get('search_ajax_module')) {
			$this->data['modules'] = $this->config->get('search_ajax_module');
		}
		
		if (isset ($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		}
		
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->template = 'module/search_ajax.tpl';
		$this->children = array (
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render());
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/search_ajax')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>