// JavaScript Document

$(document).ready(function() {
// Форма обратной связи................................./

var regVr22 = "<div><img style='margin-bottom:-4px;' src='/backform/load.gif' alt='Отправка...' width='32' height='32'><span style='font: 11px Verdana; color:#333; margin-left:6px;'></span></div><br />";

$("#send").click(function(){
		$("#loadBar").html(regVr22).show();
		var posName = $("#posName").val();
		var posCompany = $("#posCompany").val();
		//var posEmail = $("#posEmail").val();
		var posPhone = $("#posPhone").val();
		var posText = $("#posText").val();
		$.ajax({
			type: "POST",
			url: "/backform/send.php",
			data: {"posName": posName, "posCompany": posCompany, /*"posEmail": posEmail,*/ "posPhone": posPhone, "posText": posText},
			cache: false,
			success: function(response){
		var messageResp = "<p style='font-family:Verdana; font-size:11px; color:green; border:1px solid #00CC00; padding:10px; margin:20px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; background-color:#fff;'>Спасибо, <strong>";
		var resultStat = "!</strong> Ваше сообщение отправлено!</p>";
		var oll = (messageResp + posName + resultStat);
				if(response == 1){
				$("#loadBar").html(oll).fadeIn(1000).delay(2000).fadeOut(1000);
				$("#posName").val("");
				$("#posCompany").val("");
				//$("#posEmail").val("");
				$("#posPhone").val("");
				$("#posText").val("");
				} else {
		$("#loadBar").html(response).fadeIn(1000).delay(2000).fadeOut(1000); }
										}
		});
		return false;
});


});