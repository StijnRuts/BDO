<h2>
	<?= $round['Discipline']['name']; ?>,
	<?= $round['Category']['name']; ?>,
	<?= $round['Division']['name']; ?>
</h2>

<table>
	<thead>
		<tr>
			<th></th>
			<th>Deelnemer</th>
			<th>Punten</th>
			<th>Totaal</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($round['Contestant'] as $contestant): ?>
		<tr>
			<td><?= h($contestant['startnr']); ?></td>
			<td><?= h($contestant['name']); ?></td>
			<td>
				<?php foreach($contestant['scores']['users'] as $user): ?>
				<span class="filler">
					<?php for($i=0; $i<3-strlen(h($contestant['scores']['scores'][$user['id']]['total'])); $i++) echo "0"; ?>
				</span>
				<span class="score <?= $user['id']==$contestant['scores']['min'] ? 'min' : '' ?> <?= $user['id']==$contestant['scores']['max'] ? 'max' : '' ?>">
					<?= h($contestant['scores']['scores'][$user['id']]['total']); ?>
				</span>
				<?php endforeach; ?>
			</td>
			<td class="total score"><?= h($contestant['scores']['total']); ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
