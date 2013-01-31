<div class="contestants index">
	<h2><?php echo __('Contestants'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo 'id'; ?></th>
			<th><?php echo 'club_id'; ?></th>
			<th><?php echo 'discipline_id'; ?></th>
			<th><?php echo 'category_id'; ?></th>
			<th><?php echo 'division_id'; ?></th>
			<th><?php echo 'startnr'; ?></th>
			<th><?php echo 'name'; ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($contestants as $contestant): ?>
	<tr>
		<td><?php echo h($contestant['Contestant']['id']); ?>&nbsp;</td>
		<td>
			<?php echo h($contestant['Club']['name']); ?>
		</td>
		<td>
			<?php echo h($contestant['Discipline']['name']); ?>
		</td>
		<td>
			<?php echo h($contestant['Category']['name']); ?>
		</td>
		<td>
			<?php echo h($contestant['Division']['name']); ?>
		</td>
		<td><?php echo h($contestant['Contestant']['startnr']); ?>&nbsp;</td>
		<td><?php echo h($contestant['Contestant']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contestant['Contestant']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contestant['Contestant']['id']), null, __('Are you sure you want to delete # %s?', $contestant['Contestant']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Contestant'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Clubs'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club'), array('controller' => 'clubs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Disciplines'), array('controller' => 'disciplines', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Discipline'), array('controller' => 'disciplines', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Divisions'), array('controller' => 'divisions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Division'), array('controller' => 'divisions', 'action' => 'add')); ?> </li>
	</ul>
</div>
