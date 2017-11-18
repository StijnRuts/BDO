<tr class="level<?= $level; ?>">
	<th class="name"><?= h($point['Point']['name']); ?></th>

	<?php foreach($users as $user): ?>
		<td class="score">
			<?= isset($scores[$user['id']][$point['Point']['id']]) ?
				h($scores[$user['id']][$point['Point']['id']]) : '&nbsp;';
			?>
		</td>
	<?php endforeach; ?>

  <?php $field = $print ? 'th' : 'td'; ?>
	<<?= $field; ?> class="subfield score"><?= h($point['Point']['max']); ?></<?= $field; ?>>
</tr>