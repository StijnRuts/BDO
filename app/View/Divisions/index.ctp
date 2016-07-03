<table id="sortable">
	<thead>
		<tr>
			<th></th>
			<th>Divisienaam</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($divisions as $division): ?>
		<tr id="Division_<?= $division['Division']['id']; ?>">
			<td class="sorthandle"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></td>
			<td class="sorthandle"><?= h($division['Division']['name']); ?></td>
			<td>
				<?= $this->Html->link(
					'<i class="f-icon-tools"></i>',
					array('action'=>'edit', $division['Division']['id']),
					array('escape'=>false, 'title'=>'Bewerk '.h($division['Division']['name']))
				); ?>
				<?= $this->Form->postLink(
					'<i class="f-icon-remove"></i>',
					array('action'=>'delete', $division['Division']['id']),
					array('escape'=>false, 'title'=>'Verwijder '.h($division['Division']['name'])),
					'Weet u zeker dat u '.h($division['Division']['name']).' wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3" class="tablebutton">
				<?= $this->Html->link('Divisie toevoegen', array('action'=>'add'), array('class'=>'small secondary radius  button')); ?>
			</td>
		</tr>
	</tfoot>
</table>

<?php $this->Sortable->init(null, '#sortable tbody'); ?>
