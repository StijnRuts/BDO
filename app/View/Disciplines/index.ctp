<table>
	<tr>
		<th>id</th>
		<th>order</th>
		<th>name</th>
		<th class="actions">Actions</th>
	</tr>
	<?php foreach ($disciplines as $discipline): ?>
	<tr>
		<td><?php echo h($discipline['Discipline']['id']); ?></td>
		<td><?php echo h($discipline['Discipline']['order']); ?></td>
		<td><?php echo h($discipline['Discipline']['name']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('Edit', array('action'=>'edit', $discipline['Discipline']['id'])); ?>
			<?php echo $this->Form->postLink(
				'Delete', array('action'=>'delete', $discipline['Discipline']['id']),
				null, 'Weet u zeker dat u deze discipline wilt verwijderen?'
			); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?= $this->Html->link('Discipline toevoegen', array('action'=>'add')); ?>
