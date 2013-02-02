<table>
	<thead>
		<tr>
			<th>Startnr</th>
			<th>Naam</th>
			<th>Club</th>
			<th>Discipline</th>
			<th>Categorie</th>
			<th>Divisie</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contestants as $contestant): ?>
		<tr>
			<td class="startnr"><?= h($contestant['Contestant']['startnr']); ?></td>
			<td><?= h($contestant['Contestant']['name']); ?></td>
			<td><?= h($contestant['Club']['name']); ?></td>
			<td><?= h($contestant['Discipline']['name']); ?></td>
			<td><?= h($contestant['Category']['name']); ?></td>
			<td><?= h($contestant['Division']['name']); ?></td>
			<td>
				<?= $this->Html->link(
					'<i class="icon-tools"></i>',
					array('action'=>'edit', $contestant['Contestant']['id']),
					array('escape'=>false, 'title'=>'Bewerk '.h($contestant['Contestant']['name']))
				); ?>
				<?= $this->Form->postLink(
					'<i class="icon-remove"></i>',
					array('action'=>'delete', $contestant['Contestant']['id']),
					array('escape'=>false, 'title'=>'Verwijder '.h($contestant['Contestant']['name'])),
					'Weet u zeker dat u '.h($contestant['Contestant']['name']).' wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="7" class="add">
				<?= $this->Html->link('Lid toevoegen', array('action'=>'add'), array('class'=>'small secondary radius  button')); ?>
			</td>
		</tr>
	</tbody>
</table>
