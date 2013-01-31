<div class="contestants index">
	<h2>Deelnemers</h2>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th>id</th>
			<th>club</th>
			<th>discipline</th>
			<th>category</th>
			<th>division</th>
			<th>startnr</th>
			<th>name</th>
			<th class="actions">Actions</th>
		</tr>
		<?php foreach ($contestants as $contestant): ?>
		<tr>
			<td><?php echo h($contestant['Contestant']['id']); ?></td>
			<td><?php echo h($contestant['Club']['name']); ?></td>
			<td><?php echo h($contestant['Discipline']['name']); ?></td>
			<td><?php echo h($contestant['Category']['name']); ?></td>
			<td><?php echo h($contestant['Division']['name']); ?></td>
			<td><?php echo h($contestant['Contestant']['startnr']); ?></td>
			<td><?php echo h($contestant['Contestant']['name']); ?></td>
			<td class="actions">
				<?php echo $this->Html->link('Edit', array('action'=>'edit', $contestant['Contestant']['id'])); ?>
				<?php echo $this->Form->postLink(
					'Delete', array('action'=>'delete', $contestant['Contestant']['id']),
					null, 'Weet u zeker dat u deze deelnemer wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>

<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link('Deelnemer toevoegen', array('action'=>'add')); ?></li>
		<li><?php echo $this->Html->link('-> Ga naar Clubs', array('controller'=>'clubs')); ?> </li>
		<li><?php echo $this->Html->link('-> Ga naar Disciplines', array('controller'=>'disciplines')); ?></li>
		<li><?php echo $this->Html->link('-> Ga naar Categoriëen', array('controller'=>'categories')); ?></li>
		<li><?php echo $this->Html->link('-> Ga naar Divisies', array('controller'=>'divisions')); ?></li>
	</ul>
</div>
