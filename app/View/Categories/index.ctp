<table id="sortable">
	<thead>
		<tr>
			<th></th>
			<th>Categorienaam</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($categories as $category): ?>
		<tr id="Category_<?= $category['Category']['id']; ?>">
			<td class="sorthandle"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></td>
			<td class="sorthandle"><?= h($category['Category']['name']); ?></td>
			<td>
				<?= $this->Html->link(
					'<i class="f-icon-tools"></i>',
					array('action'=>'edit', $category['Category']['id']),
					array('escape'=>false, 'title'=>'Bewerk '.h($category['Category']['name']))
				); ?>
				<?= $this->Form->postLink(
					'<i class="f-icon-remove"></i>',
					array('action'=>'delete', $category['Category']['id']),
					array('escape'=>false, 'title'=>'Verwijder '.h($category['Category']['name'])),
					'Weet u zeker dat u '.h($category['Category']['name']).' wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="3" class="add">
				<?= $this->Html->link('Categorie toevoegen', array('action'=>'add'), array('class'=>'small secondary radius  button')); ?>
			</td>
		</tr>
	</tbody>
</table>

<?php $this->Sortable->init(); ?>
