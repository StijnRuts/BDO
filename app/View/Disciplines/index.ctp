<table>
	<thead>
		<tr>
			<th>Disciplinenaam</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($disciplines as $discipline): ?>
		<tr>
			<td><?= h($discipline['Discipline']['name']); ?></td>
			<td>
				<?= $this->Html->link(
					'<i class="icon-tools"></i>',
					array('action'=>'edit', $discipline['Discipline']['id']),
					array('escape'=>false, 'title'=>'Bewerk '.h($discipline['Discipline']['name']))
				); ?>
				<?= $this->Form->postLink(
					'<i class="icon-remove"></i>',
					array('action'=>'delete', $discipline['Discipline']['id']),
					array('escape'=>false, 'title'=>'Verwijder '.h($discipline['Discipline']['name'])),
					'Weet u zeker dat u '.h($discipline['Discipline']['name']).' wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="2" class="add">
				<?= $this->Html->link('Discipline toevoegen', array('action'=>'add'), array('class'=>'small secondary radius  button')); ?>
			</td>
		</tr>
	</tbody>
</table>