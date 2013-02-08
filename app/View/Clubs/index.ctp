<table>
	<thead>
		<tr>
			<th>Clubnaam</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($clubs as $club): ?>
		<tr>
			<td><?= h($club['Club']['name']); ?></td>
			<td>
				<?= $this->Html->link(
					'<i class="f-icon-tools"></i>',
					array('action'=>'edit', $club['Club']['id']),
					array('escape'=>false, 'title'=>'Bewerk '.h($club['Club']['name']))
				); ?>
				<?= $this->Form->postLink(
					'<i class="f-icon-remove"></i>',
					array('action'=>'delete', $club['Club']['id']),
					array('escape'=>false, 'title'=>'Verwijder '.h($club['Club']['name'])),
					'Weet u zeker dat u '.h($club['Club']['name']).' wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2" class="tablebutton">
				<?= $this->Html->link('Club toevoegen', array('action'=>'add'), array('class'=>'small secondary radius  button')); ?>
			</td>
		</tr>
	</tfoot>
</table>
