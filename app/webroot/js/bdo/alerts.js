$(function(){
	$(".alert-box").on("click", function(){
		$(this).slideUp(function(){ $(this).remove(); });
	});
});