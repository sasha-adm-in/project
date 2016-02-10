if (document.getElementsByClassName('lng_det')[0].innerHTML == 'rus') {$lngd='/rus'} else {$lngd=''}
$(document).ready(function() {
	/* Search */

	$('#search-me, .all_search').live('click', function() {

		var url = $('base').attr('href') + $lngd + '/index.php?route=product/search';
				 
		var search = $('#search-link').val();
		
		if (search) {
			url += '&search=' + encodeURIComponent(search);
		}
		
		location = url;
	});

    $('.slides').each(function() {
        //alert($(this).html());

        if ($(this).find('> li').html() == null) {
            $(this).parent().parent().remove();
        }
    });
	
	$('#search-link').bind('keydown', function(e) {
		if (e.keyCode == 13) {
			var url = $('base').attr('href') + $lngd + '/index.php?route=product/search';

            var search = $('#search-link').val();

            if (search) {
                url += '&search=' + encodeURIComponent(search);
            }

            location = url;
		}
	});

    $('body').click(function(e) {

         $('#search-link_cont_main').hide();

         if (e.target.id == 'search-link' && $('#search-link_cont').html() !== null) {
             $('#search-link_cont_main').show();
         }
    });
	
	/* Ajax Cart */
	$('#cart > .heading a').live('click', function() {
		$('#cart').addClass('active');
		
		$('#cart').load('index.php?route=module/cart #cart > *');
		
		$('#cart').live('mouseleave', function() {
			$(this).removeClass('active');
		});
	});
	
	/* Mega Menu */
	$('#menu ul > li > a + div').each(function(index, element) {
		// IE6 & IE7 Fixes
		if ($.browser.msie && ($.browser.version == 7 || $.browser.version == 6)) {
			var category = $(element).find('a');
			var columns = $(element).find('ul').length;
			
			$(element).css('width', (columns * 143) + 'px');
			$(element).find('ul').css('float', 'left');
		}		
		
		var menu = $('#menu').offset();
		var dropdown = $(this).parent().offset();
		
		i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#menu').outerWidth());
		
		if (i > 0) {
			$(this).css('margin-left', '-' + (i + 5) + 'px');
		}
	});

	// IE6 & IE7 Fixes
	if ($.browser.msie) {
		if ($.browser.version <= 6) {
			$('#column-left + #column-right + #content, #column-left + #content').css('margin-left', '195px');
			
			$('#column-right + #content').css('margin-right', '195px');
		
			$('.box-category ul li a.active + ul').css('display', 'block');	
		}
		
		if ($.browser.version <= 7) {
			$('#menu > ul > li').bind('mouseover', function() {
				$(this).addClass('active');
			});
				
			$('#menu > ul > li').bind('mouseout', function() {
				$(this).removeClass('active');
			});	
		}
	}
	
	$('.success img, .warning img, .attention img, .information img').live('click', function() {
		$(this).parent().fadeOut('slow', function() {
			$(this).remove();
		});
	});

    $('.maufacturers_list ul a').each(function() {
        if (location == $(this).attr('href')) {
            $(this).parent().parent().prev().addClass('current');
            $(this).addClass('current');
        }
    });
    
    var errors = false;
    
    $(".order_call").click(function() {
        showDialog(".popup_call");
    });
    
    $(".overlayExit, .popup_close").click(function() {
        $(".overlayExit, .popup_call").fadeOut();
    });
    
    $(".popup_call input[type='text']").focus(function() {
        $(this).removeClass('error_input');
        errors = false;
    });
    
    $(".popup_call a").click(function() {
        var name = $(this).parent().find("input[name='name']");
        var phone = $(this).parent().find("input[name='phone']");
        
        if (!name.val() || name.val().length < 2 || name.val() == 'Введіть Ваше ім\'я') {
            name.addClass('error_input');
            errors = true;
        }
        
        if (!phone.val() || phone.val().length < 5 || phone.val() == 'Введіть Ваш телефон') {
            phone.addClass('error_input');
            errors = true;
        }      
        
        if (!errors) {
            $.ajax({
                type: 'POST',
                url: 'system/library/sendmail.php',
                data: 'name=' + name.val() + '&phone=' + phone.val(),
                cache: false,
                success: function(response) {
                    if (response) {
                        $(".popup_call").fadeOut();
                        $(".message_sent").text(response);
                        showDialog('.message_sent');
//                        name.val('Введіть Ваше ім\'я');
//                        phone.val('Введіть Ваш телефон');
                        $('.overlayExit').delay(4000).fadeOut();
                        $('.message_sent').delay(4000).fadeOut();
                    }
                },
                
                error:function(xhr, status, errorThrown) { 
                     alert(errorThrown+'\n'+status+'\n'+xhr.statusText); 
                }        
            });
        }
    });

    $(window).resize(function() {
        resizeDialog('.popup_call');
    });
});

