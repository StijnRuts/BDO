<div class="categories index">
	<h2>Categori&euml;en</h2>
	<table>
		<tr>
			<th>id</th>
			<th>order</th>
			<th>name</th>
			<th class="actions">Actions</th>
		</tr>
		<?php foreach ($categories as $category): ?>
		<tr>
			<td><?php echo h($category['Category']['id']); ?></td>
			<td><?php echo h($category['Category']['order']); ?></td>
			<td><?php echo h($category['Category']['name']); ?></td>
			<td class="actions">
				<?php echo $this->Html->link('Edit', array('action'=>'edit', $category['Category']['id'])); ?>
				<?php echo $this->Form->postLink(
					'Delete', array('action'=>'delete', $category['Category']['id']),
					null, 'Weet u zeker dat u deze categorie wilt verwijderen?'
				); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>

<div class="actions">
	<h3>Actions</h3>
	<ul>
		<li><?php echo $this->Html->link('Categorie toevoegen', array('action'=>'add')); ?></li>
		<li><?php echo $this->Html->link('<- Terug naar deelnemers', array('controller'=>'contestants')); ?></li>
	</ul>
</div>
