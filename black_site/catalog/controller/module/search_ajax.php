<?php
class ControllerModuleSearchAjax extends Controller {
	protected function index($setting) {
//	$this->document->setCurrent('search');

		$this->data['status_input'] = $setting['status_input'];
		$this->data['input_id'    ] = $setting['input_id'];
		
		$this->data['setting'] = $this->config->get('search_ajax_setting');
		
		$this->data['heading_title'] = $this->data['setting']['module_title'];
		
		if (file_exists (DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/search_ajax.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/search_ajax.tpl';
		} else {
			$this->template = 'default/template/module/search_ajax.tpl';
		}
		
		$this->render();
	}
}
?>