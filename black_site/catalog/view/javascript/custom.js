function is_touch_device() {
  return !!('ontouchstart' in window);
}

/*--------------------------------------------------
		  DROPDOWN MENU
---------------------------------------------------*/
/*
 * jQuery Superfish Menu Plugin - v1.7.4
 * Copyright (c) 2013 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 *	http://www.opensource.org/licenses/mit-license.php
 *	http://www.gnu.org/licenses/gpl.html
 */

;(function(e){"use strict";var s=function(){var s={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",menuArrowClass:"sf-arrows"},o=function(){var s=/iPhone|iPad|iPod/i.test(navigator.userAgent);return s&&e(window).load(function(){e("body").children().on("click",e.noop)}),s}(),n=function(){var e=document.documentElement.style;return"behavior"in e&&"fill"in e&&/iemobile/i.test(navigator.userAgent)}(),t=function(e,o){var n=s.menuClass;o.cssArrows&&(n+=" "+s.menuArrowClass),e.toggleClass(n)},i=function(o,n){return o.find("li."+n.pathClass).slice(0,n.pathLevels).addClass(n.hoverClass+" "+s.bcClass).filter(function(){return e(this).children(n.popUpSelector).hide().show().length}).removeClass(n.pathClass)},r=function(e){e.children("a").toggleClass(s.anchorClass)},a=function(e){var s=e.css("ms-touch-action");s="pan-y"===s?"auto":"pan-y",e.css("ms-touch-action",s)},l=function(s,t){var i="li:has("+t.popUpSelector+")";e.fn.hoverIntent&&!t.disableHI?s.hoverIntent(u,p,i):s.on("mouseenter.superfish",i,u).on("mouseleave.superfish",i,p);var r="MSPointerDown.superfish";o||(r+=" touchend.superfish"),n&&(r+=" mousedown.superfish"),s.on("focusin.superfish","li",u).on("focusout.superfish","li",p).on(r,"a",t,h)},h=function(s){var o=e(this),n=o.siblings(s.data.popUpSelector);n.length>0&&n.is(":hidden")&&(o.one("click.superfish",!1),"MSPointerDown"===s.type?o.trigger("focus"):e.proxy(u,o.parent("li"))())},u=function(){var s=e(this),o=d(s);clearTimeout(o.sfTimer),s.siblings().superfish("hide").end().superfish("show")},p=function(){var s=e(this),n=d(s);o?e.proxy(f,s,n)():(clearTimeout(n.sfTimer),n.sfTimer=setTimeout(e.proxy(f,s,n),n.delay))},f=function(s){s.retainPath=e.inArray(this[0],s.$path)>-1,this.superfish("hide"),this.parents("."+s.hoverClass).length||(s.onIdle.call(c(this)),s.$path.length&&e.proxy(u,s.$path)())},c=function(e){return e.closest("."+s.menuClass)},d=function(e){return c(e).data("sf-options")};return{hide:function(s){if(this.length){var o=this,n=d(o);if(!n)return this;var t=n.retainPath===!0?n.$path:"",i=o.find("li."+n.hoverClass).add(this).not(t).removeClass(n.hoverClass).children(n.popUpSelector),r=n.speedOut;s&&(i.show(),r=0),n.retainPath=!1,n.onBeforeHide.call(i),i.stop(!0,!0).animate(n.animationOut,r,function(){var s=e(this);n.onHide.call(s)})}return this},show:function(){var e=d(this);if(!e)return this;var s=this.addClass(e.hoverClass),o=s.children(e.popUpSelector);return e.onBeforeShow.call(o),o.stop(!0,!0).animate(e.animation,e.speed,function(){e.onShow.call(o)}),this},destroy:function(){return this.each(function(){var o,n=e(this),i=n.data("sf-options");return i?(o=n.find(i.popUpSelector).parent("li"),clearTimeout(i.sfTimer),t(n,i),r(o),a(n),n.off(".superfish").off(".hoverIntent"),o.children(i.popUpSelector).attr("style",function(e,s){return s.replace(/display[^;]+;?/g,"")}),i.$path.removeClass(i.hoverClass+" "+s.bcClass).addClass(i.pathClass),n.find("."+i.hoverClass).removeClass(i.hoverClass),i.onDestroy.call(n),n.removeData("sf-options"),void 0):!1})},init:function(o){return this.each(function(){var n=e(this);if(n.data("sf-options"))return!1;var h=e.extend({},e.fn.superfish.defaults,o),u=n.find(h.popUpSelector).parent("li");h.$path=i(n,h),n.data("sf-options",h),t(n,h),r(u),a(n),l(n,h),u.not("."+s.bcClass).superfish("hide",!0),h.onInit.call(this)})}}}();e.fn.superfish=function(o){return s[o]?s[o].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof o&&o?e.error("Method "+o+" does not exist on jQuery.fn.superfish"):s.init.apply(this,arguments)},e.fn.superfish.defaults={popUpSelector:"ul,.sf-mega",hoverClass:"sfHover",pathClass:"overrideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},animationOut:{opacity:"hide"},speed:"normal",speedOut:"fast",cssArrows:!0,disableHI:!1,onInit:e.noop,onBeforeShow:e.noop,onShow:e.noop,onBeforeHide:e.noop,onHide:e.noop,onIdle:e.noop,onDestroy:e.noop},e.fn.extend({hideSuperfishUl:s.hide,showSuperfishUl:s.show})})(jQuery);


