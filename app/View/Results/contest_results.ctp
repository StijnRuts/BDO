<h2><?= h($contest['Contest']['name']); ?></h2>

<?php foreach($contest['Round'] as $round): ?>

<h3>
	<?= $round['Discipline']['name']; ?>,
	<?= $round['Category']['name']; ?>,
	<?= $round['Division']['name']; ?>
</h3>

<table>
	<thead>
		<tr>
			<th></th>
			<th>Deelnemer</th>
			<th>Club</th>
			<th>Punten</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($round['Contestant'] as $contestant): ?>
		<tr>
			<td><?= h($contestant['startnr']); ?></td>
			<td><?= h($contestant['name']); ?></td>
			<td><?= h($contestant['Club']['name']); ?></td>
			<td class="total score"><?= h($contestant['scores']['total']); ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php endforeach; ?>
