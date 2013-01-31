<div class="disciplines index">
	<h2>Disciplines</h2>
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
</div>

<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link('Discipline toevoegen', array('action'=>'add')); ?></li>
		<li><?php echo $this->Html->link('<- Terug naar deelnemers', array('controller'=>'contestants')); ?></li>
	</ul>
</div>
