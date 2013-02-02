<table>
	<thead>
		<tr>
			<th>Divisienaam</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($divisions as $division): ?>
		<tr>
			<td><?= h($division['Division']['name']); ?></td>
			<td>
				<?= $this->Html->link(
					'<i class="icon-tools"></i>',
					array('action'=>'edit', $division['Division']['id']),
					array('escape'=>false, 'title'=>'Bewerk '.h($division['Division']['name']))
				); ?>
				<?= $this->Form->postLink(
					'<i class="icon-remove"></i>',
					array('action'=>'delete', $division['Division']['id']),
					array('escape'=>false, 'title'=>'Verwijder '.h($division['Division']['name'])),
					'Weet u zeker dat u '.h($division['Division']['name']).' wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="2" class="add">
				<?= $this->Html->link('Divisie toevoegen', array('action'=>'add'), array('class'=>'small secondary radius  button')); ?>
			</td>
		</tr>
	</tbody>
</table>
