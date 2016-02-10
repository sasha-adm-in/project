<?php
class agooMultilang extends Controller
{
	private $langcode_all;
	private $languages_all;

	public function __construct($registry)
	{
		parent::__construct($registry);

		$code_array  = $this->config->get('general_set');

		$code        = '';
		$code_cookie = '';
		$code_flag   = false;
		$code_parefix= '';

		$ajax        = false;
		$slash       = false;

		if (isset($this->request->cookie['language'])) {
			$code_cookie = $this->request->cookie['language'];
		}
		if (isset($this->session->data['language'])) {
			$code_cookie = $this->session->data['language'];
		}
		if (isset($this->request->get['_route_'])) {
			$route = urldecode($this->request->get['_route_']);
		} else {
			$route = '';
		}



		$prev_code = $this->session->data['language'];

		if (isset($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$ajax = true;
		}

		if (isset($this->request->get['route']))
		{
			if (utf8_strpos(utf8_strtolower($this->request->get['route']),'quickview') !== false) {
             $ajax = true;
			}
			if (utf8_strpos(utf8_strtolower($this->request->get['route']),'search') !== false) {
             $ajax = true;
			}
			if (utf8_strpos(utf8_strtolower($this->request->get['route']),'assets') !== false) {
             $ajax = true;
			}
			if (utf8_strpos(utf8_strtolower($this->request->get['route']),'captcha') !== false) {
             $ajax = true;
			}
		}

		if (isset($this->request->server['HTTP_ACCEPT']))
		{
			if (strpos(strtolower($this->request->server['HTTP_ACCEPT']),strtolower('image')) !== false) {

             	if (strpos(strtolower($this->request->server['HTTP_ACCEPT']),strtolower('html')) !== false) {
                    $ajax = false;
				} else {
					$ajax = true;
				}
            }
			if (strpos(strtolower($this->request->server['HTTP_ACCEPT']),strtolower('json')) !== false) {
             $ajax = true;
			}

			if (strpos(strtolower($this->request->server['HTTP_ACCEPT']),strtolower('ajax')) !== false) {
             $ajax = true;
			}

			if (strpos(strtolower($this->request->server['HTTP_ACCEPT']),strtolower('javascript')) !== false) {
             $ajax = true;
			}
		}

		if ($ajax) {
			$parts       = explode('/', trim(utf8_strtolower($route), '/'));
			$parts_first = $parts[0];
			foreach ($code_array['prefix'] as $lang_code => $prefix) {
				$prefix = urldecode($prefix);
				if ($lang_code == $code_cookie && $route == '') {
					$route = $prefix;
					break;
				}
			}
		}

		$languages = array();
		$query     = $this->db->query("SELECT * FROM " . DB_PREFIX . "language WHERE status = '1'");
		foreach ($query->rows as $result) {
			$languages[$result['code']] = $result;
			$this->langcode_all[$result['code']]         = $result;
			$this->languages_all[$result['language_id']] = $result;
		}

		$parts       = explode('/', trim(utf8_strtolower($route), '/'));

       $request_uri = urldecode($this->request->server['REQUEST_URI']);

        if ($request_uri !=  $this->request->server['REQUEST_URI'] && count($parts) == 1) {
        	$this->request->server['REQUEST_URI'] = trim($this->request->server['REQUEST_URI'],'/');
        }

		$parts_first = $parts[0];
		if (!$ajax) {
			foreach ($code_array['prefix'] as $lang_code => $prefix) {
                $prefix = urldecode($prefix);
				if (trim(utf8_strtolower($parts[0]), '/') == trim(utf8_strtolower($prefix), '/') && trim(utf8_strtolower($prefix), '/') != '') {
  					$code_parefix = $code_array['prefix'][$lang_code];
					$code_flag    = true;
					$code         = $lang_code;
					if ($prefix[strlen($prefix) - 1] == '/') {
						$slash = true;
					}
					break;
				}
				if (trim(utf8_strtolower($prefix), '/') == '' && !$code_flag) {
						$code_parefix                    = $code_array['prefix'][$lang_code];
						$code_flag                       = false;
						$code                            = $lang_code;
						$this->session->data['language'] = $code;

				}
			}
		}


		if ($code_flag) {
			unset($parts[0]);
		}
		if (isset($this->request->post['language_code'])) {
			$code = $this->session->data['language'] = $this->request->post['language_code'];
		}

		if ($code == '' && !$ajax) {
			header($this->request->server['SERVER_PROTOCOL'] . ' 301 Moved Permanently');
			if ($code_cookie == '') {
				$code_cookie = $this->config->get('config_language');
			}
			$pref = trim($code_array['prefix'][$code_cookie], '/');
			if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
				$config_ssl = substr($this->config->get('config_ssl'), 0, $this->strpos_offset('/', $this->config->get('config_ssl'), 3) + 1);
				$url        = str_replace('&amp;', '&', $config_ssl . $pref . '/' . ltrim($request_uri, '/'));
			} else {
				$domen = substr($this->config->get('config_url'), 0, $this->strpos_offset('/', $this->config->get('config_url'), 3) + 1);
				$url   = str_replace('&amp;', '&', $domen . $pref . '/' . ltrim($request_uri, '/'));
			}
			$this->response->redirect($url);
		}

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$domen = substr($this->config->get('config_ssl'), 0, $this->strpos_offset('/', $this->config->get('config_ssl'), 3) + 1);
			$config_url = $this->config->get('config_ssl');
		} else {
			$domen = substr($this->config->get('config_url'), 0, $this->strpos_offset('/', $this->config->get('config_url'), 3) + 1);
			$config_url = $this->config->get('config_url');
		}

