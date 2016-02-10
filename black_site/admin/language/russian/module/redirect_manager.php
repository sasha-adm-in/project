<?php

$version = 'v156.2';

// Heading
$_['heading_title']				= 'Перенаправление';

// Buttons
$_['button_save_exit']			= 'Сохранить и выйти';
$_['button_save_keep_editing']	= 'Сохранить';
$_['button_import_csv']			= 'Импорт CSV';
$_['button_export_csv']			= 'Экспорт CSV';
$_['button_reset_all']			= 'Сбросить всё';
$_['button_delete_all']			= 'Удалить всё';
$_['button_add_row']			= 'Добавить';

// Entries
$_['entry_sort_by']				= 'Сортировать:';
$_['entry_order']				= 'Порядок:';
$_['entry_ascending']			= 'Восходящий';
$_['entry_descending']			= 'Низходящий';
$_['entry_status']				= 'Статус:';
$_['entry_active']				= 'Включён';
$_['entry_from_url']			= 'От URL';
$_['entry_to_url']				= 'К URL';
$_['entry_date_start']			= 'Дата начала';
$_['entry_date_end']			= 'Дата окончания';
$_['entry_response_code']		= 'Код ответа';
$_['entry_times_used']			= 'Используемое время';

// Text
$_['text_help']					= '
	<ol class="help" style="margin: 0; line-height: 1.5">
		<li>Используйте звездочку (символ *), чтобы включать маски в От URL. Это будет соответствовать 0 и более символов для этой части URL.<br />
			Вы также можете использовать групповые символы в связке К URL, чтобы перенаправить с помощью шаблона(ов) в От URL.</li>
	</ol>';
$_['text_moved_permanently']	= '301 Переехал навсегда';
$_['text_found']				= '302 Найденный';
$_['text_temporary_redirect']	= '307 Временное перенаправление';
$_['text_warning']				= 'Внимание: Эта операция не может быть отменена. Продолжить?';

// Copyright
$_['copyright']					= '<div style="text-align: center" class="help"> *** </div>';

// Standard Text
$_['standard_module']			= 'Модули';
$_['standard_shipping']			= 'Доставка';
$_['standard_payment']			= 'Оплата';
$_['standard_total']			= 'Всего заказов';
$_['standard_feed']				= 'Product Feeds';
$_['standard_success']			= 'Успех: Вы изменили ' . $_['heading_title'] . '!';
$_['standard_error']			= 'Внимание: Вы не имеете прав для изменения ' . $_['heading_title'] . '!';
?>