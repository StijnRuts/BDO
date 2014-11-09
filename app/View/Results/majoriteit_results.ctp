<?php /* <h2><?= h($round['Contest']['name']); ?></h2> */ ?>

<h3>
	<span class="nowrap"><?= $round['Discipline']['name']; ?>,</span>
	<span class="nowrap"><?= $round['Category']['name']; ?>,</span>
	<span class="nowrap"><?= $round['Division']['name']; ?></span>
</h3>

<table class="majoriteit">
	<thead>
		<tr>
			<th>Startnr</th>
			<th>Deelnemer</th>
			<th>Club</th>
			<th>Plaats</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($majoriteit as $contestant): ?>
		<tr <?= $contestant['place']>=$minplace ? "" : 'class="hidden"' ?>>
			<td><?= h($contestant['startnr']); ?></td>
			<td><?= h($contestant['name']); ?></td>
			<td><?= h($contestant['Club']['name']); ?></td>
			<td class="score"><strong><?= $contestant['place'] ?></strong></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>


<style> .hidden { display:none; } </style>

<script type="text/javascript">
	$(function() {
		$(".hidden").show();
		$('th').each(function() {
			$(this).width( $(this).width() );
		});
		$(".hidden").hide();
	});
</script>