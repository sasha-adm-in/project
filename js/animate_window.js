function runAjax(id, publ){
	$.ajax({
		type: "POST",
		data: {
			key: id,
			view: publ
		},
		url: "/ajax.php",
		dataType: "json",
		success: function(data){
			$(".comment_area").empty();	
			for (var i = 0; i < data["qq"].length; i++) {
				var row = data["qq"][i];					
				var r = row.id+","+row.public;					
				$(".comment_area").prepend(						
					"<input type='button' id='button_public_com' class='button_public_comment' value='Скрыть' onclick='runAjax("+r+");'/><p><small>"+row.name+"("+row.date+")</small><br/><span>"+row.comment+"</span></p>"
				
				);
				
			}
			$(".comment_area_nopublic").empty();	
			for (var i = 0; i < data["qqq"].length; i++) {
				var row = data["qqq"][i];
				var rr = row.id+","+row.public;
				$(".comment_area_nopublic").prepend(						
					"<input type='button' id='button_nopublic_comment' class='button_public_comment' value='Опубликовать'onclick='runAjax("+rr+");'/><p><small>"+row.name+"("+row.date+")</small><br/><span>"+row.comment+"</span></p>"							
				
				);

			}
		}
	});
}
$(function(){
	$(".hide").mouseenter(function(event){
		$(".right_banner").stop();
		$(".right_banner").animate({right:0},300);				
	})
	$(".right_banner").mouseleave(function(event){
		$(".right_banner").stop();
		$(".right_banner").animate({right:-280},500);
						
	})
	$(".right_banner_show2").click(function(event){
		$(".animate_window").animate({"margin-left":"-300"}, 300).animate({"height":"500"}, 600)
	})
	$("#animate_window_close").click(function(event){
		$(".animate_window").animate({"height":"150"}, 300).animate({"margin-left":"-1500"}, 300)
	})
	
	$("#create_comment").click(function(event){
		$(".comment").animate({"height":"600"});
	})	
	
	
});	