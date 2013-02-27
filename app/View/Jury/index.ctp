<?php $this->Html->css('bdo/loadspinner', null, array('inline'=>false)); ?>

<div id="error"></div>
<h2>Wachten op deelnemer</h2>
<div class="load"></div>

<script>
	$(document).ready(function(){ refresh(); setInterval(refresh, 5000); });
   function refresh(){
   	$.get("<?= Router::url(array('action'=>'ready')) ?>")
		 .done(function(data){
		 		console.log(data); //leeg->watchen, 1->klaar
		 })
		 .fail(function(){
		 	$("#error").html('<div class="alert-box alert">Kan geen verbinding maken</div>');
		 });
   }
</script>