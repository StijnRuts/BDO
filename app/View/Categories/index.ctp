<table>
	<thead>
		<tr>
			<th>Categorienaam</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($categories as $category): ?>
		<tr>
			<td><?= h($category['Category']['name']); ?></td>
			<td>
				<?= $this->Html->link(
					'<i class="icon-tools"></i>',
					array('action'=>'edit', $category['Category']['id']),
					array('escape'=>false, 'title'=>'Bewerk '.h($category['Category']['name']))
				); ?>
				<?= $this->Form->postLink(
					'<i class="icon-remove"></i>',
					array('action'=>'delete', $category['Category']['id']),
					array('escape'=>false, 'title'=>'Verwijder '.h($category['Category']['name'])),
					'Weet u zeker dat u '.h($category['Category']['name']).' wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="2" class="add">
				<?= $this->Html->link('Categorie toevoegen', array('action'=>'add'), array('class'=>'small secondary radius  button')); ?>
			</td>
		</tr>
	</tbody>
</table>
