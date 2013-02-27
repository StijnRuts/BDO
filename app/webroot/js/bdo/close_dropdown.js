$(function(){
	$(".dropdown ul a").bind("click", function(){
		$(this).closest("ul").removeClass("show-dropdown");
	})
});