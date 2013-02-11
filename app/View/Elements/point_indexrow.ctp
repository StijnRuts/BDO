<tr class="level<?= $level; ?>">
	<td class="ordering-arrows">
		<?= $this->Html->link(
			'<i class="f-icon-up-arrow"></i>',
			array('action'=>'moveup', $points['Point']['id']),
			array('escape'=>false, 'title'=>h($points['Point']['name'].' naar boven verplaatsen'))
		); ?>
		<?= $this->Html->link(
			'<i class="f-icon-down-arrow"></i>',
			array('action'=>'movedown', $points['Point']['id']),
			array('escape'=>false, 'title'=>h($points['Point']['name'].' naar onder verplaatsen'))
		); ?>
	</td>
	<td class="name"><?= h($points['Point']['name']); ?></td>
	<td><?= h($points['Point']['min']); ?></td>
	<td><?= h($points['Point']['max']); ?></td>
	<td>
		<?= $this->Html->link(
			'<i class="f-icon-tools"></i>',
			array('action'=>'edit', $points['Point']['id']),
			array('escape'=>false, 'title'=>'Bewerk '.h($points['Point']['name']))
		); ?>
		<?= $this->Form->postLink(
			'<i class="f-icon-remove"></i>',
			array('action'=>'delete', $points['Point']['id']),
			array('escape'=>false, 'title'=>'Verwijder '.h($points['Point']['name'])),
			'Weet u zeker dat u '.h($points['Point']['name']).' wilt verwijderen?'
		); ?>
	</td>
</tr>