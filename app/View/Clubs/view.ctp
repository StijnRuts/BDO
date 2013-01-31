<div class="clubs view">
<h2><?php  echo __('Club'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($club['Club']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($club['Club']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Club'), array('action' => 'edit', $club['Club']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Club'), array('action' => 'delete', $club['Club']['id']), null, __('Are you sure you want to delete # %s?', $club['Club']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Clubs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Club'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contestants'), array('controller' => 'contestants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Contestants'); ?></h3>
	<?php if (!empty($club['Contestant'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Club Id'); ?></th>
		<th><?php echo __('Discipline Id'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th><?php echo __('Division Id'); ?></th>
		<th><?php echo __('Startnr'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($club['Contestant'] as $contestant): ?>
		<tr>
			<td><?php echo $contestant['id']; ?></td>
			<td><?php echo $contestant['club_id']; ?></td>
			<td><?php echo $contestant['discipline_id']; ?></td>
			<td><?php echo $contestant['category_id']; ?></td>
			<td><?php echo $contestant['division_id']; ?></td>
			<td><?php echo $contestant['startnr']; ?></td>
			<td><?php echo $contestant['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'contestants', 'action' => 'view', $contestant['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'contestants', 'action' => 'edit', $contestant['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'contestants', 'action' => 'delete', $contestant['id']), null, __('Are you sure you want to delete # %s?', $contestant['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
