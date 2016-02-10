<?php 
	/**
	 * Class for auto minify, merge and compress css and js files
	 * @author Shashsakhmetov Talgat <talgatks@gmail.com>
	 * @version 1.4 
	 */
	class mcj
	{
		public $settings 	= array();
		public $scripts 	= array();				// $value = src
		public $styles 		= array();				// $value = array([href],[media]) 
		private $m_scripts 	= array();
		private $m_styles 	= array();
		private $is_MSIE;
		
		/**
		 * Construct mcj for non static use
		 * And load Default settings
		 * @param array $settings see comment //Set default settings
		 */
		function detect_ie(){
		    if (isset($_SERVER['HTTP_USER_AGENT']) && 
		    (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
		        return true;
		    else
		        return false;
		}
		static function clean($arr){
			$result = array();
			if (!empty($arr)) {
				foreach ($arr as $key => $value) {
					$result[] = trim($value);
				}
			}
			return $result;
		}
		function __construct($settings = null)
		{	
			$this->is_MSIE = $this->detect_ie();
			
			if (!function_exists('array_replace_recursive')){
				function array_replace_recursive($array, $array1, $replace = true){
				    function recurse($array, $array1){
						foreach ($array1 as $key => $value){
				        	if (!isset($array[$key]) || (isset($array[$key]) && !is_array($array[$key]))){
				          		$array[$key] = array();
				        	}
				  			if (is_array($value)){
				          		$value = recurse($array[$key], $value);
				        	}
				        	$array[$key] = $value;
				      	}
				      	return $array;
				    }
				    $args = func_get_args();
				    $array = $args[0];
				    if (!is_array($array)){
				    	return $array;
				    }
				    for ($i = 1; $i < count($args); $i++){
				    	if (is_array($args[$i])){
				    		$array = recurse($array, $args[$i]);
				      	}
				    }
				    return $array;
			  	}
			}
			//Set default settings
			$this->settings = array(
				'changed' => false,
				'common' => array(
					'use_static_gzip' 		=>	true,
					'use_ultra_cache' 		=> 	false,
					'minify_html' 			=> 	false,
					'html_minimize_library' => 	'HTMLMinRegex',
					'dir_cache_css' 		=>	'system/cache',
					'dir_cache_js' 			=>	'system/cache',
					'cache_list' 			=>	array(),
					'cdn_addr' 				=> 	'',
					'cdn_js'				=>	false,	
					'cdn_css'				=>	false,
					'cdn_imgs'				=>	false,
					'cdn_css_url'			=>	false,
				),
				'css' => array(
					'processing' 			=> true,
					// Processing
					'not_processing_list'	=> array(),
					//	Merge
					'merge' 				=> 1, // 0-[not merge], 1-[merge in directory], 2-[merge into file in dir_cache_css]
					'not_merge_list' 		=> array(),
					// 	Compress
					'minimize' 				=> true,
					'not_minimize_list' 	=> array(),
					'stay_position_list' 	=> array(),
					//	Include Images
					'include_base64_images_into_css' => true,
					'include_base64_images_max_size' => 4,
					'include_once_base64_images_list' => array(),
					'not_include_base64_images_list' => array(),
					//	CSS Minimize Library
					'minimize_library' 		=> 'CssMin',
					'minimize_library_settings'	=> array(
						'plugins' => array(
					        'Variables'						=> 	true,
					        'ConvertFontWeight'             => 	true,
					        'ConvertHslColors'              => 	true,
					        'ConvertRgbColors'              => 	true,
					        'ConvertNamedColors'            => 	true,
					        'CompressColorValues'           => 	true,
					        'CompressUnitValues'            => 	true,
					        'CompressExpressionValues'      => 	true
					    ),
					    'filters' => array(
					        'ImportImports'                 => 	false,
					        'RemoveComments'                => 	true, 
					        'RemoveEmptyRulesets'           => 	true,
					        'RemoveEmptyAtBlocks'           => 	true,
					        'ConvertLevel3AtKeyframes'      => 	true,
					        'ConvertLevel3Properties'       => 	true,
					        'Variables'                     => 	true,
					        'RemoveLastDelarationSemiColon' => 	true
					    )
					)		
				),
				'js' => array(
					'processing' 			=> true,
					//	Processing
					'not_processing_list' 	=> array(),
					//	Merge
					'merge' 				=> 1, // 0-[not merge], 1-[merge in directory], 2-[merge into file in dir_cache_js] 
					'not_merge_list' 		=> array(),
					//	Minimize
					'minimize' 				=> true,
					'not_minimize_list' 	=> array(),
					//	JS Minimize Library
					'minimize_library' 		=> 'JsMinPlus',
					'minimize_library_settings' => array(
						'compilation_level' => 'WHITESPACE_ONLY'
					),
					//	Additional settings
					'cut_scripts' 		=> false,
					'paste_position' 		=> '',
					'use_jquery_cdn' 		=> true,
					'jquery_version' 		=> '1.7.1'
				)
			);
			
			if ($settings != null) {
				if (isset($settings['js']['minimize_library'])) {
					if ($settings['js']['minimize_library'] == 'GoogleClousureCompiler') {
						$this->settings['js']['minimize_library_settings']['compilation_level'] = 'WHITESPACE_ONLY'; //WHITESPACE_ONLY SIMPLE_OPTIMIZATIONS ADVANCED_OPTIMIZATIONS
					}
				}
				if (isset($settings['css']['minimize_library'])) {
					if ($settings['css']['minimize_library']) {
						$this->settings['css']['minimize_library_settings'] = array(
							'plugins' => array(
						        'Variables'						=> 	true,
						        'ConvertFontWeight'             => 	true,
						        'ConvertHslColors'              => 	true,
						        'ConvertRgbColors'              => 	true,
						        'ConvertNamedColors'            => 	true,
						        'CompressColorValues'           => 	true,
						        'CompressUnitValues'            => 	true,
						        'CompressExpressionValues'      => 	true
						    ),
						    'filters' => array(
						        'ImportImports'                 => 	false,
						        'RemoveComments'                => 	true, 
						        'RemoveEmptyRulesets'           => 	true,
						        'RemoveEmptyAtBlocks'           => 	true,
						        'ConvertLevel3AtKeyframes'      => 	true,
						        'ConvertLevel3Properties'       => 	true,
						        'Variables'                     => 	true,
						        'RemoveLastDelarationSemiColon' => 	true
						    )
						);				
					}
				}
			}
			
			if ($settings['common']['cache_list'] == null) {
				$settings['common']['cache_list'] = array();
			}
			//Generate stay position lists
			
			if ($settings != null)
				$this->settings = array_replace_recursive($this->settings, $settings);

			//Trim array values
			$this->settings['css']['not_processing_list']				= $this->clean($this->settings['css']['not_processing_list']);
			$this->settings['css']['not_merge_list']					= $this->clean($this->settings['css']['not_merge_list']);
			$this->settings['css']['stay_position_list']				= $this->clean($this->settings['css']['stay_position_list']);
			$this->settings['css']['not_minimize_list']					= $this->clean($this->settings['css']['not_minimize_list']);
			$this->settings['css']['include_once_base64_images_list']	= $this->clean($this->settings['css']['include_once_base64_images_list']);			
			$this->settings['css']['not_include_base64_images_list']	= $this->clean($this->settings['css']['not_include_base64_images_list']);			
			
			$this->settings['js']['not_processing_list']				= $this->clean($this->settings['js']['not_processing_list']);			
			$this->settings['js']['not_merge_list']						= $this->clean($this->settings['js']['not_merge_list']);			
			$this->settings['js']['not_minimize_list']					= $this->clean($this->settings['js']['not_minimize_list']);			
			$this->settings['js']['stay_position_list']					= $this->clean($this->settings['js']['stay_position_list']);			

		}
		/**
		 * Add style to mcj processed style list
		 * @param string $href  href attribute for <link> tag
		 * @param string $media media attribute for <link> tag
		 */
		private function addStyle($href, $media, $gz = true, $hash = null)
		{
			if (!empty($this->settings['common']['cdn_addr']) && ($this->settings['common']['cdn_css'] == true)){
				$href = trim($this->settings['common']['cdn_addr'],'/').'/'. $href;
			}
			$perfix = ($this->is_MSIE || !$gz) ? '' : 'gz';

			$href = ($this->settings['common']['use_static_gzip']) ? $href .= $perfix : $href;

			$this->m_styles[] = array(
				'href' 	=> $href, 
				'id' 	=> $hash, 
				'media' => $media
			);
		}
		/**
		 * Add script to mcj processed script list
		 * @param string $src href attribute of <script></script> tag
		 */
		private function addScript($src, $gz = true, $hash = null)
		{
			if (!empty($this->settings['common']['cdn_addr']) && ($this->settings['common']['cdn_js'] == true)){
				$src = trim($this->settings['common']['cdn_addr'],'/').'/'. $src;
			}
			$perfix = ($this->is_MSIE || !$gz) ? '' : 'gz';
			
			$src = ($this->settings['common']['use_static_gzip']) ? $src .= $perfix : $src;

			$this->m_scripts[] = array(
				'src'	=> $src,
				'id'	=> $hash
			);
		}
		/**
		 * Return processed scripts if if they have been processed
		 * @return array() array of processed scripts $value = src
		 */
		public function getScripts()
		{
			return $this->m_scripts;
		}
		/**
		 * Return processed styles if if they have been processed
		 * @return array() array of processed styles $value['href'] $value['media'] 
		 */
		public function getStyles()
		{
			return $this->m_styles;
		}

		/**
		 * Header handler search all scripts and styles
		 * into $header_content and process it
		 * if $replace == true then function return $header_content
		 * with already processed and pasted scripts and styles 
		 * @param  string  $header_content html code that contains the scripts and styles  
		 * @param  boolean $replace        determines whether the set is inserted scripts and styles
		 * @return string                  return $header_content with already processed and pasted scripts and styles 
		 */
		public function header_handler($header_content, $replace = true)
		{
			$preg = array();
			$if_def_content = '';
			extract($this->settings);

			$preg[0] = '/<!--\[(.*?)\]\>(.*?)<!\[endif\]-->/s';
			$preg[1] = '/\<script[^<]*src=\"(.*?)\">[.\\n]*<\/script\>/';
			$preg[2] = '/<link[^>]*(?:rel=\"stylesheet\")[^>]*href="(.+?)"[^>]*(?:media=\"(.*)?\")?[^>]*\/>/';
			$preg[3] = '/\<script[^>]*src=\"[.\\n]\">[.\\n]*<\/script\>/'; //
			$preg[4] = '/\<html[^.]*\>(.*?)<\/html>/s'; //
			$preg[5] = '/jquery-([0-9]\.[0-9]\.[0-9])[^"]*/';
			$preg[6] = '/\<img[^>]*src="(.*?)\"[^>]*\/>/i';
			$preg[7] = '/\<script[^<]*>(.*?)<\/script\>/s';

			# 	Process If Def IE 		##########################################
			
			if (($css['processing']) || ($js['processing'])) {
				preg_match_all($preg[0], $header_content, $if_def_matches, PREG_SET_ORDER);
				if (count($if_def_matches) > 0){
					foreach ($if_def_matches as $key => $value) {
						$if_def_content .= $if_def_matches[$key][0];
					}
					$header_content = preg_replace($preg[0], '<mcj_if_def_ie>', $header_content);
				}
			}

			# 	END Process If Def IE 	##########################################
			#	SCRIPTS 				##########################################
			if ($js['processing']) {
				$local_scripts = array();
				$net_scripts = array();

				preg_match_all($preg[1], $header_content, $tmp_scripts);
				
				if (count($tmp_scripts[0]) > 0){
					$counter = 0;
					foreach ($tmp_scripts[0] as $key => $value) {
						if ($counter != 0) {
							$header_content = preg_replace($preg[1], '<mcj_script'.$counter.'>', $header_content, 1);
						}else{
							$header_content = preg_replace($preg[1], '<mcj_scriptdef>'.PHP_EOL.'<mcj_script'.$counter.'>', $header_content, 1);
						}
						
						$local = $this->file_is_local($tmp_scripts[1][$key]);
						if ((count($js['not_processing_list']) !=0) && ($local['result']) && (in_array($local['path'], $js['not_processing_list'], true))) {
							$local['result'] = false;
						}

						if ($js['use_jquery_cdn']){
							preg_match($preg[5], $tmp_scripts[0][$key], $matches);
							if (count($matches) > 0){
								$local['result'] = false;
								$tmp_scripts[1][$key] = 'http://ajax.microsoft.com/ajax/jquery/jquery-'.$matches[1].'.min.js';
								if ($js['jquery_version'] != $matches[1]){
									$tmp_scripts[1][$key] = str_replace($matches[1], $js['jquery_version'], $tmp_scripts[1][$key]);
								}
							}
						}
						$hash = (in_array($tmp_scripts[1][$key], $js['stay_position_list'], true))? $counter : null;
						if ($local['result']) {
							$this->scripts[] = array(
								'src' 	=> $local['path'],
								'id'	=> $hash
							);
						}else{
							$this->m_scripts[] = array(
								'src' => $tmp_scripts[1][$key],
								'id'	=> $hash
							);
						}
						//else $this->addScript($tmp_scripts[1][$key], true, $hash);
						++$counter;
					}
				}
				//cut inline scripts
				$script_matches_content = '';
				if ($js['cut_scripts']) {
					preg_match_all($preg[7], $header_content, $script_matches, PREG_SET_ORDER);
					if (count($script_matches) > 0){
						foreach ($script_matches as $key => $value) {
							$script_matches_content .= $script_matches[$key][0].PHP_EOL;
						}
						$header_content = preg_replace($preg[7], '', $header_content);
					}
				}
				//end cut inline scripts

				$this->process_scripts();

				if ($replace) {
					if (count($this->m_scripts) > 0){
						$gen_scripts = PHP_EOL;
						foreach ($this->m_scripts as $key => $value) {
							if ($value['id'] === null) {
								$gen_scripts .= '<script type="text/javascript" src="'.$value['src'].'"></script>'.PHP_EOL;
							}else{
								$header_content = preg_replace('/<mcj_script'.$value['id'].'>/', '<script type="text/javascript" src="'.$value['src'].'"></script>'.PHP_EOL, $header_content, 1);
							}
						}
						
						if (!empty($js['paste_position'])){
							preg_match($js['paste_position'], $header_content, $matches);
							$gen_scripts = $gen_scripts.$script_matches_content.$matches[0]; 
							$header_content = preg_replace($js['paste_position'], $gen_scripts, $header_content, 1);
							$header_content = preg_replace('/<mcj_scriptdef>/', '', $header_content, 1);
						}else{
							$gen_scripts .= $script_matches_content; 
							$header_content = preg_replace('/<mcj_scriptdef>/', $gen_scripts, $header_content, 1);
						}
						
						$i_top = count($this->scripts) + count($this->m_scripts) + 1;
						for ($i = 0; $i < $i_top; $i++) { 
							$header_content = str_replace('<mcj_script'.$i.'>', '', $header_content);
						}
						
						if ($js['use_jquery_cdn']){
							$header_content = str_replace('<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-'.$js['jquery_version'].'.min.js"></script>
', '<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery/jquery-'.$js['jquery_version'].'.min.js"></script>
<script type="text/javascript"> 
if (typeof jQuery == \'undefined\'){
document.write(unescape("%3Cscript src=\'catalog/view/javascript/jquery/jquery-'.$js['jquery_version'].'.min.js\' type=\'text/javascript\'%3E%3C/script%3E")); 
} 
</script>
', $header_content);
						}
					}
				}
			}
			
			#	END SCRIPTS 			##########################################
			#	Stylesheets 			##########################################
			
			if ($css['processing']) {
				$local_styles = array();
				$net_styles = array();
				preg_match_all($preg[2], $header_content, $tmp_styles, PREG_PATTERN_ORDER);
				if (count($tmp_styles) > 0){
					$counter = 0;
					foreach ($tmp_styles[0] as $key => $value) {
						if($tmp_styles[2][$key] == ''){
							$tmp_styles[2][$key] = 'screen';
						}
						if ($counter != 0) {
							$header_content = preg_replace($preg[2], '<mcj_style'.$counter.'>', $header_content, 1);
						}else{
							$header_content = preg_replace($preg[2], '<mcj_styledef>'.PHP_EOL.'<mcj_style'.$counter.'>', $header_content, 1);
						}
						$local = $this->file_is_local($tmp_styles[1][$key]);
						if ( (count($css['not_processing_list']) > 0) && ($local['result']) && (in_array($local['path'], $css['not_processing_list'], true))){
							$local['result'] = false;
						}
						$hash = (in_array($tmp_styles[1][$key], $css['stay_position_list'], true))? $counter : null;
						if ($local['result']) {
							$this->styles[] = array(
								'href' 	=> $local['path'],
								'id' 	=> $hash,
								'media'	=> $tmp_styles[2][$key]
							);
						}else{
							$this->m_styles[] = array(
								'href' 	=> $tmp_styles[1][$key],
								'id' 	=> $hash,
								'media'	=> $tmp_styles[2][$key]
							);
						}
						++$counter;
					}
				}
				$i_top = count($this->styles) + count($this->m_styles) + 10;
				for ($i = 0; $i < $i_top; $i++) { 
					$header_content = str_replace('<mcj_style'.$i.'>', '', $header_content);
				}
				$this->process_styles();
				//Generate css_page_id
				$css_pid = '';
				if (isset($this->m_styles) && count($this->m_styles) != 0) {
					foreach ($this->m_styles as $key => $value) {
						if (!empty($this->m_styles[$key])) {
							$css_pid .= $value['href'];
						}
					}
				}
				$css_pid = substr(md5($css_pid), 16);

				if ($replace) {
					if (count($this->m_styles) > 0) {
						$gen_styles = PHP_EOL;
						foreach ($this->m_styles as $key => $value) {
							if ($value['id'] === null) {
								$gen_styles .= '<link rel="stylesheet" type="text/css" href="'.$value['href'].'" media="'.$value['media'].'" />'.PHP_EOL;
							}else{
								$header_content = preg_replace('/<mcj_style'.$value['id'].'>/', '<link rel="stylesheet" type="text/css" href="'.$value['href'].'" media="'.$value['media'].'" />'.PHP_EOL, $header_content, 1);
							}
						}
						$header_content = preg_replace('/<mcj_styledef>/', $gen_styles, $header_content);
						for ($i = 0; $i < count($this->styles); $i++) { 
							$header_content = preg_replace('/<mcj_style'.$i.'>/', '', $header_content);
						}
					}
				}
			}
			

			if (($css['processing']) || ($js['processing'])) {
				if (isset($if_def_matches) && count($if_def_matches) > 0){
					$header_content = preg_replace('/<mcj_if_def_ie>/', $if_def_content, $header_content, 1);
					$header_content = preg_replace('/<mcj_if_def_ie>/', '', $header_content);
				}
			}
			
			$header_content = preg_replace('/\\n\\r/', '', $header_content);
			#	Add dns perfetch
			if (!empty($common['cdn_addr'])) {
				preg_match('/<head>/', $header_content, $matches);
				$gen = $matches[0].PHP_EOL.'<link rel="dns-perfetch" href="'.trim($common['cdn_addr']).'">'; 
				$header_content = preg_replace('/<head>/', $gen, $header_content, 1);
				
			}
			#	END Add dns perfetch
			#	END Stylesheets 		###########################################
			# CDN IMAGES
			if (!empty($common['cdn_addr']) && ($common['cdn_imgs'])) {
			
				preg_match_all($preg[6], $header_content, $img_matches, PREG_SET_ORDER);
				$img_src = '';
				foreach ($img_matches as $key => $value) {
					$img_src = str_replace('\\', '/', $img_src);
					$img_src = str_replace('http://'.$_SERVER['HTTP_HOST'], '', $value[1]);
					$img_src = trim($img_src, '/');
					$img_src = trim($common['cdn_addr'], '/').'/'.$img_src;
					$header_content = str_replace($value[1], $img_src, $header_content);
				}
			
			}
			
			
			if (isset($common['minify_html']) && $common['minify_html']) {
				return call_user_func(array($common['html_minimize_library'], 'minify'), $header_content);
			}
			return $header_content;
		}
		/**
		 * Process all scripts and styles
		 */
		public function process()
		{
			if (count($this->scripts) !=0 ){
				$this->process_scripts();
			}
			if (count($this->styles) !=0 ){
				$this->process_styles();
			}

		}

		public function process_scripts()
		{
			extract($this->settings);
			$files_dir_sort = array();
			$files_js_cache_sort = array();
			foreach ($this->scripts as $key => $value) {
				switch ($js['merge']) {
					case 0: # not merge
						$file = pathinfo($value['src']);
						$this->compress_js_files($file['dirname'], $value['src'], $value['id']);
						break;
					case 1: # merge in directory
						if ((in_array($value['src'], $js['not_merge_list'], true))||(in_array($value['src'], $js['stay_position_list'], true))) {
							$file = pathinfo($value['src']);
							$this->compress_js_files($file['dirname'], $value['src'], $value['id']);
						}else{
							$file = pathinfo($value['src']);
							$files_dir_sort[$file['dirname']][] = $value;
						}
						break;
					case 2: # merge into one file in dir_cache_js
						if ((in_array($value['src'], $js['not_merge_list'], true))||(in_array($value['src'], $js['stay_position_list'], true))) {
							$file = pathinfo($value['src']);
							$this->compress_js_files($file['dirname'], $value['src'], $value['id']);
						}else{
							$files_js_cache_sort[$common['dir_cache_js']][] = $value;
						}
						break;
				}
			}
			if (count($files_dir_sort) > 0) {
				foreach ($files_dir_sort as $key => $value) {
					$this->compress_js_files($key, $value);
				}
			}
			if (count($files_js_cache_sort) > 0) {
				foreach ($files_js_cache_sort as $key => $value) {
					$this->compress_js_files($key, $value);
				}
			}
		}

		public function process_styles()
		{
			extract($this->settings);
			$files_dir_sort = array();
			$files_css_cache_sort = array();
			foreach ($this->styles as $key => $value) {
				switch ($css['merge']) {
					case 0: # not merge
						$file = pathinfo($value['href']);
						$this->compress_css_files($file['dirname'], $value['href'], $value['media'], $value['id']);
						break;
					case 1: # merge in directory
						if ((in_array($value['href'], $css['not_merge_list'], true))||(in_array($value['href'], $css['stay_position_list'], true))) {
							$file = pathinfo($value['href']);
							$this->compress_css_files($file['dirname'], $value['href'], $value['media'], $value['id']);
						}else{
							$file = pathinfo($value['href']);
							$files_dir_sort[$file['dirname']][] = $value;
						}
						break;
					case 2: # merge into one file in dir_cache_css
						if ((in_array($value['href'], $css['not_merge_list'], true))||(in_array($value['href'], $css['stay_position_list'], true))) {
							$file = pathinfo($value['href']);
							$this->compress_css_files($file['dirname'], $value['href'], $value['media'], $value['id']);
						}else{
							$files_css_cache_sort[$common['dir_cache_css']][] = $value;
						}
						break;
				}
			}
			if (count($files_dir_sort) > 0) {
				foreach ($files_dir_sort as $key => $value) {
					$this->compress_css_files($key, $value);
				}
			}
			if (count($files_css_cache_sort) > 0) {
				foreach ($files_css_cache_sort as $key => $value) {
					$this->compress_css_files($key, $value);
				}
			}
		}
		private function compress_css_files($directory, $files, $media = '', $hash = null){
			extract($this->settings);
			$media_types = array();
			if (is_array($files) && count($files) > 0) {
				// Обработка массива стилкй
				foreach ($files as $key => $value) {
					$media_types[$value['media']][] = $value;
				}
				//сортировка по медиатипам (screen, tablet, phone и т.д.)
				foreach ($media_types as $media_type) {
					//Обнуление переменных
					$params = array();
					$params['id'] = '';
					//Если используется быстрое кэширование
					if($common['use_ultra_cache']){
						//Создание уникального имени для всех стилей в медиатипе
						foreach ($media_type as $key => $value) {
							$params['id'] .= $value['href'];
						}
						$params['id'] = substr(md5($params['id']), 16);
						//Вычисляем название файла
						$css_file_name = $directory.'/'.$params['id'].'.css';
						
						//Не проверяем
						$file_exists = file_exists($css_file_name);
						$in_cache_list = true;
						$is_modified = false;
					}else{
						//Создание уникального имени для всех стилей в медиатипе
						foreach ($media_type as $key => $value) {
							$params['id']				.= $value['href'];
						}
						$params['id'] = substr(md5($params['id']), 16);
						//Вычисляем название файла
						$css_file_name = $directory.'/'.$params['id'].'.css';
						
						$file_exists = file_exists($css_file_name);
						if ($file_exists) {
							//Проверяем на факт изменения файла, 
							//Дата модификации файла === дата модификации файла из списка кэша
							$params['last_modified'] = @filemtime($css_file_name);
							$in_cache_list = array_key_exists($params['id'], $common['cache_list']);
							if (isset($common['cache_list'][$params['id']])) {
								if (array_key_exists($params['id'], $common['cache_list'])) {
									$is_modified = $common['cache_list'][$params['id']]['last_modified'] != $params['last_modified'];
								}else{
									$is_modified = true;
								}
							}else{
								$is_modified = true;
							}
						}else{
							$in_cache_list = false;
							$is_modified = true;
						}
					}

					//Если файл еще не существует || Нет в кэше || был модифицирован
					if (!$file_exists || !$in_cache_list || $is_modified) {
						//обнуляем переменные
						$content = '';
						$f_content = '';
						$m_content = '';
						$m_names = '';
						//Собираем содержимое файлов в один
						foreach ($media_type as $key => $value) {
							$handle = fopen($value['href'],	'r');
							$f_content = fread($handle, filesize($value['href']));
							
							//Обрабатываем изображения
							$f_content = $this->css_ob_handler($f_content, $value['href'], $css_file_name);
							
							if (!$css['merge'] || in_array($value['href'], $css['not_minimize_list'], true)) {
								$m_names .= '/*! _['.$value['href'].']_ */'.PHP_EOL;
								$content .= $f_content.PHP_EOL.PHP_EOL;
							}else{
								$m_names .= '/*! _['.$value['href'].']_ */'.PHP_EOL;
								$m_content .= $f_content;
							}
							fclose($handle);
						}
						//Минимизируем и записываем
						$content .= $this->minimize_css($m_content);
						$content .= $m_names;
						$this->write_to_file($css_file_name, $content);
						
						//Заполняем массив $params для записи в кэш
						//$id = array($filename, $last_modified);
						$params['filename'] = $css_file_name;
						$params['last_modified'] = filemtime($css_file_name);
						
						//Записываем файлы в кэш
						$this->settings['common']['cache_list'][$params['id']] = $params;
						//Ставим отметку о том, что кэш изменился
						$this->settings['changed'] = true;
					}else{
						//Если файл существует, присутствует в кэше и не модифицирован	
					}
					//Добавляем ссылку на файл в список стилей
					$this->addStyle($css_file_name, $media_type[0]['media'], true, $hash);
				}
			}else{
				//Если $files не массив
				if (in_array($files, $css['not_minimize_list'], true)){
					//Если файл в списке исключенных из минимизации, то добавляем ссылку на файл в список стилей
					$this->addStyle($files, $media, false, $hash);
				}else{
					//Обнуление переменных
					$params = array();
					//Создание уникального имени для файла
					$params['id'] = substr(md5($files), 16);
					//Вычисляем название файла
					$css_file_name = $directory.'/'.$params['id'].'.css';
					
					//Если используется быстрое кэширование
					if ($common['use_ultra_cache']) {
						//Не проверяем
						$file_exists = file_exists($css_file_name);
						$in_cache_list = true;
						$is_modified = false;	
					}else{
						$file_exists = file_exists($css_file_name);
						if ($file_exists) {
							//Проверяем на факт изменения файла, 
							//Дата модификации файла === дата модификации файла из списка кэша
							$params['last_modified'] = @filemtime($css_file_name);
							$in_cache_list = array_key_exists($params['id'], $common['cache_list']);
							if (isset($common['cache_list'][$params['id']]['last_modified'])) {
								$is_modified = $common['cache_list'][$params['id']]['last_modified'] != $params['last_modified'];
							}else{
								$is_modified = true;
							}
						}else{
							$in_cache_list = false;
							$is_modified = true;	
						}
					}

					//Если файл еще не существует || Нет в кэше || был модифицирован
					if (!$file_exists || !$in_cache_list || $is_modified) {	
						//Обнуление переменных
						$content = '';
						$f_content = '';
						$m_names = '';
						//Собираем содержимое файлов в один
						$m_names .= '/*! _['.$files.']_ */'.PHP_EOL;
						$handle = fopen($files,	'r');
						$f_content = fread($handle, filesize($files));
						//Обрабатываем изображения
						$f_content = $this->css_ob_handler($f_content, $files, $css_file_name);

						// Минимизируем
						if (!$css['merge'] || in_array($files, $css['not_minimize_list'], true)) {
							$content .= $f_content.PHP_EOL.PHP_EOL;
						}else{
							$content .= $this->minimize_css($f_content);
						}
						fclose($handle);
						
						// записываем
						$content .= $m_names;
						$this->write_to_file($css_file_name, $content);
						
						//Заполняем массив $params для записи в кэш
						//$id = array($filename, $last_modified);
						$params['filename'] = $css_file_name;
						$params['last_modified'] = filemtime($css_file_name);
						//Если файл существует, присутствует в кэше и не модифицирован
						$this->settings['common']['cache_list'][$params['id']] = $params;
						$this->settings['changed'] = true;
					}else{
						//Если файл существует, присутствует в кэше и не модифицирован
					}
					//Добавляем ссылку на файл в список стилей
					$this->addStyle($css_file_name, $media, true, $hash);
				}
			}
		}
		public function compress_js_files($directory, $files, $hash = null){
			extract($this->settings);
			// Если $files массив
			if (is_array($files) && (count($files) > 0)) {
				// Обнуляем переменные
				$params = array();
				$params['last_modified'] = 0;
				$params['id'] = '';
				//Если используется быстрое кэширование
				if ($common['use_ultra_cache']) {
					// Создаем уникальное имя для файла
					foreach ($files as $key => $value) {
						$params['id']				.= $value['src'];
					}
					$params['id'] = substr(md5($params['id']), 16);
					//Вычисляем название файла
					$js_file_name = $directory.'/'.$params['id'].'.js';
					
					// Отключаем проверку
					$file_exists = file_exists($js_file_name);
					$in_cache_list = true;
					$is_modified = false;
				}else{
					// Если включена проверка даты модификации файлов
					// Создаем уникальное имя для файла
					foreach ($files as $key => $value) {
						$params['id'] .= $value['src'];
					}
					$params['id'] = substr(md5($params['id']), 16);
					//Вычисляем название файла
					$js_file_name = $directory.'/'.$params['id'].'.js';
					
					$file_exists = file_exists($js_file_name);
					if ($file_exists) {
						//Проверяем на факт изменения файла, 
						//Дата модификации файла === дата модификации файла из списка кэша
						$params['last_modified'] = @filemtime($js_file_name);
						$in_cache_list = array_key_exists($params['id'], $common['cache_list']);
						if (isset($common['cache_list'][$params['id']]['last_modified'])) {
							if (array_key_exists($params['id'], $common['cache_list'])) {
								$is_modified = $common['cache_list'][$params['id']]['last_modified'] != $params['last_modified'];
							}else{
								$is_modified = true;
							}
						}else{
							$is_modified = true;
						}
					}else{
						$in_cache_list = false;
						$is_modified = true;	
					}
				}
				//Если файл еще не существует || Нет в кэше || был модифицирован	
				if (!$file_exists || !$in_cache_list || $is_modified) {
					//Обнуляем переемнные
					$content = '';
					$f_content = '';
					$m_content = '';
					$m_names = '';
					// Объединяем все файлы в один
					foreach ($files as $key => $value) {
						$handle = fopen($value['src'],	'r');
						$f_content = fread($handle, filesize($value['src']));
						
						if (in_array($value['src'], $js['not_minimize_list'], true)) {
							$m_names .= '/*! _['.$value['src'].']_ */'.PHP_EOL;
							$content .= $f_content.PHP_EOL.PHP_EOL;
						}else{
							$m_names .= '/*! _['.$value['src'].']_ */'.PHP_EOL;
							$m_content .= $f_content;
						}
					}
					fclose($handle);
					// Минимизируем 
					$content .= $this->minimize_js($m_content);
					// записываем 
					$content .= $m_names;
					$this->write_to_file($js_file_name, $content);
					
					//Заполняем массив $params для записи в кэш
					//$id = array($filename, $last_modified);
					$params['filename'] = $js_file_name;
					$params['last_modified'] = filemtime($js_file_name);
					
					//Записываем файлы в кэш
					$this->settings['common']['cache_list'][$params['id']] = $params;
					//Ставим отметку о том, что кэш изменился
					$this->settings['changed'] = true;
				}else{
					//Если файл существует, присутствует в кэше и не модифицирован	
				}
				//Добавляем ссылку на файл в список стилей			
				$this->addScript($js_file_name, true, $hash);
			}else{
				// Если $files не массив
				if (in_array($files, $js['not_minimize_list'], true)){
					//Если файл в списке исключенных из минимизации, то добавляем ссылку на файл в список стилей
					$this->addScript($files, false, $hash);
				}else{
					// Обнуляем переменные
					$params = array();
					//Создание уникального имени для файла
					$params['id'] = substr(md5($files), 16);
					//Вычисляем название файла
					$js_file_name = $directory.'/'.$params['id'].'.js';
					// Если используется быстрое кэширование
					if ($common['use_ultra_cache']) {
						//Не проверяем
						$file_exists = file_exists($js_file_name);
						$in_cache_list = true;
						$is_modified = false;
					}else{
						$file_exists = file_exists($js_file_name);
						if ($file_exists) {
							//Проверяем на факт изменения файла, 
							//Дата модификации файла === дата модификации файла из списка кэша
							$params['last_modified'] = @filemtime($js_file_name);
							$in_cache_list = array_key_exists($params['id'], $common['cache_list']);
							if (array_key_exists($params['id'], $common['cache_list'])) {
								$is_modified = $common['cache_list'][$params['id']]['last_modified'] != $params['last_modified'];
							}else{
								$is_modified = true;
							}
						}else{
							$in_cache_list = false;
							$is_modified = true;
						}
					}
					//Если файл еще не существует || Нет в кэше || был модифицирован
					if (!$file_exists || !$in_cache_list || $is_modified) {
						//Обнуление переменных
						$content = '';
						$f_content = '';
						$m_names = '';

						//Собираем содержимое файлов в один
						$m_names .= '/*! _['.$files.']_ */'.PHP_EOL;
						$handle = fopen($files,	'r');
						$f_content = fread($handle, filesize($files));
						// Минимизируем
						if (in_array($files, $js['not_minimize_list'], true)) {
							$content .= $f_content.PHP_EOL.PHP_EOL;
						}else{
							$content .= $this->minimize_js($f_content);
						}
						fclose($handle);
						// записываем
						$content .= $m_names;
						$this->write_to_file($js_file_name, $content);
						
						//Заполняем массив $params для записи в кэш
						//$id = array($filename, $last_modified);
						$params['filename'] = $js_file_name;
						$params['last_modified'] = filemtime($js_file_name);
						//Если файл существует, присутствует в кэше и не модифицирован
						$this->settings['common']['cache_list'][$params['id']] = $params;
						$this->settings['changed'] = true;
					}else{
						//Если файл существует, присутствует в кэше и не модифицирован
					}
					//Добавляем ссылку на файл в список скриптов
					$this->addScript($js_file_name, true, $hash);
				}
			}
		}
		public function minimize_css($content)
		{
			$minName = $this->settings['css']['minimize_library']; 
			
			if ($minName == 'CssMin') {
				extract($this->settings['css']['minimize_library_settings']);
				$content = CssMin::minify($content, $filters, $plugins).PHP_EOL.PHP_EOL;
				return $content;
			}
			if (class_exists($minName)) {
				return call_user_func(array($minName, 'minify'), $content);
			}
			return call_user_func(array('CssMin', 'minify'), $content);
			
		}
		public function minimize_js($content)
		{
			$minName = $this->settings['js']['minimize_library'];
			
			if ($minName == 'GoogleClousureCompiler') {
				return GoogleClousureCompiler::minify($content, $this->settings['js']['minimize_library_settings']['compilation_level']).PHP_EOL.PHP_EOL;
			}
			return call_user_func(array($minName, 'minify'), $content);
		}

		public function css_ob_handler($content, $old_file_name, $new_file_name)
		{
			extract($this->settings['css']);
			if (get_magic_quotes_runtime()) {
				$content = stripcslashes($content);
			}
			if (($merge == 2) || ($include_base64_images_into_css)){
				preg_match_all("/url\s*\(['\"\s]*([^\"'\)]+)['\"\s]*\)/", $content, $urls, PREG_SET_ORDER);
				$old = $old_file_name;
				$new = $new_file_name;
				$old_file_name = pathinfo($old_file_name);
				$old_file_name = $old_file_name['dirname'];
				$new_file_name = pathinfo($new_file_name);
				$new_file_name = $new_file_name['dirname'];

				$abs_filename = array();
				$replaced = array();
				foreach ($urls as $key => $value) {
					switch ($value[1]{0}) {
					case '/':
						break;
					case 'h':
						if (substr($value[1], 0, 5) == 'http:' || substr($value[1], 0, 6) == 'https:') {
							break;
						}
					case 'd':
						if (substr($value[1], 0, 5) == 'data:') {
							break;
						}
					case 'm':
						if (substr($value[1], 0, 6) == 'mhtml:') {
							break;
						}
					default :
						if ($merge == 2){
							$filepath = pathinfo($value[1]);
							if (!empty($this->settings['common']['cdn_addr']) && ($this->settings['common']['cdn_css_url'] == true)){
								$new_path = trim($this->settings['common']['cdn_addr'], '/').'/'.$this->rel_to_rel($new, $old, $filepath['dirname'], true);
							}else{
								$new_path = $this->rel_to_rel($new, $old, $filepath['dirname']);
							}
							$filename = trim($new_path, '/').'/'.$filepath['basename'];
							
							if (!array_key_exists($value[1], $replaced)){
								$content = 	str_replace($value[1], $filename, $content);
								$replaced[$value[1]] = true;
							}
						}
						if ($include_base64_images_into_css){
							$filepath = pathinfo($value[1]);
							$new_path = $this->rel_to_rel($new, $old, trim($filepath['dirname'], '/'));

							$filename = $new_path.$filepath['basename'];
							
							$f_name = realpath($new_file_name.'/'.$filename);
							if (!empty($f_name)) {
								if (!in_array($f_name, $not_include_base64_images_list, true)) {
									$file_size = filesize($f_name);
									if ($file_size < ($include_base64_images_max_size * 1024) || in_array($f_name, $include_once_base64_images_list, true)){
										$fp = fopen($f_name, 'r');
										$fs = fread($fp, $file_size);									
										$data = 'data:'.$this->GetMIMEType(strtolower($filepath['extension'])).';base64,'.base64_encode($fs);
										if ($merge == 2){
											$content = str_replace($filename, $data, $content);	
										}else{
											$content = str_replace($value[1], $data, $content);	
										}
										fclose($fp);
									}
								}
							}
						}
						break;
					}
				}
			}
			return $content;
		}
		private static function write_to_file($file_name, $content){
			//create uncompressed file
			$uncompressed_file_handle = fopen($file_name, 'w+');
			flock(	$uncompressed_file_handle, LOCK_EX);
			fwrite(	$uncompressed_file_handle, $content);
			flock(	$uncompressed_file_handle, LOCK_UN);
			fclose(	$uncompressed_file_handle);
			//create gzipped file
			$compressed_file_handle = fopen($file_name.'gz', 'w+');
			flock(	$compressed_file_handle, LOCK_EX);
			fwrite(	$compressed_file_handle, gzencode($content, 9));
			flock(	$compressed_file_handle, LOCK_UN);
			fclose(	$compressed_file_handle);
		}
		public static function rel_to_rel($new, $old, $uri, $abs = false){
		    $new = pathinfo($new);
		    $old = pathinfo($old);
		    $new = $new['dirname'];
		    $old = $old['dirname'];
		    $realpath = realpath($old.'/'.$uri);

		    while (substr_count($new, '//')) $new = str_replace('//', '/', $new);
		    while (substr_count($realpath, '//')) $realpath = str_replace('//', '/', $realpath);
		    while (substr_count($realpath, '\\')) $realpath = str_replace('\\', '/', $realpath);
		    $realpath = str_replace($_SERVER['DOCUMENT_ROOT'].'/', '', $realpath);
		    if (!$abs){
			    $arr1 = explode('/', $new);
			    if ($arr1 == array('')) $arr1 = array();
			    $arr2 = explode('/', $realpath);
			    if ($arr2 == array('')) $arr2 = array();
			    $size1 = count($arr1);
			    $size2 = count($arr2);
		 	   	$path='';
			    for($i=0; $i<min($size1,$size2); $i++)
			    {
			        if ($arr1[$i] == $arr2[$i]) continue;
			        else $path = '../'.$path.$arr2[$i].'/';
			    }
			    if ($size1 > $size2)
			        for ($i = $size2; $i < $size1; $i++)
			            $path = '../'.$path;
			    else if ($size2 > $size1)
			        for ($i = $size1; $i < $size2; $i++)
			            $path .= $arr2[$i].'/';
			    return $path;
			}else{
		    	return $realpath;
			}
		}
		public static function GetMIMEType($ext){
			switch ($ext) {
				case 'eot' : 	return 'application/vnd.ms-fontobject'; break;					
				case 'otf' : 	return 'application/x-font-opentype'; break;					
				case 'ttf' : 	return 'application/x-font-truetype'; break;					
				case 'woff' : 	return 'font/woff'; break;					
				case 'bmp' : 	return 'image/bmp'; break;							
				case 'cgm' : 	return 'image/cgm'; break;							
				case 'g3' : 	return 'image/g3fax'; break;							
				case 'gif' : 	return 'image/gif'; break;							
				case 'ief' : 	return 'image/ief'; break;							
				case 'jpeg' :						
				case 'jpg' :							
				case 'jpe' : 	return 'image/jpeg'; break;							
				case 'ktx' : 	return 'image/ktx'; break;							
				case 'png' : 	return 'image/png'; break;							
				case 'btif' : 	return 'image/prs.btif'; break;						
				case 'svg' : 						
				case 'svgz' : 	return 'image/svg+xml'; break;						
				case 'tiff' :							
				case 'tif' : 	return 'image/tiff'; break;							
				case 'psd' : 	return 'image/vnd.adobe.photoshop'; break;			
				case 'uvi' : 			
				case 'uvvi' : 			
				case 'uvg' : 			
				case 'uvvg' : 	return 'image/vnd.dece.graphic'; break;				
				case 'sub' : 	return 'image/vnd.dvb.subtitle'; break;				
				case 'djv' : 					
				case 'djvu' : 	return 'image/vnd.djvu'; break;						
				case 'dwg' : 	return 'image/vnd.dwg'; break;						
				case 'dxf' : 	return 'image/vnd.dxf'; break;						
				case 'fbs' : 	return 'image/vnd.fastbidsheet'; break;				
				case 'fpx' : 	return 'image/vnd.fpx'; break;						
				case 'fst' : 	return 'image/vnd.fst'; break;						
				case 'mmr' : 	return 'image/vnd.fujixerox.edmics-mmr'; break;		
				case 'rlc' : 	return 'image/vnd.fujixerox.edmics-rlc'; break;		
				case 'cur' : 	return 'image/vnd.microsoft.icon'; break;					
				case 'mdi' : 	return 'image/vnd.ms-modi'; break;					
				case 'mdi' : 	return 'image/vnd.ms-modi'; break;					
				case 'npx' : 	return 'image/vnd.net-fpx'; break;					
				case 'wbmp' : 	return 'image/vnd.wap.wbmp'; break;					
				case 'xif' : 	return 'image/vnd.xiff'; break;						
				case 'webp' : 	return 'image/webp'; break;							
				case 'ras' : 	return 'image/x-cmu-raster'; break;					
				case 'cmx' : 	return 'image/x-cmx'; break;							
				case 'fh' : 			
				case 'fhc' : 			
				case 'fh4' : 			
				case 'fh5' : 			
				case 'fh7' : 	return 'image/x-freehand'; break;					
				case 'ico' : 	return 'image/x-icon'; break;						
				case 'pcx' : 	return 'image/x-pcx'; break;							
				case 'pic' : 						
				case 'pct' : 	return 'image/x-pict'; break;						
				case 'pnm' : 	return 'image/x-portable-anymap'; break;				
				case 'pbm' : 	return 'image/x-portable-bitmap'; break;				
				case 'pgm' : 	return 'image/x-portable-graymap'; break;			
				case 'ppm' : 	return 'image/x-portable-pixmap'; break;				
				case 'rgb' : 	return 'image/x-rgb'; break;							
				case 'xbm' : 	return 'image/x-xbitmap'; break;						
				case 'xpm' : 	return 'image/x-xpixmap'; break;						
				case 'xwd' : 	return 'image/x-xwindowdump'; break;	
				default:
					return '';
				break;
			}				
		}
		public function file_is_local($href)
		{
			$path = parse_url(urldecode($href));
			if ($path['path']{0} == '/'){
				$path['path'] = substr($path['path'], 1);
			}
			if((isset($path['path'])) && file_exists($path['path'])){
				$result['result'] = true;
				$result['path'] = $path['path'];
			}else{
				$result['result'] = false;	
			}
			return $result;
		}

	}
	// autoload ******************************

	function __autoload($class_name) {
	    require(dirname(__FILE__).'/lib/'.$class_name . '.php');	}
	function simple_autoload($class_name) {
	    require(dirname(__FILE__).'/lib/'.$class_name . '.php');
	}
	spl_autoload_register('simple_autoload');
	
	// end autoload **************************
			
?>