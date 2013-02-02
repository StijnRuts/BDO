$(function(){
	function hidemessage(){ $(this).slideUp(function(){ $(this).remove(); }); };
	$(".flash_info").on("click", hidemessage);
	$(".flash_success").on("click", hidemessage);
	$(".flash_error").on("click", hidemessage);
});