function showDialog(el) {
    $(el).css('left', ($(window).width()/2 - $(el).outerWidth()/2));
    $(el).css('top', ($(window).height()/2 - $(el).outerHeight()/2));
    $(".overlayExit").fadeIn();
    $(el).fadeIn();
}

function resizeDialog(el) {
    $(el).css('left', ($(window).width()/2 - $(el).outerWidth()/2));
    $(el).css('top', ($(window).height()/2 - $(el).outerHeight()/2));
}

function getURLVar(key) {
	var value = [];
	
	var query = String(document.location).split('?');
	
	if (query[1]) {
		var part = query[1].split('&');

		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');
			
			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}
		
		if (value[key]) {
			return value[key];
		} else {
			return '';
		}
	}
} 

function addToCart(product_id, quantity) {
    if (isNaN(quantity) && typeof(quantity) != 'undefined') {
        alert('Введіть число!');
        return false;    
    }
    
	quantity = typeof(quantity) != 'undefined' ? quantity : 1;

	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: 'product_id=' + product_id + '&quantity=' + quantity,
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information, .error').remove();
			
			if (json['redirect']) {
				location = json['redirect'];
			}
			
			if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
				
				$('.success').fadeIn('slow');

                $('.checkout').removeClass('hide');
                
				$('#cart').html('<div class="filled_cart"><span id="cart-total">' + json['total'] + '</span></div>');
				
				$('html, body').animate({ scrollTop: 0 }, 'slow'); 
                
                $(".success").delay(3000).fadeOut();
			}	
		}
	});
}
function addToWishList(product_id) {
	$.ajax({
		url: 'index.php?route=account/wishlist/add',
		type: 'post',
		data: 'product_id=' + product_id,
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information').remove();
						
			if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
				
				$('.success').fadeIn('slow');
				
				$('#wishlist-total').html(json['total']);
				
				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}	
		}
	});
}

function addToCompare(product_id, el) {

	$.ajax({
		url: 'index.php?route=product/compare/add',
		type: 'post',
		data: 'product_id=' + product_id,
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information').remove();
						
			if (json['success']) {
				//$('#notification2').html('<center><div class="success" style="display:none; height:150px; width: 300px; line-height:30px; padding:10px 10px 10px 20px">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div></center>');
				$('#notification2').html('<center><div class="success" style="display:none; height:138px; width: 300px; line-height:30px; padding:10px 10px 10px 20px"><img src="catalog/view/theme/res_final/image/success.png" alt="" style="padding:0 5px 0 0;" />' + json['success'] + '</div></center>');
				
				$('.success').fadeIn('slow');

                if (typeof el != 'undefined') {
					if (document.getElementsByClassName('lng_det')[0].innerHTML == 'rus') {$lngd='/rus'} else {$lngd=''}
					if ($lngd=='/rus') {$comptxt='В сравнении'} else {$comptxt='В порівнянні'}
					el.href = $lngd + '/compare-products/';
                    el.innerHTML = $comptxt;
                    el.removeAttribute('onclick');
                }
				
				$('#compare-total').html(json['total']);
                
                $('.compare').removeClass('hide');
				
				//$('html, body').animate({ scrollTop: 0 }, 'slow'); 
				MoveCenterScreen('notification2');
                
                $(".success").delay(1500).fadeOut();
			}	
		}
	});
}

function MoveCenterScreen(objID) {
var innerHeight_ = window.innerHeight ? window.innerHeight : document.documentElement.offsetHeight;
var obj = document.getElementById(objID);
obj.style.left = ( document.body.clientWidth / 2 - obj.clientWidth / 2 + document.body.scrollLeft) + 'px';
obj.style.top = ( document.documentElement.scrollTop + innerHeight_ / 2 - obj.clientHeight / 2 + document.body.scrollTop) + 'px';
}