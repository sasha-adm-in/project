<?php 
	/**
	* Google clousure compiler
	* @author Shashakhmetov Talgat <talgatks@gmail.com>
	*/
	class GoogleClousureCompiler
	{
		static $instance;
		var $urls = array('http://closure-compiler.appspot.com/compile','s');
		const URL = 'http://closure-compiler.appspot.com/compile';

		public static function minify($content, $compilation_level = 'WHITESPACE_ONLY')
		{
			if(!self::$instance)
				self::$instance = new GoogleClousureCompiler;
			$fields = array(
				'js_code'           => $content, //Content of javascript file
			    'compilation_level' => $compilation_level, // WHITESPACE_ONLY SIMPLE_OPTIMIZATIONS ADVANCED_OPTIMIZATIONS
			    'output_format'     => 'text',
			    'output_info'       => 'compiled_code'
				);
			$fields_string = '';
			$fields['js_code'] = urlencode($fields['js_code']);
			if (!function_exists('curl_version')){
				throw new GoogleClousureCompiler_Exception(
					"Google clousure compiler can't work wothout Curl or disabled allow_url_fopen."
				);
			}else{	
				foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			    rtrim($fields_string, '&');				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, self::URL);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));
				curl_setopt($ch, CURLOPT_POST, count($fields));
	            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
				$content = curl_exec($ch);
				curl_close($ch);
				if (empty($content)) {
					die('\/* Curl is does not work or you try compress empty file */');
				}
			}
			return $content;
		//}

	}}
	class GoogleClousureCompiler_Exception extends Exception 
	{

	}
?>