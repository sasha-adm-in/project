<?php
// Heading
$_['heading_title']                	= 'Настройки Mcj
';
$_['text_author']                	= 'Если у Вас есть идеи по улучшению и расширению функциональности этого модуля, а так же вопросы прошу посетить <span class="filename"></span>';
$_['text_yes']                      = 'Да';
$_['text_no']                       = 'Нет';
$_['text_enabled']                  = 'Включено';
$_['text_disabled']                 = 'Отключено';
$_['text_none']                     = ' --- Не выбрано --- ';
$_['text_select']                   = ' --- Выберите --- ';
$_['text_select_all']               = 'Выделить все';
$_['text_unselect_all']             = 'Снять выделение';
$_['text_kb']             			= 'Кб';

//Cache manager column names
$_['text_empty']             		= 'Нет элементов';
$_['text_not_found']             	= 'Битая запись в кеше. Файл не найден.';
$_['text_column_filename']          = 'Имя файла';
$_['text_column_cdate']             = 'Дата создания';
$_['text_column_contain_files']     = 'Файлы';
$_['text_column_size']             	= 'Размеры файлов';
$_['text_column_percent']           = 'Процент минимизации, компрессии';
$_['text_file_original']      		= 'Оригинальный';
$_['text_file_minimized']      		= 'Минимизированный';
$_['text_file_gzipped']      		= 'Сжатый';
$_['text_average_rating']      		= 'Средний результат:';
$_['text_dir_check_success']      	= '&nbsp;Выбранная папка доступна для записи.';
$_['text_dir_check_failed']      	= '&nbsp;Выбранная папка недоступна для записи.';
$_['text_dir_check_demo']      		= '&nbsp;У Вас нет прав для использования этой функции. Демо режим.';

// Text Common
$_['tab_common']				   					= 'Общие';
	$_['text_success']                 				= 'Настройки успешно изменены';
	$_['text_use_static_gzip']                 		= 'Использовать Gzip сжатие: <br /><span class="help">Передавать сжатые css и js.</span>';
	$_['text_use_ultra_cache']                 		= 'Использовать быстрое кеширование:<br /><span class="help">Отключает проверку даты последнего изменения файлов.</span>';
	$_['text_minify_html']                 			= 'Сжимать HTML код:<br />';
	$_['text_dir_cache_css']                 		= 'Папка для хранения css:';
	$_['text_dir_cache_js']                 		= 'Папка для хранения js:';
	$_['text_delivery_systems']                 	= 'CDN (Content Delivery Network):<br /><span class="help">В формате "http://ooo.ru".</span>';
	$_['text_delivery_systems_js']                 	= 'JavaScript:';
	$_['text_delivery_systems_css']                	= 'CSS:';
	$_['text_delivery_systems_imgs']               	= 'Images:';
	$_['text_delivery_systems_cssurl']              = 'CSS URL:';
	$_['text_debug_mode']                 			= 'Режим отладки:<br /><span class="help">На страницах каталога будет показана информация о работе оптимизатора.</span>';
	$_['text_help_file']                 			= 'Генерировать файл помощи:<br /><span class="help">Создает архив с информацией об окружении Вашего магазина.</span>';
	$_['text_help_file_gen']                 		= 'Генерировать';
	$_['text_optimize_db']       	          		= 'Оптимизировать базу данных:<br /><span class="help">Оптимизирует базу данных магазина средствами MySQL.</span>';
	$_['text_optimixe_db_button']              		= 'Начать';
	$_['text_success_db_optim']              		= 'База данных успешно оптимизирована.';

$_['text_html_minimize_library']                 	= 'Библиотека минимизации:';
	$_['text_html_minimize_library_Minify_HTML']                 = 'Minify HTML:';
	$_['text_html_minimize_library_HTMLMinRegex']                = 'HTMLMin Regex:';
