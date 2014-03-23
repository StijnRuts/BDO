<div id="error"></div>
<h2>Wachten op deelnemer</h2>

<div class="load"></div>

<?php if(isset($round)): ?>
	<div>
		<h3>Eerdere beoordelingen</h3>
		<table>
			<tbody>
				<?php foreach($round['Contestant'] as $c): ?>
				<tr>
					<td><?= h($c['startnr']); ?>: <?= h($c['name']); ?></td>
					<td class="score"><strong><?= h($c['score']==0 ? '-' : $c['score']); ?></strong></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php endif; ?>


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
	$(window).bind('beforeunload', function() {
		$("#error").hide();
	});
</script>