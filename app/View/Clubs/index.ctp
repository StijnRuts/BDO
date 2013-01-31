<div class="clubs index">
	<h2>Clubs</h2>
	<table>
		<tr>
			<th>id</th>
			<th>name</th>
			<th class="actions">Actions</th>
		</tr>
		<?php foreach ($clubs as $club): ?>
		<tr>
			<td><?php echo h($club['Club']['id']); ?></td>
			<td><?php echo h($club['Club']['name']); ?></td>
			<td class="actions">
				<?php echo $this->Html->link('Edit', array('action'=>'edit', $club['Club']['id'])); ?>
				<?php echo $this->Form->postLink(
					'Delete', array('action'=>'delete', $club['Club']['id']),
					null, 'Weet u zeker dat u deze club wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>

<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link('Club toevoegen', array('action'=>'add')); ?></li>
		<li><?php echo $this->Html->link('<- Terug naar deelnemers', array('controller'=>'contestants')); ?></li>
	</ul>
</div>