/*--------------------------------------------------
	     ADDITIONAL CODE FOR DROPDOWN MENU
---------------------------------------------------*/
    jQuery(document).ready(function($) { 
        $('ul.menu').superfish({ 
            delay:       100,                            // one second delay on mouseout 
            animation:   {height:'show'},  // fade-in and slide-down animation 
            speed:       'fast',                          // faster animation speed 
            autoArrows:  false,                           // disable generation of arrow mark-up 
			onShow: function(){
			  $(this).css("overflow", "visible");
			}
        });
	}); 


/*--------------------------------------------------
  STICKY FOOTER
---------------------------------------------------*/
jQuery(window).load(function() {  

 var footer_fixed = true;
 
 if( is_touch_device() || !footer_fixed){
  jQuery('#footer, #wrapper').css({'position':'static', 'z-index':'0'});
  jQuery('#wrapper:last').css("margin-bottom", "0"); 
  jQuery("#footer").removeClass("fixed");
 
 } else {
  var wrapper_margin_bottom = jQuery('#footer').outerHeight()+'px';
   jQuery("#wrapper").after('<div style="height:' + wrapper_margin_bottom + '; float:left; width:100%;"></div>'); 
   jQuery("#footer").addClass("fixed");
 } 
});


/*--------------------------------------------------
	 BACK TO TOP
---------------------------------------------------*/
jQuery(document).ready(function($){
	$("#back-top").hide();
	
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		$('#back-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
}); 


/*--------------------------------------------------
	    PORTFOLIO ITEM IMAGE HOVER
---------------------------------------------------*/
$(window).load(function(){
						   
	$(".portfolio-grid ul li .item-info-overlay").hide();
	
	if( is_touch_device() ){
		$(".portfolio-grid ul li").click(function(){
												  
			var count_before = $(this).closest("li").prevAll("li").length;
			
			var this_opacity = $(this).find(".item-info-overlay").css("opacity");
			var this_display = $(this).find(".item-info-overlay").css("display");
			
			
			if ((this_opacity == 0) || (this_display == "none")) {
				$(this).find(".item-info-overlay").fadeTo(250, 1);
			} else {
				$(this).find(".item-info-overlay").fadeTo(250, 0);
			}
			
			$(this).closest("ul").find("li:lt(" + count_before + ") .item-info-overlay").fadeTo(250, 0);
			$(this).closest("ul").find("li:gt(" + count_before + ") .item-info-overlay").fadeTo(250, 0);	

		});	

	}
	else{	
			$(".portfolio-grid ul li").hover(function(){
				$(this).find(".item-info-overlay").fadeTo(250, 1);
				}, function() {
					$(this).find(".item-info-overlay").fadeTo(250, 0);		
			});
		
		}	
	
});


/*--------------------------------------------------
	  DUPLICATE H3 & H4 IN PORTFOLIO
---------------------------------------------------*/
$(window).load(function(){
						  
	$(".item-info").each(function(i){
		$(this).next().prepend($(this).html())
	});
});


/*--------------------------------------------------
	     TOGGLE
---------------------------------------------------*/
jQuery(document).ready(function($) {
								
	$(".toggle-container").hide(); 
	$(".trigger").toggle(function(){
		$(this).addClass("active");
		}, function () {
		$(this).removeClass("active");
	});
	$(".trigger").click(function(){
		$(this).next(".toggle-container").slideToggle();
	});
});


/*--------------------------------------------------
	     ACCORDION PLUGIN
---------------------------------------------------*/
(function($){
    $.fn.extend({
        bra_accordion: function(options) {
 
            var defaults = {
                active: 1 //which tab should be openned by default. 0 for all closed.
            };

            var options = $.extend(defaults, options);
         
            return this.each(function() {
			  var o = options;
			  var obj = $(this); 
			  var obj_id = "#" + obj.attr("id");

				active_plus = o.active - 1;
				$(this).find('.accordion').hide();
				
				if (o.active > 0) {
					$(this).find(".trigger-button:eq(" + active_plus + ")").addClass("active"); //Activate tab and content from declaration
					$(this).find(".accordion:eq(" + active_plus + ")").slideDown('normal');; 
				}
				
				$(this).find('.trigger-button').click(function() {
					$(obj_id + " .trigger-button").removeClass("active")
					$(obj_id + ' .accordion').slideUp('normal');
					if($(this).next().is(':hidden') == true) {
						$(this).next().slideDown('normal');
						$(this).addClass("active");
					 } 
				 });
				

 
            }); // return this.each
        }
    });
})(jQuery);



/*--------------------------------------------------
					TABS PLUGIN
---------------------------------------------------*/
(function($){
    $.fn.extend({
        bra_tabs: function(options) {
 
            var defaults = {
                active: 1 //which tab should be openned by default. 0 for all closed.
            };

            var options = $.extend(defaults, options);
         
            return this.each(function() {
			  var o = options;
			  var obj = $(this); 
			  var obj_id = "#" + obj.attr("id");

				//Default Action
				$(this).next(".tab_container").find(".tab_content").hide(); //Hide all content
				if (o.active > 0) {
					$(this).find("li:nth-child(" + o.active + ")").addClass("active").show(); //Activate tab and content from declaration
					$(this).next(".tab_container").find(".tab_content:nth-child(" + o.active + ")").show(); 
				}
				
				//On Click Event
				$(this).find("li").click(function() {
					$(obj_id + " li").removeClass("active"); //Remove any "active" class
					$(this).addClass("active"); //Add "active" class to selected tab
					$(obj_id).next(".tab_container").find(".tab_content").hide(); //Hide all tab content
					var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
					$(activeTab).fadeIn(); //Fade in the active content
					return false;
				});

 
            }); // return this.each
        }
    });
})(jQuery);


/*--------------------------------------------------
	  			SLIDING GRAPH
---------------------------------------------------*/
jQuery(document).ready(function($){
								
	function isScrolledIntoView(id)
	{
		var elem = "#" + id;
		var docViewTop = $(window).scrollTop();
		var docViewBottom = docViewTop + $(window).height();
	
		if ($(elem).length > 0){
			var elemTop = $(elem).offset().top;
			var elemBottom = elemTop + $(elem).height();
		}

		return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom)
		  && (elemBottom <= docViewBottom) &&  (elemTop >= docViewTop) );
	}	
	
	function sliding_horizontal_graph(id, speed){
		//alert(id);
		$("#" + id + " li span").each(function(i){
			var j = i + 1; 										  
			var cur_li = $("#" + id + " li:nth-child(" + j + ") span");
			var w = cur_li.attr("class");
			cur_li.animate({width: w + "%"}, speed);
		})
	}
	
	function graph_init(id, speed){
		$(window).scroll(function(){
			if (isScrolledIntoView(id)){
				sliding_horizontal_graph(id, speed);
			}
			else{
				//$("#" + id + " li span").css("width", "0");
			}
		})
		
		if (isScrolledIntoView(id)){
			sliding_horizontal_graph(id, speed);
		}
	}
	
	graph_init("example-1", 1000);	

});


