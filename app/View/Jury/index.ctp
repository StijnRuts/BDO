<div id="error"></div>
<h2>Wachten op deelnemer</h2>
<div class="load"></div>

<script>
	$(document).ready(checkStage);
	function checkStage(){
		$.get("<?= Router::url(array('action'=>'checkstage')) ?>")
		 .done(function(ready){
			if(ready) window.location.href = "<?= Router::url(array('action'=>'startjudging')) ?>";
			$("#error").html('');
		 })
		 .fail(function(){
			$("#error").html('<div class="alert-box alert">Kan geen verbinding maken</div>');
		 });
		setTimeout(checkStage, 5000);
	}
</script>