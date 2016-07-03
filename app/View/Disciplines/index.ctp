<table id="sortable">
	<thead>
		<tr>
			<th></th>
			<th>Disciplinenaam</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($disciplines as $discipline): ?>
		<tr id="Discipline_<?= $discipline['Discipline']['id']; ?>">
			<td class="sorthandle"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></td>
			<td class="sorthandle"><?= h($discipline['Discipline']['name']); ?></td>
			<td>
				<?= $this->Html->link(
					'<i class="f-icon-tools"></i>',
					array('action'=>'edit', $discipline['Discipline']['id']),
					array('escape'=>false, 'title'=>'Bewerk '.h($discipline['Discipline']['name']))
				); ?>
				<?= $this->Form->postLink(
					'<i class="f-icon-remove"></i>',
					array('action'=>'delete', $discipline['Discipline']['id']),
					array('escape'=>false, 'title'=>'Verwijder '.h($discipline['Discipline']['name'])),
					'Weet u zeker dat u '.h($discipline['Discipline']['name']).' wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3" class="tablebutton">
				<?= $this->Html->link('Discipline toevoegen', array('action'=>'add'), array('class'=>'small secondary radius  button')); ?>
			</td>
		</tr>
	</tfoot>
</table>

<?php $this->Sortable->init(null, '#sortable tbody'); ?>
