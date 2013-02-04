<table>
	<thead>
		<tr>
			<th>Wedstrijdnaam</th>
			<th>Datum</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($contests as $contest): ?>
		<tr>
			<td class="linkbutton"><?= $this->Html->link(
				h($contest['Contest']['name']),
				array('action'=>'rounds', $contest['Contest']['id']),
				array('escape'=>false, 'title'=>'Beheer rondes voor '.h($contest['Contest']['name']))
			); ?></td>
			<td><?= h($contest['Contest']['date']); ?></td>
			<td>
				<?= $this->Html->link(
					'<i class="f-icon-tools"></i>',
					array('action'=>'edit', $contest['Contest']['id']),
					array('escape'=>false, 'title'=>'Bewerk '.h($contest['Contest']['name']))
				); ?>
				<?= $this->Form->postLink(
					'<i class="f-icon-remove"></i>',
					array('action'=>'delete', $contest['Contest']['id']),
					array('escape'=>false, 'title'=>'Verwijder '.h($contest['Contest']['name'])),
					'Weet u zeker dat u '.h($contest['Contest']['name']).' wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3" class="add">
				<?= $this->Html->link('Wedstrijd toevoegen', array('action'=>'add'), array('class'=>'small secondary radius  button')); ?>
			</td>
		</tr>
	</tfoot>
</table>
