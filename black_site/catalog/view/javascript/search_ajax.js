// JavaScript Document
function SearchAjax(input_id, radio) {
	var id = $(input_id).attr('id');
	
	if (!id) {
		$(input_id).attr('id', 'id' + Math.round (Math.random () * 1000000));
	}
	
	var id = $(input_id).attr('id');
	
	html  = '<div id="' + id + '_cont_main" class="search_ajax_cont">';
	html += '<div id="' + id + '_cont_param"><div class="search_ajax_close">x</div>';
	html += radio;
	html += '</div></div>';
	
	$('input#' + id).after(html);
	
	$('div#' + id + '_cont_main').hide();
	
	$(input_id).live('keyup', function () {
		var value = $('input#' + id).attr('value');
		var key = $('div#' + id + '_cont_main input[type=radio]:checked').attr('value');
		if(value) {
			getContent(id, value, key, 1);
		} else {
			$('div#' + id + '_cont_main').hide();
		}
	});
	
	$('div#' + id + '_cont_main div.search_ajax_close').live('click', function() {$('div#' + id + '_cont_main').hide()});
	
	$('div#' + id + '_cont_main input[type=radio]').click(function(){
		var value = $('input#' + id).attr('value');
		var key = $(this).attr('value');
		getContent(id, value, key, 1);
		$('input#' + id).focus();
	});
	
	$('div#' + id + '_cont_main .prevPage, div#' + id + '_cont_main .nextPage').live('click', function () {
		var value = $('input#' + id).attr('value');
		var key = $('div#' + id + '_cont_main input[type=radio]:checked').attr('value');
		var page = $(this).html();
		getContent(id, value, key, page);
		$('input#' + id).focus();
	});
}

function getContent(id, value, key, page) {
	$.ajax({
		url: 'index.php?route=product/search_ajax',
		type: 'get',
		dataType: 'json',
		data: 'filter_name=' + encodeURIComponent(value) + '&key=' + key + '&page=' + page,
		success: function(data) {
			if (data['products']) {
				$('div#' + id + '_cont').replaceWith('');
				$('div#' + id + '_cont_param').after('<div id="' + id + '_cont"></div>');
				$('div.search_ajax_cont').css({'z-index':'10000'})
				$('div#' + id + '_cont').html(data['products']);
				$('div#' + id + '_cont_main').css({'z-index':'10001'}).show();
			} else {
				$('div#' + id + '_cont').hide();
			}
		}
	});
}