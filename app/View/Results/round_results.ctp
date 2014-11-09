<h2><?= h($round['Contest']['name']); ?></h2>

<h3>
	<span class="nowrap"><?= $round['Discipline']['name']; ?>,</span>
	<span class="nowrap"><?= $round['Category']['name']; ?>,</span>
	<span class="nowrap"><?= $round['Division']['name']; ?></span>
</h3>

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
