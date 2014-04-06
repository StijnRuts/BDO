<style type="text/css">
	.place {

		text-align: center;
	}
</style>

<?php /* <h2><?= h($round['Contest']['name']); ?></h2> */ ?>

<h3>
	<span class="nowrap"><?= $round['Discipline']['name']; ?>,</span>
	<span class="nowrap"><?= $round['Category']['name']; ?>,</span>
	<span class="nowrap"><?= $round['Division']['name']; ?></span>
</h3>

<table class="majoriteit">
	<thead>
		<tr>
			<th></th>
			<th>Deelnemer</th>
			<?php foreach($users as $user): ?>
				<th><?= h($user['username']) ?></th>
			<?php endforeach; ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($majoriteit as $contestant): ?>
		<tr <?= $contestant['startnrorder']<=$startnr ? "" : 'class="hidden"' ?>>
			<td><?= h($contestant['startnr']); ?></td>
			<td><?= h($contestant['name']); ?></td>
			<?php foreach($contestant['places'] as $place): ?>
				<td class="place"><strong><?= h($place); ?></strong></td>
			<?php endforeach; ?>
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