<table>
	<thead>
		<tr>
			<th>Beoordelingspunt</th>
			<th>Jurylid</th>
			<th>Deelnemer</th>
			<th>Score</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($scores as $score): ?>
		<tr>
			<td><?= h($score['Point']['name']); ?></td>
			<td><?= h($score['User']['username']); ?></td>
			<td><?= h($score['Contestant']['name']); ?></td>
			<td><?php echo h($score['Score']['score']); ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $score['Score']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
