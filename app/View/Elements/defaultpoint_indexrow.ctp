<tr class="level<?= $level; ?>">
	<td class="ordering-arrows">
		<?= $this->Form->postLink(
			'<i class="f-icon-up-arrow"></i>',
			array('action'=>'moveup', $defaultpoint['Defaultpoint']['id']),
			array('escape'=>false, 'title'=>h($defaultpoint['Defaultpoint']['name'].' naar boven verplaatsen'))
		); ?>
		<?= $this->Form->postLink(
			'<i class="f-icon-down-arrow"></i>',
			array('action'=>'movedown', $defaultpoint['Defaultpoint']['id']),
			array('escape'=>false, 'title'=>h($defaultpoint['Defaultpoint']['name'].' naar onder verplaatsen'))
		); ?>
	</td>
	<td class="name"><?= h($defaultpoint['Defaultpoint']['name']); ?></td>
	<td><?= h($defaultpoint['Defaultpoint']['max']); ?></td>
	<td>
		<?= $this->Html->link(
			'<i class="f-icon-tools"></i>',
			array('action'=>'edit', $defaultpoint['Defaultpoint']['id']),
			array('escape'=>false, 'title'=>'Bewerk '.h($defaultpoint['Defaultpoint']['name']))
		); ?>
		<?= $this->Form->postLink(
			'<i class="f-icon-remove"></i>',
			array('action'=>'delete', $defaultpoint['Defaultpoint']['id']),
			array('escape'=>false, 'title'=>'Verwijder '.h($defaultpoint['Defaultpoint']['name'])),
			'Weet u zeker dat u '.h($defaultpoint['Defaultpoint']['name']).' wilt verwijderen?'
		); ?>
	</td>
</tr>