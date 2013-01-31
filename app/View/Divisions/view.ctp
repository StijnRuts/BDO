<div class="divisions view">
<h2><?php  echo __('Division'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($division['Division']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo h($division['Division']['order']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($division['Division']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Division'), array('action' => 'edit', $division['Division']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Division'), array('action' => 'delete', $division['Division']['id']), null, __('Are you sure you want to delete # %s?', $division['Division']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Divisions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Division'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contestants'), array('controller' => 'contestants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contestant'), array('controller' => 'contestants', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Contestants'); ?></h3>
	<?php if (!empty($division['Contestant'])): ?>
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
		foreach ($division['Contestant'] as $contestant): ?>
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
