$('#search-me').click(function(){
    var link = $('#search-link').val();
    location.href = '/index.php?route=product/search&search='+link;
});

$('#search-example').click(function(){
	$('#search-link').focus();
	$('#search-link').val('лампа').delay(1800);
	
});

$('#phone_field').mouseover(function(){
	$('.phone_field').css('display','block');
	$('#phone_field').css('background','#84b625');
	$('#phone_field').css('cursor','pointer');
});
$('#phone_field').mouseout(function(){
	$('.phone_field').css('display','none');
	$('#phone_field').css('background','none');
	$('#phone_field').css('color','#4e4f51');
});
$('.phone_field').mouseover(function(){
	$('.phone_field').css('display','block');
	$('#phone_field').css('background','#84b625');
	$('#phone_field').css('cursor','pointer');
	$('#phone_field').css('color','white');
});
$('.phone_field').mouseout(function(){
	$('.phone_field').css('display','none');
	$('#phone_field').css('background','none');
	$('#phone_field').css('color','#4e4f51');
});

$('#confirm').click(function(){
var link = '/index.php?route=checkout/simplecheckout';
location.href = link;
});