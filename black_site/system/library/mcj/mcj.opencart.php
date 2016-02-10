<?php 
/**
* 	MCJ Opencart wrapper
* 	Load settings from database and start mcj
* 	@author Shashakhmetov Talgat <talgatks@gmail.com>
* 	@version 1.4
*/
if (!function_exists('json_encode')) {
	require_once 'helper/json.php';
}
class mcj_opencart{
	public $registry;
	public $output;

	function __construct($registry, $output)
	{
		$this->registry = $registry;
		$config = $this->registry->get('config');
		
		$settings = array(
			'changed' => false,
			'common' => array(
				'use_static_gzip' 					=>	$config->get('mcj_use_static_gzip'),
				'use_ultra_cache' 					=> 	$config->get('mcj_use_ultra_cache'),
				'minify_html' 						=> 	$config->get('mcj_minify_html'),
				'html_minimize_library' 			=> 	$config->get('mcj_html_minimize_library'),
				'dir_cache_css' 					=>	$config->get('mcj_dir_cache_css'),
				'dir_cache_js' 						=>	$config->get('mcj_dir_cache_js'),
				'cache_list' 						=>	json_decode($config->get('mcj_cache_list'), true),
				'cdn_addr' 							=> 	$config->get('mcj_cdn_addr'),
				'cdn_js'							=>	$config->get('mcj_cdn_js'),	
				'cdn_css'							=>	$config->get('mcj_cdn_css'),
				'cdn_imgs'							=>	$config->get('mcj_cdn_imgs'),
				'cdn_css_url'						=>	$config->get('mcj_cdn_cssurl')
			),
			'css' => array(
				'processing' 						=> $config->get('mcj_css_processing'),
				'not_processing_list'				=> explode(PHP_EOL, $config->get('mcj_css_not_processing_list')),
				'merge' 							=> $config->get('mcj_css_merge'),
				'not_merge_list' 					=> explode(PHP_EOL, $config->get('mcj_css_not_merge_list')),
				'minimize' 							=> $config->get('mcj_css_minimize'),
				'stay_position_list' 				=> explode(PHP_EOL, $config->get('mcj_css_stay_position_list')),
				'not_minimize_list' 				=> explode(PHP_EOL, $config->get('mcj_css_not_minimize_list')),
				'include_base64_images_into_css' 	=> $config->get('mcj_css_include_base64_images_into_css'),
				'include_base64_images_max_size' 	=> $config->get('mcj_css_include_base64_images_max_size'),
				'include_once_base64_images_list' 	=> explode(PHP_EOL, $config->get('mcj_css_include_once_base64_images_list')),
				'not_include_base64_images_list' 	=> explode(PHP_EOL, $config->get('mcj_css_not_include_base64_images_list')),
				'minimize_library' 					=> $config->get('mcj_css_minimize_library'),
			),
			'js' => array(
				'processing' 						=> $config->get('mcj_js_processing'),
				'not_processing_list' 				=> explode(PHP_EOL, $config->get('mcj_js_not_processing_list')),
				'merge' 							=> $config->get('mcj_js_merge'), 
				'not_merge_list' 					=> explode(PHP_EOL, $config->get('mcj_js_not_merge_list')),
				'minimize' 							=> $config->get('mcj_js_minimize'),
				'not_minimize_list' 				=> explode(PHP_EOL, $config->get('mcj_js_not_minimize_list')),
				'stay_position_list' 				=> explode(PHP_EOL, $config->get('mcj_js_stay_position_list')),
				'minimize_library' 					=> $config->get('mcj_js_minimize_library'),
				'cut_scripts' 						=> $config->get('mcj_js_cut_scripts'),
				'paste_position' 					=> htmlspecialchars_decode($config->get('mcj_js_paste_position')),
				'use_jquery_cdn' 					=> $config->get('mcj_js_use_jquery_cdn'),
				'jquery_version' 					=> $config->get('mcj_js_jquery_version')
			)
		);
		if ($settings['css']['minimize_library'] == 'CssMin'){
			$settings['css']['minimize_library_settings'] = array(
				'plugins' => array(
			        "Variables"						=> 	$config->get('mcj_cssmin_plugin_Variables'),
			        "ConvertFontWeight"             => 	$config->get('mcj_cssmin_plugin_ConvertFontWeight'),
			        "ConvertHslColors"              => 	$config->get('mcj_cssmin_plugin_ConvertHslColors'),
			        "ConvertRgbColors"              => 	$config->get('mcj_cssmin_plugin_ConvertRgbColors'),
			        "ConvertNamedColors"            => 	$config->get('mcj_cssmin_plugin_ConvertNamedColors'),
			        "CompressColorValues"           => 	$config->get('mcj_cssmin_plugin_CompressColorValues'),
			        "CompressUnitValues"            => 	$config->get('mcj_cssmin_plugin_CompressUnitValues'),
			        "CompressExpressionValues"      => 	$config->get('mcj_cssmin_plugin_CompressExpressionValues')
			    ),
			    'filters' => array(
			        "ImportImports"                 => 	false,
			        "RemoveComments"                => 	$config->get('mcj_cssmin_filter_RemoveComments'), 
			        "RemoveEmptyRulesets"           => 	$config->get('mcj_cssmin_filter_RemoveEmptyRulesets'),
			        "RemoveEmptyAtBlocks"           => 	false,
			        "ConvertLevel3AtKeyframes"      => 	$config->get('mcj_cssmin_filter_ConvertLevel3AtKeyframes'),
			        "ConvertLevel3Properties"       => 	$config->get('mcj_cssmin_filter_ConvertLevel3Properties'),
			        "Variables"                     => 	$config->get('mcj_cssmin_filter_Variables'),
			        "RemoveLastDelarationSemiColon" => 	$config->get('mcj_cssmin_filter_RemoveLastDelarationSemiColon')
			    )		
			);
		}
		if ($settings['js']['minimize_library'] == 'GoogleClousureCompiler') {
			$settings['js']['minimize_library_settings'] = array(
			'compilation_level' => $config->get('mcj_gcc_compilation_level')
			);
		}
		require_once 'mcj.class.php';
		$mcj = new mcj($settings);

		$this->output = $mcj->header_handler($output, true);
		
		if ($mcj->settings['changed']) {
			$cache_list = json_encode($mcj->settings['common']['cache_list']);
			$db = $this->registry->get('db');
			$db->query("UPDATE " . DB_PREFIX . "setting SET `value` = '" . $db->escape($cache_list) . "' WHERE  `". DB_PREFIX ."setting`.`key` = 'mcj_cache_list'");
		}
	}
}
?>