<tr class="level<?= $level; ?>">
	<td class="ordering-arrows">
		<?= $this->Form->postLink(
			'<i class="f-icon-up-arrow"></i>',
			array('action'=>'moveup', $point['Point']['id']),
			array('escape'=>false, 'title'=>h($point['Point']['name'].' naar boven verplaatsen'))
		); ?>
		<?= $this->Form->postLink(
			'<i class="f-icon-down-arrow"></i>',
			array('action'=>'movedown', $point['Point']['id']),
			array('escape'=>false, 'title'=>h($point['Point']['name'].' naar onder verplaatsen'))
		); ?>
	</td>
	<td class="name"><?= h($point['Point']['name']); ?></td>
	<td><?= h($point['Point']['max']); ?></td>
	<td>
		<?= $this->Html->link(
			'<i class="f-icon-tools"></i>',
			array('action'=>'edit', $point['Point']['id']),
			array('escape'=>false, 'title'=>'Bewerk '.h($point['Point']['name']))
		); ?>
		<?= $this->Form->postLink(
			'<i class="f-icon-remove"></i>',
			array('action'=>'delete', $point['Point']['id']),
			array('escape'=>false, 'title'=>'Verwijder '.h($point['Point']['name'])),
			'Weet u zeker dat u '.h($point['Point']['name']).' wilt verwijderen?'
		); ?>
	</td>
</tr>