/*--------------------------------------------------
	  ADD MASK LAYER
---------------------------------------------------*/
$(window).load(function(){						
	var $item_mask = $("<div />", {"class": "item-mask"});
	$("ul.shaped .item-container, .parallax-background, .photostream a").append($item_mask)
})


/*--------------------------------------------------
	  ARCHIVE PAGE TABS
---------------------------------------------------*/
jQuery(document).ready(function($){
	$('.archive-nav > div').slideUp();
	$('#archive-nav li a').click(function(){
		var li_ord = $(this).parent().prevAll().length;
		var li_ord_plus = li_ord + 1;		
		if ($('.archive-nav div:nth-child(' + li_ord_plus + ')').css("display") == "none"){			
			$('.archive-nav div:visible').slideUp();
			$('.archive-nav div:nth-child(' + li_ord_plus + ')').slideDown();
		}
		else{
			$('.archive-nav div:visible').slideUp();
		}				
		return false;
	})

});


/*--------------------------------------------------
	     TOGGLE STYLE
---------------------------------------------------*/
/*jQuery(document).ready(function($) {
    $('#archive-nav a').click(function(){
        $('#archive-nav a').removeClass("active");
        $(this).addClass("active");
    });
    
    $(".left_nav > ul > li").each(function() {
         if ($(this).find("> ul").html()!=null) {
            $(this).addClass("link_bg");
         }
         if ($(this).find("> ul").html()==null) {
            $(this).addClass("no_bg");
         }
     })
     $('.shade label span').click(function(){
        $('.shade label span').removeClass("opa");
        $(this).addClass("opa");
    });
     
});*/

