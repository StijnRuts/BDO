<tr class="level<?= $level; ?>">
	<th class="name"><?= h($point['Point']['name']); ?></th>

	<?php foreach($users as $user): ?>
		<td class="score">
			<?= isset($scores[$user['id']][$point['Point']['id']]) ?
				h($scores[$user['id']][$point['Point']['id']]) : '&nbsp;';
			?>
		</td>
	<?php endforeach; ?>

	<td class="subfield score"><?= h($point['Point']['min']); ?></td>
	<td class="subfield score"><?= h($point['Point']['max']); ?></td>
</tr>