// Text CSS
$_['tab_css']					   					= 'CSS';
	$_['text_css_processing']                 		= 'Обрабатывать css файлы:';
	$_['text_css_not_processing_list']              = 'Список файлов исключенных из обработки:';
	$_['text_css_merge']                 			= 'Режим объединения:';
		$_['text_css_merge_0']                 		= 'Не объединять';
		$_['text_css_merge_1']                 		= 'Объединять группой в папках';
		$_['text_css_merge_2']                 		= 'Объединить в один файл';
	$_['text_css_not_merge_list']                 	= 'Список файлов исключенных из объединения:';
	$_['text_css_minimize']                 		= 'Минимизировать:';
	$_['text_css_not_minimize_list']                = 'Список файлов исключенных из минимизации:';
	$_['text_css_stay_position_list']               = 'Список позиционных стилей: <br /><span class="help">Список файлов, которые необходимо оставить на своих местах в коде страницы. (не будут объединены)</span>';
	$_['text_css_minimize_library']                 = 'Библиотека минимизации:';
		$_['text_library_css_cssmin'] 									= 'CssMin';
			$_['text_cssmin_settings']             						= 'Настройки CssMin';
			$_['text_cssmin_plugins']             						= 'Plugins';
				$_['text_cssmin_plugin_Variables']             			= 'Variables:';
				$_['text_cssmin_plugin_ConvertFontWeight']             	= 'Convert font weight:';
				$_['text_cssmin_plugin_ConvertHslColors']             	= 'Convert HLS colors:';
				$_['text_cssmin_plugin_ConvertRgbColors']             	= 'Convert RGB colors:';
				$_['text_cssmin_plugin_ConvertNamedColors']            	= 'Convert named colors:';
				$_['text_cssmin_plugin_CompressColorValues']            = 'Compress color values:';
				$_['text_cssmin_plugin_CompressUnitValues']            	= 'Compress unit values:';
				$_['text_cssmin_plugin_CompressExpressionValues']       = 'Compress expression values:';
			$_['text_cssmin_filters']             						= 'Filters';
				$_['text_cssmin_filter_RemoveComments']             	= 'Remove comments:';
				$_['text_cssmin_filter_RemoveEmptyRulesets']            = 'Remove empty rules:';
				$_['text_cssmin_filter_RemoveEmptyAtBlocks']            = 'Remove empty at block:';
				$_['text_cssmin_filter_ConvertLevel3Properties']        = 'Convert level 3 proporties:';
				$_['text_cssmin_filter_Variables']             			= 'Variables:';
				$_['text_cssmin_filter_RemoveLastDelarationSemiColon']  = 'Remove last delaration semi colon:';
		$_['text_library_css_CssMinRegex'] 				= 'CssMinRegex';
		$_['text_library_css_Minify_YUI_CssCompressor'] = 'YUI CSS Compressor PHP port';
		$_['text_library_css_canCSSMini'] 				= 'canCSSMini';
	$_['text_css_include_base64_images_into_css']   = 'Вставлять base64 изображения в css:';
	$_['text_css_include_base64_images_max_size']   = 'Максимальный размер файла изображения для вставки (КБ):';
	$_['text_css_include_once_base64_images_list']  = 'Список изображений которые необходимо вставить не смотря на размер:';
	$_['text_css_not_include_base64_images_list']   = 'Список изображений, которые не будут вставлены:';


//Text JS
$_['tab_js']					   					= 'JavaScript';
	$_['text_js_processing']                 		= 'Обрабатывать js файлы:';
	$_['text_js_not_processing_list']               = 'Список файлов исключенных из обработки:';
	$_['text_js_merge']                 			= 'Режим объединения:';
		$_['text_js_merge_0']                 		= 'Не объединять';
		$_['text_js_merge_1']                 		= 'Объединять группой в папках';
		$_['text_js_merge_2']                 		= 'Объединить в один файл';
	$_['text_js_not_merge_list']                 	= 'Список файлов исключенных из объединения:';
	$_['text_js_minimize']                 			= 'Минимизировать:';
	$_['text_js_not_minimize_list']                 = 'Список файлов исключенных из минимизации:';
	$_['text_js_stay_position_list']               	= 'Список позиционных скриптов: <br /><span class="help">Список файлов, которые необходимо оставить на своих местах в коде страницы. (не будут объединены)</span>';
	$_['text_js_minimize_library']                 	= 'Библиотека минимизации:';
		$_['text_library_js_gcc'] 					= 'Google Clousure Compiler (Curl)';
			$_['text_gcc_settings']             	= 'Настройки Google Clousure Compiler';
			$_['text_gcc_compilation_level']        = 'Уровень сжатия:<br /><span class="help">Рекомендуется значение "Только пробелы".</span>';
			$_['text_gcc_compilation_level_1']      = 'Только пробелы';
			$_['text_gcc_compilation_level_2']      = 'Простая оптимизация';
			$_['text_gcc_compilation_level_3']      = 'Расширенная оптимизация';
		$_['text_library_js_jsmin'] 				= 'JsMinPlus';
		$_['text_library_js_JShrink'] 				= 'JShrink';
		$_['text_library_js_JavaScriptPacker'] 		= 'JavaScriptPacker';
	$_['text_js_put_to_body']                 		= 'Вставлять JavaScript в тег body';
	$_['text_js_use_jquery_cdn']                 	= 'Использовать CDN для JQuery:';
	$_['text_js_jquery_version']                 	= 'Версия JQuery:';


$_['tab_cache_manager']								= 'Менеджер кеша';
$_['tab_htaccess']									= '.htaccess';
$_['text_htaccess_author']							= 'Показать рекомендуемое содержимое файла .htaccess';
$_['text_apache_modules']							= 'Список подключенных модулей Apache';

$_['tab_help']										= 'Помощь';
// Buttons
$_['button_save']					   				= 'Сохранить';
$_['button_cancel']					   				= 'Отмена';
$_['button_delete']             					= 'Удалить выбранные';
$_['button_select_css']             				= 'Выбрать всe css';
$_['button_select_js']             					= 'Выбрать все js';

//Errors
$_['error_permission']             					= 'Внимание: у Вас нет прав для редактирования этого раздела!';
$_['error_permission_edit']             			= 'Внимание: у Вас нет прав для редактирования файла .htaccess!';
$_['htaccess_not_found']							= 'Файл .htaccess не найден.';
$_['htaccess_not_writable']							= 'Нет прав на запись в файл .htaccess';
$_['htaccess_havent_gz']							= 'В файл .htaccess необходимо внести изменения.';
$_['htaccess_have_gz']								= 'В файле .htaccess уже есть все необходимые изменения.';
?>