/*-------------FOR SITE---------*/

$(function() {
         $(".left_nav > ul > li > a").click(function() {
             $(this).toggleClass("current");
             return false;
         });
         
         //$(".left_nav ul ul li > a").click(function() {
//             $(".left_nav ul ul li a").removeClass("current");
//             $(this).addClass("current");
//             return false;
//         });
         
        //$(".left_sidebar a").click(function(){
//            $(".left_sidebar ul li a").removeClass("current")
//            $(this).addClass("current");
//        })
     
         $('#prod_tabs a').click(function() {
            if ($(this).attr('class') != $('#prod_tabs').attr('class') ) {
                $('#prod_tabs').attr('class',$(this).attr('class'));
            }
        });
        
        $(document).on('click', '#cart_tabs > a', function() {
            if ($(this).attr('class') != $('#cart_tabs').attr('class') ) {
                $('#cart_tabs').attr('class',$(this).attr('class'));
            }
        });
        
        $('#new_cust  label span').click(function() {
            if ($(this).attr('class') != $('#new_cust').attr('class') ) {
                $('#new_cust').attr('class',$(this).attr('class'));
            }
        });
        
        $(".login_field input").focus(function () {
            $(".login_field").css('display','block');
            $(".login  a").css("background-color","#84b625");
            $(".login  a").css("color","#fff");
            
        });
        
          $(document).mouseup(function (e) {
            var container = $(".login_field");
            if (container.has(e.target).length === 0){
                container.hide();
                $(".login > a").removeAttr("style");
            }
        });
        
        $(".table_del").click(function () {
          $(this).parent().remove();
        });
        
        if (!$.cookie('view')) {
           $.cookie('view', 'view_block');
        }
        
        $(".view_type > a").removeClass("current");
        
        if ($.cookie('view') == 'view_block') {
            $("#view_block").addClass("current");
        } else {
            $("#view_list").addClass("current");
        }
        
        $(".view_type > a").click(function(){
           $(".view_type > a").removeClass("current");
           $(this).addClass("current");
           
           $.cookie('view', $(this).attr('id'));
           
           if ( $("#view_block").hasClass("current") ) {
               $('#prod_section .one-third').removeClass('view_list');
           }
           
           if ( $("#view_list").hasClass("current") ) {
               $('#prod_section .one-third').addClass('view_list');
           }          
        }); 
        
         
     });        


