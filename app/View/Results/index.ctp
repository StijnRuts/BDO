<div id="error"></div>
<div id="autorefresh"></div>

<script>
	$(document).ready(function(){ refresh(); setInterval(refresh, 5000); });
   function refresh(){
   	$.get("<?= Router::url(array('action'=>'results')) ?>")
		 .done(function(data){
		 		$("#autorefresh").html(data);
		 		$("#error").html("");
		 })
		 .fail(function(){
		 	$("#error").html('<div class="alert-box alert">Kan scorebord niet updaten</div>');
		 });
   }
</script>