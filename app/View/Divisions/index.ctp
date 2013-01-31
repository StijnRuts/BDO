<table>
	<tr>
		<th>id</th>
		<th>order</th>
		<th>name</th>
		<th class="actions">Actions</th>
	</tr>
	<?php foreach ($divisions as $division): ?>
	<tr>
		<td><?php echo h($division['Division']['id']); ?></td>
		<td><?php echo h($division['Division']['order']); ?></td>
		<td><?php echo h($division['Division']['name']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link('Edit', array('action'=>'edit', $division['Division']['id'])); ?>
			<?php echo $this->Form->postLink(
				'Delete', array('action'=>'delete', $division['Division']['id']),
				null, 'Weet u zeker dat u deze divisie wilt verwijderen?'
			); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?= $this->Html->link('Divisie toevoegen', array('action'=>'add')); ?>
