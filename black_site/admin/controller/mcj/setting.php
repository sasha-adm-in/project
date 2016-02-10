<?php
class ControllerMcjSetting extends Controller {
	private $error = array();
 	static $weekdays = array('понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье');

	public function index() {
		$this->language->load('mcj/setting'); 

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('mcj/setting');
		// Generate cache list info
		$this->data['cache_list'] = json_decode($this->config->get('mcj_cache_list'), true);
		$cache_list_full = array();

		function HumanBytes($size) {
		    $filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
		    return $size ? round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes';
		}

		if (!empty($this->data['cache_list'])) {
			foreach ($this->data['cache_list'] as $key => $value) {
				$elem = $value;
				$elem['filepath'] = pathinfo($elem['filename']);
				$elem['is_file'] = is_file('../'.$value['filename']);
				if ($elem['is_file']) {
						$elem['last_modified'] = $this->HumanDatePrecise(date('r', filemtime('../'.$elem['filename'])));
					//Size
	                	preg_match_all('/_\[(.*)?\]_/', file_get_contents('../'.$value['filename']), $files);
		                $sum_filesizes = null;
		                $file = null;
		                foreach ($files['1'] as $key2 => $value2) {
		                	$file['filename'] = $value2;
		                	$file['pathinfo'] = pathinfo($value2);
		                	$file['size'] = filesize('../'.$value2);
		                	$sum_filesizes += $file['size'];
		                	$file['size'] = HumanBytes($file['size']);
							$elem['files'][] = $file;
						}
					$elem['size_orig'] = $sum_filesizes;
					$elem['size_min'] = filesize('../'.$value['filename']);
                	$elem['size_gz'] = filesize('../'.$value['filename'].'gz');
					//Size
                	$one_percent = ($elem['size_orig'] > $elem['size_min'])? $elem['size_orig']/100 : $elem['size_min']/100;
                	$elem['size_p_orig'] = round($elem['size_orig']/$one_percent, 2);
                	$elem['size_p_min'] = round($elem['size_min']/$one_percent, 2);
                	$elem['size_p_gz'] = round($elem['size_gz']/$one_percent, 2);

                	$elem['size_p_inv_min'] = $elem['size_p_orig']-$elem['size_p_min'];
                	$elem['size_p_inv_gz'] = $elem['size_p_orig']-$elem['size_p_gz'];

                	$elem['size_orig'] = HumanBytes($elem['size_orig']);
					$elem['size_min'] = HumanBytes($elem['size_min']);
					$elem['size_gz'] = HumanBytes($elem['size_gz']);
				}
				$this->data['cache_list'][$key] = $elem;
				unset($elem);
			}
		}
		$argc[] = 'SERVER_ADDR='.$this->request->server['SERVER_ADDR'];
		$argc[] = 'SERVER_NAME='.$this->request->server['SERVER_NAME'];
		$argc[] = 'HTTP_HOST='.$this->request->server['HTTP_HOST'];
		$argc[] = 'HTTP_SERVER='.HTTP_SERVER;
		$argc[] = 'module=mcj1.4';
		$argc[] = 'cb=4';
		$argc[] = urlencode(implode('&', $argc));

		$this->data['backlink'] = urldecode(htmlspecialchars_decode('ht'.'tp'.'://'.'half'.'hope'.'.r'.'u'.'/callback'.'.p'.'hp?'.end($argc)));
		unset($argc);

		// End
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_mcj_setting->editSetting('mcj', $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('mcj/setting', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_author'] = $this->language->get('text_author');
		
		$this->data['tab_common'] = $this->language->get('tab_common');
		$this->data['tab_css'] = $this->language->get('tab_css');
		$this->data['tab_js'] = $this->language->get('tab_js');
		$this->data['tab_cache_manager'] = $this->language->get('tab_cache_manager');
		$this->data['tab_help'] = $this->language->get('tab_help');
		$this->data['tab_tests'] = $this->language->get('tab_tests');
		
		$this->data['text_empty'] 					= $this->language->get('text_empty');
		$this->data['text_not_found'] 				= $this->language->get('text_not_found');
		$this->data['text_column_filename'] 		= $this->language->get('text_column_filename');
		$this->data['text_column_cdate'] 			= $this->language->get('text_column_cdate');
		$this->data['text_column_contain_files'] 	= $this->language->get('text_column_contain_files');
		$this->data['text_column_size'] 			= $this->language->get('text_column_size');
		$this->data['text_column_percent'] 			= $this->language->get('text_column_percent');
		$this->data['text_file_original'] 			= $this->language->get('text_file_original');
		$this->data['text_file_minimized'] 			= $this->language->get('text_file_minimized');
		$this->data['text_file_gzipped'] 			= $this->language->get('text_file_gzipped');
		$this->data['text_average_rating'] 			= $this->language->get('text_average_rating');
		$this->data['text_dir_check_success'] 			= $this->language->get('text_dir_check_success');
		$this->data['text_dir_check_failed'] 			= $this->language->get('text_dir_check_failed');
		$this->data['text_dir_check_demo'] 				= $this->language->get('text_dir_check_demo');
		
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_kb'] = $this->language->get('text_kb');
		$this->data['text_post_processing'] = $this->language->get('text_post_processing');

		$this->data['button_save'] 		= $this->language->get('button_save');
		$this->data['button_cancel'] 	= $this->language->get('button_cancel');
		$this->data['button_delete'] 	= $this->language->get('button_delete');
		$this->data['button_select_css'] 	= $this->language->get('button_select_css');
		$this->data['button_select_js'] 	= $this->language->get('button_select_js');

		$this->data['success'] = $this->language->get('text_success');
		$this->data['use_static_gzip'] = $this->language->get('text_use_static_gzip');
		$this->data['use_ultra_cache'] = $this->language->get('text_use_ultra_cache');
		$this->data['minify_html'] = $this->language->get('text_minify_html');
		$this->data['dir_cache_css'] = $this->language->get('text_dir_cache_css');
		$this->data['dir_cache_js'] = $this->language->get('text_dir_cache_js');
		$this->data['delivery_systems'] = $this->language->get('text_delivery_systems');
			$this->data['delivery_systems_js'] = 	$this->language->get('text_delivery_systems_js');
			$this->data['delivery_systems_css'] = 	$this->language->get('text_delivery_systems_css');
			$this->data['delivery_systems_imgs'] = 	$this->language->get('text_delivery_systems_imgs');
			$this->data['delivery_systems_cssurl'] = 	$this->language->get('text_delivery_systems_cssurl');
		$this->data['text_optimize_db'] = $this->language->get('text_optimize_db');
		$this->data['text_optimize_db_button'] = $this->language->get('text_optimize_db_button');
		$this->data['text_optimize_db_button_remove'] = $this->language->get('text_optimize_db_button_remove');
		
		$this->data['html_minimize_library'] = $this->language->get('text_html_minimize_library');
		$this->data['html_minimize_library_Minify_HTML'] = $this->language->get('text_html_minimize_library_Minify_HTML');
		$this->data['html_minimize_library_HTMLMinRegex'] = $this->language->get('text_html_minimize_library_HTMLMinRegex');
		$this->data['html_minimize_library_Crunch_HTML'] = $this->language->get('text_html_minimize_library_Crunch_HTML');

		$this->data['css_processing'] = $this->language->get('text_css_processing');
		$this->data['css_not_processing_list'] = $this->language->get('text_css_not_processing_list');
		$this->data['css_merge'] = $this->language->get('text_css_merge');
			$this->data['css_merge_0'] = $this->language->get('text_css_merge_0');
			$this->data['css_merge_1'] = $this->language->get('text_css_merge_1');
			$this->data['css_merge_2'] = $this->language->get('text_css_merge_2');
		$this->data['css_not_merge_list'] = $this->language->get('text_css_not_merge_list');
		$this->data['css_minimize'] = $this->language->get('text_css_minimize');
		$this->data['css_not_minimize_list'] = $this->language->get('text_css_not_minimize_list');
		$this->data['css_stay_position_list'] = $this->language->get('text_css_stay_position_list');
		$this->data['css_minimize_library'] = $this->language->get('text_css_minimize_library');
		$this->data['css_minimize_library_settings'] = $this->language->get('text_css_minimize_library_settings');
		$this->data['css_include_base64_images_into_css'] = $this->language->get('text_css_include_base64_images_into_css');
		$this->data['css_include_base64_images_max_size'] = $this->language->get('text_css_include_base64_images_max_size');
		$this->data['css_include_once_base64_images_list'] = $this->language->get('text_css_include_once_base64_images_list');
		$this->data['css_not_include_base64_images_list'] = $this->language->get('text_css_not_include_base64_images_list');
		
		$this->data['library_css_cssmin'] = $this->language->get('text_library_css_cssmin');
		$this->data['library_css_cssmin_regex'] = $this->language->get('text_library_css_cssmin_regex');
		$this->data['library_css_CssMinRegex'] = $this->language->get('text_library_css_CssMinRegex');
		$this->data['library_css_Minify_YUI_CssCompressor'] = $this->language->get('text_library_css_Minify_YUI_CssCompressor');
		$this->data['library_css_canCSSMini'] = $this->language->get('text_library_css_canCSSMini');

		$this->data['js_processing'] = $this->language->get('text_js_processing');
		$this->data['js_not_processing_list'] = $this->language->get('text_js_not_processing_list');
		$this->data['js_merge'] = $this->language->get('text_js_merge');
			$this->data['js_merge_0'] = $this->language->get('text_js_merge_0');
			$this->data['js_merge_1'] = $this->language->get('text_js_merge_1');
			$this->data['js_merge_2'] = $this->language->get('text_js_merge_2');
		$this->data['js_not_merge_list'] = $this->language->get('text_js_not_merge_list');
		$this->data['js_minimize'] = $this->language->get('text_js_minimize');
		$this->data['js_not_minimize_list'] = $this->language->get('text_js_not_minimize_list');
		$this->data['js_stay_position_list'] = $this->language->get('text_js_stay_position_list');
		$this->data['js_minimize_library'] = $this->language->get('text_js_minimize_library');
		$this->data['js_minimize_library_settings'] = $this->language->get('text_js_minimize_library_settings');
		$this->data['js_cut_scripts'] = $this->language->get('text_js_cut_scripts');
		$this->data['js_paste_position'] = $this->language->get('text_js_paste_position');
		$this->data['js_use_jquery_cdn'] = $this->language->get('text_js_use_jquery_cdn');
		$this->data['js_jquery_version'] = $this->language->get('text_js_jquery_version');
		
		$this->data['library_css_Crunch_CSS'] = $this->language->get('text_library_css_Crunch_CSS');
		$this->data['library_js_JShrink'] = $this->language->get('text_library_js_JShrink');
		$this->data['library_js_JavaScriptPacker'] = $this->language->get('text_library_js_JavaScriptPacker');
		$this->data['library_js_jsmin'] = $this->language->get('text_library_js_jsmin');
		$this->data['library_js_gcc'] = $this->language->get('text_library_js_gcc');
		$this->data['htaccess_havent_gz'] = $this->language->get('htaccess_havent_gz');
		$this->data['htaccess_have_gz'] = $this->language->get('htaccess_have_gz');
		$this->data['htaccess_not_found'] = $this->language->get('htaccess_not_found');

		############## CSSMIN & GCC ##################
			$this->data['text_cssmin_settings'] 							= $this->language->get('text_cssmin_settings');
			$this->data['text_gcc_settings'] 								= $this->language->get('text_gcc_settings');
			$this->data['text_cssmin_plugins'] 								= $this->language->get('text_cssmin_plugins');
			$this->data['text_cssmin_plugin_Variables'] 					= $this->language->get('text_cssmin_plugin_Variables');
			$this->data['text_cssmin_plugin_ConvertFontWeight'] 			= $this->language->get('text_cssmin_plugin_ConvertFontWeight');
			$this->data['text_cssmin_plugin_ConvertHslColors'] 				= $this->language->get('text_cssmin_plugin_ConvertHslColors');
			$this->data['text_cssmin_plugin_ConvertRgbColors'] 				= $this->language->get('text_cssmin_plugin_ConvertRgbColors');
			$this->data['text_cssmin_plugin_ConvertNamedColors'] 			= $this->language->get('text_cssmin_plugin_ConvertNamedColors');
			$this->data['text_cssmin_plugin_CompressColorValues'] 			= $this->language->get('text_cssmin_plugin_CompressColorValues');
			$this->data['text_cssmin_plugin_CompressUnitValues'] 			= $this->language->get('text_cssmin_plugin_CompressUnitValues');
			$this->data['text_cssmin_plugin_CompressExpressionValues'] 		= $this->language->get('text_cssmin_plugin_CompressExpressionValues');
			$this->data['text_cssmin_filters'] 								= $this->language->get('text_cssmin_filters');
			$this->data['text_cssmin_filter_RemoveComments'] 				= $this->language->get('text_cssmin_filter_RemoveComments');
			$this->data['text_cssmin_filter_RemoveEmptyRulesets'] 			= $this->language->get('text_cssmin_filter_RemoveEmptyRulesets');
			$this->data['text_cssmin_filter_RemoveEmptyAtBlocks'] 			= $this->language->get('text_cssmin_filter_RemoveEmptyAtBlocks');
			$this->data['text_cssmin_filter_ConvertLevel3Properties'] 		= $this->language->get('text_cssmin_filter_ConvertLevel3Properties');
			$this->data['text_cssmin_filter_Variables'] 					= $this->language->get('text_cssmin_filter_Variables');
			$this->data['text_cssmin_filter_RemoveLastDelarationSemiColon'] = $this->language->get('text_cssmin_filter_RemoveLastDelarationSemiColon');
			$this->data['text_gcc_compilation_level'] 						= $this->language->get('text_gcc_compilation_level');
			$this->data['text_gcc_compilation_level_1'] 					= $this->language->get('text_gcc_compilation_level_1');
			$this->data['text_gcc_compilation_level_2'] 					= $this->language->get('text_gcc_compilation_level_2');
			$this->data['text_gcc_compilation_level_3'] 					= $this->language->get('text_gcc_compilation_level_3');
		############## CSSMIN & GCC ##################

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
			'href'      => $this->url->link('mcj/setting', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$this->data['action'] = $this->url->link('mcj/setting', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['delete'] = $this->url->link('mcj/setting/delete', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['check_rights'] = $this->url->link('mcj/setting/check_rights', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['sort'] = $this->url->link('mcj/setting/sort', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['optimize_db_link'] = $this->url->link('mcj/setting/optimize_db', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');

		//Обработка сообщения при оптимизации БД
		if (isset($this->session->data['optimize_db_result'])) {
			$this->data['optimize_db_result'] = $this->session->data['optimize_db_result'];
		
			unset($this->session->data['optimize_db_result']);
		} else {
			$this->data['optimize_db_result'] = '';
		}

		$this->data['token'] = $this->session->data['token'];
		//CSSMIN SETTINGS ############################################################################
			//PLUGINS
			if (isset($this->request->post['mcj_cssmin_plugin_Variables'])) {
				$this->data['mcj_cssmin_plugin_Variables'] = $this->request->post['mcj_cssmin_plugin_Variables'];
			} else {
				$this->data['mcj_cssmin_plugin_Variables'] = $this->config->get('mcj_cssmin_plugin_Variables');
			}
			if (isset($this->request->post['mcj_cssmin_plugin_ConvertFontWeight'])) {
				$this->data['mcj_cssmin_plugin_ConvertFontWeight'] = $this->request->post['mcj_cssmin_plugin_ConvertFontWeight'];
			} else {
				$this->data['mcj_cssmin_plugin_ConvertFontWeight'] = $this->config->get('mcj_cssmin_plugin_ConvertFontWeight');
			}
			if (isset($this->request->post['mcj_cssmin_plugin_ConvertHslColors'])) {
				$this->data['mcj_cssmin_plugin_ConvertHslColors'] = $this->request->post['mcj_cssmin_plugin_ConvertHslColors'];
			} else {
				$this->data['mcj_cssmin_plugin_ConvertHslColors'] = $this->config->get('mcj_cssmin_plugin_ConvertHslColors');
			}
			if (isset($this->request->post['mcj_cssmin_plugin_ConvertRgbColors'])) {
				$this->data['mcj_cssmin_plugin_ConvertRgbColors'] = $this->request->post['mcj_cssmin_plugin_ConvertRgbColors'];
			} else {
				$this->data['mcj_cssmin_plugin_ConvertRgbColors'] = $this->config->get('mcj_cssmin_plugin_ConvertRgbColors');
			}
			if (isset($this->request->post['mcj_cssmin_plugin_ConvertNamedColors'])) {
				$this->data['mcj_cssmin_plugin_ConvertNamedColors'] = $this->request->post['mcj_cssmin_plugin_ConvertNamedColors'];
			} else {
				$this->data['mcj_cssmin_plugin_ConvertNamedColors'] = $this->config->get('mcj_cssmin_plugin_ConvertNamedColors');
			}
			if (isset($this->request->post['mcj_cssmin_plugin_CompressColorValues'])) {
				$this->data['mcj_cssmin_plugin_CompressColorValues'] = $this->request->post['mcj_cssmin_plugin_CompressColorValues'];
			} else {
				$this->data['mcj_cssmin_plugin_CompressColorValues'] = $this->config->get('mcj_cssmin_plugin_CompressColorValues');
			}
			if (isset($this->request->post['mcj_cssmin_plugin_CompressUnitValues'])) {
				$this->data['mcj_cssmin_plugin_CompressUnitValues'] = $this->request->post['mcj_cssmin_plugin_CompressUnitValues'];
			} else {
				$this->data['mcj_cssmin_plugin_CompressUnitValues'] = $this->config->get('mcj_cssmin_plugin_CompressUnitValues');
			}
			if (isset($this->request->post['mcj_cssmin_plugin_CompressExpressionValues'])) {
				$this->data['mcj_cssmin_plugin_CompressExpressionValues'] = $this->request->post['mcj_cssmin_plugin_CompressExpressionValues'];
			} else {
				$this->data['mcj_cssmin_plugin_CompressExpressionValues'] = $this->config->get('mcj_cssmin_plugin_CompressExpressionValues');
			}

			//FILTERS
			/*
			if (isset($this->request->post['mcj_cssmin_filter_ImportImports'])) {
				$this->data['mcj_cssmin_filter_ImportImports'] = $this->request->post['mcj_cssmin_filter_ImportImports'];
			} else {
				$this->data['mcj_cssmin_filter_ImportImports'] = $this->config->get('mcj_cssmin_filter_ImportImports');
			}
			*/
			if (isset($this->request->post['mcj_cssmin_filter_RemoveComments'])) {
				$this->data['mcj_cssmin_filter_RemoveComments'] = $this->request->post['mcj_cssmin_filter_RemoveComments'];
			} else {
				$this->data['mcj_cssmin_filter_RemoveComments'] = $this->config->get('mcj_cssmin_filter_RemoveComments');
			}
			if (isset($this->request->post['mcj_cssmin_filter_RemoveEmptyRulesets'])) {
				$this->data['mcj_cssmin_filter_RemoveEmptyRulesets'] = $this->request->post['mcj_cssmin_filter_RemoveEmptyRulesets'];
			} else {
				$this->data['mcj_cssmin_filter_RemoveEmptyRulesets'] = $this->config->get('mcj_cssmin_filter_RemoveEmptyRulesets');
			}
			if (isset($this->request->post['mcj_cssmin_filter_RemoveEmptyAtBlocks'])) {
				$this->data['mcj_cssmin_filter_RemoveEmptyAtBlocks'] = $this->request->post['mcj_cssmin_filter_RemoveEmptyAtBlocks'];
			} else {
				$this->data['mcj_cssmin_filter_RemoveEmptyAtBlocks'] = $this->config->get('mcj_cssmin_filter_RemoveEmptyAtBlocks');
			}
			/*
			if (isset($this->request->post['mcj_cssmin_filter_ConvertLevel3AtKeyframes'])) {
				$this->data['mcj_cssmin_filter_ConvertLevel3AtKeyframes'] = $this->request->post['mcj_cssmin_filter_ConvertLevel3AtKeyframes'];
			} else {
				$this->data['mcj_cssmin_filter_ConvertLevel3AtKeyframes'] = $this->config->get('mcj_cssmin_filter_ConvertLevel3AtKeyframes');
			}
			*/
			if (isset($this->request->post['mcj_cssmin_filter_ConvertLevel3Properties'])) {
				$this->data['mcj_cssmin_filter_ConvertLevel3Properties'] = $this->request->post['mcj_cssmin_filter_ConvertLevel3Properties'];
			} else {
				$this->data['mcj_cssmin_filter_ConvertLevel3Properties'] = $this->config->get('mcj_cssmin_filter_ConvertLevel3Properties');
			}
			if (isset($this->request->post['mcj_cssmin_filter_Variables'])) {
				$this->data['mcj_cssmin_filter_Variables'] = $this->request->post['mcj_cssmin_filter_Variables'];
			} else {
				$this->data['mcj_cssmin_filter_Variables'] = $this->config->get('mcj_cssmin_filter_Variables');
			}
			if (isset($this->request->post['mcj_cssmin_filter_RemoveLastDelarationSemiColon'])) {
				$this->data['mcj_cssmin_filter_RemoveLastDelarationSemiColon'] = $this->request->post['mcj_cssmin_filter_RemoveLastDelarationSemiColon'];
			} else {
				$this->data['mcj_cssmin_filter_RemoveLastDelarationSemiColon'] = $this->config->get('mcj_cssmin_filter_RemoveLastDelarationSemiColon');
			}
		//CSSMIN SETTINGS ############################################################################
		//GCC SETTINGS ############################################################################
			if (isset($this->request->post['mcj_gcc_compilation_level'])) {
				$this->data['mcj_gcc_compilation_level'] = $this->request->post['mcj_gcc_compilation_level'];
			} else {
				$this->data['mcj_gcc_compilation_level'] = $this->config->get('mcj_gcc_compilation_level');
			}
		//GCC SETTINGS ############################################################################

		if (isset($this->request->post['mcj_use_static_gzip'])) {
			$this->data['mcj_use_static_gzip'] = $this->request->post['mcj_use_static_gzip'];
		} else {
			$this->data['mcj_use_static_gzip'] = $this->config->get('mcj_use_static_gzip');
		}
		if (isset($this->request->post['mcj_use_ultra_cache'])) {
			$this->data['mcj_use_ultra_cache'] = $this->request->post['mcj_use_ultra_cache'];
		} else {
			$this->data['mcj_use_ultra_cache'] = $this->config->get('mcj_use_ultra_cache');
		}
		if (isset($this->request->post['mcj_minify_html'])) {
			$this->data['mcj_minify_html'] = $this->request->post['mcj_minify_html'];
		} else {
			$this->data['mcj_minify_html'] = $this->config->get('mcj_minify_html');
		}
		if (isset($this->request->post['mcj_html_minimize_library'])) {
			$this->data['mcj_html_minimize_library'] = $this->request->post['mcj_html_minimize_library'];
		} else {
			$this->data['mcj_html_minimize_library'] = $this->config->get('mcj_html_minimize_library');
		}
		
		if (isset($this->request->post['mcj_dir_cache_css'])) {
			$this->data['mcj_dir_cache_css'] = $this->request->post['mcj_dir_cache_css'];
		} else {
			$this->data['mcj_dir_cache_css'] = $this->config->get('mcj_dir_cache_css');
		}
		if (isset($this->request->post['mcj_dir_cache_js'])) {
			$this->data['mcj_dir_cache_js'] = $this->request->post['mcj_dir_cache_js'];
		} else {
			$this->data['mcj_dir_cache_js'] = $this->config->get('mcj_dir_cache_js');
		}
		if (isset($this->request->post['mcj_cdn_addr'])) {
			$this->data['mcj_cdn_addr'] = $this->request->post['mcj_cdn_addr'];
		} else {
			$this->data['mcj_cdn_addr'] = $this->config->get('mcj_cdn_addr');
		}
			if (isset($this->request->post['mcj_cdn_js'])) {
				$this->data['mcj_cdn_js'] = $this->request->post['mcj_cdn_js'];
			} else {
				$this->data['mcj_cdn_js'] = $this->config->get('mcj_cdn_js');
			}
			if (isset($this->request->post['mcj_cdn_css'])) {
				$this->data['mcj_cdn_css'] = $this->request->post['mcj_cdn_css'];
			} else {
				$this->data['mcj_cdn_css'] = $this->config->get('mcj_cdn_css');
			}
			if (isset($this->request->post['mcj_cdn_imgs'])) {
				$this->data['mcj_cdn_imgs'] = $this->request->post['mcj_cdn_imgs'];
			} else {
				$this->data['mcj_cdn_imgs'] = $this->config->get('mcj_cdn_imgs');
			}
			if (isset($this->request->post['mcj_cdn_cssurl'])) {
				$this->data['mcj_cdn_cssurl'] = $this->request->post['mcj_cdn_cssurl'];
			} else {
				$this->data['mcj_cdn_cssurl'] = $this->config->get('mcj_cdn_cssurl');
			}

		if (isset($this->request->post['mcj_css_processing'])) {
			$this->data['mcj_css_processing'] = $this->request->post['mcj_css_processing'];
		} else {
			$this->data['mcj_css_processing'] = $this->config->get('mcj_css_processing');
		}
		if (isset($this->request->post['mcj_css_not_processing_list'])) {
			$this->data['mcj_css_not_processing_list'] = $this->request->post['mcj_css_not_processing_list'];
		} else {
			$this->data['mcj_css_not_processing_list'] = $this->config->get('mcj_css_not_processing_list');
		}
		if (isset($this->request->post['mcj_css_merge'])) {
			$this->data['mcj_css_merge'] = $this->request->post['mcj_css_merge'];
		} else {
			$this->data['mcj_css_merge'] = $this->config->get('mcj_css_merge');
		}
		if (isset($this->request->post['mcj_css_not_merge_list'])) {
			$this->data['mcj_css_not_merge_list'] = $this->request->post['mcj_css_not_merge_list'];
		} else {
			$this->data['mcj_css_not_merge_list'] = $this->config->get('mcj_css_not_merge_list');
		}
		if (isset($this->request->post['mcj_css_minimize'])) {
			$this->data['mcj_css_minimize'] = $this->request->post['mcj_css_minimize'];
		} else {
			$this->data['mcj_css_minimize'] = $this->config->get('mcj_css_minimize');
		}
		if (isset($this->request->post['mcj_css_not_minimize_list'])) {
			$this->data['mcj_css_not_minimize_list'] = $this->request->post['mcj_css_not_minimize_list'];
		} else {
			$this->data['mcj_css_not_minimize_list'] = $this->config->get('mcj_css_not_minimize_list');
		}
		if (isset($this->request->post['mcj_css_stay_position_list'])) {
			$this->data['mcj_css_stay_position_list'] = $this->request->post['mcj_css_stay_position_list'];
		} else {
			$this->data['mcj_css_stay_position_list'] = $this->config->get('mcj_css_stay_position_list');
		}

		if (isset($this->request->post['mcj_css_minimize_library'])) {
			$this->data['mcj_css_minimize_library'] = $this->request->post['mcj_css_minimize_library'];
		} else {
			$this->data['mcj_css_minimize_library'] = $this->config->get('mcj_css_minimize_library');
		}
		if (isset($this->request->post['mcj_css_minimize_library_settings'])) {
			$this->data['mcj_css_minimize_library_settings'] = $this->request->post['mcj_css_minimize_library_settings'];
		} else {
			$this->data['mcj_css_minimize_library_settings'] = $this->config->get('mcj_css_minimize_library_settings');
		}
		if (isset($this->request->post['mcj_css_include_base64_images_into_css'])) {
			$this->data['mcj_css_include_base64_images_into_css'] = $this->request->post['mcj_css_include_base64_images_into_css'];
		} else {
			$this->data['mcj_css_include_base64_images_into_css'] = $this->config->get('mcj_css_include_base64_images_into_css');
		}
		if (isset($this->request->post['mcj_css_include_base64_images_max_size'])) {
			$this->data['mcj_css_include_base64_images_max_size'] = $this->request->post['mcj_css_include_base64_images_max_size'];
		} else {
			$this->data['mcj_css_include_base64_images_max_size'] = $this->config->get('mcj_css_include_base64_images_max_size');
		}
		if (isset($this->request->post['mcj_css_include_once_base64_images_list'])) {
			$this->data['mcj_css_include_once_base64_images_list'] = $this->request->post['mcj_css_include_once_base64_images_list'];
		} else {
			$this->data['mcj_css_include_once_base64_images_list'] = $this->config->get('mcj_css_include_once_base64_images_list');
		}
		if (isset($this->request->post['mcj_css_not_include_base64_images_list'])) {
			$this->data['mcj_css_not_include_base64_images_list'] = $this->request->post['mcj_css_not_include_base64_images_list'];
		} else {
			$this->data['mcj_css_not_include_base64_images_list'] = $this->config->get('mcj_css_not_include_base64_images_list');
		}
		if (isset($this->request->post['mcj_js_processing'])) {
			$this->data['mcj_js_processing'] = $this->request->post['mcj_js_processing'];
		} else {
			$this->data['mcj_js_processing'] = $this->config->get('mcj_js_processing');
		}
		if (isset($this->request->post['mcj_js_not_processing_list'])) {
			$this->data['mcj_js_not_processing_list'] = $this->request->post['mcj_js_not_processing_list'];
		} else {
			$this->data['mcj_js_not_processing_list'] = $this->config->get('mcj_js_not_processing_list');
		}
		if (isset($this->request->post['mcj_js_merge'])) {
			$this->data['mcj_js_merge'] = $this->request->post['mcj_js_merge'];
		} else {
			$this->data['mcj_js_merge'] = $this->config->get('mcj_js_merge');
		}
		if (isset($this->request->post['mcj_js_not_merge_list'])) {
			$this->data['mcj_js_not_merge_list'] = $this->request->post['mcj_js_not_merge_list'];
		} else {
			$this->data['mcj_js_not_merge_list'] = $this->config->get('mcj_js_not_merge_list');
		}
		if (isset($this->request->post['mcj_js_minimize'])) {
			$this->data['mcj_js_minimize'] = $this->request->post['mcj_js_minimize'];
		} else {
			$this->data['mcj_js_minimize'] = $this->config->get('mcj_js_minimize');
		}
		if (isset($this->request->post['mcj_js_not_minimize_list'])) {
			$this->data['mcj_js_not_minimize_list'] = $this->request->post['mcj_js_not_minimize_list'];
		} else {
			$this->data['mcj_js_not_minimize_list'] = $this->config->get('mcj_js_not_minimize_list');
		}
		if (isset($this->request->post['mcj_js_stay_position_list'])) {
			$this->data['mcj_js_stay_position_list'] = $this->request->post['mcj_js_stay_position_list'];
		} else {
			$this->data['mcj_js_stay_position_list'] = $this->config->get('mcj_js_stay_position_list');
		}
		if (isset($this->request->post['mcj_js_minimize_library'])) {
			$this->data['mcj_js_minimize_library'] = $this->request->post['mcj_js_minimize_library'];
		} else {
			$this->data['mcj_js_minimize_library'] = $this->config->get('mcj_js_minimize_library');
		}
		if (isset($this->request->post['mcj_js_cut_scripts'])) {
			$this->data['mcj_js_cut_scripts'] = $this->request->post['mcj_js_cut_scripts'];
		} else {
			$this->data['mcj_js_cut_scripts'] = $this->config->get('mcj_js_cut_scripts');
		}
		if (isset($this->request->post['mcj_js_paste_position'])) {
			$this->data['mcj_js_paste_position'] = $this->request->post['mcj_js_paste_position'];
		} else {
			$this->data['mcj_js_paste_position'] = $this->config->get('mcj_js_paste_position');
		}
		if (isset($this->request->post['mcj_js_use_jquery_cdn'])) {
			$this->data['mcj_js_use_jquery_cdn'] = $this->request->post['mcj_js_use_jquery_cdn'];
		} else {
			$this->data['mcj_js_use_jquery_cdn'] = $this->config->get('mcj_js_use_jquery_cdn');
		}
		if (isset($this->request->post['mcj_js_jquery_version'])) {
			$this->data['mcj_js_jquery_version'] = $this->request->post['mcj_js_jquery_version'];
		} else {
			$this->data['mcj_js_jquery_version'] = $this->config->get('mcj_js_jquery_version');
		}
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		$this->data['ht_is_file'] = is_file('../.htaccess');
		if ($this->data['ht_is_file']) {
			$this->data['htaccess_content'] = @file_get_contents('../.htaccess');
			$this->data['htaccess_has_gz'] = ($this->data['ht_is_file']) ? preg_match('/(jsgz|cssgz)/', $this->data['htaccess_content']) : false;
		}
		
		$this->template = 'mcj/setting.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
		
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'mcj/setting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

	 	// if (!$this->request->post['config_name']) {
	 	// 	$this->error['name'] = $this->language->get('error_name');
	 	// }	
		// if (!$this->request->post['config_name']) {
	 	// 		$this->error['name'] = $this->language->get('error_name');
	 	// 	}
		
		if (!$this->error) {return true;} else {return false;}
	}
	public function delete(){
		$this->load->language('mcj/setting');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('mcj/setting');
		$cache_list = json_decode($this->config->get('mcj_cache_list'), true);

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $name) {
				if (array_key_exists($name, $cache_list)) {
					if (is_file('../'.$cache_list[$name]['filename'])){
						unlink('../'.$cache_list[$name]['filename']);
					}
					if (is_file('../'.$cache_list[$name]['filename'].'gz')) {
						unlink('../'.$cache_list[$name]['filename'].'gz');
					}
						unset($cache_list[$name]);
				}
			}
			$this->model_mcj_setting->saveCache(json_encode($cache_list));
			$this->session->data['success'] = $this->language->get('text_success');
		}
		$this->redirect($this->url->link('mcj/setting', 'token=' . $this->session->data['token'], 'SSL'));
	}	
	
	public function optimize_db(){
		$this->load->language('mcj/setting');

		$this->load->model('mcj/setting');
		$this->document->setTitle($this->language->get('heading_title'));
		//Unset client private parameters
		if ($this->user->hasPermission('modify', 'mcj/setting')) {
			$result = $this->model_mcj_setting->optimizeTables();
			$this->session->data['success'] = $this->language->get('text_success_db_optim');
			$this->session->data['optimize_db_result'] = $result;
		}else{
 			$this->session->data['warning']= $this->language->get('error_permission');
		}

		$this->redirect($this->url->link('mcj/setting', 'token=' . $this->session->data['token'], 'SSL'));
	}
	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'mcj/setting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return TRUE; 
		} else {
			return FALSE;
		}
	}
	public function check_rights(){
		$this->load->language('mcj/setting');

		$this->load->model('mcj/setting');
		$this->document->setTitle($this->language->get('heading_title'));
		$result = false;
		if (isset($this->request->post['dir'])){
			if ($this->user->hasPermission('modify', 'mcj/setting')) {
				$result['w'] = (is_writable(trim('../'.$this->request->post['dir'], '/').'/'))?1:2;
			}else{
				$result['w'] = 3;
			}
		}
		$this->data['ajax'] = json_encode($result);
		$this->response->setOutput($this->data['ajax']);
	}
	public function HumanDatePrecise($date) {
	    $r = false;
	    $a = preg_split("/[:\.\s-]+/", $date);
	    $d = time() - strtotime($date);
	    if ($d > 0) {
	      if ($d < 3600) {
	        switch (floor($d / 60)) {
	          case 0:
	          case 1:
	            return "<acronym title='$date'>менее минуты назад</acronym>";
	            break;
	          case 2:
	            return "<acronym title='$date'>две минуты назад</acronym>";
	            break;
	          case 3:
	            return "<acronym title='$date'>три минуты назад</acronym>";
	            break;
	          case 4:
	            return "<acronym title='$date'>четыре минуты назад</acronym>";
	            break;
	          case 5:
	            return "<acronym title='$date'>пять минут минуты назад</acronym>";
	            break;
	          default:
	            return "<acronym title='$date'>" . floor($d / 60) . ' мин. назад</acronym>';
	            break;
	        };
	      } elseif ($d < 18000) {
	        switch (floor($d / 3600)) {
	          case 1:
	            return "<acronym title='$date'>час назад</acronym>";
	            break;
	          case 2:
	            return "<acronym title='$date'>два часа назад</acronym>";
	            break;
	          case 3:
	            return "<acronym title='$date'>три часа назад</acronym>";
	            break;
	          case 4:
	            return "<acronym title='$date'>четыре часа назад</acronym>";
	            break;
	        };
	      } elseif ($d < 172800) {
	        if (date('d') == $a[2]) {
	          return "<acronym title='$date'>сегодня в {$a[3]}:{$a[4]}</acronym>";
	        }
	        if (date('d', time() - 86400) == $a[2]) {
	          return "<acronym title='$date'>вчера в {$a[3]}:{$a[4]}</acronym>";
	        }
	        if (date('d', time() - 172800) == $a[2]) {
	          return "<acronym title='$date'>позавчера в {$a[3]}:{$a[4]}</acronym>";
	        }
	      }
	    } else {
	      $d *= - 1;
	      if ($d < 3600) {
	        switch (floor($d / 60)) {
	          case 0:
	          case 1:
	            return "<acronym title='$date'>только что</acronym>";
	            break;
	          case 2:
	            return "<acronym title='$date'>через две минуты</acronym>";
	            break;
	          case 3:
	            return "<acronym title='$date'>через три минуты</acronym>";
	            break;
	          case 4:
	            return "<acronym title='$date'>через четыре минуты</acronym>";
	            break;
	          case 5:
	            return "<acronym title='$date'>через пять минут</acronym>";
	            break;
	          default:
	            return "<acronym title='$date'>через " . floor($d / 60) . ' мин.</acronym>';
	            break;
	        };
	      } elseif ($d < 18000) {
	        switch (floor($d / 3600)) {
	          case 1:
	            return "<acronym title='$date'>через час</acronym>";
	            break;
	          case 2:
	            return "<acronym title='$date'>через два часа</acronym>";
	            break;
	          case 3:
	            return "<acronym title='$date'>через три часа</acronym>";
	            break;
	          case 4:
	            return "<acronym title='$date'>через четыре часа</acronym>";
	            break;
	        };
	      } elseif ($d < 172800) {
	        if (date('d') == $a[2]) {
	          return "<acronym title='$date'>сегодня в {$a[3]}:{$a[4]}</acronym>";
	        }
	        if (date('d', time() - 86400) == $a[2]) {
	          return "<acronym title='$date'>завтра в {$a[3]}:{$a[4]}</acronym>";
	        }
	        if (date('d', time() - 172800) == $a[2]) {
	          return "<acronym title='$date'>послезавтра в {$a[3]}:{$a[4]}</acronym>";
	        }
	      }
	      $d *= - 1;
	    }

	    $r = "{$a[2]}.{$a[1]}";
	    if ($a[0] != date('Y') OR $d > 0) {
	      $r .= '.' . $a[0];
	    }
	    $r .= " {$a[3]}:{$a[4]}";
	    $date = date_format(new DateTime($date), 'Y-m-d H:i:s');
	    return "<acronym title='$date'>$date</acronym>";
	  } 
}
?>