<h2>
	<?= $round['Contest']['name']; ?>
	<small>(<?= $round['Contest']['date']; ?>)</small>
</h2>
<h2>
	<?= $round['Discipline']['name']; ?>,
	<?= $round['Category']['name']; ?>,
	<?= $round['Division']['name']; ?>
</h2>

<table>
	<thead>
		<tr>
			<th>Startnr</th>
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
