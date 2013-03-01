<tr class="level<?= $level; ?>">
	<th class="name"><?= h($point['Point']['name']); ?></th>

	<td class="score">
		<?= isset($scores[$user_id][$point['Point']['id']]) ?
			h($scores[$user_id][$point['Point']['id']]) : '&nbsp;';
		?>
	</td>

	<td class="subfield score"><?= h($point['Point']['min']); ?></td>
	<td class="subfield score"><?= h($point['Point']['max']); ?></td>
</tr>