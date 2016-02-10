function bra_mobile_menu(){

	var $menu = $( "#primary-menu" ).clone();
	$menu.find("ul").removeClass("menu");
	$menu.find("ul").removeAttr("style");
	$menu.find("li").each(function() {
		if($(this).find('> ul').length > 0) {
			 $(this).addClass('has-ul');
			 $(this).find('> a').append('<span class="sf-sub-indicator"></span>');
		}
		if($(this).find('> a').length > 0) {
			 $(this).addClass('active');
		}
	})
	$(".header").append('<div id="three-lines-menu"><a href="#">&equiv;</a></div>');
	$("#header-wrapper").after("<div id='mobile-menu'><div class='container'>" + $menu.html() + "</div></div>");

	$('#three-lines-menu').click(function(){
		$('#mobile-menu').stop(true,true).slideToggle(300);
		return false;
	});
	
	$('#mobile-menu .container ul li ul').hide();
	
	$('#mobile-menu .container ul li:has(">ul") > a .sf-sub-indicator').click(function(){
		$(this).parent().parent().toggleClass('open');
		$(this).parent().parent().find('> ul').stop(true,true).slideToggle();
		return false;
	});
}

function bra_add_sticky(add_sticky){
	var window_w = $(window).width();
	var header = $('#header-wrapper').offset().top;
	var fullwidth_h = $("#header-wrapper").prev("div").outerHeight();
	//var header = 60;
	//alert(header + " | " + fullwidth_h);
	var order = $('#header-wrapper').prev("div").length;

	if (order) header = fullwidth_h; else header = 0; 

	//alert(header + " + " + fullwidth_h);
	
	if( (window_w > 960) && ($(window).scrollTop() > header) && add_sticky) {
		//alert("inicijalni sticky " + order)
		$('#header-wrapper').addClass("sticky");
		
	}

	if ( (window_w > 960) && add_sticky){
		
		$(window).scroll(function(){
				
			if( $(window).scrollTop() > header) {
				$('#header-wrapper').addClass("sticky");
				
			} else {
				$('#header-wrapper').removeClass("sticky");
				
			}
		});		
	} else {
		$(window).unbind('scroll');
		$('#header-wrapper').removeClass("sticky");
		
	}
	
	

}

bra_sticky = true
jQuery(document).ready(function($) {
	bra_mobile_menu();
	bra_add_sticky(bra_sticky);
})

jQuery(window).resize(function() {
	bra_add_sticky(bra_sticky);
})