		$request_uri = str_replace($config_url, '' ,ltrim(trim($domen, '/').'/' . ltrim($request_uri, '/'),'/'));

		$url       = str_replace('&amp;', '&', $domen . '/' . ltrim($request_uri, '/'));

		$slash_end = '';
		$seo_url   = ltrim($request_uri, '/');


		if (isset($request_uri[strlen($request_uri) - 1]) && $request_uri[strlen($request_uri) - 1] == '/' && strlen($request_uri) > 1) {
			$slash_end = '/';
		}
		  $parts       = explode('/', trim(utf8_strtolower($request_uri), '/'));
          $parts_route = explode('/', trim(utf8_strtolower($route), '/'));

		if (isset($code_array['pagination']) && $code_array['pagination']) {
		        /* for seo pagination */
				$parts_end = end($parts_route);
				if (strpos($parts_end, $code_array['pagination_prefix'].'-') !== false || strpos($parts_end, 'page-') !== false) {
						list($key, $value) = explode("-", $parts_end);
						if ($value != 1) {
							$this->request->get['page'] = $value;
						}
			   				$title = $this->document->getTitle();
			   				$description = $this->document->getDescription();

								$this->document->setTitle($title .  ' '.$code_array['pagination_title'][$this->config->get('config_language')].' ' . $this->registry->get('langmark_page'));
								$this->document->setDescription($description .  ' '.$code_array['pagination_title'][$this->config->get('config_language')].' ' . $this->registry->get('langmark_page'));
						$this->registry->set('langmark_page', $value);
						unset($parts_route[count($parts_route) - 1]);
						//unset($parts[count($parts) - 1]);

		        reset($parts_route);

		       }
		        /* for seo pagination */
        }


		$parts_first = $parts[0];

		foreach ($code_array['prefix'] as $lang_code => $prefix) {
			$prefix = urldecode($prefix);
  			//if ($parts[0] == trim(utf8_strtolower($prefix), '/') && trim(utf8_strtolower($prefix), '/') != '') {
			if (trim(utf8_strtolower($parts_first), '/') == trim(utf8_strtolower($prefix), '/') && trim(utf8_strtolower($prefix), '/') != '') {
				$code_parefix = $code_array['prefix'][$lang_code];
				$code_flag    = true;
				$code         = $lang_code;
				if ($prefix[strlen($prefix) - 1] == '/') {
					$slash = true;
				}
				unset($parts_route[0]);
				unset($parts[0]);
				$seo_url = implode("/", $parts) . $slash_end;
				break;
			}
		}

          // echo  $code_parefix;

         $this->registry->set('langmark_url', $seo_url);
         $this->registry->set('langmark_prefix', $code_parefix);
       /*
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
			$this->config->set('config_ssl', $server.$code_parefix );
		} else {
			$server = $this->config->get('config_url');
			$this->config->set('config_url', $server.$code_parefix );
		}
        */

		foreach ($code_array['prefix'] as $lang_code => $prefix) {
			$prefix = urldecode($prefix);
			if (isset($prefix[strlen($prefix) - 1]) && $prefix[strlen($prefix) - 1] != '/' && $seo_url != '')
				$del = "/";
			else
				$del = '';
			if ($seo_url == '' || $seo_url == '/') {
				$del     = '';
				$seo_url = '';
			}
			$seourl[$lang_code] = $prefix . $del . $seo_url;
		}

		foreach ($languages as $result) {
			$languages[$result['code']]['url'] = $config_url . $seourl[$result['code']];
		}
		$this->registry->set('langmarkdata', $languages);


		if (!$ajax) {

			if ($prev_code != $code) {
				if (isset($code_array['currency'][$code]) && $code_array['currency'][$code]!='') {
	              $this->currency->set($code_array['currency'][$code]);
				}

			}


			setcookie('language', $code, time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
			$this->session->data['language'] = $code;
			$this->config->set('config_language_id', $languages[$code]['language_id']);
			$this->config->set('config_language', $languages[$code]['code']);

			$language = new Language($languages[$code]['directory']);
			$language->load($languages[$code]['filename']);
			$this->registry->set('language', $language);


			// $this->switchLanguage($languages[$code]['language_id'], $code);

		}

		if (isset($this->request->get['_route_'])) {
			$this->request->get['_route_'] = implode("/", $parts_route);
		}
		// unset($this->request->get['_route_']);
		if (isset($this->request->get['route']) || empty($parts_route)) {
			unset($this->request->get['_route_']);
		}

	}

	public function switchLanguage($language_id, $code)
	{
		if (isset($this->request->get['_route_'])) {
			$this->session->data['language'] = $code;
			setcookie('language', $code, time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
			$this->config->set('config_language_id', $language_id);
			$this->config->set('config_language', $code);
			$language = new Language($this->langcode_all[$code]['directory']);
			$language->load($this->langcode_all[$code]['filename']);
			$this->registry->set('language', $language);
			$this->session->data['language_old'] = $code;
		}
	}


	private function getQueryString($exclude = array()) {
		if (!is_array($exclude)) {
				$exclude = array();
			}

		return urldecode(http_build_query(array_diff_key($this->request->get, array_flip($exclude))));
		}

	private function strpos_offset($needle, $haystack, $occurrence)
	{
		// explode the haystack
		$arr = explode($needle, $haystack);
		// check the needle is not out of bounds
		switch ($occurrence) {
			case $occurrence == 0:
				return false;
			case $occurrence > max(array_keys($arr)):
				return false;
			default:
				return strlen(implode($needle, array_slice($arr, 0, $occurrence)));
		}
	}
}
?>